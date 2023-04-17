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
                    justify-content-between
                    align-items-center
                  ">
                    <div class="left">
                        <h6 class="text-medium mb-30">Top Selling Products</h6>
                    </div>
                    {{-- <div class="right">
                        <div class="select-style-1">
                            <div class="select-position select-sm">
                                <select class="light-bg">
                                    <option value="">Yearly</option>
                                    <option value="">Monthly</option>
                                    <option value="">Weekly</option>
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
                                    <h6 class="text-sm text-medium">Product</h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">Category</h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">Total Sold</h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium text-end">Total Amount</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-1.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Arm Chair</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>

                                <td>
                                    <p class="text-sm">43</p>
                                </td>
                                <td>
                                    <p class="text-sm text-center">₱45</p>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-2.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Sofa</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>

                                <td>
                                    <p class="text-sm">13</p>
                                </td>
                                <td>
                                    <p class="text-sm text-center">₱15</p>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-3.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Dining Table</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>

                                <td>
                                    <p class="text-sm">32</p>
                                </td>
                                <td>
                                    <p class="text-sm text-center">₱215</p>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-4.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Office Chair</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>

                                <td>
                                    <p class="text-sm">23</p>
                                </td>
                                <td>
                                    <p class="text-sm text-center">₱345</p>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-5">
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
                        <h6 class="text-medium mb-30">Sales/Revenue</h6>
                    </div>
                    {{-- <div class="right">
                        <div class="select-style-1">
                            <div class="select-position select-sm">
                                <select class="light-bg">
                                    <option value="">Yearly</option>
                                    <option value="">Monthly</option>
                                    <option value="">Weekly</option>
                                </select>
                            </div>
                        </div>
                        <!-- end select -->
                    </div> --}}
                </div>
                <!-- End Title -->
                <div class="chart">
                    <canvas id="Chart2" style="width: 100%; height: 400px"></canvas>
                </div>
                <!-- End Chart -->
            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->

    <div class="row">
        <div class="col-lg-5">
            <div class="card-style mb-30">
                {{-- Stock Alert --}}
                <div class="left">
                    <h6 class="text-medium mb-30">Stock Alerts</h6>
                    <div class="table-responsive">

                    <table id="inventory" class="table top-selling-table" style="min-height: 250px">
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
                                    <td>{{ $item->product->title }}</td>
                                    @if ($item->stocks <= $item->alert_quantity)
                                        <td class="bg-danger">{{ $item->stocks }}</td>
                                    @else
                                        <td>{{ $item->stocks }}</td>
                                    @endif
                                    <td>{{ $item->alert_quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Col -->
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
                    <div class="right">
                        <div class="select-style-1">
                            <div class="select-position select-sm">
                                <select class="light-bg">
                                    <option value="">Today</option>
                                    <option value="">Yesterday</option>
                                </select>
                            </div>
                        </div>
                        <!-- end select -->
                    </div>
                </div>
                <!-- End Title -->
                <div class="table-responsive">
                    <table class="table top-selling-table">
                        <thead>
                            <tr>
                                <th>
                                    <h6 class="text-sm text-medium">Product</h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Category
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
                            <tr>
                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-1.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Bedroom</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>
                                <td>
                                    <p class="text-sm">₱345</p>
                                </td>
                                <td>
                                    <span class="status-btn close-btn">Pending</span>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-2.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Arm Chair</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>
                                <td>
                                    <p class="text-sm">₱345</p>
                                </td>
                                <td>
                                    <span class="status-btn warning-btn">Refund</span>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-3.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Sofa</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>
                                <td>
                                    <p class="text-sm">₱345</p>
                                </td>
                                <td>
                                    <span class="status-btn success-btn">Completed</span>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="product">
                                        <div class="image">
                                            <img src="{{ asset('images/products/dummy/product-mini-4.jpg') }}"
                                                alt="" />
                                        </div>
                                        <p class="text-sm">Kitchen</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm">Interior</p>
                                </td>
                                <td>
                                    <p class="text-sm">₱345</p>
                                </td>
                                <td>
                                    <span class="status-btn close-btn">Canceled</span>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
@endsection
@section('script')
    {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.js"></script>

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

        // =========== chart two start (sales/revenue)
        const ctx2 = document.getElementById("Chart2").getContext("2d");
        const chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: "bar", // also try bar or other graph types
            // The data for our dataset
            data: {
                labels: [
                    "Jan",
                    "Fab",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                // Information about the dataset
                datasets: [{
                    label: "",
                    backgroundColor: "#4A6CF7",
                    barThickness: 6,
                    maxBarThickness: 8,
                    data: [
                        600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
                    ],
                }, ],
            },
            // Configuration options
            options: {
                borderColor: "#F3F6F8",
                borderWidth: 15,
                backgroundColor: "#F3F6F8",
                tooltips: {
                    callbacks: {
                        labelColor: function(tooltipItem, chart) {
                            return {
                                backgroundColor: "rgba(104, 110, 255, .0)",
                            };
                        },
                    },
                    backgroundColor: "#F3F6F8",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },
                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawTicks: false,
                            drawBorder: false,
                        },
                        ticks: {
                            padding: 35,
                            max: 1200,
                            min: 0,
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: "rgba(143, 146, 161, .1)",
                            zeroLineColor: "rgba(143, 146, 161, .1)",
                        },
                        ticks: {
                            padding: 20,
                        },
                    }, ],
                },
            },
        });
        // =========== chart two end
    </script>
@endsection
