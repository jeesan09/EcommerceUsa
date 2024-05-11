<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
session_start();
class ChekoutController extends Controller
{
    public function index()
    {
       $user_id =  Auth::user()->id;
        $sub_total = Cart::all()->where('user_ip',  $user_id)->sum(function($t){
            return  $t->price * $t->qty;
            });

            $cart_join_prod = DB::table('products')
            ->join('carts', 'products.id', '=', 'carts.product_id')
            ->where('user_ip',  $user_id)
            ->get(); 

        if(Auth::check()){
            return view('pages.checkout_this',compact('sub_total', 'cart_join_prod'));
        }else{
            return redirect()->route('login');
        }
       
   }



   
}
