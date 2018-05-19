
@extends('template')

@section('content')
<div align="center">
	<input type="date" name="date" value="{{ $date }}">
</div>
<div>
	<div class="row justify-content-center">
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
		<div class="col-md-7">
			
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
						<th>Amount</th>
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
								<td>
									<div class="input-group-append">
										<input type="number" name="quantity-{{ $item->id }}" style="max-width: 80px" class="form-control">
							 			<span class="input-group-text"> g</span>
									</div>
								</td>
								<td>
									<button class="add-item btn" value="{{ $item->id }}" id="add-item">Add</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				@endforeach
				</table>
			</div>
		</div>
			
	</div>
		<div class="row justify-content-center">
		<div class="col-md-7 offset-md-2">
			{{-- <ul id="added-items">
				@foreach($userFoods as $userFood)
					<li id="item-{{ $userFood->pivot->id }}">{{ $userFood->name }}: {{ $userFood->pivot->quantity }}g <button class="delete-item" value="{{ $userFood->pivot->id }}">Delete</button></li>
				@endforeach
			</ul> --}}

			<div class="scrollable" style="height: 400px">
			<table id="added-items" class="table">
				<thead align="center" class="thead-dark">
					<th colspan="10">Added items</th>
				</thead>
				<tbody>
					@foreach($userFoods as $userFood)
						<tr id="item-{{ $userFood->pivot->id }}">
							<td>{{ $userFood->name }}</td>
							<td>{{ $userFood->energy }}</td>
							<td>{{ $userFood->protein }}</td>
							<td>{{ $userFood->fat }}</td>
							<td>{{ $userFood->carbohydrate }}</td>
							<td>{{ $userFood->sugar }}</td>
							<td>{{ $userFood->salt }}</td>
							<td>{{ $userFood->fiber }}</td>
							<td>{{ $userFood->pivot->quantity }}g</td>
							<td>
								<button class="delete-item" value="{{ $userFood->pivot->id }}">Delete</button>
							</td>
						</tr>
					@endforeach
				</tbody>
		</div>
			</table>
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
			$('[id^="list"] tr').attr('class', 'd-none');

			category = $(this).val();
			$('#list-' + category + ' tr').attr('class', '');
			
			if ($(this).attr('id') == 'category-all') {
				$('[id^="list"] tr').attr('class', '');
			}

			$('input[name="keyword"]').val('');
		});

		$('#category-all').on('click', function(){
			$('#categories li').removeClass('active');
			$(this).addClass('active');
			$('[id^="list"]').attr('class', '');
			$('[id^="list"] tr').attr('class', '');
			$('input[name="keyword"]').val('');
		});

		$('#search-btn').on('click', function(){
			var keyword = $('input[name="keyword"]').val();

			if (category != '' && keyword != '') {
				$('[id^="list"] tr').attr('class', 'd-none');
				console.log($('#list-' + category + ' tr[name*="'+keyword+'"]'));
				$('#list-' + category + ' tr[name*="'+keyword+'"]').each(function(){
					console.log($(this));
					$(this).first().attr('class', '');
				});
			}

			if(category == '' && keyword != ''){
				$('[id^="list"] tr').attr('class', 'd-none');
				$('tr[name*="'+keyword+'"]').each(function(){
					console.log($(this));
					$(this).first().attr('class', '');
				});
			}
		});
	});
</script>
@endsection