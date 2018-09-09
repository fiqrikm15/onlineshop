<?php

namespace DoubleVShop\Http\Controllers;

use Illuminate\Http\Request;
use DoubleVShop\Category;

class CategoryController extends Controller
{
	// kumpulan fungsi menampilkan view
    function index(Request $request){
    	$categories = \DoubleVShop\Category::paginate(5);
    	return view('admin/content/category', compact('categories'));
    }

    function create(Request $request){
    	return view('admin/content/form/CreateCategory');
    }

    function show(Request $request){

    }

    function edit(Request $request, $id){
    	$category = \DoubleVShop\Category::find($id);
    	return view('admin/content/form/EditCategory', compact('category', 'id'));
    }

    // kumpulan fungsi logical process
    function store(Request $request){
    	$validator = \Validator::make($request->all(), [
    		'category_name' => 'required'
    	]);

    	if($validator->fails()){
    		return back()->with('errors', 'Isi form dengan benar.');
    	}else{
    		$category = new Category();
    		$category->category_name = $request->category_name;

    		if($category->save()){
    			return back()->with('msg', 'Category berhasil ditambah.');
    		}else{
    			return back()->with('errors', 'Category gagal ditambah.');
    		}    		
    	}
    }

    function update(Request $request, $id){
    	$validator = \Validator::make($request->all(), [
    		'category_name' => 'required'
    	]);

    	if($validator->fails()){
    		return back()->with('errors', 'Isi form dengan benar.');
    	}else{
    		$category = \DoubleVShop\Category::find($id);
    		$category->category_name = $request->category_name;

    		if($category->save()){
    			return back()->with('msg', 'Category berhasil diperbaharui.');
    		}else{
    			return back()->with('errors', 'Category gagal diperbaharui.');
    		}    		
    	}
    }

    function destroy(Request $request, $id){
    	$category = \DoubleVShop\Category::find($id);
    	if($category->delete()){
    		return back()->with('msg', 'Category berhasil dihapus.');
    	}else{
    		return back()->with('msg', 'Category gagal dihapus.');
    	}
    }
}
