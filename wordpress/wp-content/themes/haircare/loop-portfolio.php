<?php
$img_width=kaya_image_width(get_the_id());	
$list_images= get_post_meta($post->ID,'list_images',true);
$project_client_name= get_post_meta($post->ID,'project_client_name',true);
$project_link= get_post_meta($post->ID,'client_project_link',true);
$isotop_gal=( ($list_images=='isotope_gallery') || ($list_images=='grid_gallery') ) ? 'isotope-container' : '';
?>
	<?php if($list_images=='slider'){  ?>
<script type="text/javascript">
(function($) {
  "use strict";
$(window).load(function() {
		$('.bxslider_post_single').bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
			  adaptiveHeight: true,
			  slideMargin: 0,
			   onSliderLoad: function(){
					$(".bxslider_post_single").css("visibility", "visible");
		 }
			});
      });        
})(jQuery);
</script>
<?php $slider_class="bxslider_post_single";
} else{
	$slider_class='';
 } ?>
	<?php 
// loop Start here 
	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			global $post;
			observePostViews($post->ID);
			fetchPostViews(get_the_ID());
			$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
			$video_embed_code= get_post_meta($post->ID,'video_embed_code',true);
			$Featuredimage=get_post_meta(get_the_ID(),'Featuredimage' ,true);
			$images = rwmb_meta( 'portfolio_slide', 'type=image&size=full' );
			$title=get_the_title($post->ID);
			foreach($images as $val)
			{
			}
			$postid=$post->ID;
			echo '<div class="single_img '.$list_images.'">';
			 if( isset( $val )!='' ){ 
					global $wpdb, $post;
					if ( !is_array( $images ) )
						$images = ( array ) $images;
						if ( !empty( $images ) ) {
						if(count($images) > 1 ){
								echo '<ul class="'.$slider_class.' '.$isotop_gal.' clearfix '.$list_images.'">';
							foreach ( $images as $image ){
								echo "<li class='isotope-item all  '>"; 
					 echo "<a href='{$image['url']}' title='{$image['title']}' data-gal='prettyPhoto[gallery]' >"; ?>
					<?php if($list_images=="isotope_gallery"){ ?>
					<?php $params = array('width' => '480', 'height' => '', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."'  alt='{$image['title']}' />"; ?> 
					<?php } elseif($list_images=="grid_gallery"){ ?>
					<?php $params = array('width' => '480', 'height' => '500', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."'  alt='{$image['title']}' />"; ?> 
					<?php }else { ?>
					<?php $params = array('width' => '', 'height' => '', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."' alt='{$image['title']}' />"; ?> <?php }?>	</a>	</li>
							<?php	}
							echo '</ul>';
							}else{
								foreach ( $images as $image ) {
									$params = array('width' => '', 'height' => '', 'crop' => false);
									echo "<img src='".bfi_thumb( "{$image['url']}", $params )."' alt='{$image['title']}' />"; 
								}
							}
					} 
			} else {   }
		echo '</div>'; 
				if( $video_embed_code && $images ){
			echo '<br>';
		}
		if($video_embed_code!='')
		{		
			echo $video_embed_code;
		}
		echo '<div class="clear"></div>'; 
				if($sidebar_layout == "full") { 
				if(!empty($post->post_content) ) {	?>
					<div class="fullwidth portfolio_fullwidth portfolio_aside">
						<?php echo the_content(); ?>
					</div>
				<?php } ?>
				<?php }
			else{ }   
		wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'haircare' ), 'after' => '</div>' ) ); 
		edit_post_link( __( 'Edit', 'haircare' ), '<span class="edit-link">', '</span>' ); ?>
		<!-- End Ps -->
	</div>
		<?php endwhile; // end of the loop.  ?>