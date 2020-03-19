<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $post;

if ( $post->post_content ) : ?>

	<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'yit')); ?>

	<h2><?php echo $heading; ?></h2>

	<?php the_content(); ?>

<?php endif; ?>