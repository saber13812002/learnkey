(function( window, $, undefined ) {

	$.yit_panel_typography = function( options, element ) {
		this.element = $( element );
		this._init( options );
	};

	$.yit_panel_typography.defaults	= {
		elements : {
			size:    '.typography_size',
			unit:    '.typography_unit',
			family:  '.typography_family',
			style:   '.typography_style',
			color:   '.typography_color',
			preview: '.font-preview p',
			refresh: '.refresh'
		}
	};

	$.yit_panel_typography.prototype = {
		_init : function( options ) {
			this.options = $.extend( true, {}, $.yit_panel_typography.defaults, options );
			this._loadElements();
			this._initEvents();
		},
		
		_loadElements : function() {
			var elements = this.options.elements;
			var container = this.element;
			
			for( var el in elements) {
				elements[el] = container.find( elements[el] );
			}
		},
		
		_initEvents : function() {
			var elements = this.options.elements;
			var self = this;
			
			//size
			var size = elements.size;
			size.spinner({
				min: size.data('min') ? size.data('min') : null,
				max: size.data('max') ? size.data('max') : null
			});
			
			//color
			var color = elements.color;
			color.ColorPicker({
				color: elements.color.data('color'),
    			onShow: function (colpkr) {
    				$(colpkr).fadeIn(500);
    				return false;
    			},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
    			},
				onChange: function (hsb, hex, rgb) {                            
					elements.color.find('div').css('backgroundColor', '#' + hex);
					elements.color.next( 'input' ).attr( 'value', '#' + hex );
                    
					if( elements.refresh.is( ':visible' ) ) { return; }
					elements.preview.css( 'color', '#' + hex );
				}
			});
			
			//refresh
			var refresh = elements.refresh;
			refresh.on('click', function(e){
				e.preventDefault();
				
                $(this).parent().fadeOut( 'slow' );
                        
                //Set current value, before trigger change event
                    
                //Color
                elements.preview.css( 'color', elements.color.next().val() );
                        
                //Font size
                var size = elements.size.val();
                var unit = elements.unit.val();
                         
                elements.preview.css( 'font-size', size + unit );
                elements.preview.css( 'line-height', ( unit == 'em' || unit == 'rem' ? Number( size ) + 0.4 : Number ( size ) + 4 ) + unit );
                        
                //Font style
                var style = elements.style.val();
                                                 
                if( style == 'italic' ) {
                	elements.preview.css({ 'font-weight' : 'normal', 'font-style' : 'italic' });
                } else if( style == 'bold' ) {
                	elements.preview.css({ 'font-weight' : 'bold', 'font-style' : 'normal' }); 
                } else if( style == 'extra-bold' ) {
                    elements.preview.css({ 'font-weight' : '800', 'font-style' : 'normal' }); 
                } else if( style == 'bold-italic' ) {
                    elements.preview.css({ 'font-weight' : 'bold', 'font-style' : 'italic' });
                } else {
                    elements.preview.css({ 'font-weight' : 'normal', 'font-style' : 'normal' });
                }
                        
                //Font Family
                var group = elements.family.find( 'option:selected' ).parent().attr( 'label' );
                             
                if( group == 'Web fonts' ) {
                    //Web font
                    elements.preview.css( 'font-family', elements.family.val() );
                } else {
                    //Google font
                    WebFontConfig = {
                        google: { 
                        	families: [ elements.family.find('option:selected' ).text() ] },
                            fontactive: function( fontFamily, fontDescription ) {
                                            elements.preview.css( 'font-family', fontFamily );
                                        }
                    };
                    
                    (function() {
                        var wf = document.createElement('script');
                            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                                     '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                            wf.type = 'text/javascript';
                            wf.async = 'true';
                                
                        var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(wf, s);
                    })();
                }
			});
			
			//font size, font unit
			$([elements.size, elements.unit]).each(function(){
				$(this).on('change', function(){
					console.log( $(this).attr('id') );
		            if( elements.refresh.is( ':visible' ) ) { return; }
	                         
	                var size = elements.size.val();
	                var unit = elements.unit.val();
	                         
	                elements.preview.css({ 
						'font-size'   : size + unit,
						'line-height' : ( unit == 'em' || unit == 'rem' ? Number( size ) + 0.4 : Number ( size ) + 4 ) + unit
					}).trigger( 'resize' );
				});
			});
			
			//font family
			var family = elements.family;
			family.on('change', function(){
				if( elements.refresh.is( ':visible' ) ) { return; }
				
                var group = $( this ).find( 'option:selected' ).parent().attr( 'label' );
                         
                if( group == 'Web fonts' ) {
                    //Web font
                    elements.preview.css( 'font-family', $( this ).val() );
                } else {
                    //Google font
                    WebFontConfig = {
                        google: { 
                        	families: [ $( this ).val() ] },
                            fontactive: function( fontFamily, fontDescription ) {
                                            elements.preview.css( 'font-family', fontFamily );
                                        }
                    };
                    
                    (function() {
                        var wf = document.createElement('script');
                            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                                      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                            wf.type = 'text/javascript';
                            wf.async = 'true';
                        
                        var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(wf, s);
                    })();
                }
                         
                elements.preview.trigger( 'resize' );
			});
			
			elements.style.on('change', function(){
                if( elements.refresh.is( ':visible' ) ) { return; }
                         
                var style = $( this ).val();
                         
                if( style == 'italic' ) {
                    elements.preview.css({ 'font-weight' : 'normal', 'font-style' : 'italic' });
                } else if( style == 'bold' ) {
                    elements.preview.css({ 'font-weight' : 'bold', 'font-style' : 'normal' }); 
                } else if( style == 'extra-bold' ) {
                    elements.preview.css({ 'font-weight' : '800', 'font-style' : 'normal' }); 
                } else if( style == 'bold-italic' ) {
                    elements.preview.css({ 'font-weight' : 'bold', 'font-style' : 'italic' });
                } else {
                    elements.preview.css({ 'font-weight' : 'normal', 'font-style' : 'normal' });
                }
                         
                elements.preview.trigger( 'resize' );
			});
			
			//preview
            elements.preview.resize(function(){
                var box  = $(this).parents('.yit-box');
                $(this).parents('form').height( box.height() );  
            });
		}
	};

	$.fn.yit_panel_typography = function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
				var instance = $.data( this, 'yit_panel_typography' );
				if ( !instance ) {
					console.error( "cannot call methods on yit_checkout prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					console.error( "no such method '" + options + "' for yit_panel_typography instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {
				var instance = $.data( this, 'yit_panel_typography' );
				if ( !instance ) {
					$.data( this, 'yit_panel_typography', new $.yit_panel_typography( options, this ) );
				}
			});
		}
		return this;
	};


})( window, jQuery );
