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

		@if(\Session::has('error'))
			<div class="alert alert-danger alert-dissmissible error" role="alert">	
				<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span ariea-hidden="true">&times;</span></button>
					<span class="d-block text-center">{{ \Session::get('error') }}</span>
			</div>
		@endif

		@yield('content')
		
	</div>
</body>
<footer>
	lohere
</footer>
</html>