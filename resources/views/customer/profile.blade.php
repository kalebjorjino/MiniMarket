@extends('layouts.app')
@section('content')
    <div class="bg-3">


        {{-- <section class="pro-content"> --}}
        <section class="container">

            <!-- Profile Content -->
            <section class="profile-content">
                <div class="bg-dashboard mx-auto">
                    <div class="row">

                        <div class="col-12 col-lg-3 mt-4">
                            <div class="heading">
                                <h2>
                                    Account
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

                            <form class="align-items-center p-1" id="profileForm" method="POST" action="/account/profile">
                                @csrf

                                @if (Session::has('success'))
                                    <div class="alert alert-success fw-normal" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            id="first_name" placeholder="First Name" name='first_name'
                                            value="{{ old('first_name',auth()->guard('web')->user()->first_name) }}">
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

                                        <input type="text" class="form-control  @error('last_name') is-invalid @enderror"
                                            id="last_name" placeholder="Last Name" name='last_name'
                                            value="{{ old('last_name',auth()->guard('web')->user()->last_name) }}">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" placeholder="Phone Number" name='phone'
                                            value="{{ old('phone',auth()->guard('web')->user()->phone) }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" placeholder="Address" name='address'
                                            value="{{ old('address',auth()->guard('web')->user()->address) }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Email Address" name="email"
                                            value="{{ old('email',auth()->guard('web')->user()->email) }}" readonly>
                                    </div>
                                </div>


                                {{-- <input type="text" class="d-none" name="email"> --}}
                                <button type="submit" class="btn site-btn button_hover mt-2" id="saveProfile">SAVE
                                    CHANGES</button>

                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </section>


    </div>
@endsection
