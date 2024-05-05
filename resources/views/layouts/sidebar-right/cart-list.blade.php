<div class="section-height">
      @forelse ($carts as  $cart)
      <div class="row">
            <div class="col-12 my-cart">
                  <div class="card">
                        <div class="row  align-items-center">
                              <div class="col-5 image_section ">
                                    <a href="/products/20w70aa-aba?variant=45957189206262"><img src="https://cdn.shopify.com/s/files/1/0671/0221/2342/files/20W70AA_ABA.jpg?v=1706802513" class="item-image w-100 " alt="HP Pavilion Desktop AMD Ryzen 3, 8GB RAM, 256GB SSD, 1TB, Windows 11 Home"></a>
                              </div>
                              <div class=" col-7 text-section p-3">
                                    <span>
                                          HP Pavilion Desktop AMD Ryzen 3, 8GB RAM, 256GB SSD, 1TB, Windows 11 Home
                                    </span>
                                    <p>
                                          $234.43
                                    </p>

                                    <div class="d-flex align-items-center mb-1">
                                          <div class="border_button text-center">

                                                <button class="decrement">
                                                      -
                                                </button>
                                          </div>
                                          <div class="border_input text-center">
                                                <input class="text-center counter" type="text" value="{{ $cart->qty }}" min="1" readonly>
                                          </div>
                                          <div class="border_button text-center">
                                                <button class="increment">
                                                      +
                                                </button>
                                          </div>
                                    </div>
                                    <div>
                                          <a class="remove_button" href="#">
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
            <span>Subtotal</span>
      </div>
      <div class="col-6 text-end">
            <span>${{ $sub_total }}</span>
      </div>
</div>
<div class="row p-4">
      <div class="text-center">
            <a class="" href="">Clear Cart</a>
      </div>
      <button class="btn btn-success btn-block mt-3">Checkout</button>
</div>

<script>
      $(document).ready(function() {
		$('.increment').click(function() {
			var inputField = $(this).closest('.d-flex').find('.counter');
			var value = parseInt(inputField.val());
			value = isNaN(value) ? 1 : value;
			value++;
			inputField.val(value);
		});

		$('.decrement').click(function() {
			var inputField = $(this).closest('.d-flex').find('.counter');
			var value = parseInt(inputField.val());
			value = isNaN(value) ? 1 : value;
			if (value > 1) {
				value--;
				inputField.val(value);
			}
		});
	});
</script>