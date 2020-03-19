<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $product;

if ( ! $product->is_purchasable() && ! $product->is_in_stock() ) {
    // Availability
    $availability = $product->get_availability();

    echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] );

    return;
} else if( ! $product->is_purchasable() ) {
    return;
}
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <?php
        if ( $product->is_in_stock() ) :
            ?>
            <div class="simple-quantity">
                <?php
                // Availability
                $availability = $product->get_availability();

                if ($availability['availability']) :
                    echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] );
                endif;

                if ( is_shop_enabled() && !$product->is_sold_individually() ) {

                    $min_value = apply_filters( 'woocommerce_quantity_input_min', 1, $product );
                    $max_value = apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product );

                    woocommerce_quantity_input( array( 'min_value' => $min_value, 'max_value' => $max_value ) );
                }
                ?>
            </div>
        <?php
        else :
            // Availability
            $availability = $product->get_availability();

            echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] );
        endif
        ?>

        <?php if( yit_get_option('shop-detail-show-price') || (is_shop_enabled() && yit_get_option('shop-detail-add-to-cart')) ) : ?>
            <div class="woocommerce-price-and-add group">
                <?php if( yit_get_option('shop-detail-show-price') ): ?>
                    <div class="woocommerce-price"><?php woocommerce_get_template( 'single-product/price.php' ); ?></div>
                <?php endif ?>

                <?php if ( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') && $product->is_in_stock() ) : ?>
                    <div class="woocommerce-add-to-cart"><button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'yit'), $product->product_type); ?></button></div>
                <?php endif; ?>
            </div>
        <?php endif ?>
        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>