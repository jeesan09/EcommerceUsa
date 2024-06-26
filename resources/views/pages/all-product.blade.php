@extends('layouts.fontend-master')
@section('product')
    active
@endsection
@section('product_list')
    all-product-list
@endsection
<style>
    .section-height {
    height: 60% !important;
    overflow: hidden;
    overflow-y: scroll;
}
</style>
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">All Product</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <aside class="filterOpen d-none d-md-block col-md-3 col-lg-2 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="{{ url()->current() }}" class="sidebar-filter-clear">Clean All</a>
                            </div><!-- End .widget widget-clean -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                        aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3><!-- End .widget-title -->
                                <style>
                                    .category_pro a {
                                        cursor: pointer;

                                    }
                                </style>
                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="">
                                            @foreach ($categoris as $category)
                                            <div class=" product_data d-flex justify-content-between  pr-4">

                                                <div class="category_pro">
                                                    <a href="{{ url('product/category',$category->id) }}" class="text-dark">
                                                        {{ $category->category_name }}
                                                    </a>
                                                    <input type="hidden" id="category_id" value="{{ $category->id }}">
                                                </div><!-- End .custom-checkbox -->
                                                <div>
                                                    @php
                                                        $count_product = App\Product::where('category_name', $category->id)->count();
                                                    @endphp
                                                    <a href="{{ url('product/category',$category->id) }}" class="text-dark">
                                                     <span class="item-count">({{ $count_product }})</span>
                                                  </a>
                                                </div>
                                            </div><!-- End .filter-item -->

                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            {{-- <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-5">

                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" class="input-min" value="500" readonly>
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" class="input-max" value="2000" readonly>
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" id="range_price_left" class="range-min" min="0"
                                            max="2000" value="500" step="50">
                                        <input type="range" id="range_price_right" class="range-max" min="0"
                                            max="2000" value="1200" step="50">
                                    </div>
                                </div>
                                
                             

                            </div> --}}
                            
                            
                            <!-- End .widget -->
                            <hr>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-4">
                                    <div class="">
                                        @foreach ($brands as $brand)
                                            <div class=" product_data d-flex justify-content-between  pr-4">
                                                <div class="category_pro">
                                                    <a  href="{{ url('product/brand',$brand->id) }}" class="text-dark"> {{ $brand->brand_name }}</a>
                                                    <input type="hidden" id="brand_id" value="{{ $brand->id }}">
                                                </div><!-- End .custom-checkbox -->
                                                <div>
                                                    @php
                                                        $count_product = App\Product::where('brand_name', $brand->id)->count();
                                                    @endphp
                                                <a  href="{{ url('product/brand',$brand->id) }}" class="text-dark">
                                                    <span class="item-count">({{ $count_product }})</span>
                                                </a>
                                                </div>

                                            </div><!-- End .filter-item -->
                                        @endforeach
                                    </div><!-- End .filter-items -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                            <style>
                                * {
                                    margin: 0;
                                    padding: 0;
                                    box-sizing: border-box;

                                }

                                .wrapper {
                                    /* width: 400px; */
                                    background: #fff;
                                    border-radius: 10px;
                                    padding: 20px 25px 40px;
                                    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
                                }

                                .price-input {
                                    width: 100%;
                                    display: flex;
                                    margin: 11px 0 15px;
                                    font-size: 18px;
                                }

                                .price-input .field {
                                    display: flex;
                                    width: 100%;
                                    height: 45px;
                                    align-items: center;
                                }

                                .field input {
                                    width: 100% !important;
                                    height: 100% !important;
                                    outline: none;
                                    font-size: 19px;
                                    margin-left: 12px;
                                    border-radius: 5px;
                                    text-align: center;
                                    border: none;
                                }

                                input[type="number"]::-webkit-outer-spin-button,
                                input[type="number"]::-webkit-inner-spin-button {
                                    -webkit-appearance: none;
                                }

                                .price-input .separator {
                                    width: 130px;
                                    display: flex;
                                    font-size: 19px;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .slider {
                                    height: 5px;
                                    position: relative;
                                    background: #ddd;
                                    border-radius: 5px;
                                }

                                .slider .progress {
                                    height: 100%;
                                    left: 28%;
                                    right: 40%;
                                    position: absolute;
                                    border-radius: 5px;
                                    background: #17A2B8;
                                }

                                .range-input {
                                    position: relative;
                                }

                                .range-input input {
                                    position: absolute;
                                    width: 100%;
                                    height: 5px;
                                    top: -5px;
                                    background: none;
                                    pointer-events: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                }

                                input[type="range"]::-webkit-slider-thumb {
                                    height: 17px;
                                    width: 17px;
                                    border-radius: 50%;
                                    background: #17A2B8;
                                    pointer-events: auto;
                                    -webkit-appearance: none;
                                    box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
                                }

                                input[type="range"]::-moz-range-thumb {
                                    height: 17px;
                                    width: 17px;
                                    border: none;
                                    border-radius: 50%;
                                    background: #17A2B8;
                                    pointer-events: auto;
                                    -moz-appearance: none;
                                    box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
                                }

                                .input-spinner .form-control {
                                    padding: 2px;
                                    height: auto;
                                    border-color: #dadada;
                                    background-color: #fff;
                                }
                            </style>

                        </div><!-- End .sidebar sidebar-shop -->
                    </aside>
                    <div class="col-md-9 col-lg-10">
                        <div class="row align-items-center ">
                            <div class="col-4 d-md-none">
                               <button style="min-width: 114px;" title="Filter Products" class="btn btn-sm btn-primary filterBtn">Filters <i class="icon-long-arrow-right"></i></button>
                            </div>
                            <div class="col-8 col-md-12 ">
                                <div class="toolbox">
                                    <div class="toolbox-right">
                                        <div class="toolbox-sort">
                                            <label for="sortby">Sort by:</label>
                                            <div class="select-custom">
                                                <select name="sortby" id="sortby" class="form-control">
                                                    <option id="high_peice" value="high_peice" selected="selected">High Price
                                                    </option>
                                                    <option id="low_price"value="low_price">Lowest Price</option>
                                                    <option id="date" value="date">Date</option>
                                                </select>
                                            </div>
                                        </div><!-- End .toolbox-sort -->
                                    </div><!-- End .toolbox-right -->
                                </div>    
                            </div>
                        </div><!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @foreach ($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3 product_data">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-new">New</span>
                                                <a href="{{ route('product.details', $product->id) }}">
                                                @php $firstImage = true; @endphp
                                                @foreach ($product->product_varient as $product_varient)
                                                    @if ($firstImage)
                                                        <img src="{{ asset($product_varient->image) }}"
                                                            alt="{{ $product->product_name }}" class="product-image">
                                                        @php
                                                            $firstImage = false;
                                                            $price = $product_varient->price;
                                                        @endphp
                                                    @else
                                                        <img src="{{ asset($product_varient->image) }}" alt=""
                                                            class="product-image-hover">
                                                    @endif
                                                @endforeach
                                            </a>
                                           {{--  <div class="product-action-vertical">
                                                <a href="{{ url('add/wishlist/' . $product->id) }}"
                                                    class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                            </div> --}}
                                                <div class="product-action">
                                                   <!--  <a class="btn-product btn-cart cart_btn_click" href="#product_details"
                                                        data-toggle="modal"><span>BUY NOW</span></a> -->
                                                    <input type="hidden" class="product_input_id"
                                                        value="{{ $product->id }}">
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                            <h3 class="product-title"><a
                                                    href="{{ route('product.details', $product->id) }}">{{ $product->product_name }}
                                                </a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                               ${{ number_format($price, 2) }}
                                            </div>
                                        </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div>
                                @endforeach

                            </div><!-- End .row -->
                            <style>
                                .pagination nav {
                                    border: 1px solid #f3d7bb;
                                    padding: 5px 8px;
                                    border-radius: 2px;
                                }
                            </style>

                            <nav aria-label="Page navigation all-product">
                                <ul class="pagination justify-content-center">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div><!-- End .products -->


                    </div><!-- End .col-lg-9 -->
                    <!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
        <style>
            .modal-dialog1 {
                max-width: 1024px !important;
                margin: 0 auto !important;
            }
        </style>
        {{-- ============================== Product Details Modal Ajax start ============================================  --}}
        <div class="modal  search-result add_to_cart_modal_close" id="product_details" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="search-result">
                @include('pages.search_result')
            </div>
        </div>
        {{-- ============================== Product Details Modal Ajax END ============================================  --}}

 {{--        <script src="{{ asset('frotend') }}/assets/js/price_range.js"></script> --}}

    </main>
    
@endsection
