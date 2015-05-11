<?php
function kaya_custom_js(){
	 global $post_item_id, $post;
  echo  kaya_post_item_id();
	$kaya_fullwidth_images= get_post_meta($post_item_id,'kaya_fullwidth_images',true);
	$sidebar_layout=get_post_meta($post_item_id,'kaya_pagesidebar',true); 
  $loader_flash_bg_color = get_option('loader_flash_bg_color') ? get_option('loader_flash_bg_color') : '#1abc9c'; 
 ?>
	<script type="text/javascript">
(function($) {
  "use strict";
	$(function() {
	 /* Lodader */
<?php if( get_theme_mod('hide_page_loader') != 'on' ) { ?>  
        $("body").queryLoader2({
        barColor: "<?php echo $loader_flash_bg_color; ?>",
        backgroundColor: "#fff",
        percentage: true,
        barHeight: 1,
        completeAnimation: "grow",
        minimumTime: 100
    });
  <?php } ?>
/****************** Portfolio Isotope code **************/
if (jQuery().isotope){
var tempvar = "all";
$(window).load(function(){
$(function (){
	var isotopeContainer = $('.isotope-container'),
	isotopeFilter = $('#filter'),
	isotopeLink = isotopeFilter.find('a');
	isotopeContainer.isotope({
		itemSelector : '.isotope-item',
		//layoutMode : 'fitRows',
		filter : '.' +tempvar,
		 masonry:  {
                   columnWidth:    1,
                    isAnimated:     true,
                    isFitWidth:     true
                },
        onLayout: function() {
   			$('.isotope li, .gallery dl').addClass('isotope-ready');
   		}
	});
	isotopeLink.click(function(){
		var selector = $(this).attr('data-category');
		isotopeContainer.isotope({
			filter : '.' + selector,
			itemSelector : '.isotope-item',
			//layoutMode : 'fitRows',
			animationEngine : 'best-available'
		});
		isotopeLink.removeClass('active');
		$(this).addClass('active');
		return false;
	});
});
		$("#filter ul li a").removeClass('active');
		$("#filter ul li."+tempvar+ " a").addClass('active');
});
}

<?php if( $kaya_fullwidth_images == '1' && $sidebar_layout =='full' ){ ?>
 	function portfolio_gallery_fluid(){
  <?php $theme_layout_mode = get_theme_mod('theme_layout_mode') ? get_theme_mod('theme_layout_mode') : 'center' ; 
          if( $theme_layout_mode == 'fluid_container' ){ 
          $layout_position = get_theme_mod('layout_position') ? get_theme_mod('layout_position') : 'center' ; 
         	 if( $layout_position == 'left' ){ ?>
         	 	 var $container_fluid = 30;
         	  <?php } elseif($layout_position == 'right') { ?>
         	  	 var $container_fluid = Math.ceil( (( ($(window).width() - 30)  - parseInt($('.container').css('width')))) );
         	  <?php }else{  ?>
         	  	 var $container_fluid = Math.ceil( (( ($(window).width() - 0)  - parseInt($('.container').css('width'))) / 2) );
         	<?php  } ?>
            var $content_width= ($(window).width() + 5);
          <?php }else{ ?>
             var $content_width=  parseInt($('.container').css('width'))+60;
              var $container_fluid = 30;
          <?php } ?> 
          $('.single_img').css({
             'margin-left' :-$container_fluid,
             width : $content_width
             });
      }
      portfolio_gallery_fluid();
       $(window).resize(function(){
            portfolio_gallery_fluid();
        });
        <?php } ?>  

       // Product Cart Icon
       <?php
   $cart_icon = get_theme_mod('menu_bar_cart_icon') ? get_theme_mod('menu_bar_cart_icon') : '0';
   if( $cart_icon == '0' ){
 if( class_exists('woocommerce')){ 
  global $woocommerce;
  $url =  $woocommerce->cart->get_cart_url();
  ?>
  $("ul#jqueryslidemenu").append('<li class="cart_icon"><a href="<?php echo $url; ?>" class="cart-contents"><i class="fa fa-shopping-cart">&nbsp; </i><span><?php echo sprintf(_n('%d ', '%d', $woocommerce->cart->cart_contents_count, 'woothemes' ), $woocommerce->cart->cart_contents_count); ?> </span></a></li>');
<?php }  } ?> 

});
})(jQuery);
</script>
<?php } 
add_action( 'wp_footer', 'kaya_custom_js', 100 );
?>
