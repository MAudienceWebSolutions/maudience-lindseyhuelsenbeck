<?php
 $kaya_options = get_option('kayapati');
 $pf_link = get_post_meta(get_the_ID(), 'kaya_link', true);
$kaya_readmore_blog=$kaya_options['kaya_readmore_blog'] ? $kaya_options['kaya_readmore_blog'] : 'View More';	?>
<?php
$icon_name='fa fa-link';
echo kaya_post_content( $kaya_readmore_blog, $icon_name ); ?>
