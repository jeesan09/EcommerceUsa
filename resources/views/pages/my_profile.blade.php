@extends('layouts.fontend-master')
@section('content')
<style>
 .btn {
    padding: 0.5rem .05rem !important;
    min-width: 0px !important;
    border-radius: 4px ;
}
.table .thead-dark th {
    color: #fff;
    background-color: #c96 !important;
    border-color: #f7f7f7 !important;
}
</style>
@section('product_list')  My-profile-{{ Auth::user()->name}}  @endsection
<main class="main" >
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Profile<span> [{{ Auth::user()->name}}]</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
   
    <div class="page-content" >
        <div class="dashboard">
            <div class="container-fluid">
                <div class="row">
                    <aside class="col-sm-2 col-lg-2">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">My Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Change Password</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                          
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->
                    <style>
                        .badge{
                            font-size: 12px !important;
                        }
                    </style>
                   
                    <div class="col-sm-10 col-lg-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <table class="table table-bordered" id="myorder">
                                    <thead class="thead-dark text-center">
                                      <tr>
                                        <th style="width:5%;">Sl.No</th>
                                        <th style="width:15%;">#Invoice No</th>
                                        <th scope="col"> Sub Total</th>
                                        <th scope="col"> Dicount Amount</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($orders as $order)
                                        <tr>
                                            <th style="padding-left: 10px;"  > {{ $loop->iteration }}</th>
                                            <th style="padding-left: 10px;"  ># {{ $order->invoice }}</th>
                                            <td style="padding-left: 10px;"> <span>$</span>{{ number_format($order->subtotal) }}</td>
                                            <td style="padding-left: 10px;" > <span>$</span>{{ number_format($order->copon_discount) }}</td>
                                            <td style="padding-left: 10px;"> <span>$</span>{{ number_format($order->total) }}</td>
                                            <td style="padding-left: 10px;">
                                                @php
                                                 $newtime = strtotime($order->created_at)
                                               @endphp
                                               {{ $order->time = date('d-M-Y',$newtime)}}
                                            </td>
                                            <td  class="text-center fs-1">
                                                @if($order->order_status=="1")
                                                  <p  class="badge badge-warning text-white">Pendding</p>
                                                @elseif ($order->order_status=="2")
                                                  <p  class="badge badge-primary text-white">Oreder Accept</p>
                                                @elseif ($order->order_status=="3")
                                                <p class="badge badge-success text-white">Oreder On The Way</p>
                                                @elseif($order->order_status=="4")
                                                 <p  class="badge badge-success text-white">Order Delivery Recived</p>
                                                 @elseif($order->order_status=="5")
                                                 <p  class="badge badge-danger text-white">Order Cancel</p>
                                                @endif
                                                 
                                            </td>
                                            <td  class="text-center fs-1">
                                                @if($order->payment_inside=="COD")
                                                  <p  class="badge badge-warning text-white">COD</p>
                                                @else
                                                  <p  class="badge badge-success text-white">Online Payment</p>
                                                @endif
                                            </td>
                                            <td  class="text-center fs-1">
                                                @if($order->payment_status=="0")
                                                  <p  class="badge badge-warning text-white">Unpaid</p>
                                                @elseif ($order->payment_status=="1")
                                                  <p  class="badge badge-primary text-white">Paid</p>
                                                @endif
                                            </td>

                                            <td style="padding-left: 10px;">
                                                <a href="{{ route('my.order.details',$order->id) }}" class="btn btn-outline-success btn-sm" title="Order Details"> <i class="icon-eye"></i></a>
                                                @if($order->order_status=="1" OR $order->order_status=="2"  OR $order->order_status=="5")
                                                <a onclick="return confirm('Are you sure you want to cancel this order ?')" href="{{ route('my.order.cancel',$order->id) }}" title="Cancel order" class="btn btn-outline-danger btn-sm @if ($order->order_status=="5")
                                                    disabled
                                                @endif"> <i class="icon-close"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                  </table>
                                <div class="d-flex justify-content-end">
                                    {{  $orders->links() }}
                                </div>
                            </div><!-- .End .tab-pane -->


                            <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                <div class="row  justify-content-center">
                                    <div class="col-sm-6 ">
                                     <form action="{{ route('password.change') }}" method="POST">
                                        @csrf

                                        <label>Current password </label>
                                        <input type="password" name="old_pass" class="form-control @error('old_pass') is-invalid @enderror" >
                                            @error('old_pass')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                           @enderror
                                        <label>New password</label>
                                        <input type="password" name="new_pass" class="form-control @error('new_pass') is-invalid @enderror" >
                                        @error('new_pass')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                       @enderror
                                        <label>Confirm new password</label>
                                        <input type="password" name="confirm_pass" class="form-control @error('confirm_pass') is-invalid @enderror" >
                                        @error('confirm_pass')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                       @enderror
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                </form>
                                </div>
                              </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="{{ route('update.user.account') }}" method="post">
                                    @csrf
                                    @foreach ($users as  $user)
                                        <div class="row">
                                            <input type="hidden"  name="user_id" value="{{ $user->id }}">
                                            <div class="col-6">
                                                <label> Name *</label>
                                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" >
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                           
                                            <div class="col-6">
                                                <label>Reseller ID *</label>
                                                <input type="text" class="form-control  @error('reseller_ID') is-invalid @enderror" name="reseller_ID" value="{{ $user->reseller_ID }}" >
                                                @error('reseller_ID')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                      
  
                                            
                                            <div class="col-6">
                                                <label>Company Name *</label>
                                                <input type="text" class="form-control  @error('company_name') is-invalid @enderror" name="company_name" value="{{ $user->company_name }}" >
                                                @error('company_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                    
                                            <div class="col-6">
                                                <label>Phone No *</label>
                                                <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" >
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                    
                                            <div class="col-6">
                                                <label>Shipping Address *</label>
                                                <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address"  >{{ $user->shipping_address }}</textarea>
                                              
                                                @error('shipping_address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                   
                    

                    
                                            <div class="col-6">
                                                <label>Billing Address *</label>
                                                <textarea id="billing_address" class="form-control @error('billing_address') is-invalid @enderror" name="billing_address"  >{{ $user->billing_address }}</textarea>
                                              
                                                @error('billing_address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                    
                    
                                            <div class="col-6">
                                                <label>E-mail Address *</label>
                                                <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" >
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>                   
                    

                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
   

</main><!-- End .main -->
@endsection