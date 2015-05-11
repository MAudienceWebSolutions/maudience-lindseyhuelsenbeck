	<?php
	$footer_disable=get_theme_mod('main_footer_disable') ? get_theme_mod('main_footer_disable') : '0'; 
	if($footer_disable=="0") { ?>
    <div class="overlay_container"> 
    <div class="overlay_container_widgets container">
			<?php  get_template_part('lib/includes/bottom_footer_section'); ?>
        </div>
  </div>
	<?php } ?>
  </div>
	<div class="clear"></div>
		<!-- Start Footer bottom section -->
      <?php $disable_footer_section=get_theme_mod('disable_footer_section') ? get_theme_mod('disable_footer_section') : '0'; 
  if($disable_footer_section == "0"){ ?> 
		<div class="bottom_section">
      <div class="container">
		<div class="copyrights one_half"> 
            <?php echo get_theme_mod('footer_copyrights') ? do_shortcode( get_theme_mod('footer_copyrights') ) :'Copyright &copy; Kayapati. All rights reserved.';
                           ?>
		</div>
	 <?php echo '<div class="social_icons one_half_last">';
 	 $n=1;
    if( get_theme_mod('right_social_icon_'.$n) ){
    for ($n=1; $n <= 10; $n++) {
      ${"image_url". $n} = get_theme_mod('right_social_icon_'.$n);
      if( ${"image_url". $n} && get_theme_mod('icon_image_link_disable'.$n) != 'on'){
        ${"image_url_link". $n} = get_theme_mod('right_social_icon_link_'.$n);
        $result = '<a href="'. ${"image_url_link". $n}.'"><img src="'.${"image_url". $n}.'" alt="Social Media Icons"></a>';
        echo $result;
      }
    }
  }else{
    if( get_theme_mod('icon_image_link_disable1') != 'on' ){ echo '<a href="#"><img src="http://kayapati.com/demos/azura/wp-content/uploads/sites/14/2014/03/facebbook.png"></a>'; }
    if( get_theme_mod('icon_image_link_disable2') != 'on' ){ echo '<a href="#"><img src="http://kayapati.com/demos/azura/wp-content/uploads/sites/14/2014/03/google+.png"></a>'; }
     if( get_theme_mod('icon_image_link_disable3') != 'on' ){echo '<a href="#"><img src="http://kayapati.com/demos/azura/wp-content/uploads/sites/14/2014/03/pintrest.png"></a>'; }
     if( get_theme_mod('icon_image_link_disable4') != 'on' ){echo '<a href="#"><img src="http://kayapati.com/demos/azura/wp-content/uploads/sites/14/2014/03/skype.png"></a>';}
  }
  echo '</div>';  ?>
</div>
</div>
<?php } ?>

