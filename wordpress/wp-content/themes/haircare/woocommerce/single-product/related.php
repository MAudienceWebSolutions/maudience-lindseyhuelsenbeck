<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => -1,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>
<script type="text/javascript">
(function($) {
  "use strict";
  $(function() {
	$(".related-product-slider").owlCarousel({
                navigation : false,
                autoPlay : true,
                stopOnHover : true,
                pagination  : false,
                items :4,
              });
	});
})(jQuery);
</script>
	<div class="related products">
		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
		<div class="related-product-slider">
				<?php //woocommerce_product_loop_start(); ?>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			<?php global $product, $woocommerce_loop; ?>
			<div class="shop-products">
		<div class="shop-produt-image">
			<a href="<?php the_permalink(); ?>">
				<?php //display product thumbnail
					if (has_post_thumbnail()) { 
						$params = array('width' => '500', 'height' => '500', 'crop' => false);
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'kaya-gallery' ); 
						echo "<img src='".bfi_thumb( "{$image_src[0]}", $params )."'  alt='".get_the_title()."' />";
					}
					else {
						echo '<img src="/images/defaul_image.jpg"  alt="" />';
					} 
				?>
			</a>
			<div class="product-cart-button">
				<?php
					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( $product->id ),
					esc_attr( $product->get_sku() ),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					esc_attr( $product->product_type ),
					esc_html( $product->add_to_cart_text() )
					),
					$product ); 
				?>
			</div>
		</div>
		<div class="shop-product-details">
			<h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<span class="price"><?php echo $product->get_price_html(); ?></span>	
			<?php endif;  ?>
		</div>
	</div>
			<?php endwhile; // end of the loop. ?>
			<?php // woocommerce_product_loop_end(); ?>
		</div>
	</div>
<?php endif;
wp_reset_postdata(); ?>
