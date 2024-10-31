jQuery( document ).ready(function($) {

    /* Initialize slick slider */
    $( '.pwpc-ts-team-slider' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.pwpc-ts-team-slider-wrp').find('.pwpc-ts-slider-conf').attr('data-conf') );

        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

            jQuery('#'+slider_id).slick({
                dots            : (slider_conf.dots) == "true" ? true : false,
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                speed           : parseInt(slider_conf.speed),
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
                slidesToShow    : parseInt(slider_conf.slides_column),
                slidesToScroll  : parseInt(slider_conf.slides_scroll),
                pauseOnFocus    : false,
                prevArrow       : '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="fa fa-angle-left"></i></button>',
                nextArrow       : '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="fa fa-angle-right"></i></button>',
                rtl             : (slider_conf.rtl) == "true" ? true : false,
                mobileFirst     : (pwpc_mobile == 1) ? true : false,
                responsive      : [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slides_column) > 3) ? 3 : parseInt(slider_conf.slides_column),
                        slidesToScroll: 1
                    }
                },{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slides_column) > 2) ? 2 : parseInt(slider_conf.slides_column),
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

    /* Popup Gallery */
    $( '.pwpc-ts-popup' ).each(function( index ) {

        var wp_tsasp_id = $(this).attr('id');

        if( typeof(wp_tsasp_id) != 'undefined' && wp_tsasp_id != '' ) {
            $('#'+wp_tsasp_id).magnificPopup({
                delegate    : 'a.pwpc-ts-popup-link',
                type        : 'inline',
                mainClass   : 'pwpc-mfp-popup pwpc-ts-mfp-popup',
            });
        }
    });

    /* For older browser compatibility (Image Fallback) */
    if( pwpcl_old_browser == 1 ) {
        $( '.pwpc-ts-image-fit .pwpc-ts-team-grid, .pwpc-ts-image-fit .pwpc-team-slide, .pwpc-ts-image-fit.pwpc-ts-popup-box .pwpc-ts-popup-header' ).each(function( index ) {
            var img_obj = $(this).find('.pwpc-ts-team-avatar');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.pwpc-ts-team-avatar-bg').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }
});