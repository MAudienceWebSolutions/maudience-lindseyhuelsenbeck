(function($) {
  "use strict";
  $(function() {

 var group = $('#customize-control-kaya_logo_type input');
    $('#customize-control-upload_logo').css('display','none');
    $('#customize-control-text_logo').css('display','none');
    $('#customize-control-text_logo_font_size').css('display','none');
    $('#customize-control-text_logo_font_color').css('display','none');
    $('#customize-control-text_logo_font_family').css('display','none');
	$('#customize-control-logo_desc').css('display','none');
	$('#customize-control-logo_desc_sample').css('display','none');
	$('#customize-control-logo_desc_text_color').css('display','none');
   //var group = $('#customize-control-x_stack input');
 var text_logo_type   = $('#customize-control-kaya_logo_type input[value="text_logo"]');
 var img_logo_type   = $('#customize-control-kaya_logo_type input[value="img_logo"]');
      if(text_logo_type.is(":checked")){
            $('#customize-control-text_logo').css('display','block');
            $('#customize-control-text_logo_font_size').css('display','block');
            $('#customize-control-text_logo_font_color').css('display','block');
            $('#customize-control-text_logo_font_family').css('display','block');
			$('#customize-control-logo_desc').css('display','block');
			$('#customize-control-logo_desc_sample').css('display','block');
			$('#customize-control-logo_desc_text_color').css('display','block');
           //alert('text');
        }
        else if(img_logo_type.is(":checked")){
           $('#customize-control-upload_logo').css('display','block');
            //alert('img');
        } 
        else {
           //$('#customize-control-upload_logo').css('display','none');
       }  
  group.change( function() {
    if ($(this).val() == 'text_logo') {
            $('#customize-control-text_logo').css('display','block');
            $('#customize-control-text_logo_font_size').css('display','block');
            $('#customize-control-text_logo_font_color').css('display','block');
            $('#customize-control-text_logo_font_family').css('display','block');
            $('#customize-control-upload_logo').css('display','none');
            $('#customize-control-logo_desc').css('display','block');
			$('#customize-control-logo_desc_sample').css('display','block');
			$('#customize-control-logo_desc_text_color').css('display','block');
           //alert('text');
    }else if ($(this).val() == 'img_logo') {
         $('#customize-control-upload_logo').css('display','block');
         $('#customize-control-text_logo').css('display','none');
         $('#customize-control-text_logo_font_size').css('display','none');
         $('#customize-control-text_logo_font_color').css('display','none');
         $('#customize-control-text_logo_font_family').css('display','none');
		$('#customize-control-logo_desc').css('display','none');
		$('#customize-control-logo_desc_sample').css('display','none');
		$('#customize-control-logo_desc_text_color').css('display','none');
            //alert('img');
          }
  });
  // On change
     $('.kaya-radio-img').click(function() {
    $('.kaya-radio-img-selected').removeClass('kaya-radio-img-selected');
    $(this).addClass('kaya-radio-img-selected').children('input[@type="radio"]').prop('checked', true);
   });

});
})(jQuery);
