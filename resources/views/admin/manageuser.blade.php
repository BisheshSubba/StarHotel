<!doctype html>
<html lang="en">
<head>
   @include('admin.head')
   <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 40px;
            font-family: 'Lora', serif;
            font-weight: bolder;
            color: #2A3D5A; 
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table_des {
            border-collapse: collapse;
            margin: 20px auto;
            width: 90%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .th-deg {
            color: #fff;
            background-color: #1E3A8A; 
            padding: 15px;
            text-align: left;
            font-size: 16px;
            font-weight: bold;
        }

        .td-deg {
            padding: 12px;
            color: #333;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            font-size: 14px;
            text-align: left;
        }

        .td-deg:hover {
            background-color: #f1f1f1; 
        }

        tr {
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .table_des {
                width: 100%;
            }

            h1 {
                font-size: 30px;
            }

            .th-deg, .td-deg {
                font-size: 14px;
                padding: 10px;
            }
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #1E3A8A;
            color: #fff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #334E8C; 
        }

        .btn-danger {
            background-color: red;
        }

        .btn-danger:hover {
            background-color: darkred;
        }

        .alert {
            width: 90%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

    </style>
</head>
<body class="bg-light">
   @include('admin.navbar')

   <div class="main d-flex">
      @include('admin.sidebar')

      <div class="content flex-grow-1">
         <h1>Users</h1>

         {{-- Success or Error Message --}}
         @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
         @endif

         @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
         @endif

         <table class="table_des">
            <thead>
                <tr>
                    <th class="th-deg">Name</th>
                    <th class="th-deg">Email</th>
                    <th class="th-deg">Phone</th>
                    <th class="th-deg">Action</th> <!-- Added Action column -->
                </tr>
            </thead>
            <tbody>
                @foreach($data as $user)
                <tr>
                    <td class="td-deg">{{$user->name}}</td>
                    <td class="td-deg">{{$user->email}}</td>
                    <td class="td-deg">{{$user->phone}}</td>
                    <td class="td-deg">
                        <a href="{{ url('/admin/delete_user', $user->id) }}" 
                           onclick="return confirm('Are you sure you want to delete this user?')" 
                           class="btn btn-danger">
                           Delete
                        </a>
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
