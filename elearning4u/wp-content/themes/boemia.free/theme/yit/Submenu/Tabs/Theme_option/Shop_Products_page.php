<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
/**
 * Class to print fields in the tab Shop -> Products page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Products_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_products_page
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return array(
        	10 => array(
                'id'   => 'shop-products-title',
                'type' => 'onoff',
                'name' => __( 'Show products page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Products.', 'yit' ),
                'std'  => true,
            ),
            15 => array(
                'id'   => 'shop-products-text-title',
                'type' => 'text',
                'name' => __( 'Custom title for shop products', 'yit' ),
                'desc' => __( 'Add your text for title of Products.', 'yit' ),
                'std'  => 'Products',
                'deps' => array (
					'ids' => 'shop-products-title',
					'values' => 1
				)
            ),
            30 => array(
                'id'   => 'shop-view-show-details',
                'type' => 'onoff',
                'name' => __( 'Show details icon', 'yit' ),
                'desc' => __( 'Say if you want to show the details icon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-details_std', 1 )
            ),   
            40 => array(
                'id'   => 'shop-view-show-add-to-cart',
                'type' => 'onoff',
                'name' => __( 'Show add to cart', 'yit' ),
                'desc' => __( 'Say if you want to show the details icon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-add-to-cart_std', 1 )
            ),    
            50 => array(
                'id'   => 'shop-view-show-title',
                'type' => 'onoff',
                'name' => __( 'Show product title', 'yit' ),
                'desc' => __( 'Say if you want to show the product title.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-title_std', 1 )
            ),
            60 => array(
                'id'   => 'shop-view-show-price',
                'type' => 'onoff',
                'name' => __( 'Show product price', 'yit' ),
                'desc' => __( 'Say if you want to show the product price.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-price_std', 1 )
            ),
            65 => array(
                'id'   => 'shop-view-show-rating',
                'type' => 'onoff',
                'name' => __( 'Show product rating', 'yit' ),
                'desc' => __( 'Say if you want to show the product rating.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-rating_std', 0 )
            ),
            100 => array(
                'id'   => 'shop-sale-label',
                'type' => 'text',
                'name' => __( 'Sale label', 'yit' ),
                'desc' => __( 'Choose the label you want to display when a product is in sale.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-sale-label_std', 'Sale!' )
            ),    
        );
    }
}