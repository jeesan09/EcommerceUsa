<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderItem;
use App\Shipping;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
session_start();
class OrderController extends Controller
{
  public function proccessTo_check(Request $request)
  {
    $user_id =  Auth::user()->id;
    $request->validate([
      'frist_name' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'country' => 'required',
      'division' => 'required',
      'district' => 'required',
      'thana' => 'required',
      'address_holdding' => 'required'
    ]);
    $order_id = Order::insertGetId([
      'user_id' => Auth::id(),
      'invoice' =>  mt_rand(10000000, 99999999),
      'payemnt_type' => $request->payment_type,
      'total' => $request->total,
      'payment_inside'=>$request->payment_inside,
      'subtotal' => $request->subtotal,
      'copon_discount' => $request->discount,
      'created_at' => Carbon::now(),
    ]);

    $carts = Cart::where('user_ip',  $user_id)->latest()->get();

    if ($carts->count() >= 1) {
      foreach ($carts as $cart) {
        OrderItem::insert([
          'order_id' => $order_id,
          'product_id' => $cart->product_id,
          'product_qty' => $cart->qty,
          'product_size' => $cart->product_size,
          'product_color' => $cart->product_color,
          'created_at' => Carbon::now(),
        ]);
      }
      Shipping::insert([
        'order_id' => $order_id,
        'frist_name' => $request->frist_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'country' => $request->country,
        'division' => $request->division,
        'district' => $request->district,
        'thana' => $request->thana,
        'address_holdding' => $request->address_holdding,
        'created_at' => Carbon::now(),
      ]);

      if (Session::has('copon')) {
        session()->forget('copon');
      }

      $carts = Cart::where('user_ip',  $user_id)->delete();

      return redirect()->to('my-profile/')->with('success', 'Order successfuly Submit');
    } else {
      return redirect()->route('all.product')->with('success_delete', 'Cart Is empty Please try Again');
    }
  }

  public function my_profile()
  {
    if (Auth::check()) {
     $users = User::where('id', Auth::id())->get();
      $orders =  Order::where('user_id', Auth::user()->id)->latest()->paginate(10);
      return view('pages.my_profile', compact('orders','users'));
    } else {
      return redirect()->route('login');
    }
  }

  public function my_profile_ajax()
  {
    if (Auth::check()) {
     $users = User::where('id', Auth::id())->get();
      $orders =  Order::where('user_id', Auth::user()->id)->latest()->get();
      return view('pages.my_profile_reload', compact('orders','users'));
    } else {
      return redirect()->route('login');
    }
  }
  public function my_order_details(Request $request)
  {
   $payment_type = $request->payment_type;
   $invoiceNo=  $request->invoiceNo;
    $shippings = Shipping::where('order_id', $request->id)->orderBy('id', 'desc')->get();
    $order_items = OrderItem::where('order_id', $request->id)->get();
    return view('pages.order-details', compact('shippings', 'order_items','payment_type','invoiceNo'));
  }


  public function my_order_cancel($oder_id)
  {
     Order::where('id',$oder_id)->update([
      'order_status'=>5,
      'updated_at'=>Carbon::now(),
  ]);
    return redirect()->back()->with('success', 'Successfully Order cancel');
  }


public function my_password_change(Request $request)
{
   $request->validate([
      'old_pass'=>'required',
      'new_pass'=>'required|min:6',
      'confirm_pass'=>'required|min:6',
   ]);
  Auth::user()->id;
$db_pass = Auth::user()->password;
  if(Hash::check($request->old_pass,$db_pass)){ 
   if($request->new_pass==$request->confirm_pass){
    User::find(Auth::user()->id)->update([
      'password'=>Hash::make($request->confirm_pass),
      'updated_at'=>Carbon::now(),
    ]);
    return redirect()->back()->with('success', 'Password Successfully Change');

   }else{
    return redirect()->back()->with('success_delete', 'New password & Confirm Password Not Match');
   }
  }else{
    return redirect()->back()->with('success_delete', 'Password Not Change, Old Password Not Match ');
  }

}

public function user_update(Request $request)
{

   //return $request;
    $request->validate([
      'name'=>'required',
      'reseller_ID'=>'required',
      'phone'=>'required',
      'email'=>'required',
      'company_name'=>'required',
      'shipping_address'=>'required',
      'billing_address'=>'required',
    ]);

   $user = User::where('id',$request->user_id)->update([
      'name'=>$request->name,
      'reseller_ID'=>$request->reseller_ID,
      'phone'=>$request->phone,
      'email'=>$request->email,
      'company_name'=>$request->company_name,
      'shipping_address'=>$request->shipping_address,
      'billing_address'=>$request->billing_address,
      'address_holdding'=>$request->address_holdding,
    ]);

    return redirect()->back()->with('success','Profile Successfuly Updated');
}


}
