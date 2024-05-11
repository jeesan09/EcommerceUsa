<?php

namespace App;

use App\Admin\ProductVarient;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded=[];
    
    public function product()
    {
           return $this->belongsTo(Product::class,'product_id');
    }

    public function product_varient()
    {
           return $this->belongsTo(ProductVarient::class,'product_variant_id');
    }
}

