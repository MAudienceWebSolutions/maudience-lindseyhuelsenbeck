<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>
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
</li>