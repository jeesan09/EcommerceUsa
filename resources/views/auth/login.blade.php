@extends('layouts.fontend-master')
{{-- @section('product_list')Login-page @endsection --}}
@section('content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-sm-6">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Login</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="tab-content-5">
                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="singin-email">User Phone / E-mail *</label>
                                    <input id="singin-email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="singin-password">Password *</label>
                                    <input id="singin-password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span> <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="text-center">
                                        <a href="/register" class="btn btn-primary">Register</a>
                                    </div>                                   

                                    {{-- <div class="custom-control custom-checkbox">
                                     
                                        <input class="custom-control-input" type="checkbox" name="remember" id="signin-remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="signin-remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div> --}}

                                    @if (Route::has('password.request'))
                                    <a class="forgot-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div><!-- End .form-footer -->
                            </form>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if(session('warning'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('warning') }}
                                </div>
                            @endif                            

                        </div><!-- .End .tab-pane -->
<!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div>
        </div>
    </div>




</div>
@endsection
