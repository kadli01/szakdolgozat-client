@extends('template')

@section('content')

	<section class="reset">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div>
						<h3 class="text-center">Request a new password</h3>
						<form method="POST" action="/auth/password/mail" enctype="multipart/form-data">
							{{csrf_field()}}
							<input type="hidden" name="url" value="{{ route('password') }}">
							<div class="form-group">
								<label for="">E-mail</label>
								<input type="email" name="email" class="form-control">
								@if($errors->has('email'))
									<span class="error-message">{{ $errors->first('email') }}</span>
								@endif
							</div>	
							<div class="text-center">
								<input type="submit" name="submit" value="Send" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection