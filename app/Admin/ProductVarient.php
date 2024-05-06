<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\color as Color;
use App\Product;

class ProductVarient extends Model
{
    protected $table = 'product_varients'; 
    public function colors()
    {
        return $this->hasMany(Color::class,'id','color_id');
    }

  // Assuming the table name is 'product_varients'

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
