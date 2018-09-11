<?php

namespace DoubleVShop;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $primaryKey = 'id';

    function productImages(){
    	return $this->hasMany(ProductImage::class);
    }

    function category(){
    	return $this->hasOne(Category::class);
    }
}
