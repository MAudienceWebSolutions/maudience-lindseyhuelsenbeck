<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */
/********************* META BOX DEFINITIONS ***********************/
/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = '';
$meta_boxes = array();
/* ----------------------------------------------------- */
// Custom Background Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'page_custom_bg_img',
	'title'		=> __('Custom Background','haircare'),
	'pages' => array( 'page','portfolio','post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields'	=> array(
		array(
			'name'	=> __('Background Image','haircare'),
			'desc'	=> '',
			'id'	=> $prefix . 'page_custom_bg_img',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 1,
		),
		array(
			'name'		=> __('Position','haircare'),
			'id'		=> $prefix . 'bg_img_position',
			'type'		=> 'radio',
			'options'	=> array(
					'left'			=> __('Left','haircare'),
					'center'	=> __('Center','haircare'),
					'right'	=> __('Right','haircare'),
				),
				'multiple'	=> false,
				'std' =>  'center'
			),
		array(
			'name'		=> __('Repeat','haircare'),
			'id'		=> $prefix . 'bg_img_repeat',
			'type'		=> 'radio',
			'options'	=> array(
					'repeat'			=> __('Repeat','haircare'),
					'no-repeat'	=> __('No Repeat','haircare'),
					'cover' => __('Fit Screen', 'haircare')
				),
				'multiple'	=> false,
				'desc' =>  '',
				'std' =>  'no-repeat'
			),
				array(
			'name'		=> __('Attachemnt','haircare'),
			'id'		=> $prefix . 'bg_img_attachment',
			'type'		=> 'radio',
			'options'	=> array(
					'scroll'	=> __('Scroll','haircare'),
					'fixed'	=> __('Fixed','haircare'),
				),
				'multiple'	=> false,
				'desc' =>  '',
				'std' =>  'fixed'
			),

		)
);		*/
/* ----------------------------------------------------- */
// Page Settings
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pagesettings',
	'title' => __('Page Title bar Settings','haircare'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> __('Select Page Title Bar Style','haircare'),
			'id'		=> $prefix . "select_page_options",
			'type'		=> 'select',
			'options'	=> array(
				'page_title_setion'		=> __('Page Titlebar','haircare'),
				"singleimage" 	=> __("Parallax Header Image",'haircare'),
				'none' => __('None','haircare'),		
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		array(
				'name'		=> __('Custom Page Title','haircare'),
				'id'		=> $prefix . "kaya_custom_title",
				'type'		=> 'text',
				'std'		=> 'Enter page custom title',
				'std'		=> ''
		),
		array(
				'name'		=> __('Page Title Description','haircare'),
				'id'		=> $prefix . "kaya_custom_title_description",
				'type'		=> 'textarea',
				'std'		=> __('Enter page title description','haircare'),
				'std'		=> '',
				'cols' => 20,
				'rows' => 1,
		),
		
		array(
			'name'		=> __('Select Header Slider Type','haircare'),
			'id'		=> $prefix . "slider",
			'type'		=> 'select',
			'options'	=> array(
				"bxslider"	=> __("BX Slider",'haircare'),
				"customslider"	=> __("Slider Plugin Shortcode ",'haircare'),
												
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
// Video
	array(
			'name'		=> __('Slider Shortcode','haircare'),
			'id'		=> $prefix . 'customslider_type',
			'type'		=> 'text',
			'desc' => 'Ex: [customslider shortcode_name]'
			),
// Single Image Upload
	array(
			'name'	=> __('Parallax Bg Image','haircare'),
			'desc'	=> __('Select image and click "Insert into page".','haircare'),
			'id'	=> "Single_Image_Upload",
			'type'	=> 'image_advanced',
		),
		array(
			'name' => __( 'Background Position ', 'haircare' ),
			'id' => $prefix."single_img_attachment",
			'type' => 'radio',
			'options' => array(
			'fixed' => __( 'Fixed', 'haircare' ),
			'scroll' => __( 'Scroll', 'haircare' ),
			),
			'std' => 'fixed'
		),	
		array(
			'name'	=> __('Image Height ( px )<br><small>Ex:400-600</small>','haircare'),
			'desc'	=> __('<strong>Note:</strong> By default Screen height is displayed','haircare'),
			'id'	=> "Single_Image_height",
			'type'	=> 'text',
			'std' => '300'
		),
	array(
			'name'	=> __('Image Overlay Text ','haircare'),
			'desc'	=> __('Enter content like below html format <br />&lt;h2 style="color:#ffffff;font-size:3.5em;"&gt;Welcome To Hair Care &lt;/h2&gt; <br />
&lt;p  style="color:#ffffff;font-size:1.3em;"&gt;This is haircare Parallax Image Title description &lt;/p&gt;','haircare'),
		'id'	=> "Single_Image_content",
			'type'	=> 'textarea',
			'std' => ''
		),
	)
);

/* ----------------------------------------------------- */
// Gallery
/* -----------------------------------------------------
$meta_boxes[] = array(
	'id'		=> 'kaya_page_fullscreen_bg',
	'title'		=> __('Full screen Background Settings','haircare'),
	'pages'		=> array( 'page' , 'portfolio', 'post', 'slider', 'product' ),
	'context' => 'normal',

	'fields'	=> array(
		// Single Bg Image
		array(
			'name'	=> __('Upload Image','haircare'),
			'desc'	=> '',
			'id'	=> $prefix . 'full_screen_single_bg_image',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 1,
		),
		array(
			'name'		=> 'Background Repeat',
			'id'		=> $prefix . "single_bg_img_repeat",
			'type'		=> 'radio',
			'options'	=> array(
				"repeat" 	=> "Repeat",
				'no-repeat' => 'No Repeat',
				'cover' =>'Fit Screen size'
			),
			'multiple'	=> false,
			'desc'		=> ''
		),
		
		)
);
 */
/* ----------------------------------------------------- */
// Portfolio page Layout Options
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'my-page-layout',
	'title' => 'Portfolio Image Align Options',
	'pages' => array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'high',
		'fields' => array(
		array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( "rightsidebar" => "Images Align Left", "leftsidebar" => "Images Align Right", "full" => "Images Align Center")
		),
	)

);
*/
/* ----------------------------------------------------- */
// POrtfolio Info Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => __('General Options','haircare'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
		'fields' => array(
		array(
			'name' => __('Post Custom Title','haircare'),
			'desc' => '',
			'id' => $prefix . 'kaya_custom_title',
			'type' => 'text',
		),
		array(
			'name' => __('Post External link to','haircare'),
			'desc' => 'Ex: http://www.google.com',
			'id' => $prefix . 'Porfolio_customlink',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name'		=> __('Open In New Window','haircare'),
			'id'		=> $prefix . 'pf_link_new_window',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Related Posts','haircare'),
			'id'		=> $prefix . 'relatedpost',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> __('Display Related posts at the bottom of this post in Portfolio single page  <br /><strong>Note:</strong> <em>Related post displays based on tags</em>','haircare'),
		),
		
	)
);
/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_slides',
	'title'		=> __('Images / Video Section','haircare'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name'	=> __('Images','haircare'),
			'desc'	=> 'Upload up to 50 project images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image',
			'id'	=> $prefix . 'portfolio_slide',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 50,
		),
		array(
			'name'		=> __('Images Display Format','haircare'),
			'id'		=> $prefix . 'list_images',
			'type'		=> 'select',
			'options'	=> array(
					'slider'			=> __('Slider','haircare'),
					'isotope_gallery'	=> __('Masonry Gallery','haircare'),
					'grid_gallery'	=> __('Grid Gallery','haircare'),
					'listimg'			=> __('List Images','haircare'),
				),
				'multiple'	=> false,
				'desc' =>  ''
			),
		// Video
		array(
			'name'		=> __('Video Embed Code','haircare'),
			'id'		=> $prefix . 'video_embed_code',
			'type'		=> 'textarea',
			'desc' => __('Paste the video iframe embed code Ex: <br /> &lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; width=&quot;440&quot; height=&quot;248&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;','haircare'),
			),
		array(
			'name' => __('Images / Video Alignment','haircare'),
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( "rightsidebar" => __("Align Left",'haircare'), "leftsidebar" => __("Align Right",'haircare'), "full" => __("Align Center",'haircare')),
		),
	array(
			'name' => __('Enable Fullwidth Images','haircare'),
			'desc' => '',
			'id' => $prefix . 'kaya_fullwidth_images',
			'type' => 'checkbox',
			'std'	=> '',
		),	
		)
);
/* -----------------------------------------------------
// Light box video url
-----------------------------------------------------  */
$meta_boxes[] = array(
	'id'		=> 'lightbox_video_url',
	'title'		=> __('Light Box Video Url','haircare'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'low',
	'fields'	=> array(
		array(
			'name'		=> '',
			'id'		=> $prefix . 'video_url',
			'type'		=> 'text',
			'desc' => __('Youtube URL: http://www.youtube.com/watch?v=SZEflIVnhH8, Vimeo URL:http://vimeo.com/62022718 <br> Note: It support only for youtube & vimeo videos','haircare'),
			),
		
		)
);
/* ----------------------------------------------------- */
// Video Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_post_format_video',
	'title' => __('Video','haircare'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name' 	=> 	__('Add Iframe Video','haircare'),
			'id' 	=> 	$prefix . 'post_video',
			'type'	=> 	'textarea',
			'desc' 	=> 	'&lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;',
			'std' 	=> 	''	
		),	
	)
);

$meta_boxes[] = array(
	'id' => 'kaya_title_image_streatch',
	'title' => __('Blog Post Image Settings','haircare'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(

	/* Image Streached */
		array(
			'name' 	=> 	__('Disable Featured Image Stretch','haircare'),
			'id' 	=> 	$prefix .'kaya_image_streatch',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),		
		
	)
);
/* ----------------------------------------------------- */
// Gallery
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'kaya_post_format_gallery',
	'title'		=> __('Gallery Format','haircare'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Post Format Gallery','haircare'),
			'desc'	=> 'These images are displayed in Post single page, Upload up to 50 project images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image',
			'id'	=> $prefix . 'post_gallery',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 50,
		),
		array(
			'name' 	=> 	'Gallery Slider',
			'id' 	=> 	$prefix . 'kaya_gallery_slider',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
		)
);
/* ----------------------------------------------------- */
// Quote Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_quote_format_quote',
	'title' => __('Quote Format','haircare'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Quote','haircare'),
			'id' 	=> 	$prefix . 'kaya_quote_desc',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
	)
);
/* ----------------------------------------------------- */
// Audio Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_audio_format',
	'title' => __('Audio Format','haircare'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Audio Embed','haircare'),
			'id' 	=> 	$prefix . 'kaya_audio',
			'type'	=> 	'textarea',
			'desc' 	=> 	'Ex:<br />&lt;iframe width=&quot;100%&quot; height=&quot;100&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot; src=&quot;https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/14453926&amp;auto_play=false&amp;hide_related=false&amp;visual=true&quot;&gt;&lt;/iframe&gt;',
			'std' 	=> 	''	
		),	
	)
);
/* ----------------------------------------------------- */
// Link Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_link_format',
	'title' => __('Link Format','haircare'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Link','haircare'),
			'id' 	=> 	$prefix . 'kaya_link',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
	)
);

/* ----------------------------------------------------- */
// Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'slider-customlink',
	'title'		=> __('Slider Settings','haircare'),
	'pages'		=> array( 'slider' ),
	'context' => 'normal',
	'fields'	=> array(
	array(
			'name' => __('Slide Title Description','haircare'),
			'desc' => '',
			'id' => $prefix . 'slide_description',
			'type' => 'textarea',
			'std' => ''
		),
	array(
			'name' => __('Slide Text Color','haircare'),
			'desc' => 'Color for slide title and description',
			'id' => $prefix . 'slide_text_color',
			'type' => 'color',
			'std' => '#fff'
		),
	array(
			'name' => __('Disable Slide Title/Description','haircare'),
			'desc' => '',
			'id' => $prefix . 'disable_slide_content',
			'type' => 'checkbox',
			'std' => ''
		),
	array(
			'name' => __('Slide link','haircare'),
			'desc' => 'Ex: http://www.google.com',
			'id' => $prefix . 'customlink',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Open In New Window','haircare'),
			'desc' => '',
			'id' => $prefix . 'slider_target_link',
			'type' => 'checkbox',
			'std' => ''
		),
		)
	);
/* ----------------------------------------------------- */
// Fullscreen Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'kaya_page_fullscreen_bg',
	'title'		=> __('Full screen Background Settings','haircare'),
	'pages'		=> array( 'page' , 'portfolio', 'post', 'slider', 'product' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> 'Select Full Screen Bg Type',
			'id'		=> $prefix . "select_full_bg_type",
			'type'		=> 'select',
			'options'	=> array(
				"single_bg_image" 	=> "Single Image",
				'fullscreen_img_slider' => 'Image Slider',				
				"fullscreen_video_bg" 	=> "Video Background",
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		// Single Bg Image
		array(
			'name'	=> __('Upload Image','haircare'),
			'desc'	=> '',
			'id'	=> $prefix . 'full_screen_single_bg_image',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 1,
		),
		array(
			'name'		=> 'Repeat',
			'id'		=> $prefix . "single_bg_img_repeat",
			'type'		=> 'radio',
			'options'	=> array(
				"repeat" 	=> "Repeat",
				'no-repeat' => 'No Repeat',
				'cover' =>'Fit Screen size'
			),
			'multiple'	=> false,
			'desc'		=> '',
			'std' =>  'cover'
		),
		array(
			'name'		=> __('Position','haircare'),
			'id'		=> $prefix . 'bg_img_position',
			'type'		=> 'radio',
			'options'	=> array(
					'left'			=> __('Left','haircare'),
					'center'	=> __('Center','haircare'),
					'right'	=> __('Right','haircare'),
				),
				'multiple'	=> false,
				'std' =>  'center'
			),
		array(
			'name'		=> __('Attachemnt','haircare'),
			'id'		=> $prefix . 'bg_img_attachment',
			'type'		=> 'radio',
			'options'	=> array(
					'scroll'	=> __('Scroll','haircare'),
					'fixed'	=> __('Fixed','haircare'),
				),
				'multiple'	=> false,
				'desc' =>  '',
				'std' =>  'fixed'
			),
		// Image Slider
		array(
			'name'	=> __('Full Screen Slider Images','haircare'),
			'desc'	=> 'These images are displayed as Full screen Background slider.',
			'id'	=> $prefix . 'full_screen_bg_images',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 50,
		),
		array(
				'name' =>  __('Full Screen Bg Slide Transition','haircare'),
				'desc' => '',
				'id' => $prefix . 'full_screen_bg_transition',
				'type' => 'select',
				'std'	=> '6',
				'options' => array(
					'0' => 'None',
					'1' => 'Fade',
					'2' => 'Slide Top',
					'3' => 'Slide Right',
					'4' => 'Slide Bottom',
					'5' => 'Slide Left',
					'6' => 'Carousel Right',
					'7' => 'Carousel Left',
					),
			),
		array(
			'name'		=> 'Auto Play',
			'id'		=> $prefix . "full_screen_auto_play",
			'type'		=> 'select',
			'options'	=> array(
				'1'  	=> 'True',
				"0" 	=> "False",	
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),
		array(
			'name'	=> __('Disable Slide Title','haircare'),
			'id'	=> $prefix . 'disable_slide_title',
			'type'	=> 'checkbox',
		),
		// Video Slider
		array(
			'name'		=> 'You Tube Video ID',
			'id'		=> $prefix . 'fullscreen_bg_video',
			'type'		=> 'text',
			'desc' => 'Ex: iU8iA7jfrIg<br /> <img src="'.get_template_directory_uri().'/images/video_id.jpg"><br />
						<strong>Note : </strong> It works  youtube video id only'
			),
		array(
			'name'		=> __('Audio','haircare'),
			'id'		=> $prefix . 'background_audio',
			'type'		=> 'radio',
			'options'	=> array(
					'false'	=> __('On ','haircare'),
					'true'	=> __('Off','haircare'),
				),
				'multiple'	=> false,
				'desc' =>  '',
				'std' =>  'true'
			),
		array(
			'name'	=> __('Disable Page Content Background','haircare'),
			'id'	=> $prefix . 'disable_page_bg',
			'type'	=> 'checkbox',
		),
		array(
			'name'	=> __('Disable Backround Overlay Opacity','haircare'),
			'id'	=> $prefix . 'disable_img_opacity',
			'type'	=> 'checkbox',
		),

		)
);

/********************* META BOX REGISTERING ***********************/
/**
 * Register meta boxes
 *
 * @return void
 */
function kaya_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'kaya_register_meta_boxes' );