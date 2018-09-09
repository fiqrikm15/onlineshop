<?php

namespace DoubleVShop;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    function newsImages(){
    	return $this->hasMany(NewsImage::class);
    }
}
