<?php
/**
 * The template for displaying Search Results pages.
 *
 */
get_header(); ?>
<!-- Start Middle Section -->
	<div id="mid_container_wrapper">	
		<div id="mid_container" class="container"> 
			<?php if ( have_posts() ) : ?>
				<?php
				/* Run the loop to output the blog page.
				* called loop-blog.php and that will be used instead.
				*/
				get_template_part( 'loop', 'search'); ?>
			<?php else : ?>
				<h1><?php _e( 'Nothing Found', 'hk' ); ?></h1>
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'hk' ); ?></p>
			<?php endif; ?>
    <!--Start Footer Section -->
<?php get_footer(); ?>