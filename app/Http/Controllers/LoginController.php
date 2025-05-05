<?php

namespace App\Http\Controllers;
use App\Models\main;
use App\Models\Room;
use App\Models\booking;
use App\Models\news;
use App\Models\Enquiry;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\gallery;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('Login');
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->role != "customer") {
                    Auth::logout();
                    return redirect()->route('admin.login')->with('error', 'This is not an admin page.');
                }
                return redirect($request->redirect_to ?? route('account.dashboard'));
            } else {
                return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
            }
        } else {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }
    }
    
    public function register(){

        return view('register');
    }

    public function processRegister(Request $request)
{ 
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:5',
        'password_confirmation' => 'required|min:5',
        'name' => 'required',
        'phone' => ['required', 'regex:/^9\d{9}$/'],  
    ]);

    if ($validator->passes()) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'customer';
        $user->save();

        return redirect()->route('account.login')->with('success', 'You have registered successfully');
    } else {
        return redirect()->route('account.register')
            ->withInput()
            ->withErrors($validator);
    }
}


    public function logout(){
        Auth::logout();
        return redirect()->route('account.home');
    }
    public function home(){
        $data =main::all();
        return view('home',compact('data'));
    }
    public function view_room(){
        $data = Room::all();
    
        foreach ($data as $room) {
            $approvedBookingsCount = booking::where('room_id', $room->id)
                                            ->where('status', 'confirmed')
                                            ->count();
    
            $room->isAvailable = $approvedBookingsCount < $room->total_rooms;
        }
    
        return view('rooms', compact('data'));
    }
    
    public function room_details($id)
    {
        $room = Room::find($id);
        
        $approvedBookingsCount = booking::where('room_id', $id)
                                        ->where('status', 'confirmed')
                                        ->count();
        
        $roomAvailability = $approvedBookingsCount < $room->total_rooms;

        $recommendedRooms = (new RecommendationController)->recommend($id);
    
        $availableRoomsPerType = Room::select('room_type', 'total_rooms', 'id')->get();

        $recommendedRooms->each(function ($recommendedRoom) {
            $approvedBookingsCount = booking::where('room_id', $recommendedRoom->id)
                                            ->where('status', 'confirmed')
                                            ->count();
            $recommendedRoom->isAvailable = $approvedBookingsCount < $recommendedRoom->total_rooms;
        });

        return view('room_details', compact('room', 'roomAvailability','availableRoomsPerType', 'recommendedRooms'));
    }

    public function add_newsletter(Request $request){
            $request->validate([
                'email' => 'required|email|unique:news,email',
            ], [
                'email.unique' => 'You are already subscribed', 
            ]);
        
            
            $data = new news();
            $data->email = $request->email;
        
            $data->save();
        
            return redirect()->back()->with('message', 'You are now subscribed');
        }
        public function viewservice(){
            $data = Service::all();
        return view('viewservice',compact('data')); 
        }

        public function checkAvailability(Request $request)
        {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        
            $rooms = Room::all()->map(function ($room) use ($start_date, $end_date) {
                $total_rooms = $room->total_rooms;
        
                $booked_rooms = Booking::where('room_id', $room->id)
                    ->where(function ($query) use ($start_date, $end_date) {
                        $query->whereBetween('start_date', [$start_date, $end_date])
                            ->orWhereBetween('end_date', [$start_date, $end_date])
                            ->orWhere(function ($query) use ($start_date, $end_date) {
                                $query->where('start_date', '<=', $start_date)
                                      ->where('end_date', '>=', $end_date);
                            });
                    })
                    ->count();
        
                $room->available_rooms = max($total_rooms - $booked_rooms, 0);
                return $room;
            })->filter(function ($room) {
                return $room->available_rooms > 0; // Keep only available rooms
            });
        
            return view('availability_results', compact('rooms', 'start_date', 'end_date'));
        }
        
        public function storeenquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'total_people' => 'required|integer|min:1',
            'message' => 'nullable|string'
        ]);

        Enquiry::create($request->all());

        return back()->with('success', 'Enquiry sent successfully!');
    }

}
