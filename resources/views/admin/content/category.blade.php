@extends('admin/base')
@section('title')
Double V Shop | Admin Panel
@endsection

@section('content')
<div class="uk-child-width-1-1@s uk-grid-match" uk-grid>
	<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
		<h3 class="uk-card-title">Category List</h3><a href="{{ route('category.create') }}" class="uk-button uk-button-default uk-margin-bottom uk-width-1-4@m"><span uk-icon="icon: plus; ratio: 1" uk-margin></span> Add Category</a>
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
		      <th scope="col">Category Name</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach($categories as $index=>$category)
		        <tr>
	            	<td width="50%">{{ $category['category_name'] }}</td>
	            	<td uk-margin>
	            		<a href="{{ action('CategoryController@edit', $category['id']) }}" class="uk-button uk-button-primary uk-button-small uk-align-left@s">Edit</a> 
	            		<form action="{{ action('CategoryController@destroy', $category['id']) }}" method="post" class="uk-align-left@s">
	            			@csrf
	            			<input type="hidden" name="_method" value="DELETE">
	            			<button type="submit" class="uk-button uk-button-danger uk-button-small" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')">Delete</button>
	            		</form>
	            	</td>
		        </tr>
		    @endforeach
		  </tbody>
		</table>
		{{ $categories->links() }}
	</div>
</div>
@endsection