<!doctype html>
<html lang="en">
@include ('partials.head')
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    color: #333;
  }
</style>
<body>
    @include ('partials.header')

    <div class="profile-container">
        <div class="profile-card">
            <h2 class="profile-title">User Profile</h2>
            <div class="profile-info">
                <p><strong>Name:</strong> {{Auth::user()->name}}</p>
                <p><strong>Email:</strong> {{Auth::user()->email}}</p>
                <p><strong>Role:</strong> {{Auth::user()->role}}</p>
                <p><strong>Contact:</strong> {{Auth::user()->phone}}</p>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
