@extends('layouts.fontend-master')
@section('product_list')
@foreach ($product_details as $productOnly)
{{ $productOnly->product_slug }}
@endforeach
@endsection
<link rel="stylesheet" href="{{asset('frotend') }}/assets/css/details_page.css">

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products Details</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <style>
        .details-action-wrapper .btn-product {
            padding: 7px 64px;
        }
    </style>
    @foreach ($product_details as $products)
    <div class="page-content">
        <div class="container">
            <div class="product-details-top product_data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    @foreach ($products->product_varient as $product)
                                    <img id="product-zoom" src="{{ asset($product->image) }}" data-zoom-image="{{ asset($product->image) }}" alt="{{ $product->product_name }}">
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                    @break
                                    @endforeach
                                </figure>

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($products->product_varient as $product)
                                    <a class="product-gallery-item" href="#" data-image="{{ asset($product->image) }}" data-zoom-image="{{ asset($product->image) }}">
                                        <img src="{{ asset($product->image) }}" alt=" ">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <form action="{{ route('buynow.product') }}" method="post">
    @csrf
    <style>
        .initial_d_none {
            display: none;
        }
    </style>
    <div class="product-details">
        <h1 class="product-title">{{ $productOnly->product_name }}</h1>
        @foreach ($products->product_varient as $product)
        <div class="product-price initial_d_none product_id_{{ $product->id }}">
            <span>&#2547; </span> &nbsp; {{ number_format($product->price, 2) }}
        </div>
        @endforeach
        <div class="product-content">
            <label for="condition">Condition:</label>
            <div class="section over-hide z-bigger">
                <div class="container">
                    <div class="row">
                        <div class="col-12 p-0">
                            @php
                            $first_value = true;
                            @endphp
                            @foreach ($products->product_varient as $product)
                            <input class="checkbox-tools product_id_{{ $product->id }}" type="radio" name="condition" value="{{$product->id}}" id="condition-tool-{{$product->id}}" @if ($first_value) checked @endif>
                            @php
                            $first_value = false;
                            @endphp
                            <label class="for-checkbox-tools" for="condition-tool-{{$product->id}}">
                                {{ $product->condition}}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="details-filter-row mb-0 details-row-size">
                <div class="product-nav-thumbs">
                    <label for="product_color">Color:</label>
                    <select name="product_color" id="product_color" required class="form-control product_id_{{ $product->id }}">
                        @foreach ($product_details->flatMap->product_varient->flatMap->colors as $colorNew)
                        <option value="{{ $colorNew->id }}">
                            {{ $colorNew->color_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="error_msg text-danger ml-5"> </div>
            </div>

            <label class="mb-0" for="size">Storage:</label>
            <div class="section over-hide z-bigger">
                <div class="container">
                    <div class="row">
                        <div class="col-12 p-0">
                            @php
                            $first_value = true;
                            @endphp
                            @foreach ($products->product_varient as $product)
                            <input class="checkbox-tools2" type="radio" name="storage" value="{{$product->id}}" id="storage-tool-{{$product->id}}" @if ($first_value) checked @endif>
                            <label class="for-checkbox-tools" for="storage-tool-{{$product->id}}">{{ $product->storage }}</label>
                            @php
                            $first_value = false;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-details-action">
                <div class="qty-container">
                    <button class="qty-btn-minus btn-light" type="button"><i class="icon-minus"></i></button>
                    <input type="text" name="qty" value="0" class="input-qty" />
                    <button class="qty-btn-plus btn-light" type="button"><i class="icon-plus"></i></button>
                </div>
                <div class="details-action-wrapper">
                    <button class="btn-product btn-cart add_to_cart"><span>Add To Cart</span></button>
                    <input type="hidden" id="product_id" value="{{ $product->id }}">
                </div>
            </div>
        </div>
    </div>
</form>


                        <div class="product-details-tab">
                            <h6 class="p-0 m-0">Product Detail</h6>
                            <hr class="m-0">
                            <div class="product-detail-content" style="height: 554px;">
                                <div class="product-detail-content-inner expanded" style="max-height: none; overflow: hidden;">

                                    <ul>
                                        <li>Originally released September 2019</li>
                                        <li>Unlocked, Nano-SIM and/or Electronic SIM card, Model A2111</li>
                                        <li>6.1-inch Liquid Retina HD display</li>
                                        <li>A13 Bionic chip 6-core CPU with 2 performance and 4 efficiency cores</li>
                                        <li>Video playback: Up to 17 hours</li>
                                        <li>
                                            <span data-mce-fragment="1">4G LTE</span>, Gigabit LTE and 802.11ax Wi‑Fi with 2x2 MIMO
                                        </li>
                                        <li>Bluetooth 5.0 wireless technology</li>
                                        <li>NFC with reader mode</li>
                                        <li>Dual 12MP Wide and Ultra Wide cameras</li>
                                        <li>Digital zoom up to 5x</li>
                                        <li>4K video recording, 1080p HD video recording</li>
                                        <li>Face ID</li>
                                        <li>Siri</li>
                                        <li>Apple Pay</li>
                                        <li>6.84 ounces and 0.33 inch</li>
                                        <li>For USA, Canada, Puerto Rico, U.S. Virgin Islands</li>
                                    </ul>

                                </div>

                                <div class="toggle-read-more">Read Less</div>

                            </div>
                        </div><!-- End .product-details-tab -->


                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
            @endforeach
        </div>
    </div>

</main>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script>
    var buttonPlus = $(".qty-btn-plus");
    var buttonMinus = $(".qty-btn-minus");

    var incrementPlus = buttonPlus.click(function() {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        $n.val(Number($n.val()) + 1);
    });

    var incrementMinus = buttonMinus.click(function() {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        var amount = Number($n.val());
        if (amount > 0) {
            $n.val(amount - 1);
        }
    });

    $(document).ready(function () {
        // Initially display the price of the first selected condition
        var selectedProductId = $('input[type=radio][name=condition]:checked').val();
        var priceElement = $('.product-price.product_id_' + selectedProductId);
        if (priceElement.length > 0) {
            $('.product-price').hide(); // Hide all product prices
            priceElement.show(); // Show the price of the initially selected condition
            $('#product_price').val(priceElement.text().trim()); // Update the hidden input field
        }

        // Handle change event of condition radio buttons
        $('input[type=radio][name=condition]').change(function () {
            var selectedProductId = $(this).val();
            var priceElement = $('.product-price.product_id_' + selectedProductId);
            if (priceElement.length > 0) {
                $('.product-price').hide(); // Hide all product prices
                priceElement.show(); // Show the price of the selected condition
                $('#product_price').val(priceElement.text().trim()); // Update the hidden input field
            }
        });

        // Handle change event of color select
        $('#product_color').change(function () {
            var selectedOption = $(this).find(':selected');
            var classes = selectedOption.attr('class');
            if (classes) {
                var productId = classes.split('product_id_')[1];
                var priceElement = $('.product-price.product_id_' + productId);
                if (priceElement.length > 0) {
                    $('.product-price').hide(); // Hide all product prices
                    priceElement.show(); // Show the price of the selected condition
                    $('#product_price').val(priceElement.text().trim()); // Update the hidden input field
                }
            }
        });
    });
$('.product-price').removeClass('.initial_d_none');
</script>
@endsection