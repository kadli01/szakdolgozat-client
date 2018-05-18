
@extends('template')

@section('content')
<div align="center">
	<input type="date" name="date" value="{{ $date }}">
</div>
<div>
	<div class="row">
		<div class="col-md-2">
			
			<div id="categories" class="scrollable" style="height: 400px">
				<ul id="categories" class="list-group">
					<li id="category-all" class="list-group-item active">All</li>
					@foreach($categories as $category)
						<li id="category-{{ $category->id }}" value="{{ $category->id }}" class="list-group-item">{{ $category->name }}</li>
					@endforeach		
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			
			<div class="scrollable" style="height: 400px">
				<table class="table">
					<thead class="thead-dark">
						<th>
							<input type="text" name="keyword" placeholder="name">
							<button type="button" id="search-btn" class="btn btn-block">Search</button>
						</th>
						<th>Energy (kcal)</th>
						<th>Portein (g)</th>
						<th>Fat (g)</th>
						<th>Carbs (g)</th>
						<th>Sugar (g)</th>
						<th>Salt (g)</th>
						<th>Fiber (g)</th>
						<th></th>
						<th></th>
					</thead>
					@foreach($categories as $category)
					<tbody class="" id="list-{{ $category->id }}">
						@foreach($category->foods as $item)
						<tr name={{ $item->name }} category="{{ $category->id }}">
								<td>{{ $item->name }}</td>
								<td>{{ $item->energy }}</td>
								<td>{{ $item->protein }}</td>
								<td>{{ $item->fat }}</td>
								<td>{{ $item->carbohydrate }}</td>
								<td>{{ $item->sugar }}</td>
								<td>{{ $item->salt }}</td>
								<td>{{ $item->fiber }}</td>
								<td><input type="number" name="quantity-{{ $item->id }}" style="max-width: 80px"></td>
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

@section('jquery')
<script src="{{ asset('js/ajax-add-itemv2.js') }}"></script>
<script>
	$(document).ready(function() {

		var category = '';

		$('#categories li').on('click', function(){
			$('#categories li').removeClass('active');
			$(this).addClass('active')
			$('[id^="list"]').attr('class', 'd-none');

			category = $(this).val();
			$('#list-' + category).attr('class', '');
			
			if ($(this).attr('id') == 'category-all') {
				$('[id^="list"]').attr('class', '');
			}
		});

		$('#category-all').on('click', function(){
			$('#categories li').removeClass('active');
			$(this).addClass('active');
			$('[id^="list"]').attr('class', '');
		});

		$('#search-btn').on('click', function(){
			var keyword = $('input[name="keyword"]').val();

			console.log(keyword);
			console.log(category);

			if (category != '' && keyword != '') {
				$('[id^="list"] tr').attr('class', 'd-none');
				console.log($('#list-' + category + ' tr[name*="'+keyword+'"]'));
				$('#list-' + category + ' tr[name*="'+keyword+'"]').each(function(){
					console.log($(this));
					$(this).first().attr('class', '');
				});
			}
		});
	});
</script>
@endsection