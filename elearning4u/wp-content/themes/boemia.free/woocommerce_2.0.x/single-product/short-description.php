<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post;

if ( ! $post->post_excerpt ) return;
?>
<div itemprop="description" class="product-description group">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>