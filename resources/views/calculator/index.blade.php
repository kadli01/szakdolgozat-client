@extends('template')
<input type="date" name="date" value="{{ $date }}">
@foreach($categories as $category)
	<div>
		<p>{{ $category->name }}</p>
		@foreach($userFoods->where('category_id', $category->id) as $userFood)
			<div>
				<p id="item-{{ $userFood->pivot->id }}">{{ $userFood->name }}: {{ $userFood->pivot->quantity }} g</p>
				<button class="delete-item" value="{{ $userFood->pivot->id }}">Delete</button>
			</div>
		@endforeach
		<select name="{{$category->id}}-items">
			@foreach($category->foods as $food)
				<option value="{{ $food->id }}">{{ $food->name }}</option>
			@endforeach
			<input type="number" name="{{ $category->id }}-quantity" required> g
			@if($errors->has($category->id . '-quantity'))
				<span class="error-message">{{ $errors->first($category->id . '-quantity') }}</span>
			@endif
			<button class="add-item" value="{{$category->id}}">add</button>
		</select>
	</div>
@endforeach
<meta name="_token" content="{!! csrf_token() !!}" />

{{-- TODO: ajax post, save a users day --}}
@section('jquery')
<script src="{{ asset('js/ajax-add-item.js') }}"></script>
@endsection