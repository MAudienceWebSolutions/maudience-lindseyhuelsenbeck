jQuery(function() {
//----------------------------------------------------
// Contact Form 
//----------------------------------------------------
 jQuery('#main input#contact_submit').live("click",function(e) { 
		    e.preventDefault();
		var name = jQuery('input#name').val();
		var contact_email = jQuery('input#contact_email').val();
		var message = jQuery('textarea#message').val();
		var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
		var subject = jQuery('input#subject').val();
		var siteemail = jQuery('input#siteemail').val();
		var hasError = false;
		 if(name=='')
		 {
			 jQuery('[name="name"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
			 jQuery('[name="name"]').removeClass('vaidate_error');
			 }
			 
		if(contact_email=='')
		 {
			 jQuery('[name="contact_email"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
			if (!pattern.test(contact_email)) {
				jQuery('[name="contact_email"]').addClass('vaidate_error');
				 hasError = true;
			 }else{
				 jQuery('[name="contact_email"]').removeClass('vaidate_error');
				 }
			 }

		if(message=="")
			 {
				 jQuery('[name="message"]').addClass('vaidate_error');
				 hasError = true;
			 }else{
				 jQuery('[name="message"]').removeClass('vaidate_error');
			}
		if(subject=="")
			 {
				 jQuery('[name="subject"]').addClass('vaidate_error');
				 hasError = true;
			 }else{
				 jQuery('[name="subject"]').removeClass('vaidate_error');
				 }
        if(hasError) { return; }
		else {		
				jQuery.ajax({
		            type: 'post',
		           	url: cpath.plugin_dir + '/sendEmail.php',
		            data: 'name=' + name + '&contact_email=' + contact_email +'&subject='+ subject +'&message=' + message +'&siteemail='+ siteemail,

		            success: function(results) {	
		                jQuery('div#contact_response').html(results).css('display', 'block');		
		   
		         }
		     }); // end ajax
		}

    });
 jQuery('#main input#submit').live("click",function(e) { 
		e.preventDefault();
		var appointment_name = jQuery('input#appointment_name').val();
		var appointment_email = jQuery('input#appointment_email').val();
		var appointment_message = jQuery('textarea#appointment_message').val();
		var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
		var number_validate =  new RegExp( /^[0-9-+]+$/ );
		var appointment_persons = jQuery('input#appointment_persons').val();
		var appointment_phone = jQuery('input#appointment_phone').val();
		var appointment_date = jQuery('input#appointment_date').val();
		var appointment_time = jQuery('input#appointment_time').val();
		var appointment_subject = jQuery('input#appointment_subject').val();
		var appointment_email_id = jQuery('input#appointment_email_id').val();
		var hasError = false;
		if(appointment_name=='')
		{
			jQuery('[name="appointment_name"]').addClass('vaidate_error');
			hasError = true;
		}else{
			jQuery('[name="appointment_name"]').removeClass('vaidate_error');
		}
		if(appointment_email=='')
		{
			jQuery('[name="appointment_email"]').addClass('vaidate_error');
			hasError = true;
		}else{
		if (!pattern.test(appointment_email)) {
			jQuery('[name="appointment_email"]').addClass('vaidate_error');
			hasError = true;
		}else{
			jQuery('[name="appointment_email"]').removeClass('vaidate_error');
		}
		}
		if(appointment_email_id=='')
		{
			jQuery('[name="appointment_email_id"]').addClass('vaidate_error');
			hasError = true;
		}else{
		if (!pattern.test(appointment_email_id)) {
			jQuery('[name="appointment_email_id"]').addClass('vaidate_error');
			hasError = true;
		}else{
			jQuery('[name="appointment_email_id"]').removeClass('vaidate_error');
		}
		}
		if(appointment_time=="")
		 {
			 jQuery('[name="appointment_time"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
			 jQuery('[name="appointment_time"]').removeClass('vaidate_error');
			 }
		if(appointment_date=="")
		 {
			 jQuery('[name="appointment_date"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
			 jQuery('[name="appointment_date"]').removeClass('vaidate_error');
			 }
		if(appointment_phone=="")
		 {
			 jQuery('[name="appointment_phone"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
		 	if( !number_validate.test(appointment_phone) ){
		 		jQuery('[name="appointment_phone"]').addClass('vaidate_error');
		 	}else{
		 		jQuery('[name="appointment_phone"]').removeClass('vaidate_error');
		 	}
			 }
		if(appointment_persons=="")
		 {
			 jQuery('[name="appointment_persons"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
		 	if( !number_validate.test(appointment_persons) ){
		 		jQuery('[name="appointment_persons"]').addClass('vaidate_error');
		 	}else{
			 jQuery('[name="appointment_persons"]').removeClass('vaidate_error');
			 }	
			 }					 
		if(appointment_message=="")
		 {
			 jQuery('[name="appointment_message"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
			 jQuery('[name="appointment_message"]').removeClass('vaidate_error');
			 }
		if(appointment_subject=="")
		 {
			 jQuery('[name="appointment_subject"]').addClass('vaidate_error');
			 hasError = true;
		 }else{
			 jQuery('[name="appointment_subject"]').removeClass('vaidate_error');
		}	 		 
		if(hasError) { return; }
		else {	
			jQuery.ajax({
				type: 'post',
				url: cpath.plugin_dir + '/appointment_form.php',
				data: 'appointment_email_id='+appointment_email_id +'&appointment_name=' + appointment_name + '&appointment_email=' + appointment_email  +'&appointment_message=' + appointment_message + '&appointment_phone=' + appointment_phone + '&appointment_persons=' + appointment_persons +'&appointment_date='+ appointment_date +'&appointment_time=' + appointment_time + '&appointment_subject=' + appointment_subject,

				success: function(results) {	
					jQuery('div#response').html(results).css('display', 'block');		
				}
			}); // end ajax
		}
		});


});