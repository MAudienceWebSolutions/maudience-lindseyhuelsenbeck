<?php

// This file shows a demo for register meta boxes for ALL custom post types

add_action( 'admin_init', 'kaya_register_meta_boxes' );

function kaya_register_meta_boxes()
{
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	$prefix     = 'kaya_';
	$meta_boxes = array();

	$post_types = get_post_types();

	// 1st meta box
	$meta_boxes[] = array(
		'id'    => 'personal',
		'title' => __( 'Personal Information', 'rwmb' ),
		'pages' => $post_types,

		'fields' => array(
			array(
				'name' => __( 'Full name', 'rwmb' ),
				'id'   => $prefix . 'fname',
				'type' => 'text',
			),
			// Other fields go here
		)
	);
	// Other meta boxes go here

	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
