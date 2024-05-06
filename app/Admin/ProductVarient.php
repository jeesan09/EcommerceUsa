<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\color as Color;
class ProductVarient extends Model
{
    public function colors()
    {
        return $this->hasMany(Color::class,'id','color_id');
    }
}
