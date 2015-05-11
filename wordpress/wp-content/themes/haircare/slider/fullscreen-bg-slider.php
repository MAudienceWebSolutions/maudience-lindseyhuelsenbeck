<?php 
  global $post_item_id, $post;
	kaya_post_item_id();
	$full_screen_single_bg_image=get_post_meta($post_item_id,'full_screen_single_bg_image',true);
	$single_bg_img_repeat=get_post_meta($post_item_id,'single_bg_img_repeat',true) ? get_post_meta($post_item_id,'single_bg_img_repeat',true) :'cover';
  	$bg_img_position = get_post_meta($post_item_id,'bg_img_position',true) ? get_post_meta($post_item_id,'bg_img_position',true) : 'left';
	$bg_img_attachment = get_post_meta($post_item_id,'bg_img_attachment',true) ? get_post_meta($post_item_id,'bg_img_attachment',true) : 'fixed';
	$bg_img_position_fixed = ( $bg_img_attachment == 'fixed' ) ? 'position:fixed!important' : 'absolute';
	$bg_img_fit_screen = ( $single_bg_img_repeat == 'cover') ? 'cover' : 'inherit';
	$disable_slide_title = get_post_meta($post_item_id,'disable_slide_title',true) ? get_post_meta($post_item_id,'disable_slide_title',true) : '0';
	/* Default Image */
	$default_img = get_template_directory_uri().'/images/page_default_image.jpg';
   $custom_bg_image = get_option('page_custom_img');
   $bg_image= $custom_bg_image['bg_image'] ? $custom_bg_image['bg_image'] :$default_img ;
   $img_repeat = get_theme_mod('bg_image_repeat') ? get_theme_mod('bg_image_repeat') : 'cover';
   $img_attachment = get_theme_mod('bg_image_attachment') ? get_theme_mod('bg_image_attachment') : 'fixed';
   $img_position = get_theme_mod('bg_image_position') ? get_theme_mod('bg_image_position') : 'right';
   $fit_screen = ( $img_repeat == 'cover') ? 'cover' : 'inherit';
   $position_fixed = ( $bg_img_attachment == 'fixed' ) ? 'position:fixed!important' : 'absolute'; 

  $select_full_bg_type=get_post_meta($post_item_id,'select_full_bg_type',true) ? get_post_meta($post_item_id,'select_full_bg_type',true) :'single_bg_image';
  $fullscreen_bg_video=get_post_meta($post_item_id,'fullscreen_bg_video',true) ? get_post_meta($post_item_id,'fullscreen_bg_video',true) : '';
  $background_audio=get_post_meta($post_item_id,'background_audio',true) ? get_post_meta($post_item_id,'background_audio',true) : 'true';
 if( $select_full_bg_type == 'fullscreen_img_slider' ){
	 //$full_screen_bg_images=get_post_meta($post_item_id,'full_screen_bg_images',false);
 	if( is_search() ){ $full_screen_bg_images=get_post_meta($post_item_id,'full_screen_bg_images',false); } else{ $full_screen_bg_images = rwmb_meta( 'full_screen_bg_images', 'type=image&size=full' ); }
	 $full_screen_bg_auto_play=get_post_meta($post_item_id,'full_screen_auto_play',true) ? get_post_meta($post_item_id,'full_screen_auto_play',true) : '0';
	 $full_screen_bg_transition=get_post_meta($post_item_id,'full_screen_bg_transition',true) ? get_post_meta($post_item_id,'full_screen_bg_transition',true) : '6';
	// print_r($full_screen_bg_images);
	
	?>
	<script type="text/javascript">
			jQuery(function($){
				$.supersized({
					// Functionality
						slideshow               :   1,			// Slideshow on/off
						autoplay				:	<?php echo $full_screen_bg_auto_play;  ?>,			// Slideshow starts playing automatically
						start_slide             :   1,			// Start slide (0 is random)
						stop_loop				:	0,			// Pauses slideshow on last slide
						random					: 	0,			// Randomize slide order (Ignores start slide)
						slide_interval          :   3000,		// Length between transitions
						transition              :   <?php echo $full_screen_bg_transition;  ?>, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
						transition_speed		:	1000,		// Speed of transition
						new_window				:	1,			// Image links open in new window/tab
						pause_hover             :   0,			// Pause slideshow on hover
						keyboard_nav            :   1,			// Keyboard navigation on/off
						performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
						image_protect			:	1,			// Disables image dragging and right click with Javascript
																   
						// Size & Position						   
						min_width		        :   0,			// Min width allowed (in pixels)
						min_height		        :   0,			// Min height allowed (in pixels)
						vertical_center         :   1,			// Vertically center background
						horizontal_center       :   1,			// Horizontally center background
						fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
						fit_portrait         	:   1,			// Portrait images will not exceed browser height
						fit_landscape			:   0,			// Landscape images will not exceed browser width
																   
						// Components							
						slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
						thumb_links				:	1,			// Individual thumb links for each slide
						thumbnail_navigation    :   0,			// Thumbnail navigation
						slides 					:  	[		// Slideshow Images

					<?php $full_screen_bg_images = ( array ) $full_screen_bg_images;
						if(!empty( $full_screen_bg_images ) && !is_search() ){
								foreach ( $full_screen_bg_images as $full_screen_bg_image ) { 
									if( $full_screen_bg_image["caption"] ){ $caption = '<h4>'.$full_screen_bg_image
										["caption"].'</h4>'; }else{ $caption =''; 
								} ?>
									{ 
										image : '<?php echo $full_screen_bg_image["url"]; ?>',title:"<h2><?php echo $full_screen_bg_image['title']; ?></h2>" },		
								<?php //echo $src; 
								}

						}elseif($fullscreen_img['bg_img']){ ?>
							 {image : "<?php echo $fullscreen_img['bg_img']; ?>" }	
						<?php } else{ ?>
							 {image : '<?php echo get_template_directory_uri(); ?>/images/page_default_image.jpg' }	
						<?php } ?> 
							],
													
						// Theme Options			   
						progress_bar			:	1,			// Timer for each slide							
						mouse_scrub				:	0
						
					});
			    }); 
			    
			</script>
			<?php if(  count($full_screen_bg_images) > 1 ){ ?>
				<div id="controls">
					<ul id="slide-list"></ul>
				</div>
				<?php if( $disable_slide_title == '0'){ ?>
				<div id="slidecaption"> </div> 
				<?php } } ?>
		<?php } elseif( $select_full_bg_type == 'fullscreen_video_bg' ){ ?>	
			<!-- Video Bg -->
		<script type="text/javascript">
		jQuery( function($) {
		"use strict";
		$(function() {
			$(function(){
              $(".player").mb_YTPlayer();
			});
		});
		});		

	</script>
	
		<a id="video_bg_wrapper" class="player" data-property="{videoURL:'<?php echo trim($fullscreen_bg_video); ?>',containment:'body', showControls:true, autoPlay:true, loop:true, vol:50, mute:<?php echo trim($background_audio); ?>, startAt:10, opacity:1, addRaster:false, quality:'default'}"></a> <!--BsekcY04xvQ-->
		<?php } elseif( $select_full_bg_type == 'single_bg_image' ) {
			if ( !empty( $full_screen_single_bg_image ) ) {
			$src = wp_get_attachment_image_src( $full_screen_single_bg_image, '' );
			$src = $src[0];
			$background_repeat = ( $single_bg_img_repeat == 'cover' || $single_bg_img_repeat == 'no-repeat') ? 'no-repeat' : 'repeat';
			$background_size = ( $single_bg_img_repeat == 'cover' ) ? 'cover' : 'inherit';
			 echo '<div class="fullscreen_bg_single_img" style="background-image:url('.$src.'); background-repeat:'.$single_bg_img_repeat.'; background-size:'.$bg_img_fit_screen.'; background-position:'.$bg_img_position.'; background-attachment:'.$bg_img_attachment.'; '.$bg_img_position_fixed.'; ">&nbsp;</div>';

		}else{
			echo '<div class="page_custom_bg_img" style="background-image:url('.$bg_image.'); background-repeat:'.$img_repeat.'; background-size:'.$fit_screen.'; background-position:'.$img_position.'; background-attachment:'.$img_attachment.'; '.$position_fixed.'; ">&nbsp;</div>';
		}
		}else{
			echo '<div class="page_custom_bg_img" style="background-image:url('.$bg_image.'); background-repeat:'.$img_repeat.'; background-size:'.$fit_screen.'; background-position:'.$img_position.'; background-attachment:'.$img_attachment.'; '.$position_fixed.'; ">&nbsp;</div>';
		}
		?>
