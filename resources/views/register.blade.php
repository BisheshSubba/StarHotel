<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-image: url('../images/register.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-container {
    background: rgba(255, 255, 255, 0.5); 
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 8px 32px 0 rgba(51, 51, 51, 0.4); 
    backdrop-filter: blur(10px); 
    width: 100%;
    max-width: 400px;
    text-align: center;
    border: 0.5px solid rgba(88, 86, 86, 0.4); 
}

.form-container h4 {
    margin-bottom: 30px;
    font-size: 28px;
    color: black;
}

.form-container input {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3); 
    border-radius: 5px;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.2); 
    color: black;
}

.form-container input:focus {
    border-color: rgba(255, 255, 255, 0.5); 
    outline: none;
}

.form-container button {
    width: 100%;
    padding: 15px;
    background-color: rgba(231, 158, 98, 0.8); 
    border: none;
    border-radius: 5px;
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

.form-container button:hover {
    background-color: rgba(230, 74, 25, 0.8); 
}

.form-container a {
    display: block;
    margin-top: 20px;
    color: black;
    text-decoration: none;
    font-size: 14px;
}

.form-container a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="form-container">
        <h4>Sign Up</h4>
        <form action="{{ route('account.processRegister') }}" method="post">
            @csrf    
            <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="number" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
            @error('phone')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="password" name="password" id="password" placeholder="Password">
            @error('password')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit">Sign</button>
        </form>
        <a href="{{ route('account.login') }}">Already have an account? Log in here</a>
    </div>
</body>
</html>
