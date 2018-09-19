@extends('admin/base')
@section('title')
Double V Shop | Edit Product
@endsection
@section('content')
<div class="uk-child-width-expand@s uk-grid-match" uk-grid>
	<div>
		<div class="uk-card uk-card-default uk-card-hover uk-card-body">
			<h3 class="uk-card-title">Edit Product</h3>
			@if(\Session::has('errors'))
				<div class="uk-alert-danger" uk-alert>
				    <a class="uk-alert-close" uk-close></a>
				    <p>{{ \Session::get('errors') }}</p>
				</div>
			@endif

			@if(\Session::has('msg'))
				<div class="uk-alert-success" uk-alert>
				    <a class="uk-alert-close" uk-close></a>
				    <p>{{ \Session::get('msg') }}</p>
				</div>
			@endif

			<form action="{{ route('product.update', $product[0]->id) }}" method="post" class="uk-form-horizontal uk-margin-large" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input name="_method" type="hidden" value="PATCH">
				<div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Product Name</label>
			        <div class="uk-form-controls">
			            <input class="uk-input" id="form-horizontal-text" name="product_name" value="{{ $product[0]->product_name }}" type="text" placeholder="Product Name">
			        </div>
			    </div>

			    <div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Product Image</label>
			        <div class="js-upload" style="margin-left: 15px;" uk-form-custom>
					    <input type="file" name="product_image[]" multiple>
					    <button class="uk-button uk-button-default" type="button">Select</button>
					</div>
			    </div>

				<div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Price</label>
			        <div class="uk-form-controls">
			            <input class="uk-input" id="form-horizontal-text" name="price" value="{{ $product[0]->price }}" type="text" placeholder="Product Price">
			        </div>
			    </div>

			    <div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Product Quantity</label>
			        <div class="uk-form-controls">
			            <input class="uk-input" id="form-horizontal-text" value="{{ $product[0]->qty }}" name="qty" type="text" placeholder="Product Quantity">
			        </div>
			    </div>

			    <div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Product Category</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" name="product_category">
			                @foreach($categories as $category)
			                <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
			                @endforeach
			            </select>
			        </div>
			    </div>

				<div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Product Jenis Kelamin</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" name="jenis_kelamin">
			                <option value="Pria(Dewasa)">Pria(Dewasa)</option>
			                <option value="Pria(Anak-Anak)">Pria(Anak-Anak)</option>
			                <option value="Wanita(Dewasa)">Wanita(Dewasa)</option>
			                <option value="Wanita(Anak-Anak)">Wanita(Anak-Anak)</option>
			            </select>
			        </div>
			    </div>			    

			    <div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Product Description</label>
			        <div class="uk-margin">
			            <textarea class="uk-textarea" rows="5" name="description" placeholder="Product Description">{{ strip_tags($product[0]->description) }}</textarea>
			        </div>
			    </div>

			    <div class="uk-margin">
			    	<button type="submit" class="uk-button uk-button-default uk-width-1-1@m uk-margin-small-bottom">Save Product</button>
					<a href="{{ url('admin/product') }}" class="uk-button uk-button-secondary uk-width-1-1@m">Cancel</a>
			    </div>
			</form>
		</div>
	</div>
</div>
@endsection