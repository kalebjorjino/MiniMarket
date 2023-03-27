@extends('layouts.app')
@section('content')

<div class="bg-3">
    <section class="pro-content">

        <!-- Profile Content -->
        <section class="profile-content">
            <div class="container" style="background-color: white; border-radius: 25px; padding: 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin: 25px;">
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
</div>
@endsection
@section('script')
    <script>

        $(document).ready(function() {
            $("#fetchval").on('change', function() {
                var value = $(this).val();
                alert(value); //test
            });

        });
    </script>
@endsection
