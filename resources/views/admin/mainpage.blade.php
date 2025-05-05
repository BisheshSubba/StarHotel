<!doctype html>
<html lang="en">
    <head>
   @include('admin.head')
   <style>
        h1{
            padding: 30px;
            text-align: center;
            color: white;
        }
        form{
            display: flex;
            flex-direction: column;
            padding-left: 30px;
            color: whitesmoke;
        }
        label{
            display: inline-block;
            width: 200px;

        }
        .div_des{
            padding-top: 30px;
        }

   </style>
   </head>
   <body class="bg-light">
       @include('admin.navbar')
        <div class="main">
       @include('admin.sidebar')
            <div class="content">
            <h1>Edit Mainpage:</h1>
            
            <form action="{{route('add_main')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="div_des">
                    <label for="">Heading Title:</label>
                    <input type="text" name="title">
                </div>
                <div class="div_des">
                    <label for="">Upload Image:</label>
                    <input type="file" name="image">
                </div>
                <div class="div_des">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>
            </form>
        </div>
        </div>
        @include('admin.footer')
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>