@extends('layouts.app')

@section('content')
    <div class="bg-3">
        <div class="container bg-4">

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
