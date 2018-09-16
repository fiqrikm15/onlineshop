@extends('admin/base')
@section('title')
Double V Shop | Admin Panel
@endsection
@section('content')
<h3>Dashboard</h3>
<hr>
<div class="uk-grid-large uk-child-width-expand@s uk-text-center" uk-grid>
	<div>
		<div class="uk-card uk-card-primary uk-width-1-1@m">
			<div class="uk-card-body">
				<strong><h3>Total Product:</h3></strong>{{ $prod_count }}
			</div>
			<div class="uk-card-footer">
				<a href="{{ route('product.index') }}" class="uk-button uk-button-text">Manage Product</a>
			</div>
		</div>
	</div>
	<div>
		<div class="uk-card uk-card-primary uk-width-1-1@m">
			<div class="uk-card-body">
				<strong><h3>Total Category:</h3></strong>{{ $cat_count }}
			</div>
			<div class="uk-card-footer">
				<a href="{{ route('category.index') }}" class="uk-button uk-button-text">Manage Category</a>
			</div>
		</div>
	</div>
	<div>
		<div class="uk-card uk-card-primary uk-width-1-1@m">
			<div class="uk-card-body">
				<strong><h3>Total Article:</h3></strong>{{ $news_count }}
			</div>
			<div class="uk-card-footer">
				<a href="#" class="uk-button uk-button-text">Manage Article</a>
			</div>
		</div>
	</div>
</div><br>
<div class="uk-child-width-expand@s" uk-grid>
	<div class="uk-grid-item-match">
		<div class="uk-card uk-card-default uk-width-1-1@m">
			<div class="uk-card-header">
				<div class="uk-grid-small uk-flex-middle" uk-grid>
					<div class="uk-width-expand">
						<h3 class="uk-card-title uk-margin-remove-bottom">Last Product Added</h3>
					</div>
				</div>
			</div>
			<div class="uk-card-body">
				@if($prod_count != 0)
				<p><strong>Product Name:</strong> {{ $last_post->product_name }}</p>
				<p><strong>Created At:</strong> {{ date('d-M-Y', strtotime($last_post->created_at)) }}</p>
				<p><strong>Last Updated:</strong> {{ date('d-M-Y', strtotime($last_post->updated_at)) }}</p>
				@else
				<p>Tidak ada produk tersedia.</p>
				@endif
			</div>
			<div class="uk-card-footer uk-text-center">
				<a href="#" class="uk-button uk-button-text">Manage Product</a>
			</div>
		</div>
	</div><br>
	<div class="uk-grid-item-match">
		<div class="uk-card uk-card-default uk-width-1-1@m">
			<div class="uk-card-header">
				<div class="uk-grid-small uk-flex-middle" uk-grid>
					<div class="uk-width-expand">
						<h3 class="uk-card-title uk-margin-remove-bottom">Last Article Added</h3>
					</div>
				</div>
			</div>
			<div class="uk-card-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
			</div>
			<div class="uk-card-footer uk-text-center">
				<a href="#" class="uk-button uk-button-text">Manage Article</a>
			</div>
		</div>
	</div><br>
</div>
</div>
@endsection