@extends('template')

@section('content')
	<section>
		<div>
			<h3>Register</h3>
			<form method="POST" action="{{ route('register') }}">
				{{ csrf_field() }}

				<input type="text" name="first_name" placeholder="First name" class="form-control" value="{{ old('first_name') }}">
				@if($errors->has('first_name'))
					<span>{{ $errors->first('first_name') }}</span>
				@endif

				<input type="text" name="last_name" placeholder="Last name" class="form-control" value="{{ old('last_name') }}">
				@if($errors->has('last_name'))
					<span>{{ $errors->first('last_name') }}</span>
				@endif

				<select name="gender">
					<option value="1">Female</option>
					<option value="2">Male</option>
				</select>

				<!-- Birth date -->
							<div class="form-group">
								<div class="d-flex">

									<!-- Year -->
									<select name="birth_year" id="" class="form-control">
										<option value="" disabled selected>Year</option>
										@php
											$from = Carbon\Carbon::now()->year-100;
											$to = Carbon\Carbon::now()->year;
										@endphp
										@for($i = $from; $i <= $to; $i++)
											<option value="{{ $i }}" @if(old('birth_year') == $i) selected @endif>{{ $i }}</option>
										@endfor
									</select>
									@if($errors->has('birth_year'))
										<span class="error-message">{{ $errors->first('birth_year') }}</span>
									@endif

									<!-- Month -->
									<select name="birth_month" id="" class="form-control">
										<option value="" disabled selected>Month</option>
										@for($i = 1; $i <= 12; $i++)
											{{ $month = Carbon\Carbon::create(1, $i, 1)->formatLocalized('%B') }}
											<option value={{ $i }} @if(old('birth_month') == $i) selected @endif>{{ $month }}</option>
										@endfor
									</select>
									@if($errors->has('birth_month'))
										<span class="error-message">{{ $errors->first('birth_month') }}</span>
									@endif

									<!-- Day -->
									<select name="birth_day" id="" class="form-control">
										<option value="" disabled selected>Day</option>
										@for($i = 1; $i <= 31; $i++)
											<option value="{{ $i }}" @if(old('birth_day') == $i) selected @endif>{{ $i }}</option>
										@endfor
									</select>
									@if($errors->has('birth_day'))
										<span class="error-message">{{ $errors->first('birth_day') }}</span>
									@endif
								</div>
							</div>


				<input type="text" name="email" placeholder="E-mail address" class="form-control" value="{{ old('email') }}">
				@if($errors->has('email'))
					<span>{{ $errors->first('email') }}</span>
				@endif

				<input type="password" name="password" placeholder="Password" class="form-control">
				@if($errors->has('password'))
					<span>{{ $errors->first('password') }}</span>
				@endif

				<input type="password" name="password_confirmation" placeholder="Password confirmation" class="form-control">
				@if($errors->has('password_confirmation'))
					<span>{{ $errors->first('password_confirmation') }}</span>
				@endif

				<input type="submit" name="submit" value="login">
			</form>
		</div>
	</section>
@endsection