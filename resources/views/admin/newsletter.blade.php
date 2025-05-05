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
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .th-deg {
                color: white;
                background-color: #34495E;
                padding: 15px;
                text-align: left;
                font-weight: bold;
                border-bottom: 2px solid #ddd;
            }

            tr {
                border-bottom: 2px solid #ddd;
            }

   
            .td-deg {
                padding: 12px 20px;
                color: #333;
                background-color: #f9f9f9;
                text-align: left;
                font-size: 16px;
                border-right: 1px solid #ddd;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            .table_des th, .table_des td {
                width: 50%;
            }

            .content {
                padding: 30px;
            }

            .footer {
                background-color: #f1f1f1;
                padding: 20px;
                text-align: center;
            }
        </style>
    </head>

    <body class="bg-light">
        @include('admin.navbar')
        <div class="main">
            @include('admin.sidebar')
            <div class="content">
                <h1 class="text-center mb-4" style="font-size: 30px; font-family: 'Lora', serif; font-weight: bold; color: #333;">User Data</h1>
                <table class="table_des">
                    <thead>
                        <tr>
                            <th class="th-deg">ID</th>
                            <th class="th-deg">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $user)
                        <tr>
                            <td class="td-deg">{{$user->id}}</td>
                            <td class="td-deg">{{$user->email}}</td>
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
