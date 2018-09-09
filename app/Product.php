<?php

namespace DoubleVShop;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function productImages(){
    	return $this->hasMany(productImage::class);
    }
}
