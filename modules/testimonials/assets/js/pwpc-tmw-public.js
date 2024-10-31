jQuery( document ).ready(function($) {
	
	/* Testimonial Slider*/
	$( '.pwpc-tmw-testimonials-slidelist' ).each(function( index ) {

		var slider_id   		= $(this).attr('id');
		var testimonial_conf 	= $.parseJSON( $(this).closest('.pwpc-tmw-slider-wrp').find('.pwpc-tmw-slider-conf').attr('data-conf') );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			
			jQuery('#'+slider_id).slick({
				dots			: (testimonial_conf.dots) == "true" ? true : false,
				arrows			: (testimonial_conf.arrows) == "true" ? true : false,
				speed 			: parseInt(testimonial_conf.speed),
				autoplay 		: (testimonial_conf.autoplay) == "true" ? true : false,						
				autoplaySpeed 	: parseInt(testimonial_conf.autoplay_interval),
				slidesToShow 	: parseInt(testimonial_conf.slides_column),
				slidesToScroll 	: parseInt(testimonial_conf.slides_scroll),
				fade 			: (testimonial_conf.effect) == "true" ? true : false,
				adaptiveHeight	: (testimonial_conf.adaptive_height) == "true" ? true : false,
				mobileFirst    	: (pwpc_mobile == 1) ? true : false,
				rtl             : (testimonial_conf.rtl) == "true" ? true : false,
				responsive 		: [
				{
					breakpoint: 1023,
					settings: {
						slidesToShow: (parseInt(testimonial_conf.slides_column) > 3) ? 3 : parseInt(testimonial_conf.slides_column),
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: (parseInt(testimonial_conf.slides_column) > 2) ? 2 : parseInt(testimonial_conf.slides_column),
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 479,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 319,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				}]
			});
		}
	});
});