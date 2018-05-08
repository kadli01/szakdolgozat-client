<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nutrition Calcuator</title>
</head>
<body>
	<div>
		@if(\Session::has('success'))
			<div class="alert alert-success alert-dissmissible fade show" role="alert">
				<div class="alert-inner">
					{{ \Session::get('success') }}
				</div>
				<button type="button" class="close" data-dismiss="alert" arial-label="Close">
					<span aria-hidden="true">&limes;</span>
				</button>
			</div>
		@endif
	<h1>{{\Session::get('error')}}</h1>
		@if(\Session::has('error'))

			<div class="alert alert-danger alert-dissmissible error" role="alert">	
				<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span ariea-hidden="true">&times;</span></button>
					<span class="d-block text-center">{{ \Session::get('error') }}</span>
			</div>
		@endif

		@yield('content')
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		@yield('jquery')
	</div>
</body>
<footer>
	lohere
</footer>
</html>