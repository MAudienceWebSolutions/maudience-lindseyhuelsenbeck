<?php
global $img_width,$single_image,$slider_imageheight;
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
$options=get_option('kayapati');
?><!--Slider Initialization  -->
	<script type="text/javascript">
(function($) {
  "use strict";
	$(function() {
		$('.bxslider1').bxSlider({
			minSlides: 1,
			maxSlides: 1,
			slideWidth: 1100,
			adaptiveHeight: true,
			slideMargin: 0
		});
});
})(jQuery);

</script>	
<?php 
$meta = get_post_meta($post->ID, 'kaya_slider_slide', false );
	if ( have_posts() ) while ( have_posts() ) : the_post(); ?> <!-- While Loop Start Here  -->
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="single_img"> 
				<?php

				$video_height= get_option('video_height') ? get_option('video_height'):'350';	
				$video= get_post_meta($post->ID,'video',true);
				$Slider_Image=get_post_meta($post->ID,'Slider_Image', true);
				//if($Slider_Image=='1'){	
					if($video!='') // If Video
					{
						echo '<div class="bxsider_wraper">'; ?>
							<iframe src="<?php  echo stripslashes($video); ?>" width="<?php  echo ($img_width); ?>" height="<?php  echo ($video_height); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
					<?php
					}	
					else{ 
					global $wpdb, $post;
			   		if ( !is_array( $meta ) )
						$meta = ( array ) $meta;
						if ( !empty( $meta ) ) {
						$meta = implode( ',', $meta );
						$images = $wpdb->get_col( "
						SELECT ID FROM $wpdb->posts
						WHERE post_type = 'attachment'
						AND ID IN ( $meta )
						ORDER BY menu_order ASC
						" );
						if(count($images) > 1 ){
								echo '<ul class="bxslider1">';
								foreach ( $images as $att ) {
									// Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
									$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0];
								echo "<li>";?>
					<a  data-gal="prettyPhoto[gallery]" href='<?php echo "{$src}"; ?>'  title="">
					<?php $params = array('width' => '397', 'height' => '', 'crop' => false);?>
					<img src='<?php echo bfi_thumb( "{$src}", $params ); ?>' /> 
					</a>	</li>
							<?php	}
							echo '</ul>';
							}else{
								foreach ( $images as $att ) {
								$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0];
									echo "<img src='{$src}' />";
						
								}
							}
						} else{
					              $params = array('width' => '', 'height' => '', 'crop' => false);
              if( has_post_thumbnail() ) {
			  echo kaya_imageresize($post->ID,$params,' ');
			}
				}

					}
		?>
			</div>  
			<div class="clear"></div>
					 <!-- #post-## -->    
			<div class="content_box">
				<?php if($sidebar_layout=="full") { 
				the_content();
				} ?>				
				<div class="clear"></div>
				<?php
				edit_post_link( __( 'Edit', 'haircare' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>
		<!-- End Ps -->
		<?php  // Comment Section
		$commentsection = get_post_meta( get_the_ID(), 'commentsection', true );	
		if( $commentsection == "on") {
			comments_template( '', true );
		} ?>
	<?php endwhile; // end of the loop. ?>
