@extends('template')

@section('content')
	<section>
		<div>
			<h3>login</h3>
			<form method="POST" action="{{ route('login') }}">
				{{ csrf_field() }}
				<input type="text" name="email" placeholder="E-mail address" class="form-control">
				@if($errors->has('email'))
					<span>{{ $errors->first('email') }}</span>
				@endif
				<input type="text" name="password" placeholder="Password" class="form-control">
				@if($errors->has('password'))
					<span>{{ $errors->first('password') }}</span>
				@endif
				<input type="submit" name="submit" value="login">
			</form>
		</div>
	</section>
@endsection