<?php
function kaya_relatedpost($postid)
{	
$options=get_option('kayapati');
global $post;
$tags = wp_get_post_tags($postid);

if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
$args=array(
'tag__in' => $tag_ids,
'post_type' => 'portfolio',
'post__not_in' => array($postid),
'showposts'=>-1,  // Number of related posts that will be shown.
'ignore_sticky_posts'=>1
);  
$pf_related_post_scroll=get_theme_mod('pf_related_post_scroll') ? get_theme_mod('pf_related_post_scroll'):'true';
?>
<script type="text/javascript">
(function( $ ) {
       "use strict";
       $(function() {
	 $("#related_slider").owlCarousel({
                navigation : false,
                autoPlay : <?php echo $pf_related_post_scroll; ?>,
                stopOnHover : true,
                items :5,
              });

	       });
    })(jQuery);
</script>
<?php
$my_query = new wp_query($args);
$kaya_related_projects_text=get_theme_mod('pf_related_post_title') ? get_theme_mod('pf_related_post_title'):'Related Projects';
$pf_related_images_height=get_theme_mod('pf_related_images_height') ? get_theme_mod('pf_related_images_height'):'500';
if( $my_query->have_posts() ) {
 		echo '<div id="relatedposts">';
		echo '<div class="relatedpost_title">';
	echo '<h2>'.$kaya_related_projects_text.'</h2>';
		echo '</div>';
			echo '<div id="list" class="da-thumbs portfolio_extra"><div id="related_slider" class="">';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			$pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
            if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
            $permalink = get_permalink();
            $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
            $pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
				$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
				//if ( has_post_thumbnail() ) { 
				$terms = get_the_terms(get_the_ID(), 'portfolio_category');
				$terms_name = array();
				if($terms ){
				foreach ($terms as $term) {
					$terms_name[] = $term ->name;
				}
			}else{
				$terms_name[] = 'Uncategorized';
			}  ?>
			<article class="owl_slider_img">
            <?php  $params = array('width' => '500' , 'height' =>$pf_related_images_height, 'crop' => true);
				 echo kaya_imageresize($post->ID,$params,'');  
				       $pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
            if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
            $permalink = get_permalink();
            $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
            $pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
            $video_url = get_post_meta($post->ID,'video_url',true);
              $lightbox = $video_url ? $video_url : $imgurl;
              $link_icon = ( $video_url ) ? 'link_to_video' :'link_to_image';
               ?>
					<?php //if( get_theme_mod('pf_enable_title') != 'on' ):  ?>
						<div class="portfolio_overlay" ><a href="<?php the_permalink(); ?>">
	            			<?php  echo '<h4>'.get_the_title().'</h4>';
                  			echo '<p>'.implode(' , ', $terms_name).'</p>'; ?>
                  		</a>
	               		</div>
            		<?php //endif; ?>
            	</article>
                <!-- </li> -->
			<?php 	//}
			}
		echo '</div>';
	echo '</div>';echo '</div>';
}
}
$backup='';
$post = $backup;
wp_reset_query();
}
?>