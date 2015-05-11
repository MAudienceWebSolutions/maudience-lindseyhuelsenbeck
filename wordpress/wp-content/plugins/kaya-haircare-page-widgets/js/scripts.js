(function( $ ) {
    "use strict";
    $(function() {

    	// Info Boxes
  $( ".info_box .delete" ).click(function() {
        $(this).parent('.info_box').parent().animate({ opacity: 'hide' }, "slow");
    });
  $(".toggle_content").hide();
           $("strong.trigger").click(function(){
         $(this).toggleClass("active").next().slideToggle("slow");
      
    });
/* ----------------------------------
Gallery Widget
------------------------------------*/
$('.gallery_image_wrapper').each(function(){
	var grayscale = $(this).data('grayscale');
	if( grayscale == 'on' ){
		$(this).find('ul li, .image_gallery_slider').addClass('gray_scale_img');
		$(this).find('ul li, .image_gallery_slider').hover(function(){
			$(this).removeClass('gray_scale_img');
		},function(){
			$(this).addClass('gray_scale_img');
		});
	}
	$(this).find('ul li, .image_gallery_slider').hover(function(){
		$(this).find('.image_hover_bg_color').stop(true,true).fadeIn('slow');
		$(this).find('.mouse_over_on_image').stop(true,true).css('bottom', "0px");
	},function(){
		$(this).find('.image_hover_bg_color').stop(true,true).fadeOut('slow');
		$(this).find('.mouse_over_on_image').stop(true,true).css('bottom', "-100%");
	});	
	var bg_color =$(this).find('.image_hover_bg_color').css('background-color');
	if( bg_color != 'transparent'){
		$(this).find('ul li, .image_gallery_slider').hover(function(){
			$(this).find('img').css('opacity',0.5);
		},function(){
			$(this).find('img').css('opacity',1);
		});	
	}
});

function gallery_widget_slider(){
$('.gallery_image_wrapper').each(function(){
	var columns = $(this).data('columns');
	var autoplay = $(this).data('autoplay');
	var buttons = $(this).find('#gallery_widget_slider').data('buttons');
	var animationin = $(this).find('#gallery_widget_slider').data('animationin');
	var animationout = $(this).find('#gallery_widget_slider').data('animationout');

   $(this).find('#gallery_widget_slider').owlCarousel({
	nav:buttons,
	navText: [ '', '' ],
	loop : true,
	navigation:false,
	autoplay : autoplay,
	stopOnHover : true,
	items :columns,
	autoHeight : true,
	animateOut: animationout,
	animateIn: animationin,	  
   });	
});
}
 gallery_widget_slider();
 $('.gallery_image_wrapper').each(function(){
      	var radius = $(this).data('radius');
      	$(this).find('.owl-item').css('border-radius', radius+'%');
      });          
 //Skillbar 
jQuery('.skillbar').each(function(){
		    jQuery(this).find('.skillbar-bar').animate({
		        width:jQuery(this).attr('data-percent')
		    },2000);
		     jQuery(this).find('.skill-bar-percent, .left_arrow').animate({
		        left : jQuery(this).attr('data-percent')
		    },2000);
		   //  $( ".skill-bar-percent" ).animate({ opacity: 1}, 1500 );
		});
 // Page builder
// $(".panel-grid-cell:not(.panel-row-style)").parent('.panel-grid').addClass("no-panel-row-style");
$('span#controls .prevBtn, span#controls .nextBtn').css('display','block');
$('.widget_kaya-slider').animate({opacity:1},5000);          
    // Portrfolio Hover
$('.da-thumbs > li').each( function() { $(this).hoverdir(); } );
$('.da-thumbs .owl-item').each( function() { $(this).hoverdir(); } );
$('#relatedposts .owl-item, #kaya_main_slider .owl-item').hoverdir(); 
  function fluid_script(){
   var $content_width= $('#fluid_layout .widget_kaya-promobox, #fluid_layout .promobox-video > div').width($(window).width());
		var $container_fluid = Math.ceil( (($(window).width()  - parseInt($('.container').css('width'))) / 2) );
		$(' #fluid_layout .widget_kaya-promobox').css({
		   'margin-left' : -$container_fluid,
		   width : $content_width+'25'
		});
		var $vals = $('#box_layout').css('width');
		$('#box_layout .widget_kaya-promobox, #box_layout .promobox-video > div').css({
		   'width' : $vals,
		});
		$('#box_layout .widget_kaya-promobox').css({
		   'margin-left' : -30,
		   		});
		//alert();
		$('.widget_kaya-promobox').css({
		   'position' : 'absolute',
		   'top' : 0,
		   'overflow' : 'hidden',
		   'height' : '100%',
		  });
        }

 fluid_script();
   $(window).resize(function(){
	  fluid_script();
	});

});
})(jQuery);