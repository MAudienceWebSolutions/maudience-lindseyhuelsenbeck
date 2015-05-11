<?php
// global variables
global $more;
$more='0';
$kaya_options = get_option('kayapati');
$kaya_readmore_blog=get_theme_mod('kaya_readmore_blog') ? get_theme_mod('kaya_readmore_blog') : 'Read More';
 while ( have_posts() ) : the_post();
 ?>
  <!-- Start While Loop here -->
  <article <?php post_class('standard-blog'); ?> >
    <div class="blog_post_wrapper">
  
  <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
      echo '<div class="blog_img  ">';
        echo '<a href="'.get_permalink().'">';
        if( (get_post_meta( $post->ID, 'kaya_image_streatch', true )) == "0") {
         $params = array('width' => '1100', 'height' => '450', 'crop' => true);
        }else{
           $params = array('width' => '', 'height' => '', 'crop' => true);
        }
          $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
          echo kaya_imageresize($img_url,$params,'');
        echo '</a>'; ?>
        </div>
      <?php }   ?>
       <div class="blog_post_info"> 
      <div class="one_third">
      <span class="meta_desc">
        <span class="author"><i class="fa fa-user">&nbsp;</i><?php the_author_posts_link(); ?></span>
        <span class="category"><i class="fa fa-folder">&nbsp;</i><?php the_category(', '); ?></span>
        <span class="post_date"><i class="fa fa-clock-o">&nbsp;</i><?php echo get_the_date('M d, Y'); ?></span>
        <span class="comment"><i class="fa fa-comments">&nbsp;</i><?php comments_popup_link(__('0 Comments','lavan' ), __( '1 Comment', 'lavan' ), __( '% Comments', 'lavan' ) ); ?></span>
        <?php echo '</span>'; ?>
      </div>
        <div class="two_third_last">
            <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'lavan' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
           <?php the_title(); ?> </a>  </h3>
           <?php  echo the_content($kaya_readmore_blog); ?>
           <!--<a href="<?php echo the_permalink(); ?>" class="readmore">Readmore</a>-->
         </div>
   </div>
   
   <div class="clear"> </div>
   <!--<a class="readmore readmore-1" href="<?php the_permalink(); ?>"><?php echo $kaya_readmore_blog; ?></a>
     #post-## -->
   </div>
  </article>
  <?php  // Comment Section
  $commentsection = get_post_meta( $post->ID, 'commentsection', true );
  if( $commentsection != "on") {
    comments_template( '', true );
  } ?>
  <?php endwhile; // End the loop. While. ?>
  <?php /* Display navigation to next/previous pages when applicable */ ?>
  <?php echo kaya_pagination(); ?>
