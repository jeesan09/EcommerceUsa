@extends('layouts.fontend-master')
@section('content')
@php
$subtotalInvoice = 0;
@endphp
@php
$subtotal = 0;
@endphp
    <main class="main">
        {{--  <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container-fluid">
                <h1 class="page-title">My Order Details <span>Shop</span></h1>
            </div>
        </div> --}}
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container-fluid d-flex justify-content-between">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('my-profile/') }}">My-Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Order </li>
                </ol>
                <div>
                    <div>
                        <a class="btn btn-primary" href="{{ url('my-profile') }}"><i class="icon-long-arrow-left"></i>Back
                            to Dashboard</a>
                    </div>
                </div>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container-fluid">
                    {{-- invoce genarator  --}}
                    <div class="row justify-content-center">
                        <div class="col-8 d-none">
                            <div class="invoicePrint"  style="padding:10px; background:#fff !important; ">
                                <div class="invice-top-header" style="display:flex; width: 100%;">
                                    <div class="col-md-6" style="width: 70%; float: left;">
                                        <img  src="{{ asset('frotend/websiteLogo/MPW Wholesale.png') }}" class="img-fluid rounded-top" alt="" />
                                    </div>
                                    <div class="col-md-6" style="width: 29%;float: left;">
                                        <div class="">
                                            <strong>MPW Wholesale </strong>
                                            <p>Tel: 704-579-3971</p>
                                            <p>sales@megaphonewholesale.com</p>
                                            <p>http://www.mpwwholesale.com</p>
                                        </div>
                                        <div style="margin-top: 30px;">
                                            @foreach ($shippings as $shipping)
                                            <p>{{ $shipping->user_name }}</p>
                                            <p>{{ $shipping->email }}</p>
                                            <p>{{ $shipping->phone }}</p>
                                            <p>{{ $shipping->shiping_address }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
        
                                <div class="invice-top" style="display:flex; width: 100%; align-items:center; color:red; ">
                                    <h4 style=" color:red; ">Invoice&nbsp;<h4 style=" color:red; ">INV/{{ $invoiceNo }}</h3>
                                        </h4>
                                </div>
        
                                <div class="invice-date-section" style="display:flex; width: 100%; align-items:center; margin-bottom:10px;">
                                    <div style="width: 32%; float: left;">
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Invoice Date:</p>
                                        <p>{{ $shipping->created_at->format('d/m/Y') }}</p>
                                    </div>
                                   {{--  <div style="width: 32%; float: left;">
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Due Date:</p>
                                        <p>{{ $shipping->created_at->format('d/m/Y') }}</p>
                                    </div> --}}
                                   {{--  <div style="width: 32%; float: left;">
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Source:</p>
                                        <p>S12379</p>
                                    </div> --}}
                                </div>
                                <div class="invice-date-table" style=" width: 100%; margin-top:2px; height:700px;">
                                    <table
                                        style="width: 100%; border-top: 3px solid black; border-bottom: 3px solid black; border-collapse: collapse;">
                                        <tr>
                                            <th
                                                style="border-bottom: 1px solid rgb(162, 161, 161); padding: 10px; text-align: center;">
                                                PRODUCT</th>
                                            <th
                                                style="border-bottom: 1px solid rgb(162, 161, 161); padding: 10px; text-align: right;">
                                                QUANTITY</th>
                                            <th
                                                style="border-bottom: 1px solid rgb(162, 161, 161); padding: 10px; text-align: right;">
                                                UNIT PRICE</th>
                                            <th
                                                style="border-bottom: 1px solid rgb(162, 161, 161); padding: 10px; text-align: right;">
                                                TOTAL PRICE</th>
                                        </tr>
                                     @foreach ($order_items as $order_item)
                                        <tr>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align:left;">{{ $order_item->product->product_name }} </td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd;text-align:right;">{{ $order_item->product_qty }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{number_format( $order_item->product_varient->price,2 )}}</td>
                                            <td style=" padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{ number_format($order_item->product_qty * $order_item->product_varient->price,2) }}
                                             @php
                                                $subtotalInvoice +=
                                                    $order_item->product_qty *
                                                    $order_item->product_varient->price;
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align:left;">{{ $order_item->product->product_name }} </td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd;text-align:right;">{{ $order_item->product_qty }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{number_format( $order_item->product_varient->price,2 )}}</td>
                                            <td style=" padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{ number_format($order_item->product_qty * $order_item->product_varient->price,2) }}
                                             @php
                                                $subtotalInvoice +=
                                                    $order_item->product_qty *
                                                    $order_item->product_varient->price;
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align:left;">{{ $order_item->product->product_name }} </td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd;text-align:right;">{{ $order_item->product_qty }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{number_format( $order_item->product_varient->price,2 )}}</td>
                                            <td style=" padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{ number_format($order_item->product_qty * $order_item->product_varient->price,2) }}
                                             @php
                                                $subtotalInvoice +=
                                                    $order_item->product_qty *
                                                    $order_item->product_varient->price;
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align:left;">{{ $order_item->product->product_name }} </td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd;text-align:right;">{{ $order_item->product_qty }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{number_format( $order_item->product_varient->price,2 )}}</td>
                                            <td style=" padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${{ number_format($order_item->product_qty * $order_item->product_varient->price,2) }}
                                             @php
                                                $subtotalInvoice +=
                                                    $order_item->product_qty *
                                                    $order_item->product_varient->price;
                                            @endphp
                                            </td>
                                        </tr>
                                     @endforeach
                                    </table>
                                    <table style="width:100%; border-collapse: collapse;">
                                        <tr>
                                            <th colspan="2"> &nbsp;</th>
                                            <th colspan="1"
                                                style="border-bottom: 2px solid rgb(0, 0, 0); padding: 10px 0px; text-align: left;">
                                                Total</th>
                                            <th style="border-bottom: 2px solid rgb(0, 0, 0); padding: 10px; text-align: right;">
                                                ${{ number_format($subtotalInvoice,2 )}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2"> &nbsp;</th>
                                            <th colspan="1" style=" padding: 10px 0px; text-align: left;">Total Due:</th>
                                            <th style=" padding: 10px; text-align: right;"> ${{ number_format($subtotalInvoice,2 )}}</th>
                                        </tr>
                                        <tr>
                                            <td style="padding-left:10px; padding-top: 18px; width:65%;">
                                              &nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @if($payment_type=="COD")
                                <div style="padding-left:10px;">
                                    <p> Please use the following communication for your payment : INV/{{ $invoiceNo }}</p>
                                    <p style="font-size: 14px; font-weight:700" >R2 TESTED AND DATA SANTIZIED</p>     
                                    <p style="font-size: 14px; font-weight:700">WIRE INSTRUCTION BELOW:</p>     
                                    <p style="font-size: 14px; font-weight:700">MPW NC INC</p>    
                                    <p style="font-size: 14px; font-weight:700">FIRST CITIZEN BANK</p>   
                                    <p style="font-size: 14px; font-weight:700">ACCOUNT:&nbsp; &nbsp; 143167510</p>  
                                    <p style="font-size: 14px; font-weight:700">ROUTING:&nbsp; &nbsp; 053100300</p>
                                </div>
                                @endif
                                <div class="invice-footer-section" style="display:flex; border-top:3px solid black; width: 100%; align-items:center; margin-top:10px; padding:10px;">
                                    <div style="width: 32%; float: left;">
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Hours:</p>
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">M-F - 9 AM - 6 PM</p>
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Sat - 10 AM - 2 PM</p>
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Sun - Closed</p>
                                    </div>
                                    <div style="width: 32%; float: left;">
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">3141 Amity Ct</p>
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Suite 300</p>
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">Charlotte NC 28215</p>
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">United States</p>
                                    </div>
                                    <div style="width: 32%; float: left;">
                                        <p style="font-weight: 600; color:rgb(18, 18, 18)">The source for all your
                                            wholesale needs</p>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
                   
                    @if($payment_type=="COD")
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <table class="table  table-bordered p-0 " style="background: #fff !important;">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            Wire Transfer Information
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="  pl-2 w-50">Bank Name</td>
                                        <td class=" pl-2 w-50">FIRST CITIZEN BANK</td>
                                    </tr>
                                    <tr>
                                        <td class=" pl-2 w-50">ACCOUNT No </td>
                                        <td class=" pl-2 w-50" style="letter-spacing: 2px;">143167510</td>
                                    </tr>
                                    <tr>
                                        <td class=" pl-2 w-50">ROUTING</td>
                                        <td class="  pl-2 w-50" style="letter-spacing: 2px;">053100300</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class=" p-2 text-center">
                                            <a href="#" id="viewInvoice" class="btn btn-sm btn-secondary p-2 my-1">
                                                <i class="icon-eye"></i>View Invoice
                                            </a>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    @endif
                    <div class="row">
                        @if($payment_type!="COD")
                        <div class="col-12  text-right ">
                            <a href="#" id="viewInvoice" class="btn btn-sm btn-secondary p-2 my-1 text-end">
                                <i class="icon-eye"></i>View Invoice
                            </a>
                        </div>
                        @endif
                        <div class="col-md-6 m-0 p-0">
                            <div class="card border">
                                <div class="card-header  text-center mt-2">
                                    <h5>Order Products List</h5>
                                </div>
                             
                                <div class="card-body">
                                    <table class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Item No</th>
                                                <th scope="col">Product name</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Color</th>
                                                <th scope="col">Storage</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_items as $order_item)
                                                <tr>
                                                    <th scope="row"> {{ $loop->iteration }} </th>
                                                    <td>{{ $order_item->product->product_name }}</td>
                                                    <td style="text-align:center"> <img
                                                            src="{{ asset($order_item->product_varient->image) }}"
                                                            style="width: 50px;" alt=""></td>
                                                    <td>${{ $order_item->product_varient->price }}x{{ $order_item->product_qty }}
                                                    </td>
                                                    <td>{{ $order_item->product_varient->colors->first()->color_name }}</td>
                                                    <td>{{ $order_item->product_varient->storage }}</td>
                                                    <td><span>$</span>{{ $order_item->product_qty * $order_item->product_varient->price }}
                                                    </td>
                                                    @php
                                                        $subtotal +=
                                                            $order_item->product_qty *
                                                            $order_item->product_varient->price;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6"
                                                    style="text-align: right; padding-right:4px; font-size:16px; font-weight:500 ">
                                                    Sub Total</td>
                                                <td style=" font-size:16px; font-weight:500 ">
                                                    ${{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-0 p-0">
                            <div class="card border">
                                <div class="card-header  text-center">
                                    <h5 class="pt-2">Shipping Address</h5>
                                </div>
                                @php
                                    $count = 1;
                                @endphp
                                <div class="card-body">
                                    <table class="table table-hover table-bordered ">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center"> Address Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shippings as $shipping)
                                                <tr>
                                                    <td class="pl-2 w-50"> Name</td>
                                                    <td class="pl-2 w-50">{{ $shipping->user_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-2 w-50">Phone</td>
                                                    <td class="pl-2 w-50">{{ $shipping->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-2 w-50">Email</td>
                                                    <td class="pl-2 w-50">{{ $shipping->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-2 w-50">Address</td>
                                                    <td class="pl-2 w-50">{{ $shipping->shiping_address }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
