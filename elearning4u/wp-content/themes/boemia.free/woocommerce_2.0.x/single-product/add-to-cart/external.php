<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>

<?php //if ( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') ): ?>
	<?php do_action('woocommerce_before_add_to_cart_button'); ?>
	<div class="woocommerce-price-and-add group">
		<p class="cart"><a href="<?php echo $product_url; ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', $button_text, 'external'); ?></a></p>
	</div>
	
	<?php do_action('woocommerce_after_add_to_cart_button'); ?>
<?php //endif ?>
