<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            color: #2c3e50;
            border-bottom: 2px solid #2ecc71;
            padding-bottom: 10px;
        }

        .room-image {
            max-width: 350px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .booking-summary, .payment-section {
            width: 45%;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking-summary h2 {
            font-size: 24px;
            color: #2ecc71;
            margin-bottom: 20px;
        }

        .booking-summary p {
            font-size: 16px;
            margin: 8px 0;
            color: #34495E;
        }

        .booking-summary p strong {
            color: #2ecc71;
        }

        button.btn-success {
            display: block;
            width: 100%;
            background: #28a745;
            color: #fff;
            font-size: 18px;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        button.btn-success:hover {
            background: #218838;
        }

        .payment-section {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .payment-summary {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .payment-summary p {
            font-size: 16px;
            margin: 10px 0;
            color: #34495E;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .room-image {
                max-width: 80%;
                margin-bottom: 20px;
            }

            .booking-summary, .payment-section {
                width: 100%;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="booking-summary">
        <h2>Room: {{ $room->room_title }}</h2>
        <img class="room-image" src="{{ asset('room/' . $room->image) }}" alt="{{ $room->room_title }}">
        <p><strong>Price:</strong> Rs. {{ $room->price }}</p>
        <p><strong>WiFi:</strong> {{ $room->wifi ? 'Available' : 'Not Available' }}</p>
        <p><strong>Breakfast:</strong> {{ $room->breakfast ? 'Available' : 'Not Available' }}</p>
        <p><strong>Bed Type:</strong> {{ $room->bed_type }}</p>
            
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Phone:</strong> {{ $phone }}</p>
    </div>

    <div class="payment-section">
        <div class="payment-summary">
            <h2>Payment Summary</h2>
            @php
                $start = \Carbon\Carbon::parse($startDate);
                $end = \Carbon\Carbon::parse($endDate);
                $numberOfDays = $start->diffInDays($end);
                $totalAmount = $room->price * $numberOfDays;
            @endphp
            <p><strong>Total People:</strong> {{ $total_people }}</p>
            <p><strong>Total Amount:</strong> Rs. {{ $totalAmount }}</p>
            <p><strong>Room:</strong> {{ $room->room_title }}</p>
            <p><strong>Check In:</strong> {{ $startDate }}</p>
            <p><strong>Check Out:</strong> {{ $endDate }}</p>
        </div>
        
        <form action="{{ route('paymentInitiate') }}" method="POST">
            @csrf
            <input type="hidden" name="inputAmount4" value="{{ $totalAmount }}">
            <input type="hidden" name="inputguests" value="{{ $total_people }}">
            <input type="hidden" name="inputPurchasedOrderName" value="{{ $room->room_title }}">
            <input type="hidden" name="inputPurchasedOrderId4" value="{{ $room->id }}">
            <input type="hidden" name="startdate" value="{{ $startDate }}">
            <input type="hidden" name="enddate" value="{{ $endDate }}">
            <input type="hidden" name="inputName" value="{{ $name }}">
            <input type="hidden" name="inputEmail" value="{{ $email }}">
            <input type="hidden" name="inputPhone" value="{{ $phone }}">

            <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </form>
    </div>
</div>

</body>

</html>
