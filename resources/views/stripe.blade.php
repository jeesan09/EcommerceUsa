<!DOCTYPE html>
<html>

<head>
    <title>Payment Gateway </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frotend') }}/assets/images/icons/favicon-32x32.png">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frotend') }}/assets/css/bootstrap.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frotend') }}/assets/css/style.css">
        <!-- alertify alert er jonno  -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
        <!-- alertify alert er jonno  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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

        .name_logo {
            font-size: 34px;
            font-weight: 700;
        }

        .search-toggle1 {
            position: relative;
            display: block;
            font-size: 2.4rem;
            line-height: 1;
            min-width: 2.5rem;
            padding: 0.3rem 0.2rem;
            font-weight: 400;
            color: #333;
            text-align: center;
            z-index: 11;
            background: #ffffff1a;
            border: none;
            margin-top: 5px;
            margin-right: 69px;
        }

        .cart-dropdown {
            padding-left: 0px;
            padding-top: 4px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container @yield('home')">
                                    <a href="{{ url('/') }}" class="">Home</a>
                                </li>
                                <li class=" @yield('product')">
                                    <a href="{{ route('all.product') }}" class="sf-with-ul">Product</a>
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
                        <div class="row">
                            <div class="col-6">
                                <div class="header-search1">
                                    <form action="{{ route('search.product') }}" method="get">
                                        @csrf
                                        <div class="header-search-wrapper1 show">
                                            <label for="q" class="sr-only">Search</label>
                                            <input type="search" class="form-control" name="search_product" id="q"
                                                placeholder="Search in..." required>
                                        </div><!-- End .header-search-wrapper -->
                                        <button class="search-toggle1"><i class="icon-search"></i></button>
                                    </form>
                                </div><!-- End .header-search -->
                            </div>
                            <div class="col-6">
                                <div class="dropdown cart-dropdown">
                                    @if (Auth::check())
                                        <a href="{{ url('my-profile/') }}" class="dropdown-toggle" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            data-display="static">
                                            <i class="icon-user"></i> <span style="font-size: 15px;
                                            font-weight: 500;">My Profile</span> 
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"><i class="icon-user"></i>Login</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                    </div><!-- End .container -->
                </div><!-- End .header-middle -->
        </header>
        <style>
            .card-body {
                padding: .4rem 4rem 1.8rem 2.4rem !important;
                border: 1px solid #80808012 !important;
                border-radius: 0 !important;

            }

            .headerStyle {
                border-bottom: 2px solid #c96;
                font-size: 20px;
                font-weight: 400;
                padding-bottom: 5px;
            }
        </style>

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment details</li>
                    </ol>
                </div>
            </nav>

            <div class="container">

                <div class="page-content">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h3 style="text-align: center; margin-bottom:30px;padding-top:20px; ">Payment Gateway
                                </h3>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="py-3 text-center">
                                                    <span class="panel-title headerStyle"> Shipping detail
                                                        information</span>
                                                </div>
                                                <form id="userDetailsForm">
                                                    <div class="form-group">
                                                        <label for="name">Name:</label>
                                                        <input type="text" class="form-control" id="name"
                                                            value="{{ $user->name }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Phone:</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            value="{{ $user->phone }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ $user->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shippingAddress">Shipping Address:</label>
                                                        <input type="text" class="form-control"
                                                            id="shippingAddress"
                                                            value="{{ $user->shipping_address }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-5 ">
                                        <div class="card panel panel-default credit-card-box">
                                            <div class="card-body">
                                                <div class=" py-3 text-center ">
                                                    <span class="panel-title headerStyle">Payment Details</span>
                                                </div>
                                                @if (Session::has('success'))
                                                    <div class="alert alert-success text-center">
                                                        <a href="#" class="close" data-dismiss="alert"
                                                            aria-label="close">×</a>
                                                        <p>{{ Session::get('success') }}</p>
                                                        <p>{{ Session::get('error') }}</p>
                                                    </div>
                                                @endif

                                                <form role="form" action="{{ route('stripe.post') }}"
                                                    method="post" class="require-validation" data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                                                    @csrf


                                                    <!-- Hidden input field for subtotal -->
                                                    <input type="hidden" name="subtotal"
                                                        value="{{ $subtotal }}">

                                                    <!-- Hidden input field for CartData -->
                                                    <input type="hidden" name="cartData"
                                                        value="{{ json_encode($CartData) }}">

                                                    <div class='form-row row'>
                                                        <div class='col-xs-12 form-group required'>
                                                            <label class='control-label'>Name on Card</label> <input
                                                                class='form-control' size='4' type='text'>
                                                        </div>
                                                    </div>

                                                    <div class='form-row row'>
                                                        <div class='col-xs-12 form-group card required'>
                                                            <label class='control-label'>Card Number</label> <input
                                                                autocomplete='off' value="4242 4242 4242 4242"
                                                                class='form-control card-number' size='20'
                                                                type='text'>
                                                        </div>
                                                    </div>

                                                    <div class='form-row row'>
                                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                            <label class='control-label'>CVC</label> <input
                                                                autocomplete='off' class='form-control card-cvc'
                                                                placeholder='ex. 311' size='4' type='text'>
                                                        </div>
                                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                            <label class='control-label'>Expiration Month</label>
                                                            <input class='form-control card-expiry-month'
                                                                placeholder='MM' size='2' type='text'>
                                                        </div>
                                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                            <label class='control-label'>Expiration Year</label> <input
                                                                class='form-control card-expiry-year'
                                                                placeholder='YYYY' size='4' type='text'>
                                                        </div>
                                                    </div>

                                                    <div class='form-row row'>
                                                        <div class='col-md-12 error form-group hide'>
                                                            <div class='alert-danger alert'>Please correct the errors
                                                                and try
                                                                again.</div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <button class="btn btn-primary btn-lg btn-block"
                                                                type="submit">Pay
                                                                Now ( {{ $subtotal }}$ )</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
</body>
    <!-- alertify alert er jonno  -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- alertify alert er jonno  -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // AJAX request to update shipping address
        $('#userDetailsForm').submit(function(event) {

            event.preventDefault();

            var shippingAddress = $('#shippingAddress').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();

            $.ajax({
                url: "{{ route('update.shipping.address') }}",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    shipping_address: shippingAddress,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success('<strong class=" d-flex align-items-center justify-content-start">&nbsp; <i class="icon ion-ios-checkmark d-flex align-items-center font_size"></i> User infrormation has been updated successfully!</strong>');
                  
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error updating User infrormation. Please try again.');
                }
            });
        });
    });


    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>

</html>
