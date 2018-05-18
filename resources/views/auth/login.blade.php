@extends('template')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-4 offset-md-4" style="padding-top: 50px">
					<div class="card">
						<div class="card-body">
							
							<h3 class="card-title">Login</h3>
							<form method="POST" action="{{ route('login') }}">
								{{ csrf_field() }}

								<div class="form-group">
									<input type="text" name="email" placeholder="E-mail address" class="form-control">
									@if($errors->has('email'))
										<span>{{ $errors->first('email') }}</span>
									@endif
								</div>

								<div class="form-group">
									<input type="password" name="password" placeholder="Password" class="form-control">
									@if($errors->has('password'))
										<span>{{ $errors->first('password') }}</span>
									@endif
								</div>

								<div class="form-group">
									<a href="{{ route('password') }}">Forgot my password</a>
								</div>

								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection