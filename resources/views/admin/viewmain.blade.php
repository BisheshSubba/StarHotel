<!doctype html>
<html lang="en">
<head>
    @include('admin.head')
    <style>
        .table_des {
            border-collapse: collapse;
            margin: 20px auto;
            width: 85%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        h2{
            font-size: 40px;
            font-family: 'Lora', serif;
            font-weight: bold; 
            color: #2A3D5A; 
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .th-deg {
            color: #fff;
            background-color: #1E3A8A;
            padding: 12px;
            text-align: left;
            font-size: 18px;
        }

        .td-deg {
            padding: 12px;
            text-align: left;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .td-deg img {
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .td-deg img:hover {
            transform: scale(1.1);
        }

        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

   
        tr:hover {
            background-color: #f1f1f1;
        }

        .content {
            padding: 20px;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .table_des {
                width: 100%;
                font-size: 14px;
            }

            .th-deg, .td-deg {
                padding: 8px;
            }
        }
    </style>
</head>
<body class="bg-light">
    @include('admin.navbar')

    <div class="main d-flex">
        @include('admin.sidebar')

        <div class="content flex-grow-1">
            <h2 >Manage Main Page Content</h2>

            <table class="table_des">
                <thead>
                    <tr>
                        <th class="th-deg">Title</th>
                        <th class="th-deg">Image</th>
                        <th class="th-deg">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td class="td-deg">{{$data->title}}</td>
                        <td class="td-deg">
                            <img width="60px" src="{{ asset('mainpage/' . $data->mainimage) }}" alt="Main Image">
                        </td>
                        <td class="td-deg">
                            <a class="btn btn-primary" href="{{route('admin.updatemain',$data->id)}}">Update</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
