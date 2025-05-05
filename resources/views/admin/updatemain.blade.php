<!doctype html>
<html lang="en">
<head>
   @include('admin.head')
   <style>
        body {
            background-color: #fff;
            font-family: Arial, sans-serif;
        }

        h1 {
            padding: 30px;
            text-align: center;
            color: #1E3A8A; 
            font-size: 36px;
            text-transform: uppercase;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            padding: 30px;
            background-color: #f8f9fa; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            display: inline-block;
            width: 200px;
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"], input[type="file"] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="file"]:focus {
            border-color: #1E3A8A; 
            outline: none;
        }

        .div_des {
            margin-bottom: 20px;
        }

        .div_des img {
            max-width: 150px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            background-color: #1E3A8A; 
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 200px;
            margin: auto;
        }

        .btn:hover {
            background-color: #334E8C; 
        }

        .content {
            padding: 30px 0;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            form {
                width: 90%;
                padding: 20px;
            }

            label {
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }
   </style>
</head>
<body class="bg-light">
   @include('admin.navbar')

   <div class="main d-flex">
      @include('admin.sidebar')

      <div class="content flex-grow-1">
         <h1>Update Main Page</h1>
         <form action="{{route('admin.editimage',$page->id)}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="div_des">
                <label for="">Heading Title:</label>
                <input type="text" name="title" value="{{$page->title}}">
            </div>
            <div class="div_des">
                <label for="">Current Image:</label>
                <img src="{{ asset('mainpage/' . $page->mainimage) }}" alt="Current Image">
            </div>
            <div class="div_des">
                <label for="">Upload Image:</label>
                <input type="file" name="image">
            </div>
            <div class="div_des">
                <input class="btn" type="submit" value="Update">
            </div>
         </form>
      </div>
   </div>

   @include('admin.footer')

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
