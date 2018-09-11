@extends('admin/base')
@section('title')
Double V Shop | Admin Panel
@endsection

@section('content')
<div class="uk-child-width-1-1@s uk-grid-match" uk-grid>
	<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
		<h3 class="uk-card-title">Product List</h3><a href="{{ route('product.create') }}" class="uk-button uk-button-default uk-margin-bottom uk-width-1-4@m"><span uk-icon="icon: plus; ratio: 1" uk-margin></span> Add Product</a>
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

	    <table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Produk</th>
		      <th scope="col">Kategori</th>
		      <th scope="col">Qty</th>
		      <th scope="col">Jenis Kelamin</th>
		      <th scope="col" colspan="3">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($products as $product)
			  	<tr>
	            	<td width="30%">{{ $product->product_name }}</td>
	            	<td>{{ $product->category_name }}</td>
	            	<td>{{ $product->qty }}</td>
	            	<td>{{ $product->jenis_kelamin }}</td>
	            	<td uk-margin>
	            		<a href="{{ route('product.show', $product->id) }}" class="uk-button uk-button-default uk-button-small uk-align-left@s">Show</a> 
	            		<a href="{{ route('product.edit', $product->id) }}" class="uk-button uk-button-primary uk-button-small uk-align-left@s">Edit</a> 
	            		<form action="{{ route('product.destroy', $product->id) }}" method="post" class="uk-align-left@s">
	            			@csrf
	            			<input type="hidden" name="_method" value="DELETE">
	            			<button type="submit" class="uk-button uk-button-danger uk-button-small" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')">Delete</button>
	            		</form>
	            	</td>
		        </tr>
		  	@endforeach
		  </tbody>
		</table>
		{{ $products->links() }}
	</div>
</div>
@endsection
