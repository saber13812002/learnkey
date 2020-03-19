<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = WC()->shipping->load_shipping_methods();
?>
<div class="span6 cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

    <?php do_action('woocommerce_before_cart_totals'); ?>

    <?php if ( ! WC()->shipping->enabled || $available_methods || ! WC()->customer->get_shipping_country() || ! WC()->customer->has_calculated_shipping() ) : ?>

        <h2><?php _e('Cart Totals', 'yit'); ?></h2>
        <table align="right" cellspacing="0" cellpadding="0">
            <tbody>

            <tr class="cart-subtotal">
                <th><strong><?php _e('Cart Subtotal', 'yit'); ?></strong></th>
                <td><strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong></td>
            </tr>

            <?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
                <tr class="discount cart-discount coupon-<?php echo esc_attr( $code ); ?>">
                    <th><?php _e( 'Coupon:', 'yit' ); ?> <?php echo esc_html( $code ); ?></th>
                    <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

                <?php wc_cart_totals_shipping_html(); ?>

                <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

            <?php endif ?>

            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>

                <tr class="fee fee-<?php echo $fee->id ?>">
                    <th><?php echo $fee->name ?></th>
                    <td><?php
                        if ( $woocommerce->cart->tax_display_cart == 'excl' )
                            echo wc_price( $fee->amount );
                        else
                            echo wc_price( $fee->amount + $fee->tax );
                        ?></td>
                </tr>

            <?php endforeach; ?>

            <?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
                <?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                        <tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                            <th><?php echo esc_html( $tax->label ); ?></th>
                            <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="tax-total">
                        <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                        <td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
                <tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
                    <th><?php _e( 'Coupon:', 'yit' ); ?> <?php echo esc_html( $code ); ?></th>
                    <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

            <tr class="total">
                <th><strong><?php _e( 'Order Total', 'yit' ); ?></strong></th>
                <td><?php wc_cart_totals_order_total_html(); ?></td>
            </tr>

            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

            </tbody>
        </table>

        <?php if ( WC()->cart->get_cart_tax() ) : ?>

            <p><small><?php

                    $estimated_text = ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) ? sprintf( ' ' . __('(taxes estimated for %s)', 'yit'), WC()->countries->estimated_for_prefix() . __(WC()->countries->countries[ WC()->countries->get_base_country() ], 'yit') ) : '';

                    printf(__('Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'yit'), $estimated_text );

                    ?></small></p>
        <?php endif; ?>

    <?php elseif( WC()->cart->needs_shipping() ) : ?>

        <?php if ( ! WC()->customer->get_shipping_state() || ! WC()->customer->get_shipping_postcode() ) : ?>

            <div class="woocommerce-info woocommerce_info">

                <p><?php _e( 'No shipping methods were found; please recalculate your shipping and enter your state/county and zip/postcode to ensure there are no other available methods for your location.', 'yit' ); ?></p>

            </div>

        <?php else : ?>

            <div class="woocommerce-error woocommerce_error">

                <p><?php printf(__('Sorry, it seems that there are no available shipping methods for your location (%s).', 'yit'), WC()->countries->countries[ WC()->customer->get_shipping_country() ]); ?></p>

                <p><?php _e('If you require assistance or wish to make alternate arrangements please contact us.', 'yit'); ?></p>

            </div>

        <?php endif; ?>

    <?php endif; ?>

    <?php do_action('woocommerce_after_cart_totals'); ?>

</div>