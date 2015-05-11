<?php
 $kaya_options = get_option('kayapati');
$kaya_readmore_blog=$kaya_options['kaya_readmore_blog'] ? $kaya_options['kaya_readmore_blog'] : 'View More';
 $video = get_post_meta( get_the_ID(), 'post_video', true );
if($video!=''){ ?>
	<?php echo $video;
}
else{ ?>
	<?php  echo '<h3>Sorry, No Video Files Found... </h3>';
} ?>
<?php
$icon_name='fa fa-video-camera ';
echo kaya_post_content( $kaya_readmore_blog, $icon_name ); ?>
