<?php

namespace DoubleVShop\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
	// views function
	function index(){
        $products = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->orderBy('products.created_at', 'DESC')
                    ->paginate(5);
		return view('admin/content/product', compact('products'));
        // return json_decode($products);
	}

    function create(){
    	$categories = \DoubleVShop\Category::all();
    	return view('admin/content/form/CreateProduct', compact('categories'));
    }

    function show(Request $request, $id){

    }

    function edit(Request $request, $id){

    }

    // logical fuunction
    function store(Request $request){
    	$validator = \Validator::make($request->all(), [
    		'product_name' => 'required',
    		'price' => 'required',
    		'qty' => 'required',
    		'description' => 'required'
    	]);

    	if($validator->fails()){
    		return back()->with('errors', 'Isi form dengan benar.');
    	}else{
    		$product = new \DoubleVShop\Product;
    		$product->product_name = $request->product_name;
    		$product->category_id = $request->product_category;
    		$product->price = $request->price;
    		$product->qty = $request->qty;
    		$product->jenis_kelamin = $request->jenis_kelamin;
    		$product->description = nl2br($request->description);

    		if($product->save()){
    			$msg = "";
    			if($request->hasFile('product_image')){
	    			$image_array = $request->file('product_image');
	    			$image_len = count($image_array);

	    			for($i=0; $i < $image_len; $i++){
	    				$image_size = $image_array[$i]->getClientSize();
	    				$image_ext = $image_array[$i]->getClientOriginalExtension();
	    				$new_name = rand(123456, 999999).'.'.$image_ext;
	    				$destination_path = public_path('/uploads');

	    				$uploadImage = new \DoubleVShop\ProductImage;
	    				$uploadImage->image_name = $new_name;
	    				$uploadImage->image_size = $image_size;

	    				if($product->productImages()->save($uploadImage)){
	    					$image_array[$i]->move($destination_path, $new_name);
	    					$msg = "Product berhasil ditambahkan.";
	    				}
	    			}

	    			return back()->with('msg', $msg);
	    		}else{
	    			return back()->with('errors', "Product gagal ditambahkan.");
	    		}
    		}
    	}
    }

    function update(Request $request, $id){

    }

    function destroy(Request $request, $id){
        
    }
}
