<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;

$order = new WC_Order( $order_id );
$span_size = 'span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? 4 : 3 );
?>
<h2><?php _e('Order Details', 'yit'); ?></h2>
<table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e('Product', 'yit'); ?></th>
			<th class="product-total"><?php _e('Total', 'yit'); ?></th>
		</tr>
	</thead>
	<tfoot>
	<?php
		if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
			?>
			<tr>
				<th scope="row"><?php echo $total['label']; ?></th>
				<td><?php echo $total['value']; ?></td>
			</tr>
			<?php
		endforeach;
	?>
	</tfoot>
	<tbody>
		<?php
		if (sizeof($order->get_items())>0) :

			foreach($order->get_items() as $item) :

				$_product = get_product( $item['variation_id'] ? $item['variation_id'] : $item['product_id'] );

				echo '
					<tr class = "' . esc_attr( apply_filters('woocommerce_order_table_item_class', 'order_table_item', $item, $order ) ) . '">
						<td class="product-name">';

				echo '<a href="'.get_permalink( $item['product_id'] ).'">' . $item['name'] . '</a> <strong class="product-quantity">&times; ' . $item['qty'] . '</strong>';

				$item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
				$item_meta->display();

				if ( $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) :

					$download_file_urls = $order->get_downloadable_file_urls( $item['product_id'], $item['variation_id'], $item );
					foreach ( $download_file_urls as $i => $download_file_url ) :
						echo '<br/><small><a href="' . $download_file_url . '">' . sprintf( __( 'Download file %s &rarr;', 'yit' ), ( count( $download_file_urls ) > 1 ? $i + 1 : '' ) ) . '</a></small>';
					endforeach;

				endif;

				echo '</td><td class="product-total">' . $order->get_formatted_line_subtotal( $item ) . '</td></tr>';

				// Show any purchase notes
				if ($order->status=='completed' || $order->status=='processing') :
					if ($purchase_note = get_post_meta( $_product->id, '_purchase_note', true)) :
						echo '<tr class="product-purchase-note"><td colspan="3">' . apply_filters('the_content', $purchase_note) . '</td></tr>';
					endif;
				endif;

			endforeach;
		endif;

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
</table>

<?php if ( get_option('woocommerce_allow_customers_to_reorder') == 'yes' && $order->status=='completed' ) : ?>
	<p class="order-again">
		<a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button"><?php _e('Order Again', 'yit'); ?></a>
	</p>
<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<div class="row my-account-order-details">
    <div class="<?php echo $span_size ?>">
        <dl class="customer_details">
            <header class="title">
            	<h2><?php _e('Customer details', 'yit'); ?></h2>
            </header>
        <?php
        	if ($order->billing_email) echo '<dt>'.__('Email:', 'yit').'</dt><dd>'.$order->billing_email.'</dd>';
        	if ($order->billing_phone) echo '<dt>'.__('Telephone:', 'yit').'</dt><dd>'.$order->billing_phone.'</dd>';
        ?>
        </dl>
    </div>
    
    <?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>
    
    <div class="<?php echo $span_size ?> addresses">
        <div>
    		<header class="title">
    			<h3><?php _e('Billing Address', 'yit'); ?></h3>
    		</header>
    		<address><p>
    			<?php
    				if (!$order->get_formatted_billing_address()) _e('N/A', 'yit'); else echo $order->get_formatted_billing_address();
    			?>
    		</p></address>
        </div>
    </div>
    
    <?php endif; ?>
    <?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>
    <div class="<?php echo $span_size ?> addresses">
        <div>
    		<header class="title">
    			<h3><?php _e('Shipping Address', 'yit'); ?></h3>
    		</header>
    		<address><p>
    			<?php
    				if (!$order->get_formatted_shipping_address()) _e('N/A', 'yit'); else echo $order->get_formatted_shipping_address();
    			?>
    		</p></address>
        </div>
    </div>
    
    <?php endif; ?>
</div>