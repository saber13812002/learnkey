<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product, $price;

if ( ! isset( $price ) ) $price = $product->get_price_html();

if ( empty( $price ) ) return;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><span class="price-label"><?php _e('Price', 'yit') ?>:</span><span itemprop="price"><?php echo $price; ?></span></p>
                                                    
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>