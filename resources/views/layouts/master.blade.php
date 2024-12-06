<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Fruitkha - Slider Version</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href={{ asset('assets/img/favicon.png') }}>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href={{ asset('assets/css/all.min.css') }}>
    <!-- bootstrap -->
    <link rel="stylesheet" href={{ asset('assets/bootstrap/css/bootstrap.min.css') }}>
    <!-- owl carousel -->
    <link rel="stylesheet" href={{ asset('assets/css/owl.carousel.css') }}>
    {{-- Fruitikha css --}}
    <link rel="stylesheet" href={{ asset('assets/css/fruitikha.css') }}>
    <!-- magnific popup -->
    <link rel="stylesheet" href={{ asset('assets/css/magnific-popup.css') }}>
    <!-- animate css -->
    <link rel="stylesheet" href={{ asset('assets/css/animate.css') }}>
    <!-- mean menu css -->
    <link rel="stylesheet" href={{ asset('assets/css/meanmenu.min.css') }}>
    <!-- main style -->
    <link rel="stylesheet" href={{ asset('assets/css/main.css') }}>
    <!-- responsive -->
    <link rel="stylesheet" href={{ asset('assets/css/responsive.css') }}>

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="/">
                                <img src={{ asset('assets/img/logo.png') }} alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <x-links :active="request()->is('/')"><a href="/">Home</a></x-links>
                                <x-links :active="request()->is('products')"><a href="/products">Products</a></x-links>
                                <x-links :active="request()->is('contact')"><a href="/contact">Contact</a></x-links>
                                <x-links :active="request()->is('about')"><a href="/about">About</a></x-links>
                                <li>
                                    <div class="header-icons">
                                        @auth
                                            <a class="shopping-cart" href="{{route('cart.index')}}"><i
                                                    class="fas fa-shopping-cart"></i>
                                                    @if(request()->is('products') || request()->is('cart'))
                                                        <div class="count">{{count($carts)}}</div>
                                                    @endif
                                                </a>
                                            <div class="dropdown">
                                                    <img class="dropbtn" src="{{asset('storage/' . Auth()->user()->user_img)}}" alt="">
                                                <div class="dropdown-content" id="myDropdown">
                                                    <a href="{{url('user/profile')}}">{{Auth()->user()->username}}</a>
                                                    @if (Auth()->check() && Auth()->user()->status === 'admin')
                                                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                                                    @else
                                                        <a href="{{route('user.dashboard')}}">Dashboard</a>
                                                    @endif
                                                    
                                                    <a href="/logout">
                                                        <form action="{{route('logout')}}" method="post">
                                                            @csrf
                                                            <button class="btn ">Logout</button>
                                                        </form>
                                                    </a>
                                                </div>
                                            </div>
                                        @endauth
                                        @guest
                                            <a class="" href="/login"><i class="fas fa-login"></i>Login</a>
                                            <a class="" href="/register"><i class="fas fa-login"></i>Register</a>
                                        @endguest
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Fresh & Organic</p>
                                <h1>Delicious Seasonal Fruits</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">Fruit Collection</a>
                                    <a href="contact.html" class="bordered-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Fresh Everyday</p>
                                <h1>100% Organic Collection</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">Visit Shop</a>
                                    <a href="contact.html" class="bordered-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Mega Sale Going On!</p>
                                <h1>Get December Discount</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">Visit Shop</a>
                                    <a href="contact.html" class="bordered-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->







    @yield('content')









    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->
    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About us</h2>
                        <p>We are dedicated to providing exceptional products and services that enrich lives and foster
                            community. Our mission is to innovate and inspire, ensuring a sustainable future while
                            prioritizing quality and customer satisfaction. Join us on our journey!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Get in Touch</h2>
                        <ul>
                            <li>44 Cloncollig, Tullamore, Co Offaly, Ireland.</li>
                            <li>lakhtyari.abderrazzak@gmail.com</li>
                            <li>+353831119128</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">Pages</h2>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/product">Products</a></li>
                            <li><a href="/about">about</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="/contact">Contact</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2019 - Abderrazzak lakhtyari, All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src={{ asset('assets/js/jquery-1.11.3.min.js') }}></script>
    <!-- bootstrap -->
    <script src={{ asset('assets/bootstrap/js/bootstrap.min.js') }}></script>
    <!-- count down -->
    <script src={{ asset('assets/js/jquery.countdown.js') }}></script>
    <!-- isotope -->
    <script src={{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}></script>
    <!-- waypoints -->
    <script src={{ asset('assets/js/waypoints.js') }}></script>
    <!-- owl carousel -->
    <script src={{ asset('assets/js/owl.carousel.min.js') }}></script>
    <!-- fruitikha  -->
    <script src={{ asset('assets/js/fruitikha.js') }}></script>
    <!-- magnific popup -->
    <script src={{ asset('assets/js/jquery.magnific-popup.min.js') }}></script>
    <!-- mean menu -->
    <script src={{ asset('assets/js/jquery.meanmenu.min.js') }}></script>
    <!-- sticker js -->
    <script src={{ asset('assets/js/sticker.js') }}></script>
    <!-- main js -->
    <script src={{ asset('assets/js/main.js') }}></script>

</body>

</html>
