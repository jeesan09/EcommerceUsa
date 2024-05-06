<?php

namespace App;

use App\Admin\ProductVarient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'product_id', 'qty', 'user_ip','product_varient_id','price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function product_varient()
    {
        return $this->belongsTo(ProductVarient::class,'product_varient_id');
    }
}
