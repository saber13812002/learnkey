<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;
if ( !( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) )
    $woocommerce_loop['layout'] = 'with-hover';

if ( !( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) )
    $woocommerce_loop['view'] = 'grid';

// remove the shortcode from the short description, in list view
remove_filter( 'woocommerce_short_description', 'do_shortcode', 11 );
add_filter( 'woocommerce_short_description', 'strip_shortcodes' );

// li classes
$woocommerce_loop['li_class'] = array();
$woocommerce_loop['li_class'][] = 'product category';
$woocommerce_loop['li_class'][] = 'group';
$woocommerce_loop['li_class'][] = 'grid';
$woocommerce_loop['li_class'][] = $woocommerce_loop['layout'];
if ( yit_get_option('shop-view-show-border') ) {
    $woocommerce_loop['li_class'][] = 'with-border';
}

// width of each product for the grid
$content_width = yit_get_sidebar_layout() == 'sidebar-no' ? 1170 : 870;
if ( isset( $yit_is_feature_tab ) && $yit_is_feature_tab ) $content_width -= 300;
$product_width = yit_shop_catalog_w() + 10 + 2;  // 10 = padding & 2 = border
$is_span = false;
if ( get_option('woocommerce_responsive_images') == 'yes' ) {
    $is_span = true;
    if ( yit_get_sidebar_layout() == 'sidebar-no' ) {
            if ( $product_width >= 0   && $product_width < 120 ) { $woocommerce_loop['li_class'][] = 'span1'; $woocommerce_loop['columns'] = 12; }
        elseif ( $product_width >= 120 && $product_width < 220 ) { $woocommerce_loop['li_class'][] = 'span2'; $woocommerce_loop['columns'] = 6;  }
        elseif ( $product_width >= 220 && $product_width < 320 ) { $woocommerce_loop['li_class'][] = 'span3'; $woocommerce_loop['columns'] = 4;  }
        elseif ( $product_width >= 320 && $product_width < 470 ) { $woocommerce_loop['li_class'][] = 'span4'; $woocommerce_loop['columns'] = 3;  }
        elseif ( $product_width >= 470 && $product_width < 620 ) { $woocommerce_loop['li_class'][] = 'span6'; $woocommerce_loop['columns'] = 2;  }
        else $is_span = false;

    } else {
            if ( $product_width >= 0   && $product_width < 150 ) { $woocommerce_loop['li_class'][] = 'span1'; $woocommerce_loop['columns'] = 12; }
        elseif ( $product_width >= 150 && $product_width < 620 ) { $woocommerce_loop['li_class'][] = 'span3'; $woocommerce_loop['columns'] = 3;  }
        else $is_span = false;

    }
}
if ( isset($yit_is_feature_tab) && ($yit_is_feature_tab || ! $is_span) ) $woocommerce_loop['columns'] = floor( ( $content_width + 30 ) / ( $product_width + 30 ) );

$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woocommerce_loop['columns'] );

// first and last
    if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )         $woocommerce_loop['li_class'][] = 'last';
elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) $woocommerce_loop['li_class'][] = 'first';
?>
<li class="<?php echo implode( ' ', $woocommerce_loop['li_class'] ) ?>">

<div class="product-thumbnail group">

        <div class="thumbnail-wrapper">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<h3>
			<?php echo $category->name; ?>
			<?php if ( $category->count > 0 ) : ?>
				<mark class="count">(<?php echo $category->count; ?>)</mark>
			<?php endif; ?>
		</h3>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div></div>
</li>