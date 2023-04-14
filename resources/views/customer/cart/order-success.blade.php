   @extends('layouts.app')

   @section('content')
       <section class="order-success text-center my-5">
           <div class="container ">
               <div class="row justify-content-center ">
                   <div class="col-xs-10 col-md-8">
                       <img src="{{ asset('images/illus/check.svg') }}" alt="" class="mb-4">
                       <h5 class="success-title">ORDER PLACED SUCCESS!</h5>
                       <span class="fw-normal">Your order request has been placed. Proceed to pay your order no. {{$payment->trackingnumber}} in my orders.</span>
                   </div>

                   <div class="col-lg-10 mt-4" style="background-color: #EDEDED; padding: 2.75rem 5rem;">
                        <div class="d-flex  flex-column  align-items-start mb-2 fw-normal">
                            <p><span class="text-dark fw-bold">Order No.:</span> {{$payment->trackingnumber}} </p>
                            <p><span class="text-dark fw-bold">Order Date:</span> {{$payment->created_at}} </p>
                            <p><span class="text-dark fw-bold">Status:</span> {{$payment->status}} </p>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody class="fw-normal">
                                @foreach ($carts as $cart)
                                    @php
                                        $money = 0;
                                        $price = json_decode($cart->product->price);

                                        $money = number_format(((float)$price * (float)$cart->quantity),2, '.', '');

                                        // if($cart->product->category_id == 2 || $cart->product->category_id == 4){
                                        //     $money = ((int)$price * (int)$cart->quantity);
                                        // }
                                        // else{
                                        //     foreach($price as $arr){
                                        //         foreach($arr as $val){
                                        //             if($val->size == $cart->size && $val->color == $cart->color){
                                        //                 $money = ((int) $val->price * (int)$cart->quantity);
                                        //                 break;
                                        //             }
                                        //         }
                                        //     }
                                        // }
                                    @endphp
                                    <tr>
                                        <td scope="row">{{$loop->index+1}}</td>
                                        <td>{{$cart->product->title}}</td>
                                        <td>{{$money/$cart->quantity}}</td>
                                        <td>{{$cart->quantity}}</td>
                                        <td>₱{{$money}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" colspan="4" class="text-end pe-2"> <span class="fw-bold">Order Total</span></th>
                                    <td>₱{{number_format((float)$payment->total_price,2, '.', '')}}</td>
                                </tr>
                            </tbody>

                        </table>
                   </div>
               </div>
               <div class="row justify-content-center">
                   <div class="col-lg-12 mt-4">
                       {{-- <a href="/menu" class="main-btn btn primary-btn button_hover">Continue Shopping</a> --}}
                       <a href="/menu" class="black-btn">Continue Shopping</a>
                       <a href="/account/orders" class="black-btn">My Orders</a>
                   </div>
               </div>
           </div>
       </section>
   @endsection
