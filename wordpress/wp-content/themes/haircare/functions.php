<?php
// Define Themename
$themename="haircare";
define('KAYA_LIB', get_template_directory(). '/lib');
define('KAYA_ADMIN', KAYA_LIB . '/admin');
define('KAYA_FUNCTIONS', KAYA_LIB . '/functions');
define('KAYA_WIDGETS', KAYA_LIB . '/functions/widgets');
define('KAYA_META', KAYA_LIB . '/functions/custom_meta');
define('KAYA_SHORTCODES', KAYA_LIB . '/functions/shortcodes');
define('KAYA_INCLUDES', KAYA_LIB . '/includes');
define('KAYA_THEME_JS', get_template_directory_uri() . '/js');
define('KAYA_ADMIN_JS', get_template_directory_uri() . '/lib/admin/js');
// theme optional panel
/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/
/* Set the file path based on whether the Options Framework is in a parent theme or child theme */
/* remove unnecessary p tag*/
/* Scripts and styles  */
define('KAYA_FILEPATH', get_template_directory());
define('KAYA_DIRECTORY', get_template_directory_uri());
function excerpt_ram($text) {
return str_replace(' ', '', $text); }
require_once(KAYA_FILEPATH . '/BFI_Thumb.php');
/* These files build out the options interface.  Likely won't need to edit these. */
//require_once(KAYA_FUNCTIONS . '/custom_posts/kaya_slider.php');
require_once(KAYA_FUNCTIONS . '/custom_posts/kaya_portfolio.php');
require_once(KAYA_FUNCTIONS . '/custom_posts/toggletabs_accordion.php');
//Plugin Activation 
require_once(KAYA_FILEPATH . '/lib/plugin-activation.php');
add_filter( 'use_default_gallery_style', '__return_false' );
/*-----------------------------------------------------------------------------------*/
/* Theme Setup */
/*-----------------------------------------------------------------------------------*/ 
add_action( 'after_setup_theme', 'kaya_azura_theme_setup' );
function kaya_azura_theme_setup() {

    add_theme_support( 'custom-background');
    add_theme_support( 'custom-header' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'nav-menus' );
    add_editor_style();
    register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'haircare' ),
    'footer' => __( 'Footer Navigation' , 'haircare'),       
    ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support('post-formats',array( 'gallery','link','quote','video','audio' ) ); // Postformates
    add_image_size( 'kaya-gallery',650, 650, true );
}
// WP Default Gallery
add_shortcode( 'gallery', 'my_gallery_shortcode' );
function my_gallery_shortcode( $atts )
{
    $atts['link'] = 'file';
    return gallery_shortcode( $atts );
}
if ( ! isset( $content_width ) )
    $content_width ='';
add_action( 'tgmpa_register', 'kaya_required_plugins' );
function kaya_required_plugins() {

    $plugins = array(
   
            array(
            'name'      => 'SiteOrigin Page Builder',
            'slug'      => 'siteorigin-panels',
            'required'  => true,
        ),
 
           array(
            'name'                  => 'Kaya Hair Care Page Widgets', // The plugin name
            'slug'                  => 'kaya-haircare-page-widgets', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/lib/plugins/kaya-haircare-page-widgets.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),  

    );
    $theme_text_domain = 'haircare';
 $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( '"%1$s" plugin needs to be updated to its latest version to ensure maximum compatibility with this theme.
               <br> <span style="color:red;">Update Note:</span> Delete "%1$s" plugin by navigating to "Plugins > Installed Plugins > Deactivate > Delete" then you will see a message on top of the page to install updated plugin, click on "Begin installing plugin" and follow instructions.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
// End
require_once(KAYA_INCLUDES . '/theme-functions.php'); //header functions
require_once(KAYA_INCLUDES . '/kaya_custom_js.php'); //header functions
require_once(KAYA_INCLUDES . '/header_loads.php'); //Jquery & Css Load
require_once(KAYA_INCLUDES . '/theme_customization.php'); //Theme Customization
require_once(KAYA_FUNCTIONS . '/kaya_pagination.php'); // pagination functions
require_once(KAYA_FUNCTIONS . '/kaya_comments.php'); // comments page
require_once(KAYA_FUNCTIONS . '/common.php'); // common functions
require_once(KAYA_INCLUDES . '/kaya-sidebar-generator.php'); //Sidebar Generator
require_once(KAYA_INCLUDES . '/siteorigen_panel_row_styles.php'); //Siteorigen panel rows


//Widgets Registration
require_once(KAYA_WIDGETS . '/widgets.php');
// Make theme available for translation
// Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'haircare', get_template_directory(). '/languages' );
    $locale = get_locale();
    $locale_file = get_template_directory(). "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );
// limit the post content ======================================================================================
function kaya_content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).' ';
    } else {
    $content = implode(" ",$content);
    }   
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('get_the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

/*
 * Thank to Bob Sherron.
 * http://stackoverflow.com/questions/1155565/query-multiple-custom-taxonomy-terms-in-wordpress-2-8/2060777#2060777
 */
 function kaya_multi_tax_terms($where) {
    global $wp_query;
    global $wpdb;
    if (isset($wp_query->query_vars['term']) && (strpos($wp_query->query_vars['term'], ',') !== false && strpos($where, "AND 0") !== false) ) {
        // it's failing because taxonomies can't handle multiple terms
        //first, get the terms
        $term_arr = explode(",", $wp_query->query_vars['term']);
        foreach($term_arr as $term_item) {
            $terms[] = get_terms($wp_query->query_vars['taxonomy'], array('slug' => $term_item));
        }

        //next, get the id of posts with that term in that tax
        foreach ( $terms as $term ) {
            $term_ids[] = $term[0]->term_id;
        }

        $post_ids = get_objects_in_term($term_ids, $wp_query->query_vars['taxonomy']);

        if ( !is_wp_error($post_ids) && count($post_ids) ) {
            // build the new query
            $new_where = " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
            // re-add any other query vars via concatenation on the $new_where string below here

            // now, sub out the bad where with the good
            $where = str_replace("AND 0", $new_where, $where);
        } else {
            // give up
        }
    }
    return $where;
}
add_filter("posts_where", "kaya_multi_tax_terms");

/* Include Meta Box Script */
    define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/lib/meta-box' ) );
    define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/lib/meta-box' ) );
    require_once RWMB_DIR . 'meta-box.php';
    include 'lib/meta-boxes.php';
    /* ------------------------------------------------------------------------ */
    // Woo Commerce Shop Page title
    add_theme_support( 'woocommerce' );
if( class_exists('woocommerce')){
    function override_page_title() {
        return false;
    }
    add_filter('woocommerce_show_page_title', 'override_page_title');

   // Cart Items adding With out refresh
    add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fa fa-shopping-cart">&nbsp; </i>
            <span><?php echo sprintf(_n('%d ', '%d', $woocommerce->cart->cart_contents_count, 'woothemes' ), $woocommerce->cart->cart_contents_count); ?> </span></a>
    <?php

    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;

}
// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products(50,2); // Display 4 products in rows of 2
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 0 );
}
// Remove query string from static files
function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
?>
