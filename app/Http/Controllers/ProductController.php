<?php

namespace DoubleVShop\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;

class ProductController extends Controller
{
	// views function
	function index(){
        $products = DB::table('products')
                    ->select('products.*', 'categories.category_name')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->orderBy('products.created_at', 'DESC')
                    ->paginate(5);
        // return json_decode($products);
        return view('admin/content/product', compact('products'));
	}

    function create(){
    	$categories = \DoubleVShop\Category::all();
    	return view('admin/content/form/CreateProduct', compact('categories'));
    }

    function show(Request $request, $id){

    }

    function edit(Request $request, $id){
        $categories = \DoubleVShop\Category::all();
        $product = DB::table('products')
                    ->select('products.*', 'categories.category_name')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('products.id', '=', $id)
                    ->get();
        // return json_decode($product);
        return view('admin/content/form/EditProduct', compact('categories', 'product'));
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
        $validator = \Validator::make($request->all(), [
    		'product_name' => 'required',
    		'price' => 'required',
    		'qty' => 'required',
    		'description' => 'required'
        ]);
        
        if($validator->fails()){
            return back()->with('errors', 'Isi form dengan benar.');
        }else{
            $product = \DoubleVShop\Product::find($id);
            $product->product_name = $request->product_name;
    		$product->category_id = $request->product_category;
    		$product->price = $request->price;
    		$product->qty = $request->qty;
    		$product->jenis_kelamin = $request->jenis_kelamin;
            $product->description = nl2br($request->description);

            $productImages = DB::table('product_images')
                        ->where('product_images.product_id', $id)
                        ->get();
            $img_arr = [];

            foreach($productImages as $img){
                array_push($img_arr, $img->image_name);
            }

            $len = count($img_arr);
            $msg = "";
            
            if($product->save()){
                for($i = 0; $i < $len; $i++){
                    if(file_exists(public_path('uploads/'.$img_arr[$i]))){
                        unlink(public_path('uploads/'.$img_arr[$i]));
                    }
                }

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
                
                return back()->with('msg', 'Produk berhasil dihapus.');
            }else{
                return back()->with('errors', 'Product gagal diupdate.');
            }
        }
    }

    function destroy(Request $request, $id){
        $productImages = DB::table('product_images')
                        ->where('product_images.product_id', $id)
                        ->get();
        $img_arr = [];

        foreach($productImages as $img){
            array_push($img_arr, $img->image_name);
        }

        $len = count($img_arr);
        $msg = "";

        $product = \DoubleVShop\Product::find($id);

        if($product->delete()){
            for($i = 0; $i < $len; $i++){
                if(file_exists(public_path('uploads/'.$img_arr[$i]))){
                    unlink(public_path('uploads/'.$img_arr[$i]));
                }
            }

            $msg = "Produk berhasil dihapus.";

            $product_img = \DoubleVShop\ProductImage::where('product_id', '=', $id)->delete();
            return back()->with('msg', 'Produk berhasil dihapus.');
        }else{
            return back()->with('errors', 'Produk gagal dihapus.');
        }
    }
}
