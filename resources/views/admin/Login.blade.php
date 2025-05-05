<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 11 Multi Auth:: Admin</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <style>
            body {
                background: linear-gradient(135deg, #667eea, #764ba2);
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .card {
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                border: none;
                background: #ffffff;
            }
            .card-body {
                padding: 2rem;
            }
            h4 {
                font-weight: bold;
                color: #333;
            }
            .btn-primary {
                background-color: #4a90e2;
                border: none;
                transition: all 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #357ae8;
            }
            .form-control {
                border-radius: 10px;
                border: 1px solid #ddd;
            }
            .alert {
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @if(Session::has('success'))
                                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                                        @endif
                                        @if(Session::has('error'))
                                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                        @endif
                                        <div class="mb-4 text-center">
                                            <h4>Admin Login</h4>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.authenticate') }}" method="post">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com">
                                                <label for="email">Email</label>
                                                @error('email')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                                <label for="password">Password</label>
                                                @error('password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary py-3" type="submit">Log in now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
