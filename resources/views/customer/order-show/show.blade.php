@extends('layouts.app')



@section('content')
    <div class="bg-3">
        <div class="container">

            <section class="pro-content">

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
                                        My Orders
                                    </h2>
                                    <hr>
                                </div>


                                <section class="order-details-wrap">
                                    <a href="{{ url('account/orders/') }}" class="back-btn">
                                        <i class="fa-solid fa-chevron-left"></i> BACK</a>
                                    {{-- <div class="container"> --}}
                                    <div class="order-details-top">

                                        <div class="row">
                                            @include('customer.order-show.order_information')
                                            @include('customer.order-show.payment_details')
                                        </div>
                                    </div>

                                    @include('customer.order-show.items_ordered')
                                    @include('customer.order-show.order_totals')
                                    {{-- </div> --}}
                                </section>



                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>

    </div>
@endsection
