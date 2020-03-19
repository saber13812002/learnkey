<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $yit_topbar;
?>

<?php if($yit_topbar): ?>
<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart_control">Cart</a>
<div class="cart_wrapper">
<?php endif ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

		<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product = $cart_item['data'];

			// Only display if allowed
			if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
				continue;

			// Get price
			$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

			$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
			?>

			<li>
				<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

					<?php echo $_product->get_image(); ?>					

				</a>
				
				<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

					<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>

				</a>
				
				<?php
					echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove_item" title="%s">%s</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'yit'), __( '&times; remove', 'yit' ) ), $cart_item_key );
				?>

				<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>

				<span class="quantity"><?php printf( '%s &times; %s', $cart_item['quantity'], $product_price ); ?></span>
				
			</li>

		<?php endforeach; ?>

	<?php else : ?>

		<li class="empty"><?php _e('No products in the cart.', 'yit'); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

	<p class="total"><strong><?php _e('Subtotal', 'yit'); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button"><?php _e('View Cart', 'yit'); ?></a>
		<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="button checkout"><?php _e('Checkout', 'yit'); ?></a>
	</p>

<?php endif; ?>


<?php if($yit_topbar): ?>
</div>



<script type="text/javascript">
jQuery(document).ready(function($){
	$('.cart_control').live('click', function(e){
		//e.preventDefault();
	});
	
	$('.cart_control').live('hover', function(){
		$(this).next('.cart_wrapper').slideDown();
	}).live('mouseleave', function(){
		$(this).next('.cart_wrapper').delay(500).slideUp();
	});
	
	
    $('.cart_wrapper')
        .live('mouseenter', function(){ $(this).stop(true,true).show() })
        .live('mouseleave', function(){ $(this).delay(500).slideUp() });
});
</script>
<?php endif ?>