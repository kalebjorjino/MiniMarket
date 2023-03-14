@extends('layouts.app')
@section('content')
    {{-- <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">{{ trans('lables.bread-crumb-home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('lables.bread-profile') }}</li>
                </ol>
            </div>
        </nav>
    </div> --}}

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Profile</span>
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
                                My Profile
                            </h2>
                            <hr>
                        </div>

                        <form class="align-items-center" id="profileForm" method="POST" action='/profile'>
                            @csrf
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <!-- insert input here -->
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="first_name" placeholder="First Name" name='first_name'
                                        >
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <!-- insert input here -->
                                    <input type="text" class="form-control  @error('last_name') is-invalid @enderror"
                                        id="last_name" placeholder="Last Name" name='last_name'
                                        >
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <!-- insert input here -->
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" placeholder="Phone Number" name='phone_number'
                                        >
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- insert input here -->
                            <input type="text" class="d-none" name="email">
                            <button type="submit"
                                class="btn site-btn button_hover mt-2 saveProfile float-right">SAVE
                                CHANGES</button>

                        </form>

                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
