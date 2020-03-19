<?php
/**
 * Content Wrappers
 */
?>
            <!-- START PAGE META -->
            <div id="page-meta" class="group">
                <?php if ( ( !is_product_category() && yit_get_option('shop-products-title') ) || ( is_product_category() && yit_get_option('shop-category-title') ) || ( is_product() && yit_get_option('shop-products-details-title') ) ) : ?>
                    <h1 class="product-title page-title"><?php is_product() ? the_title() :  woocommerce_page_title() ?></h1>
                <?php endif; ?>

        		<?php do_action( 'shop_page_meta' ) ?>
        	</div>
        	<!-- END PAGE META -->   