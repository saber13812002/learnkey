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
 
yit_meta_tags() ?>

<title><?php yit_title() ?></title>

<!-- RESET STYLESHEET -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo YIT_THEME_CSS_URL . '/reset.css'; ?>" />
<!-- BOOTSTRAP STYLESHEET -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo YIT_CORE_ASSETS_URL . '/css/bootstrap.css'; ?>" />
<!-- MAIN THEME STYLESHEET -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<!-- PINGBACK & WP STANDARDS -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php

yit_enqueue_style( 10, 'font-awesome', YIT_CORE_ASSETS_URL . '/css/font-awesome.css', false, '2.0', 'all' );
if( yit_ie_version() == 7 )
    { yit_enqueue_style( 10, 'font-awesome-ie7', YIT_CORE_ASSETS_URL . '/css/font-awesome-ie7.css', false, '2.0', 'all' ); }

// colorbox
if ( is_shop_installed() ) {
    if( ! is_checkout() )
        { wp_enqueue_script( 'jquery-colorbox', get_template_directory_uri() .'/theme/assets/js/jquery.colorbox-min.js', array('jquery'), '1.0', true); }
} else {
    wp_enqueue_script( 'jquery-colorbox', get_template_directory_uri() .'/theme/assets/js/jquery.colorbox-min.js', array('jquery'), '1.0', true);
}

// jquery
wp_enqueue_script( 'jquery' );

// easing
wp_enqueue_script( 'jquery-easing', get_template_directory_uri() .'/theme/assets/js/jquery.easing.js', array('jquery'), '1.3', true);

// easing
wp_enqueue_script( 'jquery-masonry', get_template_directory_uri() .'/theme/assets/js/jquery.masonry.js', array('jquery'), '1.0', true);

// flexslider
wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() .'/theme/assets/js/jquery.flexslider-min.js', array('jquery'), '', true);

//Custom Javascript
wp_enqueue_script( 'jquery-custom', YIT_THEME_JS_URL . '/jquery.custom.js', array('jquery'), '1.0', true);

// carouFredSel
wp_register_script( 'caroufredsel', get_template_directory_uri() .'/theme/assets/js/jquery.carouFredSel-6.1.0-packed.js' );

wp_register_script( 'touch-swipe', get_template_directory_uri() .'/theme/assets/js/jquery.touchSwipe.min.js' );
wp_register_script( 'ba-throttle-debounce', get_template_directory_uri() .'/theme/assets/js/jquery.ba-throttle-debounce.min.js' );
wp_register_script( 'mousewheel', get_template_directory_uri() .'/theme/assets/js/jquery.mousewheel.min.js' );

// BlackAndWhite
wp_register_script( 'black-and-white', get_template_directory_uri() .'/theme/assets/js/jQuery.BlackAndWhite.js' );

//Responsive
if ( yit_get_option( 'responsive-enabled' ) ) {
	wp_enqueue_script( 'responsive-theme', YIT_THEME_JS_URL . '/responsive.js', array( 'jquery' ), '1.0', true );
}

$jquery_custom_l10n = array(
    'map_close' => __( '[x] Close', 'yit' ),
    'map_open' => __( '[x] Open', 'yit' )
);
wp_localize_script( 'jquery-custom', 'l10n_handler', $jquery_custom_l10n );

/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

// Enqueue blog styles
do_action( 'yit_enqueue_blog_stuffs' );
                                                                                        
if ( is_shop_installed() ) {
    if ( ! is_checkout() ) {
        yit_enqueue_style( 10, 'colorbox', get_template_directory_uri() .'/theme/assets/css/colorbox.css' );
    }
} else {
    yit_enqueue_style( 10, 'colorbox', get_template_directory_uri() .'/theme/assets/css/colorbox.css' );
}
yit_enqueue_style( 10, 'comments', YIT_THEME_TEMPLATES_URL . '/comments/css/style.css' );
?>

<!-- [favicon] begin -->
<link rel="shortcut icon" type="image/x-icon" href="<?php yit_favicon() ?>" />
<link rel="icon" type="image/x-icon" href="<?php yit_favicon() ?>" />
<!-- [favicon] end -->

<!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
<!-- For iPad3 with retina display: -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-144x.png" />
<!-- For first- and second-generation iPad: -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-114x.png" />
<!-- For first- and second-generation iPad: -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/icons/apple-touch-icon-72x.png">
<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-57x.png" />