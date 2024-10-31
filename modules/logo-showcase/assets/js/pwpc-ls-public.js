jQuery( document ).ready(function($) {

	/* Logo Slider */
	$( '.pwpc-ls-logo-showcase-slider' ).each(function( index ) {

		var slider_id   = $(this).attr('id');
		var logo_conf 	= $.parseJSON( $(this).closest('.pwpc-ls-logo-slider-wrp').find('.wpls-logo-showacse-slider-conf').attr('data-conf') );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).slick({
				centerPadding 		: 0,
				centerMode			: (logo_conf.center_mode) == "true" ? true : false,
				dots				: (logo_conf.dots) == "true" ? true : false,
				arrows				: (logo_conf.arrows) == "true" ? true : false,
				infinite			: (logo_conf.loop) == "true" ? true : false,
				speed				: parseInt(logo_conf.speed),
				autoplay			: (logo_conf.autoplay) == "true" ? true : false,
				slidesToShow		: parseInt(logo_conf.slides_column),
				slidesToScroll		: parseInt(logo_conf.slides_scroll),
				autoplaySpeed		: parseInt(logo_conf.autoplay_interval),
				rtl             	: (logo_conf.rtl) == "true" ? true : false,
				mobileFirst    		: (PwPcLs.is_mobile == 1) ? true : false,
				pauseOnFocus		: false,
				responsive: [{
					breakpoint: 1023,
					settings: {
						slidesToShow	: (parseInt(logo_conf.slides_column) > 3) ? 3 : parseInt(logo_conf.slides_column),
						slidesToScroll	: 1
					}
				},{
					breakpoint: 640,
					settings: {
						slidesToShow	: (parseInt(logo_conf.slides_column) > 2) ? 2 : parseInt(logo_conf.slides_column),
						slidesToScroll	: 1,
						centerMode 		: false
					}
				},{
					breakpoint: 479,
					settings: {
						slidesToShow	: 1,
						slidesToScroll	: 1,
						centerMode 		: false,
						dots 			: false
					}
				},{
					breakpoint: 319,
					settings: {
						slidesToShow 	: 1,
						slidesToScroll	: 1,
						centerMode 		: false,
						dots 			: false
					}
				}]
			});
		}
	});
});