<?php

namespace App\Http\Controllers;

use App\AboutPage;
use App\Brand;
use App\Category;
use App\Order;
use App\Product;
use App\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
session_start();
class FrontendController extends Controller
{
    public function index()
    {
        // only for ajax
        $products_se = Product::where('id',0)->latest()->get();
       // only for ajax end
        $products = Product::with('product_varient')->where('product_status',1)->latest()->offset(0)->limit(12)->get();
        $sliders = SliderModel::where('status',1)->latest()->offset(0)->limit(8)->get();
        $side_sliders = SliderModel::where('status',1)->latest()->offset(0)->limit(2)->get();
        $categoris = Category::where('status', 1)->latest()->offset(0)->limit(8)->get();
        $brands = Brand::where('status', 1)->latest()->offset(0)->limit(8)->get();
        $products_brand = Product::with('product_varient')->where('product_status',1)->latest()->offset(0)->limit(16)->get();

      //  dd($products_brand, $products);

        return view('pages.index', compact('products','categoris','brands','products_brand','products_se','sliders','side_sliders'));

    }

    // ajax product details page
    public function product_details(Request $request)
    {
        $products_se = Product::where('id',$request->product_id)->latest()->get();
        return view('pages.search_result', compact('products_se'))->render();
    }
    // ajax product details page  END

  public function about_page()
  {
    $about_page = AboutPage::latest()->get();
    return view('pages.about_page',compact('about_page'));
  }
public function contact_page()
{
    return view('pages.contact_page');
}

public function orderSuccesfullyCompalte()
{
  $user_id = Auth::user()->id;
   $order_id =  Order::where('user_id', $user_id)->orderBy('created_at', 'DESC')->limit('1')->get();
    foreach($order_id as $or_id){
    $id = $or_id->id;
    }
    $join_table = DB::table('orders')
    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    ->join('shippings', 'orders.id', '=', 'shippings.order_id')
    ->join('products', 'order_items.product_id', '=', 'products.id')
    ->select('order_items.*','orders.*', 'products.product_name','shippings.user_name','shippings.phone','shippings.shiping_address')
    ->where('orders.id', $id )->orderBy('order_items.created_at', 'DESC')->get();

    return view('pages.buy-now-order-success', compact('join_table'));
}


public function search_all_product(Request $request)
{
  $products = Product::query()
        ->with('brand', 'category', 'variants')
        ->whereHas('brand', function ($query) use ($request) {
            $query->where('brand_name', 'LIKE', "%{$request->search_product}%");
        })
        ->orWhereHas('category', function ($query) use ($request) {
            $query->where('category_name', 'LIKE', "%{$request->search_product}%");
        })
        ->orWhere('product_name', 'LIKE', "%{$request->search_product}%")
        ->orWhereHas('variants', function ($query) use ($request) {
            $query->where('storage', 'LIKE', "%{$request->search_product}%");
        })
        ->paginate(30);

  return view('pages.only_search_result', compact('products'));
}


}
