<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
if (!function_exists('woothemes_add_javascript')) {
	function woothemes_add_javascript( ) {
		
		global $woo_options;
		
		wp_enqueue_script( 'jquery' );    
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'superfish', get_template_directory_uri().'/includes/js/superfish.js', array( 'jquery' ) );
		wp_enqueue_script( 'wootabs', get_template_directory_uri().'/includes/js/woo_tabs.js', array( 'jquery' ) );
		wp_enqueue_script( 'general', get_template_directory_uri().'/includes/js/general.js', array( 'jquery' ) );		
		wp_enqueue_script( 'uniform', get_template_directory_uri().'/includes/js/jquery.uniform.min.js', array( 'jquery' ) );
		
		//wp_enqueue_script( 'slides', get_template_directory_uri().'/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		//wp_enqueue_script( 'carousel', get_template_directory_uri().'/includes/js/jquery.jcarousel.min.js', array( 'jquery' ) );
		
		// The slider
		if ( (is_home() || is_front_page()) && !is_paged() ) {
			wp_enqueue_script( 'slides', get_template_directory_uri().'/includes/js/slides.min.jquery.js', array( 'jquery' ) );
			wp_enqueue_script( 'jcarousel', get_template_directory_uri().'/includes/js/jquery.jcarousel.min.js', array( 'jquery' ) );
			
			// check interval is within range
			if ( (isset($woo_options[ 'woo_slider_interval' ]) && $woo_options[ 'woo_slider_interval' ] < 1) || (isset($woo_options[ 'woo_slider_interval' ]) && $woo_options[ 'woo_slider_interval' ] > 10 ) ) $woo_options[ 'woo_slider_interval' ] = 6;
		
			// check speed is within range
			if ( isset($woo_options[ 'woo_slider_speed' ]) && $woo_options[ 'woo_slider_speed' ] > 2 ) $woo_options[ 'woo_slider_speed' ] = 0.6;
				
			// Enabled
			if (isset($woo_options[ 'woo_slider' ]) && $woo_options[ 'woo_slider' ] == 'true') :
				$enabled = 'true';
			else :
				$enabled = 'false';
			endif;
			
			$params = array(
				'enabled'		=> $enabled,
				'loading_image' => get_template_directory_uri() . '/images/loading.png',
				'autoheight' 	=> $woo_options[ 'woo_slider_autoheight' ],
				'effect' 		=> $woo_options[ 'woo_slider_effect' ],
				'randomize' 	=> $woo_options[ 'woo_slider_random' ],
				'hoverPause'	=> $woo_options[ 'woo_slider_hover' ],
				'slideSpeed'	=> $woo_options[ 'woo_slider_speed' ] * 1000,
				'generatePagination' => $woo_options[ 'woo_slider_pagination' ]
			);
			
			if ($woo_options[ 'woo_slider_auto' ] == "true") :
				$params['play'] = $woo_options[ 'woo_slider_interval' ] * 1000;
			else :
				$params['play'] = 0;
			endif; 
			
			wp_localize_script( 'general', 'woo_general_params', $params );
		}
		
		
		
	}
}

?>