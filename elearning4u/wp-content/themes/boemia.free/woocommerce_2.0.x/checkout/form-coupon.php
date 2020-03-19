<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( !$woocommerce->cart->coupons_enabled() ) return;

$info_message = apply_filters('woocommerce_checkout_coupon_message', __('Have a coupon?', 'yit'));
?>

<div class="coupon_form">
    <p class="woocommerce_info"><?php echo $info_message; ?> <a href="#" class="showcoupon"><?php _e('Click here to enter your code', 'yit'); ?></a></p>

    <form class="checkout_coupon" method="post">

        <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php _e('Coupon code', 'yit'); ?>" id="coupon_code" value="" />
        </p>

        <p class="form-row form-row-last">
            <input type="submit" class="button" name="apply_coupon" value="<?php _e('Apply Coupon', 'yit'); ?>" />
        </p>

        <div class="clear"></div>
    </form>
</div>