<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\main;
use App\Models\booking;
use App\Models\gallery;
use App\Models\Service;
use App\Models\news;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Review;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryResponseMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::where('role', 'customer')->count();

    $mostBookedRoom = Booking::select('room_id')
        ->groupBy('room_id')
        ->orderByRaw('COUNT(*) DESC')
        ->first();
    $mostBookedRoom = $mostBookedRoom ? Room::find($mostBookedRoom->room_id) : null;

    $totalReviews = Review::count();

    $currentMonth = Carbon::now()->month;
    $bookingsThisMonth = Booking::whereMonth('created_at', $currentMonth)
        ->where('status', 'confirmed') 
        ->count();

        $availableRoomsPerType = Room::select('id', 'room_type', 'room_title', 'total_rooms')
        ->get()
        ->map(function ($roomType) {
            $bookedCount = Booking::where('room_id', $roomType->id)
                                  ->where('status', 'confirmed')
                                  ->count();
            $roomType->available_rooms = $roomType->total_rooms - $bookedCount;
            return $roomType;
        });    

    if (session()->has('newBooking')) {
        session()->flash('newBookingMessage', 'There is a new booking!');
    }

    $months = [];
    $bookingsPerMonth = [];
    $earningsPerMonth = []; 
    for ($i = 1; $i <= 12; $i++) {
        $months[] = Carbon::create()->month($i)->format('F'); 
        $bookingsPerMonth[] = Booking::whereMonth('created_at', $i)
                                      ->count();
    
        $earningsPerMonth[] = Booking::whereMonth('created_at', $i)
            ->sum('total_amount'); 
    }

    return view('admin.dashboard', compact('totalUsers', 'mostBookedRoom', 'totalReviews', 'bookingsThisMonth', 'availableRoomsPerType', 'months', 'bookingsPerMonth', 'earningsPerMonth'));
}


    public function rooms(){
        return view('admin.create_rooms');
    }

    public function add_room(Request $request)
    {
        $data = new Room;
        
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->room_type = $request->type;
        $data->price = $request->price;
        $data->wifi = $request->has('wifi') ? 1 : 0;
        $data->bed_type = $request->bed_type;
        $data->total_rooms = $request->total_rooms;
        $data->room_view = $request->room_view; 
        $data->total_occupancy = $request->total_occupancy; 
        $data->breakfast = $request->has('breakfast') ? 1 : 0; 
    
        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }
    
        $data->save();
    
        return redirect()->back();
    }
    
    
    public function view_room() {
        $data =Room::all();
        return view('admin.viewroom',compact('data'));
    }
    public function delete_room($id){
        $data= Room::find($id);

        $data->delete();
         
        return redirect()->back();
    }
    public function update_room($id){
      
        $data= Room::find($id);
        return view('admin.updateroom',compact('data'));
    }
    public function edit_room(Request $request, $id)
    {
        $data = Room::find($id);
    
        if (!$data) {
            return redirect()->back()->with('error', 'Room not found');
        }
    
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->room_type = $request->type;
        $data->price = $request->price;
        $data->wifi = $request->has('wifi') ? 1 : 0; 
        $data->bed_type = $request->bed_type; 
        $data->total_rooms = $request->total_rooms; 
        $data->room_view = $request->room_view; 
        $data->total_occupancy = $request->total_occupancy; 
        $data->breakfast = $request->has('breakfast') ? 1 : 0; 
    
        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }
    
        $data->save();
    
        return redirect(route('admin.viewroom'))->with('success', 'Room updated successfully');
    }
    
    public function edit_main(){
        return view('admin.mainpage');
    }
    public function add_main(Request $request){
        $data = new main;

        $data->title = $request->title;
        $image = $request->image;

        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->mainimage->move('mainpage',$imagename);

            $data->mainimage=$imagename;
        }

        $data->save();

        return redirect()->back();

    }
    public function view_main() {
        $data =main::all();
        return view('admin.viewmain',compact('data'));
    }
    public function update_main($id){

        $page= main::find($id);
        return view('admin.updatemain',compact('page'));

    }
    public function edit_images(Request $request,$id){
        $page=main::find($id);
        $page->title=$request->title;
        $image=$request->image;

        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('mainpage',$imagename);
            $page->mainimage=$imagename;
        }

        $page->save();
        return redirect(route('admin.viewmain'));
    }


    public function booking(Request $request)
    {
        $currentDate = Carbon::now()->toDateString();

        booking::where('status', 'confirmed')
            ->where('end_date', '<', $currentDate)
            ->update(['status' => 'expired']);

        $page = $request->query('page', 1);
        $perPage = 5; 
        $total = booking::count(); 
        $totalPages = ceil($total / $perPage);
        $page = max(1, min($page, $totalPages));

        $data = booking::orderBy('created_at', 'desc')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();
    
        $prevPage = $page > 1 ? url()->current() . '?page=' . ($page - 1) : null;
        $nextPage = $page < $totalPages ? url()->current() . '?page=' . ($page + 1) : null;
    
        return view('admin.booking', compact('data', 'currentDate', 'page', 'totalPages', 'prevPage', 'nextPage'));
    }
    
    public function deletebooking($id){
        $data=booking::find($id);
        $data->delete();
        return redirect()->back();

    }
    public function approvebooking($id)
{
    $data = booking::find($id);
    $data->status = 'confirmed';
    $data->save();
    session()->flash('alert', 'Your booking has been confirmed by the admin!');
    return back(); 
}


    public function rejectbooking($id) {
        $data = booking::find($id);
        $data->status = 'canceled';
        $data->save();
        return redirect()->back();
    }
    
    public function view_gallery(){
        $gallery=gallery::all();

        return view('admin.gallery',compact('gallery'));
    }

    public function uploadgallery(Request $request){
        $data= new gallery;
        $image= $request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('gallery',$imagename);
            $data->image=$imagename;
            $data->save();
        }
        return redirect()->back();
    }

    public function deleteimage($id){
        $data=gallery::find($id);
        $data->delete();

        return redirect()->back();
    }
    public function view_newsletter(){
        $data= news::all();
        return view ('admin.newsletter',compact('data'));

    }

    public function manage_user(){
           $data=User::where('role','=','customer')->get();

           return view('admin.manageuser',compact('data'));
    }

    public function delete_user($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('message', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }


    public function add_service()
    {
        return view('admin.create_service');
    }


    public function store_service(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);
    
        $data = new Service;
        $photo = $request->file('photo');
        if ($photo) {
            $imagename = time() . '.' . $photo->getClientOriginalExtension(); 
            $photo->move('service', $imagename); 
            $data->photo = $imagename;
        }

        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->save();
    
        return redirect()->route('services.view')->with('success', 'Service added successfully!');
    }
    

    public function view_service()
    {
        $services = Service::all(); 
        return view('admin.view_service', compact('services')); 
    }
    public function delete_service($id){
        $data=service::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function viewEnquiries()
    {
        $enquiries = Enquiry::latest()->get();
        return view('admin.enquiries', compact('enquiries'));
    }
    public function replyForm($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('admin.reply-enquiry', compact('enquiry'));
    }
    public function sendReply(Request $request, $id)
    {
        $request->validate(['response' => 'required|string']);

        $enquiry = Enquiry::find($id);
    
        if (!$enquiry) {
            Log::error('Enquiry not found: ' . $id);
            return back()->with('error', 'Enquiry not found.');
        }

        $updated = $enquiry->update([
            'response' => $request->response,
            'status' => 'responded',
            'responded_at' => now(),
        ]);
    
        if (!$updated) {
            Log::error('Database update failed');
            return back()->with('error', 'Failed to update response.');
        }

        try {
            Mail::to($enquiry->email)->send(new EnquiryResponseMail($enquiry));
        } catch (\Exception $e) {
            return back()->with('error', 'Email sending failed. Check logs.');
        }
    
        return redirect()->route('admin.enquiries')->with('success', 'Response sent successfully!');
    }
    
}
