<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'SAM-J K-MART') }}</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.bootstrap5.min.css"> --}}
    
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.3/b-2.3.5/b-html5-2.3.5/b-print-2.3.5/r-2.4.0/datatables.min.css" />
    @vite('resources/sass/app.scss')
</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="{{ route('adminDashboard') }}">
                <img src="{{ asset('images/logo/samj-logo.png') }}" height="85px"alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            @include('admin.layouts.navigation')
        </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    {{-- <i class="lni lni-chevron-left"></i> --}}
                                    <i class="lni lni-chevron-left me-2"></i> {{ __('Menu') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>{{ Auth::guard('admin')->user()->name }}</h6>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down ml-10"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="{{ route('profile.show') }}"> <i class="lni lni-user"></i>
                                            {{ __('My profile') }}</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('adminLogout') }}">
                                            @csrf
                                            <a href="{{ route('adminLogout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="lni lni-exit"></i> {{ __('Logout') }}</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->


    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('js/main.js') }}"></script>
    @vite('resources/js/app.js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <!-- ========= DataTables ======== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.3/b-2.3.5/b-html5-2.3.5/b-print-2.3.5/r-2.4.0/datatables.min.js">
    </script>



    @yield('script')
</body>

</html>
