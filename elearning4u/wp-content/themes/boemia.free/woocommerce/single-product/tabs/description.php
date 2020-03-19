<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

if ( $post->post_content ) : ?>

	<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'yit')); ?>

	<h2><?php echo $heading; ?></h2>

	<?php the_content(); ?>

<?php endif; ?>