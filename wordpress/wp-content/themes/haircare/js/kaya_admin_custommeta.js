(function($) {
  "use strict";
	$(function() {

	$("#video_type").change(function () {
	$("#youtube_video").parent().parent().hide();
	$("#vimeo_video").parent().parent().hide();
	var selectlayout = $("#video_type option:selected").val(); 
	$("#video_embed").parent().parent().hide();
	switch(selectlayout)
	{
		case 'vimeo':
			$("#vimeo_video").parent().parent().show();
		break;
		case 'youtube':
			$("#youtube_video").parent().parent().show();
		break;
		case 'videoembed':
			$("#video_embed").parent().parent().show();
		break;
		
	}
}).change();

//Meta Page Optons

$("#select_page_options").change(function() {
	var select_options = $("#select_page_options option:selected").val(); 
	$('#slider').parent().parent().hide();
	$('#kaya_custom_title').parent().parent().hide();
	$('#kaya_custom_title_description').parent().parent().hide();
	$("#Single_Image_height").parent().parent().hide();
	$(".Single_Image_Upload").parent().parent().hide();
	$("#Single_Image_content").parent().parent().hide();
	$("#single_img_attachment").parent().parent().parent().hide();
	$('#customslider_type').parent().parent().hide();

	switch(select_options){
		case 'page_title_setion':
			$('#slider').parent().parent().hide();
			$('#kaya_custom_title').parent().parent().show();
			$('#kaya_custom_title_description').parent().parent().show();
			$('.page_bg_Image_Upload').parent().parent().show();
			$('.kaya_title_color').parent().parent().show();
			break;
		case 'singleimage':
			$("#Single_Image_height").parent().parent().show();
			$(".Single_Image_Upload").parent().parent().show();
			$("#Single_Image_content").parent().parent().show();
			$("#single_img_attachment").parent().parent().parent().show();
			$("#Single_Image_opacity").parent().parent().show();
			break;			
	}	

}).change();

    // Display only needed post meta boxes
    var Kaya_post_options = $('#post-formats-select input'),
        kaya_meta_link = $('#kaya_link_format'),
        kaya_pf_link = $('#post-format-link'),
        kaya_meta_gallery = $('#kaya_post_format_gallery'),
        kaya_pf_gallery = $('#post-format-gallery'),
        kaya_meta_video = $('#kaya_post_format_video'),
        kaya_pf_video = $('#post-format-video'),
        kaya_meta_audio = $('#kaya_audio_format'),
        kaya_pf_audio = $('#post-format-audio'),
        kaya_meta_quote = $('#kaya_quote_format_quote'),
        kaya_pf_quote = $('#post-format-quote');

    function kaya_hide_post_formates(){
        kaya_meta_link.css('display', 'none');
        kaya_meta_gallery.css('display', 'none');
        kaya_meta_video.css('display', 'none');
        kaya_meta_audio.css('display', 'none');
        kaya_meta_quote.css('display', 'none');
    }

    kaya_hide_post_formates();

    Kaya_post_options.on('change', function(){
        var that = $(this);
        kaya_hide_post_formates();
        if(that.val() === 'link'){
            kaya_meta_link.css('display', 'block');
        }else if(that.val() === 'gallery'){
            kaya_meta_gallery.css('display', 'block');
        }else if(that.val() === 'video'){
            kaya_meta_video.css('display', 'block');
        }else if(that.val() === 'audio'){
            kaya_meta_audio.css('display', 'block');
        }else if(that.val() === 'quote'){
            kaya_meta_quote.css('display', 'block');
        }
    });

    if(kaya_pf_link.is(':checked')) kaya_meta_link.css('display', 'block');
    if(kaya_pf_gallery.is(':checked')) kaya_meta_gallery.css('display', 'block');
    if(kaya_pf_video.is(':checked')) kaya_meta_video.css('display', 'block');
    if(kaya_pf_audio.is(':checked')) kaya_meta_audio.css('display', 'block');
    if(kaya_pf_quote.is(':checked')) kaya_meta_quote.css('display', 'block');
    //Full Screeen Slider / Video Selection
  $("#select_full_bg_type").change(function () {
  	$("#full_screen_bg_images_description").parent().parent().hide();
	$("#full_screen_bg_transition").parent().parent().hide();
	$("#full_screen_auto_play").parent().parent().hide();
	$("#fullscreen_bg_video").parent().parent().hide();
	$(".full_screen_single_bg_image").parent().hide();
	$(".single_bg_img_repeat").parent().parent().hide();
	$(".bg_img_position").parent().parent().hide();
	$(".bg_img_attachment").parent().parent().hide();
	$(".disable_slide_title").parent().parent().hide();	
	$(".background_audio").parent().parent().hide();
	var selectlayout = $("#select_full_bg_type option:selected").val(); 
	$("#video_embed").parent().parent().hide();
	switch(selectlayout)
	{
		case 'fullscreen_video_bg':
			$("#fullscreen_bg_video").parent().parent().show();
			$(".background_audio").parent().parent().show();
			break;
		case 'fullscreen_img_slider':
			$("#full_screen_bg_transition").parent().parent().show();
			$("#full_screen_auto_play").parent().parent().show();
			$("#full_screen_bg_images_description").parent().parent().show();
			$(".disable_slide_title").parent().parent().show();
			break;
		case 'single_bg_image':
			$(".full_screen_single_bg_image").parent().show();
			$(".single_bg_img_repeat").parent().parent().show();
			$(".bg_img_position").parent().parent().show();
			$(".bg_img_attachment").parent().parent().show();	
			break;	
		
	}
}).change();
});
})(jQuery);