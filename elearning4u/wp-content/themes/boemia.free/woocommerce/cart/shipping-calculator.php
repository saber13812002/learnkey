<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $woocommerce;

if ( get_option('woocommerce_enable_shipping_calc')=='no' || ! WC()->cart->needs_shipping() ) return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="span6 shipping_calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
	<h2><a href="#" class="shipping-calculator-button"><?php _e('Calculate Shipping', 'yit'); ?> <span>&darr;</span></a></h2>
	<section class="shipping-calculator-form">
		<p class="form-row form-row-first">
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
				<option value=""><?php _e('Select a country&hellip;', 'yit'); ?></option>
				<?php
					foreach( WC()->countries->get_shipping_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ). '</option>';
				?>
			</select>
		</p>
		<p class="form-row form-row-last">
			<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r = WC()->customer->get_shipping_state();

				$states = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {

					// Hidden
					?>
					<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'yit' ); ?>" />
					<?php

				} elseif ( is_array( $states ) ) {

					// Dropdown
					?>
					<span>
						<select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'yit' ); ?>">
                            <option value=""><?php _e('Select a state&hellip;', 'yit'); ?></option>
                            <?php
							foreach ( $states as $ckey => $cvalue )
								echo '<option value="' . $ckey . '" '.selected( $current_r, $ckey, false ) .'>' . __( $cvalue, 'yit' ) .'</option>';
						?>
                        </select>
					</span>
					<?php

				} else {

					// Input
					?>
					<input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e('State', 'yit'); ?>" name="calc_shipping_state" id="calc_shipping_state" />
					<?php

				}
			?>
		</p>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
			<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e('Postcode/Zip', 'yit'); ?>" title="<?php _e('Postcode', 'yit'); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
		</p>
		<div class="clear"></div>
		<p><button type="submit" name="calc_shipping" value="1" class="button"><?php _e('Update Totals', 'yit'); ?></button></p>
		<?php wp_nonce_field('woocommerce-cart') ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
