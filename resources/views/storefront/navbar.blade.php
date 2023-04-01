<div>

    <div class="container-fluid" style="background: #181616">
        <div class="top-nav container d-flex justify-content-between align-items-center">

            <div class="top-nav-social-links mt-2">
                <a href="https://www.facebook.com/DongDigitalPhotoshop/" target="_blank"><i
                        class="fa-brands fa-facebook pe-1"></i></a>
                <a href="https://www.instagram.com/dongrelox/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>

            <div class="top-nav-items d-flex justify-content-between align-items-center my-2">
                @auth
                    <?php
                    // $cart_item_count = DB::table('carts')
                    //     ->where('user_id', Auth::user()->id)
                    //     ->where('inPayment', false)
                    //     ->count();
                    $cart_item_count = 0;
                    ?>

                    <div class="d-flex flex-column align-self-center mx-3 my-2">
                        <a class="nav-account" href="/account/dashboard" role="button">
                            <i class="far fa-circle-user me-1"></i> Account
                        </a>
                    </div>

                    <div class="d-flex flex-column align-self-center">
                        <a class="position-relative" href="/cart" role="button">
                            <i class="fas fa-cart-shopping" style="font-size:1rem;"></i>
                            <span
                                class="position-absolute top-0 start-100 badge bg-danger border-light rounded-circle">{{ $cart_item_count }}</span>
                        </a>
                    </div>
                @else
                    <div class="d-flex flex-column align-self-center mx-3 my-2">
                        <a class="auth-links text-decoration-none" href="/login">Login</i></a>
                    </div>
                    <div class="d-flex flex-column align-self-center">
                        <a class="auth-links text-light text-decoration-none" href="/register">Sign
                            Up</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="container-fluid nav-shadow">
        <div class="container mt-2 ">
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('images/logo/samj-logo.png') }}" alt="" width="200">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon" style="color: #fff;"></span>
                        {{-- <span class="navbar-toggler-icon" style="color: #fff;"><i class="fa-solid fa-bars"></i></span> --}}
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav navbar-nav-custom me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                                    href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('menu') ? 'active' : '' }}" href="/menu">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('about-us') ? 'active' : '' }}"
                                    href="/about-us">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}"
                                    href="/contact-us">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
