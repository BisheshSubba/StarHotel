<!doctype html>
<html lang="en">
<head>
    @include('partials.head')
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2a4365;
            --secondary-color: #d4af37;
            --accent-color: #5F9EA0;
            --light-bg: #f8f4e9;
            --dark-text: #2c3e50;
            --light-text: #7f8c8d;
            --success-color: #27ae60;
            --error-color: #e74c3c;
            --border-radius: 8px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        .main {
            padding: 2rem 0;
            min-height: 70vh;
        }

        .content {
            padding: 0 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        h1:after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }

        .table-container {
            overflow-x: auto;
            margin: 2rem 0;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .booking-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .booking-table td {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }

        .booking-table tr:last-child td {
            border-bottom: none;
        }

        .booking-table tr:hover {
            background-color: rgba(212, 175, 55, 0.1);
        }

        .booking-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1.2rem;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn i {
            margin-right: 6px;
        }

        .btn:hover {
            background-color: #c9a227;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            color: var(--primary-color);
        }

        .btn:disabled,
        .btn[disabled] {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-approved {
            background-color: var(--success-color) !important;
            color: white !important;
        }

        .btn-unavailable {
            background-color: #bdc3c7 !important;
            color: #7f8c8d !important;
        }

        .alert {
            padding: 1rem;
            background-color: var(--success-color);
            color: white;
            margin: 1rem auto;
            border-radius: var(--border-radius);
            max-width: 800px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--box-shadow);
        }

        .alert i {
            margin-right: 0.75rem;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0 0.5rem;
        }

        @media (max-width: 768px) {
            .booking-table {
                display: block;
            }
            
            .booking-table thead {
                display: none;
            }
            
            .booking-table tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: var(--border-radius);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }
            
            .booking-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: right;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .booking-table td:before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 1rem;
                color: var(--primary-color);
            }
            
            .booking-table td:last-child {
                border-bottom: none;
            }
            
            .btn {
                width: 100%;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.header')

    @if(session('alert'))
        <div class="alert">
            <div>
                <i class="fas fa-check-circle"></i>
                {{ session('alert') }}
            </div>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif

    <div class="main">
        <div class="content">
            <h1>Your Bookings</h1>
            
            <div class="table-container">
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Arrival Date</th>
                            <th>Departure Date</th>
                            <th>Room Title</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td data-label="Room ID">{{$data->room_id}}</td>
                            <td data-label="Arrival Date">{{$data->start_date}}</td>
                            <td data-label="Departure Date">{{$data->end_date}}</td>
                            <td data-label="Room Title">{{$data->room->room_title}}</td>
                            <td data-label="Price">Rs {{$data->room->price}}</td>
                            <td data-label="Total">Rs {{$data->total_amount}}</td>
                            <td data-label="Image">
                                <img src="{{ asset('room/' . $data->room->image) }}" alt="{{$data->room->room_title}}">
                            </td>
                            <td data-label="Action">
                                @if($data->end_date >= $currentDate && $data->status != 'confirmed')
                                    <a onclick="return confirm('Are you sure you want to cancel this booking?')" 
                                       class="btn" 
                                       href="{{route('cancel.booking', $data->id)}}">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                @elseif($data->status == 'confirmed')
                                    <button class="btn btn-approved" disabled>
                                        <i class="fas fa-check"></i> Approved
                                    </button>
                                @else
                                    <button class="btn btn-unavailable" disabled>
                                        <i class="fas fa-clock"></i> Expired
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);
    </script>
</body>
</html>