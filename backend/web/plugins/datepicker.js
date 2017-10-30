$(document).ready(function () {

	$('#date_call').datepicker({
            autoclose : true,
            format: 'dd-mm-yyyy',
            startDate: '+1d',
    });

    $("#projectjob-targe_completion_date").datepicker({
        autoclose : true,
        format: 'dd-mm-yyyy',
				//format: 'yyyy-mm-dd',
        startDate: '+1d'
    });

    $("#projectjobipi-dispo_by_date").datepicker({
        autoclose : true,
        format: 'dd-mm-yyyy',
        startDate: '+1d'
    });

    $('#projectjobipi-sub_c_date').datepicker({
        autoclose : true,
        format: 'dd-mm-yyyy',
        startDate: '+1d'
    });

    $('#projectjobipi-date_inspected').datepicker({
        autoclose : true,
        format: 'dd-mm-yyyy',
        startDate: '+1d'
    });


		$('.target-completion').datepicker({
				autoclose : true,
				//format: 'mm/dd/yyyy',
			 	format: 'yyyy-mm-dd',
				startDate: '+1d'
		});


    $('.datepicker').datepicker({
        autoclose : true,
      //  format: 'dd-mm-yyyy',
				format: 'yyyy-mm-dd',
        startDate: '+1d'
    });




});
