<?php
/**
 * Single product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>

<?php if( !is_shop_enabled() ) return ?>
<span class="qnt_label"><?php _e('Quantity','yit')?></span>
<div class="quantity group">
	<input type="number" name="<?php echo $input_name; ?>" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ) ?>" max="<?php echo esc_attr( $max_value ) ?>" value="<?php echo esc_attr( $input_value ) ?>" size="4" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'yit' ) ?>" class="input-text qty text" maxlength="12" />
</div>