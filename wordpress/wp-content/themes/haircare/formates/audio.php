<?php
$kaya_options = get_option('kayapati');
$audio = get_post_meta( get_the_ID(), 'kaya_audio', true );
$kaya_readmore_blog=$kaya_options['kaya_readmore_blog'] ? $kaya_options['kaya_readmore_blog'] : 'View More';
if($audio!=''){
    echo do_shortcode( $audio );
}
else{ ?>
    <?php echo "<h3> Sorry, No Audio File Found...</h3>";
} ?>
<?php
$icon_name='fa fa-forward';
echo kaya_post_content( $kaya_readmore_blog, $icon_name ); ?>
