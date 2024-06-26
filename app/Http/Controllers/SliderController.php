<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\SliderModel;
use App\Websitelogo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\facades\Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function s_index()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.slider.index', compact('categories', 'brands'));
    }

    public function s_productAdded(Request $request)
{
    $request->validate([
        'slider_image' => 'required|mimes:jpg,jpeg,gif,png,webp',
    ]);

    // Handle the file upload
    if ($request->hasFile('slider_image')) {
        $image = $request->file('slider_image');
        $name_gena = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('frontend/img/product/upload'), $name_gena);
        $image_url = 'frontend/img/product/upload/' . $name_gena;

        SliderModel::insert([
            'slider_title' => $request->slider_title,
            'slider_image' => $image_url,
            'status' => 0,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Slider Successfully Added.');
    }

    return redirect()->back()->with('error', 'Failed to upload image.');
}
    public function s_productList()
    {
        $products = SliderModel::latest()->get();
        return view('admin.slider.slider-list', compact('products'));
    }
    public function s_deactive_prod($id)
    {
        $slider = SliderModel::findOrFail($id);
        $slider->status = 0;
        $slider->save();
        return back()->with('success_delete', 'Slider successfully deactivated');
    }

    public function s_active_prod($id)
    {
        $slider =  SliderModel::findOrfail($id);
        $slider->status = 1;
        $slider->save();
        return back()->with('success', 'Slider successfully actived');
    }

    public function s_product_delete($id)
    {
        $pro_image = SliderModel::where('id', $id)->get();
        foreach ($pro_image as $pro_img) {
            unlink($pro_img->slider_image);
        }
        SliderModel::where('id', $id)->delete();
        return redirect()->back()->with('success_delete', 'slider Deleted Success ');
    }

    public function s_productedit($id)
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $product_edit = DB::table('slider_models')->select('slider_models.*')->join('brands', 'brands.id', '=', 'slider_models.brand_name')->join('categories', 'categories.id', '=', 'slider_models.category_name')->where('slider_models.id', $id)->get();
        return view('admin.slider.edit', compact('product_edit', 'categories', 'brands'));
    }

    public function s_productUpdate(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'product_price' => 'required|max:255',
            'product_quantity' => 'required|max:255',
            'brand_name' => 'required|max:255',
            'category_name' => 'required|max:255',
            'product_size' => 'required',
            'product_color' => 'required',
            'sort_description' => 'required',
            'long_description' => 'required',
        ]);

        SliderModel::find($id)->update([
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'brand_name' => $request->brand_name,
            'category_name' => $request->category_name,
            'product_size' => json_encode($request->product_size),
            'product_color' => json_encode($request->product_color),
            'sort_description' => $request->sort_description,
            'long_description' => $request->long_description,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('slider.list')->with('success', 'Product Successfuly Updated.');
    }
    public function s_productImage(Request $request, $id)
    {
        $old_img1 = $request->image_one;
        $old_img2 = $request->image_two;
        $old_img3 = $request->image_three;

        if ($old_img1 != '') {
            if ($request->has('product_img_one')) {
                unlink($old_img1);
                $image_one = $request->file('product_img_one');
                $name_gena = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
                \Image::make($image_one)
                    ->resize(2070, 470)
                    ->save('frotend/img/product/upload/' . $name_gena);
                $image_url = 'frotend/img/product/upload/' . $name_gena;
                SliderModel::find($id)->update([
                    'product_img_one' => $image_url,
                    'updated_at' => Carbon::now(),
                ]);
            }

            if ($request->has('product_img_two')) {
                unlink($old_img2);
                $image_two = $request->file('product_img_two');
                $name_gena2 = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
                \Image::make($image_two)
                    ->resize(470, 265)
                    ->save('frotend/img/product/upload/' . $name_gena2);
                $image_url2 = 'frotend/img/product/upload/' . $name_gena2;
                SliderModel::find($id)->update([
                    'product_img_two' => $image_url2,
                    'updated_at' => Carbon::now(),
                ]);
            }

            if ($request->has('product_img_three')) {
                unlink($old_img3);
                $image_three = $request->file('product_img_three');
                $name_gena3 = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
                \Image::make($image_three)
                    ->resize(470, 470)
                    ->save('frotend/img/product/upload/' . $name_gena3);
                $image_url3 = 'frotend/img/product/upload/' . $name_gena3;
                SliderModel::find($id)->update([
                    'product_img_three' => $image_url3,
                    'updated_at' => Carbon::now(),
                ]);
            }

            return redirect()->route('slider.list')->with('success', 'Image Successfuly Updated.');
        }
    }

    function create_logo()
    {
        $logo = Websitelogo::find(1);
        return view('admin.logo.index', compact('logo'));
    }

    function logo_add(Request $request)
    {
        $id = 1;
        if ($request->has('product_img_one')) {
            $image_one = $request->file('product_img_one');
            $name_gena = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            \Image::make($image_one)
                ->resize(250, 70)
                ->save('frotend/img/product/upload/' . $name_gena);
            $image_url = 'frotend/img/product/upload/' . $name_gena;
            Websitelogo::find($id)->update([
                'header_logo' => $image_url,
                'updated_at' => Carbon::now(),
            ]);
        }

        if ($request->has('product_img_two')) {
            $image_two = $request->file('product_img_two');
            $name_gena2 = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            \Image::make($image_two)
                ->resize(300, 180)
                ->save('frotend/img/product/upload/' . $name_gena2);
            $image_url2 = 'frotend/img/product/upload/' . $name_gena2;
            Websitelogo::find($id)->update([
                'footer_logo' => $image_url2,
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Image Successfully upload.');
    }
}
