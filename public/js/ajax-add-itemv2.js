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
        		console.log(data);
        		var item = '<li id="item-'+ data.userFood +'">' + data.food.name + ':' + quantity + 'g <button class="delete-item" value="' + data.userFood + '">Delete</button></li>';
        		$('#added-items').append(item);
        	},

        	error: function(data){
        		console.log(data);
        	},
        });

	});

	$(document).on('click', '.delete-item', function(e){
		var btn = $(this);
		var itemId = $(this).val();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
			}
		});

		$.ajax({
			type: 'delete',
			url: '/calculator/'+ itemId,

			success: function(data){
				$('li[id="item-' + itemId + '"').remove();
				btn.remove();
			},

			error: function(data){
				console.log(data);
			},
		});
	});

	$('input[name="date"]').change(function(e){
		location.replace('/calculator/' + $(this).val());
	});
});