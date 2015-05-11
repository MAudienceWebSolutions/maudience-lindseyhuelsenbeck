<?php
// Home Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Sidebar',
			'id'            => 'Sidebar',
			'description' => esc_html__('A widget area, used as a sidebar for Homepage', 'haircare'),			
				'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',		
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			));
// Bottom Footer Section 1st Widget Area
if ( function_exists('register_sidebar') )
	register_sidebar(
	array(
		'name'=>'Overlay Container Column 1',
		'id'            => 'footer_column_1',
		'description' => esc_html__('A widget area, used as the 1st column in the Footer Section.', 'haircare'),
		'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
		'after_widget' => '</div> ',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
// Bottom Footer Section 2nd Widget Area
if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Overlay Container Column 2',
			'id'            => 'footer_column_2',
			'description' => esc_html__('A widget area, used as the 2nd column in the Footer Section.', 'haircare'),
			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		
// Bottom Footer Section 3rd Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Overlay Container Column 3',
			'id'            => 'footer_column_3',
			'description' => esc_html__('A widget area, used as the 3rd column in the Footer Section.', 'haircare'),
			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		
// Bottom Footer Section 4th Widget Area
if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Overlay Container Column 4',
			'id'            => 'footer_column_4',
			'description' => esc_html__('A widget area, used as the Fourth column in the Footer Section.', 'haircare'),
			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

// Bottom Footer Section 5th Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Overlay Container Column 5',
		'id'            => 'footer_column_5',
		'description' => esc_html__('A widget area, used as the Fifth column in the Footer Section.', 'haircare'),
		'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));
		
?>