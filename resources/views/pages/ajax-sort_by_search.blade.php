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
                        <img src="{{ asset($product_varient->image) }}" alt="{{ $product->product_name }}" class="product-image">
                        @php
                        $firstImage = false;
                        $price = $product_varient->price;
                        @endphp
                        @else
                        <img src="{{ asset($product_varient->image) }}" alt="" class="product-image-hover">
                        @endif
                        @endforeach
                    </a>
                    {{-- <div class="product-action-vertical">
                        <a href="{{ url('add/wishlist/' . $product->id) }}" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                    </div> --}}
                    <div class="product-action">
                        <!--  <a class="btn-product btn-cart cart_btn_click" href="#product_details"
                                                        data-toggle="modal"><span>BUY NOW</span></a> -->
                        <input type="hidden" class="product_input_id" value="{{ $product->id }}">
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <h3 class="product-title"><a href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}
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
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{ $products->links() }}
        </ul>
    </nav>
</div><!-- End .products -->