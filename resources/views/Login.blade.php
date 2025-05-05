<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Star Hotel Login</title>
    <style>
     body {
    margin: 0;
    font-family: Arial, sans-serif;
    height: 100vh;
    background-image: url('../images/signup.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: rgba(255, 255, 255, 0.5); 
    border-radius: 10px;
    padding: 20px 40px;
    box-shadow: 0 8px 32px 0 rgba(51, 51, 51, 0.4); 
    backdrop-filter: blur(10px); 
    width: 100%;
    max-width: 400px;
    border: 0.5px solid rgba(88, 86, 86, 0.4); 
}

h4 {
    margin: 0 0 20px 0;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    color: black;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 14px;
    color: black;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid rgba(255, 255, 255, 0.3); 
    border-radius: 5px;
    box-sizing: border-box;
    margin-top: 5px;
    background: rgba(255, 255, 255, 0.2); 
    color: black;
}

input[type="text"]::placeholder,
input[type="password"]::placeholder {
    color: rgba(255, 255, 255, 0.7); 
}

button {
    width: 100%;
    padding: 12px;
    background-color: rgba(228, 142, 71, 0.8); 
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: rgba(255, 59, 0, 0.8); 
}

.link-secondary {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #fff;
    text-decoration: none;
}

.link-secondary:hover {
    text-decoration: underline;
}

    </style>
</head>

<body>
    <div class="container">
        <h4>Login Here</h4>


        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif

        <form action="{{route('account.authenticate')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                <input type="text" value="{{ old('email')}}" name="email" id="email"
                    class="@error('email') is-invalid @enderror">
                @error('email')
                <p class="invalid-feedback"> {{$message}} </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
                @error('password')
                <p class="invalid-feedback"> {{$message}} </p>
                @enderror
            </div>

            <button type="submit">Log in now</button>
        </form>


        <a href="{{route('account.register')}}" class="link-secondary">Create new account</a>
    </div>
</body>

</html>
