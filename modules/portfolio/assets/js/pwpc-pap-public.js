jQuery(document).ready(function($){

	$( '.pwpc-pap-portfolio-inline' ).each(function( index ) {
		var thumb_id 	= $(this).attr('id');
		var thumb_conf 	= $.parseJSON( $(this).find('.pwpc-pap-thumb-conf').attr('data-conf'));

		$('#'+thumb_id).portfolio({
            cols        : parseInt(thumb_conf.main_grid),
            transition  : 'slideDown'
        });
	});

    // Inline method popup open
	$( "ul.pwpc-pap-portfolio-inline li a" ).on( "click", function() {
		var slick_id 		= $(this).closest('.pwpc-pap-main-wrapper').find('.pwpc-pap-content .pwpc-pap-img-slider').attr('id');
		var slider_conf 	= $.parseJSON( $(this).closest('.pwpc-pap-main-wrapper').find('.pwpc-pap-slider-wrapper .pwpc-pap-slider-conf').attr('data-conf') );

		pwpcl_pap_init_slick_slider(slick_id, slider_conf);
	});

    // Old browser compatibility
    if( pwpcl_old_browser == 1 ) {
        $( '.pwpc-pap-image-fit .pwpc-pap-portfolio-wrp' ).each(function( index ) {
            var img_obj     = $(this).find('.pwpc-pap-portfolio-img');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.pwpc-pap-portfolio-bg').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }

});

// Function to intialize slick slider
function pwpcl_pap_init_slick_slider(slick_id, slider_conf) {

    if( typeof(slick_id) !== 'undefined' && slick_id != '' ) {
        if( jQuery('#'+slick_id ).hasClass('slick-initialized') ) {
            jQuery('#'+slick_id).slick('setPosition');
        } else {            
            jQuery('#'+slick_id).slick({        
                dots                : (slider_conf.dots) == 1               ? true : false,
                arrows              : (slider_conf.arrows) == 1             ? true : false,
                speed               : parseInt(slider_conf.speed),
                autoplaySpeed       : parseInt(slider_conf.autoplayspeed),
                rtl                 : (pwpc_is_rtl == 1)                ? true : false,
                mobileFirst         : (pwpc_mobile == 1)                ? true : false,                
                responsive          : [{
                    breakpoint: 1023,
                    settings: {                        
                        slidesToScroll: 1
                    }
                },{
                    breakpoint: 767,
                    settings: {                        
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 479,
                    settings: {                        
                        slidesToScroll: 1,
                        arrows: false
                    }
                },
                {
                    breakpoint: 319,
                    settings: {                        
                        slidesToScroll: 1,
                        arrows: false
                }
                }]
            });
        }
    }
}

// Close inline method popup
function pwpcl_pap_close_popup() {
    jQuery('ul.pwpc-pap-thumbs li .pwpc-pap-active-arrow').remove();
    jQuery('.pwpc-pap-main-wrapper ul.pwpc-pap-thumbs li.pwpc-pap-content').slideUp(300, function(){
        jQuery(this).remove();
    });
}