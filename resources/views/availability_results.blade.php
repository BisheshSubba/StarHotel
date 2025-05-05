<!doctype html>
<html lang="en">
@include ('partials.head')
<style>
  body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    color: #333;
    line-height: 1.6;
  }

  .container {
    width: 90%;
    max-width: 1200px;
    margin: 40px auto;
  }

  .page-title {
    text-align: center;
    margin-bottom: 40px;
    color: #222;
    position: relative;
    padding-bottom: 15px;
  }

  .page-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background-color: #d4af37; /* Gold color */
  }

  .date-range {
    text-align: center;
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 30px;
  }

  .date-range span {
    font-weight: 600;
    color: #d4af37;
  }

  .rooms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 30px;
  }

  .room-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  }

  .room-image {
    height: 200px;
    background-size: cover;
    background-position: center;
  }

  .room-content {
    padding: 25px;
  }

  .room-title {
    font-size: 1.5rem;
    margin: 0 0 10px 0;
    color: #222;
  }

  .room-detail {
    margin: 8px 0;
    font-size: 0.95rem;
    color: #555;
  }

  .room-detail strong {
    color: #333;
  }

  .price {
    font-size: 1.3rem;
    font-weight: 600;
    color: #d4af37;
    margin: 15px 0;
  }

  .availability {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
  }

  .available {
    background-color: #e8f5e9;
    color: #2e7d32;
  }

  .unavailable {
    background-color: #ffebee;
    color: #c62828;
  }

  .book-btn {
    display: inline-block;
    padding: 12px 25px;
    background-color: #d4af37;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 1rem;
  }

  .book-btn:hover {
    background-color: #c19b2e;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
  }

  .no-rooms {
    text-align: center;
    grid-column: 1/-1;
    padding: 40px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  }

  @media (max-width: 768px) {
    .rooms-grid {
      grid-template-columns: 1fr;
    }
    
    .container {
      width: 95%;
    }
  }
</style>
<body>
    @include ('partials.header')

    <div class="container">
        <h1 class="page-title">Available Rooms</h1>
        <p class="date-range">From <span>{{ $start_date }}</span> to <span>{{ $end_date }}</span></p>

        <div class="rooms-grid">
            @foreach ($rooms as $room)
            <div class="room-card">
            @if($room->image)
                <div class="room-image"  @isset($room->image)
        style="background: url('{{ asset('room/' . $room->image) }}') no-repeat center center/cover;"
        @endisset>
    </div>
            @endif
                <div class="room-content">
                    <h3 class="room-title">{{ $room->room_title }}</h3>
                    <p class="room-detail"><strong>Room Type:</strong> {{ $room->room_type }}</p>
                    <p class="room-detail"><strong>Bed Type:</strong> {{ $room->bed_type }}</p>
                    
                    @if ($room->available_rooms > 0)
                        <span class="availability available">Available: {{ $room->available_rooms }}</span>
                    @else
                        <span class="availability unavailable">Sold Out</span>
                    @endif
                    
                    <p class="price">{{ convertCurrency($room->price) }} {{ session('currency', 'NPR') }}</p>
                    
                    @if ($room->available_rooms > 0)
                        <a href="/room_details/{{ $room->id }}?start_date={{ $start_date }}&end_date={{ $end_date }}" class="book-btn">Book Now</a>
                    @else
                        <button class="book-btn" disabled>Not Available</button>
                    @endif
                </div>
            </div>
            @endforeach
            
            @if(count($rooms) === 0)
            <div class="no-rooms">
                <h3>No rooms available for the selected dates</h3>
                <p>Please try different dates or contact us for assistance.</p>
            </div>
            @endif
        </div>
    </div>

    @include('partials.footer')
</body>
</html>