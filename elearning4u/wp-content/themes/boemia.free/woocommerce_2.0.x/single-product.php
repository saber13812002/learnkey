<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */ 

get_header('shop');

wp_enqueue_script( 'jquery-elastislider' ); ?>
    	<?php
    		/**
    		 * woocommerce_before_main_content hook
    		 *
    		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
    		 * @hooked woocommerce_breadcrumb - 20
    		 */
    		do_action('woocommerce_before_main_content');
    	?>
        
        <div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    		<?php while ( have_posts() ) : the_post(); ?>
    
    			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
    
    		<?php endwhile; // end of the loop. ?>
      
        </div><!-- #product-<?php the_ID(); ?> -->
    
    	<?php
    		/**
    		 * woocommerce_after_main_content hook
    		 *
    		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
    		 */
    		do_action('woocommerce_after_main_content');
    	?>
    
    	<?php
    		/**
    		 * woocommerce_sidebar hook
    		 *
    		 * @hooked woocommerce_get_sidebar - 10
    		 */
    		do_action('woocommerce_sidebar');
    	?>
<?php get_footer('shop'); ?>