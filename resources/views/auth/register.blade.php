@extends('admin.layouts.guest')

@section('content')
    <!-- Register Section Start -->
    <div class="register-login-section spad" style="background-image: url('images/auth/white bg.png'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Sign Up</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="group-input">
                                <label for="first_name">First Name<span class="text-danger"> *
                                    </span></label>
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

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
                                    value="{{ old('last_name') }}" autocomplete="last_name">

                                @error('last_name')
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
                                <label for="phone_number">Phone Number<span class="text-danger"> *
                                    </span>
                                </label>

                                <input id="phone_number" type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}" autocomplete="phone_number">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="address">Address<span class="text-danger"> *
                                    </span>
                                </label>

                                <textarea id="address" type="text" name="address" rows="2" cols="50" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" autocomplete="address"></textarea>

                                @error('address')
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
                                    name="confirm_password" autocomplete="confirm_password">

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="site-btn register-btn">
                                {{ __('Create account') }}
                            </button>
                        </form>
                        <div class="switch-login">
                            <a href="/login" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Section End -->
@endsection
