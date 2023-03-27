@extends('layouts.app')

@section('content')
<!-- Background -->
<div class="bg-3">

    <section class="container">

        <!-- Profile Content -->
        <section class="profile-content">
            <div class="container" style="background-color: white; border-radius: 25px; padding: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin: 25px;">
            
                <div class="row">
                    <div class="col-12 col-lg-3 mt-4">
                        <div class="heading">
                            <h2>
                                User
                            </h2>
                            <hr>
                        </div>

                        @include('customer.side-menu')
                    </div>
                    <div class="col-12 col-lg-9 mt-4">
                        <div class="heading">
                            <h2>
                                My Dashboard
                            </h2>
                            <hr>
                        </div>

                        <div class="row dashboard justify-content-between text-center">

                            <div class="col-12 mb-4">
                                <div class="col-md-12 box">
                                    <br><br>
                                    <h2>Annyeonghaseyo, {{ $user->first_name }}!</h2>
                                    <h4>What are you craving today?</h4>

                                    <br><br>
                                </div>
                            </div>
                            
                            {{-- Might remove --}}
                            {{-- <div class="col-md-6 ">
                                <div class="col-md-12 box">
                                    <h5>Total Orders</h5>
                                    
                                    <h4>[insert num of orders here]</h4>
                                    <span><a href="/">View Orders</a></span>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="col-md-12 box">
                                    <h5>Items in Cart</h5>
                                    <h4>[insert num of items in cart]</h4>
                                    <span><a href="/">View Cart</a></span>
                                </div>
                            </div> --}}

                        </div>

                    </div>
                </div>
            </div>

        </section>
    </section>
</div>
@endsection
