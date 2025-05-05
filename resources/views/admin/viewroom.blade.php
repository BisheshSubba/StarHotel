<!doctype html>
<html lang="en">
<head>
    @include('admin.head')
    <style>
        .table_des {
            border: 2px solid #ddd;
            margin: auto;
            width: 80%;
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
        .desc {
            display: block;
            max-width: 200px; 
            max-height: 3em; 
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4em; 
            white-space: normal; 
        }

        .td-deg img {
            border-radius: 8px;
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 5px 15px;
            font-size: 14px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: #fff;
            text-decoration: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-primary {
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .content {
            padding: 20px;
        }

        @media (max-width: 768px) {
            .table_des {
                width: 100%;
                font-size: 12px;
            }

            .btn {
                padding: 3px 10px;
                font-size: 12px;
            }

            .td-deg {
                padding: 10px;
            }
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
                        <th class="th-deg">Room Title</th>
                        <th class="th-deg">Description</th>
                        <th class="th-deg">Room Type</th>
                        <th class="th-deg">Price</th>
                        <th class="th-deg">WiFi</th>
                        <th class="th-deg">Bed Type</th>
                        <th class="th-deg">Total Rooms</th>
                        <th class="th-deg">Room View</th>
                        <th class="th-deg">Total Occupancy</th>
                        <th class="th-deg">Breakfast</th>
                        <th class="th-deg">Image</th>
                        <th class="th-deg">Delete</th>
                        <th class="th-deg">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td class="td-deg">{{ $data->room_title }}</td>
                        <td class="td-deg">
                            <p class="desc">{!! $data->description !!}</p>
                        </td>
                        <td class="td-deg">{{ $data->room_type }}</td>
                        <td class="td-deg">Rs.{{ $data->price }}</td>
                        <td class="td-deg">{{ $data->wifi ? 'Yes' : 'No' }}</td>
                        <td class="td-deg">{{ $data->bed_type }}</td>
                        <td class="td-deg">{{ $data->total_rooms }}</td>
                        <td class="td-deg">{{ $data->room_view }}</td> 
                        <td class="td-deg">{{ $data->total_occupancy }}</td> 
                        <td class="td-deg">{{ $data->breakfast ? 'Yes' : 'No' }}</td> 
                        <td class="td-deg">
                            <img src="{{ asset('room/' . $data->image) }}" alt="Room Image">
                        </td>
                        <td class="td-deg">
                            <button class="btn btn-danger delete-room" data-id="{{ $data->id }}">Delete</button>
                        </td>
                        <td class="td-deg">
                            <a class="btn btn-primary" href="{{ route('admin.updateroom', $data->id) }}">Update</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".delete-room").forEach(button => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    let roomId = this.getAttribute("data-id");
                    let deleteUrl = "{{ route('admin.deleteroom', ':id') }}".replace(':id', roomId);

                    Swal.fire({
                        title: "Are you sure?",
                        text: "This action cannot be undone!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = deleteUrl;
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
