<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

global $product;                                    

$details = sprintf('<a href="%s" rel="nofollow" title="%s" class="details">%s</a>', get_permalink( $product->id ), __( 'Details', 'yit' ), __( 'Details', 'yit' ));
if ( ! yit_get_option('shop-view-show-details') )
    { $details = ''; } 

if ( ! is_shop_enabled() || ! yit_get_option('shop-view-show-add-to-cart') || ! $product->is_purchasable() ) :
    $add_to_cart = ''; 

$out_of_stock = '';
?>

<?php elseif ( ! $product->is_in_stock() ) : $add_to_cart = ''; $label = apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'yit' ) ); ?>

	<?php $out_of_stock = sprintf( '<a class="button out-of-stock" title="%s">%s</a>', $label, $label ); ?>

<?php else : ?>

	<?php
	
	   $add_to_cart = '';

		switch ( $product->product_type ) {
			case "variable" :
				$link 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'variable_add_to_cart_text', __('Select options', 'yit') );
				$add_to_cart = sprintf('<a href="%s" rel="nofollow" class="view-options" title="%s">%s</a>', $link, $label, $label);
			break;
			case "grouped" :
				$link 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'grouped_add_to_cart_text', __('View options', 'yit') );   
				$add_to_cart = sprintf('<a href="%s" rel="nofollow" class="view-options" title="%s">%s</a>', $link, $label, $label);
			break;
			case "external" :
				$link 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'external_add_to_cart_text', __('Read More', 'yit') );    
				$add_to_cart = sprintf('<a href="%s" rel="nofollow" class="view-options" title="%s">%s</a>', $link, $label, $label);
			break;
			default :
				$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
				$label 	= apply_filters( 'add_to_cart_text', __('Add to cart', 'yit') );
                $quantity = apply_filters( 'add_to_cart_quantity', ( get_post_meta( $product->id, 'minimum_allowed_quantity', true ) ? get_post_meta( $product->id, 'minimum_allowed_quantity', true ) : 1 ) );
                $add_to_cart = sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-quantity="%s" class="add_to_cart_button button product_type_%s" title="%s">%s</a>', $link, $product->id, $quantity, $product->product_type, $label, $label);
			break;
		}
        
	?>

<?php endif; ?>

<?php if ( ! empty( $add_to_cart ) || ! empty( $details ) ) : ?>
<div class="product-actions">
    <?php echo $details; ?>
    <?php echo $add_to_cart; ?>
    <?php if (isset($out_of_stock) && $out_of_stock != '') : echo $out_of_stock; endif ?>
</div>
<?php endif; ?>