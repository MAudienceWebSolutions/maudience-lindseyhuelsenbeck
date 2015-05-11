<?php
add_theme_support('automatic-feed-links');
global $post;
 /* Resize Images Width Fullwisth/Sidebar 
 ----------------------------------------- */
 
function kaya_image_width( $postid ){
	$sidebar_layout = get_post_meta($postid,'kaya_pagesidebar',true); 
	$kaya_width = ($sidebar_layout == "full" ) ? '1250' : '719';
	return $kaya_width;
 }
 
/* Image Resize
 ----------------------------------------- */
  /*
* @param	string $url - (required) must be uploaded using wp media uploader
* @param	int $width - (required)
* @param	int $height - (optional)
* @param	bool $crop - (optional) default to soft crop
* @param	bool $single - (optional) returns an array if false ?>

*/

function kaya_imageresize($postid,$params,$class){
	global $post;
	$title=get_the_title($post->Id);
	$img_url=wp_get_attachment_url( get_post_thumbnail_id() );
	if( $img_url ) {
		$out='<img class="'.$class.'" src="'.bfi_thumb( $img_url, $params ).'" alt="'.$title.'" />';
	}else{
		$imgurl = get_template_directory_uri().'/images/defult_featured_img.png';
		$out='<img class="'.$class.'" src="'.bfi_thumb( $imgurl, $params ).'" alt="'.$title.'" />';
	}
	return $out;
}
	 
 /* Upload Image Resize
 ----------------------------------------- */
 /*
* @param	string $url - (required) must be uploaded using wp media uploader
* @param	int $width - (required)
* @param	int $height - (optional)
* @param	bool $crop - (optional) default to soft crop
* @param	bool $single - (optional) returns an array if false ?>

*/
 
function kaya_defaulturlresize( $theImageSrc,$params,$class )
{ 
	global $post;
	$title=get_the_title($post->Id);
	$out='';
	if( $theImageSrc ) {
		$out.='<img class="'.$class.'" src="'.bfi_thumb($theImageSrc, $params ).'" alt="'.$title.'" />';
	}else{
		$imgurl = get_template_directory_uri().'/images/defult_featured_img.png';
		$out='<img class="'.$class.'" src="'.bfi_thumb( $imgurl, $params ).'" alt="'.$title.'" />';
	}
	return $out;	
}
// Site Title and Desc
function kaya_wp_title( $title ) {
	global $page, $paged;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";
	return $title;
}
add_filter( 'wp_title', 'kaya_wp_title', 10, 1 ); // End
// Logo Display Function
if(!function_exists('kaya_logo_image')): // Logo
function kaya_logo_image() {
	echo '<div id="logo-section">';
	 $kaya_default_logo = esc_attr( get_template_directory_uri().'/images/logo.png' );
     $logo = get_option('logo');
     $logo = $logo['upload_logo'] ? $logo['upload_logo']  : esc_attr( $kaya_default_logo );
     //print_r( $logo );
     $kaya_logo_type = get_theme_mod('kaya_logo_type') ? get_theme_mod('kaya_logo_type') : 'img_logo';
     $kaya_text_logo = get_theme_mod('text_logo') ? get_theme_mod('text_logo') : 'Hair Care';
     $logo_desc = get_theme_mod('logo_desc') ? get_theme_mod('logo_desc') : '';
     $logo_desc_text_color = get_theme_mod('logo_desc_text_color') ? get_theme_mod('logo_desc_text_color') : '#eee';
     if( $kaya_logo_type == 'text_logo'){
     		$kaya_logo = '<h1 class="logo text_logo" >'.trim($kaya_text_logo).'</h1>';
     		$kaya_logo .= '<h5 style="color:'.$logo_desc_text_color.'">'.$logo_desc.'</h5>';
     }
	
	elseif( $kaya_logo_type == 'img_logo'){
		if( $logo ) {
		 	$kaya_logo_src = esc_attr( $logo ) ? esc_attr( $logo ) : esc_attr( $kaya_default_logo );
		}else{
			$kaya_logo_src = esc_attr( get_template_directory_uri().'/images/logo.png' );
		}
		$kaya_logo_img = 'class="logo" src="'.esc_attr($kaya_logo_src).'" alt=""';
		$kaya_logo = apply_filters('kaya_image_logo', '<img '.$kaya_logo_img .' />');
	}else{
		$kaya_logo = '<h1 class="site-title logo">'.get_bloginfo( 'name' ).'</h1>';
		$kaya_logo = apply_filters('kaya_logo_text', $kaya_logo);
	}
		echo apply_filters('kaya_logo_html', $kaya_logo);
		//echo '</h1>';
		echo '</div>';
}	
endif; // End Logo
// Slider Include
	get_template_part('slider/kaya','slider');
// page title
//-----------------------------------------

function kaya_custom_pagetitle( $post_id )
{

	echo '<section class="sub_header_wrapper" >';
		echo '<div class="sub_header container">';
			//echo '<div class="two_third">';
		if(is_page()){
				if($kaya_custom_title=get_post_meta($post_id,'kaya_custom_title',true)) {		
					echo '<h2> '.$kaya_custom_title.'</h2>';			
				}
				else{
					echo '<h2>'.get_the_title($post_id).'</h2>';
				}
				if($kaya_custom_title_description=get_post_meta($post_id,'kaya_custom_title_description',true)) {		
					echo '<P>'.$kaya_custom_title_description.'</P>';
				} 
		}elseif( is_single()){ ?>
			<h2><?php  echo the_title(); // Page Title ?></h2>
				<div id="singlepage_nav" > <!-- Navigation Buttons -->
					<div class="nav_next_item">
						<?php next_post_link( '%link', '<span class="meta-nav-prev">&nbsp;</span>' ); ?>
					</div>
					<div class="nav_prev_item">
						<?php previous_post_link( '%link', '<span class="meta-nav-next"> &nbsp;</span>' ); ?>
					</div>
				</div>
	<?php	} elseif(is_tag()){ ?>
		<h2>
			<?php printf( __( 'Tag Archives: %s', 'haircare' ), single_cat_title( '', false ) ); ?>
		</h2>
	<?php }
	elseif ( is_author() ) {
		the_post();
		echo '<h2>'.sprintf( __( 'Author Archives: %s', 'haircare' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ).'</h2>';
		rewind_posts();

	} elseif (is_category()) { ?>
		<h2>
			<?php printf( __( 'Category Archives: %s', 'haircare' ), single_cat_title( '', false ) ); ?>
		</h2>
	<?php }  elseif( is_tax() ){
	global $post;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		 echo '<h2>' .$term->name.'<h2>'; 

	}elseif (is_search()) { ?>
			<h2><?php printf( __( 'Search Results for: %s', 'haircare' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
	<?php }elseif (is_404()) { ?>
			<h2> <?php _e( 'Error 404 - Not Found', 'haircare' ); ?> </h2>
		<?php }
		elseif ( is_day() ){ ?>
		<h2>
			<?php  printf( __( 'Daily Archives: %s', 'haircare' ), '<span>' . get_the_date() . '</span>' ); ?>
		</h2>
		<?php }			 
		 elseif ( is_month() ) { ?>
		 <h2>
		<?php 	printf( __( 'Monthly Archives: %s', 'haircare' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
		</h2>
		<?php } elseif ( is_year() ){ ?>
			<h2>	<?php printf( __( 'Yearly Archives: %s', 'haircare' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?> </h2>
		<?php }elseif ( class_exists('woocommerce') ){

			if( is_shop() ) { 
				if($kaya_custom_title=get_post_meta(woocommerce_get_page_id('shop'),'kaya_custom_title',true)) {		
					echo '<h2> '.$kaya_custom_title.'</h2>';			
				} 
				else{ ?>
						<h2><?php _e('Shop','haircare'); ?></h2>
				<?php }
				if($kaya_custom_title_description=get_post_meta(woocommerce_get_page_id('shop'),'kaya_custom_title_description',true)) {		
					echo '<P>'.$kaya_custom_title_description.'</P>';
				} }
		?>
		<?php }else { ?>
		<h2>	<?php _e( 'Blog Archives', 'haircare' ); ?> </h2> 
		<?php }
				
		echo'</div>';
	echo'</section>';
}

?>
<?php
//portfolio related post
//-------------------------------------------
	get_template_part('lib/includes/relatedpost');

// Post Views Count
function observePostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

function fetchPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count.' ';
}	


	
// footer columns
//-------------------------------------------
function kaya_footercolumn( $column )
{
	// column wise  footer widget
	if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('footer_column_'.$column.'') ) : ?>
		<div class="widget_container">
        	<h3> <?php _e( 'Overlay Container Column ', 'kaya_admin' ); echo $column; ?> </h3>
            <p>
                <?php _e( 'Wesce sit amet porttitor leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque interdum, nulla sit amet varius dignissim Vestibulum pretium risus', 'haircare' ); ?>
            </p>	
	 	</div>
	<?php endif; 
}

// Shop Page Title Post ID
function kaya_post_item_id(){
	 global $post_item_id, $post;
	if( class_exists('woocommerce')){	
		if( is_shop() ){
			$post_item_id = woocommerce_get_page_id( 'shop' );
		}
		else{
			if( get_post()){ $post_item_id = $post->ID;}
		}
	}
	elseif(get_post()){
		$post_item_id = $post->ID;
	}else{

	}
}

?>