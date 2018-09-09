<?php

namespace DoubleVShop;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    function product(){
    	return $this->hasOne(Product::class);
    }
}
