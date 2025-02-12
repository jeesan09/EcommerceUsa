<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('product_list')</title>
    @php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    @endphp
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frotend/assets/images/icons/favicon-32x32.png')}}">
    <meta name="apple-mobile-web-app-title" content="mpwrenewed.com">
    <meta name="application-name" content="mpwrenewed.com">
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- SEO Meta Tags -->

    <meta name="keywords" content="website,mpwrenewed , mobile wholesale,apple, samsung, Wholesale Mobile">
    <meta name="author" content="mpwrenewed">
    <meta name="title" content="mpwrenewed">
    <meta name="description" content="Mpw wholesale, 3141 amity ct suite 300, charlotte nc 28215, Office number 704-579-3971, sales@megaphonewholesale.comM-F: 9AM - 6PM (EST), Sat: closed, Sun: Closed">
    <meta property="og:title" content="mpwrenewed">
    <meta property="og:description" content="Mpw wholesale, 3141 amity ct suite 300, charlotte nc 28215, Office number 704-579-3971, sales@megaphonewholesale.comM-F: 9AM - 6PM (EST), Sat: closed, Sun: Closed">
    <meta property="og:image" content="{{ asset('frotend/websiteLogo/meta.jpg')}}">
    <meta property="og:url" content="https://mpwrenewed.com">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="mpwrenewed">
    <!-- Twitter Card Meta Tags -->
    {{-- <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MPWholesale">
    <meta name="twitter:description" content="Your brief description for Twitter.">
    <meta name="twitter:image" content="{{ asset('frotend') }}/websiteLogo/meta.jpg }}">
    <meta name="twitter:site" content="@mpwholesale"> --}}

    <!-- LinkedIn Meta Tags (Open Graph tags are typically sufficient, but adding specific LinkedIn tags can help) -->
    {{-- <meta property="linkedin:card" content="summary_large_image">
    <meta property="linkedin:title" content="MPWholesale">
    <meta property="linkedin:description" content="Your brief description for LinkedIn.">
    <meta property="linkedin:image" content="{{ asset('frotend') }}/websiteLogo/meta.jpg }}"> --}}

    <!-- Pinterest Meta Tags -->
    {{-- <meta name="pinterest-rich-pin" content="false">
    <meta name="pinterest:title" content="MPWholesale">
    <meta name="pinterest:description" content="Your brief description for Pinterest.">
    <meta name="pinterest:image" content="{{ asset('frotend') }}/websiteLogo/meta.jpg }}"> --}}
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
  <!--   <link rel="stylesheet" href="{{ asset('frotend/assets/css/plugins/magnific-popup/magnific-popup.css') }}"> -->
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frotend/assets/css/style.css') }}">
   <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-1ToqyuMm2I01yQNv5RKTg+ahAxkFESXr40mGgWAtN3rPBo+ZlsEVYVS0RN4AihB5" crossorigin="anonymous"> -->
    <!-- alertify alert er jonno  -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <!-- alertify alert er jonno  -->
    <style>
        .name_logo {
            font-size: 20px;
            font-weight: 700;
            width: 170px;
        }

        @media screen and (max-width: 768px) {

            .cart-dropdown .dropdown-menu,
            .compare-dropdown .dropdown-menu {
                display: block;
                width: 230px;
                margin: 1px 0 0;
                padding: 8px 5px;
            }
            .dropdown-cart-action .btn {
                font-size: 1.1rem;
            }
        }
    </style>
    <meta name="google-site-verification" content="r8K4Po3r3niF7aos1u2_sUkItkVvHe2pTdvaNmp5V8c" />
    {{-- <meta name="google-site-verification" content="Dm5v2045IhsCrRknnn9GvOVnLan_y0hdqgOkgo9YOBM" /> --}}
</head>

<body id="overlay_body">
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container-fluid">
                    <div class="header-right">
                        <ul class="top-menu">
                            <li>
                                <a href="javascript:void(0);">Links</a>
                                <ul>
                                    @php
                                        $logo = App\Websitelogo::find(1);
                                    @endphp
                                    @if (Auth::check())
                                        @php
                                            $count = App\Wishlist::where('user_ip', Auth::user()->id)->count();
                                        @endphp
                                        <li><a href="{{ url('/my-profile') }}"><i class="icon-user"></i>My Profile</a> </li>
                                    @else
                                        <li><a href="{{ route('login') }}"><i class="icon-user"></i>Login</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle sticky-header">
                <div class="container-fluid">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        <a href="{{ url('/') }}" class="name_logo  d-none d-md-block">
                            @if (isset($logo->header_logo))
                                <img src="{{ asset($logo->header_logo) }}" height="auto" alt="{{$logo->header_logo}}">
                            @else
                                MPW RENEWED
                            @endif
                        </a>
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container @yield('home')">
                                    <a href="{{ url('/') }}" class="">Home</a>
                                </li>
                                <li class=" @yield('product')">
                                    <a href="{{ route('all.product') }}">Product</a>
                                </li>
                                <li class=" @yield('about')">
                                    <a href="{{ route('about.page') }}">About</a>
                                </li>
                                <li class=" @yield('contact')">
                                    <a href="{{ route('contact.page') }}">Contact</a>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->
                    <div class="header-right">
                        <form action="{{ route('search.product') }}" method="get">
                            @csrf
                            <div class="header-search ">
                                <div class="header-search-wrapper d-flex show">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="search_product" id="q"
                                        placeholder="Search in..." required>
                                </div>
                                <div>
                                    <button class="search-toggle1"><i class="icon-search"></i></button>
                                </div>
                            </div><!-- End .header-search -->
                        </form>
                        @if (Auth::check())
                            @php
                                $qty = App\Cart::all()
                                    ->where('user_ip', Auth::user()->id)
                                    ->count();
                                $url = url()->current();
                                $path = parse_url($url, PHP_URL_PATH);
                                $trimmedPath = trim($path, '/');
                            @endphp

                            <div class="dropdown cart-dropdown" id="cart_realaod">
                                @if ($trimmedPath != 'checkout')
                                    <a href="" onclick="openNav()" class="dropdown-toggle" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        data-display="static">
                                        <i class="icon-shopping-cart"></i>
                                        <span class="cart-count"> {{ $qty }}</span>
                                    </a>
                                @else
                                @endif
                            </div><!-- End .header-right -->
                        @endif
                    </div><!-- End .container -->
                </div><!-- End .header-middle -->
        </header><!-- End .header -->

        @yield('content')
        <div id="overlay" onclick="closeNav()"></div>
        <footer class="footer footer-dark">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="widget widget-about">
                                {{--    @if (isset($logo->footer_logo))
                                <img src="{{ asset($logo->footer_logo) }}" alt="" class="name_logo" alt="Footer Logo">
                                @else
                                <h2 class="text-white name_logo"> MPW Renewed</h2>
                            @endif --}}
                                <p class="text-light">Mpw renewed inc 3141 amity ct suite 300 charlotte nc 28215 </p>
                                <p class="text-light">Office Number: 704-579-3971</p>
                                <p class="text-light">Office Email: sales@mpwrenewed.com</p>
                                <p class="text-light">M-F: 9AM - 6PM (EST)</p>
                                <p class="text-light">Sat: closed </p>
                                <p class="text-light">Sun: Closed </p>
                                <div class="social-icons">
                                    <a href="https://www.facebook.com" class="social-icon" title="Facebook" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-facebook-f"></i>
                                    </a>
                                    <a href="https://www.twitter.com" class="social-icon" title="Twitter" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="https://www.instagram.com" class="social-icon" title="Instagram" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-instagram"></i>
                                    </a>
                                    <a href="https://www.youtube.com" class="social-icon" title="Youtube" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-youtube"></i>
                                    </a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                        <div class="col-sm-4 col-lg-4">
                            <div class="widget">
                                <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->
                                <ul class="widget-list">
                                    <li><a href="{{ route('about.page') }}">About Us</a></li>
                                    <li><a href="/">How to shop </a></li>
                                    <li><a href="{{ route('contact.page') }}">Contact us</a></li>
                                    {{-- <li><a href="{{ url('/login') }}">Log in</a></li> --}}
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-4 col-lg-4">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4><!-- End .widget-title -->
                                <ul class="widget-list">
                                    <li><a href="{{ url('/login') }}">Sign In</a></li>
                                    <li><a href="{{ url('/my-profile') }}">Track My Order</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->
            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">Copyright © @php
                        echo date('Y');
                    @endphp <a  href="{{ url('/') }}" class="text-light fs-4"
                           > Developed
                            by : MPW-Renewed</a></p>
                    <figure class="footer-payments">
                        <img src="{{ asset('frotend/assets/images/payments.png') }}" alt="Payment methods"
                            width="272" height="20">
                    </figure><!-- End .footer-payments -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            <form action="{{ route('search.product') }}" method="get"class="mobile-search">
                @csrf
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control"name="search_product" id="mobile-search"
                    placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('all.product') }}"> Product</a>
                    </li>
                    <li><a href="{{ route('about.page') }}">About Us</a></li>
                    <li><a href="{{ route('contact.page') }}">Contact us</a></li>
                    @if (Auth::check())
                        <li><a href="{{ url('my-profile/') }}"><i class="icon-user"></i>My Profile</a></li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="icon-user"></i>Login</a></li>
                    @endif
                </ul>
            </nav><!-- End .mobile-nav -->
            <div class="social-icons">
                <a href="https://www.facebook.com" class="social-icon" title="Facebook" target="_blank" rel="noopener noreferrer">
                    <i class="icon-facebook-f"></i>
                </a>
                <a href="https://www.twitter.com" class="social-icon" title="Twitter" target="_blank" rel="noopener noreferrer">
                    <i class="icon-twitter"></i>
                </a>
                <a href="https://www.instagram.com" class="social-icon" title="Instagram" target="_blank" rel="noopener noreferrer">
                    <i class="icon-instagram"></i>
                </a>
                <a href="https://www.youtube.com" class="social-icon" title="Youtube" target="_blank" rel="noopener noreferrer">
                    <i class="icon-youtube"></i>
                </a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->
    <!-- alertify alert er jonno  -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- alertify alert er jonno  -->
    <script>
        @if (session('success'))
            alertify.set('notifier', 'position', 'top-right');
            alertify.success(
                '<strong class=" d-flex align-items-center justify-content-start">&nbsp; <i class="icon ion-ios-checkmark d-flex align-items-center font_size"></i> {{ session('success') }}</strong>'
            );
        @endif
        @if (session('success_delete'))
            alertify.set('notifier', 'position', 'top-right');
            alertify.warning(
                '<strong class="text-danger d-flex align-items-center justify-content-start">&nbsp; <i class="icon ion-ios-checkmark d-flex align-items-center font_size"></i> {{ session('success_delete') }}</strong>'
            );
        @endif
        @if (session('warning'))
            alertify.set('notifier', 'position', 'top-right');
            alertify.warning(
                '<strong class="text-danger d-flex align-items-center justify-content-start">&nbsp; <i class="icon ion-ios-checkmark d-flex align-items-center font_size"></i> {{ session('warning') }}</strong>'
            );
        @endif
    </script>

    <!-- alertify alert er jonno  -->

    <!-- Plugins JS File -->
    <script src="{{ asset('frotend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frotend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--     <script src="{{ asset('frotend/assets/js/jquery.hoverIntent.min.js') }}"></script> -->
    <!-- <script src="{{ asset('frotend/assets/js/superfish.min.js') }}"></script> -->
    <script src="{{ asset('frotend/assets/js/owl.carousel.min.js') }}"></script>
   <!--  <script src="{{ asset('frotend/assets/js/jquery.magnific-popup.min.js')}}"></script> -->
    <!-- <script src="{{ asset('frotend/assets/js/imagesloaded.pkgd.min.js')}}"></script> -->
 <!--    <script src="{{ asset('frotend/assets/js/isotope.pkgd.min.js')}}"></script> -->
    <script src="{{ asset('frotend/assets/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{ asset('frotend/assets/js/jquery.waypoints.min.js')}}"></script>
<!--     <script src="{{ asset('frotend/assets/js/bootstrap-input-spinner.js')}}"></script> -->
    <script src="{{ asset('frotend/assets/js/main.js')}}"></script>

</body>
@include('layouts.ajax.ajax')
@include('layouts.sidebar-right.index')
<script>
    function openNav() {
        $('#mySidenav').addClass('card-width');
        document.getElementById("overlay").style.display = "block";
        document.body.style.overflow = "hidden";
        $.ajax({
            type: 'get',
            url: "/product-cart-list",
            success: function(response) {
                $('.cartContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function closeNav() {
        $('#mySidenav').removeClass('card-width');
        document.getElementById("overlay").style.display = "none";
        document.body.style.overflow = "";
    }

    $('.filterBtn').on("click", function() {
        $('.filterOpen').removeClass('d-none');
        $('.filterBtn').addClass('d-none');
    });

    $('#viewInvoice').on("click", function() {
        var printContents = document.querySelector('.invoicePrint').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    });
</script>

</html>
