<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
session_start();
class WishListController extends Controller
{
    public function index()
    {
        $user_id =  Auth::user()->id;
        $wishlists_pro =   Wishlist::where('user_ip', $user_id)->get();
        return view('pages.wishlist-page', compact('wishlists_pro'));
    }


    public function add_wisshlist(Request $request)
    {
        $id = $request->product_id;
        $user_ip =  Auth::user()->id;
        $check = Wishlist::where('product_id', $id)->first();
        if ($check) {
            return redirect()->back()->with('success_delete', 'Allready Product wishlist');
        } else {
            Wishlist::insert([
                'user_ip' => $user_ip,
                'product_id' => $id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Successfuly Add Wishlist');
        }
    }
    public function product_remove($id)
    {
       Wishlist::where('id',$id)->delete();
       return redirect()->back()->with('success_delete', 'Successfuly Remove Wishlist');
    }
}
