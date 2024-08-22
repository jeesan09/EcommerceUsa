@extends('layouts.fontend-master')
<style>
    label {
    color: #666;
    font-weight: 300;
    font-size: 1.4rem;
    margin: 0px !important;
}
</style>
@section('content')
    <main class="main">
        <div class="container" style=" background: #f6f6f6;">

            <style>
                .form-box {
                    max-width: 800px !important;

                }

                @media (max-width: 700px) {
                    .form-footer {
                        flex-direction: column-reverse;
                    }

                    .form-footer .btn {
                        width: 100%;
                        margin-top: 10px;
                    }

                    .form-footer .btn:first-child {
                        margin-top: 10px;
                    }
                }
            </style>
            <div class="row justify-content-center">
                <div class="col-md-8 my-4">
                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Register</a>
                                </li>
                            </ul>
                            <div class="card-body mt-2">
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name"> Name <span class="text-danger">*</span></label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <label for="email">E-mail <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">Phone No *</label>
                                            <input id="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone') }}" required autocomplete="phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="company_name">Company Name  *</label>
                                                <input id="company_name" type="text"
                                                    class="form-control @error('company_name') is-invalid @enderror"
                                                    name="company_name" value="{{ old('company_name') }}" required
                                                    autocomplete="company_name" autofocus>
                                                @error('company_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="reseller_ID" >Reseller ID *</label>
                                                <input id="reseller_ID" type="text"
                                                    class="form-control @error('reseller_ID') is-invalid @enderror"
                                                    name="reseller_ID" value="{{ old('reseller_ID') }}" required
                                                    autocomplete="reseller_ID" autofocus>
                                                @error('reseller_ID')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="tax_image">TAX Image*</label>
                                            <input id="tax_image" type="file"
                                                   class="form-control @error('tax_image') is-invalid @enderror"
                                                   name="tax_image" value="{{ old('tax_image') }}" required
                                                   autocomplete="tax_image">
                                            @error('tax_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class="invalid-feedback " id="file-error">
                                                <strong></strong>
                                            </span>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="city" class="col-md-12">City *</label>
                                                <input id="city" type="text"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    name="city" value="{{ old('city') }}" required
                                                    autocomplete="city" autofocus>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>

                                        <div class="col-md-6">
                                                <input id="united_states" type="text"
                                                    class="form-control @error('united_states') is-invalid @enderror"
                                                    name="united_states" required
                                                    autocomplete="united_states" value="United states" readonly>
                                                @error('united_states')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <select name="united_region" id="united_region" required class="form-control @error('united_region') is-invalid @enderror">
                                                <option value="">Please select a region</option>
                                                <option value="Alabama">Alabama</option>
                                                <option value="Alaska">Alaska</option>
                                                <option value="Arizona">Arizona</option>
                                                <option value="Arkansas">Arkansas</option>
                                                <option value="California">California</option>
                                                <option value="Colorado">Colorado</option>
                                                <option value="Connecticut">Connecticut</option>
                                                <option value="Delaware">Delaware</option>
                                                <option value="Florida">Florida</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Idaho">Idaho</option>
                                                <option value="Illinois">Illinois</option>
                                                <option value="Indiana">Indiana</option>
                                                <option value="Iowa">Iowa</option>
                                                <option value="Kansas">Kansas</option>
                                                <option value="Kentucky">Kentucky</option>
                                                <option value="Louisiana">Louisiana</option>
                                                <option value="Maine">Maine</option>
                                                <option value="Maryland">Maryland</option>
                                                <option value="Massachusetts">Massachusetts</option>
                                                <option value="Michigan">Michigan</option>
                                                <option value="Minnesota">Minnesota</option>
                                                <option value="Mississippi">Mississippi</option>
                                                <option value="Missouri">Missouri</option>
                                                <option value="Montana">Montana</option>
                                                <option value="Nebraska">Nebraska</option>
                                                <option value="Nevada">Nevada</option>
                                                <option value="New Hampshire">New Hampshire</option>
                                                <option value="New Jersey">New Jersey</option>
                                                <option value="New Mexico">New Mexico</option>
                                                <option value="New York">New York</option>
                                                <option value="North Carolina">North Carolina</option>
                                                <option value="North Dakota">North Dakota</option>
                                                <option value="Ohio">Ohio</option>
                                                <option value="Oklahoma">Oklahoma</option>
                                                <option value="Oregon">Oregon</option>
                                                <option value="Pennsylvania">Pennsylvania</option>
                                                <option value="Rhode Island">Rhode Island</option>
                                                <option value="South Carolina">South Carolina</option>
                                                <option value="South Dakota">South Dakota</option>
                                                <option value="Tennessee">Tennessee</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Utah">Utah</option>
                                                <option value="Vermont">Vermont</option>
                                                <option value="Virginia">Virginia</option>
                                                <option value="Washington">Washington</option>
                                                <option value="West Virginia">West Virginia</option>
                                                <option value="Wisconsin">Wisconsin</option>
                                                <option value="Wyoming">Wyoming</option>
                                            </select>
                                            @error('united_region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="shipping_address">Shipping Address *</label>
                                        <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"
                                            name="shipping_address" style="min-height: 10px;" rows="2" required>{{ old('shipping_address') }}</textarea>
                                        @error('shipping_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->



                                    <div class="form-group">
                                        <label for="billing_address">Billing Address *</label>
                                        <textarea id="billing_address" class="form-control @error('billing_address') is-invalid @enderror"
                                            name="billing_address" rows="2" style="min-height: 10px;" required>{{ old('billing_address') }}</textarea>
                                        @error('billing_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- End .form-group -->

                                    <div class="row">
                                        <!-- End .form-group -->

                                        <div class="col-md-6 ">
                                            <label for="password">Password *</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div><!-- End .form-group -->
                                        <div class="col-md-6">
                                            <label for="cpassword">Confirm Password *</label>
                                            <input id="cpassword" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-footer d-flex justify-content-between">
                                        <button type="submit" class="btn btn-outline-primary-2 px-4">
                                            &nbsp; &nbsp; <span>REGISTER</span>
                                            <i class="icon-long-arrow-right"></i> &nbsp; &nbsp;
                                        </button>

                                    </div>
                                    <div class="text-center">
                                      <span class="" style="font-size: 18px;">Have Account?
                                          <a href="{{ route('login') }}">Login</a>
                                        </span>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('frotend/assets/js/jquery.min.js') }}"></script>
        <script>

            $(document).ready(function() {
        $('#tax_image').on('change', function() {
            let fileInput = $(this)[0];
            let file = fileInput.files[0];
            let fileSize = file.size / 1024 / 1024; // size in MB
            let fileType = file.type;

            // Allowed file types
            let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

            // Check file type and size
            if ($.inArray(fileType, allowedTypes) === -1) {
                showError('Only JPG, JPEG, PNG, and PDF files are allowed.');
                fileInput.value = ''; // clear the input
            } else if (fileSize > 1) {
                showError('File size must be less than or equal to 1 MB.');
                fileInput.value = ''; // clear the input
            } else {
                hideError(); // hide any previous error message
            }
        });

        function showError(message) {
            $('#file-error strong').text(message);
            $('#file-error').removeClass('d-none');
            $('#tax_image').addClass('is-invalid');
        }

        function hideError() {
            $('#file-error').addClass('d-none');
            $('#tax_image').removeClass('is-invalid');
        }
    });
        </script>
    </main>

@endsection
