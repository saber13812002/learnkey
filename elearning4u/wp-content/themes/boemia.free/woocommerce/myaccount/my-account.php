<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $woocommerce;
?>

<?php wc_print_notices(); ?>

<p class="myaccount_user"><?php printf( __('Hello, <strong>%s</strong>. From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">change your password</a>.', 'yit'), $current_user->display_name, wc_customer_edit_account_url() ); ?></p>

<?php do_action('woocommerce_before_my_account'); ?>

<?php if ($downloads = WC()->customer->get_downloadable_products()) : ?>
<h2><?php _e('Available downloads', 'yit'); ?></h2>
<ul class="digital-downloads">
	<?php foreach ($downloads as $download) : ?>
		<li><?php if (is_numeric($download['downloads_remaining'])) : ?><span class="count"><?php echo $download['downloads_remaining'] . _n('&nbsp;download remaining', '&nbsp;downloads remaining', $download['downloads_remaining'], 'yit'); ?></span><?php endif; ?> <a href="<?php echo esc_url( $download['download_url'] ); ?>"><?php echo $download['download_name']; ?></a></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

<h2><?php _e('Recent Orders', 'yit'); ?></h2>
<?php wc_get_template('myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<h2><?php _e('My Address', 'yit'); ?></h2>
<p class="myaccount_address"><?php _e('The following addresses will be used on the checkout page by default.', 'yit'); ?></p>
<?php wc_get_template('myaccount/my-address.php'); ?>

<?php
do_action('woocommerce_after_my_account');