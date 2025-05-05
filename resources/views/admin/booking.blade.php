<!doctype html>
<html lang="en">
    <head>
        @include('admin.head')
        <style>
            .table_des {
                border: 2px solid #ddd;
                width: 100%;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }
            .th-deg {
                color: #fff;
                background-color: #34495E;
                text-align: center;
                padding: 12px;
                font-size: 16px;
                font-weight: bold;
            }
            tr {
                border: 1px solid #ddd;
            }
            .td-deg {
                padding: 15px;
                text-align: center;
                min-width: 120px;
                color: #333;
                background-color: #f9f9f9;
                font-size: 14px;
            }
            .disabled-button {
                pointer-events: none;
                opacity: 0.6;
            }
            .td-deg img {
                border-radius: 8px;
                max-width: 60px;
                max-height: 60px;
                object-fit: cover;
            }
            .approved { color: rgb(27, 169, 225); }
            .rejected { color: red; }
            .waiting { color: rgb(177, 177, 24); }
            .expired { color: gray; }
            tr:hover { background-color: #f1f1f1; }
            .btn {
                padding: 5px 15px;
                font-size: 14px;
                border-radius: 5px;
                text-align: center;
            }
            .btn-danger { background-color: #e74c3c; color: #fff; text-decoration: none; }
            .btn-danger:hover { background-color: #c0392b; }
            .btn-success { background-color: #2ecc71; color: #fff; text-decoration: none; }
            .btn-success:hover { background-color: #27ae60; }
            .btn-warning { background-color: #f39c12; color: #fff; text-decoration: none; }
            .btn-warning:hover { background-color: #e67e22; }
            .btn-secondary { background-color: #95a5a6; color: #fff; text-decoration: none; }
            .btn-secondary:hover { background-color: #7f8c8d; }
            .content { padding: 20px; }

            .pagination {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }
            .pagination a, .pagination span {
                padding: 8px 15px;
                margin: 0 5px;
                background-color: #f9f9f9;
                color: #333;
                border-radius: 5px;
                text-decoration: none;
            }
            .pagination .active {
                background-color: #3498db;
                color: white;
            }
            .pagination a:hover {
                background-color: #ddd;
            }
        </style>
    </head>
    <body class="bg-light">
        @include('admin.navbar')
        <div class="main">
            @include('admin.sidebar')
            <div class="content">
                <table class="table_des">
                    <thead>
                        <tr>
                            <th class="th-deg">Room_id</th>
                            <th class="th-deg">Name</th>
                            <th class="th-deg">Email</th>
                            <th class="th-deg">Phone_no</th>
                            <th class="th-deg">Status</th>
                            <th class="th-deg">Total</th>
                            <th class="th-deg">Occupancy</th>
                            <th class="th-deg">Arrival_Date</th>
                            <th class="th-deg">Departure_Date</th>
                            <th class="th-deg">Room_Title</th>
                            <th class="th-deg">Price</th>
                            <th class="th-deg">Image</th>
                            <th class="th-deg">Delete</th>
                            <th class="th-deg">Status Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td class="td-deg">{{$data->room_id}}</td>
                            <td class="td-deg">{{$data->name}}</td>
                            <td class="td-deg">{{$data->email}}</td>
                            <td class="td-deg">{{$data->phone}}</td>
                            <td class="td-deg">
                                @if($data->status =='confirmed')
                                    <span class="approved">Approved</span>
                                @elseif($data->status =='canceled')
                                    <span class="rejected">Rejected</span>
                                @elseif($data->status =='waiting')
                                    <span class="waiting">Waiting</span>
                                @elseif($data->status =='expired')
                                    <span class="expired">Expired</span>
                                @endif  
                            </td>
                            <td class="td-deg">{{$data->total_amount}}</td>
                            <td class="td-deg">{{$data->total_occupancy}}</td>
                            <td class="td-deg">{{$data->start_date}}</td>
                            <td class="td-deg">{{$data->end_date}}</td>
                            <td class="td-deg">{{$data->room->room_title}}</td>
                            <td class="td-deg">{{$data->room->price}}</td>
                            <td class="td-deg">
                                <img src="{{ asset('room/' . $data->room->image) }}" alt="Room Image">
                            </td>
                            <td class="td-deg">
                                <a class="btn btn-danger {{ $data->status == 'expired' ? 'disabled-button' : '' }}" 
                                   href="{{ $data->status == 'expired' ? '#' : route('delete.booking', $data->id) }}">
                                    Delete
                                </a>
                            </td>

                            <td class="td-deg">
                                @if($data->status == 'waiting')
                                    <span style="padding-bottom: 10px;">
                                        <a class="btn btn-success" href="{{route('approve_book', $data->id)}}">Approve</a>
                                    </span>
                                    <a class="btn btn-warning" href="{{route('reject_book', $data->id)}}">Reject</a>
                                @else
                                    <button class="btn btn-secondary" disabled>Updated</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    @if ($page > 1)
                        <a href="{{ url()->current() }}?page={{ $page - 1 }}" class="btn">Previous</a>
                    @endif

                    @for ($i = 1; $i <= $totalPages; $i++)
                        <a href="{{ url()->current() }}?page={{ $i }}" 
                           class="btn {{ $page == $i ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    @if ($page < $totalPages)
                        <a href="{{ url()->current() }}?page={{ $page + 1 }}" class="btn">Next</a>
                    @endif
                </div>

            </div>
        </div>
        @include('admin.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
