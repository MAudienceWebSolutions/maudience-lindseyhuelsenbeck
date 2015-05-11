<?php
$kaya_options = get_option('kayapati');
$kaya_readmore_blog=$kaya_options['kaya_readmore_blog'] ? $kaya_options['kaya_readmore_blog'] : 'View More';
?>
<script type="text/javascript">
(function($) {
  "use strict";
	$(function() {	
		$('.bxslider1').bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
			  slideWidth: 580,
			  adaptiveHeight: true,
			  slideMargin: 0
			});
});
})(jQuery);
</script>	

	<?php echo '<div class="blog_single_img ">'; 
$meta = get_post_meta($post->ID, 'post_gallery', false );
					global $wpdb, $post;
				//print_r($meta);
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
									$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0];
								echo "<li>" ?>
						<?php $params = array('width' => '580', 'height' => '450', 'crop' => true);?>
					<img src='<?php echo bfi_thumb( "{$src}", $params ); ?>' />
							<?php echo '</li>';
							}
						echo '</ul>';
						} 
					}						
				 echo '</div>'; ?>
<?php
$icon_name='fa fa-picture-o';
echo kaya_post_content( $kaya_readmore_blog, $icon_name ); ?>
