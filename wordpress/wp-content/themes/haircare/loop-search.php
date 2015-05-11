<?php  
// global variables
$kaya_options=get_option('kayapati');
global $more;
$more=0;
$kaya_readmore_blog=$kaya_options['kaya_readmore_blog'] ? $kaya_options['kaya_readmore_blog'] : 'Read More' ;
$featured_image_class='blog_exerpt_without_image';

 while ( have_posts() ) : the_post(); // Start While Loop here ?> 
<div class="search_post">
  
   		<h4 class="blog_post_title"> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'haircare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a> </h4>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <?php echo the_excerpt(); ?>
           
			<?php echo '<a href="'.get_permalink().'" class="readmore readmore-1 readmore-1a">Readmore</a>'; ?>
         
       		</div>

</div>
<?php endwhile; // End the loop. Whew. ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php echo kaya_pagination();
?>