<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovada DME - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        #wrapper.home {
    background: #fff;
    padding: 0;
}
#wrapper {
    width: 100%;
    float: right;
    position: relative;
    padding: 9.063rem 0 0;
    transition: all 0.25s linear;
}
.h-100 {
    height: 100% !important;
}
#wrapper.home #main {
    padding: 0;
}
@media (min-width: 992px) {
    .col-lg-9 {
        flex: 0 0 auto;
        width: 75%;
    }
}

.carousel {
    background-repeat: no-repeat;
    background-position: top right;
    background-size: cover;
}
.carousel {
    background-image: url(https://nasir.ovadadme.org/back-ground-loader.bf630a3be88203ff.webp);
    position: relative;
}

.carousel .carousel-caption {
    color: #292b2a;
    bottom: auto;
    top: 50%;
    left: 50%;
    width: 100%;
    padding: 0 50px;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
}

.carousel-caption {
    position: absolute;
    right: 15%;
    text-align: center;
}

#wrapper.home .logo {
    display: block;
    position: static;
    margin: 15px auto 100px;
    width: 189px;
    height: auto;
    transform: translateY(0);
    -webkit-transform: translateY(0);
}

.logo a .logo  img .logo  picture  {
    display: block;
}
a:not([href]):not([class]), a:not([href]):not([class]):hover {
    color: inherit;
    text-decoration: none;
}

.right-panel {
    top: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    position: fixed;
    overflow: auto;
    padding: 73px 32px 0 35px;
    box-shadow: 2px 5px 5px rgba(0, 0, 0, 0.25);
}
.pull-right {
    float: right;
}

.right-panel h1 {
    color: #000;
    margin: 0 0 80px;
    text-transform: capitalize;
    font: 500 1.375rem / 24px "Poppins", Arial, Helvetica, sans-serif;
}
.right-panel  .form-group  {
    margin: 0 0 40px;
}
.right-panel  label  {
    color: #595b5a;
    font: 300 0.875rem / 17px "Poppins", Arial, Helvetica, sans-serif;
}
.bottom-section {
    background: #fff;
    padding: 35px 0 10px;
    top: auto;
}
.social-networks {
    overflow: hidden;
    margin: 0 0 25px -16px;
}
.list-inline {
    padding-left: 0;
    list-style: none;
}
.f-nav {
    text-align: left;
}
.list-inline-item:not(:last-child) {
    margin-right: .5rem;
}
.social-networks li {
    float: left;
    padding: 0 0 10px 16px;
}
.f-nav ul {
    margin: 0 0 0 -40px;
    display: inline-block;
    vertical-align: top;
    font: 300 1.125rem / 20px "Poppins", Arial, Helvetica, sans-serif;
}
.list-inline-item:not(:last-child) {
    margin-right: .5rem;
}
.f-nav a {
    color: #2e3031;
}
a:visited, span.MsoHyperlinkFollowed, a:link, span.MsoHyperlink {
    text-decoration: none !important;
}
.social-networks a {
    display: block;
    width: 44px;
    height: 44px;
    border: 1px solid #4c4e4f;
    position: relative;
}
.list-inline {
    padding-left: 0;
    list-style: none;
}
.social-networks a {
    display: block;
    width: 44px;
    height: 44px;
    border: 1px solid #4c4e4f;
    position: relative;
}
.social-networks a span {
    color: #00b5e9;
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 1.25rem;
    -webkit-transform: translate(-50%, -50%);
}
    </style>
</head>
<body>


<!--Login Page Starts-->
<div id="wrapper" class="h-100 home" *ngIf="showLogin" style="overflow: hidden;">

  <div class="container-fluid h-100">
    <div class="row h-100">

      <!-- main informative part of the site -->
      <main id="main" class="col-lg-9 col-md-8 h-100">

        <!-- carousel -->
        <div class="carousel h-100">
          <div class="carousel-caption">
            <strong class="logo">
              <a>
                <picture class="img-hold">
                  <source srcset="https://nasir.ovadadme.org/assets/images/logo.webp" type="image/webp">
                </picture>
              </a>
            </strong>
            <h1>Welcome to Ovada DME</h1>
          </div>
        </div>
      </main>

      <!-- right panel -->
      <aside class="right-panel login-right col-lg-3 col-md-4 pull-right">
        <h1><span class="icon-login"></span>Login</h1>
        <form [formGroup]="loginForm" autocomplete="off" novalidate>
          <!--  fake fields are a workaround for chrome/opera autofill getting the wrong fields -->
          <input style="display:none" type="text" name="fakeusernameremembered">
          <input style="display:none" type="password" name="fakepasswordremembered">
          <div class="form-group">
            <label for="name" class="d-none">Email</label>
            <input class="form-control" type="email" formControlName="email" autocomplete="nope" placeholder="Email">
            <small class="form-text text-muted danger">Please
              enter valid email!</small>
          </div>
          <div class="form-group">
            <label for="password" class="d-none">Password</label>
            <input class="form-control" type="password" formControlName="password" autocomplete="new-password"
              placeholder="Password">
            <small class="form-text text-muted danger">Please
              enter password!</small>
          </div>
          <div class="buttons">
            <div class="btn-holder">
              <button class="btn btn-default" >Sign In</button>
            </div>
          </div>
          <a href="javascript:void(0)" class="forgot-link" ">Forgot Password?</a>
        </form>

        <div class="bottom-section">
          <ul class="list-inline social-networks">
            <li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fa fa-instagram"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
          </ul>

          <!-- footer nav -->
          <nav class="f-nav">
            <ul class="list-inline">
              <li class="list-inline-item"><a href="#">Contact Us</a></li>
              <li class="list-inline-item"><a href="#">About Us</a></li>
              <li class="list-inline-item"><a href="#">FAQ</a></li>
            </ul>
          </nav>
        </div>
      </aside>
    </div>
  </div>
</div>
<div *ngIf="!showLogin">
  <div class="loading-main-div" style="width: 100%; height:100%; background-color: rgba(0 , 0 , 0 , 0.2);">

  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<!--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->
