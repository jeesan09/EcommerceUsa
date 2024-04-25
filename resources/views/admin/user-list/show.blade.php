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
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">User Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                    <p><strong>Reseller ID:</strong> {{ $user->reseller_ID }}</p>
                                    <p><strong>Company Name:</strong> {{ $user->company_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <!-- Add additional user details here -->
                                    <!-- For example: -->
                                    <!-- <p><strong>Country:</strong> {{ $user->country }}</p> -->
                                    <!-- <p><strong>Division:</strong> {{ $user->division }}</p> -->
                                    <!-- <p><strong>District:</strong> {{ $user->district }}</p> -->
                                    <!-- <p><strong>Thana:</strong> {{ $user->thana }}</p> -->
                                </div>
                            </div>
                        </div>
                    </div><!-- card -->
                </div><!-- col-8 -->
            </div><!-- row -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
@endsection
