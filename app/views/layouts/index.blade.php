<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

	{{ HTML::style("bootstrap/stylesheets/styles.css") }}
</head>
<body>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="col-xs-6">
			@yield('content')
			<br>	
			@if( preg_match('/\/authorized\/users/', $_SERVER['REQUEST_URI']) )
				@if( $_SERVER['REQUEST_URI']!='/authorized/users' )
					{{ link_to('authorized/users','<< kembali ke Daftar User',['class'=>'btn btn-default']) }}
				@endif
			@endif
			@if( preg_match('/\/profile/', $_SERVER['REQUEST_URI']) )
				@if( $_SERVER['REQUEST_URI']!='/profile' )
					{{ link_to('profile','<< kembali ke Profile',['class'=>'btn btn-default']) }}
				@endif
			@endif
			@if( (Auth::check()) )
			{{ link_to('logout','Logout',['class'=>'btn btn-default']) }}
			@endif
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	{{ HTML::script("javascripts/jquery/1.9.1/jquery-1.9.1.min.js") }}
	{{ HTML::script("javascripts/bootstrap/3.1.1/bootstrap.min.js") }}
	@yield('script')
</body>
</html>
