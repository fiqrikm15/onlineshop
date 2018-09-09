<?php

namespace DoubleVShop;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    function news(){
    	return $this->hasOne(News::class);
    }
}
