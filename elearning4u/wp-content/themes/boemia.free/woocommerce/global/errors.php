<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if ( ! $errors ) return;

?>
<ul class="woocommerce-error">
	<?php foreach ( $errors as $error ) : ?>
		<li><?php echo $error; ?></li>
	<?php endforeach; ?>
</ul>