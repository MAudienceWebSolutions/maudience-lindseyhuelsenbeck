<?php
  global $post_item_id, $post;
  echo  kaya_post_item_id();
  $kaya_options=get_option('kayapati');
	$category=get_post_meta($post_item_id,'Kaya_Sliders',false);
	$Kaya_bx_slider_limit=get_post_meta($post_item_id,'Kaya_bx_slider_limit',true);
	$kaya_slidecaption=get_post_meta($post_item_id,'kaya_slidecaption',true);
	$kaya_slidelink=get_post_meta($post_item_id,'kaya_slidelink',true);
	$Kaya_slider_easing=get_post_meta($post_item_id,'Kaya_slider_easing',true);
	$Kaya_slider_transitions=get_post_meta($post_item_id,'Kaya_slider_transitions',true);
	$kaya_slider_order=get_post_meta($post_item_id,'kaya_slider_order',true);
	$Kaya_slider_height=get_post_meta($post_item_id,'Kaya_slider_height',true) ? get_post_meta($post_item_id,'Kaya_slider_height',true) :'500';
	$slide_text_color=get_post_meta($post_item_id,'slide_text_color',true);
	$Kaya_slider_autoplay=get_post_meta($post_item_id,'Kaya_slider_autoplay',true);
	$Kaya_slider_mode=get_post_meta($post_item_id,'Kaya_slider_mode',true);
	$adaptive_height=get_post_meta($post_item_id,'adaptive_height',true);
	$Kaya_slider_pause=get_post_meta($post_item_id,'Kaya_slider_pause',true) ? get_post_meta($post_item_id,'Kaya_slider_pause',true) : '4000';
	$height = ( $adaptive_height == 'true' ) ? '' : $Kaya_slider_height;
		?>
    <script type="text/javascript">  
    (function($) {
       	"use strict";
      $(function() {
         $('.bxslider').bxSlider({
		  useCSS: false,
			preloadImages:'hidden',
		  pause : <?php echo $Kaya_slider_pause ?>,
		  easing: '<?php echo $Kaya_slider_easing; ?>',
		  speed: 2000,
		  mode:'<?php echo $Kaya_slider_transitions; ?>',
		  auto : <?php echo $Kaya_slider_autoplay; ?>,
		  adaptiveHeight : <?php echo $adaptive_height; ?>,
		  onSliderLoad: function(){
			$(".bxslider").css("visibility", "visible");
		 }
 		});
	});

})(jQuery);
    </script>

	<div id="bx_slider_wrapper">
		<div class="<?php echo $Kaya_slider_mode; ?>">
	<ul class="bxslider" style="height:<?php echo $Kaya_slider_height; ?>px!important;">
	<?php
		if(empty($category)) {
				$loop = new WP_Query(array('post_type' => 'slider', 'taxonomy' => 'slider_category','term' => $category, 'orderby' => 'menu_order', 'posts_per_page' =>$Kaya_bx_slider_limit,'order' => $kaya_slider_order));
			}else{ 
				$loop =new WP_Query( array('post_type' => 'slider', 'orderby' => '', 'posts_per_page' =>$Kaya_bx_slider_limit,'order' => $kaya_slider_order , 'tax_query' => array( array( 'taxonomy' => 'slider_category', 'field' => 'slug', 'terms' => $category , 'operator' => 'IN'))));
			}
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<li>
		<span class="slider_overlay1"> </span>	
	<?php
	global $post;  	?>
			<?php
	$slider_link=get_post_meta(get_the_ID(),'customlink' ,true);
	$slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
	$slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
	$slider_target_link= get_post_meta($post->ID,'slider_target_link',true);
	$slide_description= get_post_meta($post->ID,'slide_description',true);
	$slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
	$disable_slide_content = get_post_meta($post->ID,'disable_slide_content',true);
	if( $slider_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
		if($slider_link){
			echo '<a href="'.$slider_imglink.'" '.$target_link_class.' >';
		}
		$kaya_img_height =  ( get_theme_mod('theme_layout_mode') == 'boxed' || $Kaya_slider_mode == 'container' ) ?  '1160' : '1920';
			$params = array('width' => $kaya_img_height, 'height' => $height, 'crop' => true);
				$img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL
				echo kaya_imageresize($post->ID, $params,'');
				echo '</a>';
				if($disable_slide_content == "0") { 
					if( $slide_text_color ) {
				$slide_colors =array(
					'color' => $slide_text_color,
				); 
				$slide_color_val = array();
				foreach ($slide_colors as $slide_style => $slide_color) {
							$slide_color_val[] = $slide_style.':'.$slide_color;
				}
			} else{ $slide_text_color = ''; }?>	
				<div class="caption">
					<div class="container">
					<h3 class="slide_title" style="<?php echo implode('; ', $slide_color_val); ?>"><?php echo the_title(); ?></h3>
					<p style="color:<?php echo $slide_text_color; ?>"><?php echo $slide_description; ?></p>
				</div>
				</div>
		<?php } ?>
			<?php endwhile; // End the loop. Whew. ?>
	</li>
	 <?php else :
                echo '<li><img src="'.get_template_directory_uri().'/images/defult_featured_img.png" width="100%" height="400"></li>';
                endif; ?>

	</ul>
  	<?php   wp_reset_query();
      wp_reset_postdata(); ?>
    	<div class="clear"></div>
      </div>
  </div>