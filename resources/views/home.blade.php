<!DOCTYPE html>
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

  .banner {
    width: 100%;
    height: 80vh;
    max-height: 600px;
    display: flex;
    align-items: end;
    justify-content: center;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.7) 100%);
  }

  .banner h1 {
    position: relative;
    color: #8c6e3d;
    font-family: 'Baskerville Old Face', serif;
    font-size: 3.5rem;
    font-weight: 300;
    margin: 0;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    letter-spacing: 1px;
  }

  .content-container {
    width: 80%;
    max-width: 1200px;
    margin: 40px auto;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  }

  .content-container h2 {
    color: #222;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
    position: relative;
  }

  .content-container h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: hsl(38, 61%, 56%);
  }

  .content-container p {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    color: #555;
  }

  .btn-primary {
    display: inline-block;
    padding: 12px 28px;
    background-color: hsl(38, 61%, 56%);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(237, 178, 73, 0.3);
  }

  .btn-primary:hover {
    background-color: hsl(38, 61%, 50%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(237, 178, 73, 0.4);
  }

  .availability-container {
    width: 80%;
    max-width: 1200px;
    margin: 60px auto;
    text-align: center;
  }

  .check-availability {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    gap: 10px;
  }

  .date-input {
    position: relative;
    display: flex;
    align-items: center;
  }

  .date-input::before {
    content: '\f073';
    font-family: 'Font Awesome 6 Free';
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #777;
    font-weight: 900;
    z-index: 1;
  }

  .check-availability input {
    padding: 12px 15px 12px 35px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 0.9rem;
    width: 180px;
    transition: all 0.3s ease;
    position: relative;
  }

  .check-availability input:focus {
    border-color: hsl(38, 61%, 56%);
    outline: none;
    box-shadow: 0 0 0 3px rgba(237, 178, 73, 0.2);
  }

  .check-availability button {
    padding: 12px 28px;
    background-color: hsl(38, 61%, 56%);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .check-availability button:hover {
    background-color: hsl(38, 61%, 50%);
    transform: translateY(-2px);
  }

  .newsletter {
    width: 80%;
    max-width: 600px;
    margin: 60px auto;
    padding: 40px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    text-align: center;
  }

  .newsletter h2 {
    color: #222;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
  }

  .newsletter .email {
    padding: 12px 20px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 1rem;
    width: 100%;
    max-width: 400px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
  }

  .newsletter .email:focus {
    border-color: hsl(38, 61%, 56%);
    outline: none;
    box-shadow: 0 0 0 3px rgba(237, 178, 73, 0.2);
  }

  .alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
    background-color: #f8f9fa;
    color: #333;
    position: relative;
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
  }

  .close {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }

  @media (max-width: 768px) {
    .banner h1 {
      font-size: 2.5rem;
    }
    
    .content-container {
      width: 90%;
      padding: 25px;
    }
    
    .check-availability {
      flex-direction: column;
      align-items: stretch;
    }
    
    .check-availability input {
      width: 100%;
    }
  }
</style>
<body>

    @include('partials.header')
    
    <div class="banner" 
        @isset($data[1]->mainimage)
        style="background: url('{{ asset('mainpage/'.$data[0]->mainimage) }}') no-repeat center center/cover;"
        @endisset>
        <h1>Welcome to The Star Hotel</h1>
    </div>

    <div class="content-container">
        <h2>Introduction</h2>
        <p>Welcome to The Star Hotel, a modern sanctuary infused with the timeless charm of Nepal's architectural heritage. Established in 2024, our hotel is more than just a place to stay—it's an experience that marries luxury with authenticity, designed for discerning travelers who seek comfort without compromising on cultural immersion.</p>
        <p>Nestled in the heart of the city, The Star Hotel offers you the best of both worlds: the opulence of a high-end retreat and the warm, inviting atmosphere reminiscent of traditional Nepali homes.</p>
    </div>

    <div class="content-container">
        <h2>Rooms & Suites</h2>
        <p>Indulge in the ultimate comfort with our selection of elegant rooms and suites. Whether you prefer a cozy Deluxe Room or a luxurious Suite, each accommodation is designed with traditional Nepali aesthetics blended seamlessly with modern amenities.</p>
        <p>Enjoy features like plush bedding, high-speed WiFi, and breathtaking city views. Your perfect stay starts here.</p>
        <a href="{{ route('account.room') }}" class="btn btn-primary">Explore Rooms</a>
    </div>

    <div class="availability-container">
        <div class="check-availability">
            <div class="date-input">
                <input type="text" id="start_date" name="start_date" placeholder="Check-in Date" required>
            </div>
            <div class="date-input">
                <input type="text" id="end_date" name="end_date" placeholder="Check-out Date" required>
            </div>
            <button type="submit">Check Availability</button>
        </div>
    </div>

    <div class="newsletter">
        <h2>Stay Updated</h2>

        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" style="background-color: transparent; border:none; align-self: flex-end;" class="close" data-bs-dismiss="alert">x</button>
                {{session()->get('message')}}
            </div>
        @endif

        <form action="{{route('add_newsletter')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="email" type="email" name="email" placeholder="Enter your email" required>
            <input class="btn btn-primary" type="submit" value="Subscribe">
        </form>
    </div>

    @include('partials.footer')

    <!-- Add Font Awesome for calendar icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date pickers
            const startDate = flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    endDate.set("minDate", dateStr);
                }
            });
            
            const endDate = flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                minDate: "today"
            });

            // Form submission
            document.querySelector('.check-availability').addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON') {
                    const form = document.createElement('form');
                    form.method = 'GET';
                    form.action = "{{route('checkavailability')}}";
                    
                    const startInput = document.createElement('input');
                    startInput.type = 'hidden';
                    startInput.name = 'start_date';
                    startInput.value = document.getElementById('start_date').value;
                    
                    const endInput = document.createElement('input');
                    endInput.type = 'hidden';
                    endInput.name = 'end_date';
                    endInput.value = document.getElementById('end_date').value;
                    
                    form.appendChild(startInput);
                    form.appendChild(endInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>