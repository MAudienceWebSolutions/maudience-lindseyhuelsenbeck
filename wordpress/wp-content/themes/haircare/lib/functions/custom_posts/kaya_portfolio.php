<?php
global $post, $pf_slug_name, $pf_slug_name_nws;
$pf_slug_name = get_theme_mod('pf_slug_name') ? get_theme_mod('pf_slug_name') :'portfolio';
$pf_slug_name_nws = preg_replace('/\s/', '', $pf_slug_name);
function portfolio_register() {
	global $pf_slug_name, $pf_slug_name_nws;
	//echo $string = preg_replace("/\s+/"," ",html_entity_decode($pf_slug_name));
	$labels = array(

		'name'				=> ucwords($pf_slug_name),
		'singular_name'		=> ucwords($pf_slug_name),
		'add_new'			=> __('Add New Post ', 'angel'),
		'add_new_item'		=> __('Add New Post', 'angel'),
		'edit_item'		=> __('Edit Post', 'angel', 'angel'),
		'new_item'		=> __('New Post Item ', 'angel', 'angel'),
		'view_item'		=> __('View Post Item ', 'angel', 'angel'),
		'search_items'	=> __('Search ', 'angel') . ucwords($pf_slug_name) . _x(' Items', 'angel','angel'),
		'not_found'		=> __('Nothing found', 'angel', 'angel'),
		'not_found_in_trash'	=> __('not_found_in_trash', 'angel'),
		'parent_item_colon'	=> ''
	);
 
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'exclude_from_search'=> false,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'rewrite' => array( 'slug' => strtolower($pf_slug_name_nws), 
		'with_front' => false ),
		'query_var'			=> false,	
		'menu_icon'			=> get_template_directory_uri() . '/lib/images/kaya_portfolios.png',  		
		'supports'			=> array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes')
	); 
	register_post_type( 'portfolio' , $args );
	register_taxonomy_for_object_type('post_tag', 'portfolio');
}
	register_taxonomy("portfolio_category", 'portfolio', array(
	'hierarchical'		=> true,
	'label'				=> ucwords($pf_slug_name).' Categories',
	'singular_label'	=> 'Categories',
	'show_ui'			=> true,
	'query_var'			=> true,
	'rewrite'			=> false,
	'orderby' => 'name',
	)
);
	
add_action('init', 'portfolio_register');

function my_columns($columns) {
	$columns['portfolio_category'] = __('Category','atp_admin');
    $columns['thumbnail'] =  __('Post Image','atp_admin');

    return $columns;
}
function manage_portfolio_columns($name) {
    global $post;global $wp_query;
    switch ($name) {
	 case 'portfolio_category':
               $terms = get_the_terms($post->ID, 'portfolio_category');

        //If the terms array contains items... (dupe of core)
        if ( !empty($terms) ) {
            //Loop through terms
            foreach ( $terms as $term ){
                //Add tax name & link to an array
                $post_terms[] = esc_html(sanitize_term_field('name', $term->name, $term->term_id, '', 'edit'));
            }
            //Spit out the array as CSV
            echo implode( ', ', $post_terms );
        } else {
            //Text to show if no terms attached for post & tax
            echo '<em>No terms</em>';
        }
				break;
        case 'thumbnail':
          
				echo the_post_thumbnail(array(100,100));
				break;
       
    }
}
add_action('manage_posts_custom_column', 'manage_portfolio_columns', 10, 2);
add_filter('manage_edit-portfolio_columns', 'my_columns');
?>