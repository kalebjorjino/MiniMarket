@extends('layouts.app')

@section('content')
    <section class="checkout-section bg-white">
        <div class="container">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger fw-normal" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div id="payment-box">
                <div class="row justify-content-between checkout-form">
                    <div class="col-lg-6">
                        <div class="payment">
                            <h4>Review Information</h4>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="review-info">
                                        <li><span>Contact
                                            </span>{{ $info->orderContact->first_name . ' ' . $info->last_name }}
                                        </li>
                                        <li><span>Ship to</span> {{ $info->orderContact->address }}</li>
                                        <li><span>Courier </span>{{ $info->orderContact->courier }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="place-order my-4">
                            <div class="order-total payment-order-sum">
                                <h4>Order Summary</h4>
                                <ul class="order-table">
                                    <li>Product <span>Price</span></li>
                                    @php
                                        $Subtotal = 0;
                                        $Total = 0;
                                    @endphp

                                    @foreach ($carts as $cart)
                                        @php
                                            $total_price = 0;
                                            $price = json_decode($cart->product->price);
                                            $total_price = (float) $price * (int) $cart->quantity;
                                            
                                            $Subtotal += $total_price;
                                        @endphp
                                        <li class="fw-normal">{{ $cart->product->title }} x
                                            {{ $cart->quantity }}<span>&#8369;{{ $total_price }}</span></li>
                                    @endforeach

                                    @php
                                        $Total = $Subtotal + 100;
                                    @endphp

                                    {{-- <li class="fw-bold text-uppercase">Subtotal <span>₱{{ $Subtotal }}</span></li> --}}
                                    <li class="fw-normal">Shipping Fee <span>₱100</span></li>
                                    <li class="total-price">Total <span>&#8369;{{ $Total }}</span></li>
                                    <input type="hidden" name="total" value="{{ $Total }}">
                                </ul>


                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">
                        <div class="place-order">
                            <div class="order-total">
                                <h4>Payment Methods</h4>
                                <form action="{{ route('payOrder') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="trackingnumber" value="{{ $info->trackingnumber }}">
                                    <button class="paypal-btn">Pay with
                                        <img src="{{ asset('images/paypal/PayPal.svg.webp') }}" width="100"
                                            alt="paypal logo">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

@endsection
