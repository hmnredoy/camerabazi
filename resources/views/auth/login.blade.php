<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Loreal')  }} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="{{ url('js/app.js') }}"></script>
</head>
<body>
<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<section class="login-section">
    <div class="login-parts">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-5 mx-auto">
                    <div class="login-options">
                        {{--<div class="logo-part">
                            <img src="{{url('images/pragati-logo.png')}}" alt="Logo">
                        </div>--}}
                        <form class="login-form" method="POST" action="/login">
                            @csrf
                            <div class="login-form-part">
                                <p>Please login to your account.</p>
                                <div class="form-group custom-form-group">
                                    <label>Email</label>
                                    <div class="input-group custom-input-group">
                                        {{--                                            <input type="text" class="form-control custom-form-control" id="user_name">--}}
                                        <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group custom-form-group">
                                    <label>Password</label>
                                    <div class="input-group custom-input-group">
                                        <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text visible" style="cursor: pointer; border: 1px solid #fff;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="M8 6.4C8.352 6.4 8.68267 6.49067 8.992 6.672C9.30133 6.85333 9.54667 7.09867 9.728 7.408C9.90933 7.71733 10 8.048 10 8.4C10 8.752 9.90933 9.08267 9.728 9.392C9.54667 9.70133 9.30133 9.94667 8.992 10.128C8.68267 10.3093 8.352 10.4 8 10.4C7.648 10.4 7.31733 10.3093 7.008 10.128C6.69867 9.94667 6.45333 9.70133 6.272 9.392C6.09067 9.08267 6 8.752 6 8.4C6 8.048 6.09067 7.71733 6.272 7.408C6.45333 7.09867 6.69867 6.85333 7.008 6.672C7.31733 6.49067 7.648 6.4 8 6.4ZM8 11.744C8.608 11.744 9.168 11.5947 9.68 11.296C10.192 10.9973 10.5973 10.592 10.896 10.08C11.1947 9.568 11.344 9.008 11.344 8.4C11.344 7.792 11.1947 7.232 10.896 6.72C10.5973 6.208 10.192 5.80267 9.68 5.504C9.168 5.20533 8.608 5.056 8 5.056C7.392 5.056 6.832 5.20533 6.32 5.504C5.808 5.80267 5.40267 6.208 5.104 6.72C4.80533 7.232 4.656 7.792 4.656 8.4C4.656 9.008 4.80533 9.568 5.104 10.08C5.40267 10.592 5.808 10.9973 6.32 11.296C6.832 11.5947 7.392 11.744 8 11.744ZM8 3.392C9.09867 3.392 10.144 3.60533 11.136 4.032C12.096 4.448 12.9387 5.03467 13.664 5.792C14.4 6.54933 14.96 7.41867 15.344 8.4C14.96 9.38133 14.4 10.2507 13.664 11.008C12.9387 11.7547 12.096 12.336 11.136 12.752C10.144 13.1787 9.09867 13.392 8 13.392C6.90133 13.392 5.856 13.1787 4.864 12.752C3.904 12.336 3.056 11.7547 2.32 11.008C1.59467 10.2507 1.04 9.38133 0.656 8.4C1.04 7.41867 1.59467 6.54933 2.32 5.792C3.056 5.03467 3.904 4.448 4.864 4.032C5.856 3.60533 6.90133 3.392 8 3.392Z" fill="#E5E5E5"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group custom-form-group">
                                    <div class="col-md-6 offset-md-4">
                                      <a href="/register?type=freelancer">Looking For Job</a>
                                    </div>
                                    <div class="col-md-6 offset-md-4">
                                        <a href="/register?type=client">Looking For Freelancer</a>
                                    </div>
                                </div>

                                <div class="form-group custom-form-group">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary login-btn">Log In</button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($jobs as $job)
                    <h2>{{$job->title}} </h2>
                    {{ $job->expire->diffForHumans(null, true) }}
                    <ul>
                        @foreach($job->categories as $cat)
                        <li>
                        {{$cat->name}}
                        </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
            {{ $jobs->links() }}
        </div>
    </div>
</section>


<script>
    $(document).ready(function(){
        'use strict';
        $('.visible').click(function () {
            var val = $('#password')[0];
            var type = val.getAttribute("type");
            if(type == 'password') {
                val.setAttribute('type', 'text');
            } else {
                val.setAttribute('type', 'password');
            }
        });
    })
</script>


</body>
</html>
