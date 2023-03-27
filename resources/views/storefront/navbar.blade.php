<div style="background: light-gray">

    <div class="top-nav container d-flex justify-content-between align-items-center">

        <div class="top-nav-social-links mt-3">
            <a href="https://www.facebook.com/DongDigitalPhotoshop/" target="_blank"><i
                    class="fa-brands fa-facebook pe-1"></i></a>
            <a href="https://www.instagram.com/dongrelox/" target="_blank"><i
                    class="fa-brands fa-instagram"></i></a>
        </div>

        <div class="top-nav-items d-flex justify-content-between align-items-center mt-3">
            @auth
                <?php
                // $cart_item_count = DB::table('carts')
                //     ->where('user_id', Auth::user()->id)
                //     ->where('inPayment', false)
                //     ->count();
                $cart_item_count = 0;
                ?>
                
                <a class="nav-account pe-4" href="/account/dashboard" role="button">
                    <i class="far fa-circle-user me-1"></i>Account
                </a>

                <a class="position-relative" href="/cart" role="button">
                    <i class="fa-solid fa-bag-shopping" style="font-size:1.8rem;"></i>
                    <span
                        class="badge position-absolute top-50 start-100 translate-middle bg-dark border rounded-circle">{{ $cart_item_count }}</span>
                </a>

            @else
                <div class="d-flex flex-column align-self-end mx-3 mt-3">
                    <a class="auth-links text-decoration-none" href="/login"><i class="fa-regular fa-circle-user me-1"
                            style="font-size:0.85rem;"></i>&nbsp;Login</a>
                </div>
                <div class="d-flex flex-column align-self-end mt-3">
                    <a class="auth-links text-light text-decoration-none" href="/register">Sign
                        Up</a>
                </div>
            @endauth
        </div>

    </div>

    <div class="container mt-3">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/logo/samj-logo.png') }}" alt="" width="200">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="color: #fff;"><i class="fa-solid fa-bars"></i></span>
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