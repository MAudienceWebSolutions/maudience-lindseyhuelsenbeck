<?php
 $kaya_options = get_option('kayapati');
$quote = get_post_meta(get_the_ID(), 'kaya_quote', true);
$source = get_post_meta(get_the_ID(), 'kaya_quote_desc', true);
$kaya_readmore_blog=$kaya_options['kaya_readmore_blog'] ? $kaya_options['kaya_readmore_blog'] : 'View More';
?>
<?php
$icon_name='fa fa-quote-right';
echo kaya_post_content( $kaya_readmore_blog, $icon_name ); ?>
