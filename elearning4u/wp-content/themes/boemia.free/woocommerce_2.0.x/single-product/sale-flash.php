<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;

$regular_price = get_post_meta( $product->id, '_regular_price', true );
$regular_price_var = get_post_meta( $product->id, '_min_variation_price', true );

if ( $product->is_on_sale() && ( !empty( $regular_price ) || !empty( $regular_price_var ) ) ) : ?>
    <div class="on_sale_wrap">
        <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">' . yit_get_option('shop-sale-label') . '</span>', $post, $product); ?>
    </div>
<?php endif; ?>