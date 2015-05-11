<?php
/*  
    Plugin Name: Kaya Hair Care Page Widgets
    Plugin URI: http://themeforest.net/user/kayapati/portfolio
    Description: The easy way to create page layouts using Widgets in Pages or post with the help of Widget based page builder like   "SiteOrigin" Page Builder, always note these works better in pages only, 
                 not rcomended for sidebars. 
    Author: Ram
    Author URI: http://themeforest.net/user/kayapati/portfolio
    Version: 1.2
*/  
define('haircare_widgets', 'haircare');
 // Recent Blog post
 class Haircare_Recent_Blog_Widget extends WP_Widget{
    public function __construct(){
        parent::__construct('kaya-recent-blog-post-widget',
            __('Hair Care - Recent Blog Posts',haircare_widgets),
            array('description' => __('Displays Recent post items from posts categories.',haircare_widgets), 'class' => 'recent_blog_post_widget')
        );
    }
       public function widget( $args, $instance ) {
      echo $args['before_widget'];
      global $post;
      $instance=wp_parse_args($instance, array(
          'title' => __('Add Title',haircare_widgets),
          'title_description' => 'Add Title Description',
          'desc_color' => '#787878',
          'title_color' => '#333333',
          'text_align' => __('left',haircare_widgets),
          'heading_styles' => '3',
          'columns' => '4',
          'readmore_text' => __('Read More',haircare_widgets),
          'limit' => '2',
          'recent_blog_post' => '',
          'recent_blog_title_color' => '#333333',
          'recent_blog_desc_color' => '#757575',
          'recent_blog_date_color' => '#e7a802',
          'disable_description' => '',
          'disable_date' => '',
          'post_content_limit' => '8',
          'disable_comment' => '',
          'recent_blog_comment_color' => '#e7a802',

      ));
  ?>
<div class="recent_blog_post">
  <?php  if( $instance['title'] ):
      switch ($instance['text_align']) {
          case 'left':
             $border_lines_align ="float:left;";
            break;
          case 'right':
              $border_lines_align ="float:right;"; 
              break;
          case 'center':
              $border_lines_align ="margin:0px auto;";
              break;        
          default:
            $border_lines_align ="margin:0px auto;";
            break;
        }
          echo '<div class="custom_title kaya_title_'.$instance['text_align'].'">';
          echo  '<h'.$instance['heading_styles'].' style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h'.$instance['heading_styles'].'><div class="clear"></div>';
          if( $instance['title_description'] ) { echo  '<p style="text-align:'.$instance['text_align'].'; color:'.$instance['desc_color'].'!important;">'.$instance['title_description'].'</p>'; }
          echo '</div>';
      ?>
  <div class="clear"> </div>
  <?php endif; ?>
  <ul>
    <?php
        $loop = new WP_Query(array('post_type' => 'post', 'orderby' => '', 'order' => 'DESC', 'posts_per_page' => $instance['limit'], 'cat' =>  $instance['recent_blog_post']));
           if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
        ?>
    <li>
      <?php  
        $comment_rand = rand(1,20); ?>
        <style>
          .comment_color-<?php echo $comment_rand; ?> a{
            color:<?php echo $instance['recent_blog_comment_color']; ?>!important;
          }
        </style>
      <?php

        $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
      <a href="<?php echo the_permalink(); ?>" >
      <?php if( $img_url ){
           echo '<img src="'.aq_resize( $img_url, 60, 60, true ).'" class="alignleft" alt="'.$instance['title'].'" />';  
        }  
        echo '</a>';
        ?>
      <div class="description">
        <h5 style="color:<?php echo $instance['recent_blog_title_color']; ?>">
          <?php the_title(); ?>
        </h5>
        <?php if( $instance['disable_date'] != 'on') : ?>
        <span style="color:<?php echo $instance['recent_blog_date_color']; ?>"><?php echo get_the_date(get_option('date-formate')); ?> </span><br />
        <?php endif; ?>
        <?php if( $instance['disable_description'] != 'on') : ?>
        <span style="color:<?php echo $instance['recent_blog_desc_color']; ?>">
        <?php  echo strip_tags(haircare_content($instance['post_content_limit'])); ?>
        </span><br />
        <?php endif; ?>
        <?php if( $instance['disable_comment'] != 'on') : ?>
            <span  class="comment_color-<?php echo esc_attr( $comment_rand ); ?>"><?php comments_popup_link(__('0 Comments',haircare_widgets ), __( '1 Comment', haircare_widgets ), __( '% Comments', haircare_widgets ) ); ?></span>
        <?php endif; ?>
      </div>
    </li>
    <?php endwhile; endif; ?>
  </ul>
  <?php wp_reset_query(); ?>
</div>
<?php echo $args['after_widget'];  }
    public function form($instance){
         $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name.'-'.$category->cat_ID;
                $blog_cat_id[] = $category->cat_ID;  
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] ='';
      }
        $instance = wp_parse_args($instance, array(
           'title' => __('Add Title',haircare_widgets),
          'title_description' => 'Add Title Description',
          'desc_color' => '#787878',
          'title_color' => '#333333',
          'text_align' => __('left',haircare_widgets),
          'heading_styles' => '3',
          'columns' => '4',
          'readmore_text' => __('Read More',haircare_widgets),
          'limit' => '2',
          'recent_blog_post' => '',
          'recent_blog_title_color' => '#333333',
          'recent_blog_desc_color' => '#757575',
          'recent_blog_date_color' => '#e7a802',
          'disable_description' => '',
          'disable_date' => '',
          'post_content_limit' => '8',
          'disable_comment' => '',
          'recent_blog_comment_color' => '#e7a802',

       ) ); ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title',haircare_widgets) ?>  </label>
  <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
  </p>
 <p>
  <label for="<?php echo $this->get_field_id('heading_styles') ?>"> <?php _e('Select Heading Style',haircare_widgets)?> </label>
  <select id="<?php echo $this->get_field_id('heading_styles') ?>" name="<?php echo $this->get_field_name('heading_styles') ?>">
    <option value="3" <?php selected('3', $instance['heading_styles']) ?>><?php esc_html_e('Heading Style-3', haircare_widgets) ?> </option>
    <option value="2" <?php selected('2', $instance['heading_styles']) ?>> <?php esc_html_e('Heading Style-2', haircare_widgets) ?></option>
    <option value="1" <?php selected('1', $instance['heading_styles']) ?>><?php esc_html_e(' Heading Style-1', haircare_widgets) ?></option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title_color'); ?>"> <?php _e('Title Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo esc_attr( $instance['title_color'] ) ?>" />
</p>
 <p>
  <label for="<?php echo $this->get_field_id('title_description'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
   <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('title_description') ?>" id="<?php echo $this->get_field_id('title_description') ?>" ><?php echo esc_attr($instance['title_description']) ?></textarea>
</p>

<p>
  <label for="<?php echo $this->get_field_id('desc_color'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="widefat" value="<?php echo esc_attr( $instance['desc_color'] ) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('text_align') ?>">
  <?php _e('Title Position',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
    <option value="left" <?php selected('left', $instance['text_align']) ?>>
    <?php esc_html_e(' Left', haircare_widgets) ?>
    </option>
    <option value="right" <?php selected('right', $instance['text_align']) ?>>
    <?php esc_html_e('Right', haircare_widgets) ?>
    </option>
    <option value="center" <?php selected('center', $instance['text_align']) ?>>
    <?php esc_html_e(' Center', haircare_widgets) ?>
    </option>
  </select>
</p>
<label for="<?php echo $this->get_field_id('recent_blog_post') ?>">
<?php _e('Select Blog Category IDs',haircare_widgets) ?>
</label>
     <input type="text" name="<?php echo $this->get_field_name('recent_blog_post') ?>" id="<?php echo $this->get_field_id('recent_blog_post') ?>" class="widefat" value="<?php echo $instance['recent_blog_post'] ?>" />
       <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(',', $blog_cat_name); ?></em><br />
      <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
    </p>
<p>
  <label for="<?php echo $this->get_field_id('limit') ?>">
  <?php _e('Display Number of Posts',haircare_widgets)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('limit') ?>" value="<?php echo esc_attr($instance['limit']) ?>" name="<?php echo $this->get_field_name('limit') ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_content_limit') ?>">
  <?php _e('Posts Content Limit',haircare_widgets)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_content_limit') ?>" value="<?php echo esc_attr($instance['post_content_limit']) ?>" name="<?php echo $this->get_field_name('post_content_limit') ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('disable_date') ?>">
  <?php _e('Disable Date',haircare_widgets)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_date"); ?>" name="<?php echo $this->get_field_name("disable_date"); ?>"<?php checked( (bool) $instance["disable_date"], true ); ?> />
</p>
<p>
  <label for="<?php echo $this->get_field_id('disable_description') ?>">
  <?php _e('Disable Description',haircare_widgets)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_description"); ?>" name="<?php echo $this->get_field_name("disable_description"); ?>"<?php checked( (bool) $instance["disable_description"], true ); ?> />
</p>
<p>
  <label for="<?php echo $this->get_field_id('disable_comment') ?>">
  <?php _e('Disable Comment',haircare_widgets)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_comment"); ?>" name="<?php echo $this->get_field_name("disable_comment"); ?>"<?php checked( (bool) $instance["disable_comment"], true ); ?> />
</p>
<p>
  <label for="<?php echo $this->get_field_id('recent_blog_title_color') ?>">
  <?php _e('Posts Title Color',haircare_widgets)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('recent_blog_title_color') ?>" value="<?php echo esc_attr($instance['recent_blog_title_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_title_color') ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('recent_blog_date_color') ?>">
  <?php _e('Posts Date Color',haircare_widgets)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('recent_blog_date_color') ?>" value="<?php echo esc_attr($instance['recent_blog_date_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_date_color') ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('recent_blog_desc_color') ?>">
  <?php _e('Posts Description Color',haircare_widgets)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('recent_blog_desc_color') ?>" value="<?php echo esc_attr($instance['recent_blog_desc_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_desc_color') ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('recent_blog_comment_color') ?>">
  <?php _e('Posts Comment Color',haircare_widgets)?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('recent_blog_comment_color') ?>" value="<?php echo esc_attr($instance['recent_blog_comment_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_comment_color') ?>" />
</p>

<?php  }
 }
 
 // List style

 class Haircare_Custom_List_Box_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-list-box',
      __('Hair Care - List Items',haircare_widgets),
      array( 'description' => __('Add list items with custom icon.',haircare_widgets), 'class' => 'kaya_list_box_widget' )
    );
    }
    public function widget( $args , $instance ){
        $instance = wp_parse_args($instance, array(
          'title' => __('Add Title',haircare_widgets),
          'title_description' => __('Add Title Description',haircare_widgets),
          'desc_color' => '#787878',
          'title_color' => '#333333',
          'text_align' => __('left',haircare_widgets),
          'heading_styles' => '3',
          'list_box' => '',
          "image_uri" => '',
             ));
        $list_id = rand(1,100);
              ?>
<style>
          .custom_list_box-<?php echo esc_attr( $list_id ); ?> ul li {
              background-image:url('<?php echo aq_resize( $instance['image_uri'], 16, 16, true ); ?>');
              background-repeat:no-repeat;
               background-position: left 4px;
              background-repeat: no-repeat;
              list-style: none outside none;
              padding: 0 0 10px 28px !important; 
              margin-left: 0;
            }

          </style>
<?php echo $args['before_widget'];
   if( $instance['title'] ):
      switch ($instance['text_align']) {
          case 'left':
             $border_lines_align ="float:left;";
            break;
          case 'right':
              $border_lines_align ="float:right;"; 
              break;
          case 'center':
              $border_lines_align ="margin:0px auto;";
              break;        
          default:
            $border_lines_align ="margin:0px auto;";
            break;
        }
          echo '<div class="custom_title kaya_title_'.esc_attr( $instance['text_align'] ).'">';
          echo  '<h'.esc_attr( $instance['heading_styles'] ).' style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.esc_attr( $instance['title_color']).'!important;">'.$instance['title'].'</h'.$instance['heading_styles'].'><div class="clear"></div>';
          if( $instance['title_description'] ) { echo  '<p style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.$instance['desc_color'].'!important;">'.$instance['title_description'].'</p>'; }
          echo '</div>';
      ?>
<div class="clear"> </div>
<?php endif; 
         echo '<div class="custom_list_box custom_list_box-'.$list_id.'">';
            echo $instance['list_box'];
         echo '</div>';
         echo $args['after_widget'];
    }

    public function form( $instance ){

        $instance = wp_parse_args( $instance, array(
          'title' => __('Add Title',haircare_widgets),
          'title_description' => __('Add Title Description',haircare_widgets),
          'desc_color' => '#787878',
          'title_color' => '#333333',
          'text_align' => __('left',haircare_widgets),
          'heading_styles' => '3',
          'list_box' => '',
          "image_uri" => '',

        ) );

        ?>
    <p><?php $i = rand(1,100); ?>
      <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
      <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
      <input type="button" value="<?php _e( 'Upload List Image', 'themename' ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
      <script type="text/javascript">
        jQuery(document).ready( function(){
          jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
              e.preventDefault();
              var custom_uploader = wp.media({
                  title: 'Custom Title',
                  button: {
                      text: 'List Image Upload'
                  },
                  multiple: false  // Set this to true to allow multiple files to be selected
              })
              .on('select', function() {
                  var attachment = custom_uploader.state().get('selection').first().toJSON();
                  jQuery('.custom_media_image_<?php echo $i; ?>').attr('src', attachment.url);
                  jQuery('.custom_media_url_<?php echo $i; ?>').val(attachment.url);
              })
              .open();
          });
          });

      </script>
  </p>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title',haircare_widgets) ?>  </label>
  <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
  </p>
 <p>
  <label for="<?php echo $this->get_field_id('heading_styles') ?>"> <?php _e('Select Heading Style',haircare_widgets)?> </label>
  <select id="<?php echo $this->get_field_id('heading_styles') ?>" name="<?php echo $this->get_field_name('heading_styles') ?>">
    <option value="3" <?php selected('3', $instance['heading_styles']) ?>>
      <?php esc_html_e('Heading Style-3', haircare_widgets) ?> </option>
    <option value="2" <?php selected('2', $instance['heading_styles']) ?>>
     <?php esc_html_e('Heading Style-2', haircare_widgets) ?></option>
    <option value="1" <?php selected('1', $instance['heading_styles']) ?>>
      <?php esc_html_e(' Heading Style-1', haircare_widgets) ?></option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title_color'); ?>"> <?php _e('Title Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo $instance['title_color'] ?>" />
</p>
 <p>
  <label for="<?php echo $this->get_field_id('title_description'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
   <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('title_description') ?>" id="<?php echo $this->get_field_id('title_description') ?>" ><?php echo esc_attr($instance['title_description']) ?></textarea>
</p>
<p>
  <label for="<?php echo $this->get_field_id('desc_color'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="widefat" value="<?php echo $instance['desc_color'] ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('text_align') ?>">
  <?php _e('Title Position',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
    <option value="left" <?php selected('left', $instance['text_align']) ?>>
    <?php esc_html_e(' Left', haircare_widgets) ?>
    </option>
    <option value="right" <?php selected('right', $instance['text_align']) ?>>
    <?php esc_html_e('Right', haircare_widgets) ?>
    </option>
    <option value="center" <?php selected('center', $instance['text_align']) ?>>
    <?php esc_html_e(' Center', haircare_widgets) ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('list_box') ?>">
  <?php _e('List Box',haircare_widgets)?>
  </label>
  <textarea type="text" id="<?php echo $this->get_field_id('list_box') ?>" class="widefat" name="<?php echo $this->get_field_name('list_box') ?>" value = "<?php echo esc_attr( $instance['list_box'] ) ?>" > <?php echo esc_attr($instance['list_box']) ?></textarea>
</p>
<?php  }

 }

 // Title Widget
 class Haircare_Title_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-title',
      __('Hair Care - Custom Title',haircare_widgets),
      array( 'description' => __('Use this widget to add custom title to the blocks.',haircare_widgets) ,'class' => 'kaya_title' )
    );
    }
    public function widget( $args , $instance ){
       
        $instance = wp_parse_args($instance, array(
            'title' => __('Add Custom Title',haircare_widgets),
            'title_description' => __('Add Title Description',haircare_widgets),
            'desc_color' => '#787878',
            'title_color' => '#333333',
            'text_align' => __('left',haircare_widgets),
            'heading_styles' => '3',
         ) );

        switch ($instance['text_align']) {
          case 'left':
             $border_lines_align ="float:left;";
            break;
          case 'right':
              $border_lines_align ="float:right;"; 
              break;
          case 'center':
              $border_lines_align ="margin:0px auto;";
              break;        
          default:
            $border_lines_align ="margin:0px auto;";
            break;
        }
         echo $args['before_widget'];
      if( $instance['title'] ):
          echo '<div class="custom_title kaya_title_'.esc_attr( $instance['text_align'] ).'">';
          echo  '<h'.esc_attr( $instance['heading_styles'] ).' style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.esc_attr( $instance['title_color'] ).'!important;">'.$instance['title'].'</h'.esc_attr( $instance['heading_styles'] ).'><div class="clear"></div>';
          if( $instance['title_description'] ) { echo  '<p style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.esc_attr( $instance['desc_color'] ).'!important;">'.$instance['title_description'].'</p>'; }
          echo '</div>';
      ?>
<div class="clear"> </div>
<?php endif;
        echo  $args['after_widget'];

    }

    public function form( $instance ){
        $instance = wp_parse_args( $instance, array(
            'title' => __('Add Custom Title',haircare_widgets),
            'title_description' => __('Add Title Description',haircare_widgets),
            'desc_color' => '#787878',
            'title_color' => '#333333',
            'text_align' => __('left',haircare_widgets),
            'heading_styles' => '3',

        ) );       ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title',haircare_widgets) ?>  </label>
  <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr( $instance['title'] ) ?>" />
  </p>
 <p>
  <label for="<?php echo $this->get_field_id('heading_styles') ?>"> <?php _e('Select Heading Style',haircare_widgets)?> </label>
  <select id="<?php echo $this->get_field_id('heading_styles') ?>" name="<?php echo $this->get_field_name('heading_styles') ?>">
    <option value="3" <?php selected('3', $instance['heading_styles']) ?>>
      <?php esc_html_e('Heading Style-3', haircare_widgets) ?> </option>
    <option value="2" <?php selected('2', $instance['heading_styles']) ?>> 
      <?php esc_html_e('Heading Style-2', haircare_widgets) ?></option>
    <option value="1" <?php selected('1', $instance['heading_styles']) ?>>
      <?php esc_html_e(' Heading Style-1', haircare_widgets) ?></option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title_color'); ?>"> <?php _e('Title Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo $instance['title_color'] ?>" />
</p>
 <p>
  <label for="<?php echo $this->get_field_id('title_description'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
   <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('title_description') ?>" id="<?php echo $this->get_field_id('title_description') ?>" ><?php echo esc_attr($instance['title_description']) ?></textarea>
</p>
<p>
  <label for="<?php echo $this->get_field_id('desc_color'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="widefat" value="<?php echo $instance['desc_color'] ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('text_align') ?>">
  <?php _e('Title Position',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
    <option value="left" <?php selected('left', $instance['text_align']) ?>>
    <?php esc_html_e(' Left', haircare_widgets) ?>
    </option>
    <option value="right" <?php selected('right', $instance['text_align']) ?>>
    <?php esc_html_e('Right', haircare_widgets) ?>
    </option>
    <option value="center" <?php selected('center', $instance['text_align']) ?>>
    <?php esc_html_e(' Center', haircare_widgets) ?>
    </option>
  </select>
</p>
<?php  }

 }

 // Vspace Widget

 class Haircare_Vspace_Widget extends WP_Widget{

   public function __construct(){

   parent::__construct(  'kaya-vspace',

      __('Hair Care - Vertical Space',haircare_widgets),

      array( 'description' => __('Use this widget to add vertical height in between block rows.',haircare_widgets),'class' => 'kaya_title' )
    );

   }

    public function widget( $args , $instance ){
        echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
            'height' => '20',
         ) );
        echo '<div class="vspace" style="margin-bottom: '.esc_attr( $instance['height'] ).'px;"> </div>';
        echo  $args['after_widget'];
    }

    public function form( $instance ){
        $instance = wp_parse_args( $instance, array(
            'height' => '20',
        ) );

        ?>
<p>
  <label for="<?php echo $this->get_field_id('height'); ?>">
  <?php _e('Height',haircare_widgets) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="widefat" value="<?php echo $instance['height'] ?>" />
</p>
<?php  }
 }
 //kaya Slider

 class Haircare_Slider_Widget extends WP_Widget{
    public function __construct(){
     parent::__construct(  'kaya-slider',
      __('Hair Care - Slider',haircare_widgets),
      array( 'description' => __('Displays slider from Portfolio & Posts categories.', haircare_widgets) ,'class' => 'kaya_slider' )
    );
   }
   public function widget( $args , $instance ){
      echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
              'select_cat_type' => '',
              'slide_effect' => __('slide',haircare_widgets),
              'slide_caption' => '',
              'slider_easing' => __('swing',haircare_widgets),
              'slider_height' =>'450',
              'slider_cat' => '',
               'post_slider_cat' =>'',
              'slide_link' => '',
              'slider_pause_time' => '4000',
              'adaptive_height' => __('false',haircare_widgets),
              'slide_auto_play' => __('true',haircare_widgets),
              'slider_width' => '1160',
              'slide_limit' => '10',
               'slide_title_disable' => '',
         ) );       

    $slide_random = rand(1,50);  ?>

  <script type="text/javascript">  
      (function($) {
        "use strict";
      $(function() {
         $('.bxslider<?php echo $slide_random; ?>').bxSlider({
            useCSS: false,
            pause : <?php echo $instance['slider_pause_time'] ?>,
            easing : "<?php echo $instance['slider_easing'] ?>",
            speed: 1500,
            mode:"<?php echo $instance['slide_effect'] ?>",
            auto : <?php echo $instance['slide_auto_play']; ?>,
            adaptiveHeight : <?php echo $instance['adaptive_height']; ?>
           });
       });
    })(jQuery);
  </script>
  <div id="bx_slider_wrapper">
     <ul class="bxslider<?php echo $slide_random; ?> slider_wrap">
      <?php
          switch ( $instance['select_cat_type'] ) {
    case 'post_slider_category':
      $post_type = 'post';
      $tax_query = '';
      $terms = $instance['post_slider_cat'];
      $cat = $terms;
      break;
    case 'portfolio_category':
      $post_type = 'portfolio';
      $taxonomy = 'portfolio_category';
      $terms = ( !empty($instance['slider_cat']) ) ? explode(',', $instance['slider_cat'])  :  '';
      $tax_query = array('relation' => 'AND', array( 'taxonomy' => $taxonomy,   'field' => 'id', 'terms' => $terms  ) );
      $cat = '';
      break;    
    default:
      # code...
      break;
  }
 $array_val = ( !empty( $instance['slider_cat'] )) ? explode(',',  $instance['slider_cat']) : '';
    if( $terms ) {
    $loop = new WP_Query(array( 'cat' => $cat,  'post_type' => $post_type,  'orderby' => 'menu_order', 'posts_per_page' => $instance['slide_limit'],'order' => 'DESC',  'tax_query' => $tax_query));
    }else{
       $loop = new WP_Query(array( 'cat' => $cat, 'post_type' => $post_type, 'taxonomy' => $instance['select_cat_type'],'term' => '', 'orderby' => 'menu_order', 'posts_per_page' =>$instance['slide_limit'],'order' => 'DESC'));
    }

      if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <li>

            <?php
            global $post;

  $slider_link=get_post_meta(get_the_ID(),'customlink' ,true);
  $slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
  $slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
  $slider_target_link= get_post_meta($post->ID,'slider_target_link',true);
  $slide_description= get_post_meta($post->ID,'slide_description',true);
  $slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
  $disable_slide_content = get_post_meta($post->ID,'disable_slide_content',true);
  if( $slider_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
    if($slider_link){
           echo '<a href="'.$slider_imglink.'" '.$target_link_class.' >';
    }
             global $post;
             $slider_img_width =  $instance['slider_width'] ? $instance['slider_width'] : '1160';       
             $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL
             if( $img_url ):
                 $height = ( $instance['adaptive_height'] == 'true' ) ? '' : $instance['slider_height'];
                 echo '<img src="'.aq_resize( $img_url, $slider_img_width, $height, true ).'" class="" alt="'.get_the_title().'"  />';
             else:
                  echo '<img src="'.get_template_directory_uri().'/images/defult_featured_img.png" style="width:'.$slider_img_width.'px; height:'.$instance['slider_height'].'px;" alt="'.get_the_title().'" >';
             endif;
      if($slider_link){   
       echo '</a>';
     }
         if($instance['slide_title_disable'] != "on") { ?>
               <div class="caption">
                    <h4><?php echo the_title(); ?></h4>
              </div>
          <?php } ?>
         <?php endwhile; // End the loop. Whew. ?>
      </li>
      <?php else :
          echo '<li><img src="'.get_template_directory_uri().'/images/defult_featured_img.png" width="100%" height="400"  alt="'.get_the_title().'" ></li>';
       endif; ?>
      </ul>
    </div>
    <?php wp_reset_query(); ?>
    <div class="clear"></div>
    <?php     echo  $args['after_widget'];
       }

public function form( $instance ){
        $kaya_terms=  get_terms('portfolio_category','');
     if( $kaya_terms ){   
      foreach ($kaya_terms as $kaya_term) { 
        $kaya_cats_name[] = $kaya_term->name.'- '. $kaya_term->term_id;
        $kaya_cats_id[] = $kaya_term->term_id;
      } $slider_items = implode(',', $kaya_cats_id); }else{ $kaya_cats_name[] = '';  $slider_items = '';}
      $posts_categories = get_categories('hide_empty=0');
    if( $posts_categories ){
        foreach ($posts_categories as $category) {
               $cat_name[] = $category->name .' - '.$category->cat_ID;
               $cat_id[] = $category->cat_ID;
      } } else{   
          $cat_name[] = '';
          $cat_id[] = '';
      }
        $instance = wp_parse_args( $instance, array(
              'select_cat_type' => '',
              'slide_effect' => __('slide',haircare_widgets),
              'slide_caption' => '',
              'slider_easing' => __('swing',haircare_widgets),
              'slider_height' =>'450',
              'slider_cat' => $slider_items,
               'post_slider_cat' =>implode(',', $cat_id),
              'slide_link' => '',
              'slider_pause_time' => '4000',
              'adaptive_height' => __('false',haircare_widgets),
              'slide_auto_play' => __('true',haircare_widgets),
              'slider_width' => '1160',
              'slide_limit' => '10',
              'slide_title_disable' => '',
        ) );
        ?>
         <script type="text/javascript">
      (function($) {
      "use strict";
      $(function() {

      $("#<?php echo $this->get_field_id('select_cat_type') ?>").change(function () {
      $("#<?php echo $this->get_field_id('slider_cat') ?>").parent().hide();
      $("#<?php echo $this->get_field_id('post_slider_cat') ?>").parent().hide();
      var selectlayout = $("#<?php echo $this->get_field_id('select_cat_type') ?> option:selected").val(); 
      switch(selectlayout)
        {
          case 'portfolio_category':
           $("#<?php echo $this->get_field_id('slider_cat') ?>").parent().show();
          break;
          case 'post_slider_category':
           $("#<?php echo $this->get_field_id('post_slider_cat') ?>").parent().show();
          break;
        }
      }).change();
     });
  })(jQuery);
    </script> 
     <p>
    <label for="<?php echo $this->get_field_id('select_cat_type') ?>"> <?php _e('Select Slider Category : ',haircare_widgets); ?></label>
    <select id="<?php echo $this->get_field_id('select_cat_type') ?>" name="<?php echo $this->get_field_name('select_cat_type') ?>">
     <option value="portfolio_category" <?php selected('portfolio_category', $instance['select_cat_type']) ?>>
      <?php _e('Portfolio Category',haircare_widgets) ?> </option> 
     <option value="post_slider_category" <?php selected('post_slider_category',$instance['select_cat_type']) ?>>
      <?php _e('Posts Category',haircare_widgets) ?></option>
     </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('slider_cat') ?>">   <?php _e('Enter Portfolio Category IDs : ',haircare_widgets) ?>  </label>
          <input type="text" name="<?php echo $this->get_field_name('slider_cat') ?>" id="<?php echo $this->get_field_id('slider_cat') ?>" class="widefat" value="<?php echo $instance['slider_cat'] ?>" />
      <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(', ', $kaya_cats_name); ?></em><br />
       <p>
      <label for="<?php echo $this->get_field_id('post_slider_cat') ?>">   <?php _e('Enter Post Category IDs : ',haircare_widgets) ?>  </label>
          <input type="text" name="<?php echo $this->get_field_name('post_slider_cat') ?>" id="<?php echo $this->get_field_id('post_slider_cat') ?>" class="widefat" value="<?php echo $instance['post_slider_cat'] ?>" />
      <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong><?php echo implode(',', $cat_name); ?></em><br />
      <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
    </p>
  <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
    </p>
  <p>
  <p>
    <label for="<?php echo $this->get_field_id('slide_auto_play') ?>">
    <?php _e('Auto Play',haircare_widgets)?>
    </label>
    <select id="<?php echo $this->get_field_id('slide_auto_play') ?>" name="<?php echo $this->get_field_name('slide_auto_play') ?>">
      <option value="true" <?php selected('true', $instance['slide_auto_play']) ?>>
      <?php esc_html_e('True', '') ?>
      </option>
      <option value="false" <?php selected('false', $instance['slide_auto_play']) ?>>
      <?php esc_html_e('False', '') ?>
      </option>
    </select>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('slide_effect') ?>">
    <?php _e('Slide Transition Effect',haircare_widgets) ?>
    </label>
    <select id="<?php echo $this->get_field_id('slide_effect') ?>" name="<?php echo $this->get_field_name('slide_effect') ?>">
      <option value="horizontal" <?php selected('show', $instance['slide_effect']) ?>>
      <?php esc_html_e('Horizontal', '') ?>
      </option>
      <option value="vertical" <?php selected('vertical', $instance['slide_effect']) ?>>
      <?php esc_html_e('Vertical', '') ?>
      </option>
      <option value="fade" <?php selected('fade', $instance['slide_effect']) ?>>
      <?php esc_html_e('Fade', '') ?>
      </option>
    </select>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('slider_easing') ?>">
    <?php _e('Slide Easing Effect',haircare_widgets) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_easing') ?>" id="<?php echo $this->get_field_id('slider_easing') ?>" class="widefat" value="<?php echo $instance['slider_easing'] ?>" />
    <small>
    <?php _e("Enter easing effect Ex:linear, swing,easeOutElastic <br> for more transition effects  <a href='http://jqueryui.com/resources/demos/effect/easing.html' target='_blank'>  click here   </a>",haircare_widgets); ?>
    </small> </p>
  <label for="<?php echo $this->get_field_id('slider_pause_time') ?>">
  <?php _e('Slide Pause Time',haircare_widgets) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('slider_pause_time') ?>" id="<?php echo $this->get_field_id('slider_pause_time') ?>" class="widefat" value="<?php echo $instance['slider_pause_time'] ?>" />
  <small>
  <?php _e('The amount of time (in ms) between each auto transition , Ex: 4000',haircare_widgets); ?>
  </small>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('adaptive_height') ?>">
    <?php _e('Auto Height',haircare_widgets)?>
    </label>
    <select id="<?php echo $this->get_field_id('adaptive_height') ?>" name="<?php echo $this->get_field_name('adaptive_height') ?>">
      <option value="true" <?php selected('true', $instance['adaptive_height']) ?>>
      <?php esc_html_e('True', '') ?>
      </option>
      <option value="false" <?php selected('false', $instance['adaptive_height']) ?>>
      <?php esc_html_e('False', '') ?>
      </option>
    </select>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('slider_width') ?>">
    <?php _e('Slider Width (px)',haircare_widgets) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_width') ?>" id="<?php echo $this->get_field_id('slider_width') ?>" class="widefat" value="<?php echo $instance['slider_width'] ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('slider_height') ?>">
    <?php _e('Slider Height (px)',haircare_widgets) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_height') ?>" id="<?php echo $this->get_field_id('slider_height') ?>" class="widefat" value="<?php echo $instance['slider_height'] ?>" />
    <small>
    <?php _e('Ex: 400<br /> Note: It works only when auto height is false',haircare_widgets); ?>
    </small> </p>
      <p>
    <label for="<?php echo $this->get_field_id('slide_limit') ?>">
    <?php _e('Limit',haircare_widgets) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slide_limit') ?>" id="<?php echo $this->get_field_id('slide_limit') ?>" class="widefat" value="<?php echo $instance['slide_limit'] ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('slide_title_disable') ?>"><?php _e('Disable Slide Title',haircare_widgets)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("slide_title_disable"); ?>" name="<?php echo $this->get_field_name("slide_title_disable"); ?>"<?php checked( (bool) $instance["slide_title_disable"], true ); ?> />
  </p>
<?php  }

 }

 /* Dropcap */

class Haircare_Dropcap_Widget extends WP_Widget {

  public function __construct() {
    // widget actual processes
    parent::__construct(
      'dropcap-widget', // Base ID
      __('Hair Care - Dropcap', haircare_widgets), // Name
      array( 'description' => __( 'Use this widget to create drop cap with text or Font Awesome icons.', haircare_widgets ), ) // Args
    );

  }
public function widget( $args, $instance ) {

    echo $args['before_widget'];

  $instance = wp_parse_args( $instance, array(

        'title' => __('Dropcap Title',haircare_widgets),
        'dropcap_text' => 'A',
        'dropcap_bg_color' => '#ffffff',
        'description' => __('Enter Description Here',haircare_widgets),
        'readmore_text' => '',
        'link' => '#',
        'dropcap_color' => '#333333',
        'title_color' => '#333333',
        'description_color' => '#787878',
        'dropap_align' => __('center',haircare_widgets),
        'awesome_icon_name' => '',
        'dropap_font_size' => '',
        'text_wrap' => __('false',haircare_widgets),
        'border_radius' => '',
        'border_color' => '#000000',
        'border_width' => '1',

    ) ); 
  $dropcap_rand = rand(1,500);
  if( $instance['dropcap_bg_color'] ):
    ?>
      <style type="text/css">
            .dropca-<?php echo esc_attr( $dropcap_rand ); ?> .dropcap_bg:hover, .dropca-<?php echo esc_attr( $dropcap_rand ); ?> .dropcap_bg:hover {
                background-color: <?php echo $instance['dropcap_color']; ?>!important;
                color: <?php echo $instance['dropcap_bg_color']; ?>!important;
            }
          .dropcap a:hover{
            opacity: 0.8!important;
          }
      </style>
  <?php 
  endif;
 if($instance['dropcap_bg_color'] || $instance['border_color'] ): 

  $padding = round($instance['dropap_font_size'] / 4).'px';
else:
  $padding = '0';

endif;

if($instance['border_color']){

  $border_color = $instance['border_width'].'px solid '.esc_attr( $instance['border_color'] );

  $border_shadow = '0px 3px 0px 0px '.esc_attr( $instance['border_color'] );

}else{ $border_color = '0px solid '.$instance['border_color']; $border_shadow =''; }

 $line_height = round($instance['dropap_font_size'] /2 ).'px';

 $text_wrap = $instance['text_wrap'] == 'true' ? 'inherit' : 'hidden';

 $icon_size = round($instance['dropap_font_size'] / 2);

  $dropcap_data = array(

      'width' => round( $instance['dropap_font_size'] / 2 ).'px!important',
      'height' => round( $instance['dropap_font_size'] / 2).'px!important',
     'line-height' => $line_height,
      'font-size' => $icon_size.'px',
      'background-color' => $instance['dropcap_bg_color'],
      'color' => $instance['dropcap_color'].'',
      'padding' =>  $padding,
      'border' => $border_color,
      'border-radius' => $instance['border_radius'].'%',
  );

   $dropcap_styles =array();

    foreach ($dropcap_data as $key => $value) {

       $dropcap_styles[] = $key.':'.$value;

   }

   ?>
<div class="dropcap dropcap_<?php echo esc_attr( $instance['dropap_align'] ); ?> dropca-<?php echo $dropcap_rand; ?>  " > 
<div class="dropcap_bg align<?php echo esc_attr( $instance['dropap_align'] ); ?>  <?php echo $this->get_field_id('dropcap_bg_color') ?>" style="<?php echo  implode('; ',$dropcap_styles); ?>">
<?php
      if( $instance['awesome_icon_name'] ){
           echo ' <i class="fa '.esc_attr( $instance['awesome_icon_name'] ).'" > </i>';
              }else {

               ?>
  <strong style="font-weight:blod;"><?php echo esc_attr( $instance['dropcap_text'] ); ?></strong>
  <?php  } ?>
  
  </div>
  <div class="description" style="overflow:<?php echo esc_attr( $text_wrap ); ?>">
     <?php if( $instance['link'] ){ ?>
    <a href="<?php echo esc_url($instance['link']); ?>" >
    <?php } ?>
      <h3 style="color:<?php echo esc_attr( $instance['title_color'] ); ?>!important; text-align:<?php echo $instance['dropap_align']; ?>"><?php echo $instance['title']; ?></h3>
    <?php if( $instance['link'] ){ ?> </a> <?php } ?>
    <p style="color:<?php echo esc_attr( $instance['description_color'] ); ?>!important; text-align:<?php echo esc_attr( $instance['dropap_align'] ); ?>"><?php echo $instance['description']; ?></p>
    <?php if( $instance['readmore_text'] ): echo '<a href="'.esc_url($instance['link']).'" class="readmore readmore-1">'.esc_attr($instance['readmore_text']).'</a>'; endif;  ?>
  </div>
</div>
<?php echo $args['after_widget'];

  }

  public function form( $instance ) {

    $instance = wp_parse_args( $instance, array(

        'title' => __('Dropcap Title',haircare_widgets),
        'dropcap_text' => 'A',
        'dropcap_bg_color' => '#ffffff',
        'description' => __('Enter Description Here',haircare_widgets),
        'readmore_text' => '',
        'link' => '#',
        'dropcap_color' => '#333333',
        'title_color' => '#333333',
        'description_color' => '#787878',
        'dropap_align' => __('center',haircare_widgets),
        'awesome_icon_name' => '',
        'dropap_font_size' => '',
        'text_wrap' => __('false',haircare_widgets),
        'border_radius' => '',
        'border_color' => '#000000',
        'border_width' => '1'

    ) );

    $font_sizes = array(16,24,32,48,64,128);

    ?>
<p>
  <label for="<?php echo $this->get_field_id('awesome_icon_name') ?>">
  <?php _e('Awesome Icon Name','') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('awesome_icon_name') ?>" name="<?php echo $this->get_field_name('awesome_icon_name') ?>" value="<?php echo esc_attr($instance['awesome_icon_name']) ?>" />
  <small>
  <?php _e('Ex: fa-home, for More Awesome icons click',haircare_widgets); ?>
  <a href='http://fontawesome.io/icons/' target='_blank'> click here </a></small> </p>
<p>
  <label for="<?php echo $this->get_field_id('dropcap_text') ?>">
  <?php _e('Enter Dropcap Text','') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('dropcap_text') ?>" name="<?php echo $this->get_field_name('dropcap_text') ?>" value="<?php echo esc_attr($instance['dropcap_text']) ?>" />
  <small>
  <?php _e('Ex: A  <stong> Note: </strong>It Works only when above icon name field is empty ',haircare_widgets) ?>
  </small> </p>
<p>
  <label for="<?php echo $this->get_field_id('dropap_font_size') ?>">
  <?php _e('Dropcap Size',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('dropap_font_size') ?>" name="<?php echo $this->get_field_name('dropap_font_size') ?>">
    <?php  foreach ($font_sizes as $font_size) {
             echo '<option value="' .$font_size. '"  id="' .$font_size. '"',  $instance['dropap_font_size'] == $font_size  ? 'selected = "selected"' : '',' >'.$font_size.'</option>';
         }?>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('dropcap_bg_color') ?>">
  <?php _e('Dropcap Background Color','') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('dropcap_bg_color') ?>" name="<?php echo $this->get_field_name('dropcap_bg_color') ?>" value="<?php echo esc_attr($instance['dropcap_bg_color']) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('dropcap_color') ?>"> <?php _e('Dropcap Text Color',haircare_widgets) ?> </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('dropcap_color') ?>" name="<?php echo $this->get_field_name('dropcap_color') ?>" value="<?php echo esc_attr($instance['dropcap_color']) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('border_width') ?>"> <?php _e('Dropcap Border Width ( px )',haircare_widgets) ?> </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('border_width') ?>" name="<?php echo $this->get_field_name('border_width') ?>" value="<?php echo esc_attr($instance['border_width']) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('border_color') ?>"> <?php _e('Dropcap Border Color',haircare_widgets) ?> </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('border_color') ?>" name="<?php echo $this->get_field_name('border_color') ?>" value="<?php echo esc_attr($instance['border_color']) ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('border_radius') ?>">
  <?php _e('Dropcap Border Radius ( % )','') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('border_radius') ?>" name="<?php echo $this->get_field_name('border_radius') ?>" value="<?php echo esc_attr($instance['border_radius']) ?>" />
  <small>
  <?php _e('Ex:10,20 <stont> Note: </stong>It applies only percentage(%)',haircare_widgets) ?>
  </small> </p>
<p>
  <label for="<?php echo $this->get_field_id('title') ?>">
  <?php _e('Title', '') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($instance['title']) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('title_color') ?>">
  <?php _e('Title Color',haircare_widgets) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('title_color') ?>" name="<?php echo $this->get_field_name('title_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('description') ?>">
  <?php  _e('Description' ,haircare_widgets); ?>
  </label>
  <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" ><?php echo esc_attr($instance['description']) ?></textarea>
</p>
<p>
  <label for="<?php echo $this->get_field_id('description_color') ?>">
  <?php _e('Description Color',haircare_widgets) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('description_color') ?>" name="<?php echo $this->get_field_name('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_text') ?>">
  <?php _e('Readmore Button Text',haircare_widgets) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_text') ?>" name="<?php echo $this->get_field_name('readmore_text') ?>" value="<?php echo esc_attr($instance['readmore_text']) ?>" />
  <small>
  <?php _e('<stong>Note: </strong>Keep it empty to not display the readmore button ',haircare_widgets) ?>
  </small> </p>
<p>
  <label for="<?php echo $this->get_field_id('link') ?>">
  <?php _e('Readmore Button Link',haircare_widgets) ?>
  </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" name="<?php echo $this->get_field_name('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" />
  <small>
  <?php _e('Ex:http://www.google.com',haircare_widgets) ?>
  </small> </p>
<p>
  <label for="<?php echo $this->get_field_id('dropap_align') ?>">
  <?php _e('Dropcap Position',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('dropap_align') ?>" name="<?php echo $this->get_field_name('dropap_align') ?>">
    <option value="left" <?php selected('left', $instance['dropap_align']) ?>>
    <?php esc_html_e('Position Left', '') ?>
    </option>
    <option value="right" <?php selected('right', $instance['dropap_align']) ?>>
    <?php esc_html_e('Position Right', '') ?>
    </option>
    <option value="center" <?php selected('center', $instance['dropap_align']) ?>>
    <?php esc_html_e('Position Center', '') ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('text_wrap') ?>">
  <?php _e('Text Wrapping',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('text_wrap') ?>" name="<?php echo $this->get_field_name('text_wrap') ?>">
    <option value="true" <?php selected('true', $instance['text_wrap']) ?>>
    <?php esc_html_e('True', '') ?>
    </option>
    <option value="false" <?php selected('false', $instance['text_wrap']) ?>>
    <?php esc_html_e('False', '') ?>
    </option>
  </select>
</p>
<?php

  }

}

// Draggable Slider

class Haircare_Draggable_slider_Widget extends WP_Widget{

    public function __construct(){

        parent::__construct('haircare-draggable-slider-widget',

            __('Hair Care - Draggable Slider',haircare_widgets),

            array('description' => __('Displays portfolio items as draggable slider.',haircare_widgets), 'class' => 'draggable_widget')

        );

    }
   public function widget( $args, $instance ) {
      echo $args['before_widget'];
          global $post;
      $instance=wp_parse_args($instance, array(
        'title' => __('Draggable Slider Title',haircare_widgets),
         'description' => 'Draggable Slider Description',
        
         'description_color' => '#787878',
        'readmore_text' => __('Read More',haircare_widgets),
        'text_align'   => __('left',haircare_widgets),
        'title_color' => '#333333',
        'draggable_img_height' => '400',
        'draggable_project_link' => '#',
        'draggable_project_title' => '',
        'hide_slide_content' => '',
        'Popular_post_display' => '',
        'draggable_display_orderby' => __('date',haircare_widgets),
        'draggable_display_order' => __('DESC',haircare_widgets),
        'draggable_slide_items' => '4',
        'draggable_auto_play' => __('true',haircare_widgets),
        'select_cat_type' => '',
        'kaya_slider_cat' => '',
        'pf_slider_cat' => '',
        'draggable_title_color' => '#323232',
        'draggable_content_bg_color' => '#f5f5f5',
        'hide_lightbox_icon' => '',
        'hide_post_link_icon' => '',
        'draggable_slider_hover_color' => '#e7a802',
        'draggable_title_hover_color' => '#ffffff',
        'heading_styles' => '3',
        'slider_limit' => '10',
        'enable_lightbox_image'=>'',
      ));

      if( $instance['title'] ){
                switch ($instance['text_align']) {
          case 'left':
             $border_lines_align ="float:left;";
            break;
          case 'right':
              $border_lines_align ="float:right;"; 
              break;
          case 'center':
              $border_lines_align ="margin:0px auto;";
              break;        
          default:
            $border_lines_align ="margin:0px auto;";
            break;
        }
        echo '<div class="custom_title kaya_title_'.$instance['text_align'].'">';
          echo  '<h'.esc_attr( $instance['heading_styles'] ).' style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.esc_attr( $instance['title_color']).'!important;">'.$instance['title'].'</h'.esc_attr( $instance['heading_styles'] ).'><div class="clear"></div>';
          if( $instance['description'] ) { echo  '<p style="text-align:'.esc_attr(  $instance['text_align'] ).'; color:'.esc_attr( $instance['description_color'] ).'!important;">'.esc_attr( $instance['description'] ).'</p>'; }
          echo '</div>';

        ?>
      <div class="clear"> </div>
      <?php }
       $rand = rand(1,50);
        ?>
      <script type="text/javascript">
      (function($) {
        "use strict";
        $(function() {
          $(".kaya_portfolio_widget_sliders<?php echo $rand; ?>").owlCarousel({
          navigation : false,
          autoplay : <?php echo $instance['draggable_auto_play']; ?>,
          stopOnHover : true,
          itemsDesktop : [1199, 3],
          itemsDesktopSmall : [979, 3],
          itemsTablet : [768, 2],
          items : <?php echo $instance['draggable_slide_items'] ?>,
          afterInit: function() {
             $('.owl_Portfolio_gallery').css('display','block');
          }
       });

         // Hover Effects

         });

      })(jQuery);
     </script>
    <?php   
      switch ($instance['draggable_slide_items']) {
      case '5':
       $img_width = '350';
        break;
      case '4':
        $img_width = '500';
        break;
      case '3':
        $img_width = '650';
        break;
      case '2':
        $img_width = '980';
        break;
      case '1':
        $img_width = '1920';
        break;  
      default:
        $img_width = '600';
        break;
      }    ?>
    <div class="Portfolio_gallery owl_Portfolio_gallery">

    <div  class="da-thumbs kaya_portfolio_widget_sliders<?php echo $rand; ?>" > 
    <?php $array_val = ( !empty($instance['pf_slider_cat']) ) ? explode(',', $instance['pf_slider_cat'])  :  '';
     if( is_array($array_val ) ){
      $loop = new WP_Query(array( 'post_type' => 'portfolio',  'orderby' => $instance['draggable_display_orderby'], 'posts_per_page' => $instance['slider_limit'],'order' => $instance['draggable_display_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'portfolio_category',   'field' => 'id', 'terms' => $array_val  ) )));
      }else{
        $loop = new WP_Query(array('post_type' => 'portfolio', 'taxonomy' => 'portfolio_category','term' => '', 'orderby' => $instance['draggable_display_orderby'], 'posts_per_page' => $instance['slider_limit'],'order' => $instance['draggable_display_order']));
      }
    if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();  
        $title=get_the_title($post->Id);
        global $post;
        $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
        $draggable_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
        if($draggable_link_new_window == '1') { $draggable_target_link ="_blank"; }else{ $draggable_target_link ='_self'; }
        $permalink = get_permalink();
        $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
        $pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
        $lightbox_url =  get_template_directory_uri().'/images/defult_featured_img.png';
        $featured_img = $img_url ? $img_url : $lightbox_url;
        $video_url= get_post_meta($post->ID,'video_url',true);
        $terms = get_the_terms(get_the_ID(), 'portfolio_category');
        $terms_name = array();
        if($terms ){
        foreach ($terms as $term) {
          $terms_name[] = $term->name;
        }
      }else{
        $terms_name[] = 'Uncategorized';
      }
 $height = $instance['draggable_img_height'] ? $instance['draggable_img_height'] : '300';
               echo '<div class="owl_slider_img">';
               
                if( $img_url ):
                  $light_box_image_url =  $img_url;
                  echo '<img src="'.aq_resize( $img_url, $img_width , $height, true ).'" alt="'.$title.'"  />';
                else:
                   $light_box_image_url =  get_template_directory_uri().'/images/defult_featured_img.png';
                  echo '<img  src="'.get_template_directory_uri().'/images/defult_featured_img.png" alt="'.$title.'" class="owl_slider_margin" style="width:'.$img_width.'px; height:'.$height.'px;">';
                endif;
               $lightbox_url = $video_url ? trim($video_url) : $light_box_image_url;
                 ?>
            <?php if( $instance['hide_slide_content'] != '1' && $instance['hide_slide_content'] != 'on' ): ?>
             <div class="portfolio_overlay" style="background-color:<?php echo $instance['draggable_slider_hover_color'] ?>">
            <?php  if( $instance['enable_lightbox_image'] == 'on' ){
                echo '<a data-gal="prettyPhoto[gallery3]" href="'.$lightbox_url.'">';
               }else{
                  echo '<a  href="'.get_permalink().'">';
               } 
            echo '<h4 style="color:'.esc_attr( $instance['draggable_title_hover_color'] ).'!important;">'.get_the_title().'</h4>'; 
             echo '<p style="color:'.esc_attr( $instance['draggable_title_hover_color'] ).'!important;">'.implode(' , ', $terms_name).'</p></a>';
               echo '</div>';
             endif; ?>

    </div>
    <?php endwhile; endif; ?>
    </div>
    <?php wp_reset_query(); ?>
    </div>
    <?php
    echo $args['after_widget'];
    }

  public function form($instance){
  $portfolio_terms=  get_terms('portfolio_category','');
    if( $portfolio_terms ){
      foreach ($portfolio_terms as $portfolio_term) { 
         $pf_cats_name[] = $portfolio_term->name.' - '.$portfolio_term->term_id;
         $pf_cats_id[] = $portfolio_term->term_id;
      }
    }else{
      $pf_cats_name[] = '';
      $pf_cats_id[] = '';
    }

      $instance=wp_parse_args($instance, array(
        'title' => __('Draggable Slider Title',haircare_widgets),
        'heading_styles' => '3',
        'description' => 'Draggable Slider Description',
        'readmore_text' => __('Read More',haircare_widgets),
        'text_align'   => __('left',haircare_widgets),
        'title_color' => '#ffffff',
        'description_color' => '#787878',
        'draggable_img_height' => '400',
        'draggable_project_link' => '#',
        'draggable_project_title' => '',
        'hide_slide_content' => '',
        'Popular_post_display' => '',
        'draggable_display_orderby' => __('date',haircare_widgets),
        'draggable_display_order' => __('DESC',haircare_widgets),
        'draggable_slide_items' => '4',
        'draggable_auto_play' => __('true',haircare_widgets),
        'select_cat_type' => '',
         'pf_slider_cat' => implode(',', $pf_cats_id),
        'draggable_title_color' => '#323232',
        'draggable_content_bg_color' => '#f5f5f5',
        'hide_lightbox_icon' => '',
        'hide_post_link_icon' => '',
        'draggable_slider_hover_color' => '#e7a802',
        'draggable_title_hover_color' => '#ffffff',
        'slider_limit' => '10',
        'enable_lightbox_image'=>'',
      ));
           ?>
      <p>
        <lable for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title',haircare_widgets); ?>
        </label>
        <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
      </p>
      <p>
      <label for="<?php echo $this->get_field_id('heading_styles') ?>">
      <?php _e('Title Heading Style',haircare_widgets)?>
      </label>
      <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('heading_styles') ?>">
        <option value="1" <?php selected('1', $instance['heading_styles']) ?>>
        <?php esc_html_e('Heading Style H1 ', haircare_widgets) ?>
        </option>
        <option value="2" <?php selected('2', $instance['heading_styles']) ?>>
        <?php esc_html_e('Heading Style H2 ', haircare_widgets) ?>
        </option>
        <option value="3" <?php selected('3', $instance['heading_styles']) ?>>
         <?php esc_html_e('Heading Style H3 ', haircare_widgets) ?>
        </option>
      </select>
    </p>
      <p>
        <label for="<?php echo $this->get_field_id('title_color'); ?>">
        <?php _e('Title Color',haircare_widgets) ?>
        </label>
        <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo $instance['title_color'] ?>" />
      </p>
      <p>
          <label for="<?php echo $this->get_field_id('description'); ?>">
          <?php _e('Description',haircare_widgets) ?>
          </label>
          <textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo $instance['description'] ?>" > <?php echo $instance['description'] ?> </textarea>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('description_color') ?>">
        <?php _e('Description Color',haircare_widgets) ?>
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('description_color') ?>" name="<?php echo $this->get_field_name('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('text_align') ?>">
        <?php _e('Title Position',haircare_widgets)?>
        </label>
        <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
          <option value="left" <?php selected('left', $instance['text_align']) ?>>
          <?php esc_html_e('Title Left', haircare_widgets) ?>
          </option>
          <option value="right" <?php selected('right', $instance['text_align']) ?>>
          <?php esc_html_e('Title Right', haircare_widgets) ?>
          </option>
          <option value="center" <?php selected('center', $instance['text_align']) ?>>
          <?php esc_html_e('Title Center', haircare_widgets) ?>
          </option>
        </select>
      </p>
         <p>
      <label for="<?php echo $this->get_field_id('pf_slider_cat') ?>">  <?php _e('Enter Portfolio Category IDs : ',haircare_widgets) ?>  </label>
          <input type="text" name="<?php echo $this->get_field_name('pf_slider_cat') ?>" id="<?php echo $this->get_field_id('pf_slider_cat') ?>" class="widefat" value="<?php echo $instance['pf_slider_cat'] ?>" />
     <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(',', $pf_cats_name); ?></em><br />
     <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
    </p>
      <p>
        <label for="<?php echo $this->get_field_id('draggable_slide_items') ?>">
        <?php _e('Portfolio Slide Items',haircare_widgets); ?>
        </label>
        <select id="<?php echo $this->get_field_id('draggable_slide_items') ?>" name="<?php echo $this->get_field_name('draggable_slide_items') ?>">
          <option value="1" <?php selected('1', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('1 Item', haircare_widgets) ?>
          </option>
          <option value="2" <?php selected('2', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('2 Items', haircare_widgets) ?>
          </option>
          <option value="3" <?php selected('3', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('3 Items', haircare_widgets) ?>
          </option>
          <option value="4" <?php selected('4', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('4 Items', haircare_widgets) ?>
          </option>
          <option value="5" <?php selected('5', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('5 Items', haircare_widgets) ?>
          </option>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('draggable_auto_play') ?>">
        <?php _e('Auto Play',haircare_widgets)?>
        </label>
        <select id="<?php echo $this->get_field_id('draggable_auto_play') ?>" name="<?php echo $this->get_field_name('draggable_auto_play') ?>">
          <option value="true" <?php selected('true', $instance['draggable_auto_play']) ?>>
          <?php esc_html_e('True', haircare_widgets) ?>
          </option>
          <option value="false" <?php selected('false', $instance['draggable_auto_play']) ?>>
          <?php esc_html_e('False', haircare_widgets) ?>
          </option>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('draggable_display_orderby') ?>">
        <?php _e('Orderby',haircare_widgets)?>
        </label>
        <select id="<?php echo $this->get_field_id('draggable_display_orderby') ?>" name="<?php echo $this->get_field_name('draggable_display_orderby') ?>">
          <option value="date" <?php selected('date', $instance['draggable_display_orderby']) ?>>
          <?php esc_html_e('Date', haircare_widgets) ?>
          </option>
          <option value="menu_order" <?php selected('menu_order', $instance['draggable_display_orderby']) ?>>
          <?php esc_html_e('Menu Order', haircare_widgets) ?>
          </option>
          <option value="title" <?php selected('title', $instance['draggable_display_orderby']) ?>>
          <?php esc_html_e('Title', haircare_widgets) ?>
          </option>
          <option value="rand" <?php selected('rand', $instance['draggable_display_orderby']) ?>>
          <?php esc_html_e('Random', haircare_widgets) ?>
          </option>
          <option value="author" <?php selected('author', $instance['draggable_display_orderby']) ?>>
          <?php esc_html_e('Author', haircare_widgets) ?>
          </option>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('draggable_display_order') ?>">
        <?php _e('Order',haircare_widgets)?>
        </label>
        <select id="<?php echo $this->get_field_id('draggable_display_order') ?>" name="<?php echo $this->get_field_name('draggable_display_order') ?>">
          <option value="ASC" <?php selected('ASC', $instance['draggable_display_order']) ?>>
          <?php esc_html_e('Ascending', haircare_widgets) ?>
          </option>
          <option value="DESC" <?php selected('DESC', $instance['draggable_display_order']) ?>>
          <?php esc_html_e('Descending', haircare_widgets) ?>
          </option>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('draggable_img_height'); ?>">
        <?php _e('Image Height',haircare_widgets) ?>
        </label>
        <input type="text" name="<?php echo $this->get_field_name('draggable_img_height') ?>" id="<?php echo $this->get_field_id('draggable_img_height') ?>" class="widefat" value="<?php echo $instance['draggable_img_height'] ?>" />
      </p>
      <p>
            <label for="<?php echo $this->get_field_id('draggable_slider_hover_color'); ?>"><?php _e('Post Thumbnail Hover Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('draggable_slider_hover_color') ?>" id="<?php echo $this->get_field_id('draggable_slider_hover_color') ?>" class="widefat" value="<?php echo $instance['draggable_slider_hover_color'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('draggable_title_hover_color'); ?>"><?php _e('Post Thumbnail Hover Title Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('draggable_title_hover_color') ?>" id="<?php echo $this->get_field_id('draggable_title_hover_color') ?>" class="widefat" value="<?php echo $instance['draggable_title_hover_color'] ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('enable_lightbox_image') ?>"><?php _e('Enable Lightbox',haircare_widgets)?></label>&nbsp;
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_lightbox_image"); ?>" name="<?php echo $this->get_field_name("enable_lightbox_image"); ?>"<?php checked( (bool) $instance["enable_lightbox_image"], true ); ?> />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('slider_limit'); ?>"><?php _e('Slider Items Limits',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('slider_limit') ?>" id="<?php echo $this->get_field_id('slider_limit') ?>" class="widefat" value="<?php echo $instance['slider_limit'] ?>" />
        </p>
       <p>
        <label for="<?php echo $this->get_field_id('hide_slide_content') ?>"><?php _e('Disable Slide Content',haircare_widgets)?></label>&nbsp;
       <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_slide_content"); ?>" name="<?php echo $this->get_field_name("hide_slide_content"); ?>"<?php checked( (bool) $instance["hide_slide_content"], true ); ?> />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('Popular_post_display') ?>">
        <?php _e('Popular Posts',haircare_widgets)?>
        </label>
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("Popular_post_display"); ?>" name="<?php echo $this->get_field_name("Popular_post_display"); ?>"<?php checked( (bool) $instance["Popular_post_display"], true ); ?> />
      </p>
<?php  }
 }

 /**
 * kaya Image boxes
 */

 class Haircare_Imageboxes_Widget extends WP_Widget

 {
   function __construct()

   {
     parent::__construct( 'kaya-image-boxes',

        __('Hair Care - Image Box',haircare_widgets),
       array('description' => __('Displays image box with title and description.',haircare_widgets)  )
      );

   }

   function widget( $args, $instance ){

      $instance = wp_parse_args($instance,array(

         'title' => __('Enter Title Here',haircare_widgets),
        'link' => '#',
        'description' => __('Enter Description Here',haircare_widgets),
        "image_size" => __("full",haircare_widgets),
        "image_id" => "",
        "thumb_src" => '',
        'description_color' => '#757575',
        'title_color' => '#ffffff',
        'border_color' => '#6E6E6E',
        'imagebox_align' => __('left',haircare_widgets),
        'image_width' => '100',
        'image_height' => '100',
        'price' => '$30',
        'price_bg_color' => '#e7a802',
        'price_color' => '#ffffff',

        ));

        echo $args['before_widget'];
           echo "<div class='image-boxes'>";
                $img= wp_get_attachment_image_src($instance["image_id"],$instance["image_size"] );
                $img = $img[0];  ?>
          <div class="figure  align<?php echo esc_attr( $instance['imagebox_align']); ?>">
          <?php
              if( $instance['link'] ){
                echo '<a href="'.esc_url( $instance['link'] ).'">';
              }
             if( $img ){
                echo '<img src="'.aq_resize( $img, $instance['image_width'], $instance['image_height'], true ).'" class="" alt="'.$instance['title'].'"  />';
               }else{
                  echo '<img src="'.get_template_directory_uri().'/images/defult_featured_img.png" style="width:'.$instance['image_width'].'px; height:'.esc_attr( $instance['image_height'] ).'px;" alt="'.esc_attr( $instance['title'] ).'" >';
               }
              if( $instance['link'] ){
               echo '</a>'; 
              } 
            if( $instance['price'] ){ ?>
             <span class="price" style="background-color:<?php echo $instance['price_bg_color']; ?>; color:<?php echo $instance['price_color']; ?>"><?php echo esc_attr( $instance['price'] ) ?></span>
             <?php } ?>
          </div>
        <?php //endif; ?>
        <?php  echo '<div class="description" style="text-align:'.$instance['imagebox_align'].'">';
             if( $instance['title'] ): echo '<h4 style="color:'.$instance['title_color'].'">';
                if( $instance['link'] ){
                  echo '<a style="color:'.esc_attr( $instance['title_color'] ).'" href="'.esc_url( $instance['link'] ).'">';
                }
                echo $instance['title'];
                if( $instance['link'] ){
                  echo '</a>';
                }  
                echo '</h4>';
             endif;
            if( $instance['description'] ):  echo '<p style="color:'.esc_attr( $instance['description_color'] ).'">'.$instance['description'].'</p>'; endif;
           echo '</div>'; 
      echo "</div>";       
    echo $args['after_widget'];

    }

    function form( $instance ){



      $instance = wp_parse_args($instance, array(

        'title' => __('Enter Title Here',haircare_widgets),
        'link' => '#',
        'description' => __('Enter Description Here',haircare_widgets),
        "image_size" => __("full",haircare_widgets),
        "image_id" => "",
        "thumb_src" => '',
        'description_color' => '#757575',
        'title_color' => '#ffffff',
        'border_color' => '#6E6E6E',
        'imagebox_align' => __('left',haircare_widgets),
        'image_width' => '100',
        'image_height' => '100',
        'price' => '$30',
        'price_bg_color' => '#e7a802',
        'price_color' => '#ffffff',
        ));

        ?>
        <p style="text-align: center;"><img id="i<?php echo $this->get_field_id( 'thumb_src' ); ?>" src="<?php echo($instance["thumb_src"]); ?>" /></p>
        <p style="text-align: center;"> <a href="#" id="<?php echo $this->get_field_id( 'image_button' ); ?>" class="button">Choose Image</a> </p>
        <input id="<?php echo $this->get_field_id( 'image_id' ); ?>" name="<?php echo $this->get_field_name( 'image_id' ); ?>" type="hidden" value="<?php echo($instance["image_id"]); ?>" />
        <input id="<?php echo $this->get_field_id( 'thumb_src' ); ?>" name="<?php echo $this->get_field_name( 'thumb_src' ); ?>" type="hidden" value="<?php echo($instance["thumb_src"]); ?>" />
        <script type="text/javascript">

              (function($) {
                    "use strict";
                  $(function() {
                 $("#<?php echo $this->get_field_id( 'image_button' ); ?>").click(function(e) {
                      e.preventDefault();
                      var custom_uploader = wp.media({title: 'Choose Team Image', button: {text: 'Use Image'}, multiple: false})
                      .on('select', function() {
                         var attachment = custom_uploader.state().get('selection').first().toJSON();
                         $('#<?php echo $this->get_field_id( 'image_id' ); ?>').val(attachment.id);
                          $('#<?php echo $this->get_field_id( 'thumb_src' ); ?>').val(attachment.sizes.thumbnail.url);
                         $('#i<?php echo $this->get_field_id( 'thumb_src' ); ?>').attr("src",$('#<?php echo $this->get_field_id( 'thumb_src' ); ?>').val());
                          console.log(attachment);
                      })
                      .open();
                  });

                  $('#i<?php echo $this->get_field_id( 'thumb_src' ); ?>').attr("src",$('#<?php echo $this->get_field_id( 'thumb_src' ); ?>').val());
                });
          })(jQuery);
        </script>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('image_width') ?>">
        <?php _e('Image Width (px)',haircare_widgets)?>
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_width') ?>" value="<?php echo esc_attr($instance['image_width']) ?>" name="<?php echo $this->get_field_name('image_width') ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('image_height') ?>">
        <?php _e('Image Height (px)',haircare_widgets)?>
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_height') ?>" value="<?php echo esc_attr($instance['image_height']) ?>" name="<?php echo $this->get_field_name('image_height') ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('link') ?>">
        <?php _e('Image Link',haircare_widgets)?>
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" name="<?php echo $this->get_field_name('link') ?>" />
      </p>

      <p>
        <lable for="<?php echo $this->get_field_id('price'); ?>"> <?php _e('Price',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('price') ?>" class="widefat" value="<?php echo esc_attr($instance['price']) ?>" name="<?php echo $this->get_field_name('price') ?>" />
      </p>
            <p>
        <lable for="<?php echo $this->get_field_id('price_bg_color'); ?>"> <?php _e('Price Background Color',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('price_bg_color') ?>" class="widefat" value="<?php echo esc_attr($instance['price_bg_color']) ?>" name="<?php echo $this->get_field_name('price_bg_color') ?>" />
      </p>
      <p>
        <lable for="<?php echo $this->get_field_id('price_color'); ?>"> <?php _e('Price Color',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('price_color') ?>" class="widefat" value="<?php echo esc_attr($instance['price_color']) ?>" name="<?php echo $this->get_field_name('price_color') ?>" />
      </p>
      <p>
        <lable for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('title_color') ?>">
        <?php _e('Title Color',haircare_widgets)?>
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" name="<?php echo $this->get_field_name('title_color') ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('description') ?>">
        <?php _e('Description',haircare_widgets)?>
        </label>
        <textarea cols="10" class="widefat" id="<?php echo $this->get_field_id('description') ?>" value="<?php echo esc_attr($instance['description']) ?>" name="<?php echo $this->get_field_name('description') ?>" ><?php echo esc_attr($instance['description']) ?></textarea>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('description_color') ?>">
        <?php _e('Description Color',haircare_widgets)?>
        </label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" name="<?php echo $this->get_field_name('description_color') ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('imagebox_align') ?>">
        <?php _e('Image Position',haircare_widgets)?>
        </label>
        <select id="<?php echo $this->get_field_id('imagebox_align') ?>" name="<?php echo $this->get_field_name('imagebox_align') ?>">
          <option value="left" <?php selected('left', $instance['imagebox_align']) ?>>
          <?php esc_html_e('Position Left', haircare_widgets) ?>
          </option>
          <option value="right" <?php selected('right', $instance['imagebox_align']) ?>>
          <?php esc_html_e('Position Right', haircare_widgets) ?>
          </option>
          <option value="center" <?php selected('center', $instance['imagebox_align']) ?>>
          <?php esc_html_e('Position Center', haircare_widgets) ?>
          </option>
          <option value="none" <?php selected('none', $instance['imagebox_align']) ?>>
          <?php esc_html_e('None', haircare_widgets) ?>
          </option>
        </select>
      </p>
<?php }

 }

/* Flickr Widget 
-------------------------------------- */
class Haircare_Flickr_Widget extends WP_Widget {

  public function __construct() {

    // widget actual processes
    parent::__construct(
      'flickr-widget', // Base ID
      __('Hair Care - Flickr ', haircare_widgets), // Name
      array( 'description' => __( 'Displays flickr images.', haircare_widgets ) ) // Args
    );
  }

public function widget( $args, $instance ) {

  //echo $args['before_widget'];
  $instance = wp_parse_args( $instance, array(

      'title' => __('Flickr Images',haircare_widgets),
      'id' => '',
      'number' => '8',

      ));

// outputs the content of the widget

extract($args); // Make before_widget, etc available.
 $fli_name = empty($instance['title']) ? __('Flickr', haircare_widgets) : $instance['title'];
 $fli_id = $instance['id'];
 $fli_number = $instance['number'];
 $unique_id = $args['widget_id'];
 $instance['id'];

echo $before_widget;
 echo '<div class="custom_title"><h3 style="margin-bottom:0;">'.esc_url( $fli_name ).'</h3></div>'; ?>
<div id="flickr-widget">
  <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $fli_number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $fli_id; ?>"></script>
</div>
<?php echo $after_widget; ?>
<?php }



public function form($instance) {

// Get the options into variables, escaping html characters on the way

  $instance = wp_parse_args( $instance, array(

      'title' => __('Flickr Images',haircare_widgets),
      'id' => '',
      'number' => '8',

      ));

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
  <?php  _e('Flickr Name',haircare_widgets); ?>
  :
  <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $instance['title'] ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('id'); ?>">
  <?php  _e('Flickr ID - ',haircare_widgets); ?>
  <a target="_blank" href="http://www.idgettr.com">idGettr</a> ex: 52617155@N08
  <input id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" class="widefat" value="<?php echo $instance['id'] ?>"  />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('number'); ?>">
  <?php _e('Number of photos:',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $instance['number'] ?>"  />
  </label>
</p>
<?php

}

}
/* Button Widget */
class Haircare_Readmore_Button_Widget extends WP_Widget {
  public function __construct(){
  parent::__construct(
     'haircare-readmore-button',
    __('Hair Care - Button ',haircare_widgets),   
    array( 'description' => __('Displays Readmore Butoom where ever you want.',haircare_widgets),'class' => 'kaya_readmore_widget',
      )
    );
}
public function widget( $args , $instance){
      $instance = wp_parse_args($instance, array(
          
          'readmore_button_text' => __('Readmore',haircare_widgets),
          'readmore_button_link' => '#',
          'readmore_button_color' => '#e7a802',
          'readmore_button_border_color' => '#e7a802',
          'readmore_button_text_color' => '#ffffff',
          'readmore_button_hover_color' => '#333333',
          'readmore_button_hover_link_color' => '#ffffff',
          'readmore_button_alignment' => __('left',haircare_widgets),
          'readmore_button_new_window' => ''

      ));
        echo $args['before_widget']; 
          $button_hover =rand(1,100);
        ?>
         <style type="text/css">
         #mid_container_wrapper .widget_haircare-readmore-button .widget_readmore-<?php echo $button_hover; ?> {
            color: <?php echo $instance['readmore_button_text_color']; ?>!important;
            border:2px solid <?php echo $instance['readmore_button_border_color']; ?>!important;
            background: <?php echo $instance['readmore_button_color']; ?>!important;
        }
        #mid_container_wrapper .widget_haircare-readmore-button .widget_readmore-<?php echo $button_hover; ?>:hover {
            background-color: <?php echo $instance['readmore_button_hover_color']; ?>!important;
            color: <?php echo $instance['readmore_button_hover_link_color']; ?>!important;
        }
       
         .widget_readmore-<?php echo $button_hover; ?>.aligncenter{
          display: table!important;
        }
        </style>
        <?php $target_window = ( $instance['readmore_button_new_window'] == 'on' ) ? '_blank' : '_self'; ?>
        <a class="readmore widget_readmore-<?php echo $button_hover; ?> align<?php echo $instance['readmore_button_alignment']; ?>" href="<?php echo $instance['readmore_button_link']; ?>" target="<?php echo $target_window; ?>" style="border:2px solid <?php echo $instance['readmore_button_color']; ?>; color:<?php echo $instance['readmore_button_text_color']; ?>;"><?php echo $instance['readmore_button_text']; ?></a>
         <?php   echo '<div class="clear">&nbsp;</div>';
        echo $args['after_widget'];

    }
    public function form($instance){
      $instance = wp_parse_args($instance, array(
          
          'readmore_button_text' => __('Readmore',haircare_widgets),
          'readmore_button_link' => '#',
          'readmore_button_color' => '#e7a802',
          'readmore_button_text_color' => '#ffffff',
          'readmore_button_hover_color' => '#333333',
          'readmore_button_hover_link_color' => '#ffffff',
          'readmore_button_alignment' => __('left',haircare_widgets),
          'readmore_button_new_window' => '',
          'readmore_button_border_color' => '#e7a802',

      ));?>

      <p>
  <label for="<?php echo $this->get_field_id('readmore_button_text'); ?>">
  <?php  _e('Button Text',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_text'); ?>" name="<?php echo $this->get_field_name('readmore_button_text'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_text'] ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_button_link'); ?>">
  <?php  _e('Destination URL',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_link'); ?>" name="<?php echo $this->get_field_name('readmore_button_link'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_link'] ?>"  />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_button_color'); ?>">
  <?php _e('Button Background Color',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_color'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_color'] ?>"  />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_button_border_color'); ?>">
  <?php _e('Button Border Color',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_border_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_border_color'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_border_color'] ?>"  />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_button_text_color'); ?>">
  <?php  _e('Button Text Color',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_text_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_text_color'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_text_color'] ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_button_hover_color'); ?>">
  <?php  _e('Button Hover BG Color',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_hover_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_hover_color'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_hover_color'] ?>"  />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('readmore_button_hover_link_color'); ?>">
  <?php _e('Button Hover Text Color',haircare_widgets); ?>
  <input id="<?php echo $this->get_field_id('readmore_button_hover_link_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_hover_link_color'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_hover_link_color'] ?>"  />
  </label>
</p> 
<p>
        <label for="<?php echo $this->get_field_id('readmore_button_alignment') ?>">  <?php _e('Button Alignment',haircare_widgets) ?> </label>
        <select id="<?php echo $this->get_field_id('readmore_button_alignment') ?>" name="<?php echo $this->get_field_name('readmore_button_alignment') ?>">
          <option value="left" <?php selected('left', $instance['readmore_button_alignment']) ?>> 
            <?php esc_html_e('Left', haircare_widgets) ?> </option>
          <option value="right" <?php selected('right', $instance['readmore_button_alignment']) ?>> 
            <?php esc_html_e('Right', haircare_widgets) ?> </option>
          <option value="center" <?php selected('center', $instance['readmore_button_alignment']) ?>> 
            <?php esc_html_e('Center', haircare_widgets) ?> </option>
        </select>
      </p>
 <p>
        <label for="<?php echo $this->get_field_id('readmore_button_new_window') ?>"> <?php _e('Open In New Window',haircare_widgets) ?> </label>
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("readmore_button_new_window"); ?>" name="<?php echo $this->get_field_name("readmore_button_new_window"); ?>"<?php checked( (bool) $instance["readmore_button_new_window"], true ); ?> />
      </p>    
<?php }
}
// Info Boxes
class Haircare_Info_Boxes extends WP_Widget{
  public function __construct(){
    parent::__construct(
        'info-boxes',
          __('Hair Care - Info Boxes', haircare_widgets), // Name
        array(
            'description' => __('Info boxes.',haircare_widgets) , 'class' => ''
          )
      );
} public function widget( $args, $instance){
        $instance= wp_parse_args($instance, array(
              'info_box_type' => __('success',haircare_widgets),
              'info_box_content' => __('Add Info Box Content',haircare_widgets),
          ));
        echo $args['before_widget'];
          echo '<div class="info_box '.esc_attr( $instance['info_box_type'] ).'">';
              echo $instance['info_box_content'];
              echo '<img src="'.plugins_url( 'images/'.$instance['info_box_type'].'_btn.png' , __FILE__ ).'" class="delete">';
          echo '</div>';
        echo $args['after_widget'];

    }
    public function form($instance){
        $instance= wp_parse_args($instance, array(
              'info_box_type' => __('success',haircare_widgets),
              'info_box_content' => __('Add Info Box Content',haircare_widgets),
          ));
      ?>

      <p> <label for="<?php echo $this->get_field_id('info_box_type') ?>"><?php _e('Info Box Type',haircare_widgets) ?></label>
        <select id="<?php echo $this->get_field_id('info_box_type') ?>" name="<?php echo $this->get_field_name('info_box_type') ?>">
          <option value="success" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'success',$instance['info_box_type'] ) ?> >
            <?php esc_html_e('Success', haircare_widgets) ?></option>
          <option value="info" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'info',$instance['info_box_type'] ) ?> >
            <?php esc_html_e('Info', haircare_widgets) ?></option>
          <option value="warning" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'warning',$instance['info_box_type'] ) ?> >
            <?php esc_html_e('Warning', haircare_widgets) ?></option>
          <option value="error" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'error',$instance['info_box_type'] ) ?> >
            <?php esc_html_e('Error', haircare_widgets) ?></option>      
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('info_box_content') ?>"><?php _e('Info Box Content',haircare_widgets) ?></lable>
         <textarea type="text" id="<?php echo $this->get_field_id('info_box_content') ?>" class="widefat" name="<?php echo $this->get_field_name('info_box_content') ?>" value = "<?php echo esc_attr( $instance['info_box_content'] ) ?>" > <?php echo esc_attr( $instance['info_box_content']) ?></textarea>
      </p>
      <?php
    }
  }
  //Testimonial
  class Haircare_Testimonial_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-testimonials',
      __('Hair Care - Testimonial',haircare_widgets),
      array( 'description' => __('Displays testimonial boxes.',haircare_widgets), 'class' => 'kaya_testimonial_widget' )
    );
    }
    public function widget( $args , $instance ){
        $instance = wp_parse_args($instance, array(
              'title' => __('Client Name',haircare_widgets),
              'img_url' => '#',
              'description' => __('Add Your Testimonial description', haircare_widgets),
              'link' => '#',
              "testimonial_img" => '',
              'tm_bg_color' => '#eee',
              'tm_client_name_color' => '#e7a802',
              'tm_description_color' => '#787878',
              'tm_designation' => 'C.E.O',
              'tm_designation_color' => '#3e3e3e'
             )); 
                $tm_rand = rand(1,20);
          echo $args['before_widget'];
            echo '<div class="testimonial_wrapper testimonial-'.esc_attr( $tm_rand ).'" style="background-color:'.esc_attr( $instance['tm_bg_color']).'">';
            echo '<span class="opacity_bg_color"> </span>';
            echo '<div class="testimonial_name">';
             if( $instance['title'] ): echo '<h5 style="color:'.esc_attr( $instance['tm_client_name_color']).'; text-align:center;">'.$instance['title'].'</h5>'; endif;
             echo '<span style="color:'.esc_attr( $instance['tm_designation_color']).'">'.$instance['tm_designation'].'</span>';
             echo '</div>';
              echo '<div class="testimonial_image_wrapper" style="border:5px solid '.esc_attr( $instance['tm_bg_color'] ).'">';
                echo '<a href="'.$instance['link'].'" target="_blank">';
                     if( $instance['testimonial_img'] ){
                    echo '<img src="'.aq_resize( $instance['testimonial_img'], '100', '100', true ).'" style="border:5px solid '.$instance['tm_bg_color'].';" class="testimonial_img" alt="'.$instance['title'].'"  />';
                    }else{     ?> 
                    <img src="<?php echo plugins_url( 'images/defult_featured_img.png' , __FILE__ ); ?>" class="alignleft testimonial_img" style="width:75px; height:75px;" alt="'.$instance['title'].'; border:5px solid <?php echo $instance['tm_bg_color']; ?>"  />
                 <?php    } 
                    
                echo '</a>';
                echo '</div>';
                  // endif;
                 echo '<div class="" >';
                  if( $instance['description']): echo '<p style="color:'.$instance['tm_description_color'].'">'. $instance['description'].'</p>'; endif;
                 
                echo '</div>';
          echo '</div>';
          echo $args['after_widget'];

    }
    public function form( $instance ){

        $instance = wp_parse_args($instance, array(
              'title' => __('Client Name',haircare_widgets),
              'img_url' => '#',
              'description' => __('Add Your Testimonial description', haircare_widgets),
              'link' => '#',
              "testimonial_img" => '',
              'tm_bg_color' => '#eee',
              'tm_client_name_color' => '#e7a802',
              'tm_description_color' => '#787878',
              'tm_designation' => 'C.E.O',
              'tm_designation_color' => '#3e3e3e'
             )); 
        ?>
        <p>
        <label for="<?php echo $this->get_field_id('tm_bg_color') ?>"><?php _e('Content Box Background Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_bg_color') ?>" id="<?php echo $this->get_field_id('tm_bg_color') ?>" class="widefat" value="<?php echo $instance['tm_bg_color'] ?>" />
     </p>
    <p>
        <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Client Name',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" placeholder="Jhon Deo" />
     </p>
        <p>
        <label for="<?php echo $this->get_field_id('tm_client_name_color') ?>"><?php _e('Client Name Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_client_name_color') ?>" id="<?php echo $this->get_field_id('tm_client_name_color') ?>" class="widefat" value="<?php echo $instance['tm_client_name_color'] ?>" />
     </p>
      <p>
        <label for="<?php echo $this->get_field_id('tm_designation') ?>"><?php _e('Designation',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_designation') ?>" id="<?php echo $this->get_field_id('tm_designation') ?>" class="widefat" value="<?php echo $instance['tm_designation'] ?>" placeholder="C.E.O" />
     </p>

     <p>
        <label for="<?php echo $this->get_field_id('tm_designation_color') ?>"><?php _e('Designation Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_designation_color') ?>" id="<?php echo $this->get_field_id('tm_designation_color') ?>" class="widefat" value="<?php echo $instance['tm_designation_color'] ?>" />
     </p>
          <p><?php $i = rand(1,100); ?>
      <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['testimonial_img'])){echo $instance['testimonial_img'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
      <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('testimonial_img'); ?>" id="<?php echo $this->get_field_id('testimonial_img'); ?>" value="<?php echo $instance['testimonial_img']; ?>">
      <input type="button" value="<?php _e( 'Upload Testimonial Image', 'themename' ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
      <script type="text/javascript">
        jQuery(document).ready( function(){
          jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
              e.preventDefault();
              var custom_uploader = wp.media({
                  title: 'Testimonial Image',
                  button: {
                      text: 'Upload Testimonial Image'
                  },
                  multiple: false  // Set this to true to allow multiple files to be selected
              })
              .on('select', function() {
                  var attachment = custom_uploader.state().get('selection').first().toJSON();
                  jQuery('.custom_media_image_<?php echo $i; ?>').attr('src', attachment.url);
                  jQuery('.custom_media_url_<?php echo $i; ?>').val(attachment.url);
              })
              .open();
          });
          });

      </script>

  </p>
       <p> <label for="<?php echo $this->get_field_id('link') ?>"><?php _e('Image Link',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('link') ?>" id="<?php echo $this->get_field_id('link') ?>" class="widefat" value="<?php echo $instance['link'] ?>"  />
        <small><?php _e('Ex: http://www.google.com',haircare_widgets); ?></small>
    </p>

     <p>
        <label for="<?php echo $this->get_field_id('description') ?>"><?php _e('Description',haircare_widgets); ?></label>
         <textarea cols="40" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" value="<?php echo $instance['description'] ?>" class="widefat" ><?php echo $instance['description'] ?></textarea>
      </p>
       <p>
        <label for="<?php echo $this->get_field_id('tm_description_color') ?>"><?php _e('Description Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_description_color') ?>" id="<?php echo $this->get_field_id('tm_description_color') ?>" class="widefat" value="<?php echo $instance['tm_description_color'] ?>"  />
     </p>

 
     <?php  }
 }
 
//Testimonial slider
  class Haircare_Testimonial_Slider_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-testimonials-slider',
      __('Hair Care - Testimonial Slider',haircare_widgets),
      array( 'description' => __('Displays testimonial Slider boxes.',haircare_widgets), 'class' => 'kaya_testimonial_widget' )
    );
    }
    public function widget( $args , $instance ){ 
        $instance = wp_parse_args($instance, array(
            'title' => __('Testimonial Slider Title',haircare_widgets),
            'title_description' => __('Add Title Description',haircare_widgets),
            'desc_color' => '#787878',
            'title_color' => '#3333',
            'text_align' => __('left',haircare_widgets),
            'heading_styles' => '3',
              'auto_play' => __('true',haircare_widgets),
              'tm_bg_color' => '#eee',
              'tm_client_name_color' => '#e7a802',
              'tm_description_color' => '#787878',
              'tm_designation' => 'C.E.O',
              'tm_designation_color' => '#3e3e3e',
              'blog_category' => '',
              'draggable_slide_items' => '4',
             )); 
                
          echo $args['before_widget'];
          $tm_rand = rand(1,100); ?>
          <script>
          (function($) {
          "use strict";
          $(function() {
              $(".testimonial-slider-<?php echo $tm_rand ?>").owlCarousel({
                navigation : false,
                autoPlay : <?php echo $instance['auto_play'] ?>,
                stopOnHover : true,
                pagination  : false,
                items :<?php echo $instance['draggable_slide_items'] ?>,
              });
            });
        })(jQuery);
              </script>
          <?php 
          if( $instance['title'] ):
        echo '<div class="custom_title kaya_title_'.esc_attr( $instance['text_align'] ).'">';
          echo  '<h'.esc_attr( $instance['heading_styles'] ).' style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.esc_attr( $instance['title_color']).'!important;">'.$instance['title'].'</h'.$instance['heading_styles'].'><div class="clear"></div>';
          if( $instance['title_description'] ) { echo  '<p style="text-align:'.esc_attr( $instance['text_align'] ).'; color:'.$instance['desc_color'].'!important;">'.$instance['title_description'].'</p>'; }
          echo '</div>';
      ?>
<div class="clear"> </div>
<?php endif; 
          echo '<div class="testimonial-slider-'.$tm_rand.'">';
$loop = new WP_Query(array('post_type' => 'post',   'cat' =>  $instance['blog_category']));
      if($loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
      $img_url = wp_get_attachment_url(get_post_thumbnail_id());
            echo '<div class="testimonial_wrapper testimonial-'.esc_attr( $tm_rand ).'" style="background-color:'.esc_attr( $instance['tm_bg_color']).'">';
            echo '<span class="opacity_bg_color"> </span>';
            echo '<div class="testimonial_name">';
             if( $instance['title'] ): echo '<h5 style="color:'.esc_attr( $instance['tm_client_name_color']).'; text-align:center;">'.get_the_title().'</h5>'; endif;
               echo '</div>';
              echo '<div class="testimonial_image_wrapper" style="border:5px solid '.esc_attr( $instance['tm_bg_color'] ).'">';
                echo '<a href="'.get_permalink().'" target="_blank">';
                     if( $img_url ){
                    echo '<img src="'.aq_resize( $img_url, '100', '100', true ).'" style="border:5px solid '.$instance['tm_bg_color'].';" class="testimonial_img" alt="'.get_the_title().'"  />';
                    }else{     ?> 
                    <img src="<?php echo plugins_url( 'images/defult_featured_img.png' , __FILE__ ); ?>" class="alignleft testimonial_img" style="width:100px; height:100px;" alt=<?php echo get_the_title(); ?> style="border:5px solid <?php echo $instance['tm_bg_color']; ?>"  />
                 <?php    } 
                    
                echo '</a>';
                echo '</div>';
                  // endif;
                 echo '<div class="" >';
                  echo '<p style="color:'.$instance['tm_description_color'].'">'. get_the_content().'</p>'; 
                 
                echo '</div>';
          echo '</div>';
          endwhile; endif;
          wp_reset_query();
          echo '</div>';
          echo $args['after_widget'];

    }
    public function form( $instance ){
      $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name .' - '.$category->cat_ID;
               $blog_cat_id[] = $category->cat_ID;
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] = '';
      }
        $instance = wp_parse_args($instance, array(
          'title' => __('Testimonial Slider Title',haircare_widgets),
            'title_description' => __('Add Title Description',haircare_widgets),
            'desc_color' => '#787878',
            'title_color' => '#333333',
            'text_align' => __('left',haircare_widgets),
            'heading_styles' => '3',
            'auto_play' => __('true',haircare_widgets),
               'blog_category' => implode(',',$blog_cat_id),
              'img_url' => '#',
              'description' => __('Add Your Testimonial description', haircare_widgets),
              'link' => '#',
              "testimonial_img" => '',
              'tm_bg_color' => '#eee',
              'tm_client_name_color' => '#e7a802',
              'tm_description_color' => '#787878',
              'tm_designation' => 'C.E.O',
              'tm_designation_color' => '#3e3e3e',
              'draggable_slide_items' => '4'
             )); 
        ?>
        <p>
  <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title',haircare_widgets) ?>  </label>
  <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
  </p>
 <p>
  <label for="<?php echo $this->get_field_id('heading_styles') ?>"> <?php _e('Select Heading Style',haircare_widgets)?> </label>
  <select id="<?php echo $this->get_field_id('heading_styles') ?>" name="<?php echo $this->get_field_name('heading_styles') ?>">
    <option value="3" <?php selected('3', $instance['heading_styles']) ?>><?php esc_html_e('Heading Style-3', haircare_widgets) ?> </option>
    <option value="2" <?php selected('2', $instance['heading_styles']) ?>> <?php esc_html_e('Heading Style-2', haircare_widgets) ?></option>
    <option value="1" <?php selected('1', $instance['heading_styles']) ?>><?php esc_html_e(' Heading Style-1', haircare_widgets) ?></option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title_color'); ?>"> <?php _e('Title Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo esc_attr( $instance['title_color'] ) ?>" />
</p>
 <p>
  <label for="<?php echo $this->get_field_id('title_description'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
   <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('title_description') ?>" id="<?php echo $this->get_field_id('title_description') ?>" ><?php echo esc_attr($instance['title_description']) ?></textarea>
</p>

<p>
  <label for="<?php echo $this->get_field_id('desc_color'); ?>"> <?php _e('Description Color',haircare_widgets) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="widefat" value="<?php echo esc_attr( $instance['desc_color'] ) ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('text_align') ?>">
  <?php _e('Title Position',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
    <option value="left" <?php selected('left', $instance['text_align']) ?>>
    <?php esc_html_e(' Left', haircare_widgets) ?>
    </option>
    <option value="right" <?php selected('right', $instance['text_align']) ?>>
    <?php esc_html_e('Right', haircare_widgets) ?>
    </option>
    <option value="center" <?php selected('center', $instance['text_align']) ?>>
    <?php esc_html_e(' Center', haircare_widgets) ?>
    </option>
  </select>
</p>
  <p>
      <label for="<?php echo $this->get_field_id('blog_category') ?>">
      <?php _e('Enter Blog Category IDs : ',haircare_widgets) ?>
      </label>
          <input type="text" name="<?php echo $this->get_field_name('blog_category') ?>" id="<?php echo $this->get_field_id('blog_category') ?>" class="widefat" value="<?php echo $instance['blog_category'] ?>" />
     <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(',', $blog_cat_name); ?></em><br />
      <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
    </p>
          <p>
        <label for="<?php echo $this->get_field_id('draggable_slide_items') ?>">
        <?php _e('Slide Items',haircare_widgets); ?>
        </label>
        <select id="<?php echo $this->get_field_id('draggable_slide_items') ?>" name="<?php echo $this->get_field_name('draggable_slide_items') ?>">
          <option value="1" <?php selected('1', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('1 Item', haircare_widgets) ?>
          </option>
          <option value="2" <?php selected('2', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('2 Items', haircare_widgets) ?>
          </option>
          <option value="3" <?php selected('3', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('3 Items', haircare_widgets) ?>
          </option>
          <option value="4" <?php selected('4', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('4 Items', haircare_widgets) ?>
          </option>
          <option value="5" <?php selected('5', $instance['draggable_slide_items']) ?>>
          <?php esc_html_e('5 Items', haircare_widgets) ?>
          </option>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('auto_play') ?>">
        <?php _e('Auto Play',haircare_widgets) ?>
        </label>
        <select id="<?php echo $this->get_field_id('auto_play') ?>" name="<?php echo $this->get_field_name('auto_play') ?>">
          <option value="true" <?php selected('true', $instance['auto_play']) ?>>
          <?php esc_html_e('True', haircare_widgets) ?>
          </option>
          <option value="false" <?php selected('false', $instance['auto_play']) ?>>
          <?php esc_html_e('False', haircare_widgets) ?>
          </option>
        </select>
      </p>
        <p>
        <label for="<?php echo $this->get_field_id('tm_bg_color') ?>"><?php _e('Content Box Background Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_bg_color') ?>" id="<?php echo $this->get_field_id('tm_bg_color') ?>" class="widefat" value="<?php echo $instance['tm_bg_color'] ?>" />
     </p>
        <p>
        <label for="<?php echo $this->get_field_id('tm_client_name_color') ?>"><?php _e('Post Title Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_client_name_color') ?>" id="<?php echo $this->get_field_id('tm_client_name_color') ?>" class="widefat" value="<?php echo $instance['tm_client_name_color'] ?>" />
     </p>
       <p>
        <label for="<?php echo $this->get_field_id('tm_description_color') ?>"><?php _e('Post Content Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tm_description_color') ?>" id="<?php echo $this->get_field_id('tm_description_color') ?>" class="widefat" value="<?php echo $instance['tm_description_color'] ?>"  />
     </p>

 
     <?php  }
 }

 // Toggle Tabs And Accordion
 class Haircare_Toggle_Tabs_Accordion extends WP_Widget{
public function __construct(){
  parent::__construct(
    'toggle-tabs-accordion',
    'Hair Care - Toggle Tabs',
    array('description' => __('Add Toggle tabs and Accordion widget.',haircare_widgets))
    );
}
public function widget($args, $instance){
  $instance = wp_parse_args($instance, array(
      'title' => '',
      'select_type' => '',
      'select_tabs_type' => __('horizontal',haircare_widgets),
      'tabs_acordion_order' => '',
      'tabs_acordion_orderby' => '',
      'taba_accordion_cat' => '',
      'limit' => '',
      'tabs_bg_color' => '#ffffff',
      'tabs_content_bg_color' => '#eee',
      'tabs_content_color' => '#666',
      'tabs_title_color' => '#343434',
      'tabs_border_color' => '#f5f5f5',
      'tabs_content_link_color' => '#343434'
    ));
  // Accordion Script
    $tabs_rand_class = rand(1,100);
    $toggle_rand_class = rand(1,100);
    $accordion_rand = rand(1,100);
    $tabs_rand = rand(1,100);
    ?>
    <style>
    .accordion > div a, .toggle_content .block a, .tabDetails a{
      color:<?php echo $instance['tabs_content_link_color'] ?>;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .ui-tabs-active a, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .ui-tabs-active a{
      background-color: <?php echo $instance['tabs_content_bg_color'] ?>!important;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .tabDetails p, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .tabDetails  p{
      color: <?php echo $instance['tabs_content_color'] ?>!important;
    }
    .toggle-<?php echo $toggle_rand_class; ?> .toggle_container_wrapper p{
      color: <?php echo $instance['tabs_content_color'] ?>!important;
    }
    #accordion<?php echo $accordion_rand; ?> {
     border-bottom: 1px solid <?php echo $instance['tabs_border_color'] ?>;
    }
    </style>
    <?php
 
      if( $instance['select_type'] == 'accordion' ){
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $( "#accordion<?php echo $accordion_rand; ?>" ).accordion({
            autoHeight: true,
            collapsible: false,
             heightStyle: "content"
          });

         });
    </script>
        <?php  } // Tabs Script ?>
    <?php    if( $instance['select_type'] == 'tabs' ){ ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $("#tabid-<?php echo $tabs_rand; ?>").tabs().addClass( "<?php echo $instance['select_tabs_type']; ?>_tabs" );
          //$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
         });
    </script>
    <?php
  } ?>
  <?php  // Switch case in tabs type and add classes
  echo $args['before_widget'];
  switch ($instance['select_type']) {
    case 'accordion':
      $ids='accordion'.$accordion_rand.'';
      $class = '';
      break;
    case 'tabs':
      $ids='tabid-'.$tabs_rand.'';
      $class = 'tabContaier tabs-'.$tabs_rand_class.'';
      break;
    case 'toggle':
      $ids='';
      $class = 'toggle-'.$toggle_rand_class.'';
      break;
    default:
      $ids='';
       $class = '';
      break;
  }
    
    echo '<div class="'.$instance['select_type'].'_wrapper '.$instance['select_type'].' '.$class.' " id="'.$ids.'">';
    // Adding ul when tabs active 
    if ($instance['select_type'] == 'tabs') { echo '<ul class="tabContaier">'; }

 $array_val = ( !empty( $instance['taba_accordion_cat'] )) ? explode(',', $instance['taba_accordion_cat']) : '';
  if( $array_val ) {
    $loop = new WP_Query(array( 'post_type' => 'tabs',   'orderby' => $instance['tabs_acordion_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['tabs_acordion_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'toggletabs_category',   'field' => 'id', 'terms' => $array_val  ) )));
    }else{
       $loop = new WP_Query(array('post_type' => 'tabs' , 'taxonomy' => 'toggletabs_category', 'term' => $instance['taba_accordion_cat'], 'orderby' => $instance['tabs_acordion_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['tabs_acordion_order'] ));
    }

  if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post(); 
    if( $instance['select_type'] == 'accordion' ){ // Accordion ?>
      <strong style="background-color:<?php echo $instance['tabs_bg_color']; ?>; color:<?php echo $instance['tabs_title_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"><?php echo the_title(); ?></strong>
      <div style="background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"> <?php echo get_the_content(); ?> </div> 
    <?php } 
      elseif( $instance['select_type'] == 'toggle' ){ // Toggle ?>
        <div class="toggle_container_wrapper"><strong class="trigger" style="background-color:<?php echo $instance['tabs_bg_color']; ?>; color:<?php echo $instance['tabs_title_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;" ><?php echo the_title(); ?></strong><div class="toggle_content"><div class="block" style="background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"><?php echo the_content(); ?></div></div></div>

     <?php }
      elseif ($instance['select_type'] == 'tabs') { // Tabs
       $string = mb_strtolower( preg_replace("/[\s_]/", "-", get_the_title()));
        echo '<li><a style="background-color:'.$instance['tabs_bg_color'].'; color:'.$instance['tabs_title_color'].'!important; border:1px solid'.$instance['tabs_border_color'].';" href="#'.trim($string).'">'.get_the_title().'</a></li>';
      }

     ?>
  <?php endwhile;
  wp_reset_query();
  endif;
     if ($instance['select_type'] == 'tabs') { echo '</ul>'; // End Tabs UL
     if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post(); // Tabs Content loop 
       $string = mb_strtolower( preg_replace("/[\s_]/", "-", get_the_title())); ?>
       <div id="<?php echo trim($string); ?>">
           <div class="tabDetails" style="background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"><?php the_content(); ?></div>
      </div>
     <?php endwhile;
     wp_reset_query();
     endif; // End Tabs Loop
     }
  echo  '</div>';
  echo $args['after_widget'];
}
// Form
public function form($instance){
  $tabs_terms=  get_terms('toggletabs_category','');
        if( $tabs_terms ){
          foreach ($tabs_terms as $tabs_term) { 
            $tab_cat_ids[] = $tabs_term->term_id;
             $tab_cats_name[] = $tabs_term->name.' - '.$tabs_term->term_id;
          }
        }else{ $tab_cats_name[] = ''; $tab_cat_ids[] = ''; }
    $instance = wp_parse_args($instance, array(
      'title' => '',
      'select_type' => '',
      'select_tabs_type' => __('horizontal',haircare_widgets),
      'tabs_acordion_order' => '',
      'tabs_acordion_orderby' => '',
      'taba_accordion_cat' => implode(',', $tab_cat_ids),
      'limit' => '',
      'tabs_bg_color' => '#ffffff',
      'tabs_content_bg_color' => '#eee',
      'tabs_content_color' => '#666',
      'tabs_title_color' => '#343434',
      'tabs_border_color' => '#f5f5f5',
      'tabs_content_link_color' => '#343434'
    )); ?>
  <script type="text/javascript">
      (function($) {
      "use strict";
      $(function() {

      $("#<?php echo $this->get_field_id('select_type') ?>").change(function () {
      $("#<?php echo $this->get_field_id('select_tabs_type') ?>").parent().hide();
      var selectlayout = $("#<?php echo $this->get_field_id('select_type') ?> option:selected").val(); 
      switch(selectlayout)
        {
          case 'tabs':
           $("#<?php echo $this->get_field_id('select_tabs_type') ?>").parent().show();
          break;      
        }
      }).change();
     });
  })(jQuery);
    </script>
    <p> <label for="<?php echo $this->get_field_id('select_type') ?>"><?php _e('Select Type',haircare_widgets) ?></label>
        <select id="<?php echo $this->get_field_id('select_type') ?>" name="<?php echo $this->get_field_name('select_type') ?>">
          <option value="accordion" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'accordion',$instance['select_type'] ) ?> >
            <?php esc_html_e('Accordion', haircare_widgets) ?></option>
          <option value="tabs" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'tabs',$instance['select_type'] ) ?> >
            <?php esc_html_e('Tabs', haircare_widgets) ?></option>
          <option value="toggle" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'toggle',$instance['select_type'] ) ?> >
            <?php esc_html_e('Toggle ', haircare_widgets) ?></option>
              
        </select>
      </p>
      <p> <label for="<?php echo $this->get_field_id('select_tabs_type') ?>"><?php _e('Select Tabs Type',haircare_widgets) ?></label>
        <select id="<?php echo $this->get_field_id('select_tabs_type') ?>" name="<?php echo $this->get_field_name('select_tabs_type') ?>">
          <option value="horizontal" id="<?php echo $this->get_field_id('select_tabs_type') ?>" <?php selected( 'horizontal',$instance['select_tabs_type'] ) ?> >
            <?php esc_html_e('Horizontal Tabs', haircare_widgets) ?></option>
          <option value="vertical" id="<?php echo $this->get_field_id('select_tabs_type') ?>" <?php selected( 'vertical',$instance['select_tabs_type'] ) ?> >
            <?php esc_html_e('Vertical Tabs', haircare_widgets) ?></option>
        </select>
      </p>
      <p>
 
  <p>
  <label for="<?php echo $this->get_field_id('taba_accordion_cat') ?>"> <?php _e('Enter Category IDs : ',haircare_widgets) ?> </label>
 <input type="text" name="<?php echo $this->get_field_name('taba_accordion_cat') ?>" id="<?php echo $this->get_field_id('taba_accordion_cat') ?>" class="widefat" value="<?php echo $instance['taba_accordion_cat'] ?>" />
  <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(', ', $tab_cats_name); ?></em><br />
  <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
</p>


           <p>
      <label for="<?php echo $this->get_field_id('tabs_acordion_orderby') ?>"><?php _e('Orderby',haircare_widgets)?></label>
        <select id="<?php echo $this->get_field_id('tabs_acordion_orderby') ?>" name="<?php echo $this->get_field_name('tabs_acordion_orderby') ?>">
        <option value="date" <?php selected('date', $instance['tabs_acordion_orderby']) ?>>
          <?php esc_html_e('Date', haircare_widgets) ?></option>
       <option value="menu_order" <?php selected('menu_order', $instance['tabs_acordion_orderby']) ?>>
        <?php esc_html_e('Menu Order', haircare_widgets) ?></option>
        <option value="title" <?php selected('title', $instance['tabs_acordion_orderby']) ?>>
          <?php esc_html_e('Title', haircare_widgets) ?></option>
        <option value="rand" <?php selected('rand', $instance['tabs_acordion_orderby']) ?>>
          <?php esc_html_e('Random', haircare_widgets) ?></option>
        <option value="author" <?php selected('author', $instance['tabs_acordion_orderby']) ?>>
          <?php esc_html_e('Author', haircare_widgets) ?></option>
      </select>
        </p>
       <p>
      <label for="<?php echo $this->get_field_id('tabs_acordion_order') ?>"><?php _e('Order',haircare_widgets)?></label>
        <select id="<?php echo $this->get_field_id('tabs_acordion_order') ?>" name="<?php echo $this->get_field_name('tabs_acordion_order') ?>">
        <option value="ASC" <?php selected('ASC', $instance['tabs_acordion_order']) ?>>
          <?php esc_html_e('Ascending', haircare_widgets) ?></option>
       <option value="DESC" <?php selected('DESC', $instance['tabs_acordion_order']) ?>>
        <?php esc_html_e('Descending', haircare_widgets) ?></option>
        </select>
        </p> 
      <p>
        <label for="<?php echo $this->get_field_id('limit') ?>"><?php _e('Limit',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('limit') ?>" id="<?php echo $this->get_field_id('limit') ?>"  value="<?php echo $instance['limit'] ?>" />
     </p>
     <p>
        <label for="<?php echo $this->get_field_id('tabs_bg_color') ?>"><?php _e('Tabs Bg Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tabs_bg_color') ?>" id="<?php echo $this->get_field_id('tabs_bg_color') ?>"  value="<?php echo $instance['tabs_bg_color'] ?>" />
     </p>
     <p>
        <label for="<?php echo $this->get_field_id('tabs_title_color') ?>"><?php _e('Tabs Title Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tabs_title_color') ?>" id="<?php echo $this->get_field_id('tabs_title_color') ?>"  value="<?php echo $instance['tabs_title_color'] ?>" />
     </p>
     <p>
        <label for="<?php echo $this->get_field_id('tabs_content_bg_color') ?>"><?php _e('Tabs Content BG Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tabs_content_bg_color') ?>" id="<?php echo $this->get_field_id('tabs_content_bg_color') ?>"  value="<?php echo $instance['tabs_content_bg_color'] ?>" />
     </p>
     <p>
        <label for="<?php echo $this->get_field_id('tabs_content_color') ?>"><?php _e('Tabs Content Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tabs_content_color') ?>" id="<?php echo $this->get_field_id('tabs_content_color') ?>"  value="<?php echo $instance['tabs_content_color'] ?>" />
     </p>
     <p>
        <label for="<?php echo $this->get_field_id('tabs_content_link_color') ?>"><?php _e('Tabs Content Link Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tabs_content_link_color') ?>" id="<?php echo $this->get_field_id('tabs_content_link_color') ?>"  value="<?php echo $instance['tabs_content_link_color'] ?>" />
     </p>
      <p>
        <label for="<?php echo $this->get_field_id('tabs_border_color') ?>"><?php _e('Tabs Border Color',haircare_widgets); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('tabs_border_color') ?>" id="<?php echo $this->get_field_id('tabs_border_color') ?>"  value="<?php echo $instance['tabs_border_color'] ?>" />
     </p>
<?php 
}
 }
 // Pricing Table
class Haircare_Pricing_Table extends WP_Widget{
  public function __construct(){
    parent::__construct(
      'haircare-pricing-table',
      __('Hair Care - Pricing Table',haircare_widgets),
      array('description' => __('Displays Pricing Table.',haircare_widgets))
      );
  }
  public function widget($args, $instance){
      $instance = wp_parse_args($instance, array(
          'pricing_content' => '<ul>
                                    <li>Price Text-1</li>
                                    <li>Price Text-2</li>
                                </ul>',
          'pricing_title' => __('Price Title',haircare_widgets),
          'price' => '$45',
          'price_description' => __('Per Month',haircare_widgets),
          'button_text' => __('Signup',haircare_widgets),
          'button_link' => '#',
          'pricing_bg_color' => '#FF9D01',
          'pricing_text_color' => '#333333',
          'pricing_content_li_odd_bg' => '#F8F7DC ',
          'pricing_content_li_odd_color' => '#333333',
          'pricing_content_li_even_bg' => '#ffffff',
          'pricing_content_li_even_color' => '#333333',       
        ));
      $li_rand_color = rand(1,100); ?>
        <style>
        .even-odd-li-<?php echo $li_rand_color; ?> li:nth-child(odd){
              background-color: <?php echo $instance['pricing_content_li_odd_bg'] ?>;
              color: <?php echo $instance['pricing_content_li_odd_color'] ?>;
        }
        .even-odd-li-<?php echo $li_rand_color; ?> li:nth-child(even){
              background-color: <?php echo $instance['pricing_content_li_even_bg'] ?>;
              color: <?php echo $instance['pricing_content_li_even_color'] ?>;
        }
        </style>
      <?php echo $args['before_widget'];
       // echo 'testing pricing table content'; 
        echo '<div class="pricing_table">';
            if( $instance['pricing_title'] ): 
              echo '<div class="pricing_header" style="background-color:'.$instance['pricing_bg_color'].';">';
                echo '<h3><strong style="color:'.$instance['pricing_text_color'].';">'.$instance['pricing_title'] .'</strong></h3>';
              echo '</div>'; 
            endif; 
            if( $instance['price'] || $instance['price_description'] ):
              echo '<div class="price" style="background-color:'.$instance['pricing_bg_color'].';">';
                if( $instance['price'] ): echo '<h1 style="color:'.$instance['pricing_text_color'].';">'.$instance['price'].'</h1>'; endif;
                if( $instance['price_description'] ): echo '<em style="color:'.$instance['pricing_text_color'].';">'.$instance['price_description'].'</em>'; endif;
              echo '</div>'; 
            endif;
            if( $instance['pricing_content'] ):
                echo '<div class="pricing_content even-odd-li-'.$li_rand_color.'">';
                  echo $instance['pricing_content']; 
                echo '</div>';
            endif;    
            if( $instance['button_text'] ):
              echo '<div class="pricing_footer" style="background-color:'.$instance['pricing_bg_color'].';"><a class="read_more" href="'.$instance['button_link'].'">'.$instance['button_text'].'</a></div>';
            endif;
          echo '</div>';
          echo $args['after_widget'];
  }
  public function form($instance){
         $instance = wp_parse_args($instance, array(
          'pricing_content' => '<ul><li>Price List-1</li><li>Price List-2</li></ul>',
          'pricing_title' => __('Price Title',haircare_widgets),
          'price' => '$45',
          'price_description' => __('Per Month',haircare_widgets),
          'button_text' => __('Signup',haircare_widgets),
          'button_link' => '#',
          'pricing_bg_color' => '#FF9D01',
          'pricing_text_color' => '#333333',
          'pricing_content_li_odd_bg' => '#F8F7DC ',
          'pricing_content_li_odd_color' => '#333333',
          'pricing_content_li_even_bg' => '#ffffff',
          'pricing_content_li_even_color' => '#333333',

        )); ?>
    <p>
      <label for="<?php echo $this->get_field_id('pricing_title') ?>"><?php _e('Pricing Title', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_title') ?>" name="<?php echo $this->get_field_name('pricing_title') ?>" value="<?php echo esc_attr($instance['pricing_title']) ?>">
      <small><?php _e('Ex:Basic, Premium, Standard',haircare_widgets) ?></small>     
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id('price') ?>"><?php _e('Price', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('price') ?>" name="<?php echo $this->get_field_name('price') ?>" value="<?php echo esc_attr($instance['price']) ?>"> 
      <small><?php _e('Ex:$45, $61.5',haircare_widgets) ?></small>     
    </p> 
    <p>
      <label for="<?php echo $this->get_field_id('price_description') ?>"><?php _e('Price Description', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('price_description') ?>" name="<?php echo $this->get_field_name('price_description') ?>" value="<?php echo esc_attr($instance['price_description']) ?>">
      <small><?php _e('Ex:Per Month, Per Year',haircare_widgets) ?></small>    
    </p>     
    <p>
      <label for="<?php echo $this->get_field_id('pricing_content') ?>"><?php _e('Pricing Content',haircare_widgets) ?></label>
      <textarea cols="10" class="widefat" id="<?php echo $this->get_field_id('pricing_content') ?>" value="<?php echo esc_attr($instance['pricing_content']) ?>" name="<?php echo $this->get_field_name('pricing_content') ?>" ><?php echo esc_attr($instance['pricing_content']) ?></textarea>
      <small><?php _e('Note: Pricing content add ul li only',haircare_widgets) ?></small>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('button_text') ?>"><?php _e('Signup Button Text', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('button_text') ?>" name="<?php echo $this->get_field_name('button_text') ?>" value="<?php echo esc_attr($instance['button_text']) ?>">    
      <small><?php _e('Ex: Signup',haircare_widgets) ?></small>  
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('button_link') ?>"><?php _e('Signup Button Link', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('button_link') ?>" name="<?php echo $this->get_field_name('button_link') ?>" value="<?php echo esc_attr($instance['button_link']) ?>">
      <small><?php _e('Ex: http://www.google.com',haircare_widgets) ?></small>     
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id('pricing_bg_color') ?>"><?php _e('Pricing Box BG Color', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_bg_color') ?>" name="<?php echo $this->get_field_name('pricing_bg_color') ?>" value="<?php echo esc_attr($instance['pricing_bg_color']) ?>">    
      <small><?php _e('Ex: #FF9D01',haircare_widgets) ?></small>  
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('pricing_text_color') ?>"><?php _e('Pricing Box Text Color', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_text_color') ?>" name="<?php echo $this->get_field_name('pricing_text_color') ?>" value="<?php echo esc_attr($instance['pricing_text_color']) ?>">
      <small><?php _e('Ex: #333333',haircare_widgets) ?></small>     
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('pricing_content_li_odd_bg') ?>"><?php _e('Price Content Odd BG Color', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_content_li_odd_bg') ?>" name="<?php echo $this->get_field_name('pricing_content_li_odd_bg') ?>" value="<?php echo esc_attr($instance['pricing_content_li_odd_bg']) ?>">    
      <small><?php _e('Ex: #F8F7DC ',haircare_widgets) ?></small>  
    </p>
        <p>
      <label for="<?php echo $this->get_field_id('pricing_content_li_odd_color') ?>"><?php _e('Price Content Odd Text Color', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_content_li_odd_color') ?>" name="<?php echo $this->get_field_name('pricing_content_li_odd_color') ?>" value="<?php echo esc_attr($instance['pricing_content_li_odd_color']) ?>">    
      <small><?php _e('Ex: #333333 ',haircare_widgets) ?></small>  
    </p>
        <p>
      <label for="<?php echo $this->get_field_id('pricing_content_li_even_bg') ?>"><?php _e('Price Content Even BG Color', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_content_li_even_bg') ?>" name="<?php echo $this->get_field_name('pricing_content_li_even_bg') ?>" value="<?php echo esc_attr($instance['pricing_content_li_even_bg']) ?>">    
      <small><?php _e('Ex: #333333 ',haircare_widgets) ?></small>  
    </p>
        <p>
      <label for="<?php echo $this->get_field_id('pricing_content_li_even_color') ?>"><?php _e('Price Content Even Text Color', haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('pricing_content_li_even_color') ?>" name="<?php echo $this->get_field_name('pricing_content_li_even_color') ?>" value="<?php echo esc_attr($instance['pricing_content_li_even_color']) ?>">    
      <small><?php _e('Ex: #333333 ',haircare_widgets) ?></small>  
    </p>


  <?php }
}
class Haircare_Twitter_Widget extends WP_Widget {
  public function __construct(){
    parent::__construct(
      'haircare-twitter',
      __('Hair Care - Twitter',haircare_widgets),
      array('description' => __('Dsiplay latest tweets',haircare_widgets))
      );
  }
  function widget($args, $instance)
  {
   
    $instance = wp_parse_args($instance, array(
          'title' => '',
          'twitter_username' => '', 
          'count' => 3, 
          'consumer_key' => '',
          'access_token' => '',
          'consumer_secret' => '', 
          'access_token' => '', 
          'access_token_secret' => ''

        )); 

  echo $args['before_widget'];
   
    if($instance['title']) {
      echo $args['before_title'].$instance['title'].$args['after_title'];
    }
    
    if($instance['twitter_username'] && trim($instance['consumer_key']) && trim($instance['consumer_secret']) && trim($instance['access_token']) && trim($instance['access_token_secret']) && $instance['count']) { 
    require_once 'twitteroauth/twitteroauth.php';
    $transName = 'list_tweets';
    $cacheTime = 1;
    if(false === ($twittermsg = get_transient($transName))) {
         // require the twitter auth class
         require_once 'twitteroauth/twitteroauth.php';
         $twitterConnection = new TwitterOAuth(
             trim($instance['consumer_key']),  // Consumer Key
              trim($instance['consumer_secret']),     // Consumer secret
              trim($instance['access_token']),       // Access token
              trim($instance['access_token_secret'])     // Access token secret
              );
         $twittermsg = $twitterConnection->get(
                'statuses/user_timeline',
                array(
                  'screen_name'     => $instance['twitter_username'],
                  'count'           => $instance['count'],
                  'exclude_replies' => true
                )
              );
         if($twitterConnection->http_code != 200)
         {
              $twittermsg = get_transient($transName);
         }
         // Save our new transient.
         set_transient($transName, $twittermsg, 60 * $cacheTime);
    }
    $twitter = get_transient($transName);
    if($twitter && is_array($twitter)) {
      //var_dump($twitter);
    ?>
    
          <div class="twitter_container" id="tweets_<?php echo $args['widget_id']; ?>">
            <ul>
              <?php foreach($twitter as $tweet): ?>
              <li><i class="fa fa-twitter"> </i>
                <span class="description">
                <?php
                $latestTweet = $tweet->text;
                $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
                $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
                echo $latestTweet;
                ?>
              
                <?php
                $twitterTime = strtotime($tweet->created_at);
                $timeAgo = $this->ago($twitterTime);
                ?>
                <a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" ><?php echo $timeAgo; ?></a>
                </span>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
    <?php }}
    
    echo $args['after_widget'];
  }
  
  function ago($time)
  {
     $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
     $lengths = array("60","60","24","7","4.35","12","10");

     $now = time();

         $difference     = $now - $time;
         $tense         = "ago";

     for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
         $difference /= $lengths[$j];
     }

     $difference = round($difference);

     if($difference != 1) {
         $periods[$j].= "s";
     }

     return "$difference $periods[$j] ago ";
  }

 function form($instance)
  {

 $instance = wp_parse_args($instance, array(
          'title' => '',
          'twitter_username' => '', 
          'count' => 3, 
          'consumer_key' => '',
          'access_token' => '',
          'consumer_secret' => '', 
          'access_token' => '', 
          'access_token_secret' => ''

        )); 
?>
    
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Twitter Title:',haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key:',haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret:',haircare_widgets) ?></label>
      <input class="widefat" type="text"  id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token:',haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret:',haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
    </p>
        <p>
      <label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter User Name:',haircare_widgets) ?></label>
      <input class="widefat" type="text"  id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" value="<?php echo $instance['twitter_username']; ?>" />
    <p>
      <label for="<?php echo $this->get_field_id('count') ?>"><?php _e('Number of Tweets:',haircare_widgets) ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('count') ?>" name="<?php echo $this->get_field_name('count') ?>" value="<?php echo esc_attr($instance['count']) ?>">    
    </p>
  <?php
  }
}

 /**
 *  Portfolio Widget 
 */
 class Haircare_Portfolio extends WP_Widget
 {
   
   function __construct()
   {
     parent::__construct(
      'kaya-portfolio',
      __('Hair Care - Portfolio',haircare_widgets),
      array('description' => 'Display Portfolio items as a Grid & Masonry style')
      );
   }
   function widget( $args, $instance ){
      $instance = wp_parse_args( $instance, array( 

        'Select_disply_style' => '', 
        'columns' => '',
        'kaya_portfolio_filter' => '',
        'portfolio_widget_category' => '',
        'pf_display_orderby' => '',
        'pf_display_order' => '',
        'limit' => '50',
        'hide_post_link_icon' => '',
        'hide_lightbox_icon' => '',
        'hide_post_title' => '',
        'post_title_color' => '#333333',
        'post_thumb_hover_color' => '#e7a802',
        'post_thumb_width' => '650',
        'post_thumb_height' => '650',
        'video_id' => '',
         'disable_pattern' => '',
        'fluid_pf_gallery' => '',
        'Popular_post_display' => '',
        'enable_pagination' => '',
        'enable_lightbox_image' => '',
        )); 
      echo $args['before_widget'];
       $rand = rand(1,100);
      if( $instance['fluid_pf_gallery'] == 'on'){ ?>
        <script>
      (function( $ ) {
       "use strict";
       $(function() {
        function portfolio_gallery_fluid(){
                     var $content_width= ($(window).width() + 5);
             <?php $layout_position = get_theme_mod('layout_position') ? get_theme_mod('layout_position') : 'center' ; 
          if( $layout_position == 'center' ){ ?>
             var $container_fluid = Math.ceil( (( ($(window).width() - 0)  - parseInt($('.container').css('width'))) / 2) );
          <?php }elseif( $layout_position == 'right' ) { ?>
             var $container_fluid = 300;
        <?php  }else{ ?>
              var $container_fluid = 30;
          <?php } ?>          
           $('#fluid_container .portfolio_fluid<?php echo $rand; ?>').css({
             'margin-left' :-$container_fluid,
             width : $content_width
             });
           var $boxed_width = $('#boxed_container').width();
            $('#boxed_container .portfolio_fluid<?php echo $rand; ?>').css({
             'margin-left' :-30,
             'width' :$boxed_width
             }); 
        }
         portfolio_gallery_fluid();
         $(window).resize(function(){
            portfolio_gallery_fluid();
        });   
      });
      })(jQuery);
      </script>
    <?php  
      $fullwidth_pf_gallery = 'fullwidth_pf_gallery';
  }else{ $fullwidth_pf_gallery =''; }
    ?>
      <?php
      switch( $instance['columns'] ){
            case 5:
              $width = ( $instance['Select_disply_style'] == 'masonry_gallery') ? '' :'500';
              $width  = $instance['post_thumb_width'] ? $instance['post_thumb_width'] : '500';
              $height = $instance['post_thumb_height'] ? $instance['post_thumb_height'] : '650';
              break;
            case 4:
              $width = ( $instance['Select_disply_style'] == 'masonry_gallery') ? '' :'500';
              $width  = $instance['post_thumb_width'] ? $instance['post_thumb_width'] : '500';
              $height = $instance['post_thumb_height'] ? $instance['post_thumb_height'] : '650';
              break;
            case 3:
              $width = ( $instance['Select_disply_style'] == 'masonry_gallery') ? '' :'650';
              $width = $instance['post_thumb_width'] ? $instance['post_thumb_width'] : '650';
              $height = $instance['post_thumb_height'] ? $instance['post_thumb_height'] : '650';
              break;
            }
       echo '<div class="fluid_portfolio_wrapper portfolio_fluid'.$rand.'  '.$fullwidth_pf_gallery.'">';
       if ($instance['kaya_portfolio_filter'] == 'true'){ //filter settings
            echo '<div class="filter_portfolio">';
              echo '<div class="filter" id="filter">';
                echo '<ul>';
                  echo '<li class="all" ><a class="" href="#" data-category="all">'.__( 'All', haircare_widgets ).'</a></li>';
                  $category = trim( $instance['portfolio_widget_category']);
                  if( $category ){
                    $pf_categories = @explode(',', $category);
                     for($i=0;$i<count($pf_categories);$i++){
                      $terms[] = get_term_by('id', $pf_categories[$i], 'portfolio_category');
                    } } else {
                      $terms = get_terms('portfolio_category');
                    }
                    foreach($terms as $term) {
                        echo '<li  class="cat-'.$term->term_id .'" >';
                    echo '<a href="#" data-category="cat-' . $term->term_id . '">' . $term->name . ' </a></li>';
                    }
                    //print_r($terms);
                echo '</ul>';
             echo '</div>';
           echo '</div>'; 
        }
          echo '<ul class="da-thumbs widget_portfolio_items isotope-container portfolio'.$instance['columns'].' portfolio_items">';
       if ( get_query_var('paged') ) {
          $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ){
         $paged = get_query_var('page');
        } else {
         $paged = 1;
        }
      $array_val = ( !empty( $instance['portfolio_widget_category'] )) ? explode(',',  $instance['portfolio_widget_category']) : '';
        if( $instance["Popular_post_display"] == '1' || $instance["Popular_post_display"] == 'on' ){
           $args = array('paged' => $paged, 'post_type' => 'portfolio', 'showposts' => $instance['limit'], 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'field' => 'id', 'order' => $instance['pf_display_order'], 'taxonomy' => 'portfolio_category');
        }else{
        if( $array_val ) {
          $args = array('paged' => $paged,'post_type' => 'portfolio',  'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['pf_display_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'portfolio_category',   'field' => 'id', 'terms' => $array_val  )));
          }else{
            $args = array('paged' => $paged,'post_type' => 'portfolio', 'term' => $instance['portfolio_widget_category'], 'taxonomy' => 'portfolio_category','posts_per_page' => $instance['limit'], 'order' => $instance['pf_display_order'], 'orderby' => $instance['pf_display_orderby']);
          }
        }
           query_posts($args);
            if( have_posts() ) : while( have_posts() ) : the_post();
             $img_url =wp_get_attachment_url( get_post_thumbnail_id() );
               $terms = get_the_terms(get_the_ID(), 'portfolio_category');
            $terms_id = array();
        $terms_name = array();
        if($terms ){
        foreach ($terms as $term) {
          $terms_id[] = 'cat-'.$term->term_id;
          $terms_name[] = $term->name;
        }
      }else{
        $terms_name[] = 'Uncategorized';
      }
        echo '<li class="isotope-item all '.implode(' ', $terms_id).'"> ';   ?>
        <?php 
        global $post;
        $video_url = get_post_meta($post->ID,'video_url',true);
        $img_url = wp_get_attachment_url( get_post_thumbnail_id() );
        $default_image =  get_template_directory_uri().'/images/defult_featured_img.png';
        $light_box_image_url = $img_url ? $img_url : $default_image;
        $lightbox_url = $video_url ? $video_url : $light_box_image_url;
          global $post;
            if( $instance['enable_lightbox_image'] == 'on' ){
                echo '<a data-gal="prettyPhoto[gallery2]" href="'.$lightbox_url.'">';
               }else{
                  echo '<a  href="'.get_permalink().'">';
              }
            if( $img_url ) {
              echo '<img src="'.aq_resize( $img_url, $width, $height, true ).'" alt="'.get_the_title().'" />';
              }else{
                echo '<img src="'.get_template_directory_uri().'/images/defult_featured_img.png" alt="'.get_the_title().'" style="width:500px; height:200px;">'; 
                } ?>
            <?php 
            if( $instance['hide_post_title'] != 'on' ):  ?>
              <div class="portfolio_overlay" style="background-color:<?php echo $instance['post_thumb_hover_color']; ?>!important;">
                <div class="overlay_content">
              <?php

              echo '<h4 style="color:'.$instance['post_title_color'].'!important;">'.get_the_title().'</h4>';  
              echo '<p style="color:'.$instance['post_title_color'].'!important;">'.implode(' , ', $terms_name).'</p>';
              echo '</div>';
              echo '</div>';
              endif; 
        ?>
      </a>
       </li>
       <?php endwhile; endif; 
         echo '</ul>';
        if( $instance['enable_pagination'] == 'on' ):
          echo kaya_pagination();
        endif;
         wp_reset_query(); // End loop
         //endif;
     echo '</div>';
    //echo $args['after_widget'];
     echo '</div>';
   }
   function form( $instance ){
     $fullscreen_slider_categories = get_terms('portfolio_category');
     if( $fullscreen_slider_categories ){
     foreach ($fullscreen_slider_categories as $fullscreen_slider_cat) {
      $fullscreen_category_ids[] = $fullscreen_slider_cat->term_id;
      $fullscreen_category_names[] = $fullscreen_slider_cat->name.'-'.$fullscreen_slider_cat->term_id;
     }
   }else{
      $fullscreen_category_names[] =""; $fullscreen_category_ids[]="";
   }
       $instance = wp_parse_args( $instance, array(

        'Select_disply_style' => '', 
        'columns' => '',
        'kaya_portfolio_filter' => '',
        'portfolio_widget_category' => implode(',', $fullscreen_category_ids),
        'pf_display_orderby' => '',
        'pf_display_order' => '',
        'limit' => '50',
        'hide_post_link_icon' => '',
        'hide_lightbox_icon' => '',
        'hide_post_title' => '',
        'post_title_color' => '#333333',
        'post_thumb_hover_color' => '#e7a802',
        'post_thumb_width' => '650',
        'post_thumb_height' => '650',
        'video_id' => '',
        'disable_pattern' => '',
        'fluid_pf_gallery' => '',
        'Popular_post_display' => '',
        'enable_pagination' => '',
        'enable_lightbox_image' => '',
        )); ?>
    <p>
      <label for="<?php echo $this->get_field_id('Select_disply_style') ?>"> <?php _e('Select Display style',haircare_widgets) ?> </label>
    <select id="<?php echo $this->get_field_id('Select_disply_style') ?>" name="<?php echo $this->get_field_name('Select_disply_style') ?>">
      <option value="grid_style" <?php selected('grid_style', $instance['Select_disply_style']) ?>> <?php esc_html_e('Grid Style', haircare_widgets) ?> </option>
      <option value="masonry_gallery" <?php selected('masonry_gallery', $instance['Select_disply_style']) ?>> <?php esc_html_e('Masonry Gallery', haircare_widgets) ?> </option>
      </select>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('portfolio_widget_category') ?>">
  <?php _e('Select Portfolio Category IDs : ',haircare_widgets) ?>
  </label>
  <input type="text" value="<?php echo $instance['portfolio_widget_category']; ?>" name="<?php echo $this->get_field_name('portfolio_widget_category') ?>" id="<?php echo $this->get_field_id('portfolio_widget_category') ?>"><br>
  <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(', ', $fullscreen_category_names); ?></em><br />
  <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
</p>
</p>
<p>
  <label for="<?php echo $this->get_field_id('kaya_portfolio_filter') ?>">
  <?php _e('Portfolio Filter Tabs',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('kaya_portfolio_filter') ?>" name="<?php echo $this->get_field_name('kaya_portfolio_filter') ?>">
    <option value="false" <?php selected('false', $instance['kaya_portfolio_filter']) ?>>
    <?php esc_html_e('False', '') ?>
    </option>
    <option value="true" <?php selected('true', $instance['kaya_portfolio_filter']) ?>>
    <?php esc_html_e('True', '') ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('columns') ?>">
  <?php _e('Select Columns',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('columns') ?>" name="<?php echo $this->get_field_name('columns') ?>">
    <option value="5" <?php selected('5', $instance['columns']) ?>>
    <?php esc_html_e('Column5', '') ?>
    </option>
    <option value="4" <?php selected('4', $instance['columns']) ?>>
    <?php esc_html_e('Column4', '') ?>
    </option>
    <option value="3" <?php selected('3', $instance['columns']) ?>>
    <?php esc_html_e('Column3', '') ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('pf_display_orderby') ?>">
  <?php _e('Orderby',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('pf_display_orderby') ?>" name="<?php echo $this->get_field_name('pf_display_orderby') ?>">
    <option value="date" <?php selected('date', $instance['pf_display_orderby']) ?>>
    <?php esc_html_e('Date', haircare_widgets) ?>
    </option>
    <option value="menu_order" <?php selected('menu_order', $instance['pf_display_orderby']) ?>>
    <?php esc_html_e('Menu Order', haircare_widgets) ?>
    </option>
    <option value="title" <?php selected('title', $instance['pf_display_orderby']) ?>>
    <?php esc_html_e('Title', haircare_widgets) ?>
    </option>
    <option value="rand" <?php selected('rand', $instance['pf_display_orderby']) ?>>
    <?php esc_html_e('Random', haircare_widgets) ?>
    </option>
    <option value="author" <?php selected('author', $instance['pf_display_orderby']) ?>>
    <?php esc_html_e('Author', haircare_widgets) ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('pf_display_order') ?>">
  <?php _e('Order',haircare_widgets)?>
  </label>
  <select id="<?php echo $this->get_field_id('pf_display_order') ?>" name="<?php echo $this->get_field_name('pf_display_order') ?>">
        <option value="DESC" <?php selected('DESC', $instance['pf_display_order']) ?>>
    <?php esc_html_e('Descending', haircare_widgets) ?>
    </option>
    <option value="ASC" <?php selected('ASC', $instance['pf_display_order']) ?>>
    <?php esc_html_e('Ascending', haircare_widgets) ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_thumb_width'); ?>"><?php _e('Post Thumbnail Width',haircare_widgets) ?></label>
  <input type="text" name="<?php echo $this->get_field_name('post_thumb_width') ?>" id="<?php echo $this->get_field_id('post_thumb_width') ?>" class="widefat" value="<?php echo $instance['post_thumb_width'] ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('post_thumb_height'); ?>"><?php _e('Post Thumbnail Height',haircare_widgets) ?></label>
  <input type="text" name="<?php echo $this->get_field_name('post_thumb_height') ?>" id="<?php echo $this->get_field_id('post_thumb_height') ?>" class="widefat" value="<?php echo $instance['post_thumb_height'] ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_thumb_hover_color'); ?>"><?php _e('Post Thumbnail Hover Background Color',haircare_widgets) ?></label>
  <input type="text" name="<?php echo $this->get_field_name('post_thumb_hover_color') ?>" id="<?php echo $this->get_field_id('post_thumb_hover_color') ?>" class="widefat" value="<?php echo $instance['post_thumb_hover_color'] ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_title_color'); ?>"><?php _e('Post Thumbnail Hover Title Color',haircare_widgets) ?></label>
  <input type="text" name="<?php echo $this->get_field_name('post_title_color') ?>" id="<?php echo $this->get_field_id('post_title_color') ?>" class="widefat" value="<?php echo $instance['post_title_color'] ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('fluid_pf_gallery') ?>"><?php _e('Full Width Portfolio',haircare_widgets)?></label>&nbsp;
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("fluid_pf_gallery"); ?>" name="<?php echo $this->get_field_name("fluid_pf_gallery"); ?>"<?php checked( (bool) $instance["fluid_pf_gallery"], true ); ?> />
  </p>
  </p>
  <label for="<?php echo $this->get_field_id('Popular_post_display') ?>">
  <?php _e('Popular Posts',haircare_widgets)?>
  </label>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("Popular_post_display"); ?>" name="<?php echo $this->get_field_name("Popular_post_display"); ?>"<?php checked( (bool) $instance["Popular_post_display"], true ); ?> />
</p>
  <p>
    <label for="<?php echo $this->get_field_id('hide_post_title') ?>"><?php _e('Disable Post Title',haircare_widgets)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_post_title"); ?>" name="<?php echo $this->get_field_name("hide_post_title"); ?>"<?php checked( (bool) $instance["hide_post_title"], true ); ?> />
  </p>
 <p>
    <label for="<?php echo $this->get_field_id('enable_pagination') ?>"><?php _e('Enable Pagination',haircare_widgets)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_pagination"); ?>" name="<?php echo $this->get_field_name("enable_pagination"); ?>"<?php checked( (bool) $instance["enable_pagination"], true ); ?> />
  </p>
   <p>
    <label for="<?php echo $this->get_field_id('enable_lightbox_image') ?>"><?php _e('Image Lightbox',haircare_widgets)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_lightbox_image"); ?>" name="<?php echo $this->get_field_name("enable_lightbox_image"); ?>"<?php checked( (bool) $instance["enable_lightbox_image"], true ); ?> />
  </p>  
<p>
  <label for="<?php echo $this->get_field_id('limit') ?>"> <?php _e('Display Number of Images',haircare_widgets) ?> </label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('limit') ?>" value="<?php echo esc_attr($instance['limit']) ?>" name="<?php echo $this->get_field_name('limit') ?>" />
</p>

   <?php }
 }
/* Charts */
// Skill set
 class Haircare_circular_skill_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-skillset',
      __('Hair Care - Circular Skillset',haircare_widgets),
      array( 'description' => __('Use this widget to display circular Skillset.',haircare_widgets),'class' => 'kaya_skillset' )
    );
    }
    public function widget( $args , $instance ){
        echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
            'title' => '',
            'title_color' =>'#333333',
            'bar_color'  =>'#2ACCBF' ,
            'track_color' => '#333333',
            'skillset_width' => '75',
            'kaya_scroll_animation' => __('none',haircare_widgets),
            'skill_bar_icon' => __('fa-camera',haircare_widgets),
            'skill_bar_icon_color' => '#333',
            'skill_bar_content' => __('Enter circular Chart Descritpion',haircare_widgets),
            'content_color' => '#787878'
         ));

         $chart_rand = rand(1,100);
          ?>
    <script type="text/javascript">
           jQuery(function() {
          jQuery('.chart<?php echo $chart_rand; ?>').easyPieChart({
              barColor:'<?php echo $instance["bar_color"]; ?>',
              trackColor: '<?php echo $instance["track_color"]; ?>',
              scaleColor: false,
              lineCap: '',
              lineWidth: 10,
              animate: 1000,
              size: 180      
        });
    });
   </script>
   <div class="chart_wrapper">
      <div class="chart">
         <?php if( $instance['title'] ): ?><div class="label"><h3 style="color:<?php echo $instance['title_color']; ?>"><?php echo $instance['title']; ?></h3></div>  <?php endif; ?>
          <div class="chart<?php echo $chart_rand; ?> percentage-light" data-percent="<?php echo $instance['skillset_width']; ?>%" style="color:<?php echo $instance['title_color']; ?>"><div class="skills"><span style="color:<?php echo $instance["bar_color"]; ?>"><?php //echo $instance['skillset_width']; ?></span>
            <span style="color:<?php echo $instance['skill_bar_icon_color']; ?>!important;" class="circle_icon fa <?php echo $instance['skill_bar_icon']; ?>"> </span>
           </div> </div>
        </div>
        <p style="color:<?php echo $instance['content_color']; ?>"><?php echo $instance['skill_bar_content']; ?> </p>
      </div>



   <?php      echo  $args['after_widget'];
    }
  public function form( $instance ){
        $instance = wp_parse_args( $instance, array(
           'title' => '',
           'title_color' =>'#333333',
           'bar_color'  =>'#2ACCBF' ,
           'track_color' => '#333333',
           'skillset_width' => '75',
           'kaya_scroll_animation' => __('none',haircare_widgets),
           'skill_bar_icon' => __('fa-camera',haircare_widgets),
           'skill_bar_icon_color' => '#333',
           'skill_bar_content' => __('Enter circular Chart Descritpion',haircare_widgets),
           'content_color' => '#787878'
        ) );
        ?>
          <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo $instance['title_color'] ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('skillset_width'); ?>"><?php _e('Skillset Width',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('skillset_width') ?>" id="<?php echo $this->get_field_id('skillset_width') ?>" class="widefat" value="<?php echo $instance['skillset_width'] ?>" />
        </p>
         <p>
          <label for="<?php echo $this->get_field_id('bar_color'); ?>"><?php _e('Circular Bar Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('bar_color') ?>" id="<?php echo $this->get_field_id('bar_color') ?>" class="widefat" value="<?php echo $instance['bar_color'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('track_color'); ?>"><?php _e('Track Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('track_color') ?>" id="<?php echo $this->get_field_id('track_color') ?>" class="widefat" value="<?php echo $instance['track_color'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('skill_bar_icon'); ?>"><?php _e('Circular Chart Icon',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('skill_bar_icon') ?>" id="<?php echo $this->get_field_id('skill_bar_icon') ?>" class="widefat" value="<?php echo $instance['skill_bar_icon'] ?>" />
        </p>
         <small>  <?php _e('Ex: fa-camera, for More Awesome icons click',haircare_widgets); ?> <a href='http://fontawesome.io/icons/' target='_blank'> click here </a></small>
        <p>
            <label for="<?php echo $this->get_field_id('skill_bar_icon_color'); ?>"><?php _e('Circular Chart Icon Color Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('skill_bar_icon_color') ?>" id="<?php echo $this->get_field_id('skill_bar_icon_color') ?>" class="widefat" value="<?php echo $instance['skill_bar_icon_color'] ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('skill_bar_content') ?>">  <?php _e('Circular Chart Description',haircare_widgets)?>   </label>
          <textarea type="text" id="<?php echo $this->get_field_id('skill_bar_content') ?>" class="widefat" name="<?php echo $this->get_field_name('skill_bar_content') ?>" value = "<?php echo esc_attr( $instance['skill_bar_content'] ) ?>" > <?php echo $instance['skill_bar_content'] ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content_color'); ?>"><?php _e('Content Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('content_color') ?>" id="<?php echo $this->get_field_id('content_color') ?>" class="widefat" value="<?php echo $instance['content_color'] ?>" />
        </p>
     <?php  }
 }
 // Team Widget
 class Haircare_Team_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-team_widget',
      __('Hair Care - Team',haircare_widgets),
      array( 'description' => __('Use this widget to add team blocks.',haircare_widgets) ,'class' => 'kaya_title' )
    );
    }
    public function widget( $args , $instance ){
        echo $args['before_widget'];
        $instance = wp_parse_args( $instance, array(
            'title' => __('Add Team Title',haircare_widgets),
            'team_designation' => __('Designation',haircare_widgets),
            'team_description_color' => '#787878',
            'title_color' => '#ffffff',
            'team_designation_color' => '#626262',
            'team_info_bg_color' => '#131c20',
            'link' => '#',
            "team_src" => '',
            'team_social_icon' => '<a href="#"><i class="fa fa-facebook"></i></a>
                                  <a href="#"><i class="fa fa-twitter"></i></a>
                                  <a href="#"><i class="fa fa-google-plus"></i></a>
                                  <a href="#"><i class="fa fa-rss"></i></a>
                                  <a href="#"><i class="fa fa-skype"></i></a>
                                  <a href="#"><i class="fa fa-linkedin"></i></a>',
              ) );  
         $rand = rand(1,100);
         ?>
       <style type="text/css">
          .team_social_icon_<?php echo $rand; ?> > a i {
            color: <?php echo $instance['title_color']; ?>
          }
          .team_social_icon_<?php echo $rand; ?> > a:hover {
            opacity: 0.7;
          }
        </style>
        <?php 
        echo "<div class='team_content_wrapper'>";
           if( $instance['team_src'] ){
              echo '<img src="'.aq_resize( $instance['team_src'], '', '800', true ).'" class="" alt="'.$instance['title'].'"  />';
             }else{
                echo '<img src="'.get_template_directory_uri().'/images/defult_featured_img.png" style="width:480px; height:250px;" alt="'.$instance['title'].'" >';
             } 
           ?>

          <div class="team_description" style="background-color:<?php echo $instance['team_info_bg_color']; ?>">    
           <?php if(!empty($instance['title'])): echo '<h5 style="color:'.$instance['title_color'].';"><a style="color:'.$instance['title_color'].';" href="'.$instance['link'].'">'.$instance['title'].'</a></h5>'; 
            endif; ?>
          <?php if(!empty($instance['team_designation'])): echo '<p style="color:'.$instance['team_designation_color'].';">'.$instance['team_designation'].'</p>'; endif; ?>
          <?php if(!empty( $instance['team_social_icon'] )): ?>
              <div class="team_social_icon team_social_icon_<?php echo $rand; ?>">
                 <?php echo $instance['team_social_icon']; ?>
              </div>
            <?php endif; ?>
        </div>
      </div>

    <?php  echo  $args['after_widget'];
    }

    public function form( $instance ){
        $instance = wp_parse_args( $instance, array(
            'title' => __('Add Team Title',haircare_widgets),
            'team_designation' => __('Designation',haircare_widgets),
            'team_description_color' => '#787878',
            'title_color' => '#ffffff',
            'team_designation_color' => '#626262',
            'team_info_bg_color' => '#131c20',
            'link' => '#',
            "team_src" => '',
            'team_social_icon' => '<a href="#"><i class="fa fa-facebook"></i></a>
                                  <a href="#"><i class="fa fa-twitter"></i></a>
                                  <a href="#"><i class="fa fa-google-plus"></i></a>
                                  <a href="#"><i class="fa fa-rss"></i></a>
                                  <a href="#"><i class="fa fa-skype"></i></a>
                                  <a href="#"><i class="fa fa-linkedin"></i></a>',
              ) );    
          ?>
     <p><?php $i = rand(1,100); ?>
      <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['team_src'])){echo $instance['team_src'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
      <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('team_src'); ?>" id="<?php echo $this->get_field_id('team_src'); ?>" value="<?php echo $instance['team_src']; ?>">
      <input type="button" value="<?php _e( 'Upload Image', 'themename' ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
      <script type="text/javascript">
        jQuery(document).ready( function(){
          jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
              e.preventDefault();
              var custom_uploader = wp.media({
                  title: 'Image Box Uploading',
                  button: {
                      text: 'Upload Image'
                  },
                  multiple: false  // Set this to true to allow multiple files to be selected
              })
              .on('select', function() {
                  var attachment = custom_uploader.state().get('selection').first().toJSON();
                  jQuery('.custom_media_image_<?php echo $i; ?>').attr('src', attachment.url);
                  jQuery('.custom_media_url_<?php echo $i; ?>').val(attachment.url);
              })
              .open();
          });
          });

      </script>
  </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo $instance['title_color'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Title Link',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('link') ?>" id="<?php echo $this->get_field_id('link') ?>" class="widefat" value="<?php echo $instance['link'] ?>" />
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('team_info_bg_color'); ?>"><?php _e('Team Content Background Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('team_info_bg_color') ?>" id="<?php echo $this->get_field_id('team_info_bg_color') ?>" class="widefat" value="<?php echo $instance['team_info_bg_color'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('team_designation'); ?>"><?php _e('Team Designation',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('team_designation') ?>" id="<?php echo $this->get_field_id('team_designation') ?>" class="widefat" value="<?php echo $instance['team_designation'] ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('team_designation_color'); ?>"><?php _e('Designation Color',haircare_widgets) ?></label>
            <input type="text" name="<?php echo $this->get_field_name('team_designation_color') ?>" id="<?php echo $this->get_field_id('team_designation_color') ?>" class="widefat" value="<?php echo $instance['team_designation_color'] ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('team_social_icon') ?>">  <?php _e('Team Social Icons',haircare_widgets)?>   </label>
          <textarea type="text" id="<?php echo $this->get_field_id('team_social_icon') ?>" class="widefat" name="<?php echo $this->get_field_name('team_social_icon') ?>" value = "<?php echo esc_attr( $instance['team_social_icon'] ) ?>" > <?php echo $instance['team_social_icon'] ?></textarea>
        </p>


<?php  }

 }
   // Skill Set
 class Haircare_Skillset_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-skillbar',
      __('Hair Care - Skillbar',haircare_widgets),
      array( 'description' => __('Use this widget to add bar type skills.',haircare_widgets) ,'class' => 'kaya_skllbar' )
    );
    }
    public function widget( $args , $instance ){
      echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(

            'title' => __('PHP',haircare_widgets),
            'skillset_width' => '85',
            'skillbar_color' => '#e7a802',
             'skillbar_title_color' => '#333333',
         ) ); ?>
         <div class="skillbar clearfix " data-percent="<?php echo $instance['skillset_width']; ?>%">
      <div class="skillbar-title" style="background: <?php echo $instance['skillbar_color']; ?>px;">
        <span style="color:<?php echo $instance['skillbar_title_color'];?>;"><?php echo $instance['title']; ?></span></div>
      <div class="skillbar-bar" style="background: <?php echo $instance['skillbar_color']; ?>;"></div>
      <span class="left_arrow" style="border-left: 0px solid <?php echo $instance['skillbar_color']; ?>;">&nbsp;</span>
      <div style="color:<?php echo $instance['skillbar_title_color'];?>;" class="skill-bar-percent"><?php echo $instance['skillset_width']; ?>%</div>
    </div>
    <?php  echo $args['after_widget']; ?>
    <?php }

    public function form( $instance ){

        $instance = wp_parse_args( $instance, array(

               'title' => __('PHP',haircare_widgets),
            'skillset_width' => '85',
            'skillbar_color' => '#0099900',
             'skillbar_title_color' => '#333333',
             ) );       ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Skillbar Title',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $instance['title']; ?>" />
        </p>
           <p>
            <label for="<?php echo $this->get_field_id('skillbar_title_color') ?>"><?php _e('Skillbar Title Color',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('skillbar_title_color') ?>" name="<?php echo $this->get_field_name('skillbar_title_color') ?>" value="<?php echo $instance['skillbar_title_color']; ?>" />
        </p>
       <p>
            <label for="<?php echo $this->get_field_id('skillset_width') ?>"><?php _e('Skillbar Width',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('skillset_width') ?>" name="<?php echo $this->get_field_name('skillset_width') ?>" value="<?php echo $instance['skillset_width']; ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('skillbar_color') ?>"><?php _e('Skillbar Color',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('skillbar_color') ?>" name="<?php echo $this->get_field_name('skillbar_color') ?>" value="<?php echo $instance['skillbar_color']; ?>" />
        </p>
     <?php  }

 }
 /**
 *  Contact Form
 */
 class Haircare_Contact_Form extends WP_Widget
 {
  public function __construct(){
   parent::__construct( 'haircare-contact-form', 
      __('Hair Care - Contact Form', haircare_widgets),
      array(  'description' => __('Add contact form widget.',haircare_widgets), 'class' => 'contact_form'   ));
   }
   public function widget( $args , $instance ){

      $instance = wp_parse_args($instance , array(
            'button_text' => __('Mail Us',haircare_widgets),
            'clear_button_text' => __('Clear',haircare_widgets),
            'email_id' => __('yourdomain@gmail.com',haircare_widgets),
        ));
      echo $args['before_widget']; 
      ?>
        <form method="post" action="sendEmail.php" name="contact-form" id="contact-form">
          <div id="main">
            <div id="contact_response" > </div>
            <input type="hidden" name="siteemail" id="siteemail" value="<?php echo $instance['email_id']; ?>" />
            <p class="one_third"><input type="text" name="name" id="name" size="23"  placeholder="<?php _e('Name',haircare_widgets); ?>" /></p>
            <p class="one_third"><input type="text" name="contact_email" placeholder="<?php _e('Email',haircare_widgets); ?>" id="contact_email" size="23" /></p>
            <p class="one_third_last"><input type="text" name="subject" placeholder="<?php _e('Subject',haircare_widgets); ?>" id="subject" size="23" /></p>
            <p class="fullwidth"><textarea name="message" id="message" cols="30" rows="4" placeholder="<?php _e('Your Message',haircare_widgets); ?>"></textarea></p>
            <p style="padding-bottom:0"><input  class="readmore readmore-1 readmore-1a" type="submit" name="contact_submit" id="contact_submit" value="<?php echo $instance['button_text'] ?>" /> 
              <?php if( $instance['clear_button_text']  ) : ?>
              <input  class="readmore readmore-1 readmore-1a" type="reset" name="reset" id="reset" value="<?php echo $instance['clear_button_text'] ?>" />
              <?php endif; ?> 
              </p>
        </div>
        </form>
      <?php echo $args['after_widget']; 
   }
   public function form( $instance ){
           $instance = wp_parse_args($instance , array(
            'button_text' => __('Mail Us',haircare_widgets),
            'clear_button_text' => __('Clear',haircare_widgets),
            'email_id' => __('yourdomain@gmail.com',haircare_widgets),
        ));
  ?>
   <p>
      <label for="<?php echo $this->get_field_id('email_id'); ?>"> <?php _e('Email Id To Receive Emails',haircare_widgets) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('email_id') ?>" id="<?php echo $this->get_field_id('email_id') ?>" class="widefat" value="<?php echo $instance['email_id'] ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('button_text'); ?>"> <?php _e('Submit Button Text',haircare_widgets) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('button_text') ?>" id="<?php echo $this->get_field_id('button_text') ?>" class="widefat" value="<?php echo $instance['button_text'] ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('clear_button_text'); ?>"> <?php _e('Clear Button Text',haircare_widgets) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('clear_button_text') ?>" id="<?php echo $this->get_field_id('clear_button_text') ?>" class="widefat" value="<?php echo $instance['clear_button_text'] ?>" />
    </p>  
 <?php }
  }
   // Blog Page
 class Haircare_Blog_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-blog',
      __('Hair Care - Blog',haircare_widgets),
      array( 'description' => __('Use this widget to create blog page.',haircare_widgets) ,'class' => 'kaya_blog' )
    );
    }
    public function widget( $args , $instance ){
     //echo $args['before_widget'];
      global $post;
        $instance = wp_parse_args($instance, array(
            'content_limit' => '30',
            'post_limit' => '10',
            'blog_category' => '',
            'title_color' => '#333333',
            'content_color' => '#787878',
            'posts_link_color' => '#1e85be',
            'posts_link_hover_color' => '#e7a802',
            'disable_pagination' => '',
            'blog_posts_order_by' => '',
            'blog_posts_order' => '',
            'readmore_button_text' => __('Read More',haircare_widgets),
            'post_title_color' => '#333333',
         ) ); ?>
       <style type="text/css">
           #mid_container_wrapper .blog_post_wrapper .meta_desc a{
            color: <?php echo $instance['posts_link_color']; ?>
          }
          #mid_container_wrapper .blog_post_wrapper .meta_desc a:hover{
            color: <?php echo $instance['posts_link_hover_color']; ?>!important;
          }
          #mid_container_wrapper .blog_post_wrapper p,  #mid_container_wrapper .blog_post_wrapper{
            color: <?php echo $instance['content_color']; ?>
          }           
        </style>
        <?php echo '<div class="blog_post_wrapper">';
          if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
          } elseif ( get_query_var('page') ){
            $paged = get_query_var('page');
          } else {
            $paged = 1;
          }
          $args = array(
               'cat' =>  $instance['blog_category'],
               'post_type' => 'post',
               'posts_per_page' => $instance['post_limit'],
               'paged' => $paged,
                'orderby' => $instance['blog_posts_order_by'], 
                'order' => $instance['blog_posts_order'], 
               );
      query_posts($args);
      if(have_posts() ) : while( have_posts() ) : the_post(); 
      //$kaya_readmore_blog=get_theme_mod('readmore_button_text') ? get_theme_mod('readmore_button_text') : 'Read More';
      $class="two_third_last";
      ?>
        <article <?php post_class('standard-blog'); ?> >
    <div class="blog_post_wrapper">
  
  <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
      echo '<div class="blog_img  ">';
        echo '<a href="'.get_permalink().'">';
        if( (get_post_meta( $post->ID, 'kaya_image_streatch', true )) == "0") {
         $params = array('width' => '1100', 'height' => '500', 'crop' => true);
        }else{
           $params = array('width' => '', 'height' => '', 'crop' => true);
        }
          $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
          echo kaya_imageresize($img_url,$params,'');
        echo '</a>'; ?>
        </div>
      <?php }   ?>
       <div class="blog_post_info"> 
      <div class="one_third">
      <span class="meta_desc">
        <span class="author"><i class="fa fa-user">&nbsp;</i><?php the_author_posts_link(); ?></span>
        <span class="category"><i class="fa fa-folder">&nbsp;</i><?php the_category(', '); ?></span>
        <span class="post_date"><i class="fa fa-clock-o">&nbsp;</i><?php echo get_the_date('M d, Y'); ?></span>
        <span class="comment"><i class="fa fa-comments">&nbsp;</i><?php comments_popup_link(__('0 Comments',haircare_widgets ), __( '1 Comment', haircare_widgets ), __( '% Comments', haircare_widgets ) ); ?></span>
        <?php echo '</span>'; ?>
      </div>
        <div class="two_third_last">
         <h3><a style="color:<?php echo $instance['post_title_color']; ?>;" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', haircare_widgets ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?> </a>  </h3>
           <p><?php echo trim( strip_tags( haircare_content($instance['content_limit']) ) ); ?></p>
           <?php if( $instance['readmore_button_text'] ){ ?>
            <a href="<?php echo the_permalink(); ?>" class="readmore"><?php echo $instance['readmore_button_text'] ?></a>
           <?php  } ?>
         </div>
   </div>
    
   <div class="clear"> </div>
   </div>
  </article>
      <?php endwhile; endif; 
      if( $instance['disable_pagination'] != 'on' ){
         echo kaya_pagination(); 
      }
       wp_reset_query(); ?>
    </div>
    <?php  //echo $args['after_widget']; 
   ?>
    <?php }
public function form( $instance ){
  $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name .' - '.$category->cat_ID;
               $blog_cat_id[] = $category->cat_ID;
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] = '';
      }
    $instance = wp_parse_args( $instance, array(
        'content_limit' => '30',
        'post_limit' => '10',
        'blog_category' => implode(',',$blog_cat_id),
        'title_color' => '#333333',
        'content_color' => '#787878',
        'posts_link_color' => '#1e85be',
        'posts_link_hover_color' => '#e7a802',
        'disable_pagination' => '',
        'blog_posts_order_by' => '',
        'blog_posts_order' => '',
        'readmore_button_text' => __('Read More',haircare_widgets),
        'post_title_color' => '#333333',
             ) );  ?>
        <p>
      <label for="<?php echo $this->get_field_id('blog_category') ?>">
      <?php _e('Enter Blog Category IDs : ',haircare_widgets) ?>
      </label>
          <input type="text" name="<?php echo $this->get_field_name('blog_category') ?>" id="<?php echo $this->get_field_id('blog_category') ?>" class="widefat" value="<?php echo $instance['blog_category'] ?>" />
     <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',haircare_widgets); ?> </strong> <?php echo implode(',', $blog_cat_name); ?></em><br />
      <stong><?php _e('Note:',haircare_widgets); ?></strong><?php _e('Separate IDs with commas only',haircare_widgets); ?>
    </p>
           <p>
      <label for="<?php echo $this->get_field_id('blog_posts_order_by') ?>"><?php _e('Orderby',haircare_widgets)?></label>
        <select id="<?php echo $this->get_field_id('blog_posts_order_by') ?>" name="<?php echo $this->get_field_name('blog_posts_order_by') ?>">
        <option value="date" <?php selected('date', $instance['blog_posts_order_by']) ?>>
          <?php esc_html_e('Date', haircare_widgets) ?></option>
       <option value="menu_order" <?php selected('menu_order', $instance['blog_posts_order_by']) ?>>
        <?php esc_html_e('Menu Order', haircare_widgets) ?></option>
        <option value="title" <?php selected('title', $instance['blog_posts_order_by']) ?>>
          <?php esc_html_e('Title', haircare_widgets) ?></option>
        <option value="rand" <?php selected('rand', $instance['blog_posts_order_by']) ?>>
          <?php esc_html_e('Random', haircare_widgets) ?></option>
        <option value="author" <?php selected('author', $instance['blog_posts_order_by']) ?>>
          <?php esc_html_e('Author', haircare_widgets) ?></option>
      </select>
        </p>
       <p>
      <label for="<?php echo $this->get_field_id('blog_posts_order') ?>"><?php _e('Order',haircare_widgets)?></label>
        <select id="<?php echo $this->get_field_id('blog_posts_order') ?>" name="<?php echo $this->get_field_name('blog_posts_order') ?>">
         <option value="DESC" <?php selected('DESC', $instance['blog_posts_order']) ?>>
          <?php esc_html_e('Descending', haircare_widgets) ?></option> 
        <option value="ASC" <?php selected('ASC', $instance['blog_posts_order']) ?>>
          <?php esc_html_e('Ascending', haircare_widgets) ?></option>
      </select>
        </p> 
           <p>
            <label for="<?php echo $this->get_field_id('content_limit') ?>"><?php _e('Post Content Limit',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('content_limit') ?>" name="<?php echo $this->get_field_name('content_limit') ?>" value="<?php echo $instance['content_limit']; ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('readmore_button_text') ?>"><?php _e('Readmore Button Text',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_button_text') ?>" name="<?php echo $this->get_field_name('readmore_button_text') ?>" value="<?php echo $instance['readmore_button_text']; ?>" />
        </p>
       <p>
            <label for="<?php echo $this->get_field_id('post_limit') ?>"><?php _e('Display Posts Per Page',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_limit') ?>" name="<?php echo $this->get_field_name('post_limit') ?>" value="<?php echo $instance['post_limit']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_title_color') ?>"><?php _e('Posts Title Color',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_title_color') ?>" name="<?php echo $this->get_field_name('post_title_color') ?>" value="<?php echo $instance['post_title_color']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content_color') ?>"><?php _e('Posts Content Color',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('content_color') ?>" name="<?php echo $this->get_field_name('content_color') ?>" value="<?php echo $instance['content_color']; ?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('posts_link_color') ?>"><?php _e('Posts Link Color',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('posts_link_color') ?>" name="<?php echo $this->get_field_name('posts_link_color') ?>" value="<?php echo $instance['posts_link_color']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_link_hover_color') ?>"><?php _e('Posts Link Hover Color',haircare_widgets)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('posts_link_hover_color') ?>" name="<?php echo $this->get_field_name('posts_link_hover_color') ?>" value="<?php echo $instance['posts_link_hover_color']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('disable_pagination') ?>"> <?php _e('Disable Pagination',haircare_widgets) ?> </label>
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
      </p>
     <?php  }

 }
 /* ------------------------------------
// Price list table
---------------------------------------*/
 class Haircare_Simple_Pricetable_Widget extends WP_Widget{
   public function __construct(){
   parent::__construct(  'kaya-price-table-menu',
      __('Hair Care - Tabular Price',haircare_widgets),
      array( 'description' => __('Add hair salon price in table format.',haircare_widgets), 'class' => 'kaya_food_menu_widget' )
    );
    }
    public function widget( $args , $instance ){
        $instance = wp_parse_args($instance, array(
          'title' => __('Tabular Menu Title',haircare_widgets),
          'title_color' => '',
          'list_box' => '',
          'text_align' => __('left',haircare_widgets),
          'items_list_box' => '<ul>
            <li><span>Hair Dressing </span><span>$30</span></li>
            <li><span>Hair Color</span><span>$10</span></li>
            <li><span>Hair Dressing</span><span>$30</span></li>
            </ul>',
           'items_list_box_text_color' => '#ffffff',
          'items_list_box_bg_color' => '#333',
          'items_list_font_size' => '13',

             )); 
        $rand = rand(1,100);
  echo $args['before_widget']; ?>
   <style type="text/css">
        .items_list_box<?php echo $rand; ?> ul li{
          color: <?php echo $instance['items_list_box_text_color']; ?>!important;
          background-color: <?php echo $instance['items_list_box_bg_color']; ?>!important;
          font-size: <?php echo $instance['items_list_font_size']; ?>px!important;
        }
      </style>
  <?php if( $instance['title'] ):

       echo '<div class="custom_title kaya_title_'.$instance['text_align'].'">';
         echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h3>';
      echo '</div>';
      ?>
  <div class="clear"> </div>
  <?php endif; 
         echo '<div class="items_list_box items_list_box'.$rand.'">';
            echo $instance['items_list_box'];
         echo '</div>';
         echo $args['after_widget'];
    }

    public function form( $instance ){

       $instance = wp_parse_args( $instance, array(
          'title' => __('Tabular Menu Title',haircare_widgets),
          'title_color' => '',
          'list_box' => '',
          'text_align' => __('left',haircare_widgets),
          'items_list_box' => '<ul>
            <li><span>Hair Dressing </span><span>$30</span></li>
            <li><span>Hair Color</span><span>$10</span></li>
            <li><span>Hair Dressing</span><span>$30</span></li>
            </ul>',
           'items_list_box_text_color' => '#ffffff',
          'items_list_box_bg_color' => '#333',
          'items_list_font_size' => '13',

        ) );
      ?>
      
        <p>
          <lable for="<?php echo $this->get_field_id('title'); ?>">
          <?php _e('Title',haircare_widgets); ?>
          </label>
          <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('title_color'); ?>">
          <?php _e('Title Color',haircare_widgets) ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo $instance['title_color'] ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('text_align') ?>"> <?php _e('Title Position',haircare_widgets)?> </label>
          <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
            <option value="left" <?php selected('left', $instance['text_align']) ?>>
            <?php esc_html_e(' Left', haircare_widgets) ?>
            </option>
            <option value="right" <?php selected('right', $instance['text_align']) ?>>
            <?php esc_html_e(' Right', haircare_widgets) ?>
            </option>
            <option value="center" <?php selected('center', $instance['text_align']) ?>>
            <?php esc_html_e(' Center', haircare_widgets) ?>
            </option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('items_list_box') ?>"> <?php _e('Menu Items List Box',haircare_widgets)?></label>
          <textarea type="text" id="<?php echo $this->get_field_id('items_list_box') ?>" class="widefat" name="<?php echo $this->get_field_name('items_list_box') ?>" value = "<?php echo esc_attr( $instance['items_list_box'] ) ?>" > <?php echo esc_attr( $instance['items_list_box'] ) ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('items_list_font_size'); ?>">
          <?php _e('Menu Items Font Size',haircare_widgets) ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('items_list_font_size') ?>" id="<?php echo $this->get_field_id('items_list_font_size') ?>" class="widefat" value="<?php echo $instance['items_list_font_size'] ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('items_list_box_bg_color'); ?>">
          <?php _e('Background Color',haircare_widgets) ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('items_list_box_bg_color') ?>" id="<?php echo $this->get_field_id('items_list_box_bg_color') ?>" class="widefat" value="<?php echo $instance['items_list_box_bg_color'] ?>" />
        </p>
         <p>
          <label for="<?php echo $this->get_field_id('items_list_box_text_color'); ?>">
          <?php _e('Text Color',haircare_widgets) ?>
          </label>
          <input type="text" name="<?php echo $this->get_field_name('items_list_box_text_color') ?>" id="<?php echo $this->get_field_id('items_list_box_text_color') ?>" class="widefat" value="<?php echo $instance['items_list_box_text_color'] ?>" />
        </p>
<?php  }

 }
 /* Opening Hours */
  class Haircare_Opening_Hours_Widget extends WP_Widget{
    public function __construct(){
        parent::__construct('kaya-opening-hours-widget',
            __('Hair Care - Opening Hours Widget',haircare_widgets),
            array('description' => __('Displays Recent post items from posts categories.',haircare_widgets), 'class' => 'recent_blog_post_widget')
        );
    }
     public function widget( $args, $instance ) {
      $instance = wp_parse_args( $instance, array(

            'title' => __('Opening Hours',haircare_widgets),
            'title_color' => '#333',
            'timing_color' => '#242424',
            'weekdays_color' => '#e7a802',
            'table_content' => '<ul>
              <li><span>Monday</span> 8:00 - 16:00</li>
              <li><span>Tuesday</span> 10:00 - 16:00</li>
              <li><span>Wednesday</span> 8:00 - 16:00</li>
              <li><span>Thursday</span> 8:00 - 16:00</li>
              <li><span>Friday</span> 8:00 - 16:00</li>
              <li><span>Saturday</span> 12:00 - 16:00</li>
              <li><span>Sunday</span>CLOSED</li>
            </ul>',
        ));
      echo $args['before_widget'];
      $rand_colors = rand(1,100); ?>
        <style>
          .opening_hours_middle li span{
            color:<?php echo $instance['weekdays_color']; ?>;
          }
          .opening_hours_middle li{
            color:<?php echo $instance['timing_color']; ?>;
          }
        </style>
    <?php  //echo 'This is Opening hours Widget';
      echo '<div class="opeing_hours_widget_wrapper">';
      echo '<div class="opening_hours_top"> </div>';
      echo '<div class="opening_hours_middle">';
      echo '<div class="opening_hours_title"><h3 style="color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h3></div>';
      echo $instance['table_content'];
      echo '</div>';
      echo '<div class="opening_hours_bottom"> </div>';
      echo '</div>';
      echo $args['after_widget'];
    }
    public function form($instance){
            $instance = wp_parse_args( $instance, array(
             'title' => __('Opening Hours',haircare_widgets),
            'title_color' => '#333',
            'timing_color' => '#242424',
            'weekdays_color' => '#e7a802',
            'table_content' => '<ul>
              <li><span>Monday</span> 8:00 - 16:00</li>
              <li><span>Tuesday</span> 10:00 - 16:00</li>
              <li><span>Wednesday</span> 8:00 - 16:00</li>
              <li><span>Thursday</span> 8:00 - 16:00</li>
              <li><span>Friday</span> 8:00 - 16:00</li>
              <li><span>Saturday</span> 12:00 - 16:00</li>
              <li><span>Sunday</span>CLOSED</li>
            </ul>',
        ));
    ?>
      <p> 
        <lable for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
      </p>
      <p> 
        <lable for="<?php echo $this->get_field_id('title_color'); ?>"> <?php _e('Title Color',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat" value="<?php echo esc_attr($instance['title_color']) ?>" name="<?php echo $this->get_field_name('title_color') ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('table_content') ?>"> <?php _e('Table Content',haircare_widgets)?></label>
        <textarea type="text" id="<?php echo $this->get_field_id('table_content') ?>" class="widefat" name="<?php echo $this->get_field_name('table_content') ?>" value = "<?php echo esc_attr( $instance['table_content'] ) ?>" > <?php echo esc_attr( $instance['table_content'] ) ?></textarea>
      </p>
      <p> 
        <lable for="<?php echo $this->get_field_id('weekdays_color'); ?>"> <?php _e('Week Days Color',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('weekdays_color') ?>" class="widefat" value="<?php echo esc_attr($instance['weekdays_color']) ?>" name="<?php echo $this->get_field_name('weekdays_color') ?>" />
      </p>
      <p> 
        <lable for="<?php echo $this->get_field_id('timing_color'); ?>"> <?php _e('Timing Colors',haircare_widgets); ?> </label>
        <input type="text" id="<?php echo $this->get_field_id('timing_color') ?>" class="widefat" value="<?php echo esc_attr($instance['timing_color']) ?>" name="<?php echo $this->get_field_name('timing_color') ?>" />
      </p>
  <?php   }

  }
  /**
 *  Make An appointment
 */
 class Haircare_Appointform extends WP_Widget
 {
  public function __construct(){
   parent::__construct( 'haircare-appointment-form', 
      __('Hair Care - Appointment Form', haircare_widgets),
      array(  'description' => __('Add Appointment form',haircare_widgets), 'class' => 'appointment_form'   ));
   }
    public function widget( $args , $instance ){

      $instance = wp_parse_args($instance , array(
            'button_text' => __('Mail Us',haircare_widgets),
            'clear_button_text' => __('Clear',haircare_widgets),
            'email_id' => __('yourdomain@gmail.com',haircare_widgets),
        ));
      echo $args['before_widget'];
         ?>
        <script type="text/javascript">
          jQuery(document).ready(function() {
            jQuery('.appointment_date').datepicker({
              dateFormat : 'dd-mm-yy'
            });
         });

        </script>
        <form method="post" action="appointment_form.php" name="contact-form" id="contact-form">

          <div id="main">
            <div id="response" />
          </div>
            <input type="hidden" name="appointment_email_id" id="appointment_email_id" value="<?php echo $instance['email_id']; ?>" />
            <p class="one_third"><input type="text" name="appointment_name" id="appointment_name" size="23"  placeholder="<?php _e('Name',haircare_widgets); ?>" /></p>
            <p class="one_third"><input type="text" name="appointment_email" placeholder="<?php _e('Email',haircare_widgets); ?>" id="appointment_email" size="23" /></p>
            <p class="one_third_last"> <input type="text" name="appointment_phone" id="appointment_phone" size="23"  placeholder="<?php _e('Phone',haircare_widgets); ?>"/></p>
            <p class="one_third"><input type="text" class="appointment_date" name="appointment_date" id="appointment_date"  placeholder="<?php _e('Appointment On',haircare_widgets); ?>" value=""/></p>
            <p class="one_third"><input type="text" name="appointment_time" placeholder="<?php _e('Time',haircare_widgets); ?>" id="appointment_time" size="23" /></p>
            <p class="one_third_last"><input type="text" name="appointment_subject" placeholder="<?php _e('Subject',haircare_widgets); ?>" id="appointment_subject" size="23" /></p>
            <p class="fullwidth"><textarea name="appointment_message" id="appointment_message" cols="30" rows="4" placeholder="<?php _e('Your Message',haircare_widgets); ?>"></textarea></p>
            <p style="padding-bottom:0"><input  class="readmore readmore-1 readmore-1a" type="submit" name="submit" id="submit" value="<?php echo $instance['button_text'] ?>" /> 
              <?php if(  $instance['clear_button_text'] ): ?>
                <input  class="readmore readmore-1 readmore-1a" type="reset" name="reset" id="reset" value="<?php echo $instance['clear_button_text'] ?>" />
              <?php endif; ?>
            </p>
        </div>
        </form>
      <?php echo $args['after_widget']; 
   }
   public function form( $instance ){
           $instance = wp_parse_args($instance , array(
            'button_text' => __('Mail Us',haircare_widgets),
            'clear_button_text' => __('Clear',haircare_widgets),
            'email_id' => __('yourdomain@gmail.com',haircare_widgets),
        ));
  ?>
  <p>
      <label for="<?php echo $this->get_field_id('email_id'); ?>"> <?php _e('Email Id',haircare_widgets) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('email_id') ?>" id="<?php echo $this->get_field_id('email_id') ?>" class="widefat" value="<?php echo $instance['email_id'] ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('button_text'); ?>"> <?php _e('Submit Button Text',haircare_widgets) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('button_text') ?>" id="<?php echo $this->get_field_id('button_text') ?>" class="widefat" value="<?php echo $instance['button_text'] ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('clear_button_text'); ?>"> <?php _e('Clear Button Text',haircare_widgets) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('clear_button_text') ?>" id="<?php echo $this->get_field_id('clear_button_text') ?>" class="widefat" value="<?php echo $instance['clear_button_text'] ?>" />
    </p>  
 <?php }
  }
 //Gallery Images
 class Haircare_Gallery_Images_Widget extends WP_Widget
 {
   function __construct()
   {
     parent::__construct( 'kaya-gallery-images-boxes',
        __('Haircare Images Gallery ',haircare_widgets),
       array('description' => __('Displays Gallery Image Columns ',haircare_widgets)  )
      );
   }
    function widget( $args, $instance ){
      $instance = wp_parse_args($instance,array(        
        'upload_images_ids' => '',
        'gallery_columns' => '4',
        'gallery_type' =>'',
        'enable_image_title' => '',
        'enable_grayscale_images' => '',
        'image_title_bg_color' => '#333333',
        'image_title_color' => '#ffffff',
        'image_bg_hover_color' => '',
        'gallery_images_space' => '',
        'image_radius' => '0',
        'gallery_image_shadow' => '',
        'animation_names' => '',
        'slider_auto_play' => __('true',haircare_widgets),
        'image_width' => '',
        'image_height' => '',
        'enable_image_zoom_hover' => '',
        'disable_light_box' => '',
        'slider_arrows_bg_color' => '#333333',
        'slider_arrows_color' => '#ffffff',
        'enable_slider_dots_buttons' => '',
        'disable_slider_arrow_buttons' => '',
        'slide_animation_in' => '',
        'slide_animation_out' => '',        
      ));

    echo $args['before_widget'];
    $gallery_rand=rand(1,500); 
    $enable_slider_dots_buttons = ($instance['enable_slider_dots_buttons'] == 'on' ) ? 'block' :'none';
    echo '<style>.gallery_image_wrapper_'.$gallery_rand.' .owl-next, .gallery_image_wrapper_'.$gallery_rand.' .owl-prev, .gallery_image_wrapper_'.$gallery_rand.' #gallery_widget_slider .owl-dots{ background-color:'.$instance['slider_arrows_bg_color'].'; color:'.$instance['slider_arrows_color'].';  }
      .gallery_image_wrapper_'.$gallery_rand.'  #gallery_widget_slider .owl-dots::after { border-color: transparent '.$instance['slider_arrows_bg_color'].' '.$instance['slider_arrows_bg_color'].' transparent; }
      .gallery_image_wrapper_'.$gallery_rand.'  #gallery_widget_slider .owl-dots { display:'.$enable_slider_dots_buttons.'!important; }
       .gallery_image_wrapper_'.$gallery_rand.' #gallery_widget_slider .owl-dot{ border:2px solid'.$instance['slider_arrows_color'].';  }
        .gallery_image_wrapper_'.$gallery_rand.' #gallery_widget_slider .owl-dot.active{ background:'.$instance['slider_arrows_color'].';  }
    </style>';
    //echo '<style> border-radius:'.$instance['image_radius'].'%; </style>';
    $gallery_image_shadow = ($instance['gallery_image_shadow'] == 'on') ? 'box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);' : '';
    $slider_auto_play = ($instance['gallery_type'] == 'gallery_slider') ? 'data-autoplay="'.$instance['slider_auto_play'].'"' : '';
    $grid_columns = ($instance['gallery_type'] == 'list_gallery_images') ? 'gallery_list_images' : 'gallery_image_columns_'.$instance['gallery_columns'].'';
    $image_height = $instance['image_height'] ? $instance['image_height']  : '650';
    $slider_radius = ($instance['gallery_type'] == 'gallery_slider') ? 'border-radius:0 0 '.$instance['image_radius'].'px '.$instance['image_radius'].'%;'  : '';
    $image_zoom_hover = ( $instance['enable_image_zoom_hover'] == 'on' ) ? 'img_zoom_hover' : '';
    $gray_scale = ($instance['enable_grayscale_images'] == 'on' ) ? 'on' :'off';
    $enable_slider_dots_buttons = ($instance['enable_slider_dots_buttons'] == 'on' ) ? 'off' :'on';
    $disable_slider_arrow_buttons = ($instance['disable_slider_arrow_buttons'] == 'on' ) ? 'false' :'true';
    $gallery_animation =   ( trim( $instance['animation_names'] ) )  ? 'wow '. $instance['animation_names'] : '';
    $gallery_image_sapce = ($instance['gallery_images_space'] == 'on') ? 'gallery_with_sapce' : 'gallery_no_space';
    $upload_image_ids = explode(',', trim( $instance['upload_images_ids']));
    if( trim( !empty($instance['upload_images_ids']) ) ){
      $upload_image_ids = array_unique( array_combine(range(1, count($upload_image_ids)), $upload_image_ids));
        echo '<div class="'. $gallery_animation .' '.$gallery_image_sapce.' gallery_image_wrapper '.$grid_columns.' gallery_image_wrapper_'.$gallery_rand.' '.$image_zoom_hover.'" data-radius="'.$instance['image_radius'].'" data-columns="'.$instance['gallery_columns'].'" data-grayscale="'.$gray_scale.'"  '.$slider_auto_play.'>';
      if( $instance['gallery_type'] == 'gallery_slider'){ // Slider
        echo '<div  class="" id="gallery_widget_slider" data-buttons="'.$disable_slider_arrow_buttons.'" data-animationin="'.$instance['slide_animation_in'].'" data-animationout="'.$instance['slide_animation_out'].'">';
          foreach ($upload_image_ids as $upload_image_id) {
          $attachment = get_post( $upload_image_id );

          $values =  array(
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
            );
            $upload_img_url = wp_get_attachment_image_src($upload_image_id, "full");
            $src = $upload_img_url[0];;
            $width = $upload_img_url[1];
            $height = $upload_img_url[2];
            $image_width = $instance['image_width'] ? $instance['image_width'] : $width;
            $image_height = $instance['image_height'] ? $instance['image_height'] : $height;
            $image_bg_color = $instance['image_bg_hover_color'] ? 'background-color:'.$instance['image_bg_hover_color'].';' : '';
            $image_custom_link= get_post_meta( $upload_image_id, '_image_custom_link', true ) ? get_post_meta( $upload_image_id, '_image_custom_link', true ) : '';
           $link_new_window= get_post_meta( $upload_image_id, '_link_new_window', true ) ? get_post_meta( $upload_image_id, '_link_new_window', true ) : '';
          //$target_link = ( $link_new_window == 'on' ) ? '_blank' : '_self';
          $customlink = $image_custom_link ? $image_custom_link : $src;
          $link_open = $image_custom_link ? 'target="'.$link_new_window.'"' : 'data-gal=prettyPhoto[image_gallery]';
            echo "<div class='image_gallery_slider ".$gallery_image_sapce."'  style=' border-radius:".$instance['image_radius']."px; '>";
            echo '<div class="image_hover_bg_color" style="'.$image_bg_color.';"> </div>';
            if( $instance['disable_light_box'] != 'on' ){
              echo "<a href=\" $customlink \"  $link_open style='border-radius:".$instance['image_radius']."px; '>";
            } 
            echo "<img src='".aq_resize( $src, $image_width, $image_height , 't' )."' alt='".esc_html($values['title'])."'; style='".$gallery_image_shadow."'>";
            if( $instance['disable_light_box'] != 'on' ){
              echo "</a>";
            }
            if( $instance['enable_image_title'] == 'custom_text' ){
              if( $values['description'] ):  echo '<div class="custom_text">';   echo $values['description'];   echo '</div>';
            endif; 
            }
            elseif( $instance['enable_image_title'] == 'custom_text_bottom' ){
              if( $values['description'] ):  echo '<div class="custon_text_bottom">';   echo $values['description'];   echo '</div>';
            endif; 
            }
            elseif( $instance['enable_image_title'] !='none' ){
              echo '<span class="gallery_caption '.$instance['enable_image_title'].'" style="background-color:'.$instance['image_title_bg_color'].'; color:'.$instance['image_title_color'].'; '.$slider_radius.'"><strong style="color:'.$instance['image_title_color'].';">'.$values['title'].'</strong>';
              echo '<p>'.$values['description'].'</p></span>'; 
            }else{ }
            echo "</div>";
           }
          echo '</div>'; // end
      }else{
        echo '<ul class="gallery-images">';
        foreach ($upload_image_ids as $upload_image_id) {
        $attachment = get_post( $upload_image_id );
        $values =  array(
          'caption' => $attachment->post_excerpt,
          'description' => $attachment->post_content,
          'href' => get_permalink( $attachment->ID ),
          'src' => $attachment->guid,
          'title' => $attachment->post_title
          );
         // $image_array_values = wp_get_attachment_image_src($upload_image_id, $size, false);
          $upload_img_url = wp_get_attachment_image_src($upload_image_id, "full");
          $src = $upload_img_url[0];;
          $width = $upload_img_url[1];
          $height = $upload_img_url[2];
          $image_custom_link= get_post_meta( $upload_image_id, '_image_custom_link', true ) ? get_post_meta( $upload_image_id, '_image_custom_link', true ) : '';
          $link_new_window= get_post_meta( $upload_image_id, '_link_new_window', true ) ? get_post_meta( $upload_image_id, '_link_new_window', true ) : '';
          $target_link = ( $link_new_window == 'on' ) ? '_blank' : '_self';
          $customlink = $image_custom_link ? $image_custom_link : $src;
          $link_open = $image_custom_link ? 'target="'.$link_new_window.'"' : 'data-gal=prettyPhoto[image_gallery]';
          $image_width = $instance['image_width'] ? $instance['image_width'] : $width;
          $image_height = $instance['image_height'] ? $instance['image_height'] : $height;
          $image_bg_color = $instance['image_bg_hover_color'] ? 'background-color:'.$instance['image_bg_hover_color'].';' : '';
          echo "<li class='isotope-ready' style=' border-radius:".$instance['image_radius']."px; '>";
          if($instance['gallery_type'] =='grid_gallery'){
            echo '<div class="image_hover_bg_color" style="'.$image_bg_color.'; width:'.$image_width.'px; height:'.$image_height.'px;"> </div>';

            if( $instance['disable_light_box'] != 'on' ){
              echo "<a href=\" $customlink \"  $link_open style='border-radius:".$instance['image_radius']."px;'>";
            } 
            echo "<img style='border-radius:".$instance['image_radius']."px; ".$gallery_image_shadow."' src='".aq_resize( $src, $image_width, $image_height , 't' )."' alt='".esc_html($values['title'])."'>";
            if( $instance['disable_light_box'] != 'on' ){
              echo "</a>";
            } 
          }
          if( $instance['enable_image_title'] == 'custom_text' ){
              if( $values['description'] ):  echo '<div class="custom_text">';   echo $values['description'];   echo '</div>';
            endif; 
          }
         elseif( $instance['enable_image_title'] == 'custom_text_bottom' ){
              if( $values['description'] ):  echo '<div class="custon_text_bottom">';   echo $values['description'];   echo '</div>';
            endif; 
           }
          elseif( $instance['enable_image_title'] !='none' ){
              echo '<span class="gallery_caption '.$instance['enable_image_title'].'" style="background-color:'.$instance['image_title_bg_color'].'; color:'.$instance['image_title_color'].'; '.$slider_radius.'"><strong style="color:'.$instance['image_title_color'].';">'.$values['title'].'</strong>';
              echo '<p>'.$values['description'].'</p></span>'; 
          }else{ }
          echo "</li>";
         }
        echo '</ul>';
      } 
      echo '</div>';
    }
        echo $args['after_widget'];
    }

    function form( $instance ){
      $instance = wp_parse_args($instance, array(
       
        'upload_images_ids' => '',
        'gallery_columns' => '4',
        'gallery_type' =>'',
        'enable_image_title' => '',
        'enable_grayscale_images' => '',
        'image_title_bg_color' => '#333333',
        'image_title_color' => '#ffffff',
        'image_bg_hover_color' => '',
        'gallery_images_space' => '',
        'image_radius' => '0',
        'gallery_image_shadow' => '',
        'animation_names' => '',
        'slider_auto_play' => __('true',haircare_widgets),
        'enable_image_zoom_hover' => '',
        'image_height' => '',
        'image_width' => '',
        'disable_light_box' => '',
        'slider_arrows_bg_color' => '',
        'slider_arrows_color' => '',
        'slider_arrows_bg_color' => '#333333',
        'slider_arrows_color' => '#ffffff',
        'enable_slider_dots_buttons' => '',
        'disable_slider_arrow_buttons' => '',
        'slide_animation_in' => '',
        'slide_animation_out' => '',
        ));

        ?>
  <script type='text/javascript'>
    (function($) {
      "use strict";
      $(function() {
      $('.image_gallery_color_pickr').each(function(){
        $(this).wpColorPicker();
      });
      $("#<?php echo $this->get_field_id('gallery_type') ?>").change(function () {
        $("#<?php echo $this->get_field_id('gallery_columns') ?>").parent().show();
        $("#<?php echo $this->get_field_id('slider_auto_play') ?>").parent().hide();
        $(".gallery_slider_settings").hide();
        var select_gallery_type = $("#<?php echo $this->get_field_id('gallery_type') ?> option:selected").val(); 
        switch(select_gallery_type){
          case 'gallery_slider':
            $("#<?php echo $this->get_field_id('slider_auto_play') ?>").parent().show();
             $(".gallery_slider_settings").show();
            break;
          case 'list_gallery_images':
            $("#<?php echo $this->get_field_id('gallery_columns') ?>").parent().hide();
            break;    
        }
      }).change();
      $("#<?php echo $this->get_field_id('enable_image_title') ?>").change(function () {
          $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().show();
          $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().show();
          $(".custom_text_desciption").hide();
          $(".custom_text_desciption_bottom").hide();
          var enable_image_title = $("#<?php echo $this->get_field_id('enable_image_title') ?> option:selected").val(); 
          switch(enable_image_title){
          case 'none':
            $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().hide();
            $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().hide();   
            break;
          case 'custom_text':
            $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().hide();
            $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().hide();
            $(".custom_text_desciption").show();
            break;            
        case 'custom_text_bottom':
            $("#<?php echo $this->get_field_id('image_title_bg_color') ?>").parent().parent().parent().hide();
            $("#<?php echo $this->get_field_id('image_title_color') ?>").parent().parent().parent().hide();
            $(".custom_text_desciption_bottom").show();
            break;            
        }
      }).change();


    $("#<?php echo $this->get_field_id('gallery_columns') ?>").change(function () {
        $("#<?php echo $this->get_field_id('slide_animation_in') ?>").parent().hide();
        $("#<?php echo $this->get_field_id('slide_animation_out') ?>").parent().hide();
        var select_gallery_type = $("#<?php echo $this->get_field_id('gallery_columns') ?> option:selected").val(); 
        switch(select_gallery_type){
          case '1':
            $("#<?php echo $this->get_field_id('slide_animation_in') ?>").parent().show();
            $("#<?php echo $this->get_field_id('slide_animation_out') ?>").parent().show();
            break;
              
        }
      }).change();
   });
  })(jQuery);
  </script>
<?php $animationins = array( 'bounceIn'=> 'BounceIn','bounceInLeft' => 'BounceInLeft', 'bounceInUp' => 'BounceInUp','bounceInDown' => 'BounceInDown', 'bounceInRight' => 'BounceInRight', 'fadeIn'=> 'fadeIn', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUpBig' => 'fadeInUpBig','fadeInDown'=> 'fadeInDown', 'fadeInLeft' => 'fadeInLeft','fadeInRight' => 'fadeInRight','fadeInUp' => 'fadeInUp', 'rotateIn'=> 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight','rotateInUpLeft' => 'rotateInUpLeft');

$animationouts = array( 'bounceOut'=> 'BounceOut', 'bounceOutLeft' => 'BounceOutLeft', 'bounceOutUp' => 'BounceOutUp', 'bounceOutDown' => 'BounceOutDown', 'bounceOutRight' => 'BounceOutRight', 'fadeOut'=> 'fadeOut','fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeftBig' => 'fadeOutLeftBig','fadeOutRightBig' => 'faceOutRightBig','fadeOutUpBig' => 'fadeOutUpBig', 'fadeOutDown'=> 'fadeOutDown','fadeOutLeft' => 'fadeOutLeft', 'fadeOutRight' => 'fadeOutRight', 'fadeOutUp' => 'fadeOutUp', 'rotateOut'=> 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft','rotateOutDownRight' => 'rotateOutDownRight','rotateOutUpLeft' => 'rotateOutUpLeft','rotateOutUpRight' => 'rotateOutUpRight');
?>
<div class="input-elements-wrapper">    
  <p><?php $i = rand(1,100); ?>
        <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('upload_images_ids'); ?>" id="<?php echo $this->get_field_id('upload_images_ids'); ?>" value="<?php echo $instance['upload_images_ids']; ?>">
        <input type="button" value="<?php _e( 'Upload Gallery Images', haircare_widgets ); ?>" class="button button-primary  custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
        <script type="text/javascript">
          jQuery(document).ready( function(){
            var file_frame;
            jQuery('.custom_media_upload_<?php echo $i; ?>').live('click', function( event ){
             event.preventDefault();
            if ( file_frame ) {
            file_frame.open();
            return;
            }
             // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Upload Gallery Images',
            button: {
            text: 'Upload Gallery Images',
            },
            multiple: true // Set to true to allow multiple files to be selected
            });

          file_frame.on( 'select', function() {
          var selection = file_frame.state().get('selection');
          var attachment_ids = selection.map( function( attachment ) {
              attachment = attachment.toJSON();
              return attachment.id;
            }).join();
              if( attachment_ids.charAt(0) === ',' ) { attachment_ids = attachment_ids.substring(1); }
              jQuery('.custom_media_url_<?php echo $i; ?>').val( attachment_ids );
          });
            // Finally, open the modal
            file_frame.open();
            });
            });

        </script><br />
        <small><?php _e('Note:Comma separated attachment IDs',haircare_widgets) ?></small>
  </p>
   <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_type') ?>">  <?php _e('Select Gallery Type',haircare_widgets)?>  </label>
    <select id="<?php echo $this->get_field_id('gallery_type') ?>" name="<?php echo $this->get_field_name('gallery_type') ?>">
      <option value="grid_gallery" <?php selected('grid_gallery', $instance['gallery_type']) ?>>  <?php esc_html_e('Grid Gallery', haircare_widgets) ?> </option>
      <option value="gallery_slider" <?php selected('gallery_slider', $instance['gallery_type']) ?>>  <?php esc_html_e('Slider', haircare_widgets) ?>    </option>
      
    </select>
  </p>
    <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_columns') ?>">  <?php _e('Select Columns',haircare_widgets)?>  </label>
    <select id="<?php echo $this->get_field_id('gallery_columns') ?>" name="<?php echo $this->get_field_name('gallery_columns') ?>">
      <option value="4" <?php selected('4', $instance['gallery_columns']) ?>> 
       <?php esc_html_e('Column 4', haircare_widgets) ?>    </option>
      <option value="3" <?php selected('3', $instance['gallery_columns']) ?>> 
       <?php esc_html_e('Column 3', haircare_widgets) ?>    </option>
      <option value="2" <?php selected('2', $instance['gallery_columns']) ?>>  
        <?php esc_html_e('Column 2', haircare_widgets) ?>    </option>
      <option value="1" <?php selected('1', $instance['gallery_columns']) ?>>  
        <?php esc_html_e('Column 1', haircare_widgets) ?>    </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_width'); ?>"> <?php _e('Image Width & Height',haircare_widgets) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_width') ?>" id="<?php echo $this->get_field_id('image_width') ?>" class="small-text" value="<?php echo $instance['image_width'] ?>" /> X
    <input type="text" name="<?php echo $this->get_field_name('image_height') ?>" id="<?php echo $this->get_field_id('image_height') ?>" class="small-text" value="<?php echo $instance['image_height'] ?>" />
    <small><?php _e('PX',haircare_widgets); ?></small>
  </p>

<p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('slider_auto_play') ?>">  <?php _e('Auto Play',haircare_widgets)?>  </label>
    <select id="<?php echo $this->get_field_id('slider_auto_play') ?>" name="<?php echo $this->get_field_name('slider_auto_play') ?>">
      <option value="true" <?php selected('True', $instance['slider_auto_play']) ?>>  <?php esc_html_e('True', haircare_widgets) ?>    </option>
      <option value="false" <?php selected('false', $instance['slider_auto_play']) ?>>  <?php esc_html_e('False', haircare_widgets) ?>    </option>
    </select>
  </p> 
 
</div>
<div class="input-elements-wrapper gallery_slider_settings">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slide_animation_in') ?>">  <?php _e('Slide AnimateIn',haircare_widgets)?>  </label>
    <select id="<?php echo $this->get_field_id('slide_animation_in') ?>" name="<?php echo $this->get_field_name('slide_animation_in') ?>">
      <?php  echo '<option value="fadeIn">Choose Animation</option>';
      foreach ($animationins as $k => $animationin) {
        echo  '<option value='.$k.'  '.selected($k, $instance['slide_animation_in']).' >'.$animationin.'</option>';
      } ?>
     
    </select>
  </p>
  <p class="three_fourth_last">
    <label for="<?php echo $this->get_field_id('slide_animation_out') ?>">  <?php _e('Slide AnimateOut',haircare_widgets)?>  </label>
    <select id="<?php echo $this->get_field_id('slide_animation_out') ?>" name="<?php echo $this->get_field_name('slide_animation_out') ?>">
      <?php echo '<option value="fadeOut">Choose Animation</option>'; 
      foreach ($animationouts as $k => $animationout) {
      echo  '<option value="'.$k.'"  '.selected($k, $instance['slide_animation_out']).' >'.$animationout.'</option>';
      } ?>     
    </select>
  </p>
   <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('disable_slider_arrow_buttons') ?>">  <?php _e('Disable Slider Arrow Buttons',haircare_widgets) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_slider_arrow_buttons"); ?>" name="<?php echo $this->get_field_name("disable_slider_arrow_buttons"); ?>"<?php checked( (bool) $instance["disable_slider_arrow_buttons"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_slider_dots_buttons') ?>">  <?php _e('Slider Dots Buttons',haircare_widgets) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_slider_dots_buttons"); ?>" name="<?php echo $this->get_field_name("enable_slider_dots_buttons"); ?>"<?php checked( (bool) $instance["enable_slider_dots_buttons"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_arrows_bg_color') ?>">  <?php _e('Slider Navigation Background Color',haircare_widgets)?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_arrows_bg_color') ?>" id="<?php echo $this->get_field_id('slider_arrows_bg_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['slider_arrows_bg_color'] ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('slider_arrows_color') ?>">  <?php _e('Slider Navigation Color',haircare_widgets)?>  </label>
   <input type="text" name="<?php echo $this->get_field_name('slider_arrows_color') ?>" id="<?php echo $this->get_field_id('slider_arrows_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['slider_arrows_color'] ?>" />
  </p>
</div> 
<div class="input-elements-wrapper"> 
    <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_bg_hover_color'); ?>"> <?php _e('Image Hover BG Opacity Color',haircare_widgets) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_bg_hover_color') ?>" id="<?php echo $this->get_field_id('image_bg_hover_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['image_bg_hover_color'] ?>" />
  </p> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_image_zoom_hover') ?>">  <?php _e('Image Zoom On Hover ',haircare_widgets)?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_image_zoom_hover"); ?>" name="<?php echo $this->get_field_name("enable_image_zoom_hover"); ?>"<?php checked( (bool) $instance["enable_image_zoom_hover"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_radius'); ?>"> <?php _e('Image Radius',haircare_widgets) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_radius') ?>" id="<?php echo $this->get_field_id('image_radius') ?>" class="small-text" value="<?php echo $instance['image_radius'] ?>" />
    <small><?php _e('px',haircare_widgets); ?></small>
  </p>  
</div> 
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_image_title') ?>">  <?php _e('Attachment Image',haircare_widgets)?>  </label>
    <select id="<?php echo $this->get_field_id('enable_image_title') ?>" name="<?php echo $this->get_field_name('enable_image_title') ?>">
      <option value="none" <?php selected('none', $instance['enable_image_title']) ?>>  <?php esc_html_e('Title & Description None', haircare_widgets) ?>    </option>
      <option value="mouse_over_on_image" <?php selected('mouse_over_on_image', $instance['enable_image_title']) ?>>  <?php esc_html_e('Title & Description On Mouseover', haircare_widgets) ?>    </option>
      <option value="fixed_on_image" <?php selected('fixed_on_image', $instance['enable_image_title']) ?>>  <?php esc_html_e('Title & Description Fixed', haircare_widgets) ?> </option>
      <option value="image_bottom" <?php selected('image_bottom', $instance['enable_image_title']) ?>>  <?php esc_html_e('Title & Description Under Image', haircare_widgets) ?> </option>
       <option value="custom_text" <?php selected('custom_text', $instance['enable_image_title']) ?>>  <?php esc_html_e('Description Over Image', haircare_widgets) ?> </option>
       <option value="custom_text_bottom" <?php selected('custom_text_bottom', $instance['enable_image_title']) ?>>  <?php esc_html_e('Descriptoon Under Image', haircare_widgets) ?> </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_title_bg_color'); ?>"> <?php _e('Image Title Background Color',haircare_widgets) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_title_bg_color') ?>" id="<?php echo $this->get_field_id('image_title_bg_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['image_title_bg_color'] ?>" />
  </p>


  <p class="three_fourth_last custom_text_desciption">
    <strong>Add content in <em>"Attachment Details > description"</em> area like below format:</strong><br />
    &lt;div style="background:#333333; padding:25px; position:absolute; bottom:0; right:0; width:40%;"&gt;
    &lt;h3 style="color:#ffffff;"&gt;This is Title&lt;/h3&gt;
    &lt;p style="color:#666666;"&gt;Image attachment details description&lt;/p&gt;
    &lt;/div&gt;
    <br />
    <strong>For more details</strong> <a href="<?php echo plugin_dir_url( __FILE__ ).'images/attachment-details-description.jpg' ?>" target="_blank">click here</a>
  </p>
  <p class="three_fourth_last custom_text_desciption_bottom">
    <strong>Add content in <em>"Attachment Details > description"</em> area like below format:</strong><br />
      &lt;h3 style="color:#333333;"&gt;This is Title&lt;/h3&gt;
    &lt;p style="color:#666666;"&gt;Image attachment details description&lt;/p&gt;
    <br />
    for more details <a href="<?php echo plugin_dir_url( __FILE__ ).'images/attachment-details-description.jpg' ?>" target="_blank">click here</a>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_title_color'); ?>"> <?php _e('Image Title Color',haircare_widgets) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_title_color') ?>" id="<?php echo $this->get_field_id('image_title_color') ?>" class="image_gallery_color_pickr" value="<?php echo $instance['image_title_color'] ?>" />
  </p>

</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_grayscale_images') ?>">  <?php _e('Gray Scale Images',haircare_widgets)?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_grayscale_images"); ?>" name="<?php echo $this->get_field_name("enable_grayscale_images"); ?>"<?php checked( (bool) $instance["enable_grayscale_images"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_images_space') ?>">  <?php _e('Gutter',haircare_widgets)?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("gallery_images_space"); ?>" name="<?php echo $this->get_field_name("gallery_images_space"); ?>"<?php checked( (bool) $instance["gallery_images_space"], true ); ?> />
  </p>

  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('gallery_image_shadow') ?>">  <?php _e('Image Shadow',haircare_widgets) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("gallery_image_shadow"); ?>" name="<?php echo $this->get_field_name("gallery_image_shadow"); ?>"<?php checked( (bool) $instance["gallery_image_shadow"], true ); ?> />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('disable_light_box') ?>">  <?php _e('Disable Lightbox',haircare_widgets) ?>  </label>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_light_box"); ?>" name="<?php echo $this->get_field_name("disable_light_box"); ?>"<?php checked( (bool) $instance["disable_light_box"], true ); ?> />
  </p>
</div> 
 

<?php }
 }
// Limit Content
function haircare_content($limit) {
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

// Widget Registration

function kaya_haircare_widgets(){

    register_widget('Haircare_Title_Widget');
    register_widget('Haircare_Vspace_Widget');
    register_widget('Haircare_Slider_Widget');
    register_widget('Haircare_Team_Widget');
    register_widget('Haircare_Dropcap_Widget');
    register_widget('Haircare_Draggable_slider_Widget');
    register_widget('Haircare_Imageboxes_Widget');
    register_widget('Haircare_circular_skill_Widget');
    register_widget('Haircare_Info_Boxes');
    register_widget('Haircare_Custom_List_Box_Widget');
    register_widget('Haircare_Flickr_Widget');
    register_widget('Haircare_Recent_Blog_Widget');
    register_widget('Haircare_Readmore_Button_Widget');
    register_widget('Haircare_Portfolio');
    register_widget('Haircare_Testimonial_Widget');
    register_widget('Haircare_Toggle_Tabs_Accordion');
    register_widget('Haircare_Pricing_Table');
    register_widget('Haircare_Twitter_Widget');
    register_widget('Haircare_Skillset_Widget');
    register_widget('Haircare_Contact_Form');
    register_widget('Haircare_Blog_Widget');
    register_widget('Haircare_Simple_Pricetable_Widget');
    register_widget('Haircare_Testimonial_Slider_Widget');
    register_widget('Haircare_Opening_Hours_Widget');
    register_widget('Haircare_Appointform');
    register_widget('Haircare_Gallery_Images_Widget');
}

add_action( 'widgets_init', 'kaya_haircare_widgets');



function kaya_haircare_widgets_styles()

{
    wp_enqueue_style('css_haircare_page_widgets', plugins_url('css/page_widgets.css', __FILE__));
    wp_enqueue_style('css_widget_bxslider', plugins_url('css/widget_bxslider.css', __FILE__));
    wp_enqueue_style('css_owl.carousel', plugins_url('css/owl.carousel.css', __FILE__));
    wp_enqueue_style('css_portfolio_hover', plugins_url('css/portfolio_hover.css', __FILE__));
    wp_enqueue_style('css_widgets_animation', plugins_url('css/animate.min.css', __FILE__));
}

function kaya_haircare_widgets_scripts(){
    wp_enqueue_script('widget_jquery_bxslider', plugins_url('js/jquery.bxslider.js', __FILE__),array( 'jquery' ),'', true);
    wp_enqueue_script('js_owl.carousel', plugins_url('js/owl.carousel.js', __FILE__),array( 'jquery' ),'1.29', true);
    wp_enqueue_script('widget_contact', plugins_url('js/widget_contact.js', __FILE__),array( 'jquery' ),'', true);
    wp_enqueue_script('js_esay-pie-chart', plugins_url('js/jquery.easy-pie-chart.js', __FILE__),array( 'jquery' ),'', true);
    wp_localize_script( 'jquery', 'cpath', array('plugin_dir' => plugins_url('',__FILE__)));
    wp_enqueue_script('jquery.hoverdir', plugins_url('js/jquery.hoverdir.js', __FILE__),array( 'jquery' ),'', true);
    wp_enqueue_script('jquery-ui-accordion');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('haircare_js_scripts', plugins_url('js/scripts.js', __FILE__),array( 'jquery' ),'', true);

}
add_theme_support('post-thumbnails');
include( plugin_dir_path( __FILE__ ) . 'aq_resizer.php');
include( plugin_dir_path( __FILE__ ) . 'media_image_attachments.php');
// Admin Enqueue Script For Upload image from media library
function kaya_haircare_admin_script(){
    wp_enqueue_media();
 }
add_action('admin_enqueue_scripts', 'kaya_haircare_admin_script'); //script files
//include( plugin_dir_path( __FILE__ ) . 'fullscreen-bg-slider.php');
add_action('wp_enqueue_scripts', 'kaya_haircare_widgets_styles'); // styles files
add_action('wp_enqueue_scripts', 'kaya_haircare_widgets_scripts'); //script files
// Language 
class Haircare_Language_Translation{
  public function __construct(){
     add_action('plugins_loaded', array(&$this,'haircare_plugin_textdomain'));
  }
    public  function haircare_plugin_textdomain() {
    $domain = haircare_widgets;
      $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
      load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
      load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
        }
}
$language_file = new Haircare_Language_Translation();
?>