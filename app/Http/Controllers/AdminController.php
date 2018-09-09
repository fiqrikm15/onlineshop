<?php

namespace DoubleVShop\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){
    	return view('admin/content/index');
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
