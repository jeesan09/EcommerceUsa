@extends('layouts.fontend-master')
@section('product')
    active
@endsection
@section('product_list')
    Search-product-list
@endsection
<style>
    .pagination nav {
        border: 1px solid #f3d7bb;
        padding: 5px 8px;
        border-radius: 2px;
    }
</style>
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->current() }}">All Product</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @if ($products->count() >= 1)
                                    @foreach ($products as $product)
                                        <div class="col-6 col-md-4 col-lg-4 col-xl-3 product_data">
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <a href=" {{ route('product.details', $product->product_slug) }}">
                                                        @php $categoryProduct = true; @endphp
                                                        @foreach ($product->variants as $product_varient)
                                                            @if ($categoryProduct)
                                                                <img src="{{ asset($product_varient->image) }}"
                                                                    alt="{{ $product->product_name }}"
                                                                    class="product-image">
                                                                @php
                                                                    $categoryProduct = false;
                                                                    $price = $product_varient->price;
                                                                @endphp
                                                            @else
                                                                <img src="{{ asset($product_varient->image) }}"
                                                                    alt="{{ $product->product_name }}"
                                                                    class="product-image-hover">
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                </figure><!-- End .product-media -->
                                                <div class="product-body">
                                                    <h3 class="product-title"><a
                                                            href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    </h3><!-- End .product-title -->
                                                    <div class="product-price">
                                                        ${{ number_format($price, 2) }}
                                                    </div>
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        </div>
                                    @endforeach
                                @else
                                    <div class=" pt-4 text-center">
                                        <img src="{{ asset('frotend/assets/no_product_alert/no-emoji.gif') }}"
                                            style="width: 200px" alt="No Product Found">
                                        <h5 class="text-danger ">No Product Found</h5>
                                    </div>
                                @endif
                            </div><!-- End .row -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div><!-- End .products -->
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>
@endsection
