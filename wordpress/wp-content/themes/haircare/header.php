<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php 
 $responsive_mode = get_theme_mod( 'responsive_layout_mode' ) ? get_theme_mod( 'responsive_layout_mode' ) : 'on';
if($responsive_mode == "on"){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0" />
<?php } ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php
 wp_head(); ?>
 </head>
<body <?php body_class(); ?> >
	<?php
	  global $post_item_id, $post;
		echo  kaya_post_item_id();	
	 if( get_post_meta($post_item_id,'disable_img_opacity',true) != '1' ): ?>
	<div class="overlay_pattern"></div>
<?php endif; 
	 if( get_theme_mod('bg_image_pattern_disable') != 'on' ): ?>
	<div class="imgoverlay_pattern"></div>
<?php endif; ?>
	<?php
	 $full_screen_bg_images=get_post_meta($post_item_id,'full_screen_bg_images',false);
		get_template_part('slider/fullscreen-bg-slider'); 
	?>
	<?php //kaya_custom_bg_img(); 
 $layout_mode = get_theme_mod('theme_layout_mode') ?  get_theme_mod('theme_layout_mode') : 'fluid_container'; ?>
	<div id="<?php echo $layout_mode; ?>"><!-- Main Layout Section Start -->

		<!--Start header  section -->
	<header class="header_wrapper">
		<div class="container">
			<div class="header_left_section ">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"  title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php kaya_logo_image(); ?> </a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-src="<?php echo  get_template_directory_uri() ?>/images/logo@2x.png" data-media="(min-device-pixel-ratio: 1.5)" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> </a>		
			</div>
			<div class="mobile_nav_icon">
					<i class="fa fa-bars"> </i>
			</div>
			<div class="header_right_section ">
				<nav>
					<?php 
					if (has_nav_menu('primary')) {
					wp_nav_menu(array('echo' => true, 'container_id' => 'myslidemenu','menu_id'=> 'jqueryslidemenu', 'container_class' => 'menu','theme_location' => 'primary', 'menu_class'=> 'menu'));
					}else{
					wp_nav_menu(array('echo' => true, 'container_id' => 'myslidemenu','menu_id'=> 'jqueryslidemenu', 'container_class' => 'menu','theme_location' => 'primary', 'menu_class'=> 'menu'));
					}
					?>
				</nav>
			</div>
		</div>	
	</header>
	<?php echo kaya_slider_page_title_data(); ?>	