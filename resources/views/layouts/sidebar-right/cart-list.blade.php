<div class="section-height">
      @forelse ($carts as $cart)
      <div class="row">
            <div class="col-12 my-cart">
                  <div class="card">
                        <div class="row  align-items-center">
                              <div class="col-5 image_section ">
                                  <a href="#"><img src="{{ asset($cart->product_varient->image) }}"></a>
                              </div>
                              <div class=" col-7 text-section p-3">
                            
                                    <span>
                                        {{ $cart->product->product_name }}
                                    </span>
                                    <p class="fs-4" style="font-size: 16px; font-weight:500">
                                          ${{ $cart->price* $cart->qty }}
                                    </p>

                                    <div class="d-flex align-items-center mb-1">
                                          <div class="border_button text-center">

                                                <button class="decrement" data-cart-id="{{ $cart->id }}">
                                                      -
                                                </button>
                                          </div>
                                          <div class="border_input text-center">
                                                <input class="text-center counter" type="text" value="{{ $cart->qty }}" min="1" readonly>
                                          </div>
                                          <div class="border_button text-center">
                                                <button class="increment" data-cart-id="{{ $cart->id }}">
                                                      +
                                                </button>
                                          </div>
                                    </div>
                                    <div>
                                          <a class="remove_button" data-cart-id="{{ $cart->id }}" href="#">
                                                Remove
                                          </a>
                                    </div>

                              </div>

                        </div>
                  </div>
            </div>

      </div>
      @empty
      <div class="">
            <h6 class="text-danger  text-center" style="padding-top: 100px;">Cart list is empty</h6>
      </div>
      @endforelse

</div>
<div class="row Subtotal-section">
      <div class="col-6">
            <span class="subtotal">Subtotal</span>
      </div>
      <div class="col-6 text-end">
            <span class="subtotalValue">${{ $sub_total }}</span>
      </div>
</div>

<div class=" row justify-content-center">
      <div class="text-center">
            <a class="celerCart"  href="">Clear Cart</a>
      </div>
      <button class="btn btn-success btn-block mt-3">Checkout</button>
</div>

<script>
      $(document).ready(function() {
            $('.increment').click(function() {
                  var cartId = $(this).data('cart-id');
                  var inputField = $(this).closest('.d-flex').find('.counter');
                  var value = parseInt(inputField.val());
                  value = isNaN(value) ? 1 : value;
                  value++;
                  inputField.val(value);

                  updateCart(cartId, value);
            });

            $('.decrement').click(function() {
                  var cartId = $(this).data('cart-id');
                  var inputField = $(this).closest('.d-flex').find('.counter');
                  var value = parseInt(inputField.val());
                  value = isNaN(value) ? 1 : value;
                  if (value > 1) {
                        value--;
                        inputField.val(value);
                  }
                  updateCart(cartId, value);
            });

            $('.remove_button').click(function() {
                  var cartId = $(this).data('cart-id');

                  $.ajax({
                        type: 'post',
                        url: "/cart-item-removed",
                        data: {
                              cartId: cartId
                        },
                        success: function(response) {
                              if (response.success == "Cart item removed") {
                                    openNav();
                                    alertify.set("notifier", "position", "bottom-left");
                                    alertify.success("Cart item removed");
                              } else {
                                    alertify.set("notifier", "position", "top-right");
                                    alertify.warning("Something wrong");
                              }
                        },
                        error: function(xhr, status, error) {
                              console.error(xhr.responseText);
                        }
                  });
            });
            $('.celerCart').click(function() {
                
                  $.ajax({
                        type: 'post',
                        url: "/cart-item-removed",
                        success: function(response) {
                              if (response.success == "Cart item removed") {
                                    openNav();
                                    alertify.set("notifier", "position", "bottom-left");
                                    alertify.success("Cart item removed");
                              } else {
                                    alertify.set("notifier", "position", "top-right");
                                    alertify.warning("Something wrong");
                              }
                        },
                        error: function(xhr, status, error) {
                              console.error(xhr.responseText);
                        }
                  });
            });

      });

      function updateCart(cartId, qty) {
            var cartId = cartId;
            var qty = qty;
            $.ajax({
                  type: 'post',
                  url: "/cart-update-qty",
                  data: {
                        cartId: cartId,
                        qty: qty
                  },
                  success: function(response) {
                        if (response.success == "Cart item quantity updated") {
                              openNav();
                              alertify.set("notifier", "position", "bottom-left");
                              alertify.success("Cart item quantity updated");
                        } else {
                              alertify.set("notifier", "position", "top-right");
                              alertify.warning("Something wrong");
                        }
                  },
                  error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                  }
            });
      }
</script>