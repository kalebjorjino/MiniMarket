@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Dashboard</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item">
                                <a href="#0">Dashboard</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('adminDashboard') }}">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-cart-full"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Active Products</h6>
                    <h3 class="text-bold mb-10">{{ $active }}</h3>

                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon success">
                    <i class="lni lni-dollar"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Income</h6>
                    <h3 class="text-bold mb-10">₱{{ $income }}</h3>

                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon primary">
                    <i class="lni lni-credit-cards"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Expense</h6>
                    <h3 class="text-bold mb-10">₱{{ $expenses }}</h3>

                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon orange">
                    <i class="lni lni-user"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Verified Customers</h6>
                    <h3 class="text-bold mb-10">{{ $users }}</h3>

                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
    
    <div class="row">
        <div class="col-lg-7">
            <div class="card-style mb-30">
                <div
                    class="
                    title
                    d-flex
                    flex-wrap
                    align-items-center
                    justify-content-between
                  ">
                    <div class="left">
                        <h6 class="text-medium mb-30">Latest Orders</h6>
                    </div>
                    {{-- <div class="right">
                        <div class="select-style-1">
                            <div class="select-position select-sm">
                                <select class="light-bg">
                                    <option value="">Today</option>
                                    <option value="">Yesterday</option>
                                </select>
                            </div>
                        </div>
                        <!-- end select -->
                    </div> --}}
                </div>
                <!-- End Title -->
                <div class="table-responsive">
                    <table class="table top-selling-table">
                        <thead>
                            <tr>
                                <th>
                                    <h6 class="text-sm text-medium">Order No</h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Order Date
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Amount
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Status
                                    </h6>
                                </th>
                                {{-- <th>
                                    <h6 class="text-sm text-medium text-end">
                                        Action <i class="lni lni-arrows-vertical"></i>
                                    </h6>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest as $l)

                            <tr>
                                <td>
                                    <p class="text-sm">{{$l['trackingnumber']}}</p>
                                </td>
                                <td>
                                    <p class="text-sm">{{$l['created_at']}}</p>
                                </td>
                                <td>
                                    <p class="text-sm">₱{{$l['total']}}</p>
                                </td>
                                <td>
                                    <span class="status-btn active-btn">{{$l['status']}}</span>
                                </td>

                            </tr>
                            @endforeach                    
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-5">
            <div class="card-style mb-30" >
                {{-- Stock Alert --}}
                <div class="left">
                    <h6 class="text-medium mb-30">Stock Alerts</h6>
                    <div class="table-responsive">

                    <table id="inventory" class="table top-selling-table">
                        <thead>
                            <tr>
                                <th>
                                    <h6 class="text-sm text-medium">ID</h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Product
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Stocks
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Alert Quantity
                                    </h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    @if ($item->stocks <= $item->alert_quantity)
                                        <td class="bg-danger">{{ $item->stocks }}</td>
                                    @else
                                        <td>{{ $item->stocks }}</td>
                                    @endif
                                    <td>{{ $item->stock_alert }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Col -->
      
    </div>
    <!-- End Row -->
@endsection
@section('script')
    <script>
          $(function() {
            $("#inventory").DataTable({
                "aaSorting": [ ], // Prevent initial sorting
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 5,
                "searching": false,
            })
        });

    </script>
@endsection
