<?php

namespace DoubleVShop;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $primaryKey = 'id';

    function product(){
    	return $this->hasMany(Product::class);
    }
}
