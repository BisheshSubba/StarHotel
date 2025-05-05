<!doctype html>
<html lang="en">
    <head>
        @include('admin.head')
        <style>
          h1 {
                padding: 20px;
                text-align: center;
                color: #fff;
                font-size: 30px;
                font-weight: bold;
                text-transform: uppercase;
                background-color: #2C3E50;
                border-radius: 8px;
                margin-bottom: 20px;
            }

            form {
                display: flex;
                flex-direction: column;
                padding: 20px;
                color: whitesmoke;
                background-color: #34495E;
                border-radius: 8px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
                margin: 0 auto;
                max-width: 700px;
                margin-top: 10px;
            }

            label {
                display: inline-block;
                width: 200px;
                font-size: 16px;
                margin-bottom: 8px;
                color: #BDC3C7;
            }

            .div_des {
                padding-top: 12px;
                margin-bottom: 12px;
            }

            input[type="text"], input[type="number"], textarea, select {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                border-radius: 8px;
                border: 1px solid #7F8C8D;
                background-color: #ecf0f1;
                font-size: 14px;
                color: #2C3E50;
            }

            textarea {
                resize: vertical;
                height: 100px; 
            }

            input[type="file"] {
                padding: 5px;
            }

            select {
                width: 100%;
                padding: 10px;
                background-color: #ecf0f1;
                border: 1px solid #7F8C8D;
                border-radius: 8px;
                font-size: 14px;
            }

            input[type="submit"] {
                background-color: #F39C12;
                color: white;
                border: none;
                padding: 10px 18px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }

            input[type="submit"]:hover {
                background-color: #E67E22;
            }

            .content {
                margin-left: 250px;
                padding: 20px;
                flex-grow: 1;
                background-color: #F4F6F7;
            }

            .form-container {
                display: flex;
                justify-content: center;
            }

        </style>
    </head>
    <body class="bg-light">
        @include('admin.navbar')

        <div class="main">
            @include('admin.sidebar')

            <div class="content">
                <h1>Add New Service</h1>

                <!-- Display any success message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-container">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_des">
                            <label for="title">Service Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="div_des">
                            <label for="photo">Service Photo:</label>
                            <input type="file" name="photo" id="photo" class="form-control" required>
                        </div>
                        <div class="div_des">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Service</button>
                    </form>
                </div>
            </div>
        </div>

        @include('admin.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
