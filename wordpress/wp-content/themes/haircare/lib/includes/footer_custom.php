<div class="clear"> </div>
<span class="footer_top"> </span>
<footer>
<div class="container">
<div class="one_fourth">
<?php 
 $kaya_options = get_option('kayapati');
$footer_column_one=$kaya_options['footer_column_one'] ? $kaya_options['footer_column_one'] : 'footer copy rights';
echo $footer_column_one;?>
  
</div>
<div class="one_fourth">
<div class="social_icons">
<?php // Socail Icons
$footer_facebook_icon=$kaya_options['footer_facebook_icon'] ? $kaya_options['footer_facebook_icon'] : '';
$footer_facebook_link=$kaya_options['footer_facebook_link'] ? $kaya_options['footer_facebook_link'] : ''; 
 $footer_twitter_icon=$kaya_options['footer_twitter_icon'] ? $kaya_options['footer_twitter_icon'] : '';
$footer_twitter_link=$kaya_options['footer_twitter_link'] ? $kaya_options['footer_twitter_link'] : ''; 
 $footer_googleplus_icon=$kaya_options['footer_googleplus_icon'] ? $kaya_options['footer_googleplus_icon'] : '';
$footer_googleplus_link=$kaya_options['footer_googleplus_link'] ? $kaya_options['footer_googleplus_link'] : ''; 
 $footer_skype_icon=$kaya_options['footer_skype_icon'] ? $kaya_options['footer_skype_icon'] : '';
$footer_skype_link=$kaya_options['footer_skype_link'] ? $kaya_options['footer_skype_link'] : ''; 

 $footer_youtube_icon=$kaya_options['footer_youtube_icon'] ? $kaya_options['footer_youtube_icon'] : '';
$footer_youtube_link=$kaya_options['footer_youtube_link'] ? $kaya_options['footer_youtube_link'] : ''; 

 $footer_dribble_icon=$kaya_options['footer_dribble_icon'] ? $kaya_options['footer_dribble_icon'] : '';
$footer_dribble_link=$kaya_options['footer_dribble_link'] ? $kaya_options['footer_dribble_link'] : ''; 

 $footer_rss_icon=$kaya_options['footer_rss_icon'] ? $kaya_options['footer_rss_icon'] : '';
$footer_rss_link=$kaya_options['footer_rss_link'] ? $kaya_options['footer_rss_link'] : ''; 
?>
<?php if($footer_facebook_icon){ ?>
	<a href="<?php echo $footer_facebook_link; ?>" class="hint--top" data-hint="Facebook"><img src="<?php echo $footer_facebook_icon; ?>" alt="facebook" /></a>
<?php } ?>
<?php if($footer_twitter_icon) {?>
	<a href="<?php echo $footer_twitter_link; ?>"class="hint--top" data-hint="Twitter"><img src="<?php echo $footer_twitter_icon; ?>" alt="twitter" /></a> 
<?php } ?>
<?php if($footer_googleplus_icon) {?>
	<a href="<?php echo $footer_googleplus_link; ?>" class="hint--top" data-hint="Google Plus"><img src="<?php echo $footer_googleplus_icon; ?>" alt="googleplus" /></a>
<?php } ?>
<?php if($footer_skype_icon) {?>
	<a href="<?php echo $footer_skype_link; ?>" class="hint--top" data-hint="Skype"><img src="<?php echo $footer_skype_icon; ?>" alt="skype" /></a> 
<?php } ?>
 <?php if($footer_youtube_icon) {?>
	<a href="<?php echo $footer_youtube_link; ?>" class="hint--top" data-hint="Youtube"><img src="<?php echo $footer_youtube_icon; ?>" alt="youtube" /></a> 
<?php } ?>
 <?php if($footer_dribble_icon) {?>
	<a href="<?php echo $footer_dribble_link; ?>" class="hint--top" data-hint="Dribble"><img src="<?php echo $footer_dribble_icon; ?>" alt="dribble" /></a> 
<?php } ?>
 <?php if($footer_rss_icon) {?>
	<a href="<?php echo $footer_rss_link; ?>" class="hint--top" data-hint="Rss"><img src="<?php echo $footer_rss_icon; ?>" alt="rss" /></a> 
<?php } ?>

</div>
	
</div>
<div class="one_fourth">
<?php 
$footer_column_three=$kaya_options['footer_column_three'];
echo $footer_column_three;?>

</div>
<div class="one_fourth_last">
<?php 
$footer_column_four=$kaya_options['footer_column_four'];
echo $footer_column_four;?>

</div>
</div>
</footer>