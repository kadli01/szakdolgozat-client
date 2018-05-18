$(document).ready(function(){

	var url = '/calculator/add';

	$(document).on('click', '.add-item', function(e){
		var category = $(this).val();
		var date = $('input[name="date"]').val();
		var itemId = $('select[name="' + category + '-items"] option:selected').val();
		var quantity = $('input[name="' + category + '-quantity"]').val();

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
        console.log(formData);

        $.ajax({
        	type: 'post',
        	url: url,
        	data: formData,
        	dataType: 'json',

        	success: function(data){
        		var data = data.data;
        		var item = '<div id="item-'+ data.userFood +'"  class="d-flex align-items-center">';
        		item +=	'<p>'+ data.food.name +': '+ quantity +' g</p>';
        		item += '<button class="delete-item" value="' + data.userFood +'">Delete</button>';
        		item += '</div>';

        		$('#scrollable-' + category).append(item);

        		console.log(data);
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
				$('div #item-' + itemId).remove();
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