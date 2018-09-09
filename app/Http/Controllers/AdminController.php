<?php

namespace DoubleVShop\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index(Request $request){
        $category = \DoubleVShop\Category::all();
        $product = \DoubleVShop\Product::all();
        $news = \DoubleVShop\News::all();
        $cat_count = $category->count();
        $prod_count = $product->count();
        $news_count = $news->count();
        $last_post = DB::table('products')->latest()->first();
    	return view('admin/content/index', compact('cat_count', 'prod_count', 'news_count', 'last_post'));
    }

    public function user(Request $request){
    	return view('admin/content/user');
    }

    public function category(Request $request){
    	return view('admin/content/category');
    }

    public function product(Request $request){
    	return view('admin/content/product');
    }
}
