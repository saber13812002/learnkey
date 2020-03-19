<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;
?>
<div class="product_meta">

    <?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku"><?php _e('SKU:', 'yit'); ?> <?php echo $product->get_sku(); ?>.</span>
	<?php endif; ?>

    <?php
    $size = count( get_the_terms( $post->ID, 'product_cat' ) );
    echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'yit' ) . ' ', '.</span>' );
    ?>

    <?php
    $size = count( get_the_terms( $post->ID, 'product_tag' ) );
    echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'yit' ) . ' ', '.</span>' );
    ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>