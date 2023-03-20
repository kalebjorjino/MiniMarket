@extends('layouts.app')

@section('content')
    <div class="bg-3">
    <div class="container" style="background-color: white; border-radius: 25px; padding: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
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
                    <h4 style="font-weight: 400;"><br><br>A verification link has been sent to your email address.</h4>
                    <p>If you did not receive an email,</p>
                    <br>
                </div>
                <br>
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Click here to request another') }}
                    </button>
                </div>
            </div>            
    </div>
@endsection
