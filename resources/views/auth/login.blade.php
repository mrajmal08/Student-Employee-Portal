<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        .left-side {
            background-image: url('/assets/img/image.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            height: 100vh;
            background-color: white;
        }

        .login-form {
            max-width: 400px;
            width: 100%;
            margin: auto;
            position: relative;
            top: -20%;
        }

        .social-icons a {
            margin: 0 0.5rem;
            color: inherit;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        .text-links {
            margin-top: 20px;
        }

        .text-links a {
            margin: 0 10px;
            color: #595b5a;
            text-decoration: none;
        }

        .text-links a:hover {
            color: #05a853;
        }

        .input {
            border: 0;
            border-radius: 0;
            background: none;
            padding-left: 3px;
            padding-right: 3px;
            border-bottom: 1px solid #acacac;
        }

        .text-color {
            color: #595b5a;
        }

        .text-color:hover {
            color: #05a853;
        }
        .logo-center{
            position: relative;
            top: -4%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 left-side">
                <div class="text-center logo-center">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" class="" width="260">

                    <div class="my-5">
                        <h1>Welcome to Maven Mind</h1>

                    </div>
                </div>
            </div>

            <div class="col-md-3 right-side">
                <div class="login-form">
                    <h4 class="text-left mb-5">
                        <i class="bi bi-lock-fill" style="color: #00b5e9;"></i>
                        Login
                    </h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label d-none">Email</label>
                            <input class="form-control input  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="email" id="email" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label d-none">Password</label>
                            <input class="form-control input @error('password') is-invalid @enderror" type="password" name="password" autocomplete="new-password"
                                placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-grid mb-5 col-4">
                            <button type="submit" class="btn btn-sm" style="background-color: #00b5e9; color: #ffffff">Sign In</button>
                        </div>
                        <div class="text-left col-6">
                            <!-- <a href="#" class="text-decoration-none">Forgot Password?</a>  {{ route('password.request') }} -->
                            @if (Route::has('password.request'))
                            <a class="text-color" href="#">
                                {{ __('Forgot Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>
                    <div class="social-icons mt-5">
                        <a href="#"><i class="bi bi-facebook" style="color: #00b5e9;"></i></a>
                        <a href="#"><i class="bi bi-twitter" style="color: #00b5e9;"></i></a>
                        <a href="#"><i class="bi bi-instagram" style="color: #00b5e9;"></i></a>
                        <a href="#"><i class="bi bi-linkedin" style="color: #00b5e9;"></i></a>
                    </div>
                    <div class="text-links">
                        <a href="#">Contact Us</a>
                        <a href="#">About Us</a>
                        <a href="#">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
