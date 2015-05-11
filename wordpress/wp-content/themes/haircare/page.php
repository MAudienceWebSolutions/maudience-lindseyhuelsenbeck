<?php get_header(); ?>
	<!--   Start Middle Section  -->  
	<div id="mid_container_wrapper">
		<div id="mid_container" class="container"> 
			<section class="two_third" id="content_section">
				<?php // Page Content
				if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</section>
				<aside class="one_third_last right_sidebar"> <!--Start Sidebar Section -->
					<?php get_sidebar(); ?>	
				</aside> <!--End Sidebar Section -->
	<?php get_footer(); ?>