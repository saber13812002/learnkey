// JavaScript Document
if (!window.parseBool) {
	function parseBool(value) {
	  if (typeof value === "string") {
	     value = value.replace(/^\s+|\s+$/g, "").toLowerCase();
	     if (value === "true" || value === "false")
	       return value === "true";
	  }
	  return; // returns undefined
	}
}

jQuery(function(){ 

	jQuery('.view a').click(function(){

		if(jQuery(this).hasClass('gallery')){
		
			jQuery(this).parent().parent().find('.block').removeClass('block-fullwidth');
			jQuery('.view a').removeClass('active');
			jQuery(this).addClass('active');
		
		} else {
					
			jQuery(this).parent().parent().find('.block').addClass('block-fullwidth');
			jQuery('.view a').removeClass('active');
			jQuery(this).addClass('active');
		
		}
		
		return false;
		
	});
	
	// Uniform
	jQuery("select.orderby, .variations select, input[type=radio]").uniform();
   	// Setup the slider
   jQuery(window).load(function(){
	   if( jQuery.isFunction(jQuery.fn.slides) && woo_general_params.enabled=='true' ) {
			if ( jQuery( '#slides .slide' ).length > 1 ) {
			
				jQuery('#slides').slides({
					preload: 			true,
					preloadImage: 		woo_general_params.loading_image,
					autoHeight: 		parseBool(woo_general_params.autoheight),
					effect: 			woo_general_params.effect,
					randomize: 			parseBool(woo_general_params.randomize),					
					hoverPause: 		parseBool(woo_general_params.hoverPause),
					
					container: 			'slides_container',	
					play: 				parseInt(woo_general_params.play),		
					slideSpeed: 		parseInt(woo_general_params.slideSpeed),
					fadeSpeed:			parseInt(woo_general_params.slideSpeed),
					
					crossfade: 			true,
					generateNextPrev: 	false,
					generatePagination: parseBool(woo_general_params.generatePagination),
					animationStart: function(){
						jQuery('.slide-content').animate({
							opacity:0,
							right:-500,
							filter:''
						},200);
					},
					animationComplete: function(current){
						jQuery('.slide-content').animate({
							opacity:1,
							right:0,
							filter:''
						},300);
					}, 
					slidesLoaded: function () { jQuery( '#slides .navigation' ).fadeIn( 'slow' ); }
						
				});
			
			} else {
				jQuery( '#slides .slide:first' ).fadeIn( 'slow' );
			}
			
			if (woo_general_params.generatePagination=='true') {
				jQuery( '#slides .pagination' ).wrap( '<div id="slider_pag" />' );
				jQuery( '#slides #slider_pag' ).wrap( '<div id="slider_nav" />' );
			}
		}
	});
	
});