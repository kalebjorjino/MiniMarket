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

                                <!-- order table -->

                                <div class="filters">
                                    <span class="fw-bold text-muted"><small>Sort orders: </small></span>
                                    <select id="fetchval" name="fetchval" aria-label="Default select" class=""
                                        required>
                                        <option value="0">All</option>
                                        <option value="1">Order Placed</option>
                                        <option value="2">Processing</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Canceled</option>
                                    </select>
                                </div>
                                <div id="data_table_wrapper" class="order-history table-responsive fw-normal">
                                    <table id="data_table" class="table table-hover  mb-0">
                                        <thead>
                                            <tr>
                                                <th>Order no.</th>
                                                <th>Date Ordered</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th data-orderable="false">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="">{{ $order->trackingnumber }}</td>
                                                    <td class="">{{ date('Y-m-d', strtotime($order->created_at)) }}
                                                    </td>
                                                    <td class=""><span
                                                            class="badge bg-secondary m-0">{{ $order->status }}</span>
                                                    </td>
                                                    <td class="">{{ number_format($order->total_price, 2) }}</td>
                                                    <td class="">

                                                        <a href="" class="btn btn-secondary btn-icon me-1 my-2"
                                                            data-toggle="tooltip" title="Show">
                                                            <i class="far fa-eye"></i>
                                                        </a>

                                                        {{-- <a href="" class="btn btn-success btn-icon btn-sm mr-1 my-1"
                                                data-toggle="tooltip" title="Pay">
                                                <i class="far fa-credit-card"></i>
                                            </a> --}}

                                                        <a href="" class="btn btn-danger btn-icon my-2"
                                                            data-toggle="tooltip" title="Cancel">
                                                            <i class="far fa-circle-xmark"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });

        $(document).ready(function() {
            $("#fetchval").on('change', function() {
                var value = $(this).val();
                alert(value); //test
            });

        });

        // DATATABLES
        $(document).ready(function() {
            $("#data_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            })
        });
    </script>
@endsection
