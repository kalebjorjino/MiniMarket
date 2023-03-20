@extends('layouts.app')

@section('content')
<div class="bg-3">
    <div class="mx-auto" style="width: 600px;">
        <div class="signin-wrapper" style="background-color: transparent;">
            <div class="form-wrapper" style="margin:auto;">
                <div class="logo" style="margin:auto;">
                    <img src="{{ asset('images/logo/samj-logo.png') }}" alt="SAMJ Logo" style="width:400px; display: block; margin-left: auto; margin-right: auto;">
                </div>
                <h6 class="mb-15" style="display: block; font: 900 3em Lato; text-align:center;">{{ __('ANNYEONGHASEYO!') }}</h6>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12" style="width: 400px; display: block; margin-left: auto; margin-right: auto;">
                            <div class="input-style-1">
                                <label for="email">{{ __('Email') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email"
                                    name="email" id="email" placeholder="{{ __('Email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12" style="width: 400px; display: block; margin-left: auto; margin-right: auto;">
                            <div class="input-style-1">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid" @enderror
                                    name="password" id="password" placeholder="{{ __('Password') }}" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-xxl-6 col-lg-12 col-md-6" style="width: 400px; display: flex; margin-left: auto; margin-right: auto; display: flex;justify-content:space-between;">
                            <div class="form-check checkbox-style mb-30">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    value="" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" style="text-decoration: underline; text-align: right; padding-left: 45px;">{{ __('Forgot Your Password?') }}</a>
                                    @endif
                            </div>
                            
                        </div>
                        <!-- end col -->
                        
                        <div class="col-12" style="width: 400px; display: block; margin-left: auto; margin-right: auto;">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center" style="padding: 10px; font-size:1.3em; background-color: #2d32cd;">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="switch-login" style="text-align: center; padding: 15px;">
                            New customer? <a href="/register" class="or-login" style="color: #cc2e3a; text-decoration:underline; ">Sign up here</a>
                        </div>
                        </div>
                    </div>
                    <!-- end row -->
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- end col -->
@endsection
