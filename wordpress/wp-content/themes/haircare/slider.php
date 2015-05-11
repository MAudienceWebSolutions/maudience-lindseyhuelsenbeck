<?php 
global $post;
 $full_screen_bg_images=get_post_meta($post->ID,'full_screen_bg_images',false);
 $full_screen_bg_auto_play=get_post_meta($post->ID,'full_screen_auto_play',true) ? get_post_meta($post->ID,'full_screen_auto_play',true) : '0';
 $full_screen_bg_transition=get_post_meta($post->ID,'full_screen_bg_transition',true) ? get_post_meta($post->ID,'full_screen_bg_transition',true) : '6';
// print_r($full_screen_bg_images);
 $fullscreen_img = get_option('fullscreen');
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

				<?php	$full_screen_bg_images = ( array ) $full_screen_bg_images;
						if(!empty( $full_screen_bg_images ) ){
							$full_screen_bg_images = implode(',', $full_screen_bg_images);
							$images = $wpdb->get_col( "
												SELECT ID FROM $wpdb->posts
												WHERE post_type = 'attachment'
												AND ID IN ( $full_screen_bg_images )
												ORDER BY menu_order DESC
								" );

							foreach( $images as $image){
								$src = wp_get_attachment_image_src($image,'');
								$src = $src[0]; ?>
								{image : '<?php echo $src; ?>' },		
							<?php //echo $src; 
							}

					}elseif($fullscreen_img['bg_img']){ ?>
						 {image : "<?php echo $fullscreen_img['bg_img']; ?>" }	
					<?php } else{ ?>
						 {image : '<?php echo get_template_directory_uri(); ?>/images/default_slide_img.jpg' }	
					<?php } ?> 
						
						
												],
												
					// Theme Options			   
					progress_bar			:	1,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    }); 
		    
		</script>