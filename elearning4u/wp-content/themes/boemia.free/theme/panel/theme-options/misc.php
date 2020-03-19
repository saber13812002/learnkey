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

function yit_admin_menu_theme_options( $array ) {
    return array_merge( $array, array(
    	'shop' => __( 'Shop', 'yit' )            
    ) );
}
add_filter( 'yit_admin_menu_theme_options', 'yit_admin_menu_theme_options' );

function yit_admin_submenu_theme_options( $array ) {
    return array_merge( $array, array(
        'general' => array(
            'settings' => __( 'Settings', 'yit' ),
            'footer' => __( 'Footer', 'yit' ),
            'integration' => __( 'Integration', 'yit' )
        ),
        'shop' => array(
            'general_settings' => __( 'General settings', 'yit' ),
            'products_page' => __( 'Products page', 'yit' ),
            'products_details_page' => __( 'Products details page', 'yit' ),
            'category_page' => __( 'Category page', 'yit' )
        )
    ) );
}
add_filter( 'yit_admin_submenu_theme_options', 'yit_admin_submenu_theme_options' );