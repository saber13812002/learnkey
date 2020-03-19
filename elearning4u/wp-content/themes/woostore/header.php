<?php
/**
 * Header Template
 *
 * Here we setup all logic and HTML that is required for the header section of all screens.
 *
 */
 global $woo_options;
 global $woocommerce;
?>

<?php 
	$http_or_https = (is_ssl()) ? 'https:' : 'http:';	
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html  lang="fa-IR" class="no-js"> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<!-- The main stylesheet -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php $GLOBALS['feedurl'] = get_option('woo_feed_url'); if ( !empty($feedurl) ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Load Modernizr which enables HTML5 elements & feature detects -->
<script src="<?php echo get_template_directory_uri(); ?>/includes/js/libs/modernizr-2.0.6.min.js"></script>	
      
<?php wp_head(); ?>
<?php woo_head(); ?>

<!-- Load Google HTML5 shim to provide support for <IE9 -->
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body <?php body_class(get_option('woo_site_layout')); ?>>
<?php woo_top(); ?>

<div id="wrapper">

	<?php if ( function_exists( 'has_nav_menu') && has_nav_menu( 'top-menu' ) ) { ?>

	<div id="top">
		<div class="col-full">
			<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
		</div>
	</div><!-- /#top -->

    <?php } ?>

	<div id="header" class="col-full">

		<div id="logo">

		<?php if ($woo_options['woo_texttitle'] != 'true' ) : $logo = $woo_options['woo_logo']; ?>
			<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>">
				<img src="<?php if ($logo) echo $logo; else { echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo( 'name' ); ?>" />
			</a>
        <?php endif; ?>

        <?php if( is_singular() && !is_front_page() ) : ?>
			<span class="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></span>
        <?php else : ?>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <?php endif; ?>
			<span class="site-description"><?php bloginfo( 'description' ); ?></span>

		</div><!-- /#logo -->
		
		<div id="search-top">
	    
	    	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>">
				<label class="screen-reader-text" for="s"><?php _e('Search for:', 'woothemes'); ?></label>
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  class="field s" placeholder="<?php _e('Search for products', 'woothemes'); ?>" />
				<input type="image" class="submit btn" name="submit" value="<?php _e('Search', 'woothemes'); ?>" src="<?php echo get_template_directory_uri(); ?>/images/ico-search.png">
				<input type="hidden" name="post_type" value="product" />
			</form>
			<div class="fix"></div>
			
			

		</div><!-- /.search-top -->

	</div><!-- /#header -->
	
	<div id="container" class="col-full">

	<div id="navigation" class="col-full">
		<div id="nav-home" class="fl"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ico-home-active.png" alt="" /></a></div>
		<?php
		if ( function_exists( 'has_nav_menu') && has_nav_menu( 'primary-menu') ) {
			wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
		} else {
		?>
        <ul id="main-nav" class="nav fl">
			<?php
        	if ( isset($woo_options[ 'woo_custom_nav_menu' ]) AND $woo_options[ 'woo_custom_nav_menu' ] == 'true' ) {
        		if ( function_exists( 'woo_custom_navigation_output') )
					woo_custom_navigation_output();
			} else { ?>
	            <?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
	            <li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'woothemes' ) ?></a></li>
	            <?php
	    			wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' );
			}
			?>
        </ul><!-- /#nav -->
        <?php } ?>
        
        <div id="btn-cart" class="fr">
        	<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
				<span> 
				<?php 
				echo sprintf(_n('%d item &ndash; ', '%d items &ndash; ', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
				echo $woocommerce->cart->get_cart_total();
				?>
				</span>
			</a>
        </div>
        
        <ul id="account-nav" class="nav fr">
        
        <li class="account">
        	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('Account','woothemes'); ?></a>
        </li>
        <?php
        if (sizeof($woocommerce->cart->cart_contents)>0) :
        echo '<li class="checkout"><a href="'.$woocommerce->cart->get_checkout_url().'">'.__('Checkout','woothemes').'</a></li>';
    	endif; 
    	?>
    	
    	</ul>

	</div><!-- /#navigation -->