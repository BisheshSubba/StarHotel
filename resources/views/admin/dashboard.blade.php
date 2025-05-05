<!doctype html>
<html lang="en">
<head>
   @include('admin.head')
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
      .dashboard-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         gap: 20px;
         margin-top: 20px;
         padding: 20px;
      }
      .dashboard-card {
         padding: 20px;
         border-radius: 10px;
         text-align: center;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
         transition: transform 0.3s ease, box-shadow 0.3s ease;
         position: relative;
         overflow: hidden;
         color: #fff;
      }
      .dashboard-card:nth-child(1) { background: linear-gradient(135deg, #ff7eb3, #ff758c); }
      .dashboard-card:nth-child(2) { background: linear-gradient(135deg, #6a11cb, #2575fc); }
      .dashboard-card:nth-child(3) { background: linear-gradient(135deg, #ff9a8b, #ff6a88); }
      .dashboard-card:nth-child(4) { background: linear-gradient(135deg, #43cea2, #185a9d); }
      
      .dashboard-card:hover {
         transform: translateY(-5px);
         box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      }
      .dashboard-card h3 {
         font-size: 1.2rem;
         margin-bottom: 10px;
      }
      .dashboard-card p {
         font-size: 1.5rem;
         font-weight: bold;
         margin: 0;
      }
      .available-rooms-container {
         margin-top: 20px;
         display: flex;
         justify-content: center;
         padding: 20px;
      }
      .room-table {
         width: 80%;
         background: #ffffff;
         border-radius: 10px;
         padding: 15px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }
      .room-table th {
         background: #6a0dad;
         color: #fff;
         padding: 10px;
      }
      .room-table th, .room-table td {
         padding: 10px;
         text-align: center;
         border-bottom: 1px solid #ddd;
      }
      .chart-container {
         width: 80%;
         margin: 40px auto;
         background: #fff;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }
      h1 {
         font-weight: bold;
         text-align: center;
         color: #4a0866;
         margin-top: 20px;
      }
   </style>
</head>
<body>
   @include('admin.navbar')
   <div class="main"> 
      @include('admin.sidebar')

      <div class="content">
         @if(session('newBookingMessage'))
         <div class="alert alert-info">
            {{ session('newBookingMessage') }}
         </div>
         @endif
         <h1>Welcome to Admin Dashboard</h1>
         
         <div class="dashboard-container">
            <div class="dashboard-card">
               <h3>Total Users</h3>
               <p>{{ $totalUsers }}</p>
            </div>

            <div class="dashboard-card">
               <h3>Most Booked Room</h3>
               <p>{{ $mostBookedRoom ? $mostBookedRoom->room_title . ' (' . $mostBookedRoom->room_type . ')' : 'No bookings yet' }}</p>
            </div>

            <div class="dashboard-card">
               <h3>Total Reviews</h3>
               <p>{{ $totalReviews }}</p>
            </div>

            <div class="dashboard-card">
               <h3>Bookings This Month</h3>
               <p>{{ $bookingsThisMonth }}</p>
            </div>
         </div>

         <div class="chart-container">
            <canvas id="bookingChart"></canvas>
         </div>

         <div class="chart-container">
            <canvas id="earningsChart"></canvas>
         </div>

         <div class="available-rooms-container">
         <table class="room-table">
            <thead>
               <tr>
                  <th>Room Type</th>
                  <th>Available Rooms</th>
               </tr>
            </thead>
            <tbody>
               @foreach($availableRoomsPerType as $room)
               <tr>
               <td>{{ $room->room_title}}</td>
               <td>
                  {{ $room->total_rooms - \App\Models\Booking::where('room_id', $room->id)->where('status', 'confirmed')->count() }}
               </td>
            </tr>
               @endforeach
            </tbody>
         </table>
      </div>

      </div>
   </div>

   @include('admin.footer')
   <div id="chartData"
     data-months='@json($months)'
     data-bookings='@json($bookingsPerMonth)'
     data-earnings='@json($earningsPerMonth)'>
   </div>

<script>
    var chartData = document.getElementById('chartData');
    var months = JSON.parse(chartData.dataset.months);
    var bookingsPerMonth = JSON.parse(chartData.dataset.bookings);
    var earningsPerMonth = JSON.parse(chartData.dataset.earnings);
</script>

<script>
    var ctx = document.getElementById('bookingChart').getContext('2d');
    var bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Bookings Per Month',
                data: bookingsPerMonth,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var earningsCtx = document.getElementById('earningsChart').getContext('2d');
    var earningsChart = new Chart(earningsCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Total Earnings Per Month',
                data: earningsPerMonth,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
