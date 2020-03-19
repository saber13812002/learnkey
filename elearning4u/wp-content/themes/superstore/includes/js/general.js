/*-----------------------------------------------------------------------------------*/
/* GENERAL SCRIPTS */
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){

	// Table alt row styling
	jQuery( '.entry table tr:odd' ).addClass( 'alt-table-row' );

	// FitVids - Responsive Videos
	jQuery( '.post, .widget, .panel, .page, #featured-slider .slide-media' ).fitVids();

	// Add class to parent menu items with JS until WP does this natively
	jQuery("ul.sub-menu, ul.children").parents('li').addClass('parent');


	// Responsive Navigation (switch top drop down for select)
	jQuery('ul#top-nav').mobileMenu({
	    switchWidth: 769,                   //width (in px to switch at)
	    topOptionText: 'Select a page',     //first option text
	    indentString: '&nbsp;&nbsp;&nbsp;'  //string for indenting nested items
	});



  	// Show/hide the main navigation
  	jQuery('.nav-toggle').click(function() {
	  jQuery('#navigation, .header-top .account, .header-top .cart').slideToggle('fast', function() {
	  	return false;
	    // Animation complete.
	  });
	});

	// Stop the navigation link moving to the anchor (Still need the anchor for semantic markup)
	jQuery('.nav-toggle a').click(function(e) {
        e.preventDefault();
    });

    jQuery(function(){
		jQuery('.star-rating, ul.cart a.cart-contents, .cart a.remove, .added_to_cart, a.tiptip').tipTip({
			defaultPosition: "top",
			delay: 0
		});
	});

	// Show / hide the shipping address header on the checkout
   	$('#shiptobilling input').change(function(){
		$('#shiptobilling + h3').hide();
		if (!$(this).is(':checked')) {
			$('#shiptobilling + h3').slideDown();
		}
	}).change();

	// Only apply the fixed stuff to desktop devices

	if ( ! navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) {

		// Payment box fixed
		if (jQuery(window).width() > 767) {
			var bh = $('body').height();
		   	var pos = $('#payment').position();

		   	if (jQuery(window).width() > 767) {
				$('#payment').top
		   	}

		   	$(window).scroll(function() {

			var c = $(document).scrollTop();
			var b = $(window).height();
			var w = $(document).width();

			if ($(window).width() > 768){
			   if (c > 600+pos.top){
				$('#payment').css('position','fixed').css('width',$('#order_review .shop_table').width()).addClass('fixed');
			   } else {
				$('#payment').removeAttr('style').removeClass('fixed');
			   }
			} else {
			   $('#payment').removeAttr('style').removeClass('fixed');
			}
				// console.log(bh);
		   	});
			$(window).resize(function(){
				if (jQuery(window).width() > 767) {
					$('#payment').removeAttr('style').removeClass('fixed');
				} else {
					$('#payment').css('width',$('#order_review .shop_table').width());
				}
		   	});
		}

		// #navigation fixed
		if (jQuery(window).width() > 767) {
			var bh = $('body').height();
		   	var pos = $('#navigation').position();

		   	if (jQuery(window).width() > 767) {
				$('#navigation').top
		   	}

		   	$(window).scroll(function() {

			var c = $(document).scrollTop();
			var b = $(window).height();
			var w = $(document).width();

			if (jQuery(window).width() > 767) {
			   if (c > 30+pos.top){
				$('#navigation').css('position','fixed').css('width',$('.header-top').width()).addClass('fixed');
			   } else {
				$('#navigation').removeAttr('style').removeClass('fixed');
			   }
			} else {
			   $('#navigation').removeAttr('style').removeClass('fixed');
			}
				// console.log(bh);
		   	});
			$(window).resize(function(){
				if (jQuery(window).width() > 767) {
					$('#navigation').removeAttr('style').removeClass('fixed');
				} else {
					$('#navigation').css('width',$('#order_review .shop_table').width());
				}
		   	});
		}

	}

});