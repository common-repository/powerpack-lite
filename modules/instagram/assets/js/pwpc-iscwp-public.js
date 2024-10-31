jQuery(document).ready(function($) {

	// For Slider
	$( '.pwpc-iscwp-gallery-slider' ).each(function( index ) {

		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.pwpc-iscwp-insta-slider-wrp').find('.pwpc-iscwp-gallery-slider-conf').attr('data-conf') );

		jQuery('#'+slider_id).slick({
			dots			: (slider_conf.dots) == "true" ? true : false,
			infinite		: (slider_conf.loop) == "true" ? true : false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "true" ? true : false,
			autoplaySpeed	: parseInt(slider_conf.autoplay_interval),
			slidesToShow	: parseInt(slider_conf.slidestoshow),
			slidesToScroll	: parseInt(slider_conf.slidestoscroll),
			centerPadding 	: 0,
			pauseOnFocus	: false,
			rtl             : (pwpc_is_rtl == 1) ? true : false,
			responsive 		: [{
				breakpoint 	: 1023,
				settings 	: {
					slidesToShow 	: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
					slidesToScroll 	: 1,
					dots 			: (slider_conf.dots) == "true" ? true : false,
				}
			},{
				breakpoint	: 767,
				settings	: {
					slidesToShow 	: (parseInt(slider_conf.slidestoshow) > 2) ? 2 : parseInt(slider_conf.slidestoshow),
					dots 			: (slider_conf.dots) == "true" ? true : false,
					slidesToScroll 	: 1,
				}
			},
			{
				breakpoint	: 479,
				settings	: {
					slidesToShow 	: 1,
					slidesToScroll 	: 1,
					dots 			: false,
				}
			},
			{
				breakpoint	: 319,
				settings	: {
					slidesToShow 	: 1,
					slidesToScroll 	: 1,
					dots 			: false,
				}
			}]
		});
	});

	// Popup Gallery
	$( '.pwpc-iscwp-popup-gallery' ).each(function( index ) {
		
		var gallery_id	= $(this).attr('id');
		
		if( typeof(gallery_id) !== 'undefined' && gallery_id != '' ) {

			var user 		= $(this).attr('data-user');
			var popup_conf 	= $.parseJSON($(this).closest('.pwpc-iscwp-main-wrp').find('.pwpc-iscwp-popup-conf').attr('data-conf'));

			$('#'+gallery_id).magnificPopup({
				delegate: 'a.pwpc-iscwp-img-link',
				type: 'inline',
				mainClass: 'pwpc-mfp-popup pwpc-mfp-zoom-in pwpc-iscwp-mfp-popup',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: true,
				removalDelay: 160,
				gallery: {
					enabled : (popup_conf.popup_gallery) == "true" ? true : false,
				},
				callbacks: {
					change: function() {

						var popup_obj 		= this.content;
						var media_shortcode = popup_obj.attr('data-shortcode');

						if( media_shortcode ) {
							
							popup_obj.find('.pwpc-loader').fadeIn();
							popup_obj.find('.pwpc-iscwp-error').remove();

							// Creating object
							var shortcode_obj = {};

							// Creating object
							$.each(popup_conf, function (key,val) {
								shortcode_obj[key] = val;
							});

							var data = {
					            action  		: 'pwpcl_iscwp_get_media_data',
					            shortcode   	: media_shortcode,
					            user 			: user,
					            shrt_param 		: shortcode_obj
					        };

					        $.post(pwpc_ajaxurl, data, function(response) {
					        	var result = jQuery.parseJSON(response);

					        	if(result.success == 1) {
					        		popup_obj.find('.pwpc-loader').hide();
					        		popup_obj.find('.pwpc-iscwp-popup-body').html(result.data);
					        		popup_obj.removeAttr('data-shortcode');
					        	} else {
					        		popup_obj.find('.pwpc-loader').hide();
					        		popup_obj.find('.pwpc-iscwp-popup-body').html('<div class="pwpc-error pwpc-iscwp-error">'+result.msg+'</div>');
					        	}
					        });
					    }
					}
				}
			});
		}
	});

	// Old Browser detection
	if( pwpcl_old_browser == 1 ) {
        $( '.pwpc-iscwp-image-fit .pwpc-iscwp-cnt-wrp' ).each(function( index ) {
            var img_obj     = $(this).find('.pwpc-iscwp-img');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.pwpc-iscwp-img-wrp').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }
});