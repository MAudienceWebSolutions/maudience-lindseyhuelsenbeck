<?php
/**
 * The template for displaying Author Archive pages.
 */
get_header(); 
$blog_single_page_sidebar = get_theme_mod( 'blog_single_page_sidebar' ) ? get_theme_mod( 'blog_single_page_sidebar' ): 'two_third';
$blog_sidebar_position = ( $blog_single_page_sidebar == 'two_third' ) ? 'one_third_last'  : 'one_third';
$sidebar_border_class=( $blog_single_page_sidebar == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
	?>
<!--Start Middle Section  -->
	<div id="mid_container_wrapper">
		<div id="mid_container" class="container">
			<section class="<?php echo $blog_single_page_sidebar; ?>" id="content_section">
				<?php get_template_part( 'loop'); //called loop-blog.php ?>
			</section>
        <?php // Sidebar Section
		if( $blog_single_page_sidebar != 'fullwidth' ) :	?>
			<article class="<?php echo $blog_sidebar_position. ' ' . $sidebar_border_class; ?>" >
				<?php get_sidebar();?>
			</article>
			<?php endif; ?>
			<div class="clear"></div>
	<?php get_footer(); ?>