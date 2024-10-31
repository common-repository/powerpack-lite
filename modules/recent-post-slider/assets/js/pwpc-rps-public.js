jQuery(document).ready(function($) {

    /* For Carousel Slider */
    $( '.pwpc-rps-post-carousel' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.pwpc-rps-carousel-slider-wrp').find('.pwpc-rps-slider-conf').attr('data-conf'));

        jQuery('#'+slider_id).slick({
            dots            : (slider_conf.dots) == "true" ? true : false,
            arrows          : (slider_conf.arrows) == "true" ? true : false,
            speed           : parseInt(slider_conf.speed),
            autoplay        : (slider_conf.autoplay) == "true" ? true : false,
            autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
            slidesToShow    : parseInt(slider_conf.slides_to_show),
            slidesToScroll  : parseInt(slider_conf.slides_to_scroll),
            mobileFirst     : (pwpc_mobile == 1) ? true : false,
            rtl             : (slider_conf.rtl) == "true" ? true : false,
            responsive: [{
                breakpoint: 1023,
                settings: {
                    slidesToShow: (parseInt(slider_conf.slides_to_show) > 3) ? 3 : parseInt(slider_conf.slides_to_show),
                    slidesToScroll: 1,
                }
            },{

                breakpoint: 767,                
                settings: {
                    slidesToShow: (parseInt(slider_conf.slides_to_show) > 2) ? 2 : parseInt(slider_conf.slides_to_show),
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 319,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }               
            }]
        });
    });

    /* For Slider */
    $( '.pwpc-rps-post-slider-js' ).each(function( index ) {
        
        var slider_id       = $(this).attr('id');
        var slider_conf     = $.parseJSON( $(this).closest('.pwpc-rps-slider-wrp').find('.pwpc-rps-slider-conf').attr('data-conf'));
        
        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

            jQuery('#'+slider_id).slick({
                dots            : (slider_conf.dots) == "true" ? true : false,
                fade            : (slider_conf.fade) == "true" ? true : false,                
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                speed           : parseInt(slider_conf.speed),
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
                slidesToShow    : 1,
                slidesToScroll  : 1,
                rtl             : (slider_conf.rtl) == "true" ? true : false,                
            });
        }
    });

    /* For older browser compatibility (Image Fallback) */
    if( pwpcl_old_browser == 1 ) {
        $( '.pwpc-rps-image-fit .pwpc-rps-post-slides' ).each(function( index ) {
            var img_obj = $(this).find('.pwpc-rps-post-img');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.pwpc-rps-post-image-bg').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }
});