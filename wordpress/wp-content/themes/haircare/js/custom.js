(function($) {
  "use strict";
  $(function() {
  $(window).load(function(){$('body').width($('body').width()+1).width('auto')});
  var $mid_container_height = $("#mid_container_wrapper").css('height');
// prettyphoto
$('.gallery-item a').attr('data-gal', 'prettyPhoto[gallery]');
$("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
$('.more-link').addClass("readmore");
$('#wp-calendar a').parent().addClass('cal-blog');
$('.fullscreen_portfolio_bg:last-child').parents().find('#mid_container_wrapper').css({'padding-bottom':'0'});
//$('.widget_kaya-portfolio-slider-widget').parent().parent().css({"padding-bottom":"0","position":"relative","z-index":"3"} );
//$(".widget_kaya-title.panel-first-child.panel-last-child").parent().parent().css("cssText", "margin-bottom: 30px!important;");
//$('.panel-row-style').parent().next().children('.panel-row-style').parent().prev().attr('style','margin-bottom:0!important');
//$('.panel-row-style').append('<div class="container_bg_img"></div>');
//$(".widget_kaya-title.panel-first-child.panel-last-child").parent().parent('.panel-row-style').parent().next().children('.panel-row-style').parent().prev().children('.panel-row-style').attr("style", "margin-bottom: 0px!important; padding-bottom:3px; border-bottom:0;");
//$(".widget_kaya-title.panel-first-child.panel-last-child").parent().parent('.panel-row-style').parent().next().children('.panel-row-style').attr("style", "padding-top:30px; border-top:0;");
$('.panel-row-style').parent().addClass('panel-row-style-parent');
$('.panel-row-style-parent:last-child').parent().parent().parent().parent().parent().parent().css('padding-bottom','0').addClass('panel-row-style-last');
$('.panel-row-style-parent:first-child').parent().parent().parent().parent().parent().parent().css('padding-top','0').addClass('panel-row-style-first');
$('.menu ul:first > li').addClass("main-links");
  $('#mid_container, .bottom_section').animate({opacity:1},0);
// Responsive Mobile Section
// Responsive Menu Nav
   $("<select />").appendTo(".menu");
  // Create default option "Go to..."
  $("<option />", {
  "selected": "selected",
  "value"   : "",
  "text"    : "Go to..."
  }).appendTo(".menu select");

  // Populate dropdowns with the first menu items
  $(".menu ul li a").each(function() {
  var el = $(this);
  if($(this).parents("ul.sub-menu").length > 0){
  $("<option />",{
  "value"   : el.attr("href"),
  //"text"    : '\xa0'+ '\xa0'+ '\xa0'+ el.text()
  "text"    : " -- "+ el.text()
  }).appendTo(".menu select");
  }else{
  $("<option />", {
  "value"   : el.attr("href"),
  "text"    : el.text()
  }).appendTo(".menu select");
  }
  });
  //make responsive dropdown menu actually work     
  $(".menu select").change(function() {
  window.location = $(this).find("option:selected").val();
  });

//mobile menu
    //$('.mobile_nav_icon i').click(function(e){    
        //    $('nav').slideToggle(300);
      //  });
function checkWidth() {
    if ($(window).width() <= 1006) {
      
        $('.header_right_section  nav .menu').addClass('mobile_menu');
        $('.header_right_section  nav .menu').removeClass('menu');
        $('.mobile_menu').parent().removeClass('toggle_off');
        //alert($(window).width());
    } else {
      //alert('test');
        $('.mobile_menu').addClass('menu');
        $('.header_right_section  nav .menu').removeClass('mobile_menu');
         $('.header_right_section  nav .menu').parent().addClass('toggle_off');
         var $mid_container_height = $("#mid_container_wrapper").css('height');
         // Sidebar Border Fullwidth
        var $mid_container_padding =  parseInt(jQuery("#mid_container_wrapper").css("padding-top"));
        $('#sidebar').css({'height' : $mid_container_height,'margin-top' : -$mid_container_padding, 'margin-bottom' : -$mid_container_padding,'padding-top' : $mid_container_padding, 'padding-bottom' : $mid_container_padding});
    }
}
//checkWidth();
 $(window).resize(function(){

   // checkWidth();
});

/****************** masonry code **************/
if (jQuery().isotope){
$(window).load(function(){
$(function (){
  var isotopeContainer = $('.isotope-container, .portfolio_gallery, .blog-isotope-container, .widget-isotope-container, .gallery-images');
  isotopeContainer.isotope({
    masonry:{
                   columnWidth:    1,
                    isAnimated:     true,
                    isFitWidth:     true
                }
  });
});
});
}

// Scroll Top
 $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('.scroll_top').fadeIn();
    } else {
        $('.scroll_top').fadeOut();
    }
});
 $('.scroll_top').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});

// Slider Arrows Hide / Show
$('.bx-controls-direction .bx-prev').css('display','none');
$('.bx-controls-direction .bx-next').css('display','none');
$('.single_img.slider, .widget_kaya-slider').hover(function(){
     //$('.bx-controls-direction', this).fadeIn();
     $('.bx-controls-direction .bx-prev').css({'display':'block','left' : "-40px"}).stop().animate({'display':'block','left' : "30px"});
     $('.bx-controls-direction .bx-next').css({'display':'block','right' : "-40px"}).stop().animate({'display':'block','right' : "30px"});
  },function(){
      $('.bx-controls-direction .bx-prev').stop().css({'display':'block','left':'50px'}).animate({'display':'block','left' : "-40px" });
      $('.bx-controls-direction .bx-next').stop().css({'display':'block','right':'50px'}).animate({'display':'block','right' : "-40px"});
});
// parallax Image
var $single_img_parallex_inner_text = jQuery(".single_img_parallex_inner_text").height();
  var aaa = $('.single_img_parallex_inner_text').css('margin-top', -($single_img_parallex_inner_text / 2 ))
 $(window).resize(function(){
     var $single_img_parallex_inner_text = jQuery(".single_img_parallex_inner_text").height();  
  });
//Fit Videos
 $("#mid_container_wrapper").fitVids({ customSelector: "iframe[src^='http://socialcam.com']"});
 //Footer Overlay container
$('.bottom_footer').on('click', '.footer-open', function(event) {
  //alert('open');
      $('.overlay_container').addClass('active').fadeTo( 450, 1 );
      $('.bottom_footer i').addClass('footer-close fa-plus').removeClass('footer-open fa-times');
  });
$('.bottom_footer').on('click', '.footer-close', function(event) {
  //alert('close');
     $('.overlay_container').removeClass('active').fadeTo( 200, 0 );
     $('.bottom_footer i').addClass('footer-open fa-times').removeClass('footer-close fa-plus');
  });
// Midcontainer window height
var $header_height = $('.header_wrapper').height();
var $sub_header_wrapper = $('.sub_header_wrapper').height();
var $screen_height = ( $(window).height() - ($header_height + $sub_header_wrapper + 225) );
$('#mid_container_wrapper').css('min-height',$screen_height); 
// Footer Toggle 
  $('#footer_toggle').click(function () {
    $('#bottom_toggle_footer').slideToggle({
      direction: "up"
    }, 300);
    $(this).toggleClass('close_toggle');
  }); // end click
// Scrollbar
if($('body')[0].scrollHeight > $(window).height()){
    $('.bottom_section').addClass("scrollbar");  
}else
$('.bottom_section').addClass("noscrollbar"); 
/* Shooping Cart */
$('.shop-product-items li .shop-produt-image, .related-product-slider .shop-produt-image, .upsells-product-slider .shop-produt-image').hover(function(){
    $(this).find('.product-cart-button').css({'display':'block','right' : "-50px"}).stop(true, true).animate({'display':'block','right' : "0"});
},function(){
     $(this).find('.product-cart-button').stop(true, true).css({'display':'block','right':'0px'}).animate({'display':'block','right' : "-50px"});
})
//$('.attachment-shop_single.wp-post-image').attr('data-pimg',"http://localhost/hair/wp-content/uploads/2013/06/T_2_front1.jpg");
$('.widget_shopping_cart_content .buttons a').removeClass('wc-forward');
$('.button, #review_form_wrapper .form-submit #submit, .widget_shopping_cart_content .buttons a').not('.wc-forward').addClass('primary-button');
$('.checkout-button, #place_order, .cart-sussess-message a').addClass('seconadry-button');
$('.related.products li, .upsells.products li, .cross-sells ul.products li').removeClass('first last');
//$('.related.products li, .upsells.products li').removeClass('last');
$('.add_to_wishlist').removeClass('single_add_to_wishlist button alt primary-button');
$('i.icon-align-right').removeClass('icon-align-right').addClass('fa fa-heart');

});
})(jQuery);