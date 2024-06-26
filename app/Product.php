<?php

namespace App;

use App\Admin\ProductVarient;
use Illuminate\Database\Eloquent\Model;
use App\Admin\color as Color;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_code', 'product_price', 'product_quantity', 'brand_name', 'category_name','product_size','product_color', 'sort_description', 'long_description', 'product_img_one', 'product_img_two', 'product_img_three',  'product_img_four', 'product_img_five','product_img_six','product_status', 'product_slug',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_name');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_name');
    }

    public function product_varient()
    {
        return $this->hasMany(ProductVarient::class,'product_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVarient::class);
    }

}
