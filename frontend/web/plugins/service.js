$(document).ready(function(){

$('.serviceCustomer').change(function(){

	if($(this).val() == 0){
		return false;
	
	}else{

		var customerId = $('.serviceCustomer').val();

		$.get('?r=service/get-customer-information',{
			customerId : customerId

		},function(data){
			var data = jQuery.parseJSON(data);
			var result = data.result;
			
			if( data.status == 'Success') {
				
				var html = '<table class="table table-hover table-striped viewTableContent">'+
                        '<tr>'+
                            '<td><b>CUSTOMER NAME</b></td>' +
                            '<td>'+result.name.toUpperCase()+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>CONTACT PERSON</b></td>' +
                            '<td>'+result.contact_person.toUpperCase()+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>JOB SITE</b></td>' +
                            '<td>'+result.job_site.toUpperCase()+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>ADDRESS</b></td>' +
                            '<td>'+result.address.toUpperCase()+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>EMAIL</b></td>' +
                            '<td>'+result.email.toUpperCase()+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>CONTACT NUMBER</b></td>' +
                            '<td>'+result.contact_number+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>FAX NUMBER</b></td>' +
                            '<td>'+result.fax_number+'</td>'+
                        '</tr>'+
                    '</table>';

        			$('#customer-information').html(html);

			}else{
				return false;

			}
		});
	}

});

});