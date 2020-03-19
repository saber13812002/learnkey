<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register theme metaboxes.
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

function yit_remove_options_metabox( $array ) {
    
    return $array;
}
add_filter( 'yit_remove_options_metabox', 'yit_remove_options_metabox' );

//yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

/**
 * TESTIMONIALS
 */ 
yit_metaboxes_sep( 'yit-testimonial-site', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Small quote', 'yit' ),
    'desc' =>  __( 'Insert the text to show with blockquote', 'yit' ),
);

yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_small-quote', 'text', $options );

/**
 * LOGOS
 */ 
yit_register_metabox ( 'yit-logo-site', __( 'Other Logo info', 'yit' ), 'logo' );
$options = array(
    'title' => __( 'Link', 'yit' ),
    'desc' =>  __( 'Insert the link for Logo.', 'yit' ),
);
yit_add_option_metabox( 'yit-logo-site', __( 'Settings', 'yit' ), '_site-link', 'text', $options );
