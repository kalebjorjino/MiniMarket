@extends('layouts.app')

@section('content')
    <section class="checkout-section bg-white">
        <div class="container">

            @if ($errors->any())
                <ul
                    style="
                     width: 100%; background-color: rgb(255, 172, 172); border: red solid 1px;
                     border-radius: 5px; text-center; padding: .75rem;
                 ">
                    @foreach ($errors->all() as $error)
                        <li style="color: red; margin-left: .5rem">{{ $error }}</li>
                    @endforeach
                </ul>
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
                <form class="checkout-form">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="payment">
                                <h4>Contact Information</h4>
                                {{-- <span>Please provide your contact details below to proceed</span> --}}
                                {{-- <input type="hidden" id="payment-type" name="payment-type"> --}}
                                <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="first_name">First Name <span class="text-danger"> *
                                                </span></label>
                                            <input id="first_name" type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                                placeholder="First Name" autofocus>

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="last_name">Last Name <span class="text-danger"> *
                                                </span></label>
                                            <input id="last_name" type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                                placeholder="Last Name">

                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 group-input mt-2">
                                        <label for="phone_number">Phone Number <span class="text-danger"> *
                                            </span>
                                        </label>

                                        <input id="phone_number" type="text" name="phone_number"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            value="{{ old('phone_number', $user->phone) }}" placeholder="Phone Number">

                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-6 group-input mt-2">
                                        <label for="email">{{ __('Email Address') }} <span class="text-danger"> *
                                            </span></label>

                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email', $user->email) }}" autocomplete="email"
                                            placeholder="Email Address">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="group-input mt-2">
                                        <label for="address">{{ __('Shipping Address') }} <span class="text-danger"> *
                                            </span></label>

                                        <input id="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address', $user->address) }}" placeholder="Address">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="payment my-4">
                                <h4>Shipping Courier</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="courier" id="grab-courier"
                                        value="GrabExpress">
                                    <label class="form-check-label" for="grab-courier">
                                        GrabExpress
                                    </label>
                                    <span>Same day delivery within NCR</span>

                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" name="courier" id="lala-courier"
                                        value="Lalamove">
                                    <label class="form-check-label" for="grab-courier">
                                        Lalamove
                                    </label>
                                    <span>Same day delivery within NCR</span>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-5">
                            <div class="place-order">
                                <div class="order-total">
                                    <h4>Order Summary</h4>

                                    <ul class="order-table pl-0 pt-3">
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

                                        <li class="fw-bold text-uppercase">Subtotal <span>₱{{ $Subtotal }}</span></li>
                                        <li class="fw-normal">Shipping Fee <span>₱100</span></li>
                                        <li class="total-price">Total <span>&#8369;{{ $Total }}</span></li>
                                        <input type="hidden" name="total" value="{{ $Total }}">
                                    </ul>

                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn text-white">Proceed to
                                            Payment</button>
                                    </div>
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
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>

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
