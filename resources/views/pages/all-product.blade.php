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

    .pagination nav {
        border: 1px solid #f3d7bb;
        padding: 5px 8px;
        border-radius: 2px;
    }
    .category_pro a {
        cursor: pointer;

    }
</style>
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->current() }}">All Products</a></li>
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
                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="">
                                            @foreach ($categoris as $category)
                                                <div class=" product_data d-flex justify-content-between  pr-4">
                                                    <div class="category_pro">
                                                        <a href="{{ route('category.products', $category->id) }}"
                                                            class="text-dark">
                                                            {{ $category->category_name }}
                                                        </a>
                                                        <input type="hidden" id="category_id" value="{{ $category->id }}">
                                                    </div><!-- End .custom-checkbox -->
                                                    <div>
                                                        @php  $count_product = App\Product::where('category_name',$category->id)->count();  @endphp
                                                        <a href="{{ route('category.products', $category->id) }}"
                                                            class="text-dark">
                                                            <span class="item-count">({{ $count_product }})</span>
                                                        </a>
                                                    </div>
                                                </div><!-- End .filter-item -->
                                            @endforeach
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

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
                                                    <a href="{{ route('brand.products', $brand->id) }}" class="text-dark">
                                                        {{ $brand->brand_name }}</a>
                                                    <input type="hidden" id="brand_id" value="{{ $brand->id }}">
                                                </div><!-- End .custom-checkbox -->
                                                <div>
                                                    @php
                                                        $count_product = App\Product::where('brand_name', $brand->id)->count();
                                                    @endphp
                                                    <a href="{{ route('brand.products', $brand->id) }}" class="text-dark">
                                                        <span class="item-count">({{ $count_product }})</span>
                                                    </a>
                                                </div>

                                            </div><!-- End .filter-item -->
                                        @endforeach
                                    </div><!-- End .filter-items -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar sidebar-shop -->
                    </aside>
                    <div class="col-md-9 col-lg-10">
                        <div class="row align-items-center ">
                            <div class="col-4 d-md-none">
                                <button style="min-width: 114px;" title="Filter Products"
                                    class="btn btn-sm btn-primary filterBtn">Filters <i
                                        class="icon-long-arrow-right"></i></button>
                            </div>
                            <div class="col-8 col-md-12 ">
                                <div class="toolbox">
                                    <div class="toolbox-right">
                                        <div class="toolbox-sort">
                                            <label for="sortby">Sort by:</label>
                                            <div class="select-custom">
                                                <select name="sortby" id="sortby" class="form-control">
                                                    <option id="high_peice" value="high_peice" selected="selected">High
                                                        Price
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
                                                <a href="{{ route('product.details', $product->product_slug) }}">
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
                                                            <img src="{{ asset($product_varient->image) }}"
                                                                alt="{{ $product->product_name }}"
                                                                class="product-image-hover">
                                                        @endif
                                                    @endforeach
                                                </a>
                                                <div class="product-action">
                                                    <input type="hidden" class="product_input_id"
                                                        value="{{ $product->id }}">
                                                </div>
                                            </figure>
                                            <div class="product-body">
                                                <h3 class="product-title">
                                                    <a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}
                                                    </a></h3>
                                                <div class="product-price">
                                                    @if(Auth::check() && Auth::user()->status == 1)
                                                    ${{ number_format($price, 2) }}
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div><!-- End .row -->
                            <nav aria-label="Page navigation all-product">
                                <ul class="pagination justify-content-center">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div><!-- End .col-lg-9 -->
                    <!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>
@endsection
