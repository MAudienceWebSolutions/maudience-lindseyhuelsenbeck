<?php
/**
 * The template for displaying Tag Archive pages.
 */
get_header(); 
// Image width Depend Theme layoout
$img_width=kaya_image_width(get_the_id());
$blog_single_page_sidebar = get_theme_mod( 'blog_single_page_sidebar' ) ? get_theme_mod( 'blog_single_page_sidebar' ): 'two_third';
$blog_sidebar_position = ( $blog_single_page_sidebar == 'two_third' ) ? 'one_third_last'  : 'one_third';
$sidebar_border_class=( $blog_single_page_sidebar == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
	// Page Title
	?>
<!--Start Middle Section  -->
<div id="mid_container_wrapper">
	<div id="mid_container" class="container"> 
 		<section class="<?php echo $blog_single_page_sidebar; ?>" id="content_section">
			<?php
                /* Run the loop to output the blog page.
                * called loop-blog.php and that will be used instead.
                */
                get_template_part( 'loop');
            ?>
        </section>
		<!-- Start Sidebar Section -->
		<?php if($blog_single_page_sidebar !="full") { ?>
			<article class="<?php echo $blog_sidebar_position. ' ' . $sidebar_border_class; ?>" >
				<?php get_sidebar();?>
			</aside>
			<div class="clear"></div>
		<?php } ?>
       <!--End content Section -->
<?php get_footer(); // Footer Section ?>