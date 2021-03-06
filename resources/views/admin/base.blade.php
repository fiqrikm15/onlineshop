<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="{{ asset('css/theme.css') }}"> <!-- Resource style -->
	<link rel="stylesheet" href="{{ asset('css/nav.css') }}"> <!-- CSS reset -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Resource style -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.18/js/uikit.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.18/js/uikit-icons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/js-signals/1.0.0/js-signals.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/hasher/1.2.0/hasher.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crossroads/0.12.2/crossroads.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.6.2/ckeditor.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.calenstyle/latest/calenstyle.min.css" />
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.calenstyle/latest/calenstyle.min.js"></script>
	<!-- For i18n -->
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.calenstyle/latest/i18n/calenstyle-i18n.js"></script>
	<script type="text/javascript" src="js/CalJsonGenerator.js"></script>	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.10.1/chartist.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.10.1/chartist.min.js"></script>
	<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
	<title>@yield('title')</title>
</head>
<body>
	@auth
	<header class="cd-main-header">
		<a href="#" class="cd-logo">
			Double V Shop
		</a>

		<a href="#" class="cd-nav-trigger"><span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li class="has-children account">
					<a href="#">
						<img src="{{ asset('img/pria.jpg') }}" alt="avatar">
						Account
					</a>

					<ul>
						<li><a href="{{ url('/admin/logout') }}">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			
			<ul class="uk-nav uk-nav-default">
				
				<li class="cd-label">Menu</li>
				<li class="has-children overview"><a href="{{ url('/admin') }}">Dashboard</a></li>
				<li class="has-children bookmarks">
					@if(!Request::is('admin/product/*'))
					<a href="#">Product</a>
					@else
					<a href="{{ route('product.index') }}">Product</a>
					@endif

					<ul>
						<li><a href="{{ route('product.create') }}">Add Product</a></li>
						<li><a href="{{ route('product.index')}}">Manage Product</a></li>
					</ul>
				</li>

				<li class="has-children bookmarks">
					@if(!Request::is('admin/category/*'))
					<a href="#">Category</a>
					@else
					<a href="{{ route('category.index') }}">Category</a>
					@endif
					
					<ul>
						<li><a href="{{ route('category.create') }}">Add Category</a></li>
						<li><a href="{{ route('category.index') }}">Manage Category</a></li>
					</ul>
				</li>
				
				<li class="has-children bookmarks">
					<a href="#">Article</a>
					
					<ul>
						<li><a href="#widgets/tabs">Add Article</a></li>
						<li><a href="#widgets/modals">Manage Article</a></li>
					</ul>
				</li>
				<li class="has-children"><a href="/admin/user">User</a></li>
			</ul>

		</nav>

		<div class="content-wrapper">
        <!-- Page Content -->
        <div id="page-content-wrapper uk-margin-top" style="margin-top: 10px;">
			<div class="uk-container uk-container-medium" id="content">
				@yield('content')
			</div>
        </div>
        <!-- /#page-content-wrapper -->
		</div> <!-- .content-wrapper -->
	</main> <!-- .cd-main-content -->
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->

<script>
function get_content(tpl, div) {
$.get(tpl, function(result){
    $result = $(result);

    $( div ).html( result );
    $result.find('script').appendTo(div);
}, 'html');

}
crossroads.addRoute('/{section}/{subsection}', function(section, subsection){  
  get_content('templates/'+section+'/'+subsection+'.html', '#content');
});
crossroads.addRoute('/', function(id){  
  get_content('templates/home.html', '#content');
}); 

//setup hasher
function parseHash(newHash, oldHash){
  crossroads.parse(newHash);
}
hasher.initialized.add(parseHash); //parse initial hash
hasher.changed.add(parseHash); //parse hash changes
hasher.init(); //start listening for history change


(function($) {
    var $window = $(window),
        $html = $('#wrapper');

    function resize() {
        if ($window.width() < 768) {
            return $html.removeClass('toggled');
        }
		
        $html.addClass('toggled');
    }

    $window
        .resize(resize)
        .trigger('resize');
})(jQuery);
</script>
@else
<div>
	<p>Please Login Before</p>
	Login <a href="{{route('login')}}">Here!</a>
</div>
@endauth
</body>
</html>