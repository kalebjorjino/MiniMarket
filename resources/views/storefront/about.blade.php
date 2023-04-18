@extends('layouts.app')

@section('content')

<div class="bg-aboutus">
    <div class="about-section">
        <div class="container"
            style="font-family: 'Gotham'; padding:70px 70px 0px 70px;">
            <div class="row justify-content-around">
                <h2 class="title title_color text-center mb-5">About Us Page</h2>
                <p style="
                text-align: center;
                font-size:18px;">At SAMJ Korean Mini Mart, we believe that great food brings people together. That's why we've dedicated ourselves to providing our customers with the most authentic and delicious Korean food products available. From traditional snacks and sweets to popular beverages and pantry staples, our store offers a wide selection of high-quality Korean food and ingredients.</p>
            </div>
        </div>
    </div>

    <div class="gallery-section">
        <div class="container"
            style="padding:70px;">
            <div class="row">
                <div class="column">
                  <img src="https://images.unsplash.com/photo-1528615141309-53f2564d3be8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                  <img src="https://images.unsplash.com/photo-1635363638580-c2809d049eee?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">
                </div>
                <div class="column">
                  <img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80">
                  <img src="https://images.unsplash.com/photo-1575932444877-5106bee2a599?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80">
                </div>
                <div class="column">
                  <img src="https://images.summitmedia-digital.com/cosmo/images/2020/06/15/korean-grocery-essentials-1592209693.jpg">
                  <img src="https://images.unsplash.com/photo-1532347231146-80afc9e3df2b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=685&q=80">
                </div>
                <div class="column">
                  <img src="https://images.unsplash.com/photo-1563998711910-49e1ce922ec2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                  <img src="https://images.unsplash.com/photo-1563998767816-3684925102c1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">
                </div>
              </div>
        </div>
    </div>

    <div class="team-section">
            <div class="bg-team"
                style="
                padding:50px;">
                <h2 style="
                    color:#ffffff; 
                    text-align: center;
                    font-family: 'Gotham';">
                    OUR TEAM</h2>
            </div>
    </div>
</div>
@endsection
