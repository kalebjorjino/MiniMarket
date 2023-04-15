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

            {{-- <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-group payment-type">
                        <label class="d-block" for="payment-type"><strong>PAYMENT
                                TYPE</strong></label>
                        <select aria-label="Payment Type" name="payment-type" onchange="bindSelectValue(this.value)">
                            <option disabled value="" selected>Select payment type</option>
                            <option value="1">Full Payment (100%)</option>
                            <option value="2">Partial Payment (50%)</option>
                        </select>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="d-none" id="payment-box"> --}}
            {{-- <form action="/cart/{{ $type }}/payment/{{ $tracking }}" method="POST" class="checkout-form"
                    enctype="multipart/form-data"> --}}
            <div id="payment-box">

                <div class="row justify-content-between checkout-form">
                    <div class="col-lg-6">
                        <div class="payment">
                            <h4>Review Information</h4>
                            {{-- <span>Please provide your contact details below to proceed</span> --}}
                            {{-- <input type="hidden" id="payment-type" name="payment-type"> --}}

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

                                    {{-- <input type="hidden" name="order" value="{{ $type }}"> --}}
                                    <input type="hidden" name="trackingnumber" value="{{ $info->trackingnumber }}">
                                    {{-- <input type="hidden" name="payment-type" id="paypal-type"> --}}
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

                {{-- @if ($paypal)
                    <div class="w-100 d-flex justify-content-start align-items-center mb-4 mt-4">
                        <div style="width: 100%; max-width: 350px; background-color: rgb(186, 186, 186); height: 2px;">
                        </div>
                        <h6 class="m-0" style="color: rgb(186, 186, 186);"> OR </h6>
                        <div style="width: 100%; max-width: 350px; background-color: rgb(186, 186, 186); height: 2px;">
                        </div>
                    </div>

                    <style>
                        .paypal-btn {
                            width: 100%;
                            background-color: #ffc439;
                            border: none;
                            padding: .5rem;
                            color: white;
                            max-width: 600px;
                        }
                    </style>

                    <form action="/payment/create/window" method="POST">
                        @csrf

                        <input type="hidden" name="order" value="{{ $type }}">
                        <input type="hidden" name="trackingnumber" value="{{ $tracking }}">
                        <input type="hidden" name="payment-type" id="paypal-type">
                        <button class="paypal-btn">
                            <img src="/img/PayPal.svg.webp" width="100" alt="">
                        </button>
                    </form>
                @endif --}}


            </div>
        </div>
    </section>

@endsection
@section('script')
    {{-- <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script> --}}

    {{-- <script>
        function bindSelectValue(val) {
            if (val == "1" || val == "2") {
                let paypal = document.getElementById("paypal-type")
                if (paypal != null) paypal.value = val;
                document.getElementById("payment-type").value = val;
                document.getElementById("payment-box").classList.remove('d-none')
            }
        }
    </script> --}}
@endsection
