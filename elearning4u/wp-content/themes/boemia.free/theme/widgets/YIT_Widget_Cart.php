<?php
/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author 		YIThemes
 * @extends 	WP_Widget
 */
class YIT_Widget_Cart extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function YIT_Widget_Cart() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass 		= 'woocommerce widget_shopping_cart';
		$this->woo_widget_description 	= __( "Display the user's Cart in the sidebar. (No checkout or cart page control)", 'woocommerce' );
		$this->woo_widget_idbase 		= 'yit_widget_cart';
		$this->woo_widget_name 			= __( 'WooCommerce Cart', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget( 'shopping_cart', $this->woo_widget_name, $widget_ops );
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		global $woocommerce, $yit_topbar;

		extract( $args );

        $cart_count = isset( $woocommerce->cart->cart_contents ) ? count( $woocommerce->cart->cart_contents ) : 0;

		//if ( is_cart() || is_checkout() ) return;

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Cart', 'woocommerce') : $instance['title'], $instance, $this->id_base );
		$hide_if_empty = empty( $instance['hide_if_empty'] )  ? 0 : 1;

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		//$woocommerce->mfunc_wrapper( 'woocommerce_mini_cart()', 'woocommerce_mini_cart', array( 'list_class' => $hide_if_empty ? 'hide_cart_widget_if_empty' : '' ) );
		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		
		if($yit_topbar) :
			if ( $cart_count > 0 ) : ?>
			<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart_control"><span class="count"><?php echo $cart_count; ?></span></a>
			<?php else: ?>
			<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart_control cart_control_empty"><span class="count"><?php echo $cart_count; ?></span></a>
			<?php endif ?>
		<div class="cart_wrapper">
		<?php endif;
		
        echo '<div class="widget_shopping_cart_content ' . ( $hide_if_empty ? 'hide_cart_widget_if_empty' : '' ) . '">
		                    <ul class="cart_list product_list_widget">
                        <li class="empty">' . __( 'No products in the cart.', 'yit' ) . '</li>
                    </ul>
		</div>';
		
		if($yit_topbar): ?>
			</div>

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:800&text=<?php echo $cart_count; ?>">


            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $(document).on('click', '.cart_control', function(e){
                        //e.preventDefault();
                    });

                    $(document).on('hover', '.cart_control', function(){
                        $(this).next('.cart_wrapper').slideDown();
                    }).on('mouseleave', '.cart_control', function(){
                            $(this).next('.cart_wrapper').delay(500).slideUp();
                        });


                    $(document).on('mouseenter', '.cart_wrapper', function(){ $(this).stop(true,true).show() });
                    $(document).on('mouseleave', '.cart_wrapper', function(){ $(this).delay(500).slideUp() });
                });
            </script>
			<?php endif;

		echo $after_widget;

		if ( $hide_if_empty && sizeof( $woocommerce->cart->get_cart() ) == 0 ) {
			$woocommerce->add_inline_js( "
				jQuery('.hide_cart_widget_if_empty').closest('.widget').hide();
				jQuery('body').bind('adding_to_cart', function(){
					jQuery(this).find('.hide_cart_widget_if_empty').closest('.widget').fadeIn();
				});
			" );
		}
	}


	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['hide_if_empty'] = empty( $new_instance['hide_if_empty'] ) ? 0 : 1;
		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'woocommerce') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('hide_if_empty') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_if_empty') ); ?>"<?php checked( $hide_if_empty ); ?> />
		<label for="<?php echo $this->get_field_id('hide_if_empty'); ?>"><?php _e( 'Hide if cart is empty', 'woocommerce' ); ?></label></p>
		<?php
	}

}