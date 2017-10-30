$(document).ready(function(e){
	$("#calendar").fullCalendar({
	    eventClick: function(calEvent, jsEvent, view) {
	    	$("#calendarModal").find('.modal-header label').html(calEvent.title);
	    	$("#calendarModal").find('.modal-body').html(
	    		'Start: ' + calEvent.start.format("YYYY-MM-DD") + "<br>" +
	    		'Status: ' + calEvent.status_flag
	    		);
	        $("#calendarModal").modal('toggle');

	    },
	    eventSources: [
	        '?r=calendar/tasks',
	        '?r=calendar/service'
	    ]

	});
});
