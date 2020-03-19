// Types JavaScript Document
jQuery(document).ready(function($){


	//upload
 	$('input.upload_button').live('click',function() { 
		var upField = $(this).prev();
		var this_button = $(this);
				
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true&width=700');    
		
		window.send_to_editor = function(html) {
			//alert(html);
						
			imgurl = $('a', '<div>' + html + '</div>').attr('href');
			upField.val(imgurl);
      upField.change();
			console.log(upField);
			//upId.val(idimg[1]);
						
			if ( ! this_button.hasClass('upload-button') ) {
		 		$image_preview = upField.parents('.sortItem').find('.ss-ImageSample');
				if( $image_preview.length > 0 ) $image_preview.attr('src',imgurl);
			}
      
			tb_remove();
		}          
    
		return false;
	});  
	
	// select
    var select_value = function() {
        var value = $(this).children("option:selected").text();
        
        if( value == '' )
            value = $(this).children().children("option:selected").text();
        
                                                                        
        if ( $(this).parent().find('span').length <= 0 ) {  
            $(this).before('<span></span>');
        }
        
        $(this).parent().children('span').replaceWith('<span>'+value +'</span>'); 
    };                
    $('.select_wrapper select').each(select_value).change(select_value);
  
    // preview  
    $('.upload_img_url').change(function(){
        var url = $(this).val();
        var re = new RegExp("(http|ftp|https)://[a-zA-Z0-9@?^=%&amp;:/~+#-_.]*.(gif|jpg|jpeg|png|ico)");
        
        var preview = $(this).parent().siblings('.upload_img_preview');
        if(re.test(url)) {
        	preview.html('<img src="'+url+'" style="max-width:600px; max-height:300px;" />');
        } else {
        	preview.html('');
        }
    }).change();
  
  
  	//wp editor
	$('.submit [type=submit]').on('click', function(){
		$('.wp-editor-wrap.tmce-active .switch-html').click(function(){
			$(this).addClass('yit_switch_changed');
		}).click();
		
		$('.yit_switch_changed').removeClass('yit_switch_changed').next().click();
    });
    
    //typography
    $('.typography_container').yit_panel_typography();
    
    //number
    $('.number_container .number').each(function(){
    	var min = $(this).data('min') ? $(this).data('min') : null,
    		max = $(this).data('max') ? $(this).data('max') : null
    		value = $(this).val();	
    	
    	$(this).spinner({
        	min: min,
        	max: max,
            defaultValue: value,
            interval: 1
    	});
    });
    
    //on-off
    $('.onoff_container span').on('click', function(){
    	var input = $( this ).prev( 'input' );
        var checked = input.attr( 'checked' );
                    
        if( checked ) {
        	input.attr( 'checked', false ).attr( 'value', 0 ).removeClass('onoffchecked');
        } else {
            input.attr( 'checked', true ).attr( 'value', 1 ).addClass('onoffchecked');
        }
                    
        input.change();
    });
    
    //slider
    $('.slider_container .ui-slider-horizontal').each(function(){
		var val      = $(this).data('val'); 
        var minValue = $(this).data('min'); 
        var maxValue = $(this).data('max');
        var step     = $(this).data('step');
        var labels   = $(this).data('labels');

        $(this).slider({
        	value: val,
            min: minValue,
            max: maxValue,
            range: 'min',
            step: step, 
            
            slide: function( event, ui ) {
                $(this).find('input').val( ui.value );
                $(this).siblings('.feedback').find('strong' ).text( ui.value + labels );
            }
        });
    });
    
    //colorpicker
    $('.rm_colorpicker .colorpicker_container').each(function(){
    	var color = $(this).data('color');
    	var self  = $(this);
    	
		$(this).ColorPicker({
			color: color,
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				self.find('div').css('backgroundColor', '#' + hex);
				self.next('input').attr( 'value', '#' + hex );
			}
		});
    });
    
});
