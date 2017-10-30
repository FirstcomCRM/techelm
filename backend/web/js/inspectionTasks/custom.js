$(document).ready(function(e){

	$(document).on('click', '.remove', function(e){
		$(this).closest('tr').remove();
	});
	$('body').on('focus',".datepicker", function(){
	    $(this).datepicker();
	});
	$.fn.datepicker.defaults.format = "yyyy-mm-dd";

	$(document).on('click', '#add_row', function(e){		//i = i+1;
		e.preventDefault();		//console.log(i);
		//var row = $('#tasks_inspection tbody tr').first().clone();
		var row = $('#tasks_inspection tbody tr').first().clone();

		row.find('input').val('');
		row.find('.datepicker').datepicker();
		$('#tasks_inspection tbody').append(row);
	});













});