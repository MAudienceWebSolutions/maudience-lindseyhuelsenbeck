<?php
/* These are functions specific to the included option settings and this theme */
/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

/* Add Body Classes for Layout

/*-----------------------------------------------------------------------------------*/
// This used to be done through an additional stylesheet call, but it seemed like
// a lot of extra files for something so simple. Adds a body class to indicate sidebar position.
/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/
function kaya_favicon() {
  $favicon = get_option('favicon'); 
  	if ($favicon['favi_img']) {
		echo '<link rel="shortcut icon" href="'.  $favicon['favi_img']  .'"/>'."\n";
	}
}
add_action('wp_head', 'kaya_favicon');
/*-----------------------------------------------------------------------------------*/
/* Custom CSS
/*-----------------------------------------------------------------------------------*/
function kaya_custom_css() {
$kaya_custom_css = get_theme_mod('kaya_custom_css') ? get_theme_mod('kaya_custom_css') : '';
if($kaya_custom_css)
{
	echo '<style>';
	echo $kaya_custom_css;
	echo '</style>';
}
}
add_action('wp_head', 'kaya_custom_css');
/*-----------------------------------------------------------------------------------*/
/* Custom JS
/*-----------------------------------------------------------------------------------*/
function kaya_theme_custom_js() {
$kaya_custom_js = get_theme_mod('kaya_custom_jquery') ? get_theme_mod('kaya_custom_jquery') : '';
if($kaya_custom_js)
{
  echo '<script>';
  echo $kaya_custom_js;
  echo '</script>';
}
}
add_action('wp_head', 'kaya_theme_custom_js');
/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/
function kaya_childtheme_analytics(){

	$shortname =  get_option('kaya_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','kaya_childtheme_analytics');
/*-----------------------------------------------------------------------------------*/
/* Page Title bar Settings */
/*-----------------------------------------------------------------------------------*/
function kaya_slider_page_title_data(){
  global $post_item_id, $post;
  echo  kaya_post_item_id();

    if( class_exists('woocommerce') ){
        if( is_shop() ){
          $select_page_options=get_post_meta( woocommerce_get_page_id( 'shop' ),'select_page_options',true);
        }else{ if( get_post() ) { $select_page_options=get_post_meta(get_the_ID(),'select_page_options',true); } else{ $select_page_options = ''; } }
    }elseif( is_page()){
         $select_page_options=get_post_meta($post->ID,'select_page_options',true);
    }else{
        $select_page_options = '';
    }
  if($select_page_options=="singleimage"){
     get_template_part('slider/single','image');
  }
  elseif($select_page_options == 'page_title_setion'){
            kaya_custom_pagetitle($post_item_id); ?>
  <?php }
  elseif($select_page_options == 'none'){   }  else{
    if( !is_front_page() ){ kaya_custom_pagetitle($post_item_id);  }
  }
}
/*-----------------------------------------------------------------------------------*/
// Page Border Radus
/*-----------------------------------------------------------------------------------*/
function kaya_page_border_radius(){

   $layout_position = get_theme_mod('layout_position') ? get_theme_mod('layout_position') : 'center';
   $theme_layout_mode = get_theme_mod('theme_layout_mode') ? get_theme_mod('theme_layout_mode') : 'fluid_container';
  if( $theme_layout_mode =='boxed_container' ) { if( $layout_position == 'left' ) { $border_radius = '0 10px 0 0;'; }  elseif( $layout_position == 'right' ){ $border_radius = ' 10px 0 0 0;'; } else{ $border_radius = '10px 10px 0 0;';} }else{
      $border_radius ='';
  }
  global $post_item_id, $post;
  echo  kaya_post_item_id();

    if( class_exists('woocommerce') ){
        if( is_shop() ){
          $select_page_options=get_post_meta( woocommerce_get_page_id( 'shop' ),'select_page_options',true);
        }else{ if( get_post() ) { $select_page_options=get_post_meta(get_the_ID(),'select_page_options',true); } else{ $select_page_options = ''; } }
    }elseif( is_page()){
         $select_page_options=get_post_meta($post->ID,'select_page_options',true) ? get_post_meta($post->ID,'select_page_options',true) :'page_title_setion';
    }else{
        $select_page_options = '';
    }
  if($select_page_options == 'page_title_setion'){ ?>
    <style type="text/css">
    .sub_header_wrapper {
        border-radius: <?php echo $border_radius ?>;
    }
    </style>
  <?php }
  else{  if( is_single() || is_tax() || is_archive() || is_search() ){  ?>
    <style type="text/css">
    .sub_header_wrapper {
        border-radius: <?php echo $border_radius ?>;
    }
    </style>
  <?php }else{   ?>
    <style type="text/css">
    #mid_container_wrapper {
       border-radius: <?php echo $border_radius ?>;
    }
    </style>
  <?php }

  }
}
add_action('wp_head','kaya_page_border_radius');
/*-----------------------------------------------------------------------------------*/
/* Left Section Socila media icons */
/*-----------------------------------------------------------------------------------*/
function nav_toggle_section_data(){
  $vertical_logo = get_option('vertical_logo');
  $hide_vertical_logo = get_theme_mod('hide_vertical_logo');
  if( $hide_vertical_logo !='on'):
   echo '<div class="vertical_logo">';
  if($vertical_logo['upload_vertical_logo']):
   echo '<img src="'.$vertical_logo['upload_vertical_logo'].'" alt="Vertical Logo">';
  else:
      echo '<img src="'.get_template_directory_uri().'/images/vertical-logo.png" alt="Vertical Logo">';
  endif;
  echo '</div>';
  endif;
  echo '<div class="social_icons">';
  $n=1;
    if( get_theme_mod('left_social_icon_'.$n) ){
    for ($n=1; $n <= 10; $n++) {
      ${"image_url". $n} = get_theme_mod('left_social_icon_'.$n);
      if( ${"image_url". $n} && get_theme_mod('icon_image_link_disable'.$n) != 'on'){
        ${"image_url_link". $n} = get_theme_mod('left_social_icon_link_'.$n);
        $result = '<a href="'. ${"image_url_link". $n}.'"><img src="'.${"image_url". $n}.'" alt="Social Media Icons"></a>';
        echo $result;
      }
    }
  }else{
    if( get_theme_mod('icon_image_link_disable1') != 'on' ){ echo '<a href="#"><img src="http://kayapati.com/demos/milan/wp-content/uploads/sites/21/2014/06/twitter.png"></a>'; }
    if( get_theme_mod('icon_image_link_disable2') != 'on' ){ echo '<a href="#"><img src="http://kayapati.com/demos/milan/wp-content/uploads/sites/21/2014/06/googleplus.png"></a>'; }
     if( get_theme_mod('icon_image_link_disable3') != 'on' ){echo '<a href="#"><img src="http://kayapati.com/demos/milan/wp-content/uploads/sites/21/2014/06/skype.png"></a>'; }
     if( get_theme_mod('icon_image_link_disable4') != 'on' ){echo '<a href="#"><img src="http://kayapati.com/demos/milan/wp-content/uploads/sites/21/2014/06/vimeo.png"></a>';}
  }
  echo '</div>';  
}
/*-----------------------------------------------------------------------------------*/
/* Background Image Settings */
/*-----------------------------------------------------------------------------------*/

function kaya_custom_bg_img(){
    global $post_item_id, $post;
  echo  kaya_post_item_id();
  $page_custom_img = get_option('page_custom_img');
 $page_custom_bg_img = get_post_meta($post_item_id,'page_custom_bg_img',true);
 $defult_image = get_template_directory_uri().'/images/page_default_image.jpg';
 if( $page_custom_bg_img ){
   $src = wp_get_attachment_image_src( $page_custom_bg_img, '' );
   $bg_image = $src[0];
  $bg_img_position = get_post_meta($post_item_id,'bg_img_position',true) ? get_post_meta($post->ID,'bg_img_position',true) : 'left';
  $bg_img_repeat = get_post_meta($post_item_id,'bg_img_repeat',true) ? get_post_meta($post->ID,'bg_img_repeat',true) : 'no-repeat';
  $bg_img_attachment = get_post_meta($post_item_id,'bg_img_attachment',true) ? get_post_meta($post->ID,'bg_img_attachment',true) : 'fixed';
  $position_fixed = ( $bg_img_attachment == 'fixed' ) ? 'position:fixed!important' : 'absolute';
  $fit_screen = ( $bg_img_repeat == 'cover') ? 'cover' : 'inherit';
 }
 else{
 	$default_img = get_template_directory_uri().'/images/page_default_image.jpg';
   $bg_image= $page_custom_img['bg_image'] ? $page_custom_img['bg_image'] : $default_img;
   $bg_img_repeat = get_theme_mod('bg_image_repeat') ? get_theme_mod('bg_image_repeat') : 'cover';
   $bg_img_attachment = get_theme_mod('bg_image_attachment') ? get_theme_mod('bg_image_attachment') : 'fixed';
   $bg_img_position = get_theme_mod('bg_image_position') ? get_theme_mod('bg_image_position') : 'right';
   $fit_screen = ( $bg_img_repeat == 'cover') ? 'cover' : 'inherit';
   $position_fixed = ( $bg_img_attachment == 'fixed' ) ? 'position:fixed!important' : 'absolute';
 }
  //echo $page_bg_img_cover = ($background_repeat == 'no-repeat') ? 'cover' : 'inherit';
  echo '<div class="page_custom_bg_img" style="background-image:url('.$bg_image.'); background-repeat:'.$bg_img_repeat.'; background-size:'.$fit_screen.'; background-position:'.$bg_img_position.'; background-attachment:'.$bg_img_attachment.'; '.$position_fixed.'; ">&nbsp;</div>';
// Pattern Disable
  if( get_theme_mod('bg_image_pattern_disable') != 'on' ) { ?>  
    <div class="imgoverlay_pattern"> </div>
 <?php }  

}
/*-----------------------------------------------------------------------------------*/
/* Theme Customization Styles */
/*-----------------------------------------------------------------------------------*/
function kaya_custom_colors(){
  // Logo Section
  global $post_item_id, $post;
  echo  kaya_post_item_id();
    //Page bg disable
   $disable_page_bg = get_post_meta($post_item_id, 'disable_page_bg',true) ? get_post_meta($post_item_id, 'disable_page_bg',true) : '0';
   $text_logo_font_size = get_theme_mod('text_logo_font_size') ? get_theme_mod('text_logo_font_size') : '40' ;
    $text_logo_font_color = get_theme_mod('text_logo_font_color') ? get_theme_mod('text_logo_font_color') : '#333333' ;
    $logo_desc_text_color = get_theme_mod('logo_desc_text_color') ? get_theme_mod('logo_desc_text_color') : '#fff' ;
    $text_logo_font_family = get_theme_mod('text_logo_font_family') ? get_theme_mod('text_logo_font_family') : '';
   // Layout Options 3px 0 0 3px
   $layout_position = get_theme_mod('layout_position') ? get_theme_mod('layout_position') : 'center' ;
   $slide_list = ($layout_position == 'left') ? 'right' : 'left';
   $slide_list_border = ($layout_position == 'left') ? '3px 0 0 3px' : '0 3px 3px 0';
    $url=get_template_directory_uri().'/images/'; 
      // Buttons Color Section
  $button_bg_color = get_option('button_bg_color') ? get_option('button_bg_color') : '#1abc9c';
  $button_border_color = get_option('button_border_color') ? get_option('button_border_color') : '#ffffff';
  $button_bg_text_color = get_option('button_bg_text_color') ? get_option('button_bg_text_color') : '#fff';
  $button_bg_hover_color = get_option('button_bg_hover_color') ? get_option('button_bg_hover_color') : '#303030';
  $button_hover_text_color = get_option('button_hover_text_color') ? get_option('button_hover_text_color') : '#fff';
      // Input fields Color Section
  $input_background_color = get_option('input_background_color') ? get_option('input_background_color') : '#333333';
  $input_text_color = get_option('input_text_color') ? get_option('input_text_color') : '#ffffff';
    $input_border_color = get_option('input_border_color') ? get_option('input_border_color') : '#2d2d2d';
  $input_error_border_color = get_option('input_error_border_color') ? get_option('input_error_border_color') : '#dd1c1c';
 // Header Section
    $upload_header = get_option('upload_header');
    $backgroundbg_repeat = get_theme_mod('backgroundbg_repeat') ? get_theme_mod('backgroundbg_repeat') : 'repeat' ;
    $header_bg_color = get_theme_mod('header_bg_color') ? get_theme_mod('header_bg_color') : '' ;
    // Toggle Left Section
    $overlap_container_border_color = get_option( 'overlap_container_border_color') ? get_option( 'overlap_container_border_color') : '#1abc9c';
    $overlap_container_border_icon_color = get_option( 'overlap_container_border_icon_color') ? get_option( 'overlap_container_border_icon_color') : '#fff';
    $overlap_container_bg_color = get_option( 'overlap_container_bg_color') ? get_option( 'overlap_container_bg_color') : '#222222';
    $overlap_container_title_color = get_option( 'overlap_container_title_color') ? get_option( 'overlap_container_title_color') : '#ffffff';
    $overlap_container_link_color = get_option( 'overlap_container_link_color') ? get_option( 'overlap_container_link_color') : '#333333';
    $overlap_container_text_color = get_option( 'overlap_container_text_color') ? get_option( 'overlap_container_text_color') : '#ffffff';
    $overlap_container_hover_color = get_option( 'overlap_container_hover_color') ? get_option( 'overlap_container_hover_color') : '#000';
  
    $responsive_layout_mode = get_option( 'responsive_layout_mode' );
    $home_container_bg = get_theme_mod( 'home_container_bg' ) ? get_theme_mod( 'home_container_bg' ) : 'on'; // Home Container Bg
    $layout_border_top = get_theme_mod( 'layout_border_top' ) ? get_theme_mod( 'layout_border_top' ) : '#EF7360 ';
    $upload_header = get_option('upload_header');
    $header_image_repeat = get_theme_mod('header_image_repeat') ? get_theme_mod('header_image_repeat') : 'repeat';
   
    $page_title_bar = get_option('page_title_bar');
  //print_r($page_title_bar);
    $page_title_bar_bg_repeat = get_theme_mod('page_title_bar_bg_repeat') ? get_theme_mod('page_title_bar_bg_repeat') : 'repeat' ;
    $page_title_bg_color = get_theme_mod( 'page_title_bg_color' ) ? get_theme_mod( 'page_title_bg_color' ) : '';
    $page_titlebar_title_color = get_theme_mod('page_titlebar_title_color') ? get_theme_mod('page_titlebar_title_color') : '#3A3A3A';
     // Menu  Section
    $menubg_color = get_option('menubg_color') ? get_option('menubg_color') : '';
    $menu_bar = get_option('menu_bar');
    $menu_bar_bg_repeat = get_theme_mod('menu_bar_bg_repeat') ? get_theme_mod('menu_bar_bg_repeat') : 'repeat' ;

    $menubg = get_option('menubg');
    $menubg_repeat = get_theme_mod('menubg_repeat') ? get_theme_mod('menubg_repeat') : 'repeat' ;
    $menu_bg_active_color = get_option('menu_bg_active_color') ? get_option('menu_bg_active_color') : '#000' ;
    $menu_link_active_color = get_option('menu_link_active_color') ? get_option('menu_link_active_color') : '#1abc9c' ;
// Menu Border bottom Colors
    $menu_border_bottom_color_1 = get_option('menu_border_bottom_color_1') ? get_option('menu_border_bottom_color_1') : '#f95240'; 
    $menu_border_bottom_color_2 = get_option('menu_border_bottom_color_2') ? get_option('menu_border_bottom_color_2') : '#1f9fba';
    $menu_border_bottom_color_3 = get_option('menu_border_bottom_color_3') ? get_option('menu_border_bottom_color_3') : '#9bbb1c';
    $menu_border_bottom_color_4 = get_option('menu_border_bottom_color_4') ? get_option('menu_border_bottom_color_4') : '#ffa401';
    $menu_border_bottom_color_5 = get_option('menu_border_bottom_color_5') ? get_option('menu_border_bottom_color_5') : '#ca3636';
    $menu_border_bottom_color_6 = get_option('menu_border_bottom_color_6') ? get_option('menu_border_bottom_color_6') : '#e7a802';
    $menu_border_bottom_color_7 = get_option('menu_border_bottom_color_7') ? get_option('menu_border_bottom_color_7') : '#626262';
    $menu_border_bottom_color_8 = get_option('menu_border_bottom_color_8') ? get_option('menu_border_bottom_color_8') : '#055a47';
    $menu_border_bottom_color_9 = get_option('menu_border_bottom_color_9') ? get_option('menu_border_bottom_color_9') : '#9bbb1c';
    $menu_border_bottom_color_10 = get_option('menu_border_bottom_color_10') ? get_option('menu_border_bottom_color_10') : '#f95240';

    $menu_background_color = get_option('menu_background_color') ? get_option('menu_background_color') : '' ;
    $menu_link_color = get_option('menu_link_color') ? get_option('menu_link_color') : '#ffffff' ;
    $menu_link_hover_text_color = get_option('menu_link_hover_text_color') ? get_option('menu_link_hover_text_color') : '#1abc9c';
    $menu_link_hover_bg_color = get_option('menu_link_hover_bg_color') ? get_option('menu_link_hover_bg_color') : '#000';
    $sub_menu_link_color = get_option('sub_menu_link_color') ? get_option('sub_menu_link_color') : '#4f4f4f';
    $sub_menu_link_hover_color = get_option('sub_menu_link_hover_color') ? get_option('sub_menu_link_hover_color') : '#1abc9c ';
    $sub_menu_bg_color = get_option('sub_menu_bg_color') ? get_option('sub_menu_bg_color') : '#fff';
    $sub_menu_link_hover_bg_color = get_option('sub_menu_link_hover_bg_color') ? get_option('sub_menu_link_hover_bg_color') : '#fff';
    $sub_menu_bottom_border_color = get_option('sub_menu_bottom_border_color') ? get_option('sub_menu_bottom_border_color') : '#eaeaea';
    $sub_menu_link_active_color = get_option('sub_menu_link_active_color') ? get_option('sub_menu_link_active_color') : '#1abc9c';
    $sub_menu_active_bg_color = get_option('sub_menu_active_bg_color') ? get_option('sub_menu_active_bg_color') : '#e8e8e8';
    
    //Page color settings bottom-opc
    $defult_bg_img = get_template_directory_uri().'/images/top-opc.png';
    $page_content_bg = get_option('page_content_bg');
    $page_content_bg_repeat = get_theme_mod('page_content_bg_repeat') ? get_theme_mod('page_content_bg_repeat') : 'repeat' ;
    $page_bg_color = get_option('page_bg_color') ? get_option('page_bg_color') : '';
    $page_titles_color = get_option('page_titles_color') ? get_option('page_titles_color') : '#5b5b5b';
    $page_description_color = get_option('page_description_color') ? get_option('page_description_color') : '#8e8e8e';
    $page_link_color = get_option('page_link_color') ? get_option('page_link_color') : '#21abce';
    $page_link_hover_color = get_option('page_link_hover_color') ? get_option('page_link_hover_color') : '#bf1952';
    // Footer
    $upload_footer = get_option('upload_footer');
    $footer_bg_image_repeat = get_theme_mod('footer_bg_image_repeat') ? get_theme_mod('footer_bg_image_repeat') : 'repeat' ;
    $footer_bg_color = get_option('footer_bg_color') ? get_option('footer_bg_color') : '';
    $footer_text_color = get_option('footer_text_color') ? get_option('footer_text_color') : '#fff';
    /* Social Sharing icons */
    $social_sharing_icon_bg_color =get_theme_mod('social_sharing_icon_bg_color') ? get_theme_mod('social_sharing_icon_bg_color') : '#333333';
    $social_sharing_icon_color =get_theme_mod('social_sharing_icon_color') ? get_theme_mod('social_sharing_icon_color') : '#e7a802';
    $social_sharing_icon_bg_hover_color =get_theme_mod('social_sharing_icon_bg_hover_color') ? get_theme_mod('social_sharing_icon_bg_hover_color') : '#e7a802';
    $social_sharing_icon_link_hover_color =get_theme_mod('social_sharing_icon_link_hover_color') ? get_theme_mod('social_sharing_icon_link_hover_color') : '#333333';
        //Sidebar color settings
    $sidebar_bg_color = get_option('sidebar_bg_color') ? get_option('sidebar_bg_color') : '';
    $sidebar_title_color = get_option('sidebar_title_color') ? get_option('sidebar_title_color') : '#353535';
    $sidebar_link_color = get_option('sidebar_link_color') ? get_option('sidebar_link_color') : '#21abce';
    $sidebar_link_hover_color = get_option('sidebar_link_hover_color') ? get_option('sidebar_link_hover_color') : '#bf1952';
    $sidebar_content_color = get_option('sidebar_content_color') ? get_option('sidebar_content_color') : '#454545';
    // Accent Color Section
  	$accent_bg_color = get_option('accent_bg_color') ? get_option('accent_bg_color') : '#1abc9c';
  	$accent_text_color = get_option('accent_text_color') ? get_option('accent_text_color') : '#ffffff';
       /* Font Family */
    $google_bodyfont=get_theme_mod( 'google_body_font' ) ? get_theme_mod( 'google_body_font' ) : '';
    $google_menufont=get_theme_mod( 'google_menu_font') ? get_theme_mod( 'google_menu_font' ) : '';
    $google_generaltitlefont=get_theme_mod( 'google_heading_font') ? get_theme_mod( 'google_heading_font') : '';
     /* Font Sizes */
    /* Title Font sizes H1 */
    $h1_title_font_size=get_theme_mod( 'h1_title_fontsize', '' ) ? get_theme_mod( 'h1_title_fontsize', '' ) : '27'; // H1
    $h2_title_font_size=get_theme_mod( 'h2_title_fontsize', '' ) ? get_theme_mod( 'h2_title_fontsize', '' ) : '24'; // H2
    $h3_title_font_size=get_theme_mod( 'h3_title_fontsize', '' ) ? get_theme_mod( 'h3_title_fontsize', '' ) : '20'; // H3
    $h4_title_font_size=get_theme_mod( 'h4_title_fontsize', '' ) ? get_theme_mod( 'h4_title_fontsize', '' ) : '18'; // H4
    $h5_title_font_size=get_theme_mod( 'h5_title_fontsize', '' ) ? get_theme_mod( 'h5_title_fontsize', '' ) : '16'; // H5
    $h6_title_font_size=get_theme_mod( 'h6_title_fontsize', '' ) ? get_theme_mod( 'h6_title_fontsize', '' ) : '14'; // H6
    $body_font_size=get_theme_mod( 'body_font_size', '' ) ? get_theme_mod( 'body_font_size', '' ) : '13'; // Body Font Size
    $menu_font_size=get_theme_mod( 'menu_font_size', '' ) ? get_theme_mod( 'menu_font_size', '' ) : '14'; // Body Font Size
      
   /* Portfolio Thumbnail color section */
   $pf_posts_title_bg_color = get_theme_mod('pf_posts_title_bg_color') ? get_theme_mod('pf_posts_title_bg_color') : '#e7a802';
   $pf_posts_title_color = get_theme_mod('pf_posts_title_color') ? get_theme_mod('pf_posts_title_color') : '#333333';
   $pf_related_title_color = get_theme_mod('pf_related_title_color') ? get_theme_mod('pf_related_title_color') : '#333';
   /* Filter Tabs Color */
    $pf_filter_tabs_bg_color = get_theme_mod('pf_filter_tabs_bg_color') ? get_theme_mod('pf_filter_tabs_bg_color') : '#0c151c';
    $pf_filter_tabs_link_color = get_theme_mod('pf_filter_tabs_link_color') ? get_theme_mod('pf_filter_tabs_link_color') : '#333333';
    $pf_filter_tabs_active_color = get_theme_mod('pf_filter_tabs_active_color') ? get_theme_mod('pf_filter_tabs_active_color') : '#e7a802';

    /* Woocommerce Color Section */
    $primary_buttons_bg_color = get_option('primary_buttons_bg_color') ? get_option('primary_buttons_bg_color') : '#434a54';
    $primary_buttons_text_color = get_option('primary_buttons_text_color') ? get_option('primary_buttons_text_color') : '#333333';
    $primary_buttons_bg_hover_color = get_option('primary_buttons_bg_hover_color') ? get_option('primary_buttons_bg_hover_color') : '#e7a802';
    $primary_buttons_text_hover_color = get_option('primary_buttons_text_hover_color') ? get_option('primary_buttons_text_hover_color') : '#333333';

    $secondary_buttons_bg_color = get_option('secondary_buttons_bg_color') ? get_option('secondary_buttons_bg_color') : '#e7a802';
    $secondary_buttons_text_color = get_option('secondary_buttons_text_color') ? get_option('secondary_buttons_text_color') : '#333333';
    $secondary_buttons_bg_hover_color = get_option('secondary_buttons_bg_hover_color') ? get_option('secondary_buttons_bg_hover_color') : '#434a54';
    $secondary_buttons_text_hover_color = get_option('secondary_buttons_text_hover_color') ? get_option('secondary_buttons_text_hover_color') : '#333333';
    $woo_elments_colors = get_option('woo_elments_colors') ? get_option('woo_elments_colors') : '#e7a802';

    $success_msg_bg_color = get_option('success_msg_bg_color') ? get_option('success_msg_bg_color') : '#dff0d8';
    $success_msg_text_color = get_option('success_msg_text_color') ? get_option('success_msg_text_color') : '#468847';
    $notification_msg_bg_color = get_option('notification_msg_bg_color') ? get_option('notification_msg_bg_color') : '#b8deff';
    $notification_msg_text_color = get_option('notification_msg_text_color') ? get_option('notification_msg_text_color') : '#333';
    $warning_msg_bg_color = get_option('warning_msg_bg_color') ? get_option('warning_msg_bg_color') : '#f2dede';
    $warning_msg_text_color = get_option('warning_msg_text_color') ? get_option('warning_msg_text_color') : '#a94442';

    // Fluid Container
    /* $fluid_bg1_color = get_option('fluid_bg1_color') ? get_option('fluid_bg1_color') : '#f2f2f2';
    $fluid_bg1_text_color = get_option('fluid_bg1_text_color') ? get_option('fluid_bg1_text_color') : '#656565';
    $fluid_bg1_image = get_option('fluid_bg1_image');
    $fluid_image_repeat = get_theme_mod('fluid_image_repeat') ? get_theme_mod('fluid_image_repeat') : 'repeat' ;
    $fluid_image1_opacity = get_theme_mod('fluid_image1_opacity') ? get_theme_mod('fluid_image1_opacity') : '1' ;

    $fluid_bg1_border_color = get_option('fluid_bg1_border_color') ? get_option('fluid_bg1_border_color') : '#eee';
    $fluid_bg1_border = get_theme_mod('fluid_bg1_border') ? get_theme_mod('fluid_bg1_border') : '1' ;
    // Fluid Container 2
    $fluid_bg2_color = get_option('fluid_bg2_color') ? get_option('fluid_bg2_color') : '#f2f2f2';
    $fluid_bg2_text_color = get_option('fluid_bg2_text_color') ? get_option('fluid_bg2_text_color') : '#666666';
    $fluid_bg2_image = get_option('fluid_bg2_image');
    $fluid_image2_repeat = get_theme_mod('fluid_image2_repeat') ? get_theme_mod('fluid_image2_repeat') : 'repeat' ;
    $fluid_image2_opacity = get_theme_mod('fluid_image2_opacity') ? get_theme_mod('fluid_image2_opacity') : '1' ;
    $fluid_bg2_border_color = get_option('fluid_bg2_border_color') ? get_option('fluid_bg2_border_color') : '#eee';
    $fluid_bg2_border = get_theme_mod('fluid_bg2_border') ? get_theme_mod('fluid_bg2_border') : '1' ;
    */
   // Start css Styles 
     $css = '';
    /* body Font family */
    $lineheight_body = round((1.7 * $body_font_size));
    $lineheight_h1 = round((1.4 * $h1_title_font_size));
    $lineheight_h2 = round((1.4 * $h2_title_font_size));
    $lineheight_h3 = round((1.4 * $h3_title_font_size));
    $lineheight_h4 = round((1.4 * $h4_title_font_size)); 
    $lineheight_h5 = round((1.4 * $h5_title_font_size));
    $lineheight_h6 = round((1.4 * $h6_title_font_size));
    // Logo
    $css .= 'h1.logo, .logo{
          font-size:'.$text_logo_font_size.'px;
          color:'.$text_logo_font_color.';
          font-family:'.$text_logo_font_family.'!important;
        }';
    $css .= '.logo_desc h1, .logo_desc h2, .logo_desc h3,
        .logo_desc h4, .logo_desc h5, .logo_desc h6,
        .logo_desc p, .logo_desc{
            color:'.$logo_desc_text_color.';
        }';    
 
   $css .= '.menu ul li a{
        font-family:'.$google_menufont.'!important;
        font-size:'.$menu_font_size.'px;
        line-height: 100%;
    }
    body, p{
        font-family:'.$google_bodyfont.'!important;
        line-height:'.$lineheight_body.'px;
        font-size:'.$body_font_size.'px;
    }
    p{
        padding-bottom:'.$lineheight_body.'px;
    }
    /* Heading Font Family */
     h1, h2, h3, h4, h5, h6{
        font-family:'.$google_generaltitlefont.'!important;
    }
    /* Font Sizes */
    h1{
      font-size:'.$h1_title_font_size.'px;
     line-height:'.$lineheight_h1.'px;
    }
    h2{
     font-size:'.$h2_title_font_size.'px;
      line-height:'.$lineheight_h2.'px;
    }
    h3{
      font-size:'.$h3_title_font_size.'px!important;
      line-height:'.$lineheight_h3.'px!important;
    }
    h4{
      font-size:'.$h4_title_font_size.'px;
      line-height:'.$lineheight_h4.'px;
    }
    h5{
     font-size:'.$h5_title_font_size .'px;
      line-height:'. $lineheight_h5 .'px;
       font-weight: 300;
    }
    h6{
      font-size:'.$h6_title_font_size.'px;
      line-height:'.$lineheight_h6.'px;
      font-weight: 300;
    }';
    /* Layout Positions */
    $css .='#fluid_container .container{
        float:'.$layout_position.';
        padding:30px;
    }
    .bottom_footer .container{
        float:'.$layout_position.';
    }
    #boxed_container{
      float:'.$layout_position.';
    }
    ul#slide-list{
      '.$slide_list.' : 0;
      border-radius:'.$slide_list_border.';
    }';
    /* Home Page Container Bg  */
    if( $home_container_bg == 'off' ){
    $css .= '.home #mid_container_wrapper{
          background: none!important;
          box-shadow: 0 0;
    }'; 
  }

       /* Input field  Colors */
     $css .= '.vaidate_error{
      border:1px solid '.$input_error_border_color.'!important;
    }';
$css .= '#search_form input, #contact-form p.one_third input, #contact-form p.one_third_last input, #contact-form p.fullwidth textarea, input[type="text"], textarea, input{
        background-color:'.$input_background_color.'!important;
        color:'.$input_text_color.'!important;
        border-color:'.$input_border_color.';
     }';
  /* Buttons Colors */
$css .= 'a.readmore, input#submit, #contact-form p #contact_submit, #commentform #submit , #contact-form #reset ,  #mid_container_wrapper .blog_read_more, #search_form button {
        background:'.$button_bg_color.'!important;
        border:2px solid '.$button_border_color.'!important;
        color:'.$button_bg_text_color.'!important;
     }
    a.readmore:hover, input#submit:hover, #contact-form p #contact_submit:hover, #commentform #submit:hover , #contact-form #reset:hover,  #mid_container_wrapper .blog_read_more:hover {
        background-color:'.$button_bg_hover_color.'!important;
        color:'.$button_hover_text_color.'!important;
     }';

  $css .= '.bottom_footer{
      border-bottom:5px solid '.$overlap_container_border_color.'!important;
     }
     .bottom_footer{
        background:'.$overlap_container_border_color.'!important;
        color:'.$overlap_container_border_icon_color.'!important;
     }
     .bottom_footer i{
        color:'.$overlap_container_border_icon_color.'!important;
     }
     .overlay_container{
       background-color:'.$overlap_container_bg_color.';
       color:'.$overlap_container_text_color.';
     }
    .overlay_container  h3{
        color:'.$overlap_container_title_color.';
      }
     .overlay_container, .overlay_container p, .bottom_section {
       color:'.$overlap_container_text_color.';
     }
     .overlay_container a, .bottom_section a{
       color:'.$overlap_container_link_color.';
     }
     .overlay_container a:hover, .bottom_section a:hover{
       color:'.$overlap_container_hover_color.';
     }';   
   /* Header Section */
if( $header_bg_color ){
   $css .= '.header_wrapper{
      background-color:'.$header_bg_color.'!important;     
        }';
     }else{ 
    if( $upload_header['bg_image'] ){ 
       $backgroundbg_image_repeat = ( $backgroundbg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
     $css .='.header_wrapper {
      background:url('.$upload_header['bg_image'].')!important;
      background-size : '.$backgroundbg_image_repeat.'!important;
      background-repeat : '.$backgroundbg_repeat.'!important;
      background-attachment: scroll!important;
      background-position: center;
       background-repeat:repeat;
           
     }';
    }
  }       
    /* Accent Color Settings */
    $css .= '.post_description,  .blog_single_img .bx-prev:hover, .blog_single_img .bx-next:hover, .blog_single_img .isotope_gallery li, #main_slider .prevBtn, #main_slider .nextBtn, .widget_tag_cloud .tagcloud a:hover , #sidebar .widget_calendar table caption, .cal-blog, .pagination .current, .pagination span a.current, ul.page-numbers .current,  .bx-wrapper .bx-controls-direction a:hover, .slides-pagination a.current,  .owl_slider_img, .slides-navigation a:hover, .blog_post_comment, #prevslide:hover, #nextslide:hover, .owl-theme .owl-controls .owl-buttons div:hover, ul#slide-list li.current-slide a, ul#slide-list li.current-slide a:hover, ul#slide-list li a:hover{
       background-color:'.$accent_bg_color.'!important;
     }';
     $css .= '#sidebar h3:after, .custom_title.kaya_title_left h3:before, .custom_title.kaya_title_left h2:before, .custom_title.kaya_title_left h1:before, .custom_title.kaya_title_center h3:before, .custom_title.kaya_title_center h2:before, .custom_title.kaya_title_center h1:before, .custom_title.kaya_title_right h3:before, .custom_title.kaya_title_right h2:before, .custom_title.kaya_title_right h1:before, .relatedpost_title > h2:after, .related.products > h2:after, .overlay_container h3:before, h3.widget-title:after, .bx-wrapper .bx-pager,  .bx-wrapper .bx-controls-auto, .bx-wrapper .bx-pager, .bx-wrapper .bx-controls-auto{
          background:'.$accent_bg_color.'!important;
     }
     ul#slide-list li a{
        border-color:'.$accent_bg_color.'!important;
     }
    .bx-controls.bx-has-pager.bx-has-controls-direction{
      border-top:5px solid '.$accent_bg_color.'!important;
     }
     .bx-pager.bx-default-pager:before, .bx-pager.bx-default-pager:after {
        border-color: '.$accent_bg_color.' transparent;
    }
     .widget_container h3 span, #entry-author-info h4 , .accent, .meta_desc span i, #slidecaption h2 span{
      color:'.$accent_bg_color.'!important;
    }';
    /* Accent background text color */
    $css .= '.widget_tag_cloud .tagcloud a:hover, #sidebar .widget_calendar table caption, #sidebar .widget_calendar table td a, #sidebar .widget_calendar table td a:visited, .pagination .current, .pagination span a.current, ul.page-numbers .current, a.social-icons:hover,.slider_items h4, .blog_post_comment h3 a, #mid_container_wrapper .pagination a:hover{
       color:'.$accent_text_color.'!important;
     }
    footer a.readmore, .header_cart_items .button.wc-forward, a.page-numbers:hover, .filter_portfolio .filter .active, #filter ul li a:hover{
        background:'.$accent_bg_color.'!important;
        color:'.$accent_text_color.'!important;
     }
     #mid_container_wrapper .blog_post_wrapper .pagination a:hover,.woocommerce #content nav.woocommerce-pagination ul li a:focus {
        background:'.$accent_bg_color.'!important;
        color:'.$accent_text_color.'!important;
     }
      .bx-pager div a:after, .bx-pager div a:hover{
        background:'.$accent_text_color.'!important;
     }
      .bx-pager div a{
        border-color:'.$accent_text_color.'!important;
     }
    input#submit:hover,  footer a.readmore:hover, .header_cart_items .button.wc-forward:hover{
       background:'.$accent_text_color.';
        color:'.$accent_bg_color.';
     }';
    // Page Title bar Section 
           // Page Title bar Section 
     $page_title_bg_img = $page_title_bar['bg_img'] ? $page_title_bar['bg_img'] : $defult_bg_img;
     if( $page_title_bg_color ){
        $css .= '.sub_header_wrapper {
            background :'.$page_title_bg_color.';
        }';
     }
     else{
      if( $page_title_bg_img ){
        $bg_size_cover = ( $page_title_bar_bg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
        $css .= '.sub_header_wrapper{
               background:url('.$page_title_bg_img.')!important;
               background-repeat:'.$page_title_bar_bg_repeat.'!important;
               background-size : '.$bg_size_cover.'!important;
        }';
    }
  }
      $css .= '.sub_header_wrapper h2, .sub_header_wrapper p{
        color:'.$page_titlebar_title_color.';
      }';
      $css .= '.sub_header_wrapper h2, .sub_header_wrapper p{
        color:'.$page_titlebar_title_color.';
      }';
  
    /* Menu Section */
    
  if( $menubg_color ){
  $css .= '.header_wrapper .container{
      background-color:'.$menubg_color.'!important;     
        }';
     }else{ 
    if( $menu_bar['menu_bg_img'] ){ 
       $menu_bg_image_size = ( $menu_bar_bg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
     $css .= '.header_wrapper .container{
      background:url('.$menu_bar['menu_bg_img'].')!important;
      background-size : '.$menu_bg_image_size.'!important;
      background-repeat : '.$menu_bar_bg_repeat.'!important;
      background-position: center;
           
     }';
    }
  } 
  $css .= '.menu > ul > li > a{
        color:'.$menu_link_color.'!important;
    }
    .menu > ul  > li:hover > a, .mobile_menu > ul  > li:hover > a
    {
      color:'.$menu_link_hover_text_color.'!important;
    }
    .menu .current_page_ancestor > a, .menu .current-menu-ancestor > a, .menu .current-menu-item > a, .mobile_menu .current_page_ancestor > a, .mobile_menu .current-menu-ancestor > a, .mobile_menu .current-menu-item > a{
        color:'.$menu_link_active_color.'!important;
    }
  /* .menu ul li:nth-child(1) { border-bottom: 3px solid '.$menu_border_bottom_color_1.'; }
  .menu ul li:nth-child(2) { border-bottom: 3px solid '.$menu_border_bottom_color_2.'; }
  .menu ul li:nth-child(3) { border-bottom: 3px solid '.$menu_border_bottom_color_3.'; }
  .menu ul li:nth-child(4) { border-bottom: 3px solid '.$menu_border_bottom_color_4.'; }
  .menu ul li:nth-child(5) { border-bottom: 3px solid '.$menu_border_bottom_color_5.'; } 
  .menu ul li:nth-child(6) { border-bottom: 3px solid '.$menu_border_bottom_color_6.'; }
  .menu ul li:nth-child(7) { border-bottom: 3px solid '.$menu_border_bottom_color_7.'; }
  .menu ul li:nth-child(8) { border-bottom: 3px solid '.$menu_border_bottom_color_8.'; }
  .menu ul li:nth-child(9) { border-bottom: 3px solid '.$menu_border_bottom_color_9.'; }
  .menu ul li:nth-child(10) { border-bottom: 3px solid '.$menu_border_bottom_color_10.'; } */
  .menu ul ul li a, .menu ul ul {
      background-color:'.$sub_menu_bg_color.'!important;
    }
  .menu > ul > li > ul:after {
    border-color: transparent transparent '.$sub_menu_bg_color.'!important;
  }
    .menu ul ul li a{
      color:'.$sub_menu_link_color.'!important;
    }
    .menu ul ul li a:hover{
      color:'.$sub_menu_link_hover_color.'!important;
      background-color:'.$sub_menu_link_hover_bg_color.'!important; 
    }
    .mobile_menu ul ul li a:hover{
      color:'.$sub_menu_link_hover_color.'!important;
     
    }
    .menu ul ul li{
      border-bottom:  1px solid '.$sub_menu_bottom_border_color.'!important; 
    }
    .menu .sub-menu .current-menu-item > a {
         color:'.$sub_menu_link_active_color.'!important;
         background-color:'.$sub_menu_active_bg_color.'!important;
    }';  
          
    /*Page color settings */
    $page_bg_img = $page_content_bg['bg_img'] ? $page_content_bg['bg_img'] : $defult_bg_img;
    //if(!is_front_page()){
    if( $disable_page_bg == '0' ){
      if( $page_bg_color ){
        $css .= '#mid_container_wrapper{
       background-color : '.$page_bg_color.';
      }';
    }else{
    if( $page_bg_img ){
      $bg_size_cover = ( $page_content_bg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
     $css .= '#mid_container_wrapper{
           background:url('.$page_bg_img.')!important;
           background-repeat:'.$page_content_bg_repeat.'!important;
           background-size: '.$bg_size_cover.'!important;
    }';
    }
 } 
}
    $css .= 'cite.fn, #mid_container_wrapper h1, 
    #mid_container_wrapper h2,
    #mid_container_wrapper h3,
    #mid_container_wrapper h4,
    #mid_container_wrapper h5,
    #mid_container_wrapper h6,
	mid_container_wrapper h1 a, 
	#mid_container_wrapper h2 a,
    #mid_container_wrapper h3 a,
    #mid_container_wrapper h4 a,
    #mid_container_wrapper h5 a,
    #mid_container_wrapper h6 a, #mid_container_wrapper .summary .price{
      color: '.$page_titles_color.';
    }

     #mid_container_wrapper p, #mid_container_wrapper{
       color: '.$page_description_color.';
    }
    #mid_container_wrapper a{
       color: '.$page_link_color.';
    }
    #mid_container_wrapper a:hover{
       color: '.$page_link_hover_color.';
    }
    .product-remove a.remove{
      border:1px solid '.$page_link_color.';
    }';
    /* Sidebar */
    $css .= '#sidebar h3{
      color:'.$sidebar_title_color.';
    }
     #sidebar p, #sidebar, #sidebar #search_form input{
      color: '.$sidebar_content_color.';
    }
    #sidebar a{
      color: '.$sidebar_link_color.';
    }
     #sidebar a:hover{
      color:'.$sidebar_link_hover_color.';
    }
    #mid_container_wrapper .blog_post h4 a{
      color: '.$page_titles_color.';
    }';

    /* Portfolio thumbnail color */
    $css .= '.da-thumbs li .portfolio_overlay, #relatedposts .owl-item .portfolio_overlay {
        background-color : '.$pf_posts_title_bg_color.'!important;
    }
    #mid_container_wrapper .da-thumbs li div h4, #mid_container_wrapper #relatedposts .owl-item div h4, #mid_container_wrapper .da-thumbs li div a, #mid_container_wrapper #relatedposts .owl-item div a{
         color:'.$pf_posts_title_color.'!important;
    }
     .portfolio_item_content h4, #relatedposts .owl-item h4, .portfolio_item_content p, #relatedposts .owl-item p {
      color: '.$pf_posts_title_color.'!important;
     }';
    /* social sharing icons */
    $css .='.social_saring_icons a{
        background-color:'.$social_sharing_icon_bg_color.';
        color:'.$social_sharing_icon_color.'!important;
    }.social_saring_icons a:hover{
        background-color:'.$social_sharing_icon_bg_hover_color.'!important;
        color:'.$social_sharing_icon_link_hover_color.'!important;
    }';
    
    // Reated post bg color 
     $css .='.relatedpost_title > h2{
        //color:'.$pf_related_title_color.'!important;
     }';
  /* Woocommerce Color Section */
     $css .= '.primary-button, #mid_container input#submit.primary-button, p.buttons .button.wc-forward{
        background:'.$primary_buttons_bg_color.'!important;
        color:'.$primary_buttons_text_color.'!important;
     }
     .primary-button:hover, #mid_container input#submit.primary-button:hover, p.buttons .button.wc-forward:hover{
        background:'.$primary_buttons_bg_hover_color.'!important;
        color:'.$primary_buttons_text_hover_color.'!important;
     }
     .seconadry-button, #place_order, .single-product-tabs .active, .single-product-tabs li:hover, .woocommerce .quantity .minus, .woocommerce .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page .quantity .plus{
        background:'.$secondary_buttons_bg_color.'!important;
        color:'.$secondary_buttons_text_color.'!important;
     }
     .woocommerce-tabs li.active:after , .woocommerce-tabs .single-product-tabs li:hover:after{
       border-color: '.$secondary_buttons_bg_color.' transparent transparent !important;
     }
     .seconadry-button:hover, #place_order:hover, .woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page .quantity .plus:hover{
        background:'.$secondary_buttons_bg_hover_color.'!important;
        color:'.$secondary_buttons_text_hover_color.'!important;
     }
     .woocommerce a.wc-forward:after, .woocommerce-page a.wc-forward:after{
          color:'.$secondary_buttons_text_color.'!important;
     }
     .woocommerce a.wc-forward:hover:after, .woocommerce-page a.wc-forward:hover:after{
          color:'.$secondary_buttons_text_hover_color.'!important;
     }
 
    .product-remove a.remove:hover {
       border-color: '.$woo_elments_colors.'!important;
    }
    .product-remove a.remove:hover, .star-rating, #mid_container_wrapper .comment-form-rating .stars a:hover, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .upsells-product-slider  ins span.amount, .related-product-slider .shop-products span .amount , .woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins{
           color:'.$woo_elments_colors.'!important;
    }
    .woocommerce span.onsale, .woocommerce-page span.onsale{
         background-color:'.$woo_elments_colors.'!important;
    }
    .cart-sussess-message {
      background-color:'.$success_msg_bg_color.';
      color:'.$success_msg_text_color.';
    }
    .woocommerce-cart-info {
      background-color:'.$notification_msg_bg_color.';
      color: '.$notification_msg_text_color.';
    }
    .woocommerce-cart-info a{
          color: '.$notification_msg_text_color.'!important;
    }
    .woocommerce-cart-error {
      background-color: '.$warning_msg_bg_color.';
      color: '.$warning_msg_text_color.';
    }';
    /* Panel Row Styles 
    $css .= '.panel-row-style-container1{
        background-color:'.$fluid_bg1_color.'!important;
        border-top:'.$fluid_bg1_border.'px solid '.$fluid_bg1_border_color.';
        border-bottom:'.$fluid_bg1_border.'px solid '.$fluid_bg1_border_color.';
       
    }';
  if( $fluid_bg1_image['fluid_image1'] ): 
    $fluid_image_cover = ($fluid_image_repeat == 'no-repeat') ? 'cover' : 'inherit';
      $css .= '.panel-row-style-container1 .container_bg_img{
        background-image:url('.$fluid_bg1_image['fluid_image1'].');
        background-attachment: fixed!important;
        background-repeat:'.$fluid_image_repeat.';
        background-size: '.$fluid_image_cover.';
        opacity:'.$fluid_image1_opacity.';
      }'; 
    endif; 
    $css .= '.panel-row-style-container1 p, .panel-row-style-container1 h1, .panel-row-style-container1 h2,.panel-row-style-container1 h3, .panel-row-style-container1 h4, .panel-row-style-container1 h5,.panel-row-style-container1 h6, .panel-row-style-container1 a{
       color: '.$fluid_bg1_text_color.';
    }';

    Container2 Style 
   $css .= '.panel-row-style-container2{
        background-color:'.$fluid_bg2_color.'!important;
         color: '.$fluid_bg2_text_color.'!important;
         border-top:'.$fluid_bg2_border.'px solid '.$fluid_bg2_border_color.';
          border-bottom:'.$fluid_bg2_border.'px solid '.$fluid_bg2_border_color.';
    }';
    if( $fluid_bg2_image['fluid_image2'] ):
       $fluid_image2_cover = ($fluid_image2_repeat == 'no-repeat') ? 'cover' : 'inherit';
      $css .= '.panel-row-style-container2 .container_bg_img {
        background-image:url('.$fluid_bg2_image['fluid_image2'].')!important;
        background-attachment: fixed!important;
        background-repeat:'.$fluid_image2_repeat.';
        background-size: '.$fluid_image2_cover.';
        opacity:'.$fluid_image2_opacity.';
      }';
  endif;
  $css .= '#mid_container_wrapper .panel-row-style-container2 p,  #mid_container_wrapper .panel-row-style-container2 h1, #mid_container_wrapper .panel-row-style-container2 h2,v .panel-row-style-container2 h3, #mid_container_wrapper .panel-row-style-container2 h4, #mid_container_wrapper .panel-row-style-container2 h5, #mid_container_wrapper .panel-row-style-container2 h6, #mid_container_wrapper .panel-row-style-container2 a{
        color: '.$fluid_bg2_text_color.';
  }'; 
  */
  // Footer Bg Color
  if(  $footer_bg_color ){
        $css .= '.bottom_section{
           background-color:'.$footer_bg_color.';
    }';
    }else{
    if( $upload_footer['footer_bg_img'] ){
      $bg_size_cover = ( $page_content_bg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
      $css .= '.bottom_section{
        background: url('.$upload_footer['footer_bg_img'].');
        background-repeat:'.$footer_bg_image_repeat.';
        background-position:center;
      }';
    }
 } 

  $css .= '.bottom_section .container{
      color:'.$footer_text_color.';

  }';
  $css = preg_replace( '/\s+/', ' ', $css ); 
  $output = "<!-- Customizer Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action('wp_head','kaya_custom_colors');

function kaya_theme_customizer_css() { 
  $css ='';
     $css .=' .customize-control-radio label {
          float: left;
          margin-right: 10px;
      }
      h4.customizer_sub_section{
          background-color: #EEEEEE;
          margin-bottom: 15px !important;
          margin-left: -30px;
          margin-right: -30px;
          margin-top: 15px !important;
          padding: 5px 30px;
          border: 1px solid #e5e5e5;
      }
      .title_description {
        display: block;
        line-height: 23px;
        margin: 0 0 10px;
        padding: 0;
      }

      .img_radio {
        display: none !important;
      }
      .kaya-radio-img {
        display: inline-block;
        margin: 0 3px 3px 0;
        border: 2px solid #fff;
      }
      .kaya-radio-img:hover{
        border: 2px solid #2EA2CC;
      }
      .kaya-radio-img-selected {
       border: 2px solid #2EA2CC;
}';
$css = preg_replace( '/\s+/', ' ', $css );
 $output = "<!-- Theme  Customizer admin Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action( 'customize_controls_print_styles', 'kaya_theme_customizer_css' );
?>