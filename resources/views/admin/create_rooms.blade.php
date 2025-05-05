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
                <h1>Create Rooms:</h1>
                <div class="form-container">
                    <form action="{{ route('add_room') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_des">
                            <label for="title">Room Title:</label>
                            <input type="text" name="title" required>
                        </div>
                        <div class="div_des">
                            <label for="description">Room Description:</label>
                            <textarea cols="60" rows="4" name="description"></textarea>
                        </div>
                        <div class="div_des">
                            <label for="image">Upload Image:</label>
                            <input type="file" name="image">
                        </div>
                        <div class="div_des">
                            <label for="type">Room Type:</label>
                            <select name="type">
                                <option selected value="Standard">Standard</option>
                                <option value="Delux">Delux</option>
                                <option value="SuperDelux">Super Delux</option>
                            </select>
                        <div class="div_des">
                            <label for="room_view">Room View:</label>
                            <select name="room_view" id="room_view">
                                <option value="Garden View">Garden View</option>
                                <option value="City View">City View</option>
                                <option value="Mountain View">Mountain View</option>
                            </select>
                        </div>
                        </div>
                        <div class="div_des">
                            <label for="wifi">WiFi Available:</label>
                            <input type="checkbox" name="wifi" id="wifi" value="1">
                        </div>
                        <div class="div_des">
                            <label for="breakfast">Breakfast Included:</label>
                            <input type="checkbox" name="breakfast" id="breakfast" value="1">
                        </div>
                        <div class="div_des">
                            <label for="bed_type">Bed Type:</label>
                            <select name="bed_type" id="bed_type">
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                            </select>
                        </div>
                        <div class="div_des">
                            <label for="price">Room Price:</label>
                            <input type="number" name="price" required>
                        </div>
                        <div class="div_des">
                            <label for="total_rooms">Total Rooms Available:</label>
                            <input type="number" name="total_rooms" min="1" required>
                        </div>
                        <div class="div_des">
                            <label for="total_occupancy">Total Occupancy:</label>
                            <input type="number" name="total_occupancy" min="1" required>
                        </div>
                        <div class="div_des">
                            <input class="btn-primary" type="submit" value="Add Room">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('admin.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
