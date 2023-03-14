@extends('admin.layouts.guest')

@section('content')
    <!-- Register Section Start -->
    <div class="register-login-section spad" style="background-image: url('images/auth/SAMJ_LoginBG3.png'); background-position: center; background-repeat: no-repeat; background-size: cover; position: relative;">
    <!-- <img src="{{ asset('images/Food1.png') }}" style="
        position: absolute;
        left: -100px;
        top: 450px;
        z-index: 1;
        width: 35%;">
    <img src="{{ asset('images/Food2.png') }}" style="
        position: absolute;
        left: 1450px;
        top: 0px;
        z-index: 1;
        width: 40%;">
    <img src="{{ asset('images/Food3.png') }}" style="
        position: absolute;
        left: 1550px;
        top: 450px;
        z-index: 1;
        width: 28%;">
    <img src="{{ asset('images/Food3.png') }}" style="
        position: absolute;
        left: 1350px;
        top: 450px;
        z-index: 1;
        width: 30%;"> -->
        <div class="container" style="background-color: white; border-radius: 25px; padding: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2 style="text-align: center; font-size:3em; font: 900 3em Lato;">Sign Up</h2>
                        <br>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="group-input">
                                <label for="first_name">First Name<span class="text-danger"> *
                                    </span></label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="last_name">Last Name<span class="text-danger"> *
                                    </span></label>
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" >

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="group-input">
                                <label for="phone_number">Phone Number<span class="text-danger"> *
                                    </span>
                                </label>

                                <input id="phone_number" type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="group-input">
                                <label for="email">{{ __('Email Address') }}<span class="text-danger"> * </span></label>

                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="password">{{ __('Password') }}<span class="text-danger"> * </span></label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="confirm_password">{{ __('Confirm Password') }}<span class="text-danger"> *
                                    </span></label>

                                <input id="confirm_password" type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    name="password_confirmation" autocomplete="confirm_password">

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="col-12" style="width: 400px; display: block; margin-left: auto; margin-right: auto;">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center" style="padding: 10px; font-size:1.3em; background-color: #2d32cd;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="switch-login" style="text-align: center; padding: 15px;">
                            Already have an account? <a href="{{route('login')}}" class="or-login" style="color: #cc2e3a; text-decoration:underline; ">Login here</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Section End -->
@endsection
