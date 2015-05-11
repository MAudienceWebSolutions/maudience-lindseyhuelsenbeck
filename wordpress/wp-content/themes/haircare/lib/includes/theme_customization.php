<?php
add_action('customize_register', 'kaya_customize_remove');
function kaya_customize_remove($wp_customize) {
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'nav' );
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->remove_section( 'background_image' );
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'sidebar-widgets-Sidebar' );
    $wp_customize->remove_section( 'sidebar-widgets-footer_column_1' );
    $wp_customize->remove_section( 'sidebar-widgets-footer_column_2' );
    $wp_customize->remove_section( 'sidebar-widgets-footer_column_3' );
    $wp_customize->remove_section( 'sidebar-widgets-footer_column_4' );
    $wp_customize->remove_section( 'sidebar-widgets-footer_column_5' );
	}

  function kaya_customize_register( $wp_customize ){
   	class Kaya_Customize_Subtitle_control extends WP_Customize_control{
   			public $type = 'sub-title';
   			public function render_content(){
   				echo '<h4 class="customizer_sub_section">'.esc_html($this->label).'</h4>';
   			}
   		}
   	class Kaya_Customize_Textarea_Control extends WP_Customize_control{
   		public $type = 'text-area';
   		public function render_content(){ ?>
   			<label class="customize-control-title"> <?php echo esc_html( $this->label ); ?></label>
   			<textarea rows="6" width="100%" <?php $this->link(); ?> ><?php echo esc_textarea( $this->value() ); ?></textarea>
   		<?php }
   	}
   	class Kaya_Customize_Description_Control extends WP_Customize_Control{
   		public $type = 'description';
   		public function render_content(){
   			echo '<span class="title_description">'.esc_html( $this->label ).'</span>';
   		}
   	}
   
   	class Kaya_Customize_Multiselect_Control extends WP_Customize_Control
   		{
   			public $type = 'multi-select';
   			public function render_content()
   			{ ?>
   				<label class="customize-control-title"><?php echo esc_html($this->label); ?></label>
   				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
   					<?php
   						foreach ( $this->choices as $value => $label ) {
   							$selected = ( in_array($value, $this->value()) ) ? selected(1,1,false) : '';
   							echo '<option value="'.esc_attr( $value ).'" '.$selected.'>'.$label.'</option>';	
   						}

   					?>
   				</select>	
   		<?php }
   		}
   	class Kaya_Customize_Images_Radio_Control extends WP_Customize_Control {
			public $type = 'img_radio';
			public function render_content() {
			if ( empty( $this->choices ) )
			return;
			$name = 'customize-image-radios-' . $this->id;	 ?>
			
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php foreach ( $this->choices as $value => $label ) { ?>
				<?php $selected = ( $this->value() == $value ) ? 'kaya-radio-img-selected' : ''; ?>
				<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="kaya-radio-img <?php echo $selected; ?>">
				<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="img_radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				<img src="<?php echo $label['img_src']; ?>" alt="" />
				</label>
			<?php
			} // end foreach
		}	
  	 }
	}
add_action('customize_register','kaya_customize_register');
/*-----------------------------------------------------------------------------------*/
/* Layout Mode section */
/*-----------------------------------------------------------------------------------*/ 
function theme_layout_mode( $wp_customize ) {
     $wp_customize->add_panel( 'theme_layout_mode_panel', array(
      'priority'       => 0,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Layout Mode', 'haircare' ),
      'description'    => '',
  ) );
$wp_customize->add_section(
  // ID
  'theme-layout-mode',
  // Arguments array
  array(
    'title' => __( 'Layout Mode', 'haircare' ),
    'priority'       => 1,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_layout_mode_panel'
    //'description' => __( '', 'haircare' )
  ));
$wp_customize->add_setting( 'theme_layout_mode',
    array( 
      'default' => 'fluid_container'
    ));
  $wp_customize->add_control( 'theme_layout_mode',
    array(
    'label' => __('Layout Mode','haircare'),
    'section' => 'theme-layout-mode',
    'priority' => 1,
    'type' => 'radio',
    'choices' => array(
      'fluid_container' => __('Full Width','haircare'),
      'boxed_container' => __('Boxed','haircare') 
      )
    )
    );
$wp_customize->add_setting('layout_position',
  array(
    'deafult' => 'center',
    ));
$wp_customize->add_control('layout_position',
  array(
    'label' => __('Layout Position','haircare'),
    'capability' => 'edit_theme_options', 
    'section' => 'theme-layout-mode',
    'priority' => 2,
    'type' => 'radio',
    'choices' => array(
      'left' => __('Left','haircare'),
      'right' => __('Right','haircare'),
      'center' => __('Center','haircare')
      )
    ));
    $wp_customize->add_setting( 'responsive_layout_mode',
    array( 
      'default' => 'on'
    ));
  $wp_customize->add_control( 'responsive_layout_mode',
    array(
    'label' => __('Responsive Mode','haircare'),
      'section' => 'theme-layout-mode',
    'priority' => 3,
    'type' => 'radio',
    'choices' => array(
      'on' => __('On','haircare'),
      'off' => __('Off','haircare')  
      )
    )
    );
  }
add_action( 'customize_register', 'theme_layout_mode' );
/*-----------------------------------------------------------------------------------*/
/* Page Custom Background section */
/*-----------------------------------------------------------------------------------*/ 
function page_custom_bg_section( $wp_customize ) {
     $wp_customize->add_panel( 'page_custom_bg_section_panel', array(
      'priority'       => 0,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Page Custom Background Settings', 'haircare' ),
      'description'    => '',
  ) );
    $wp_customize->add_section(
  // ID
  'page_custom_bg_section',
  // Arguments array
  array(
    'title' => __( 'Page Custom Background Settings', 'haircare' ),
    'priority'       => 1,
    'capability' => 'edit_theme_options',
    'panel' => 'page_custom_bg_section_panel'
    //'description' => __( '', 'haircare' )
  ));

  $wp_customize->add_setting('page_custom_img[bg_image]',array(
      'default' => '',
       'capability'   => 'edit_theme_options',
        'type'       => 'option',
      ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control($wp_customize,'page_custom_img',array(
        'label' => __('Upload Image','haircare'),
        'section' => 'page_custom_bg_section',
        'settings' => 'page_custom_img[bg_image]',
        'priority' => 1
        ))); 

    $wp_customize->add_setting('bg_image_position', array(
      'default' => 'right'
    ));      
    $wp_customize->add_control('bg_image_position',array(
    'label' => __('Position','haircare'),
    'type' => 'radio',
    'section' => 'page_custom_bg_section',
    'choices' => array(
      'left' => __('Left','haircare'),
      'center' => __('Center','haircare'),
      'right' => __('Right','haircare')
      ),
    'priority' => 2
  ));
    $wp_customize->add_setting('bg_image_repeat', array(
      'default' => 'cover'
    ));      
    $wp_customize->add_control('bg_image_repeat',array(
    'label' => __('Repeat','haircare'),
    'type' => 'radio',
    'section' => 'page_custom_bg_section',
    'choices' => array(
      'repeat' => __('Repeat','haircare'),
      'no-repeat' => __('No Repeat','haircare'),
      'cover' => __('Fit Screen','haircare')
      ),
    'priority' => 3
  ));
    $wp_customize->add_setting('bg_image_attachment', array(
      'default' => 'fixed'
    ));      
    $wp_customize->add_control('bg_image_attachment',array(
    'label' => __('Attachment','haircare'),
    'type' => 'radio',
    'section' => 'page_custom_bg_section',
    'choices' => array(
      'scroll' => __('scroll','haircare'),
      'fixed' => __('Fixed','haircare'),
      ),
    'priority' => 3
  ));
  $wp_customize->add_setting('bg_image_pattern_disable', array(
      'default' => ''
    ));
  $wp_customize->add_control('bg_image_pattern_disable',array(
    'label' => __('Disable Overlay Pattern','haircare'),
    'type' => 'checkbox',
    'section' => 'page_custom_bg_section',
    'priority' => 4
  ));
  }
add_action( 'customize_register', 'page_custom_bg_section' );

//End

/*-----------------------------------------------------------------------------------*/
/* Header section */
/*-----------------------------------------------------------------------------------*/ 
function header_section( $wp_customize ) {
     $wp_customize->add_panel( 'header_section_panel', array(
      'priority'       => 1,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Header Section', 'haircare' ),
      'description'    => '',
  ) );
		$wp_customize->add_section(
	// ID
	'header-section',
	// Arguments array
	array(
		'title' => __( 'Header Section', 'haircare' ),
		'priority'       => 4,
		'capability' => 'edit_theme_options',
    'panel' => 'header_section_panel'
		//'description' => __( '', 'haircare' )
	));
    $wp_customize->add_setting('upload_header[bg_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'bg_image', array(
        'label'    => __('Header BG Image', 'themename'),
        'section'  => 'header-section',
        'settings' => 'upload_header[bg_image]',
    'priority' => 1
    )));

 $wp_customize->add_setting('backgroundbg_repeat',
  array(
    'deafult' => 'no-repeat',
    ));
$wp_customize->add_control('backgroundbg_repeat',
  array(
    'label' => __('Background Repeat','haircare'),
    'capability' => 'edit_theme_options', 
    'section' => 'header-section',
    'priority' => 2,
    'type' => 'radio',
    'choices' => array(
      'no-repeat' => __('No Repeat','haircare'),
      'repeat' => __('Repeat','haircare')
      )
    ));

 $wp_customize->add_setting( 'header_bg_color',
    array( 
      'default' => ''
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'header_bg_color',
    array(
      'label' => __('Header Background Color','haircare'),
      'section' => 'header-section',
      'priority' => 3,
      'type' => 'color',
    ))); 
   $wp_customize->add_setting('kaya_logo_type', array(
    'default' => 'img_logo',
  ));
$wp_customize->add_control('kaya_logo_type',array(
    'label' => __('Choose Logo Type','haircare'),
    'type' => 'radio',
    'section' => 'header-section',
    'choices' => array(
      'text_logo' => __('Text Logo','haircare'),
      'img_logo' => __('Image Logo','haircare')
      ),
    'priority' => 4
  ));  
  $wp_customize->add_setting( 'logo_section_title' );
  $url=get_template_directory_uri();
  $wp_customize->add_setting('logo[upload_logo]', array(
        'default'           => $url.'/images/logo.png',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_logo', array(
        'label'    => __('Upload Logo Image', 'haircare'),
        'section'  => 'header-section',
        'settings' => 'logo[upload_logo]',
		'priority' => 7
    )));

    $wp_customize->add_setting('text_logo',
    array(
        'default' => 'Hair Care',
    ));

$wp_customize->add_control(
    'text_logo',
    array(
        'label' => 'Text Logo',
        'section' => 'header-section',
        'type' => 'text',
    'priority' => 30,
    ));
$wp_customize->add_setting('text_logo_font_size',
    array(
        'default' => '40',
    ));

$wp_customize->add_control(
    'text_logo_font_size',
    array(
        'label' => 'Logo Font Size ( px )',
        'section' => 'header-section',
        'type' => 'text',
    'priority' => 40,
    ));

$wp_customize->add_setting('text_logo_font_color',
    array(
        'default' => '#333333',
    ));

$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_logo_font_color',
    array(
        'label' => 'Logo Font Color',
      'section' => 'header-section',
        'type' => 'color',
    'priority' => 50,
    )));
$wp_customize->add_setting(
    'text_logo_font_family',
    array(
        'default' => '',
    )
);
  $wp_customize->add_control(
    'text_logo_font_family',
    array(
        'label' => 'Enter Google font for Logo',
       'section' => 'header-section',
        'type' => 'text',
    'priority' => 60,
    )
);

  $wp_customize->add_setting( 'logo_desc', array(
        'default' => ''
    ));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'logo_desc', array(
      'label'    => __( 'Logo Description', 'haircare' ),
      'section' => 'header-section',
      'settings' => 'logo_desc',
      'priority' => 80,
      'type' => 'text-area',
      ))  );

    $wp_customize->add_setting( 'logo_desc_sample' );
  $wp_customize->add_control(
    new Kaya_Customize_Description_Control( $wp_customize, 'logo_desc_sample', array(
      'label'    => __( 'Beauty Hair Salon', 'haircare' ),
     'section' => 'header-section',
      'settings' => 'logo_desc_sample',
      'priority' => 91
    ))
  );
  
$wp_customize->add_setting( 'logo_desc_text_color',array(
    'default' => '#eee'
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'logo_desc_text_color', array(
      'label'    => __( 'Logo Description Color', 'haircare' ),
     'section' => 'header-section',
      'settings' => 'logo_desc_text_color',
      'priority' => 110,
      'type' => 'color',
      ))  );



  /*
    // Colors Options 
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'header-section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
}
*/
	}
add_action( 'customize_register', 'header_section' );
/*-----------------------------------------------------------------------------------*/
/* Menu  color section */
/*-----------------------------------------------------------------------------------*/ 
function menu_color_section( $wp_customize ) {
    $wp_customize->add_panel( 'menu_panel_section', array(
      'priority'       => 5,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Menu Color Section', 'haircare' ),
      'description'    => '',
  ) );
    $wp_customize->add_section(
  // ID
  'menu-color-section',
  // Arguments array
  array(
    'title' => __( 'Menu Links Color Settings', 'haircare' ),
    'priority'       => 5,
    'capability' => 'edit_theme_options',
    'panel' => 'menu_panel_section'
    //'description' => __( '', 'haircare' )
  )
);
$colors = array();
 $wp_customize->add_setting('menu_bar[menu_bg_img]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option'
      ));
     $wp_customize->add_control(
      new WP_Customize_Image_Control($wp_customize,'menu_bar',array(
        'label' =>  __('Upload BG Image','haircare'),
        'section' => 'menu-color-section',
        'settings' => 'menu_bar[menu_bg_img]',
        'priority' => 1
        )));
     $wp_customize->add_setting('menu_bar_bg_repeat',
  array(
    'deafult' => 'repeat',
    ));
  $wp_customize->add_control('menu_bar_bg_repeat',
  array(
    'label' => __('Background Repeat','haircare'),
    'capability' => 'edit_theme_options', 
  'section' => 'menu-color-section',
    'priority' => 2,
    'type' => 'radio',
    'choices' => array(
      'no-repeat' => __('No Repeat','haircare'),
      'repeat' => __('Repeat','haircare')
      )
    )); 
$colors[] = array(
    'slug'=>'menubg_color',
    'priority' => 3,
    'default' => '',
    'label' => __('Menubar Background Color', 'haircare'),
  );
$colors[] = array(
    'slug'=>'menu_link_color',
    'priority' => 4,
    'default' => '#ffffff',
    'label' => __('Menu Links Color', 'haircare'),
  );
  $colors[] = array(
    'slug'=>'menu_link_hover_text_color',
    'default' => '#1abc9c',
    'label' => __('Menu Hover Links color', 'haircare'),
    'priority' => 5
  );
  $colors[] = array(
    'slug'=>'menu_link_active_color',
    'priority' => 6,
    'default' => '#1abc9c',
    'label' => __('Menu Active Links Color', 'haircare'),
  );
  $wp_customize->add_setting( 'submenu_title_info' );
  $wp_customize->add_control(
      new Kaya_Customize_Subtitle_control( $wp_customize, 'submenu_title_info', array(
        'label'    => __( 'Child Menu Settings', 'haircare' ),
        'section' => 'menu-color-section',
        'settings' => 'submenu_title_info',
        'priority' => 7
    )));
  $colors[] = array(
    'slug'=>'sub_menu_bg_color',
    'default' => '#fff',
    'label' => __('Menu BG Color', 'haircare'),
    'priority' => 8
  );
  $colors[] = array(
    'slug'=>'sub_menu_link_color',
    'default' => '#4f4f4f',
    'label' => __('Links Color', 'haircare'),
    'priority' => 9
  );
  $colors[] = array(
    'slug'=>'sub_menu_bottom_border_color',
    'default' => '#eaeaea',
    'label' => __('Border Bottom Color', 'haircare'),
    'priority' => 10
  );
  $colors[] = array(
    'slug'=>'sub_menu_link_hover_bg_color',
    'default' => '#fff',
    'label' => __('Hover Background Color', 'haircare'),
    'priority' => 20
  );
      $colors[] = array(
    'slug'=>'sub_menu_link_hover_color',
    'default' => '#1abc9c',
    'label' => __('Links Hover Color', 'haircare'),
    'priority' => 21
  );
  $colors[] = array(
    'slug'=>'sub_menu_active_bg_color',
    'default' => '#e8e8e8',
    'label' => __('Link Active BG Color', 'haircare'),
    'priority' => 22
  );
  $colors[] = array(
    'slug'=>'sub_menu_link_active_color',
    'default' => '#1abc9c',
    'label' => __('Link Active Color', 'haircare'),
    'priority' => 23
  );
      // Colors Options 
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'menu-color-section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
  }
}
  add_action( 'customize_register', 'menu_color_section' );
/*-----------------------------------------------------------------------------------*/
/* Page right color section */
/*-----------------------------------------------------------------------------------*/ 
function page_color_section( $wp_customize ) {
    $wp_customize->add_panel( 'page_color_panel', array(
      'priority'       => 5,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'page Section', 'haircare' ),
      'description'    => '',
  ) );
    $wp_customize->add_section(
  // ID
  'page-color-section',
  // Arguments array
  array(
    'title' => __( 'Page Title bar  Section', 'haircare' ),
    'priority'       => 5,
    'capability' => 'edit_theme_options',
    'panel' => 'page_color_panel'
    //'description' => __( '', 'haircare' )
  )
);
  $url=get_template_directory_uri().'/images/'; 
  $wp_customize->add_setting('page_title_bar[bg_img]',array(
      'default' =>  $url.'top-opc.png',
      'capability' => 'edit_theme_options',
      'type' => 'option'
      ));
     $wp_customize->add_control(
      new WP_Customize_Image_Control($wp_customize,'page_title_bar',array(
        'label' =>  __('Upload BG Image','haircare'),
        'section' => 'page-color-section',
        'settings' => 'page_title_bar[bg_img]',
        'priority' => 1
        )));
     $wp_customize->add_setting('page_title_bar_bg_repeat',
  array(
    'deafult' => 'repeat',
    ));
  $wp_customize->add_control('page_title_bar_bg_repeat',
  array(
    'label' => __('Background Repeat','haircare'),
    'capability' => 'edit_theme_options', 
    'section' => 'page-color-section',
    'priority' => 2,
    'type' => 'radio',
    'choices' => array(
      'no-repeat' => __('No Repeat','haircare'),
      'repeat' => __('Repeat','haircare')
      )
    )); 
  $wp_customize->add_setting( 'page_title_bg_color',
    array( 
      'default' => ''
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
      $wp_customize, 'page_title_bg_color',
    array(
      'label' => __('Background Color','haircare'),
      'section' => 'page-color-section',
      'priority' => 3,
      'type' => 'color',
    )));
  $wp_customize->add_setting( 'page_titlebar_title_color',
    array( 
      'default' => '#333333'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'page_titlebar_title_color',
    array(
      'label' => __('Title Color','haircare'),
      'section' => 'page-color-section',
      'priority' => 4,
      'type' => 'color',
    ))); 
}
add_action( 'customize_register', 'page_color_section' );
// page mid content section
function page_mid_content($wp_customize){
      $wp_customize->add_section(
  // ID
  'page_mid_content',
  // Arguments array
  array(
    'title' => __( 'Page Middle Content Settings', 'haircare' ),
    'priority'       => 6,
    'capability' => 'edit_theme_options',
    'panel' => 'page_color_panel',
    'description' => __( '<strong style="color:red;"> Note: </strong>Color applies for overlap container button background color, titles border botttom strip color, single page slider arrows BG hover, blog single page post info icons and etc...', 'haircar' )
  )
);

  $wp_customize->add_setting('page_content_bg[bg_img]',array(
      'default' =>  '',
      'capability' => 'edit_theme_options',
      'type' => 'option'
      ));
     $wp_customize->add_control(
      new WP_Customize_Image_Control($wp_customize,'page_content_bg',array(
        'label' =>  __('Upload BG Image','haircare'),
        'section'  => 'page_mid_content',
        'settings' => 'page_content_bg[bg_img]',
        'priority' => 6
        )));

    $wp_customize->add_setting('page_content_bg_repeat',
  array(
    'deafult' => 'repeat',
    ));
  $wp_customize->add_control('page_content_bg_repeat',
  array(
    'label' => __('Background Repeat','haircare'),
    'capability' => 'edit_theme_options', 
  'section'  => 'page_mid_content',
    'priority' => 7,
    'type' => 'radio',
    'choices' => array(
      'no-repeat' => __('No Repeat','haircare'),
      'repeat' => __('Repeat','haircare')
      )
    )); 
    $colors[] = array(
    'slug'=>'page_bg_color',
    'default' => '',
    'label' => __('Background Color', 'haircare'),
    'priority' => 8
    );

    $colors[] = array(
    'slug'=>'page_titles_color',
    'default' => '#5b5b5b',
    'label' => __('Title Color', 'haircare'),
    'priority' => 9
    );
    $colors[] = array(
    'slug'=>'page_description_color',
    'default' => '#8e8e8e',
    'label' => __('Content Color', 'haircare'),
    'priority' => 10
    );
    $colors[] = array(
    'slug'=>'page_link_color',
    'default' => '#21abce',
    'label' => __('Link Color', 'haircare'),
    'priority' => 11
    );
    $colors[] = array(
    'slug'=>'page_link_hover_color',
    'default' => '#bf1952',
    'label' => __('Link Hover Color', 'haircare'),
    'priority' => 12
    );
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section'  => 'page_mid_content',
      'settings' => $color['slug'])
    )
  );
}
}
add_action( 'customize_register', 'page_mid_content' );
//Page Sidebar 
function page_sidebar_content($wp_customize){
      $wp_customize->add_section(
  // ID
  'page_sidebar_content',
  // Arguments array
  array(
    'title' => __( 'Page Sidebar Color Settings', 'haircare' ),
    'priority'       => 6,
    'capability' => 'edit_theme_options',
    'panel' => 'page_color_panel',
    //'description' => __( '<strong style="color:red;"> Note: </strong>Color applies for overlap container button background color, titles border botttom strip color, single page slider arrows BG hover, blog single page post info icons and etc...', 'haircar' )
  )
);

  $colors[] = array(
    'label' => 'Title Color',
    'default' => '#353535',
    'priority' => 14  ,
    'slug' => 'sidebar_title_color',
    'capability' => 'edit_theme_options'
    );
  $colors[] = array(
      'label' => __('Content Color','haircare'),
      'slug' => 'sidebar_content_color',
      'priority' => 15,
      'default' => '#454545',
      'capability' => 'edit_theme_options'
    );
  $colors[] = array(
      'label' => __('Link Color','haircare'),
      'slug' => 'sidebar_link_color',
      'priority' => 16,
      'capability' => 'edit_theme_options',
      'default' => '#21abce'
    );
  $colors[] = array(
      'label' => __('Link Hover Color','haircare'),
      'slug' => 'sidebar_link_hover_color',
      'default' => '#bf1952',
      'priority' => 17,
      'capability' => 'edit_theme_options'
    );  
  
  foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section'  => 'page_sidebar_content',
      'settings' => $color['slug'])
    )
  );
}
}
add_action( 'customize_register', 'page_sidebar_content' );


// Page Title color Settings

function page_titlebar_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'page-titlebar-section',
	// Arguments array
	array(
		'title' => __( 'Page Titlebar Settings', 'haircare' ),
		'priority'       => 7,
		'capability' => 'edit_theme_options',
		//'description' => __( '', 'haircare' )
	)
);

    $colors[] = array(
	'slug'=>'page_titlebar_bg_color',
	'default' => '#f7f7f7',
	'label' => __('Background Color', 'haircare'),
	'priority' => 2
);

 // Page title bar title Color
    $colors[] = array(
	'slug'=>'page_titlebar_title_color',
	'default' => '#3A3A3A',
	'label' => __('Title Color', 'haircare'),
	'priority' => 3
);
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'page-titlebar-section',
			'settings' => $color['slug'])

		)
	);
}


}
/*-----------------------------------------------------------------------------------*/
/* Portfolio Thumbnail Color Settings */
/*-----------------------------------------------------------------------------------*/ 
function portfolio_thumbnail_color($wp_customize){
     $wp_customize->add_panel( 'portfolio_thumbnail_color_panel', array(
      'priority'       => 5,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Portfolio Section', 'haircare' ),
      'description'    => '',
  ) );

     
  $wp_customize->add_section(
    'pf_page_section', 
    array(
      'title' => 'Portfolio Category Section',
      'priority' => '5',
      'capability' => 'edit_theme_options',
      'panel' => 'portfolio_thumbnail_color_panel'
    )
    );

    $wp_customize->add_setting('pf_slug_name', array(
      'default' => 'portfolio'
    ));
  $wp_customize->add_control('pf_slug_name',array(
    'label' => __('Portfolio Slug Name','haircare'),
    'type' => 'text',
    'section' => 'pf_page_section',
    'priority' => 0
  ));
$wp_customize->add_setting( 'pf_slug_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_slug_note', array(
      'label'    => __( 'Note: Please make sure that the permalinks to be updated by navigating to "Settings > Permalinks" select post and save changes to avoid 404 error page.', 'haircare' ),
      'section'  => 'pf_page_section',
      'settings' => 'pf_slug_note',
      'priority' => 1
    ))
  );
 
  $wp_customize->add_setting('pf_related_post_title', array(
      'default' => 'Related Post'
    ));
  $wp_customize->add_control('pf_related_post_title',array(
    'label' => __('Related Post Title','haircare'),
    'type' => 'text',
    'section' => 'pf_page_section',
    'priority' => 5
  ));
  $wp_customize->add_setting('pf_related_images_height', array(
      'default' => '500'
    ));
  $wp_customize->add_control('pf_related_images_height',array(
    'label' => __('Related Post Thumbnail Height','haircare'),
    'type' => 'text',
    'section' => 'pf_page_section',
    'priority' => 6
  ));
      $wp_customize->add_setting('pf_related_post_scroll', array(
      'default' => 'false'
    ));
      $wp_customize->add_control('pf_related_post_scroll',array(
    'label' => __('Post Items Auto play','haircare'),
    'type' => 'radio',
    'section' => 'pf_page_section',
    'choices' => array(
      'true' => __('True','haircare'),
      'false' => __('False','haircare'),
      ),
    'priority' =>7
  ));

    $wp_customize->add_setting( 'pf_category_menu_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_category_menu_note', array(
      'label'    => __( 'Note: Use this section when you use "Portfolio Categories" in menu bar', 'haircare' ),
      'section'  => 'pf_page_section',
      'settings' => 'pf_category_menu_note',
      'priority' => 11
    )));
    $wp_customize->add_setting('pf_page_sidebar', array(
      'default' => 'fullwidth'
    ));
      $wp_customize->add_control('pf_page_sidebar',array(
    'label' => __('Category Page Layout','haircare'),
    'type' => 'radio',
    'section' => 'pf_page_section',
    'choices' => array(
      'fullwidth' => __('No Sidebar','haircare'),
      'two_third' => __('Right','haircare'),
      'two_third_last' => __('Left','haircare')
      ),
    'priority' => 12
  ));
    $wp_customize->add_setting(
    'pf_thumbnail_columns',
    array(
        'default' => '4',
    )
);
    $wp_customize->add_control(
    'pf_thumbnail_columns',
    array(
        'type' => 'select',
        'label' => 'Select Columns',
        'section' => 'pf_page_section',
        'choices' => array(
           '4' => __('4 Columns','haircare'),
           '3' => __('3 Columns','haircare'),
          '2' => __('2 Columns','haircare'),
          ),
    'priority' => 13,
    )
);

$wp_customize->add_setting('pf_images_height', array(
      'default' => '400'
    ));
  $wp_customize->add_control('pf_images_height',array(
    'label' => __('Thumbnail Height','haircare'),
    'type' => 'text',
    'section' => 'pf_page_section',
    'priority' => 16
  ));

      $wp_customize->add_setting('pf_enable_lightbox', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_enable_lightbox',array(
    'label' => __('Enable Lightbox','haircare'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 18
  ));
    $wp_customize->add_setting('pf_enable_title', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_enable_title',array(
    'label' => __('Disable Posts Title','haircare'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 18
  ));
  $wp_customize->add_setting( 'pf_posts_title_bg_color',
    array( 
      'default' => '#e7a802'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'pf_posts_title_bg_color',
    array(
      'label' => __('Thumbnail Background Color','haircare'),
      'section' => 'pf_page_section',
      'priority' => 19,
      'type' => 'color',
    )));  
  $wp_customize->add_setting( 'pf_posts_title_color',
    array( 
      'default' => '#333333'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'pf_posts_title_color',
    array(
      'label' => __('Thumbnail Title Color','haircare'),
      'section' => 'pf_page_section',
      'priority' => 20,
      'type' => 'color',
    ))); 

}
add_action('customize_register','portfolio_thumbnail_color');
/*-----------------------------------------------------------------------------------*/
// Blog Single Page
/*-----------------------------------------------------------------------------------*/ 
function blog_single_page_section( $wp_customize ){
  // Blog Page Categories
  $wp_customize->add_section('blog_page_section',array(
      'title' => __('Blog Page Section','haircare'),
      'priority' =>10,
    ));
    $wp_customize->add_setting('kaya_readmore_blog', 
    array(
        'default' => '',
    ));
$wp_customize->add_control(
    'kaya_readmore_blog',
    array(
        'label' => __('Readmore Button Text', 'haircare' ),
        'section' => 'blog_page_section',
        'type' => 'text',
        'priority' => 0,    
    ));
  $wp_customize->add_setting('blog_single_page_sidebar', array(
      'default' => 'two_third'
    ));
  $wp_customize->add_control('blog_single_page_sidebar',array(
    'label' => __('Blog Single Page Sidebar','haircare'),
    'type' => 'radio',
    'section' => 'blog_page_section',
    'choices' => array(
      'fullwidth' => __('No Sidebar','haircare'),
      'two_third' => __('Right','haircare'),
      'two_third_last' => __('Left','haircare')
      ),
    'priority' => 1
  ));

}
add_action('customize_register','blog_single_page_section');
/* overlap_container_section */
/*-----------------------------------------------------------------------------------*/ 
function overlap_container_section( $wp_customize ) {
     $wp_customize->add_panel( 'overlapcontainer_section', array(
      'priority'       => 20,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Overlap Container Section', 'haircare' ),
      'description'    => '',
  ) );
    $wp_customize->add_section(
  // ID
  'overlap_container_section',
  // Arguments array
  array(
    'title' => __( 'Overlap Container Section', 'haircare' ),
    'priority'       => 0,
    'capability' => 'edit_theme_options',
    'panel' => 'overlapcontainer_section'
    //'description' => __( '', 'haircare' )
  )
);
  $wp_customize->add_setting('disable_overlay_container', array(
      'default' => ''
    ));
  $wp_customize->add_control('disable_overlay_container',array(
    'label' => __('Disable Overlap Container','haircare'),
    'type' => 'checkbox',
    'section' => 'overlap_container_section',
    'priority' => 0
  ));
$colors = array();
  $colors[] = array(
    'slug'=>'overlap_container_border_color',
    'priority' => 1,
    'default' => '#1abc9c',
    'label' => __('Overlap Container Border Color', 'haircare'),
  );
  $colors[] = array(
    'slug'=>'overlap_container_border_icon_color',
    'priority' => 2,
    'default' => '#fff',
    'label' => __('Overlap Container Icon color', 'haircare'),
    );
$wp_customize->add_setting('overlap_widgte_columns',
  array(
    'deafult' => '0',
    ));
$src = get_template_directory_uri() . '/images/footer_columns/';
$wp_customize->add_control(
new Kaya_Customize_Images_Radio_Control(
$wp_customize,'overlap_widgte_columns',
  array(
    'label' => 'Display Columns',
    'section' => 'overlap_container_section',
    'priority' => 3,
      'type' => 'img_radio', // Image radio replacement
      'choices' => array(
        '1' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'fc1.png' ),
        '2' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'fc2.png' ),
        '3' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'fc3.png' ),
        '4' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'fc4.png' ),
        '5' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'fc5.png' ),
        'twothird' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'two_third_one_third.png' ),
        'onethird' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'one_third_two_third.png' ),
        'threefourth' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'three_fourth_one_fourth.png' ),
        'onefourth' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'one_fourth_three_fourth.png' ),
        'halffourth' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'two_fourth_fourth_fourth.png' ),
        'twofourth' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'fourth_fourth_two_fourth.png' ),
        'fifth_fifth' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'fifth_fifth_three_fifth.png' ),
        'three_fifth' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'three_fifth_fifth_fifth.png' ),
        'fifth_fifth_fifth' => array( 'label' => __( 'Col-2', 'haircare' ),'img_src' => $src . 'fifth_fifth_fifth_two_fifth.png' ),
        'two_fifth' => array( 'label' => __( 'Col-1', 'haircare' ),'img_src' => $src . 'two_fifth_fifth_fifth_fifth.png' ),
      ),  
    )));
$colors[] = array(
    'slug'=>'overlap_container_bg_color',
    'priority' => 4,
    'default' => '#222222',
    'label' => __('Background color', 'haircare'),
  );
  
  $colors[] = array(
    'slug'=>'overlap_container_title_color',
    'priority' => 5,
    'default' => '#ffffff',
    'label' => __('Title color', 'haircare'),
  );
  $colors[] = array(
    'slug'=>'overlap_container_text_color',
    'priority' => 6,
    'default' => '#ffffff',
    'label' => __('Text color', 'haircare'),
    );

  $colors[] = array(
    'slug'=>'overlap_container_link_color',
    'priority' => 7,
    'default' => '#333333',
    'label' => __('Link color', 'haircare'),
  );

    $colors[] = array(
    'slug'=>'overlap_container_hover_color',
    'priority' => 8,
    'default' => '#e7a802',
    'label' => __('Link Hover color', 'haircare'),
  );
    // Colors Options 
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'overlap_container_section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
  }
}
add_action( 'customize_register', 'overlap_container_section' );
/*---------------------------------------------------------------------*/
/*END*/
/*-----------------------------------------------------------------------------------*/
/* Bootom Footer color section */
/*-----------------------------------------------------------------------------------*/ 
function bottom_footer_section( $wp_customize ) {
     $wp_customize->add_panel( 'bottom_footer_panel', array(
      'priority'       => 30,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Bottom Footer Section', 'haircare' ),
      'description'    => '',
  ) );
    $wp_customize->add_section(
  // ID
  'bottom_footer_section',
  // Arguments array
  array(
    'title' => __( 'Bottom Footer Section', 'haircare' ),
    'priority'       => 13,
    'capability' => 'edit_theme_options',
    'panel' => 'bottom_footer_panel'
    //'description' => __( '', 'haircare' )
  )
);
   $wp_customize->add_setting('disable_footer_section', array(
      'default' => ''
    ));
  $wp_customize->add_control('disable_footer_section',array(
    'label' => __('Disable Footer Section','haircare'),
    'type' => 'checkbox',
    'section' => 'bottom_footer_section',
    'priority' => 0
  ));   
$wp_customize->add_setting('upload_footer[footer_bg_img]',array(
      'default' => '',
       'capability'   => 'edit_theme_options',
        'type'       => 'option',
      ));
  $wp_customize->add_setting( 'footer_copyrights',
  array(
    'default' => 'Copy rights &copy; kayapati.com'
    ));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'footer_copyrights', array(
      'label'    => __( 'Copy Right Information', 'haircare' ),
      'section'  => 'bottom_footer_section',
      'settings' => 'footer_copyrights',
      'priority' => 1,
      'type' => 'text-area',
      )) );
$wp_customize->add_control(
      new WP_Customize_Image_Control($wp_customize,'upload_footer',array(
        'label' => __('Upload Footer BG Image','haircare'),
        //'default' =>  
        'section' => 'bottom_footer_section',
        'settings' => 'upload_footer[footer_bg_img]',
        'priority' => 2
        ))); 
$wp_customize->add_setting('footer_bg_image_repeat', array(
      'default' => 'repeat'
    ));      
    $wp_customize->add_control('footer_bg_image_repeat',array(
    'label' => __('Background Image Repeat','haircare'),
    'type' => 'radio',
    'section' => 'bottom_footer_section',
    'choices' => array(
      'repeat' => __('Repeat','haircare'),
      'no-repeat' => __('No Repeat','haircare'),
      ),
    'priority' => 3
  ));  
$colors = array();
$colors[] = array(
    'slug'=>'footer_bg_color',
    'priority' => 4,
    'default' => '',
    'label' => __('Background color', 'haircare'),
  );
  
  $colors[] = array(
    'slug'=>'footer_text_color',
    'priority' => 6,
    'default' => '#fff',
    'label' => __('Text color', 'haircare'),
    );
    // Colors Options 
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'bottom_footer_section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
  }
}
add_action( 'customize_register', 'bottom_footer_section' );

/* Social Media Icons */
/*----------------------------------------------------------------------------------- */
function social_media_icons_section( $wp_customize ) {

    $wp_customize->add_section(
  // ID
  'social_media_icons',
  // Arguments array
  array(
    'title' => __( 'Social Media Icons', 'haircare' ),
    'priority'       => 14,
    'capability' => 'edit_theme_options',
    'panel' => 'bottom_footer_panel'
    //'description' => __( '', 'haircare' )
  )
);  
  for ($i=1; $i <= 10 ; $i++) { 


       $wp_customize->add_setting('icon_image_link_disable'.$i, array(
      'default' => ''
    ));
  $wp_customize->add_control('icon_image_link_disable'.$i,array(
     'label' => __('Disable Icon','haircare'),
    'type' => 'checkbox',
    'section' => 'social_media_icons',
    'priority' => (20 * $i) + 6
  ));

      $wp_customize->add_setting(  'icon_image_link'.$i );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_link'.$i, array(
      'label'    => 'http://www.socialmedia.com/userid',
      'section'  => 'social_media_icons',
      'settings' => 'icon_image_link'.$i,
      'priority' => (20 * $i) + 5,
    )));
    $wp_customize->add_setting(
    'right_social_icon_link_'.$i,
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_link_'.$i,
    array(
        'label' => __('Social Icon Image Link - ','haircare').$i,
         'section'  => 'social_media_icons',
        'type' => 'text',
        'priority' => (20 * $i) + 4,
    ));
    $wp_customize->add_setting(  'icon_image_url'.$i );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_url'.$i, array(
      'label'    => 'http://kayapati.com/demos/milan/wp-content/uploads/sites/21/2014/06/facebook.png',
      'section'  => 'social_media_icons',
      'settings' => 'icon_image_url'.$i,
      'priority' => (20 * $i) + 3,
    )));
  $wp_customize->add_setting(
    'right_social_icon_'.$i,
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_'.$i,
    array(
       'label' => __('Social Icon Image URL - ','haircare').$i,
         'section'  => 'social_media_icons',
        'type' => 'text',
        'priority' => (20 * $i) + 2,
    ));
    $wp_customize->add_setting( 'left_social_icon_border_'.$i );
  $wp_customize->add_control(
    new Kaya_Customize_Subtitle_control( $wp_customize, 'left_social_icon_border_'.$i , array(
      'label'    => '',
        'section'  => 'social_media_icons',
      'settings' => 'left_social_icon_border_'.$i,
      'priority' =>(20 * $i) + 1
    )));
}
$wp_customize->add_setting( 'overlap_container_social_icons_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'overlap_container_social_icons_note', array(
      'label'    => __( 'Note: Social media icons are displayed in "Overlay Container" bottom right section ', 'haircare' ),
      'section'  => 'social_media_icons',
      'settings' => 'overlap_container_social_icons_note',
      'priority' => 1
    ))
  );
}
add_action( 'customize_register', 'social_media_icons_section' );
//end
/*-----------------------------------------------------------------------------------*/
// Typography
/*-----------------------------------------------------------------------------------*/ 
function typography( $wp_customize ){
   $wp_customize->add_panel( 'typography_panel', array(
      'priority'       => 50,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Typography Section', 'haircare' ),
      'description'    => '',
  ) );
  $wp_customize->add_section(
  // ID
  'typography_section',
  // Arguments array
  array(
    'title' => __( 'Google Font Family', 'haircare' ),
    'priority'       => 14,
    'capability' => 'edit_theme_options',
    'panel' => 'typography_panel',
    'description' => __( 'Select Google Fonts', 'haircare' )."<a href='http://www.google.com/fonts' target='_blank' > here </a>"
  )
);  
  // Body Font
  $wp_customize->add_setting(
    'google_body_font',
    array(
        'default' => '',
    )
);

$wp_customize->add_control(
    'google_body_font',
    array(
        'label' => __('Enter Google font for Body', 'haircare' ),
        'section' => 'typography_section',
        'type' => 'text',
    'priority' => 1,    
    )
);
  // Title Font
  $wp_customize->add_setting(
    'google_heading_font',
    array(
        'default' => '',
    )
);
  $wp_customize->add_control(
    'google_heading_font',
    array(
        'label' => __('Enter Google font for Headings', 'haircare' ),
        'section' => 'typography_section',
        'type' => 'text',
        'priority' => 2,
    )
);
  // Menu  Font
  $wp_customize->add_setting(
    'google_menu_font',
    array(
        'default' => '',
    )
);
  $wp_customize->add_control(
    'google_menu_font',
    array(
        'label' => __('Enter Google font for Menu', 'haircare' ),
        'section' => 'typography_section',
        'type' => 'text',
    'priority' => 2,
    )
);
}
 add_action( 'customize_register', 'typography' );
 //Font Settigs
function font_settings( $wp_customize ){
 $wp_customize->add_section(
  // ID
  'font_section',
  // Arguments array
  array(
    'title' => __( 'Font Section', 'haircare' ),
    'priority'       => 20,
    'capability' => 'edit_theme_options',
    'panel' => 'typography_panel'
    //'description' => __( '', 'haircare' )
  )
);
$Body_fontsizes=array( '10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','21' => '21', '22' => '22','23' => '23','24' => '24','25' => '25');
// Body Font Size
$wp_customize->add_setting(
    'body_font_size',
    array(
        'default' => '13',
    )
);

$wp_customize->add_control(
    'body_font_size',
    array(
        'type' => 'select',
        'label' => __('Body Font Size', 'haircare' ),
        'section' => 'font_section',
        'choices' => $Body_fontsizes,
    'priority' => 3,
    )
);
// Menu Font Size
$wp_customize->add_setting(
    'menu_font_size',
    array(
        'default' => '13',
    )
);
$wp_customize->add_control(
    'menu_font_size',
    array(
        'type' => 'select',
        'label' => __('Menu  Font Size', 'haircare' ),
        'section' => 'font_section',
        'choices' => $Body_fontsizes,
    'priority' => 4,
    )
);
// Title Font Sizes
// H1
$fontsizes=array( '10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','21' => '21', '22' => '22','23' => '23','24' => '24','25' => '25','26' => '26','27' => '27','28' => '28','29' => '29','30' => '30','31' => '31','32' => '32','33' => '33','34' => '34','35' => '35','36' => '36','37' => '37','38' => '38','39' => '39','40' => '40');
$wp_customize->add_setting(
    'h1_title_fontsize',
    array(
        'default' => '27',
    )
);
$wp_customize->add_control(
    'h1_title_fontsize',
    array(
        'type' => 'select',
        'label' => __('Font size for heading - H1', 'haircare' ),
        'section' => 'font_section',
        'choices' => $fontsizes,
    'priority' => 4,
    
    )
);
// H2
$wp_customize->add_setting(
    'h2_title_fontsize',
    array(
        'default' => '24',
    )
);
$wp_customize->add_control(
    'h2_title_fontsize',
    array(
        'type' => 'select',
        'label' => __('Font size for heading - H2', 'haircare' ),
        'section' => 'font_section',
        'choices' => $fontsizes,
    'priority' => 5,
    )
);
// H3
$wp_customize->add_setting(
    'h3_title_fontsize',
    array(
        'default' => '20',
    )
);
$wp_customize->add_control(
    'h3_title_fontsize',
    array(
        'type' => 'select',
        'label' => __('Font size for heading - H3', 'haircare' ),
        'section' => 'font_section',
        'choices' => $fontsizes,
    'priority' => 6,
    )
);
// H4
$wp_customize->add_setting(
    'h4_title_fontsize',
    array(
        'default' => '18',
    )
);
$wp_customize->add_control(
    'h4_title_fontsize',
    array(
        'type' => 'select',
        'label' => __('Font size for heading - H4', 'haircare' ),
        'section' => 'font_section',
        'choices' => $fontsizes,
    'priority' => 7,
    )
);
// H5
$wp_customize->add_setting(
    'h5_title_fontsize',
    array(
        'default' => '16',
    )
);
$wp_customize->add_control(
    'h5_title_fontsize',
    array(
        'type' => 'select',
        'label' => __('Font size for heading - H5', 'haircare' ),
        'section' => 'font_section',
        'choices' => $fontsizes,
    'priority' => 8,
    )
);
// H6
$wp_customize->add_setting(
    'h6_title_fontsize',
    array(
        'default' => '14',
    )
);
$wp_customize->add_control(
    'h6_title_fontsize',
    array(
        'type' => 'select',
        'label' => __('Font size for heading - H6', 'haircare' ),
        'section' => 'font_section',
        'choices' => $fontsizes,
    'priority' => 9,
    )
);
}
add_action( 'customize_register', 'font_settings' );
/*---------------------------------------------------------------------*/
// Global Settings
function global_section( $wp_customize ) {

    $wp_customize->add_panel( 'global_section_panel', array(
      'priority'       => 60,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Global Settings', 'haircare' ),
      'description'    => '',
  ) );
    $wp_customize->add_section(
  // ID
  'global-section',
  // Arguments array
  array(
    'title' => __( 'General Settings', 'haircare' ),
    'priority'       => 10,
    'capability' => 'edit_theme_options',
    'panel' => 'global_section_panel'
    //'description' => __( '', 'haircare' )
  ));
    $wp_customize->add_setting('hide_page_loader', array(
      'default' => ''
    ));
  $wp_customize->add_control('hide_page_loader',array(
    'label' => __('Disable page Loader','haircare'),
    'type' => 'checkbox',
    'section' => 'global-section',
    'priority' => 0
  )); 
  $colors[] = array(
    'slug'=>'loader_flash_bg_color',
    'default' => '#1abc9c',
    'label' => __('Loader Flash Background Color', 'haircare'),
    'priority' => 0
  );
  $wp_customize->add_setting('favicon[favi_img]',array(
      'default' => '',
       'capability'   => 'edit_theme_options',
        'type'       => 'option',
      ));
    $wp_customize->add_control(
      new WP_Customize_Image_Control($wp_customize,'favicon',array(
        'label' => __('Upload Favicon Image','haircare'),
        //'default' =>  
        'section' => 'global-section',
        'settings' => 'favicon[favi_img]',
        'priority' => 4
        )));    
  $wp_customize->add_setting( 'google_tracking_code' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'google_tracking_code', array(
      'label'    => __( 'Google Analytics Code', 'haircare' ),
      'section'  => 'global-section',
      'settings' => 'google_tracking_code',
      'priority' => 5,
      'type' => 'text-area',
      ))  );
  
  $wp_customize->add_setting( 'kaya_custom_css' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'kaya_custom_css', array(
      'label'    => __( 'Custom CSS', 'haircare' ),
      'section'  => 'global-section',
      'settings' => 'kaya_custom_css',
      'priority' => 6,
      'type' => 'text-area',
      ))  );

  $wp_customize->add_setting( 'kaya_custom_jquery' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'kaya_custom_jquery', array(
      'label'    => __( 'Custom JQUERY', 'haircare' ),
      'section'  => 'global-section',
      'settings' => 'kaya_custom_jquery',
      'priority' => 7,
      'type' => 'text-area',
      ))  );
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'global-section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
}
  }
add_action( 'customize_register', 'global_section' );  

//Button Color Settings
function button_color_settings( $wp_customize ) {
    $wp_customize->add_section(
  // ID
  'button_color_settings',
  // Arguments array
  array(
    'title' => __( 'Button Color Settings', 'haircare' ),
    'priority'       => 20,
    'capability' => 'edit_theme_options',
    'panel' => 'global_section_panel'
    //'description' => __( '', 'haircare' )
  )
);

  $colors[] = array(
    'slug'=>'button_bg_color',
    'default' => '#1abc9c',
    'label' => __('Button Background Color', 'haircare'),
    'priority' => 9
  );
    $colors[] = array(
    'slug'=>'button_border_color',
    'default' => '#ffffff',
    'label' => __('Button Border Color', 'haircare'),
    'priority' => 9
  );
        $colors[] = array(
    'slug'=>'button_bg_text_color',
    'default' => '#fff',
    'label' => __('Text Color', 'haircare'),
    'priority' => 10
  );
     $colors[] = array(
    'slug'=>'button_bg_hover_color',
    'default' => '#303030',
    'label' => __('Hover Background Color', 'haircare'),
    'priority' => 11
  );
          $colors[] = array(
    'slug'=>'button_hover_text_color',
    'default' => '#fff',
    'label' => __('Hover Text Color', 'haircare'),
    'priority' => 12
  );


foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'button_color_settings',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
}
  }
add_action( 'customize_register', 'button_color_settings' );

//inputfields color settings

function input_fields_color_settings( $wp_customize ) {
    $wp_customize->add_section(
  // ID
  'input_fields_color_settings',
  // Arguments array
  array(
    'title' => __( 'Input Fields Color Settings', 'haircare' ),
    'priority'       => 30,
    'capability' => 'edit_theme_options',
    'panel' => 'global_section_panel'
    //'description' => __( '', 'haircare' )
  )
);
 $colors[] = array(
    'slug'=>'input_background_color',
    'default' => '#333333',
    'label' => __('Background Color', 'haircare'),
    'priority' => 14
  );
        $colors[] = array(
    'slug'=>'input_text_color',
    'default' => '#ffffff',
    'label' => __('Text Color', 'haircare'),
    'priority' => 15
  );
     $colors[] = array(
    'slug'=>'input_border_color',
    'default' => '#2d2d2d',
    'label' => __('Border Color', 'haircare'),
    'priority' => 16
  );
      $colors[] = array(
    'slug'=>'input_error_border_color',
    'default' => '#dd1c1c',
    'label' => __('Error Field Border Color', 'haircare'),
    'priority' => 17
  );

 foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'input_fields_color_settings',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
}
  }
add_action( 'customize_register', 'input_fields_color_settings' );   

//Accent  Color settings

function Accent_color_settings( $wp_customize ) {
    $wp_customize->add_section(
  // ID
  'Accent_color_settings',
  // Arguments array
  array(
    'title' => __( 'Accent Color Settings', 'haircare' ),
    'priority'       => 40,
    'capability' => 'edit_theme_options',
    'panel' => 'global_section_panel',
    'description' => __( '<strong style="color:red;"> Note: </strong>Color applies for overlap container button background color, titles border botttom strip color, single page slider arrows BG hover, blog single page post info icons and etc...', 'haircare' )
  )
);

$colors[] = array(
  'slug'=>'accent_bg_color',
  'default' => '#1abc9c',
   'transport'   => 'refresh',
  'label' => __('Accent BG Color', 'haircare')
);

$colors[] = array(
  'slug'=>'accent_text_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
  'label' => __('Text Color for Accent BG Color', 'haircare')
);

 foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'Accent_color_settings',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
}
  }
add_action( 'customize_register', 'Accent_color_settings' );   

/*-----------------------------------------------------------------------------------*/
// Woo Commerce Page
/*-----------------------------------------------------------------------------------*/ 
function woocommerce_page_section( $wp_customize ){
   $wp_customize->add_panel( 'woocommerce_page_panel', array(
      'priority'       => 80,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Woocommerce Page Section', 'haircare' ),
      'description'    => '',
  ) );
	// Blog Page Categories
	$wp_customize->add_section('woocommerce_page_section',array(
			'title' => 'Woocommerce Page Section',
			'priority' => '10',
      'panel' => 'woocommerce_page_panel'
		));
      $wp_customize->add_setting('menu_bar_cart_icon', array(
  'default' => ''
  ));
  $wp_customize->add_control('menu_bar_cart_icon',array(
  'label' => __('Disable Menu Bar Cart Icon','haircare'),
  'type' => 'checkbox',
  'section' => 'woocommerce_page_section',
  'priority' => 0
  ));
	$wp_customize->add_setting('shop_page_sidebar', array(
			'default' => 'fullwidth'
		));
	$wp_customize->add_control('shop_page_sidebar',array(
		'label' => __('Shop Page Sidebar','haircare'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','haircare'),
			'two_third' => __('Right','haircare'),
			'two_third_last' => __('Left','haircare')
			),
		'priority' => 1
	));
		$wp_customize->add_setting('product_tag_page_sidebar', array(
			'default' => 'fullwidth'
		));
	$wp_customize->add_control('product_tag_page_sidebar',array(
		'label' => __('Product Categories / Tags  Page Sidebar','haircare'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','haircare'),
			'two_third' => __('Right','haircare'),
			'two_third_last' => __('Left','haircare')
			),
		'priority' => 2
	));
	$wp_customize->add_setting('shop_single_page_sidebar', array(
			'default' => 'two_third'
		));
	$wp_customize->add_control('shop_single_page_sidebar',array(
		'label' => __('Shop Single Page Sidebar','haircare'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','haircare'),
			'two_third' => __('Right','haircare'),
			'two_third_last' => __('Left','haircare')
			),
		'priority' => 3
	));
}
add_action('customize_register','woocommerce_page_section');

//Primary Buttons Color Settings
function primary_buttons_color_settings($wp_customize) {

 $wp_customize->add_section(
  // ID
  'woocommerce_primarybuttons_section',
  // Arguments array
  array(
    'title' => __( 'Primary Buttons Color Section', 'haircare' ),
    'priority'       => 20,
    'capability' => 'edit_theme_options',
    'panel' => 'woocommerce_page_panel'
    //'description' => __( '', 'haircare' )
  )
);

$wp_customize->add_setting( 'woo-buttons-note_description' );
$wp_customize->add_control(
new Kaya_Customize_Description_Control( 
  $wp_customize, 'woo-buttons-note_description', array(
  'label'    => __( 'Note: Color applies for Add to cart, Update Cart , mini cart items and  Apply Coupon buttons', 'haircare' ),
  'section'  => 'woocommerce_primarybuttons_section',
  'settings' => 'pf_category_menu_note',
  'priority' => 4
)));
 $color = array();   
$colors[] = array(
  'slug'=>'primary_buttons_bg_color',
  'default' => '#434a54',
   'transport'   => 'refresh',
   'priority' => 5,
  'label' => __('Primary  Buttons BG Color', 'haircare')
);
$colors[] = array(
  'slug'=>'primary_buttons_text_color',
  'default' => '#333333',
   'transport'   => 'refresh',
  'label' => __('Primary  Buttons Text Color', 'haircare'),
  'priority' => 6
);
$colors[] = array(
  'slug'=>'primary_buttons_bg_hover_color',
  'default' => '#e7a802',
   'transport'   => 'refresh',
   'priority' => 7,
  'label' => __('Primary  Buttons BG Hover Color', 'haircare')
);
$colors[] = array(
  'slug'=>'primary_buttons_text_hover_color',
  'default' => '#333333',
   'transport'   => 'refresh',
   'priority' => 8,
  'label' => __('Primary  Buttons Text Hover Color', 'haircare')
);
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'woocommerce_primarybuttons_section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','primary_buttons_color_settings');

//Secondary Buttons Color Settings
function secondary_buttons_color_settings($wp_customize) {

 $wp_customize->add_section(
  // ID
  'woocommerce_secondarybuttons_section',
  // Arguments array
  array(
    'title' => __( 'Secondary Buttons Color Section', 'haircare' ),
    'priority'       => 30,
    'capability' => 'edit_theme_options',
    'panel' => 'woocommerce_page_panel'
    //'description' => __( '', 'haircare' )
  )
);
$wp_customize->add_setting( 'woo-secondary-buttons-note_description' );
$wp_customize->add_control(
new Kaya_Customize_Description_Control( 
  $wp_customize, 'woo-secondary-buttons-note_description', array(
  'label'    => __( 'Note: Color applies for Tabs active color, tab hover color, quantity(plus, minus), view Cart, proceed to checkout and place order buttons', 'haircare' ),
  'section'  => 'woocommerce_secondarybuttons_section',
  'settings' => 'pf_category_menu_note',
  'priority' => 4
)));
 $color = array();   
$colors[] = array(
  'slug'=>'secondary_buttons_bg_color',
  'default' => '#e7a802',
   'transport'   => 'refresh',
   'priority' => 10,
  'label' => __('Secondary Buttons BG Color', 'haircare')
);
$colors[] = array(
  'slug'=>'secondary_buttons_text_color',
  'default' => '#333333',
   'transport'   => 'refresh',
  'label' => __('Secondary Buttons Text Color', 'haircare'),
  'priority' => 11
);
$colors[] = array(
  'slug'=>'secondary_buttons_bg_hover_color',
  'default' => '#434a54',
   'transport'   => 'refresh',
   'priority' => 12,
  'label' => __('Secondary Buttons BG Hover Color', 'haircare')
);
$colors[] = array(
  'slug'=>'secondary_buttons_text_hover_color',
  'default' => '#333333',
   'transport'   => 'refresh',
   'priority' => 13,
  'label' => __('Secondary Buttons Text Hover Color', 'haircare')
);
// Price tag Hover Color 
  $colors[] = array(
  'slug'=>'woo_elments_colors',
  'default' => '#e7a802',
   'transport'   => 'refresh',
   'priority' => 14,
  'label' => __('Elements color', 'haircare')
);
    $wp_customize->add_setting( 'elements_color_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'elements_color_note', array(
      'label'    => __( 'Note: color applied for price, onsale tag, star-rating, .quantity .minus / plus hover and etc...', 'haircare' ),
      'section'  => 'woocommerce_page_section',
      'settings' => 'elements_color_note',
      'priority' => 15
    )));
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'woocommerce_secondarybuttons_section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','secondary_buttons_color_settings');

//Alert Boxes Color Settings
function alert_boxes_color_settings($wp_customize) {

 $wp_customize->add_section(
  // ID
  'woocommerce_alert_boxes_section',
  // Arguments array
  array(
    'title' => __( 'Alert Boxes Color Section', 'haircare' ),
    'priority'       => 40,
    'capability' => 'edit_theme_options',
    'panel' => 'woocommerce_page_panel'
    //'description' => __( '', 'haircare' )
  )
);
$colors[] = array(
  'slug'=>'success_msg_bg_color',
  'default' => '#dff0d8',
   'transport'   => 'refresh',
   'priority' => 17,
  'label' => __('Success Alert Box BG Color', 'haircare')
);
$colors[] = array(
  'slug'=>'success_msg_text_color',
  'default' => '#468847',
   'transport'   => 'refresh',
   'priority' => 18,
  'label' => __('Success Alert Box Text Color', 'haircare')
);

$colors[] = array(
  'slug'=>'notification_msg_bg_color',
  'default' => '#b8deff',
   'transport'   => 'refresh',
   'priority' => 19,
  'label' => __('Notification Alert Box BG Color', 'haircare')
);
$colors[] = array(
  'slug'=>'notification_msg_text_color',
  'default' => '#333',
   'transport'   => 'refresh',
   'priority' => 20,
  'label' => __('Notification Alert Box Text Color', 'haircare')
);

$colors[] = array(
  'slug'=>'warning_msg_bg_color',
  'default' => '#f2dede',
   'transport'   => 'refresh',
   'priority' => 21,
  'label' => __('Warning Alert Box BG Color', 'haircare')
); 
$colors[] = array(
  'slug'=>'warning_msg_text_color',
  'default' => '#a94442',
   'transport'   => 'refresh',
   'priority' => 22,
  'label' => __('Warning Alert Box Text Color', 'haircare')
); 
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'woocommerce_alert_boxes_section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','alert_boxes_color_settings');

/*-----------------------------------------------------------------------------------*/
// Fluid Container Row Styles
/*-----------------------------------------------------------------------------------
function fluidcontainer( $wp_customize ) {
    $wp_customize->add_section(
  // ID
  'fluid_color_section',
  // Arguments array
  array(
    'title' => __( 'Fluid Row Visual Settings', 'haircare' ),
    'priority'       => 11,
    'capability' => 'edit_theme_options',
    //'description' => __( '', 'haircare' )
  )
);
  $wp_customize->add_setting( 'container-row-style-title' );
  $wp_customize->add_control(
      new Kaya_Customize_Subtitle_control( $wp_customize, 'container-row-style-title', array(
        'label'    => __( 'Row Visual Style - 1', 'haircare' ),
        'section'  => 'fluid_color_section',
        'settings' => 'container-row-style-title',
        'priority' => 0
    )));  
  $colors = array();
$url=get_template_directory_uri();
  $wp_customize->add_setting('fluid_bg1_image[fluid_image1]', array(
        'default'           => $url.'/images/container1_bg.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'fluid_image1', array(
        'label'    => __('Background Image', 'haircare'),
        'section'  => 'fluid_color_section',
        'settings' => 'fluid_bg1_image[fluid_image1]',
    'priority' => 1
    )));

$wp_customize->add_setting('fluid_image_repeat',
  array(
    'deafult' => 'no-repeat',
    ));
$wp_customize->add_control('fluid_image_repeat',
  array(
    'label' => 'Background Repeat',
    'capability' => 'edit_theme_options', 
    'section' => 'fluid_color_section',
    'priority' => '2',
    'type' => 'radio',
    'choices' => array(
      'no-repeat' => 'No Repeat',
      'repeat' => 'Repeat'
      )
    ));

$opacity_values = array('0' => '0','0.1' => '0.1','0.2' => '0.2','0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5','0.6' => '0.6','0.7' => '0.7','0.8' => '0.8','0.9' => '0.9','1' => '1');
$wp_customize->add_setting('fluid_image1_opacity',array(
    'default' => '1'
  ));
$wp_customize->add_control('fluid_image1_opacity',array(
    'label' => 'Background Image Opacity',
    'capability' => 'edit_theme_options',
    'section' => 'fluid_color_section',
    'priority' => '3',
    'type' => 'select',
    'choices' => $opacity_values
  ));

$colors[] = array(
  'slug'=>'fluid_bg1_color',
  'default' => '#f2f2f2',
   'transport'   => 'refresh',
   'priority' => 4,
  'label' => __('Background Color', 'haircare')
);
    $wp_customize->add_setting('fluid_bg1_border',
    array(
        'default' => '1',
    ));
  $wp_customize->add_control('fluid_bg1_border',
    array(
        'label' => __('Border Width (px)','haircare'),
         'section'  => 'fluid_color_section',
        'type' => 'text',
        'priority' =>5,
    ));
 $colors[] = array(
  'slug'=>'fluid_bg1_border_color',
  'default' => '#eee',
   'transport'   => 'refresh',
   'priority' => 6,
  'label' => __('Border Color', 'haircare')
);
 $colors[] = array(
  'slug'=>'fluid_bg1_text_color',
  'default' => '#656565',
   'transport'   => 'refresh',
   'priority' => 7,
  'label' => __('Text Color', 'haircare')
);   

// Container row style - 2
$wp_customize->add_setting( 'container-row-style2-title' );
  $wp_customize->add_control(
      new Kaya_Customize_Subtitle_control( $wp_customize, 'container-row-style2-title', array(
        'label'    => __( 'Row Visual Style - 2', 'haircare' ),
        'section'  => 'fluid_color_section',
        'settings' => 'container-row-style2-title',
        'priority' =>8
    )));
  $wp_customize->add_setting('fluid_bg2_image[fluid_image2]', array(
        'default'           =>'',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'fluid_image2', array(
        'label'    => __('Background Image', 'haircare'),
        'section'  => 'fluid_color_section',
        'settings' => 'fluid_bg2_image[fluid_image2]',
    'priority' => 9
    )));
  $wp_customize->add_setting('fluid_image2_repeat',
  array(
    'deafult' => 'no-repeat',
    ));
$wp_customize->add_control('fluid_image2_repeat',
  array(
    'label' => 'Background Repeat',
    'capability' => 'edit_theme_options', 
    'section' => 'fluid_color_section',
    'priority' => '10',
    'type' => 'radio',
    'choices' => array(
      'no-repeat' => 'No Repeat',
      'repeat' => 'Repeat'
      )
    ));

$opacity_values = array('0' => '0','0.1' => '0.1','0.2' => '0.2','0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5','0.6' => '0.6','0.7' => '0.7','0.8' => '0.8','0.9' => '0.9','1' => '1');
$wp_customize->add_setting('fluid_image2_opacity',array(
    'default' => '1'
  ));
$wp_customize->add_control('fluid_image2_opacity',array(
    'label' => 'Background Image Opacity',
    'capability' => 'edit_theme_options',
    'section' => 'fluid_color_section',
    'priority' => '11',
    'type' => 'select',
    'choices' => $opacity_values
  ));


$colors[] = array(
  'slug'=>'fluid_bg2_color',
  'default' => '#f2f2f2',
  'label' => __('Background Color', 'haircare'),
  'priority' => 12
);
    $wp_customize->add_setting('fluid_bg2_border',
    array(
        'default' => '1',
    ));
  $wp_customize->add_control('fluid_bg2_border',
    array(
        'label' => __('Border Width (px)','haircare'),
         'section'  => 'fluid_color_section',
        'type' => 'text',
        'priority' =>13,
    ));
 $colors[] = array(
  'slug'=>'fluid_bg2_border_color',
  'default' => '#eee',
   'transport'   => 'refresh',
   'priority' => 14,
  'label' => __('Border Color', 'haircare')
);
 $colors[] = array(
  'slug'=>'fluid_bg2_text_color',
  'default' => '#666666',
   'transport'   => 'refresh',
   'priority' => 15,
  'label' => __('Text Color', 'haircare')
);   

foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'fluid_color_section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])

    )
  );
}

}
add_action( 'customize_register', 'fluidcontainer' );
*/ 
// End
/*-----------------------------------------------------------------------------------*/