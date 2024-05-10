@extends('layouts.fontend-master')

@section('content')
<main class="main">
<div class="container" style=" background: #f6f6f6;">
    <style>
        .form-box {
    max-width: 800px !important;
  
}
    </style>
    <div class="row justify-content-center">
        <div class="col-md-8 my-4">
            <div class="form-box">
                <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Register</a>
                    </li>
                </ul>
                <div class="card-body mt-2">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Name *</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div><!-- End .form-group -->


                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md">Reseller ID *</label>

                            <div class="col-md-12">
                                <input id="reseller_ID" type="text" class="form-control @error('reseller_ID') is-invalid @enderror" name="reseller_ID" value="{{ old('reseller_ID') }}" required autocomplete="reseller_ID" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md">Company Name *</label>

                            <div class="col-md-12">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="shipping_address">Shipping Address *</label>
                            <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows="4" required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- End .form-group -->



                        <div class="form-group">
                            <label for="billing_address">Billing Address *</label>
                            <textarea id="billing_address" class="form-control @error('billing_address') is-invalid @enderror" name="billing_address" rows="4" required>{{ old('billing_address') }}</textarea>
                            @error('billing_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- End .form-group -->




                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone">Phone No *</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- End .form-group -->
                            <div class="col-md-6">
                                <label for="email">E-mail Address *</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="col-md-6 ">
                                <label for="password">Password *</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div><!-- End .form-group -->
                            <div class="col-md-6">
                                <label for="cpassword">Confirm Password *</label>
                                <input id="cpassword" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-footer d-flex justify-content-between mb-4">
                            <!-- Back button -->
                            <a href="javascript:history.back()" style="color: black; text-decoration:none " class="btn btn-outline-primary-2">Back</a>

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

</main>
@endsection
