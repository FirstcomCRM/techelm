$(document).ready(function(e){
	var price = $('#servicejobparts-total_price').val() ? $('#servicejobparts-total_price').val(): 0;
	var quantity = $('#servicejobparts-quantity').val() ? $('#servicejobparts-quantity').val(): 0;
	var getSum = function setSum(){
				$('#servicejobparts-total_price').val(quantity * price);
	}
	$(document).on('input', '#servicejobparts-quantity', function(e){
		quantity = parseInt($(this).val());
		getSum();
	});

	$(document).on('input', '#servicejobparts-unit_price', function(e){
		price = parseInt($(this).val());
		getSum();
	});
});
