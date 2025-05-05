<!DOCTYPE html>
<html lang="en">
@include ('partials.head')
<style>
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #faf7f2;
    margin: 0;
    padding: 0;
    color: #333;
}

.rooms {
    display: flex;
    flex-direction: column;
    padding: 60px 20px;
    background-color: #faf7f2;
}

h1 {
    font-size: 3em;
    font-weight: 300;
    color: #8c6e3d;
    margin-bottom: 40px;
    text-align: center;
    position: relative;
    letter-spacing: 1px;
}

h1::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 2px;
    background-color: #d4af37;
}

.cont {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: center;
    padding: 0 50px;
    max-width: 1400px;
    margin: 0 auto;
}

.room {
    flex: 1 1 calc(33.333% - 40px);
    max-width: calc(33.333% - 40px);
    min-width: 320px;
    display: flex;
    flex-direction: column;
    background-color: #fff;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border-radius: 8px;
    transition: all 0.4s ease;
    position: relative;
}

.room:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
}

.room_img {
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.room_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.room:hover .room_img img {
    transform: scale(1.1);
}

.bed_room {
    padding: 25px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.bed_room h3 {
    font-size: 1.8em;
    color: #5a4a2a;
    margin-bottom: 15px;
    font-weight: 500;
}

.bed_room p {
    font-size: 1.05em;
    color: #6e6e6e;
    margin-bottom: 15px;
    line-height: 1.7;
    flex-grow: 1;
}

.bed_room strong {
    color: #5a4a2a;
}

.room-price {
    font-size: 1.4em;
    color: #d4af37;
    font-weight: 600;
    margin: 15px 0;
    letter-spacing: 0.5px;
}

.btn-primary {
    display: inline-block;
    padding: 12px 30px;
    font-size: 1.05em;
    color: #fff;
    background-color: #d4af37;
    border-radius: 4px;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-family: 'Cormorant Garamond', serif;
    letter-spacing: 0.5px;
}

.btn-primary:hover {
    background-color: #c19b2e;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
}

.btn-primary:disabled {
    background-color: #cccccc;
    transform: none;
    box-shadow: none;
    cursor: not-allowed;
}

.view-all {
    text-align: center;
    margin-top: 50px;
}

.view-all .btn {
    padding: 15px 35px;
    font-size: 1.1em;
    font-weight: 500;
    color: #fff;
    background-color: #d4af37;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
    letter-spacing: 1px;
}

.view-all .btn:hover {
    background-color: #b38f2a;
    transform: translateY(-3px);
}

.availability-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.85em;
    font-weight: 600;
    z-index: 2;
}

.available {
    background-color: rgba(212, 175, 55, 0.9);
    color: white;
}

.unavailable {
    background-color: rgba(204, 204, 204, 0.9);
    color: #666;
}

@media (max-width: 1024px) {
    .room {
        flex: 1 1 calc(50% - 30px);
        max-width: calc(50% - 30px);
    }
}

@media (max-width: 768px) {
    .cont {
        padding: 0 20px;
        gap: 30px;
    }
    
    h1 {
        font-size: 2.5em;
    }
}

@media (max-width: 600px) {
    .room {
        flex: 1 1 100%;
        max-width: 100%;
        min-width: auto;
    }
    
    .rooms {
        padding: 40px 15px;
    }
}
</style>

<body>
    @include('partials.header')

    <div class="rooms">
        <h1>Our Luxurious Rooms</h1>
        <div class="cont">
            @foreach($data as $rooms)
            <div class="room">
                @if($rooms->isAvailable)
                    <span class="availability-badge available">Available</span>
                @else
                    <span class="availability-badge unavailable">Unavailable</span>
                @endif
                <div class="room_img">
                    <figure>
                        <img src="{{ asset('room/' . $rooms->image) }}" alt="{{ $rooms->room_title }}">
                    </figure>
                </div>
                <div class="bed_room">
                    <h3>{{ $rooms->room_title }}</h3>
                    <p>{{ Str::limit($rooms->description, 150) }}</p>
                    <p><strong>Bed Type:</strong> {{ $rooms->bed_type }}</p>
                    <p class="room-price">{{ convertCurrency($rooms->price) }} {{ session('currency', 'NPR') }}</p>

                    @if($rooms->isAvailable)
                        <a class="btn-primary" href="{{ route('room_details', $rooms->id) }}">View Details</a>
                    @else
                        <button class="btn-primary" disabled>Currently Booked</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('partials.footer')
</body>
</html>