@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Change Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <section class="pro-content">

        <!-- Profile Content -->
        <section class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 mt-4">
                        <div class="heading">
                            <h2>
                                My Account
                            </h2>
                            <hr>
                        </div>

                        @include('customer.side-menu')
                    </div>
                    <div class="col-12 col-lg-9 mt-4">
                        <div class="heading">
                            <h2>
                                Change Password
                            </h2>
                            <hr>
                        </div>

                        <form class="align-items-center" method="POST" action="/changepassword">
                            @csrf
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}

                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="current_password" class="col-sm-3 col-form-label">Current Password </label>
                                <div class="col-sm-9">
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" placeholder="Enter Current password" name="current_password">
                                    <!-- insert here input pass chack -->

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password" placeholder="Create New Password" name="new_password">

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password_confirmation" class="col-sm-3 col-form-label">Confirm New
                                    Password</label>
                                <div class="col-sm-9">
                                    <input type="password"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                        placeholder="Confirm New Password" name="new_password_confirmation">
                                    @error('new_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit"
                                class="btn site-btn button_hover mt-2 float-right">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
