@extends('template')

@section('content')
<div class="container">
	
<div class="dashboard-header" style="padding-top: 15px;">
		<form method="POST" action="{{ route('statistics-filter') }}">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-2 offset-md-1">
					<h1>Statistics</h1>
				</div>

				
					<div class="col-md-2 offset-md-3">
						<div class="input-group">
							<span class="input-group-addon" id="sizing-addon2"><i class="fa fa-fw fa-calendar"></i></span>
							<input class="form-control date" type="text" name="start_date" value="{{ $startDate->toDateString() }}">
						</div>
					</div>

					<div class="col-md-2">
						<div class="input-group">
							<input class="form-control date" type="text" name="end_date" value="{{ $endDate->toDateString() }}">
						</div>
					</div>
					<div class="col-md-2">
						
						<span class="input-group-btn">
							<button class="btn btn-primary" type="submit" name="submit" style="position: relative; right: 0px; top: 0px;">Filter</button>
						</span>
					</div>

			</div>
		</form>

	</div>
</div>
<div class="container">
{{-- <div class="col-md-10 offset-md-1">		 --}}
<div class="card">
<div class="card-body">
	<div class="stat chart-container">
		<canvas id="stat" height="75vw"></canvas>
	</div>
</div>
</div>
{{-- </div> --}}
{{-- <div class="col-md-10 offset-md-1" style="padding-top: 15px;">	 --}}
	<div class="col-md-2 offset-md-1">
		<h1>Categories</h1>
	</div>
	<div class="card">
		<div class="card-body">
	<div class="categories chart-container">
		<canvas id="categories"></canvas>
	</div>
</div>
</div>
</div>
{{-- </div> --}}
@endsection

@section('jquery')
	<script src="/assets/js/Chart.bundle.min.js"></script>
	<script>
		var ctx = $('#stat');
		new Chart(ctx, {
			type: 'line',
			data:{
				labels: {!!  json_encode(array_filter(array_pluck($userFoods, 'date'))) !!},
				datasets: [
				{
					label: "energy (kcal)",
					yAxisID: 'kcal',
					data: {!!  json_encode(array_pluck($userFoods, 'energy')) !!},	
					borderColor: 'rgba(255, 159, 64, 1)',
					backgroundColor: 'rgba(255, 159, 64, 1)',
					fill: false,
				},
				{
					label: "protein (g)",
					yAxisID: 'g',
					data: {!!  json_encode(array_pluck($userFoods, 'protein')) !!},	
					borderColor: 'rgba(255, 50, 164, 1)',
					backgroundColor: 'rgba(255, 50, 164, 1)',
					fill: false,
				},
				{
					label: "fat (g)",
					yAxisID: 'g',
					data: {!!  json_encode(array_pluck($userFoods, 'fat')) !!},	
					borderColor: 'rgba(165, 128, 14, 1)',
					backgroundColor: 'rgba(165, 128, 14, 1)',
					fill: false,
					hidden: true,
				},
				{
					label: "carbohydrate (g)",
					yAxisID: 'g',
					data: {!!  json_encode(array_pluck($userFoods, 'carbohydrate')) !!},	
					borderColor: 'rgba(49, 9, 229, 1)',
					backgroundColor: 'rgba(49, 9, 229, 1)',
					fill: false,
					hidden: true,
				},
				{
					label: "sugar (g)",
					yAxisID: 'g',
					data: {!!  json_encode(array_pluck($userFoods, 'sugar')) !!},	
					borderColor: 'rgba(224, 8, 213, 1)',
					backgroundColor: 'rgba(224, 8, 213, 1)',
					fill: false,
					hidden: true,
				},
				{
					label: "salt (g)",
					yAxisID: 'g',
					data: {!!  json_encode(array_pluck($userFoods, 'salt')) !!},	
					borderColor: 'rgba(151, 154, 160, 1)',
					backgroundColor: 'rgba(151, 154, 160, 1)',
					fill: false,
					hidden: true,
				},
				{
					label: "fiber (g)",
					yAxisID: 'g',
					data: {!!  json_encode(array_pluck($userFoods, 'fiber')) !!},	
					borderColor: 'rgba(22, 186, 22, 1)',
					backgroundColor: 'rgba(22, 186, 22, 1)',
					fill: false,
					hidden: true,
				},
				],
			},
			options:{
				scales: {
					yAxes: [{
						id: 'kcal',
						type: 'linear',						
						position: 'left',
						title: 'kcal',
						ticks: {
							beginAtZero: true
						}
					}, {
						id: 'g',
						type: 'linear',
						position: 'right',
						title: {
							display: true,
							labelString: 'g',
						},
						ticks: {
							beginAtZero: true
						}
					}]
				},
			}
		});

		var ctx = $('#categories');
		new Chart(ctx, {
			type: 'doughnut',

			data:{
				labels: {!!  json_encode(array_filter(array_pluck($userCategories, 'name'))) !!},
				datasets: [
				{
					data: {!!  json_encode(array_pluck($userCategories, 'quantity')) !!},	
					label: {!!  json_encode(array_pluck($userCategories, 'percentage')) !!},
					backgroundColor: {!!  json_encode($userCategories->colors) !!},
				},
				],
			},
			options: {
				tooltips: {
					callbacks: {
						title: function(tooltipItem, data) {
							return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
							return data['datasets'][0]['data'][tooltipItem['index']] + ' g';
						},
						afterLabel: function(tooltipItem, data) {
							return data['datasets'][0]['label'][tooltipItem['index']] + '%';
						}
					},
				},
			}
		});

	</script>
@endsection