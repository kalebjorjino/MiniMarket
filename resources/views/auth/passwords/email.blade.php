@extends('layouts.app')

@section('content')
    <!-- Forgot  Section Start -->
    <div class="bg-3">
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
                        <h2 style="text-align: center; font-size:3em; font: 900 3em Lato;">Forgot Password?</h2>
                        <br>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="group-input" style="width: 50%; display: block; margin-left: auto; margin-right: auto;">
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
                            
                            <br>
                            <div class="col-12" style="width: 400px; display: block; margin-left: auto; margin-right: auto;">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center" style="padding: 10px; font-size:1.3em; background-color: #2d32cd;">
                                    {{ __('Request Reset Link') }}
                                </button>
                            </div>
                            <div class="switch-login" style="text-align: center; padding: 15px;">
                            Remembered it? <a href="{{route('login')}}" class="or-login" style="color: #cc2e3a; text-decoration:underline; ">Login here</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Forgot Pass Section End -->
@endsection
