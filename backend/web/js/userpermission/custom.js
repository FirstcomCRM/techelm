$(document).ready(function(e){

	$("#controller").change(function(e){
		e.preventDefault();
		location.href = "?r=user-permission%2Fcreate&controller=" + $(this).val();
	});

});