$(document).ready(function(){

	var url = '/calculator/add';

	$(document).on('click', '.add-item', function(e){
		var itemId = $(this).val();
		var date = $('input[name="date"]').val();
		var quantity = $('input[name="quantity-'+ itemId +'"]').val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
			}
		});

		e.preventDefault(); 

 		var formData = {
 			date: date,
            itemId: itemId,
            quantity: quantity,
        }

        $.ajax({
        	type: 'post',
        	url: url,
        	data: formData,
        	dataType: 'json',

        	success: function(data){
        		var data = data.data;
        		$('#no-items').remove();
        		// var item = '<li id="item-'+ data.userFood +'">' + data.food.name + ':' + quantity + 'g <button class="delete-item" value="' + data.userFood + '">Delete</button></li>';
        		var item = '<tr id="item-' + data.userFood + '">';
        		item += '<td class="name">' + data.food.name + '</td>';
				item += '<td>' + data.food.energy*quantity/100 + '</td>';
				item += '<td>' + data.food.protein*quantity/100 + '</td>';
				item += '<td>' + data.food.fat*quantity/100 + '</td>';
				item += '<td>' + data.food.carbohydrate*quantity/100 + '</td>';
				item += '<td>' + data.food.sugar*quantity/100 + '</td>';
				item += '<td>' + data.food.salt*quantity/100 + '</td>';
				item += '<td>' + data.food.fiber*quantity/100 + '</td>';
				item += '<td>' + quantity + ' g</td>';
				item += '<td><button class="delete-item" value="' + data.userFood + '">Delete</button>';
				item += '</td>';
				item += '</tr>';
        		$('#added-items> tbody:last-child').append(item);
        	},

        	error: function(data){
        		// 3console.log(data);
        	},
        });

	});

	$(document).on('click', '.delete-item', function(e){
		var btn = $(this);
		var itemId = $(this).val();
		var row = $(this).closest('tr');

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
			}
		});

		$.ajax({
			type: 'delete',
			url: '/calculator/'+ itemId,

			success: function(data){
				row.remove();
				$('li[id="item-' + itemId + '"').remove();
				
				btn.remove();
			},

			error: function(data){
				// console.log(data);
			},
		});
	});

	$('input[name="date"]').change(function(e){
		location.replace('/calculator/' + $(this).val());
	});
});