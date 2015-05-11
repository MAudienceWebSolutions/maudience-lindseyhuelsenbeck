<?php
/*
Template Name: Full Width Page
*/
get_header();  ?>
<div id="mid_container_wrapper">
		<div id="mid_container" class="container">
			<section class="fullwidth" id="content_section">
				<?php
				if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				<!-- #post-## -->
				<?php endwhile; ?>
			</section>
	<?php   get_footer(); ?>