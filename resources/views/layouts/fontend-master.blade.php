<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('product_list')</title>
    @php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
       
    @endphp

    <meta name="keywords" content="mpwrenewed.com" >
    <meta name="description" content="mpwrenewed.com">
    <meta name="author" content="mpwrenewed.com">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frotend') }}/assets/images/icons/favicon-32x32.png">
    <meta name="apple-mobile-web-app-title" content="mpwrenewed.com">
    <meta name="application-name" content="mpwrenewed.com">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frotend') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frotend') }}/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('frotend') }}/assets/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frotend') }}/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-1ToqyuMm2I01yQNv5RKTg+ahAxkFESXr40mGgWAtN3rPBo+ZlsEVYVS0RN4AihB5" crossorigin="anonymous">

    <!-- alertify alert er jonno  -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <!-- alertify alert er jonno  -->


</head>

<body id="overlay_body">
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container-fluid">
                    <div class="header-right">
                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    @php
                                        $logo = App\Websitelogo::find(1);
                                    @endphp
                                    @if (Auth::check())
                                        @php
                                            $count = App\Wishlist::where('user_ip', Auth::user()->id)->count();
                                            /*   $count_order = App\Order::where('user_id', Auth::user()->id)->count(); */
                                          

                                        @endphp
                                        {{--   @if ($count_order > 0)
                                        <li><a href="{{ url('/buynow/order-complate') }}"><i class="icon-heart-o"></i>My
                                            Order <span>({{ $count_order }})</span></a></li>
                                        @endif
                                        <li><a href="{{ url('wishlist/page') }}"><i class="icon-heart-o"></i>My Wishlist
                                        <span>({{ $count }})</span></a></li> --}}
                                        <li><a href="{{ url('my-profile/') }}"><i class="icon-user"></i>My Profile</a>
                                        </li>
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
                        <style>
                            .name_logo {
                                font-size: 34px;
                                font-weight: 700;
                                width: 170px;
                            }
                          
                        </style>
                        <a href="{{url('/')}}" class="name_logo  d-none d-md-block">
                            @if ($logo->header_logo != '')
                            <img src="{{ asset($logo->header_logo) }}" height="auto" alt="" >
                            @else
                            MPW WHOLESALE
                       @endif
                        </a>
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container @yield('home')">
                                    <a href="{{ url('/') }}" class="">Home</a>
                                </li>
                                <li class=" @yield('product')">
                                    <a href="{{ route('all.product') }}" >Product</a>
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
                                </div><!-- End .header-search-wrapper -->
                                <div >
                                    <button class="search-toggle1"><i class="icon-search"></i></button>
                                </div>
                            </div><!-- End .header-search -->
                        </form>
                        <style>
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

                        @if(Auth::check())
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
                                <a href="#" onclick="openNav()" class="dropdown-toggle" role="button"
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
                                {{-- @if ($logo->footer_logo != '')
                                <img src="{{ asset($logo->footer_logo) }}" alt="" class="footer-logo" alt="Footer Logo" width="135" height="25">
                                @else
                                <h2 class="text-white"> SellsPoints</h2>
                           @endif --}}
                                <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate
                                    magna eros eu erat. </p>

                                <div class="social-icons">
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                            class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                            class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Youtube" target="_blank"><i
                                            class="icon-youtube"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                            class="icon-pinterest"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-4 col-lg-4">
                            <div class="widget">
                                <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="{{ url('/about/page') }}">About Us</a></li>
                                    <li><a href="#">How to shop </a></li>
                                    <li><a href="{{ url('/contact/page') }}">Contact us</a></li>
                                    {{-- <li><a href="{{ url('/login') }}">Log in</a></li> --}}
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-4 col-lg-4">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4><!-- End .widget-title -->
                                <ul class="widget-list">
                                    <li><a href="{{ url('/login') }}">Sign In</a></li>
                                    <li><a href="{{ url('/shopping/cart/list') }}">View Cart</a></li>
                                    <li><a href="{{ url('/wishlist/page') }}">My Wishlist</a></li>
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
                    @endphp <a class="text-light fs-4"
                            href="{{ url('/') }}"> Developed
                            by : MPW-Wholesale</a></p><!-- End .footer-copyright -->
                    <figure class="footer-payments">
                        <img src="{{ asset('frotend') }}/assets/images/payments.png" alt="Payment methods"
                            width="272" height="20">
                    </figure><!-- End .footer-payments -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top" style="background: #c96"><i class="icon-arrow-up"></i></button>

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
                        <a href="{{ url('/all-product') }}"> Product</a>
                    </li>
                    {{--  @if ($count_order > 0)
                        <li><a href="{{ url('/buynow/order-complate') }}"><i class="icon-shopping-cart"></i>My Order
                                <span>({{ $count_order }})</span></a>
                        </li>
                    @endif
                    <li><a href="{{ url('wishlist/page') }}"><i class="icon-heart-o"></i>My Wishlist
                            <span>({{ $count }})</span></a></li>  --}}

                    <li><a href="{{ url('/about/page') }}">About Us</a></li>
                    <li><a href="{{ url('/contact/page') }}">Contact us</a></li>
                    @if (Auth::check())
                        <li><a href="{{ url('my-profile/') }}"><i class="icon-user"></i>My Profile</a></li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="icon-user"></i>Login</a></li>
                    @endif
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i
                        class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i
                        class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i
                        class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i
                        class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- End .modal -->

    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{asset('frotend') }}/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{asset('frotend') }}/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
    <script src="{{ asset('frotend') }}/assets/js/jquery.min.js"></script>

    <script src="{{ asset('frotend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frotend') }}/assets/js/jquery.hoverIntent.min.js"></script>

    <script src="{{ asset('frotend') }}/assets/js/superfish.min.js"></script>
    <script src="{{ asset('frotend') }}/assets/js/owl.carousel.min.js"></script>

    {{-- <script src="{{asset('frotend') }}/assets/js/wNumb.js"></script> --}}
    {{-- <script src="{{asset('frotend') }}/assets/js/nouislider.min.js"></script> --}}


    <script src="{{ asset('frotend') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('frotend') }}/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('frotend') }}/assets/js/isotope.pkgd.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('frotend') }}/assets/js/jquery.elevateZoom.min.js"></script>
    <script src="{{ asset('frotend') }}/assets/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('frotend') }}/assets/js/bootstrap-input-spinner.js"></script>

    <script src="{{ asset('frotend') }}/assets/js/main.js"></script>

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
            url: "/product/cart-list/",
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
</script>
<script>
    $('.filterBtn').on("click", function(){
             $('.filterOpen').removeClass('d-none');
             $('.filterBtn').addClass('d-none');
         });
       
 </script>
</html>
