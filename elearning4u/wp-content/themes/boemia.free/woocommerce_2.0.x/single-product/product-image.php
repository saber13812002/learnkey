<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $woocommerce;

?>
<div class="images">

	<?php if ( has_post_thumbnail() ) : ?>

		<?php if( get_option( 'woocommerce_enable_lightbox' ) == 'yes' ) : ?>
		<a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="zoom" rel="prettyPhoto[product-gallery]" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>">
        <?php endif ?>
            <?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'class' => 'shop_single' ) ) ?>
        <?php if( get_option( 'woocommerce_enable_lightbox' ) == 'yes' ) : ?>
        </a>
        <?php endif ?>

	<?php else : ?>

		<img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />

	<?php endif; ?>

	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>