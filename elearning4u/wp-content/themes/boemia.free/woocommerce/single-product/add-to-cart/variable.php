<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;

foreach( $available_variations as $key => $val ) :
    if ( empty( $val['price_html'] ) ) {
        $same_price = true;
    } else {
        $available_variations[$key]["price_html"] = '<span class="price-label">'.__('Price', 'yit').': </span>'.$val["price_html"];
    }
endforeach;

do_action('woocommerce_before_add_to_cart_form');

if( apply_filters( 'show_variable_price', isset( $same_price ) && $same_price ) ) wc_get_template( 'single-product/price.php' );
?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<div class="variations group">
			<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				<label for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label($name); ?></label>
					<select id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
						<option value=""><?php echo __('Choose an option', 'yit') ?>&hellip;</option>
                        <?php
							if ( is_array( $options ) ) {

								if ( empty( $_POST ) )
									$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
								else
									$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( $name ) ) {

									$orderby = wc_attribute_orderby( $name );

									switch ( $orderby ) {
										case 'name' :
											$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
										break;
										case 'id' :
											$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false );
										break;
										case 'menu_order' :
											$args = array( 'menu_order' => 'ASC' );
										break;
									}

									$terms = get_terms( $name, $args );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) )
											continue;

										echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
									}
								} else {

									foreach ( $options as $option ) {
										echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
									}

								}
							}
						?>
					</select> <?php
						if ( sizeof($attributes) == $loop )
							echo '<a class="reset_variations" href="#reset">'. apply_filters( 'yit_clear_selection_text', __('Clear selection', 'yit') ) .'</a>';
					?>
	        <?php endforeach;?>
	</div>

	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap" style="display:none;">
        <?php do_action( 'woocommerce_before_single_variation' ); ?>

        <div class="variations_button for_quantity">
		    <?php if ( is_shop_enabled() ) woocommerce_quantity_input(); ?>
        </div>

		<?php if( yit_get_option('shop-detail-show-price') || (is_shop_enabled() && yit_get_option('shop-detail-add-to-cart')) ) : ?>
		<div class="woocommerce-price-and-add group">
			<!--div class="woocommerce-price"><?php wc_get_template( 'single-product/price.php' ); ?></div-->
			<!--div class="woocommerce-add-to-cart"-->

				<?php if( yit_get_option('shop-detail-show-price') ): ?>
				<div class="single_variation"></div>
				<?php endif ?>


				<?php if( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') ) : ?>
				<div class="variations_button">
                    <input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
                    <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
					<input type="hidden" name="variation_id" value="" />
					<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'yit'), $product->product_type); ?></button>
				</div>
				<?php endif ?>
			<!--/div-->
		</div>
		<?php endif ?>

        <?php do_action( 'woocommerce_after_single_variation' ); ?>
	</div>
	<div><input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /></div>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php
wc_enqueue_js( "

	jQuery('form.variations_form').on( 'woocommerce_variation_select_change', function( event, variation ) {
        jQuery('.variations_form .stock').remove();
    } );
" );
?>