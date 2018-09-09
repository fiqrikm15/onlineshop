@extends('admin/base')
@section('title')
Double V Shop | Add Category
@endsection
@section('content')
<div class="uk-child-width-expand@s uk-grid-match" uk-grid>
	<div>
		<div class="uk-card uk-card-default uk-card-hover uk-card-body">
			<h3 class="uk-card-title">Add New Category</h3>
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

			<form action="{{ url('/admin/category') }}" method="post" class="uk-form-horizontal uk-margin-large">
				{{ csrf_field() }}
				<div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Category Name</label>
			        <div class="uk-form-controls">
			            <input class="uk-input" id="form-horizontal-text" name="category_name" type="text" placeholder="Category Name">
			        </div>
			    </div>
			    <div class="uk-margin">
			    	<button type="submit" class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom">Add Category</button>
			    </div>
			</form>
		</div>
	</div>
</div>
@endsection