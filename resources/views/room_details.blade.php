<!DOCTYPE html>
<html lang="en">
@include ('partials.head')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #faf7f2;
        margin: 0;
        padding: 0;
        color: #333;
        line-height: 1.6;
    }

    :root {
        --primary-color: #5a4a2a;
        --secondary-color: #d4af37;
        --accent-color: #c19b2e;
        --light-bg: #f8f4e9;
        --dark-text: #2a2118;
        --light-text: #6e6e6e;
        --success-color: #8c9e6e;
        --error-color: #c17c74;
        --border-radius: 8px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    h1, h2, h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    h1 {
        font-size: 2.75rem;
        font-weight: 600;
        position: relative;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    h1:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--secondary-color);
        border-radius: 2px;
    }

    .rooms {
        padding: 4rem 0;
        background-color: #faf7f2;
    }

    .room-card {
        display: flex;
        flex-direction: row;
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        margin: 2rem auto;
        width: 90%;
        max-width: 1200px;
        transition: var(--transition);
        border-left: 5px solid var(--secondary-color);
        position: relative;
    }

    .room-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .room-card-left {
        flex: 1.2;
        display: flex;
        flex-direction: column;
    }

    .room-card-right {
        flex: 1;
        padding: 2.5rem;
        background-color: #fff;
        position: relative;
    }

    .room-card-right:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, var(--secondary-color), var(--accent-color));
    }

    .room-card-image {
        position: relative;
        overflow: hidden;
        height: 450px;
    }

    .room-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .room-card-image:hover .room-img {
        transform: scale(1.03);
    }

    .room-card-content {
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .room-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--primary-color);
        position: relative;
        padding-bottom: 0.5rem;
    }

    .room-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--secondary-color), var(--accent-color));
        border-radius: 2px;
    }

    .room-description {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--light-text);
    }

    .room-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background-color: var(--light-bg);
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .detail-item:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background-color: var(--secondary-color);
        transition: var(--transition);
    }

    .detail-item:hover:before {
        background-color: var(--accent-color);
        width: 5px;
    }

    .detail-item:hover {
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .detail-item i {
        font-size: 1.25rem;
        color: var(--secondary-color);
        min-width: 25px;
        text-align: center;
        transition: var(--transition);
    }

    .detail-item:hover i {
        color: var(--accent-color);
        transform: scale(1.1);
    }

    .detail-item h4 {
        font-size: 0.95rem;
        margin: 0;
        color: var(--dark-text);
        font-weight: 500;
    }

    .detail-item span {
        font-weight: 600;
        color: var(--primary-color);
    }

    .price-highlight {
        background: linear-gradient(135deg, var(--primary-color) 0%, #3a2e1a 100%);
        color: white;
        padding: 1.5rem;
        border-radius: var(--border-radius);
        text-align: center;
        margin-top: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(90, 74, 42, 0.2);
    }

    .price-highlight:after {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 40px;
        height: 40px;
        background-color: var(--secondary-color);
        transform: rotate(45deg);
        opacity: 0.3;
    }

    .price-highlight span {
        font-size: 1.75rem;
        font-weight: bold;
        color: var(--secondary-color);
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1;
    }

    .booking {
        background: linear-gradient(135deg, var(--primary-color) 0%, #3a2e1a 100%);
        padding: 3rem;
        margin: 3rem auto;
        max-width: 650px;
        box-shadow: var(--box-shadow);
        color: white;
        border-radius: var(--border-radius);
        position: relative;
        overflow: hidden;
    }

    .booking:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://www.transparenttextures.com/patterns/cream-paper.png');
        opacity: 0.05;
        pointer-events: none;
    }

    .booking h1 {
        color: var(--secondary-color);
        font-size: 2rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .booking h1:after {
        background: var(--secondary-color);
    }

    .booking label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        color: rgba(255, 255, 255, 0.9);
    }

    .booking input, 
    .booking select {
        width: 100%;
        padding: 0.75rem 1rem;
        margin-bottom: 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        font-size: 1rem;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        transition: var(--transition);
        font-family: 'Cormorant Garamond', serif;
    }

    .booking input[readonly] {
        background-color: rgba(255, 255, 255, 0.05) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        cursor: not-allowed;
    }

    .booking input[readonly]:focus {
        box-shadow: none !important;
    }

    .booking input:focus, 
    .booking select:focus {
        outline: none;
        border-color: var(--secondary-color);
        background-color: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .booking input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .btn {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: var(--transition);
        width: 100%;
        margin-top: 0.5rem;
        font-family: 'Cormorant Garamond', serif;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn:hover {
        background-color: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
    }

    .btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
        z-index: -1;
    }

    .btn:hover:before {
        left: 100%;
    }

    .full-booked-message {
        background-color: var(--error-color);
        color: white;
        padding: 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: var(--border-radius);
        text-align: center;
        margin: 2rem auto;
        width: 90%;
        max-width: 600px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: var(--box-shadow);
    }

    .full-booked-message i {
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 1.5rem;
        text-align: center;
        background-color: #faf7f2;
    }

    .recommended {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
        margin-top: 3rem;
    }

    .reco-room {
        width: 30%;
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
    }

    .reco-room:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .reco-room img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: var(--transition);
    }

    .reco-room:hover img {
        transform: scale(1.05);
    }

    .room-card-desc {
        padding: 1.75rem;
        text-align: left;
    }

    .room-card-desc h2 {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
        color: var(--primary-color);
        font-family: 'Playfair Display', serif;
        font-weight: 600;
    }

    .room-card-desc p {
        color: var(--light-text);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .room-card-desc .btn-primary {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        margin-top: 1.5rem;
        width: auto;
        display: inline-block;
        border-radius: 6px;
        font-weight: 600;
    }

    .room-card-desc .btn-primary:hover {
        background-color: var(--accent-color);
        transform: translateY(-3px);
    }

    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1.25rem 1.75rem;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        z-index: 1000;
        display: flex;
        align-items: center;
        max-width: 400px;
        opacity: 1;
        transition: opacity 0.5s ease;
        font-family: 'Cormorant Garamond', serif;
    }

    .alert-success {
        background-color: var(--success-color);
        color: white;
    }

    .alert-danger {
        background-color: var(--error-color);
        color: white;
    }

    .alert i {
        margin-right: 0.75rem;
        font-size: 1.5rem;
    }

    .close {
        margin-left: 1rem;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        opacity: 0.8;
        transition: var(--transition);
    }

    .close:hover {
        opacity: 1;
    }

    .auth-prompt {
        text-align: center;
        padding: 2.5rem;
        background: rgba(255,255,255,0.1);
        border-radius: var(--border-radius);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }

    .auth-prompt h3 {
        color: var(--secondary-color);
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }
    .enquiry-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
        z-index: 1000;
        overflow-y: auto;
    }

    .enquiry-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 2.5rem;
        width: 90%;
        max-width: 600px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        position: relative;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {opacity: 0; transform: translateY(-50px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 1.75rem;
        color: var(--light-text);
        cursor: pointer;
        transition: var(--transition);
    }

    .close-modal:hover {
        color: var(--primary-color);
        transform: rotate(90deg);
    }

    .enquiry-form h2 {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        text-align: center;
        font-family: 'Playfair Display', serif;
    }

    .enquiry-form h2:after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: var(--secondary-color);
        margin: 0.75rem auto;
    }

    .enquiry-form label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--dark-text);
        font-weight: 500;
    }

    .enquiry-form input,
    .enquiry-form textarea,
    .enquiry-form select {
        width: 100%;
        padding: 0.75rem 1rem;
        margin-bottom: 1.25rem;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
        font-family: 'Poppins', sans-serif;
    }

    .enquiry-form input:focus,
    .enquiry-form textarea:focus,
    .enquiry-form select:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .enquiry-form textarea {
        min-height: 120px;
        resize: vertical;
    }

    .enquiry-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
        display: inline-block;
        margin-top: 1rem;
        width: 100%;
    }

    .enquiry-btn:hover {
        background-color: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(90, 74, 42, 0.3);
    }

    .trigger-enquiry-btn {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
        display: block;
        margin: 2rem auto 0;
        width: 200px;
        text-align: center;
    }

    .trigger-enquiry-btn:hover {
        background-color: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
    }

    @media (max-width: 992px) {
        .room-card {
            flex-direction: column;
        }
        
        .room-card-image {
            height: 350px;
        }
        
        .room-details {
            grid-template-columns: 1fr;
        }
        
        .reco-room {
            width: 45%;
        }

        .room-card-right:before {
            width: 100%;
            height: 4px;
            top: auto;
            bottom: 0;
            background: linear-gradient(to right, var(--secondary-color), var(--accent-color));
        }
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 2.25rem;
        }
        
        .room-title {
            font-size: 1.75rem;
        }
        
        .booking {
            padding: 2.5rem;
        }
        
        .reco-room {
            width: 100%;
            max-width: 400px;
        }

        .room-card-content, .room-card-right {
            padding: 1.75rem;
        }
    }

    @media (max-width: 576px) {
        .room-card {
            width: 95%;
        }
        
        .booking {
            width: 95%;
            padding: 2rem;
        }
        
        .alert {
            width: 90%;
            left: 5%;
            right: 5%;
        }

        .price-highlight span {
            font-size: 1.5rem;
        }
    }
</style>

<body>
@include('partials.header')

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
        <span class="close" onclick="this.parentElement.style.opacity='0'">&times;</span>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
        <span class="close" onclick="this.parentElement.style.opacity='0'">&times;</span>
    </div>
@endif

<div class="rooms">
    <div class="room-card">
        <div class="room-card-left">
            <div class="room-card-image">
                <a href="javascript:void(0)" data-image="{{ asset('room/' . $room->image) }}" onclick="openModal(this)">
                    <img class="room-img" src="{{ asset('room/' . $room->image) }}" alt="Room Image">
                </a>
            </div>
            <div class="room-card-content">
                <div>
                    <h2 class="room-title">{{ $room->room_title }}</h2>
                    <p class="room-description">{{ $room->description }}</p>
                </div>
                <div class="price-highlight">
                    Price: <span>{{ convertCurrency($room->price) }} {{ session('currency', 'NPR') }}</span> per night
                </div>
            </div>
        </div>
        <div class="room-card-right">
            <h3>Room Features</h3>
            <div class="room-details">
                <div class="detail-item">
                    <i class="fas fa-bed"></i>
                    <h4>Room Type: <span>{{ $room->room_type }}</span></h4>
                </div>
                <div class="detail-item">
                    <i class="fas fa-binoculars"></i>
                    <h4>Room View: <span>{{ $room->room_view }}</span></h4>
                </div>
                <div class="detail-item">
                    <i class="fas fa-wifi"></i>
                    <h4>WiFi: 
                        <span style="color: <?php echo $room->wifi ? 'var(--success-color)' : 'var(--error-color)'; ?>;">
                            {{ $room->wifi ? 'Available' : 'Not Available' }}
                        </span>
                    </h4>
                </div>
                <div class="detail-item">
                    <i class="fas fa-coffee"></i>
                    <h4>Breakfast: 
                        <span style="color: <?php echo $room->breakfast ? 'var(--success-color)' : 'var(--error-color)'; ?>;">
                            {{ $room->breakfast ? 'Available' : 'Not Available' }}
                        </span>
                    </h4>
                </div>
                <div class="detail-item">
                    <i class="fas fa-bed"></i>
                    <h4>Bed Type: <span>{{ $room->bed_type }}</span></h4>
                </div>
                <div class="detail-item">
                    <i class="fas fa-door-open"></i>
                    <h4>Available Rooms: <span>{{ $room->total_rooms - \App\Models\Booking::where('room_id', $room->id)->where('status', 'confirmed')->count() }}</span></h4>
                </div>
                <div class="detail-item">
                    <i class="fas fa-users"></i>
                    <h4>Total Occupancy: <span>{{ $room->total_occupancy }}</span></h4>
                </div>
                
                <button class="trigger-enquiry-btn" onclick="openEnquiryModal()">
                    <i class="fas fa-envelope"></i> Make an Enquiry
                </button>
            </div>
        </div>
    </div>

    @if($roomAvailability)
    <form action="{{ route('bookingDetails') }}" method="POST" onsubmit="return validateBookingForm()">
        @csrf
        <div class="booking">
            <h1>Book Room</h1>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session()->get('message') }}
                    <span class="close" onclick="this.parentElement.style.opacity='0'">&times;</span>
                </div>
            @endif

            @auth
                <form action="{{ route('bookingDetails') }}" method="POST" onsubmit="return validateBookingForm()">
                    @csrf
                    <label>Name:</label>
                    <input type="text" id="inputName" name="inputName" 
                           value="{{ Auth::user()->name }}" 
                           readonly 
                           placeholder="Your full name">

                    <label>Email:</label>
                    <input type="email" id="inputEmail" name="inputEmail" 
                           value="{{ Auth::user()->email }}" 
                           readonly 
                           placeholder="Your email address">

                    <label>Phone:</label>
                    <input type="text" id="inputPhone" name="inputPhone" 
                           value="{{ Auth::user()->phone }}" 
                           readonly 
                           placeholder="Your phone number">
                    
                    <label>Total People:</label>
                    <select id="inputTotalPeople" name="inputTotalPeople" required>
                        @for ($i = 1; $i <= $room->total_occupancy; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    
                    <input type="hidden" name="inputAmount" value="{{ $room->price }}">
                    <input type="hidden" name="inputPurchasedOrderName" value="{{ $room->room_title }}">
                    <input type="hidden" name="inputPurchasedOrderId" value="{{ $room->id }}">

                    <label>Start Date:</label>
                    <input type="text" id="startdate" name="startdate" placeholder="Select start date" readonly required>

                    <label>End Date:</label>
                    <input type="text" id="enddate" name="enddate" placeholder="Select end date" readonly required>

                    <button type="submit" class="btn">Book Now</button>
                </form>
            @else
                <div class="auth-prompt">
                    <h3>You need to login to book this room</h3>
                    <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 1.5rem;">
                        <a href="{{ route('account.login') }}" class="btn" style="background: var(--secondary-color); width: auto; padding: 0.75rem 2rem;">
                            Login
                        </a>
                        <a href="{{ route('account.register') }}" class="btn" style="background: var(--primary-color); width: auto; padding: 0.75rem 2rem;">
                            Register
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </form>
    @else
        <p class="full-booked-message">
            <i class="fas fa-exclamation-triangle"></i> Sorry, this room is fully booked for your selected dates.
        </p>
    @endif
</div>

@include('partials.review')

<div class="container">
    <h1>Recommended Rooms</h1>
    <div class="recommended">
        @if($recommendedRooms->count() > 0)
            @foreach($recommendedRooms as $room)
                <div class="reco-room">
                    <img src="{{ asset('room/' . $room->image) }}" alt="{{ $room->room_title }}">
                    <div class="room-card-desc">
                        <h2>{{ $room->room_title }}</h2>
                        <p>{{ Str::limit($room->description, 100) }}</p>
                        <p>{{ convertCurrency($room->price) }} {{ session('currency', 'NPR') }} | Rating: {{ $room->average_rating }}</p>
                        @if($room->isAvailable)
                            <a class="btn btn-primary" href="{{ route('room_details', $room->id) }}">View Details</a>
                        @else
                            <button class="btn btn-primary" disabled>Unavailable</button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p style="color: var(--light-text); font-style: italic;">No similar rooms found at this time.</p>
        @endif
    </div>
</div>

<div id="enquiryModal" class="enquiry-modal">
    <div class="enquiry-content">
        <span class="close-modal" onclick="closeEnquiryModal()">&times;</span>
        <div class="enquiry-form">
            <h2>Room Enquiry</h2>
            <form id="enquiryForm" action="{{ route('enquiries.store') }}" method="POST" onsubmit="return validateEnquiryForm()">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="room_title" value="{{ $room->room_title }}">
                
                <div>
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required 
                           placeholder="John Doe" 
                           pattern="[A-Za-z\s]+"
                           title="Name should only contain letters and spaces">
                </div>
                
                <div>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           placeholder="your@gmail.com" 
                           pattern="[a-zA-Z0-9._%+-]+@gmail\.com"
                           title="Please enter a valid @gmail.com address">
                </div>
                
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required 
                           placeholder="98XXXXXXXX" 
                           pattern="98\d{8}"
                           title="Phone must start with 98 and be 10 digits"
                           maxlength="10">
                </div>
                
                <div>
                    <label for="checkin_date">Check-in Date</label>
                    <input type="text" id="checkin_date" name="checkin_date" class="datepicker" required placeholder="Select date">
                </div>
                
                <div>
                    <label for="checkout_date">Check-out Date</label>
                    <input type="text" id="checkout_date" name="checkout_date" class="datepicker" required placeholder="Select date">
                </div>
                
                <div>
                    <label for="total_people">Total People</label>
                    <select id="total_people" name="total_people" required>
                        @for ($i = 1; $i <= $room->total_occupancy; $i++)
                            <option value="{{ $i }}">{{ $i }} person{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>
                
                <div>
                    <label for="message">Your Message (Optional)</label>
                    <textarea id="message" name="message" placeholder="Any special requests or questions..."></textarea>
                </div>
                
                <button type="submit" class="enquiry-btn">
                    <i class="fas fa-paper-plane"></i> Send Enquiry
                </button>
            </form>
        </div>
    </div>
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        flatpickr("#startdate", {
            dateFormat: "Y-m-d",
            minDate: today,
            onChange: function (selectedDates) {
                flatpickr("#enddate", {
                    dateFormat: "Y-m-d",
                    minDate: selectedDates[0],
                });
            }
        });

        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });

    function validateBookingForm() {
        const startdate = document.getElementById("startdate").value;
        const enddate = document.getElementById("enddate").value;

        if (!startdate) {
            alert("Please select a start date.");
            return false;
        }

        if (!enddate) {
            alert("Please select an end date.");
            return false;
        }

        return true; 
    }

    function validateEnquiryForm() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;
        const checkin = document.getElementById("checkin_date").value;
        const checkout = document.getElementById("checkout_date").value;

        const namePattern = /^[A-Za-z\s]+$/;
        if (!namePattern.test(name)) {
            alert("Name should only contain letters and spaces.");
            return false;
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid @gmail.com email address.");
            return false;
        }

        const phonePattern = /^98\d{8}$/;
        if (!phonePattern.test(phone)) {
            alert("Phone number must be exactly 10 digits and start with 98.");
            return false;
        }

        if (!checkin) {
            alert("Please select a check-in date.");
            return false;
        }

        if (!checkout) {
            alert("Please select a check-out date.");
            return false;
        }

        return true;
    }

    function openEnquiryModal() {
        document.getElementById('enquiryModal').style.display = 'block';
        document.body.style.overflow = 'hidden';

        flatpickr("#checkin_date", {
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates) {
                flatpickr("#checkout_date", {
                    dateFormat: "Y-m-d",
                    minDate: selectedDates[0],
                });
            }
        });
    }

    function closeEnquiryModal() {
        document.getElementById('enquiryModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('enquiryModal');
        if (event.target == modal) {
            closeEnquiryModal();
        }
    }

    document.getElementById('phone').addEventListener('input', function(e) {
        this.value = this.value.replace(/\D/g, '');
        
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
        
        if (this.value.length >= 2 && !this.value.startsWith('98')) {
            this.value = '98' + this.value.slice(2);
        }
    });
</script>

</body>
</html>