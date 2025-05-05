<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Booking; 
use App\Models\Room;
use Illuminate\Support\Facades\Http;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Session;
use CurlFile;

class PaymentController extends Controller
{
    public function bookingDetails(Request $request)
{
    $roomId = $request->input('inputPurchasedOrderId');
    $room = Room::findOrFail($roomId);

    $startDate = $request->input('startdate');
    $endDate = $request->input('enddate');
    $name = $request->input('inputName');
    $total_people = $request->input('inputTotalPeople');
    $email = $request->input('inputEmail');
    $phone = $request->input('inputPhone');

    $isBookedByUser = Booking::where('room_id', $roomId)
        ->where('start_date', '<=', $endDate)
        ->where('end_date', '>=', $startDate)
        ->where('email', $email)
        ->exists();

    if ($isBookedByUser) {
        return redirect()->back()->with('message', 'You have already booked this room during this time.');
    }

    $bookedRoomsCount = Booking::where('room_id', $roomId)
        ->where('start_date', '<=', $endDate)
        ->where('end_date', '>=', $startDate)
        ->count();

    if ($bookedRoomsCount >= $room->total_rooms) {
        return redirect()->back()->with('message', 'No rooms available for the selected dates.');
    }


    return view('booking_details', compact('room', 'startDate', 'endDate', 'name','total_people', 'email', 'phone'));
}

public function initiatePayment(Request $request)
{
    $amount = $request->input('inputAmount4');
    $purchase_order_id = $request->input('inputPurchasedOrderId4');
    $purchase_order_name = $request->input('inputPurchasedOrderName');
    $name = $request->input('inputName');
    $email = $request->input('inputEmail');
    $phone = $request->input('inputPhone');
    $guest = $request->input('inputguests');
    $roomId = $request->input('inputPurchasedOrderId4');
    $startDate = $request->input('startdate');
    $endDate = $request->input('enddate');

    $booking = Booking::create([
        'room_id' => $roomId,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'phone' => $phone,
        'total_occupancy' => $guest,
        'email' => $email,
        'name' => $name,
        'status' => 'pending',
        'total_amount' => $amount,
    ]);

    session([
        'purchase_order_id' => $purchase_order_id,
        'purchase_order_name' => $purchase_order_name,
        'amount' => $amount,
        'name' => $name,
        'email' => $email,
        'room_id' =>$roomId,
    ]);

    $postFields = [
        "return_url" => route('paymentResponse'),
        "website_url" => url('/'),
        "amount" => $amount * 100,  
        "purchase_order_id" => $purchase_order_id,
        "purchase_order_name" => $purchase_order_name,
        "customer_info" => [
            "name" => $name,
            "email" => $email,
            "phone" => $phone
        ]
    ];

    $jsonData = json_encode($postFields);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => [
            'Authorization: key ' . env('KHALTI_SECRET_KEY'),
            'Content-Type: application/json',
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $responseArray = json_decode($response, true);

        if (isset($responseArray['payment_url'])) {
            return redirect()->to($responseArray['payment_url']);
        } else {
            return back()->with('error', 'Payment initiation failed. Please try again.');
        }
    }

    return back()->with('error', 'Unexpected error occurred. Please try again.');
}


public function paymentResponse(Request $request)
{
    $pidx = $request->input('pidx');
    $purchaseOrderId = session('purchase_order_id');  
    $purchaseOrderName = session('purchase_order_name');
    $email = session('email');
    $roomId = session('room_id');

    if ($pidx && $purchaseOrderId) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]),
            CURLOPT_HTTPHEADER => [
                'Authorization: key ' . env('KHALTI_SECRET_KEY'),
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response) {
            $responseArray = json_decode($response, true);

            $booking = Booking::where('room_id', $roomId)
                ->where('status', 'pending')
                ->latest()
                ->first();

            if (!$booking) {
                session()->flash('error', 'No pending booking found.');
                return $this->returnRoomDetailsView($roomId);
            }

            if ($responseArray['status'] === 'Completed') {
                $booking->update(['status' => 'confirmed']);
                session()->flash('newBooking', true);
                Mail::to($email)->send(new BookingConfirmationMail($booking, $purchaseOrderName));
                session()->flash('success', 'Transaction successful. Your booking is confirmed.');
            } else {

                $booking->delete();
                session()->flash('error', 'Transaction failed. Booking has been canceled. Please try again.');
            }
        } else {
            Booking::where('room_id', $roomId)
                ->where('status', 'pending')
                ->latest()
                ->delete();

            session()->flash('error', 'Unable to verify payment. Booking has been canceled. Please try again.');
        }
    } else {
        Booking::where('room_id', $roomId)
            ->where('status', 'pending')
            ->latest()
            ->delete();

        session()->flash('error', 'Invalid payment response. Booking has been canceled. Please try again.');
    }

    return $this->returnRoomDetailsView($roomId);
}

private function returnRoomDetailsView($roomId)
    {
        $room = Room::find($roomId);
        $approvedBookingsCount = Booking::where('room_id', $roomId)
                                        ->where('status', 'confirmed')
                                        ->count();
        
        $roomAvailability = $approvedBookingsCount < $room->total_rooms;

        $recommendedRooms = (new RecommendationController)->recommend($roomId);

        $recommendedRooms->each(function ($recommendedRoom) {
            $approvedBookingsCount = Booking::where('room_id', $recommendedRoom->id)
                                            ->where('status', 'confirmed')
                                            ->count();
            $recommendedRoom->isAvailable = $approvedBookingsCount < $recommendedRoom->total_rooms;
        });

        return view('room_details', compact('room', 'roomAvailability', 'recommendedRooms'));
    }
}