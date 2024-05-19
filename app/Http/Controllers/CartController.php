<?php

namespace App\Http\Controllers;

use App\Admin\ProductVarient;
use App\Cart;
use App\Copon;
use App\Order;
use App\OrderItem;
use App\Product;
use App\Shipping;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

session_start();

class CartController extends Controller
{
    public function cartListRender()
    {
        $user_id = Auth::user()->id;
        $sub_total = Cart::all()
            ->where('user_ip', $user_id)
            ->sum(function ($t) {
                return $t->price * $t->qty;
            });

        $carts = Cart::with('product', 'product_varient')->where('user_ip', $user_id)->latest()->get();

        return view('layouts.sidebar-right.cart-list', compact('carts', 'sub_total'));
    }

    public function cart_update_qty(Request $request)
    {
        $cart = Cart::find($request->cartId);
        $cart->qty = $request->qty;
        $cart->save();
        return response()->json([
            'success' => 'Cart item quantity updated',
        ]);
    }
    public function cart_item_removed(Request $request)
    {
        Cart::find($request->cartId)->delete();
        return response()->json([
            'success' => 'Cart item removed',
        ]);
    }
    public function cart_item_removed_all(Request $request)
    {
        $user_id = Auth::user()->id;
        Cart::where('user_ip', $user_id)->delete();
        return response()->json([
            'success' => 'Cart item removed all',
        ]);
    }

    public function buy_now_add(Request $request)
    {
        $user_id = Auth::user()->id;
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
        $check = Cart::where('product_id', $product_id)->where('product_varient_id', $varient_id)->where('user_ip', $user_id)->first();

        if ($check) {
            $check->qty += $qty;
            $check->save();
            return response()->json([
                'success' => 'Product added to cart',
            ]);
        } else {
            Cart::create([
                'product_id' => $product_id,
                'qty' => $qty,
                'price' => $product_price,
                'product_varient_id' => $varient_id,
                'user_ip' => $user_id,
            ]);

            return response()->json([
                'success' => 'Product added to cart',
            ]);
        }
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

    public function paymentCheckout(Request $request)
    {
        $user = Auth::user();
        $cart_join_prod = DB::table('products')
            ->join('carts', 'products.id', '=', 'carts.product_id')
            ->where('user_ip', $user->id)
            ->get();
        $sub_total = Cart::all()
            ->where('user_ip', $user->id)
            ->sum(function ($t) {
                return $t->price * $t->qty;
            });
        if ($sub_total > 0) {
            return view('pages.check-out-buy-page', compact('user', 'cart_join_prod', 'sub_total'));
        } else {
            Session::flash('success_delete', 'Cart list is empty');
            return redirect()->back();
        }
    }
    public function orderCheckout(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::where('user_ip', $user->id)->get();
        if ($carts->isNotEmpty()) {
            DB::beginTransaction();
            try {
                $order_id = Order::insertGetId([
                    'user_id' => Auth::id(),
                    'invoice' => mt_rand(10000000, 99999999),
                    'payment_type' => 'COD',
                    'total' => $request->subtotal,
                    'payment_inside' => 'COD',
                    'payment_status' => 0,
                    'order_status' => '1',
                    'subtotal' => $request->subtotal,
                    'stripe_id' => null,
                    'stripe_url' => null,
                    'created_at' => Carbon::now(),
                ]);

                if (count($carts) >= 1) {
                    foreach ($carts as $cart) {
                        OrderItem::insert([
                            'order_id' => $order_id,
                            'product_id' => $cart->product_id,
                            'product_qty' => $cart->qty,
                            'product_variant_id' => $cart->product_varient_id,
                            'product_color' => null,
                            'created_at' => Carbon::now(),
                        ]);

                        ProductVarient::where('id', $cart['product_varient_id'])->decrement('quantity', $cart['qty']);
                    }
                }

                Shipping::insert([
                    'order_id' => $order_id,
                    'user_name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'shiping_address' => $user->shipping_address,
                    'created_at' => Carbon::now(),
                ]);

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                Log::error('Transaction failed: ' . $e->getMessage());
                throw $e;
            }

            $carts = Cart::where('user_ip', $user->id)->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }


         //   $carts = Cart::where('user_ip', $user->id)->delete();
            return redirect()->to('my-profile/')->with('success', 'Order successfuly submit');
        } else {
            dd(0);
        }
    }
}
