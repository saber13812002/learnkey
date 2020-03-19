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



add_action('wp_print_styles', 'add_widgets_css');

if( !function_exists( 'add_widgets_css' ) ) {
	/*
	 * Add style of widgets in theme
	 */
	function add_widgets_css(){
		$url = YIT_THEME_ASSETS_URL . '/css/widgets.css';
	    //wp_register_style('widgets_css', $url);
	    yit_enqueue_style(1300, 'widgets_css', $url);	
	}
}
