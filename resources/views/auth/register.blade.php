@extends('template')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3" style="padding-top: 50px">
					<div class="card">
						<div class="card-body">

							<h3>Register</h3>
							<form method="POST" action="{{ route('register') }}">
								{{ csrf_field() }}
								<input type="hidden" name="url" value="{{ env('APP_URL') }}">

								<div class="form-group">
									<label>First name</label>
									<input type="text" name="first_name" placeholder="First name" class="form-control" value="{{ old('first_name') }}">
									@if($errors->has('first_name'))
										<span class="error-message">{{ $errors->first('first_name') }}</span>
									@endif
								</div>

								<div class="form-group">
									<label>Last name</label>
									<input type="text" name="last_name" placeholder="Last name" class="form-control" value="{{ old('last_name') }}">
									@if($errors->has('last_name'))
										<span class="error-message">{{ $errors->first('last_name') }}</span>
									@endif
								</div>

								<div class="form-group">
									<label>Gender</label>
									<select name="gender" class="form-control">
										<option selected disabled>Gender</option>
										<option value="1" @if(old('gender') == 1) selected @endif>Female</option>
										<option value="2" @if(old('gender') == 2) selected @endif>Male</option>
									</select>
									@if($errors->has('gender'))
										<span class="error-message">{{ $errors->first('gender') }}</span>
									@endif
								</div>
								<!-- Birth date -->
								<div class="form-group">
									<label>Birth date</label>
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

								<div class="form-group">
									<label>E-mail address</label>
									<input type="text" name="email" placeholder="E-mail address" class="form-control" value="{{ old('email') }}">
									@if($errors->has('email'))
										<span class="error-message">{{ $errors->first('email') }}</span>
									@endif
								</div>

								<div class="form-group">	
									<label>Password</label>							
									<input type="password" name="password" placeholder="Password" class="form-control">
									@if($errors->has('password'))
										<span class="error-message">{{ $errors->first('password') }}</span>
									@endif
								</div>

								<div class="form-group">								
									<label>Password confirmation</label>		
									<input type="password" name="password_confirmation" placeholder="Password confirmation" class="form-control">
									@if($errors->has('password_confirmation'))
										<span class="error-message">{{ $errors->first('password_confirmation') }}</span>
									@endif
								</div>

								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection