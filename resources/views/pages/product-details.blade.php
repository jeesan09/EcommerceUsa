@extends('layouts.fontend-master')
@section('product_list')
    @foreach ($product_details as $productOnly)
        {{ $productOnly->product_slug }}
    @endforeach
@endsection

<style>
    :root {
        --white: #ffffff;
        --light: #f0eff3;
        --black: #000000;
        --dark-blue: #1f2029;
        --dark-light: #353746;
        --red: #da2c4d;
        --yellow: #f8ab37;
        --grey: #ecedf3;
    }

    ::selection {
        color: var(--white);
        background-color: var(--black);
    }

    ::-moz-selection {
        color: var(--white);
        background-color: var(--black);
    }

    [type="checkbox"]:checked,
    [type="checkbox"]:not(:checked),
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
        width: 0;
        height: 0;
        visibility: hidden;
    }

    .checkbox-tools:checked+label,
    .checkbox-tools:not(:checked)+label,
    .checkbox-tools2:checked+label,
    .checkbox-tools2:not(:checked)+label {
        position: relative;
        display: inline-block;
        padding: 17px;

        font-size: 18px;
        line-height: 0px;
        letter-spacing: 1px;
        margin: 0 auto;
        margin-left: 0px;
        margin-right: 5px;
        margin-bottom: 8px;
        text-align: center;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        text-transform: uppercase;
        color: var(--white);
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }

    .checkbox-tools:not(:checked)+label,
    .checkbox-tools2:not(:checked)+label {
        background-color: var(--dark-light);
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    }

    .checkbox-tools:checked+label,
    .checkbox-tools2:checked+label {
        background-color: transparent;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .checkbox-tools:not(:checked)+label:hover,
    .checkbox-tools2:not(:checked)+label:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .checkbox-tools:checked+label::before,
    .checkbox-tools:not(:checked)+label::before,
    .checkbox-tools2:checked+label::before,
    .checkbox-tools2:not(:checked)+label::before {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 4px;
        background-image: linear-gradient(298deg, var(--red), var(--yellow));
        z-index: -1;
    }

    .checkbox-tools:checked+label .uil,
    .checkbox-tools:not(:checked)+label .uil,
    .checkbox-tools2:checked+label .uil,
    .checkbox-tools2:not(:checked)+label .uil {
        font-size: 24px;
        line-height: 24px;
        display: block;
        padding-bottom: 10px;
    }

    .checkbox:checked~.section .container .row .col-12 .checkbox-tools:not(:checked)+label,
    .checkbox:checked~.section .container .row .col-12 .checkbox-tools2:not(:checked)+label {
        background-color: var(--light);
        color: var(--dark-blue);
        box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
    }

    button:focus,
    input:focus {
        outline: none;
        box-shadow: none;
    }

    a,
    a:hover {
        text-decoration: none;
    }

    /*--------------------------*/
    .qty-container {
        display: flex;
        /*  align-items: center;
        justify-content: center; */
    }

    .qty-container .input-qty {
        text-align: center;
        padding: 6px 10px;
        border: 1px solid #d4d4d4;
        max-width: 80px;
    }

    .qty-container .qty-btn-minus,
    .qty-container .qty-btn-plus {
        border: 1px solid #d4d4d4;
        padding: 10px 13px;
        font-size: 10px;
        height: 40px;
        width: 43px;
        transition: 0.3s;
    }

    .qty-container .qty-btn-plus {
        margin-left: -1px;
    }

    .qty-container .qty-btn-minus {
        margin-right: -1px;
    }


    /*---------------------------*/
    .btn-cornered,
    .input-cornered {
        border-radius: 4px;
    }

    .btn-rounded {
        border-radius: 50%;
    }

    .input-rounded {
        border-radius: 50px;
    }
</style>


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
                                                <img id="product-zoom" src="{{ asset($product->image) }}"
                                                    data-zoom-image="{{ asset($product->image) }}"
                                                    alt="{{ $product->product_name }}">
                                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                    <i class="icon-arrows"></i>
                                                </a>
                                            @break
                                        @endforeach
                                    </figure>

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @foreach ($products->product_varient as $product)
                                            <a class="product-gallery-item" href="#"
                                                data-image="{{ asset($product->image) }}"
                                                data-zoom-image="{{ asset($product->image) }}">
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

                                <div class="product-details">
                                    <h1 class="product-title">{{ $productOnly->product_name }} dsfsd</h1>
                                    <!-- End .product-title -->
                                    <input type="hidden" name="product_price" id="product_price"
                                        value="{{ $product->product_price }}">
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="{{ $product->id }}">
                                    <div class="product-price">
                                        <span>&#2547;</span> {{ number_format($product->price, 2) }}
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        {!! substr($product->sort_description, 0, 200) !!}
                                        {{-- <p>{{ substr(strip_tags($product->sort_description),0, 200)}}</p> --}}
                                        <label for="condition">Condition:</label>
                                        <div class="section over-hide z-bigger">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12 p-0">
                                                        <input class="checkbox-tools" type="radio" name="condition"
                                                            id="condition-tool-1" checked>
                                                        <label class="for-checkbox-tools"
                                                            for="condition-tool-1">A+</label>
                                                        <input class="checkbox-tools" type="radio" name="condition"
                                                            id="condition-tool-2">
                                                        <label class="for-checkbox-tools"
                                                            for="condition-tool-2">B</label>
                                                        <input class="checkbox-tools" type="radio" name="condition"
                                                            id="condition-tool-3">
                                                        <label class="for-checkbox-tools"
                                                            for="condition-tool-3">C</label>
                                                        <input class="checkbox-tools" type="radio" name="condition"
                                                            id="condition-tool-4">
                                                        <label class="for-checkbox-tools"
                                                            for="condition-tool-4">D</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="details-filter-row mb-0 details-row-size">
                                            <div class=" product-nav-thumbs">
                                                <label>Color:</label>
                                                <select name="product_color" id="product_color" required
                                                    class="form-control">
                                                    @foreach ($product_details->flatMap->product_varient->flatMap->colors as $colorNew)
                                                        <option value="{{ $colorNew->color_name }}">
                                                            {{ $colorNew->color_name }}</option>
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
                                                        <input class="checkbox-tools2" type="radio" name="storage"
                                                            id="storage-tool-4" checked>
                                                        <label class="for-checkbox-tools"
                                                            for="storage-tool-4">128GB</label>
                                                        <input class="checkbox-tools2" type="radio" name="storage"
                                                            id="storage-tool-3">
                                                        <label class="for-checkbox-tools"
                                                            for="storage-tool-3">64GB</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-details-action">
                                            <div class="qty-container">
                                                <button class="qty-btn-minus btn-light" type="button"><i
                                                        class="icon-minus"></i></button>
                                                <input type="text" name="qty" value="0"
                                                    class="input-qty" />
                                                <button class="qty-btn-plus btn-light" type="button"><i
                                                        class="icon-plus"></i></button>
                                            </div>
                                            <div class="details-action-wrapper">

                                                <button class="btn-product btn-cart add_to_cart"><span>Add To
                                                        Cart</span></button>
                                                <input type="hidden" id="product_id" value="{{ $product->id }}">
                                            </div><!-- End .details-action-wrapper -->
                                        </div><!-- End .product-details-action -->
                                    </div><!-- End .product-details -->
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
                              <span data-mce-fragment="1">4G LTE</span>, Gigabit LTE and 802.11ax Wi‑Fi with 2x2 MIMO</li>
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
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
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
</script>
@endsection
