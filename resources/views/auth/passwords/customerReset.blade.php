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
                <div class="card-body">
                    <h2 style="text-align: center; font-size:3em; font: 900 3em Lato;">Reset Password</h2>
                        <br>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!--  -->

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Section End -->
@endsection
