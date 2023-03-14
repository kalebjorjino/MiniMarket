@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Orders</span>
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
                                My Orders
                            </h2>
                            <hr>
                        </div>
                        
                        <!-- insert here user orderdata -->
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@section('script')
    <script>
        // $(document).ready(function() {
        //     $('select').niceSelect();
        // });

        $(document).ready(function() {
            $("#fetchval").on('change', function() {
                var value = $(this).val();
                alert(value); //test
            });

            // can be removed
            // $.ajax({
            //     url: "",
            //     type: "POST",
            //     data: 'request=' + value;
            //     success.function(data) {
            //         $(".order-history").html(data);
            //     }
            // });
        });
    </script>
@endsection
