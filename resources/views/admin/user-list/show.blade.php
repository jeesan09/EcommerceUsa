@extends('admin.admin_layouts')

@section('admin_content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/admin/home') }}">Home</a>
            <a class="breadcrumb-item" href="{{ url('/user-list') }}">User Page</a>
            <span class="breadcrumb-item active">User Details</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mt-4">User Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                    <p><strong>Shipping Address:</strong> {{ $user->shipping_address }}</p>
                                    <p><strong>Billing Address:</strong> {{ $user->billing_address }}</p>
                                    <p><strong>Reseller ID:</strong> {{ $user->reseller_ID }}</p>
                                    <p><strong>Company Name:</strong> {{ $user->company_name }}</p>
                                    <p><strong>City:</strong> {{ $user->city }}</p>
                                    <p><strong>Region:</strong> {{ $user->united_region }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Tax-Image/PDF</h5>
                                    @if(pathinfo($user->tax_image, PATHINFO_EXTENSION) === 'pdf')
                                        <embed src="{{ asset($user->tax_image) }}" type="application/pdf" width="100%" height="500px" />
                                    @else
                                        <!-- Display Image -->
                                        <img src="{{ asset($user->tax_image) }}" style="width:100%" alt="Tax Image">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- card -->
                </div><!-- col-8 -->
            </div><!-- row -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
@endsection
