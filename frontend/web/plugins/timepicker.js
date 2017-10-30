$(document).ready(function(){
	
	var date = new Date();
	var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear(); 

    var now = currentDate + '/' + currentMonth + '/' + currentYear;

	$('.timepicker').wickedpicker({now: '0:00:00', twentyFour: false, title:
       now , showSeconds: true});

});