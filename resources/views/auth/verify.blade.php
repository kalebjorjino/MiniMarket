@extends('layouts.app')

@section('content')
    <div class="bg-3">
        <div class="container"
            style="background-color: white; border-radius: 25px; padding: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        height: 500px;
        display: flex;
        justify-content: center;
        align-items: center;">

            <div class="row" style="text-align:center;">
                <div>
                    <h1 style="font: 900 3em Lato;">Chukahae, chingu!</h1>
                    <h2 style="font-weight: 400;">You have successfully created your account.</h2>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <h4 style="font-weight: 400;" class="mt-5">Before getting started, please check your email for a
                        verification
                        link.</h4>
                    <p>If you did not receive an email, click the button below to request another.</p>
                    <br>
                </div>
                <br>
                <div class="col-md-6 offset-md-3">
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-dark">
                            {{ __('Resend verification link') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
