
@extends('template')

@section('content')
<div align="center">
	<input type="date" name="date" value="{{ $date }}">
</div>
<div class="row">
	@foreach($categories as $category)
		<div class="col-md-4">
			<p>{{ $category->name }}</p>
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
			<div class="scrollable" id="scrollable-{{ $category->id }}">
				@foreach($userFoods->where('category_id', $category->id) as $userFood)
					
					<div class="d-flex align-items-center">
						<p id="item-{{ $userFood->pivot->id }}" 
							data-toggle="tooltip" data-html="true" title="
							energy: {{ $userFood->energy }} kcal 
							protein: {{ $userFood->protein }} g
							sugar: {{ $userFood->sugar }} g">
							{{ $userFood->name }}: {{ $userFood->pivot->quantity }} g
						</p>
						<button class="delete-item" value="{{ $userFood->pivot->id }}">Delete</button>
					</div>
				@endforeach
			</div>
		</div>
	@endforeach
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

{{-- TODO: ajax post, save a users day --}}
@section('jquery')
<script src="{{ asset('js/ajax-add-item.js') }}"></script>
@endsection