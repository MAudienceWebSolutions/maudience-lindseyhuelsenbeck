<?php
get_header();
$portfolio_page_options = $pf_page_sidebar = get_theme_mod('pf_page_sidebar') ? get_theme_mod('pf_page_sidebar') : 'fullwidth';
$sidebar_class=( $portfolio_page_options == 'two_third' ) ? 'one_third_last' : 'one_third';
$sidebar_border_class=( $portfolio_page_options == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
$pf_img_height =  get_theme_mod('pf_images_height') ? get_theme_mod('pf_images_height') :'600';
$pf_thumbnail_columns =  get_theme_mod('pf_thumbnail_columns') ? get_theme_mod('pf_thumbnail_columns') :'4';
switch ($pf_thumbnail_columns) {
	case '4':
		$width='500';
		break;
	case '3':
		$width='650';
		break;
	case '2':
		$width='980';
		break;
	case '1':
		$width='1920';
		break;	
	default:
		# code...
		break;
}
$height=($portfolio_page_options== "fullwidth" ) ?  '350' : '400';
?>
	<div id="mid_container_wrapper">
		<div id="mid_container" class="container"> 
			<section class="<?php echo $portfolio_page_options; ?>" id="content_section">
			 <?php	echo '<div class="Portfolio_gallery pf_taxonomy_gallery">';		
				echo '<ul id="list" class="da-thumbs isotope-container portfolio'.$pf_thumbnail_columns.' porfolio_items portfolio_extra clearfix">';
					while (have_posts()) : the_post(); // loop start here
						$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
						$pf_lightbox =  $imgurl ? $imgurl : get_template_directory_uri().'/images/defult_featured_img.png';
						$video_url= get_post_meta($post->ID,'video_url',true);
				        $lightbox_type = $video_url ? trim($video_url) : $pf_lightbox;
				       
				        $class = $video_url ? 'link_to_video' : 'link_to_image';
						$terms = get_the_terms(get_the_ID(), 'portfolio_category');
						$pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
						if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
						$permalink = get_permalink();
						$Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
						$pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
						$terms = get_the_terms(get_the_ID(), 'portfolio_category');
				$terms_slug = array();
				$terms_name = array();
				if($terms ){
				foreach ($terms as $term) {
					$terms_slug[] = $term->slug;
					$terms_name[] = $term->name;
				}
			}else{
				$terms_name[] = 'Uncategorized';
			}

			echo '<li class="isotope-item all">';   ?>
				<?php  $params = array('width' => $width , 'height' => $pf_img_height, 'crop' => true);
				echo kaya_imageresize($post->ID,$params,'');   ?>
				<?php if( get_theme_mod('pf_enable_title') != 'on' ):
				echo '<div class="portfolio_overlay">';
				if( get_theme_mod('pf_enable_lightbox') == 'on' ){ ?>
					<a href="<?php echo $lightbox_type; ?>" data-gal="prettyPhoto[gallery4]">
				<?php }else{ ?>
					<a href="<?php echo the_permalink(); ?>">
				<?php } ?>
				<h4><?php echo the_title(); ?></h4>
					<?php echo implode(',', $terms_name); ?>
				</a>
				</div>
				<?php endif; ?>
				
            </li>
				<?php	endwhile; // end here
				echo '</ul>';
			echo '</div></section>'; ?>
		
		<?php
		wp_reset_query(); 
		if( $portfolio_page_options != 'fullwidth' ) :	?>
			<aside class="<?php echo $sidebar_class.' '.$sidebar_border_class; ?>" >
				<?php get_sidebar();?>
			</aside>
			<?php endif; ?>
		<?php echo kaya_pagination(); // Pagination ?>
	<?php get_footer(); ?>