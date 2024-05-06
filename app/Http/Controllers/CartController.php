<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Copon;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();


class CartController extends Controller
{
   public function cart_page()
   {
      $sub_total = Cart::all()->where('user_ip',  session_id())->sum(function ($t) {
         return  $t->price * $t->qty;
      });
      $carts = Cart::where('user_ip',  session_id())->get();
      return view('pages.cartpage', compact('carts', 'sub_total'));
   }

   public function cartListRender()
   {
      $sub_total = Cart::all()->where('user_ip',  session_id())->sum(function ($t) {
         return  $t->price * $t->qty;
      });
 
      $carts = Cart::with('product','product_varient')->where('user_ip',  session_id())->latest()->get();
      
      return view('layouts.sidebar-right.cart-list', compact('carts', 'sub_total'));
   }

   public function cart_update_qty(Request $request)
   {
     $cart = Cart::find($request->cartId);
     $cart->qty = $request->qty;
     $cart->save();
     return response()->json([
      'success'=>'Cart item quantity updated'
     ]);
   }
   public function cart_item_removed(Request $request)
   {
    Cart::find($request->cartId)->delete();
     return response()->json([
      'success'=>'Cart item removed'
     ]);
   }


   //ajux add to cart 
   public function add_to_cart(Request $request, $product_id)
   {
      $request->validate([
         'product_size' => 'required',
         'product_color' => 'required',
         'qty' => 'required',
      ]);

      $product_id = $product_id;
      $qty = $request->qty;
      $product_price = $request->product_price;
      $product_size = $request->product_size;
      $product_color = $request->product_color;

      $check = Cart::where('product_id', $product_id)->where('user_ip',  session_id())->first();
      if ($check) {
         // Cart::where('product_id', $product_id)->increment('qty');
         // return redirect()->back()->with('success', 'product allready Cart');
         Cart::insert([
            'product_id' => $product_id,
            'price' => $product_price,
            'qty' => $qty,
            'product_size' => $product_size,
            'product_color' => $product_color,
            'user_ip' =>  session_id()
         ]);
         return redirect()->back()->with('success', 'product add to Cart');
      } else {
         Cart::insert([
            'product_id' => $product_id,
            'price' => $product_price,
            'qty' => $qty,
            'product_size' => $product_size,
            'product_color' => $product_color,
            'user_ip' =>  session_id()
         ]);
         return redirect()->back()->with('success', 'product add to Cart');
      }
   }

   public function buy_now_add(Request $request)
   {
    
       $request->validate([
           'storage' => 'required',
           'qty' => 'required',
       ]);
       $price = explode('৳ ', $request->product_price);
       $product_price = preg_replace('/[^0-9.]/', '', $price[1]);
       $product_price = floatval($product_price);
       $values = explode(',', $request->storage); 
       $varient_id = $values[0]; 
       $product_id = $request->product_id;
       $qty = $request->qty;
       $check = Cart::where('product_id', $product_id)->where('product_varient_id',$varient_id )->where('user_ip',  session_id())->first();
     
       if ($check) {
       
           $check->qty += $qty;
           $check->save();
           return response()->json([
               'success' => 'Product added to cart'
           ]);
       } else {
           Cart::create([
               'product_id' => $product_id,
               'qty' => $qty,
               'price' => $product_price,
               'product_varient_id' => $varient_id,
               'user_ip' => session_id()
           ]);
   
           return response()->json([
               'success' => 'Product added to cart'
           ]);
       }
   }
   



   // remove cart itmem
   public function cart_product_remove(Request $request)
   {
      Cart::find($request->cart_id)->delete();
      return redirect()->back()->with('success_delete', 'Cart item remove');
   }

   // remove cart list page
   public function cart_list_page()
   {
      $sub_total = Cart::all()->where('user_ip',  session_id())->sum(function ($t) {
         return  $t->price * $t->qty;
      });
      $carts = Cart::where('user_ip',  session_id())->get();
   
      return view('pages.cart-list', compact('carts', 'sub_total'));
   }

   //cart product update 
   public function cart_product_update(Request $request)
   {
      Cart::where('id', $request->cart_id)->increment('qty');
       if (Session::has('copon')) {
         session()->forget('copon');
      }
      return redirect()->back()->with('success', 'Cart Quantity Updated');
     
   }
   //cart product decriment 
   public function cart_product_decrement(Request $request)
   {
      Cart::where('id', $request->cart_id)->decrement('qty');
      if (Session::has('copon')) {
         session()->forget('copon');
      }
      return redirect()->back()->with('success', 'Cart Quantity Decriment');
      

   }

   //apply Copon in cart product
   public function apply_copon(Request $request)
   {
      $sub_total = Cart::all()->where('user_ip',  session_id())->sum(function ($t) {
         return  $t->price * $t->qty;
      });
      $chack = Copon::where('coupon_name', $request->copon_name)->first();

      if ($chack) {
         Session::put('copon', [
            'coupon_name' => $chack->coupon_name,
            'coupon_discount' => $chack->discount,
            'discount_amount' => $sub_total * ($chack->discount / 100)
         ]);
         return redirect()->back()->with('success', 'Successfuly Coupon Added');
      } else {
         return redirect()->back()->with('success_delete', 'Invalid Coupon please Try Again');
      }
   }


   // Coupun remove 
   public function couponremove()
   {
      if (Session::has('copon')) {
         session()->forget('copon');
         return redirect()->back()->with('success_delete', 'Succesfuly Coupon destroy');
      }
   }

   public function checkout_buy_page()
   {
    $sub_total = Cart::all()->where('user_ip',  session_id())->sum(function($t){
        return  $t->price * $t->qty;
        });

        $cart_join_prod = DB::table('products')
        ->join('carts', 'products.id', '=', 'carts.product_id')
        ->where('user_ip',  session_id())
        ->get();
        return view('pages.check-out-buy-page',compact('sub_total', 'cart_join_prod'));
   }
   

}
