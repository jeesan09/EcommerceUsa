          

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
            <a type="button" class="celerCart" href="#">Clear Cart</a>
      </div>
</div>

<style>
      /* Corrected class name to "checkbox" */
      .checkbox {
            position: absolute !important;
            width: 57px !important;
            height: 20px !important;
            visibility: visible !important;
            background-color: #ccc !important;
            border: 1px solid #aaa !important;
      }

      .labelCSS label {
            font-weight: 300;
            font-size: 1.4rem;
            margin: 0px 29px 0.1rem;
      }

      .payment-header {
            border-bottom: 1px solid #8080803d;
            text-align: center;
            padding: 4px 12px;
      }
      .border_row{
            border: 1px solid #8080803d;
            border-radius: 4px;
      }
  .border_row .form-check {
    position: relative;
    display: block;
    padding: 10px 1px;
}
</style>

<div class="row mt-3 mx-2 border_row">
      <div class="col-12 px-2 payment-header">
            <h6 class="modal-title ml-4" style="font-size: 15px;" id="paymentModalLabel">Select Payment Method</h6>
      </div>
     <div class="col-12 d-flex justify-content-between">
     <div class="form-check labelCSS">
            <input class="form-check-input checkbox" type="radio" name="payment_option" value="online_payment" checked>
            <label class="form-check-label">
                  Online Payment
            </label>
      </div>
      <div class="form-check labelCSS">
            <input class="form-check-input checkbox" type="radio" name="payment_option" value="cash_on_delivery">
            <label class="form-check-label">
                  Wire Transfer
            </label>
      </div>
     </div>
</div>
<a href="#" id="checkout_button" class="btn btn-success btn-block mt-1 text-white">Checkout</a>

<script>
      $(document).ready(function() {
            

    // Handle checkout button click
    $('#checkout_button').click(function() {
        // Determine the selected payment method
        var paymentMethod = $('input[name="payment_option"]:checked').val();

        // Serialize the $carts data to a JSON string
        var cartsData = JSON.stringify(<?php echo json_encode($carts); ?>);

        // Get the sub_total value
        var subTotal = <?php echo $sub_total; ?>;

        // Perform different actions based on the selected payment method
        if (paymentMethod === 'online_payment') {
            // Redirect to the /stripe route with cart data and sub_total
         /*    window.location.href = '/stripe?payment_method=online_payment&sub_total=' + subTotal; */
            window.location.href = '/stripe';
        } else if (paymentMethod === 'cash_on_delivery') {
            // Redirect to the / route with cart data and sub_total
           /*  window.location.href = '/checkout?payment_method=cash_on_delivery&carts=' + encodeURIComponent(cartsData) + '&sub_total=' + subTotal; */
            window.location.href = '/checkout';
        }
    });
       // Your existing JavaScript code for cart functionality
            $('.increment').click(function() {
                  var increment = 1;
                  var cartId = $(this).data('cart-id');
                  var inputField = $(this).closest('.d-flex').find('.counter');
                  var value = parseInt(inputField.val());
                  value = isNaN(value) ? 1 : value;
                  value++;
                  inputField.val(value);

                  updateCart(cartId, value, increment, inputField);
            });

            $('.decrement').click(function() {
                  var increment = 0;
                  var cartId = $(this).data('cart-id');
                  var inputField = $(this).closest('.d-flex').find('.counter');
                  var value = parseInt(inputField.val());
                  value = isNaN(value) ? 1 : value;
                  if (value > 1) {
                        value--;
                        inputField.val(value);
                  }
                  updateCart(cartId, value, increment, null);
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
                                    $("#cart_realaod").load(location.href + " #cart_realaod");
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
                        url: "/cart-item-removed-all",
                        success: function(response) {
                              if (response.success == "Cart item removed all") {
                                    openNav();
                                    alertify.set("notifier", "position", "bottom-left");
                                    alertify.success("Cart item removed all");
                                    $("#cart_realaod").load(location.href + " #cart_realaod");
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

      function updateCart(cartId, qty, increment, inputField) {
            var cartId = cartId;
            var qty = qty;
            $.ajax({
                  type: 'post',
                  url: "/cart-update-qty",
                  data: {
                        cartId: cartId,
                        qty: qty,
                        increment: increment,
                  },
                  success: function(response) {
                        if (response.success == "Cart item quantity updated") {
                              openNav();
                              alertify.set("notifier", "position", "bottom-left");
                              alertify.success("Cart item quantity updated");
                        } else {
                         if(response.warning){
                            alertify.set("notifier", "position", "bottom-left");
                            alertify.warning("Out of stock ! Please check quantity. ");
                           if(inputField !=null){
                              var value = parseInt(inputField.val());
                              value = isNaN(value) ? 1 : value;
                              value--;
                              inputField.val(value);
                           }
                          return;
                           }
                              alertify.set("notifier", "position", "bottom-left");
                              alertify.warning("Something wrong");
                        }
                  },
                  error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                  }
            });
      }
</script>

<style>
      /* Custom styles for radio buttons */
      .form-check-input:checked {
            background-color: green;
            /* Change to desired color */
      }

      /* Custom styles for radio button labels */
      .form-check-label {
            cursor: pointer;
      }

      /* Custom styles for radio button label text when checked */
      .form-check-input:checked+.form-check-label {
            color: green;
            /* Change to desired color */
      }
</style>