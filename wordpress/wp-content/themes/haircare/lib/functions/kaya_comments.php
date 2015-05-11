<?php

if ( ! function_exists( 'kaya_comment' ) ) :
function kaya_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<span class="parent">	
	<div class="avatar_img alignleft">
	  <?php echo get_avatar( $comment, 46 ); ?>
	 
		</div>
		<div id="comment-<?php comment_ID(); ?>" class="description">
            <div class="comment-author vcard">
              
                <?php printf( __( '%s <span class="says"></span>', 'haircare' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            </div><div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'haircare' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'haircare' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata --><!-- .comment-author .vcard -->

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'haircare' ); ?>
			<br />
		<?php endif; ?>

		

		<div class="comment-body"><?php comment_text(); ?></div>

		 <div class="reply">
			<?php //comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&rarr;</span>', 'haircare' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->
		</span>	

	<?php

		break;

		case 'pingback'  :

		case 'trackback' :

	?>
	<li class="post pingback">

		<p><?php _e( 'Pingback:', 'haircare' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'haircare'), ' ' ); ?></p>

	<?php 

			break;

	endswitch;

}

endif;



if ( ! function_exists( 'kaya_posted_on' ) ) :


function kaya_posted_on() { ?>
	<div class="postmeta">
	<div class="postmetadata">
	<span class="postmetadate"><?php echo get_the_date();?></span>
	<span class="postemetain"><?php _e('Posted In','haircare'); ?>: <?php the_category(', ') ?> </span>
	<span class="postmetawriter"><?php  _e( 'By ' ,'haircare'); the_author_posts_link(); ?>  </span>
	<span class="comments"> <?php comments_popup_link( __( 'Leave a comment', 'haircare' ), __( '1 Comment', 'haircare' ), __( '% Comments', 'haircare' ) ); ?> </span>
	<span class="editlink"><?php edit_post_link( __( 'Edit', 'haircare' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' );?></span>
	</div>
	</div>
<?php
}
endif;
if ( ! function_exists( 'kaya_comment' ) ) :

function kaya_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case '' :

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<div id="comment-<?php comment_ID(); ?>">

		<div class="comment-author vcard">

			<?php echo get_avatar( $comment, 46 ); ?>

			<?php printf( __( '%s <span class="says">says:</span>', 'haircare' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>

		</div><!-- .comment-author .vcard -->

		<?php if ( $comment->comment_approved == '0' ) : ?>

			<?php _e( 'Your comment is awaiting moderation.', 'haircare' ); ?>

			<br />

		<?php endif; ?>



		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">

			<?php

				/* translators: 1: date, 2: time */

				printf( __( '%1$s at %2$s', 'haircare' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'haircare' ), ' ' );

			?>

		</div><!-- .comment-meta .commentmetadata -->



		<div class="comment-body"><?php comment_text(); ?></div>



		<div class="reply">

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		</div><!-- .reply -->

	</div><!-- #comment-##  -->



	<?php

		break;

		case 'pingback'  :

		case 'trackback' :

	?>

	<li class="post pingback">

		<p><?php _e( 'Pingback:', 'haircare' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'haircare'), ' ' ); ?></p>

		<?php 

	break;

	endswitch;

}

endif;

if ( ! function_exists( 'kaya_posted_in' ) ) :

function kaya_posted_in() {

	// Retrieves tag list of current post, separated by commas.

	$tag_list = get_the_tag_list( '', ', ' );

	if ( $tag_list ) {

		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'haircare' );

	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'haircare' );

	} else {

		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'haircare' );

	}

	// Prints the string, replacing the placeholders.

	printf(

		$posted_in,

		get_the_category_list( ', ' ),

		$tag_list,

		get_permalink(),

		the_title_attribute( 'echo=0' )

	);

}
endif;?>