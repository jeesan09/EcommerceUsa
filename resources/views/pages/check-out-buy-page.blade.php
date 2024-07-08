@extends('layouts.fontend-master')
@section('content')
@section('product_list')
    Payment Getway
@endsection
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

    <div class="page-content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 style="text-align: center; margin-bottom:30px;padding-top:20px; ">Wire Transfer</h3>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <div class="py-3 text-center">
                                        <span class="panel-title headerStyle"> Shipping detail information</span>
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
                                            <input type="text" class="form-control" id="shippingAddress"
                                                value="{{ $user->shipping_address }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <aside class="col-lg-5" >
                            <form action="{{ route('checkout.order') }}" method="post">
                                @csrf
                            <div class="summary" >
                                <h3 class="summary-title">Order Item(s)</h3><!-- End .summary-title -->
                                <table class="table table-summary">
                                    <thead>
                                        <tr style="border-bottom:1px solid rgba(218, 218, 218, 0.757)">
                                            <th>Product Name </th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart_join_prod as $cart_product )
                                        <tr>
                                            <td><a >{{ $cart_product->product_name }} * {{ $cart_product->qty }}</a></td>
                                            <td> <span>$</span>{{ $cart_product->qty * number_format($cart_product->price ) }}</td>
                                        </tr>
                                        @endforeach
                                        <input type="hidden" name="subtotal" value="{{ $sub_total }}">
                                        <input type="hidden" name="total" value="{{ $sub_total }}">
                                        <tr class="summary-total">
                                            <td> Sub Total:</td>
                                            <td>     <span>$</span>{{ number_format($sub_total,2) }}</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>    <span>$</span>{{ number_format($sub_total,2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                @if($sub_total > 1)
                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text ">Proceed to Checkout</span>
                                    </button>
                                  @else
                                      <a href="{{ route('all.product') }}" class="btn btn-outline-primary-2 btn-block"> Back to Shopping</a>
                              @endif
                                </form>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->

                    </div>

                </div>
            </div>

        </div>
    </div>
</main>


@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
</script>
