<!doctype html>
<html lang="en">
    <head>
        @include('admin.head')
        <style>
            .content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                margin-top: 40px;
                padding: 20px;
            }

            h1 {
              font-size: 40px;
            font-family: 'Lora', serif;
            font-weight: bold; 
            color: #2A3D5A; 
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            }

            form {
                display: flex;
                flex-direction: column;
                border-radius: 15px;
                padding: 20px;
                background-color: #5F4B8B;
                color: white;
                width: 50%;
                margin-bottom: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            form input[type="file"] {
                padding: 8px;
                border-radius: 8px;
                border: 1px solid #ddd;
            }

            form .btn {
                width: 100%;
                padding: 10px;
                border-radius: 8px;
                font-size: 16px;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
                margin-bottom: 40px;
            }

            .col-md-4 {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .col-md-4 img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .btn-danger {
                margin-top: 10px;
                background-color: #e74c3c;
                border: none;
                padding: 8px 15px;
                border-radius: 8px;
                color: white;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .btn-danger:hover {
                background-color: #c0392b;
            }

            .footer {
                margin-top: 30px;
                background-color: #f1f1f1;
                padding: 20px;
                text-align: center;
                font-size: 14px;
            }
        </style>
    </head>

    <body class="bg-light">
        @include('admin.navbar')
        <div class="main">
            @include('admin.sidebar')
            <div class="content">
                <h1>Gallery</h1>

                <div class="row">
                    @foreach($gallery as $image)
                        <div class="col-md-4">
                            <img src="{{asset('/gallery/'.$image->image)}}" alt="Gallery Image">
                            <a class="btn btn-danger" href="{{route('deleteimage', $image->id)}}">Delete</a>
                        </div>
                    @endforeach
                </div>

                <form action="{{route('uploadgallery')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="image">Upload Image:</label>
                        <input type="file" name="image" id="image" required>
                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" value="Add Image">
                    </div>
                </form>
            </div>
        </div>

        @include('admin.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
