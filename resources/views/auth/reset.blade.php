@extends('template')

@section('title')

@endsection

@section('content')

	<section class="reset">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div>
						<h3 class="text-center">Set up your new password</h3>
						<form method="POST" action="{{ url('/auth/password/reset') }}" enctype="multipart/form-data">
							{{csrf_field()}}
							<input type="hidden" name="token" class="form-control" value="{{ $token }}">
							<div class="form-group">
								<label for="">New password</label>
								<input type="password" name="password" class="form-control">
								@if($errors->has('password'))
									<span class="error-message">{{ $errors->first('password') }}</span>
								@endif
							</div>
							<div class="form-group">
								<label for="">Confirm password</label>
								<input type="password" name="password_confirmation" class="form-control">
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