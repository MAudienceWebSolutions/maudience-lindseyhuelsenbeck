<?php
	function kaya_home_slider() {

		$labels = array(
		'name'				=> _x('Kaya Slider','Kaya Slider','Kaya Slider'),
		'singular_name'		=> _x('Kaya Slider','Kaya Slider', 'Kaya Slider'),
		'add_new'			=> _x('Add New Post', 'Slider Listing','slider'),
		'add_new_item'		=> __('Add New Post','slider'),
		'edit_item'			=> __('Edit Post','slider'),
		'new_item'			=> __('New Slider Post Item','slider'),
		'view_item'			=> __('View slider Item','slider'),
		'search_items'		=> __('Search Slider Items','slider'),
		'not_found'			=> __('Nothing found','slider'),
		'not_found_in_trash'=> __('Nothing found in Trash','slider'),
		'parent_item_colon'	=> ''
	);
	

$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'exclude_from_search'=> false,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'rewrite'			=> array( 'with_front' => false ),
		'query_var'			=> false,	
	'menu_icon' => get_stylesheet_directory_uri() . '/lib/images/kaya_slider.png',		
		'supports'			=> array('title', '', '', 'thumbnail', '', '')
	); 
	register_post_type( 'slider' , $args );
	register_taxonomy_for_object_type('post_tag', 'slider');
}
	register_taxonomy("slider_category", 'slider', array(
	'hierarchical'		=> true,
	'label'				=> 'Slider Categories',
	'singular_label'	=> 'Slider Categories',
	'show_ui'			=> true,
	'query_var'			=> true,
	'rewrite'			=> false,
	)
);
	
add_action('init', 'kaya_home_slider');

function slider_columns($columns) {
	$columns['slider_category'] = __('Category','atp_admin');
    $columns['thumbnail'] =  __('Post Image','atp_admin');

    return $columns;
}

function kaya_manage_slider_columns($name) {
    global $post;global $wp_query;
    switch ($name) {
	 case 'slider_category':
               $terms = get_the_terms($post->ID, 'slider_category');

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
   				//echo the_post_thumbnail(array(100,100));
				break;
       
    }
}
add_action('manage_posts_custom_column', 'kaya_manage_slider_columns', 10, 2);
add_filter('manage_edit-slider_columns', 'slider_columns');
?>
