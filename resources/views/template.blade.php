<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nutrition Calcuator</title>

	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css?ver=1.0">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
	<script type="text/javascript" src="/js/app.js"></script>
</head>
<body>

			{{-- navbar on top --}}
		<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
			<div class="container">
				{{-- <a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a> --}}
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						<a href="{{ route('calculator') }}" class="nav-link">Nutrition Calculator</a>
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@if(!session('user_token'))
							<li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
							<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
						@else
							<li><a class="nav-link" href="{{ route('calculator') }}">Calculator</a></li>
							<li><a class="nav-link" href="{{ route('statistics') }}">Statistics</a></li>
							<li class="nav-item">
								<a  class="nav-link" href="{{ route('logout') }}">Logout</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		{{-- NAVBAR on top END --}}


	<div>
		@if(\Session::has('success'))
			<div class="alert alert-success alert-dissmissible fade show" role="alert">
				<div class="alert-inner" align="center">
					{{ \Session::get('success') }}
					<button type="button" class="close" data-dismiss="alert" arial-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		@endif

		@if(\Session::has('error'))

			<div class="alert alert-danger alert-dissmissible error" role="alert">	
				<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span ariea-hidden="true">&times;</span></button>
					<span class="d-block text-center">{{ \Session::get('error') }}</span>
			</div>
		@endif
	</div>

		@yield('content')
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		@yield('jquery')
		<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
		<script>

			$(document).ready(function() 
			{
				$('.date').datepicker({
					format: "yyyy-mm-dd"
				});
			});
		</script>
<footer>
	
</footer>

</body>
</html>