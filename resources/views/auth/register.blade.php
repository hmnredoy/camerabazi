{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="firstname" class="col-md-4 col-form-label text-md-right">Firstname</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="firstname" type="text" class="form-control  " name="firstname" value="" autofocus>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="lasttname" class="col-md-4 col-form-label text-md-right">Last tname</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="lastname" type="text" class="form-control" name="lastname" value="" autofocus>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="contatc" class="col-md-4 col-form-label text-md-right">Contact</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="contatc" type="text" class="form-control  " name="contact" value="" autofocus>--}}

{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}



{{--                        <input type="hidden" value="{{$role->id}}" class="form-check-input" name="role">--}}


{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.main');

@section('content')
    <section class="join-now-section">

        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                    <div class="join-now-form-part">
                        <h2>Join Now as {{ $role->name }}</h2>
                        <form class="custom-join-now-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row form-group custom-form-group">
                                <div class="col">
                                    <input type="text" name="name"  value="{{ old('username')}}" class="form-control custom-form-control" placeholder="User name">
                                    <div class="invalid-feedback">
                                        Please choose an emailaddress.
                                    </div>
                                </div>

                                <input type="hidden" value="{{$role->id}}" class="form-check-input" name="role">
                            </div>

                            <div class="form-group custom-form-group">
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control custom-form-control" id="email" placeholder="Your Email Address">
                                <div class="invalid-feedback">
                                    Please choose an emailaddress.
                                </div>
                            </div>

                            <div class="form-group custom-form-group">
                                <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control custom-form-control" id="contact_number" placeholder="Contact Number">
                                <div class="invalid-feedback">
                                    Please choose an emailaddress.
                                </div>
                            </div>
                            <select  name="location" class="custom-select">
                                <option selected>Open this select menu</option>
                               @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->title}}</option>
                               @endforeach
                            </select>

                            <div class="form-group custom-form-group">
                                <input type="password" name="password" class="form-control custom-form-control" id="password" placeholder="Password">
                                <div class="invalid-feedback">
                                    Please choose an emailaddress.
                                </div>
                            </div>

                            <div class="form-group custom-form-group">
                                <input type="password" name="password_confirmation" class="form-control custom-form-control" id="confirm_password" placeholder="Confirm Password">
                                <div class="invalid-feedback">
                                    Please choose an emailaddress.
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <div class="select-option">
                                    <!-- <h5>Billing Address</h5> -->
                                    <label class="selectall">I agree to the <span>Terms & Conditions</span> and <span>Privacy Policy </span> </span>
                                        <input type="checkbox" id="selectall">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary custom-getstart-btn">Get Started</button>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="sign-in-option">
                            Already a member ? <a href="#">Sign in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection