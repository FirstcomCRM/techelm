$(document).ready(function(e){
	$("#add_row").click(function(e){
		e.preventDefault();
		var row = $("#task tbody tr").first().clone();
		row.find('input').val('');
		$("#task tbody").prepend(row);
	});	$(document).on('click', '.remove', function(e){		$(this).closest('tr').remove();	});
});
