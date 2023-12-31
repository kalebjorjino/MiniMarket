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

                                <!-- sort filter -->

                                {{-- <div class="filters">
                                    <span class="fw-bold text-muted"><small>Sort orders: </small></span>
                                    <select id="fetchval" name="fetchval" aria-label="Default select" class=""
                                        required>
                                        <option value="0">All</option>
                                        <option value="1">Order Placed</option>
                                        <option value="2">Processing</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Canceled</option>
                                    </select>
                                </div> --}}


                                <!-- order table -->

                                <div id="data_table_wrapper" class="order-history table-responsive fw-normal">
                                    <table id="data_table" class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Order no.</th>
                                                <th>Order Date</th>
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
                                                    <td class="">
                                                        <span
                                                            class="badge bg-primary @if ($order->status == 'Cancelled') bg-danger @endif  m-0">{{ $order->status }}</span>
                                                    </td>
                                                    <td class="">{{ number_format($order->total_price, 2) }}</td>
                                                    <td class="">
                                                        <a href="{{ route('customer.order', $order->trackingnumber) }}"
                                                            class="btn btn-secondary btn-icon me-1 my-2"
                                                            data-toggle="tooltip" title="Show">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-danger btn-icon my-2 cancel"
                                                            data-id="{{ $order->id }}" data-toggle="tooltip"
                                                            title="Cancel" @disabled($order->status == 'Completed' || $order->status == 'Cancelled')>
                                                            <i class="far fa-circle-xmark"></i>
                                                        </button>
                                                        {{-- <a href="" class="btn btn-success btn-icon btn-sm mr-1 my-1"
                                                                data-toggle="tooltip" title="Pay">
                                                                <i class="far fa-credit-card"></i>
                                                            </a> --}}
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

        // $(document).ready(function() {
        //     $("#fetchval").on('change', function() {
        //         var value = $(this).val();
        //         alert(value); //test
        //     });

        // });

        // DATATABLES
        $(document).ready(function() {
            $("#data_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
            })
        });

        var url = window.location.href;
        $('body').on('click', '.cancel', function(e) {

            e.preventDefault();
            let id = $(this).data('id')

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#d33",
                // cancelButtonColor: "#6C757D", // #3085d6
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`${url}/${id}`).then(function(r) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled!',
                            'Order has been cancelled.',
                            'success'
                        )
                    }).then(() => {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Action is cancelled',
                        'error'
                    )
                }
            })
        });
    </script>
@endsection
