<!doctype html>
<html lang="en">
    <head>
        @include('admin.head')
        <style>
            h1 {
                padding: 30px;
                text-align: center;
                color: #fff;
                font-size: 36px;
                font-weight: bold;
                text-transform: uppercase;
                background-color: #2C3E50;
                border-radius: 8px;
            }

            form {
                display: flex;
                flex-direction: column;
                padding: 30px;
                color: whitesmoke;
                background-color: #34495E;
                border-radius: 8px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
                margin-top: 20px;
            }

            label {
                display: inline-block;
                width: 200px;
                font-size: 18px;
                margin-bottom: 10px;
                color: #BDC3C7;
            }

            .div_des {
                padding-top: 20px;
                margin-bottom: 15px;
            }

            input[type="text"], input[type="number"], textarea, select {
                width: 100%;
                padding: 12px;
                margin-top: 5px;
                border-radius: 8px;
                border: 1px solid #7F8C8D;
                background-color: #ecf0f1;
                font-size: 16px;
                color: #2C3E50;
            }

            input[type="checkbox"] {
                margin-top: 10px;
            }

            textarea {
                resize: vertical;
            }

            input[type="file"] {
                padding: 5px;
            }

            .div_des img {
                margin-top: 10px;
                border-radius: 5px;
            }

            select {
                width: 100%;
                padding: 12px;
                background-color: #ecf0f1;
                border: 1px solid #7F8C8D;
                border-radius: 8px;
                font-size: 16px;
            }

            input[type="submit"] {
                background-color: #F39C12;
                color: white;
                border: none;
                padding: 12px 20px;
                font-size: 18px;
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

        </style>
    </head>
    <body class="bg-light">
        @include('admin.navbar')
        <div class="main">
            @include('admin.sidebar')
            <div class="content">
                <h1>Update Room:</h1>
                
                <form action="{{ route('admin.editroom', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_des">
                        <label for="title">Room Title:</label>
                        <input type="text" name="title" value="{{ $data->room_title }}">
                    </div>

                    <div class="div_des">
                        <label for="description">Room Description:</label>
                        <textarea cols="60" rows="6" name="description">{{ $data->description }}</textarea>
                    </div>

                    <div class="div_des">
                        <label for="current_image">Current Image:</label>
                        <img width="150px" src="{{ asset('room/' . $data->image) }}">
                    </div>

                    <div class="div_des">
                        <label for="image">Upload Image:</label>
                        <input type="file" name="image">
                    </div>

                    <div class="div_des">
                        <label for="type">Room Type:</label>
                        <select name="type">
                            <option value="{{ $data->room_type }}">{{ ucfirst($data->room_type) }}</option>
                            <option value="standard">Standard</option>
                            <option value="delux">Delux</option>
                            <option value="superdelux">Super Delux</option>
                        </select>
                    </div>
                    <div class="div_des">
                        <label for="room_view">Room View:</label>
                        <select name="room_view" id="room_view">
                            <option value="Garden View" {{ $data->room_view == 'Garden View' ? 'selected' : '' }}>Garden View</option>
                            <option value="City View" {{ $data->room_view == 'City View' ? 'selected' : '' }}>City View</option>
                            <option value="Mountain View" {{ $data->room_view == 'Mountain View' ? 'selected' : '' }}>Mountain View</option>
                        </select>
                    </div>
                    <div class="div_des">
                        <label for="wifi">WiFi Available:</label>
                        <input type="checkbox" name="wifi" value="1" {{ isset($data) && $data->wifi ? 'checked' : '' }}> Yes
                    </div>
                    <div class="div_des">
                        <label for="breakfast">Breakfast Included:</label>
                        <input type="checkbox" name="breakfast" value="1" {{ $data->breakfast ? 'checked' : '' }}>
                    </div>
                    <div class="div_des">
                        <label for="bed_type">Bed Type:</label>
                        <select name="bed_type" id="bed_type">
                            <option value="single" {{ isset($data) && $data->bed_type == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="double" {{ isset($data) && $data->bed_type == 'double' ? 'selected' : '' }}>Double</option>
                        </select>
                    </div>
                    <div class="div_des">
                        <label for="price">Room Price:</label>
                        <input type="number" name="price" value="{{ $data->price }}">
                    </div>

                    <div class="div_des">
                        <label for="total_rooms">Total Rooms Available:</label>
                        <input type="number" name="total_rooms" min="1" value="{{ $data->total_rooms }}">
                    </div>
                    <div class="div_des">
                        <label for="total_occupancy">Total Occupancy:</label>
                        <input type="number" name="total_occupancy" min="1" value="{{ $data->total_occupancy }}" required>
                    </div>
                    <div class="div_des">
                        <input class="btn btn-warning" type="submit" value="Update Room">
                    </div>
                </form>
            </div>
        </div>
        @include('admin.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
