<?php
get_header(); 
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
switch( $sidebar_layout ){
	case 'leftsidebar':
		$sidebar_class="two_third_last";
		break;
	case 'rightsidebar':
		$sidebar_class="two_third";
		break;	
	case 'full':
		$sidebar_class="fullwidth";
		break;		
}
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last'; ?>
<!--Start Middle Section  -->
	<div id="mid_container_wrapper">
	<div id="mid_container" class="container"> 
		<section class="<?php echo $sidebar_class; ?>" id="content_section">
			<?php get_template_part('loop','page'); ?>
		</section>
		<!--StartSidebar Section -->
		<?php if($sidebar_layout !="full") { ?>
			<article class="<?php echo $aside_class;?>">
				<?php //get_sidebar();
				the_content();
				?>
			</article>
			<div class="clear"></div>
		<?php } ?>
		<div class="clear"></div>
		<!--End content Section -->
	<?php get_footer(); ?>