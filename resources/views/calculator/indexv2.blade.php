
@extends('template')

@section('content')
<div align="center">
	<input type="date" name="date" value="{{ $date }}">
</div>
<div>
	<div class="row">
		<div class="col-md-2">
			
			<div id="categories" class="scrollable" style="height: 400px">
				<ul id="categories">
					@foreach($categories as $category)
						<li id="category-{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</li>
					@endforeach		
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			
			<div class="scrollable" style="height: 400px">
				<table>
					<thead>
						<th></th>
						<th>Energy</th>
						<th>Portein</th>
						<th>Fat</th>
						<th>Carbohydrate</th>
						<th>Sugar</th>
						<th>Salt</th>
						<th>Fiber</th>
						<th></th>
					</thead>
					@foreach($categories as $category)
					<tbody class="d-none" id="list-{{ $category->id }}">
						@foreach($category->foods as $item)
						<tr>
								<td>{{ $item->name }}</td>
								<td>{{ $item->energy }}</td>
								<td>{{ $item->protein }}</td>
								<td>{{ $item->fat }}</td>
								<td>{{ $item->carbohydrate }}</td>
								<td>{{ $item->sugar }}</td>
								<td>{{ $item->salt }}</td>
								<td>{{ $item->fiber }}</td>
								<td><input type="number" name="quantity-{{ $item->id }}"></td>
								<td><button class="add-item" value="{{ $item->id }}" id="add-item">add</button></td>
						</tr>
						@endforeach
					</tbody>
				@endforeach
				</table>
			</div>
		</div>
		<div class="col-md-4">
			<ul id="added-items">
				@foreach($userFoods as $userFood)
					<li id="item-{{ $userFood->pivot->id }}">{{ $userFood->name }}: {{ $userFood->pivot->quantity }}g <button class="delete-item" value="{{ $userFood->pivot->id }}">Delete</button></li>
				@endforeach
			</ul>
		</div>
	</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

{{-- TODO: ajax post, save a users day --}}
@section('jquery')
<script src="{{ asset('js/ajax-add-itemv2.js') }}"></script>
<script>
	$(document).ready(function() {

		$('#categories li').on('click', function(){
			$('[id^="list"]').attr('class', 'd-none');
			var category = $(this).val();
			$('#list-' + category).attr('class', '');
		});
	});
</script>
@endsection