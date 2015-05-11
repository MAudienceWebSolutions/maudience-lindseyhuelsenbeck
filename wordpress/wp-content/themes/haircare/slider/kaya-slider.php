<?php
// Slider Settings
if( !function_exists('kaya_image_slider') ) :
function kaya_image_slider(){
  global $post_item_id, $post;
  echo  kaya_post_item_id();
  $kaya_options = get_option('kayapati');
 $slider=get_post_meta($post_item_id,'slider',true);
 if( $slider == 'none' || $slider == ''){ }
 		else {

			echo '<div id="main_slider">';	
			if($slider=="bxslider"){
				get_template_part('slider/bx','slider');
			}
			elseif($slider=="customslider"){
				get_template_part('slider/custom','slider');
			}
			
			else{ }
		echo '</div>';
	}
	//else{ ?>

<?php	//}
	wp_reset_query();
}
endif;
?>