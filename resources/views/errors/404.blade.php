@extends('layouts.fontend-master')
@section('content')
    <main class="main">
        <div class="container " style=" background: #f6f6f6;">
            <div class="row justify-content-center my-4">
                <div class="col-sm-9">
                    <div class="form-box">
                        <div class="form-tab">
                            <div class="tab-content">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('frotend') }}/error-images/404.svg" alt="Payment methods"
                                        style="height: 300px">
                                </div>
                                <div class="text-center mt-3">
                                    <h5 class="text-danger">{{ @$statusCode }} - Page Not Found</h5>
                                    <p class="text-dark">Sorry, the page you are looking for could not be found.</p>
                                </div>
                               <div class="text-center pt-1">
                                    <a class="btn btn-primary" href="{{ url('/') }}">Go Home</a>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
