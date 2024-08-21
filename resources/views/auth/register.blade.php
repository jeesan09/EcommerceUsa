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
                                <form method="POST" action="{{ route('register') }}">
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
                                                   autocomplete="tax_image" accept="image/*">
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
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
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
                                    <div class="form-footer d-flex justify-content-between mb-4">
                                        <!-- Back button -->
                                        <a href="javascript:history.back()" style=" text-decoration:none "
                                            class="btn btn-primary text-white text-left"><i class="icon-long-arrow-left"></i>Back</a>

                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>REGISTER</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                    </div><!-- End .form-footer -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
