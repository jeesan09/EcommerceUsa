<?php

namespace App\Http\Controllers\Admin;

use App\Admin\color;
use App\Admin\ProductVarient;
use Illuminate\Support\Facades\DB;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\facades\Image;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }
  public function index()
  {
    $categories = Category::latest()->get();
    $brands = Brand::latest()->get();
    $colors = color::get();
    return view('admin.product.index', compact('categories', 'brands', 'colors'));
  }
  public function productAdded(Request $request)
  {

    $request->validate([
      'product_name' => 'required|max:255',
      'product_code' => 'required|max:255',
      'brand_name' => 'required|max:255',
      'category_name' => 'required|max:255',
      'sort_description' => 'required',
      'long_description' => 'required',
    ]);

    $product_id =  Product::insertGetId([
      'product_name' => $request->product_name,
      'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
      'product_code' => $request->product_code,
      'brand_name' => $request->brand_name,
      'category_name' => $request->category_name,
      'sort_description' => $request->sort_description,
      'long_description' => $request->long_description,
      'created_at' => Carbon::now(),
    ]);
  $slug = strtolower(str_replace(' ', '-', $request->product_name)) . '-' . $product_id;
  Product::where('id', $product_id)->update(['product_slug' => $slug]);

    $conditions = $request->condition;
    $colors = $request->color;
    $storages = $request->storage;
    $prices = $request->price;
    $quantities = $request->qty;
    $images = $request->image;

    foreach ($prices as $index => $price) {
      if ($request->hasFile('image')) {
        $image_varient =  $images[$index];
        $name_gnrtn_verirnt = hexdec(uniqid()) . "." . $image_varient->getClientOriginalExtension();
        \Image::make($image_varient)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gnrtn_verirnt);
        $image_url_varient = 'frotend/img/product/upload/' . $name_gnrtn_verirnt;
      } else {
        $image_url_varient = null;
      }

      $productVariant = new ProductVarient;
      $productVariant->product_id = $product_id;
      $productVariant->condition = $conditions[$index];
      $productVariant->color_id = $colors[$index];
      $productVariant->storage = $storages[$index];
      $productVariant->price = $price;
      $productVariant->quantity = $quantities[$index];
      $productVariant->image = $image_url_varient;
      $productVariant->save();
    }

    return redirect()->back()->with('success', 'Product Successfuly Added.');
  }

  public function productList()
  {
    $products = Product::with('product_varient')->latest()->get();
    //$products = Product::latest()->get();

    return view('admin.product.product-list', compact('products'));
  }


  public function productedit($id)
  {
    $categories = Category::latest()->get();
    $brands = Brand::latest()->get();
    $product_edit = Product::where('id', $id)->get();
    $product_varient = ProductVarient::where('product_id', $id)->get();
    $colors = color::get();
    return view('admin.product.edit', compact('product_edit', 'categories', 'brands', 'colors', 'product_varient'));
  }

  public function productUpdate(Request $request, $id)
  {
    $request->validate([
      'product_name' => 'required|max:255',
      'product_code' => 'required|max:255',
      'brand_name' => 'required|max:255',
      'category_name' => 'required|max:255',
      'sort_description' => 'required',
      'long_description' => 'required',
    ]);

    $product = Product::findOrFail($id); 
    $product->product_name = $request->product_name;
  /*   $product->product_slug = strtolower(str_replace(' ', '-', $request->product_name)); */
    $product->product_code = $request->product_code;
    $product->brand_name = $request->brand_name;
    $product->category_name = $request->category_name;
    $product->sort_description = $request->sort_description;
    $product->long_description = $request->long_description;
    $product->updated_at = Carbon::now();
    $product->save();
    $slug = strtolower(str_replace(' ', '-', $request->product_name)) . '-' . $id;
    Product::where('id', $id)->update(['product_slug' => $slug]);
    $conditions = $request->conditionNew;
    $colors = $request->colorNew;
    $storages = $request->storageNew;
    $prices = $request->priceNew;
    $quantities = $request->qtyNew;
    $images = $request->imageNew;

    if($request->has('priceNew')){
      foreach ($prices as $index => $price) {
        if ($request->hasFile('imageNew')) {
          $image_varient =  $images[$index];
          $name_gnrtn_verirnt = hexdec(uniqid()) . "." . $image_varient->getClientOriginalExtension();
          \Image::make($image_varient)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gnrtn_verirnt);
          $image_url_varient = 'frotend/img/product/upload/' . $name_gnrtn_verirnt;
        } else {
          $image_url_varient = null;
        }
  
        $productVariant = new ProductVarient;
        $productVariant->product_id = $id;
        $productVariant->condition = $conditions[$index];
        $productVariant->color_id = $colors[$index];
        $productVariant->storage = $storages[$index];
        $productVariant->price = $price;
        $productVariant->quantity = $quantities[$index];
        $productVariant->image = $image_url_varient;
        $productVariant->save();
      }
    }

    return redirect()->route('product.list')->with('success', 'Product Successfuly Updated.');
  }

  public function singleProductUpdate(Request $request, $id)
  {
    $productVariant = ProductVarient::find($id);
    if ($request->hasFile('image')) {
    
      $image_varient = $request->image;
      $name_gnrtn_verirnt = hexdec(uniqid()) . "." . $image_varient->getClientOriginalExtension();
      \Image::make($image_varient)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gnrtn_verirnt);
      $image_url_varient = 'frotend/img/product/upload/' . $name_gnrtn_verirnt;
      $productVariant->image = $image_url_varient;
    }
    $productVariant->product_id = $request->product_id;
    $productVariant->condition = $request->condition;
    $productVariant->color_id =  $request->color;
    $productVariant->storage =  $request->storage;
    $productVariant->price =  $request->price;
    $productVariant->quantity =  $request->qty;
    $productVariant->save();
    return redirect()->route('product.list')->with('success', 'Product Successfuly Updated.');
  }
  public function productDeletesingle( $id)
  {
    $productVariant = ProductVarient::find($id);
    if ($productVariant->image) {
      $oldImagePath = public_path($productVariant->image);
      if (file_exists($oldImagePath)) {
          unlink($oldImagePath);
      }
   }
   $productVariant->delete();
    return redirect()->route('product.list')->with('success', 'Product Successfuly Updated.');
  }
  


  public function productImage(Request $request, $id)
  {
    $old_img1 = $request->image_one;
    $old_img2 = $request->image_two;
    $old_img3 = $request->image_three;
    $old_img4 = $request->image_four;
    $old_img5 = $request->image_five;
    $old_img6 = $request->image_six;

    if ($old_img1 != '') {

      if ($request->has('product_img_one')) {
        if ($old_img1 != "") {
          unlink($old_img1);
        }


        $image_one = $request->file('product_img_one');
        $name_gena = hexdec(uniqid()) . "." . $image_one->getClientOriginalExtension();
        \Image::make($image_one)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gena);
        $image_url = 'frotend/img/product/upload/' . $name_gena;
        Product::find($id)->update([
          'product_img_one' => $image_url,
          'updated_at' => Carbon::now(),
        ]);
      }

      if ($request->has('product_img_two')) {
        if ($old_img2 != "") {
          unlink($old_img2);
        }

        $image_two = $request->file('product_img_two');
        $name_gena2 = hexdec(uniqid()) . "." . $image_two->getClientOriginalExtension();
        \Image::make($image_two)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gena2);
        $image_url2 = 'frotend/img/product/upload/' . $name_gena2;
        Product::find($id)->update([
          'product_img_two' => $image_url2,
          'updated_at' => Carbon::now(),
        ]);
      }

      if ($request->has('product_img_three')) {

        if ($old_img3 != "") {
          unlink($old_img3);
        }

        $image_three = $request->file('product_img_three');
        $name_gena3 = hexdec(uniqid()) . "." . $image_three->getClientOriginalExtension();
        \Image::make($image_three)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gena3);
        $image_url3 = 'frotend/img/product/upload/' . $name_gena3;
        Product::find($id)->update([
          'product_img_three' => $image_url3,
          'updated_at' => Carbon::now(),
        ]);
      }

      if ($request->has('product_img_four')) {
        if ($old_img4 != "") {
          unlink($old_img4);
        }

        $image_four = $request->file('product_img_four');
        $name_gena4 = hexdec(uniqid()) . "." . $image_four->getClientOriginalExtension();
        \Image::make($image_four)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gena4);
        $image_url4 = 'frotend/img/product/upload/' . $name_gena4;
        Product::find($id)->update([
          'product_img_four' => $image_url4,
          'updated_at' => Carbon::now(),
        ]);
      }

      if ($request->has('product_img_five')) {
        if ($old_img5 != "") {
          unlink($old_img5);
        }

        $image_five = $request->file('product_img_five');
        $name_gena5 = hexdec(uniqid()) . "." . $image_five->getClientOriginalExtension();
        \Image::make($image_five)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gena5);
        $image_url5 = 'frotend/img/product/upload/' . $name_gena5;
        Product::find($id)->update([
          'product_img_five' => $image_url5,
          'updated_at' => Carbon::now(),
        ]);
      }
      if ($request->has('product_img_six')) {
        if ($old_img6 != "") {
          unlink($old_img6);
        }

        $image_six = $request->file('product_img_six');
        $name_gena6 = hexdec(uniqid()) . "." . $image_six->getClientOriginalExtension();
        \Image::make($image_six)->resize(2070, 2070)->save('frotend/img/product/upload/' . $name_gena6);
        $image_url6 = 'frotend/img/product/upload/' . $name_gena6;
        Product::find($id)->update([
          'product_img_six' => $image_url6,
          'updated_at' => Carbon::now(),
        ]);
      }

      return redirect()->route('product.list')->with('success', 'Image Successfuly Updated.');
    }
  }

  public function deactive_prod($id)
  {
    Product::findOrfail($id)->update([
      'product_status' => '0',
      'updated_at' => Carbon::now(),
    ]);
    return back()->with('success_delete', 'Product successfully deactived');
  }

  public function active_prod($id)
  {
    Product::findOrfail($id)->update([
      'product_status' => '1',
      'updated_at' => Carbon::now()
    ]);
    return back()->with('success', 'Product successfully actived');
  }


  public function product_delete($id)
  {
    $pro_image =  Product::where('id', $id)->get();

    foreach ($pro_image as $pro_img) {
      if ($pro_img->product_img_one != "") {
        unlink($pro_img->product_img_one);
      }
      if ($pro_img->product_img_two != "") {
        unlink($pro_img->product_img_two);
      }
      if ($pro_img->product_img_three != "") {
        unlink($pro_img->product_img_three);
      }
      if ($pro_img->product_img_four != "") {
        unlink($pro_img->product_img_four);
      }
      if ($pro_img->product_img_five != "") {
        unlink($pro_img->product_img_five);
      }
      if ($pro_img->product_img_six != "") {
        unlink($pro_img->product_img_six);
      }
    }

    Product::where('id', $id)->delete();
    return redirect()->back()->with('success_delete', 'Product Deleted Success ');
  }
}
