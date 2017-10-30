$(document).ready(function(e){
	$(document).on('click', '#btnAddRow', function(e){
		e.preventDefault();
		var table = $('#complaints');
		var row = table.find('tbody').find('tr').first().clone();
		row.find('textarea').val('');
		table.prepend(row);
	});


	$('#complaints *').ready(function(e){
		var category_id = $('#servicejob-service_no').val();
	/*	$(".service_category ").each(function(e){
			var category = $(this);
			var category_id = $(this).val();
			getComplaints(category, category_id);
		});*/
/*		$(".service_category").click(function(e){
			console.log('click');
			var category = $(this);
			var category_id = $(this).val();
			getComplaints(category, category_id);
		});*/
		/*$(document).on('click', '.service_category', function(e){
			console.log('click');
			var category = $(this);
			var category_id = $(this).val();
			getComplaints(category, category_id);
		});
	});*/


		$(document).on('change', '.service_category', function(e){
			var category = $(this);
			var category_id = $(this).val();
			getComplaints(category, category_id);
		});
	});

	function getComplaints(category, category_id){
		$.ajax({
			url: '?r=servicejob%2Fget-complaints',
			dataType: 'json',
			data: {category_id: category_id},
			method: 'post',
			success: function(e){
				var data = e.data;
				var html;
				for(var x = 0; x<e.data.categories.length; x++){
					var complaint = e.data.categories[x].complaint;
					var id = e.data.categories[x].id;
					html += "<option value='" + id + "'>" + complaint + "</option>";
				}
				category.closest('tr').find('.service_complaints').empty().append(html);
			}
		});
	}
});
