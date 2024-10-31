jQuery(document).ready(function($){

    // Initialize slick slider
    $( '.pwpc-hs-slider-nav' ).each(function( index ) {

        var slider_nav_id       = $(this).attr('id');
        var pwpc_hs_slider_id    = $(this).attr('data-slider-nav-for');
        var slider_conf         = $.parseJSON( $(this).closest('.pwpc-hs-slider-wrp').find('.pwpc-hs-slider-conf').attr('data-conf') );

        // For Navigation
        if( typeof(pwpc_hs_slider_id) != 'undefined' && pwpc_hs_slider_id != '' ) {
            nav_id = '.'+pwpc_hs_slider_id;
        }

        // For slider
        if( typeof(pwpc_hs_slider_id) != 'undefined' && pwpc_hs_slider_id != '' ) {

            jQuery('.'+pwpc_hs_slider_id).slick({
                dots            : (slider_conf.dots)    == "true"   ? true : false,
                infinite        : true,
                arrows          : false,
                speed           : parseInt(slider_conf.speed),
                autoplay        : (slider_conf.autoplay)    == "true"   ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplayInterval),
                asNavFor        : '#'+slider_nav_id,
                slidesToShow    : 1,
                slidesToScroll  : 1,
                adaptiveHeight  : (slider_conf.adaptiveheight)  == "false"  ? false : true,
                mobileFirst     : (pwpc_mobile   == 1)       ? true : false,
                rtl             : (slider_conf.rtl      == "true")  ? true : false,
            });
        }

        // For Navigation
        if( typeof(slider_nav_id) != 'undefined' ) {
            
            jQuery('#'+slider_nav_id).slick({
                slidesToShow    : parseInt(slider_conf.slidestoshow),
                slidesToScroll  : 1,
                asNavFor        : nav_id,
                arrows          : (slider_conf.arrows)  == "true"   ? true : false,
                dots            : false,
                speed           : parseInt(slider_conf.speed),
                centerMode      : (slider_conf.nav_centermode)  == "false"  ? false : true,
                focusOnSelect   : true,
                centerPadding   : '10px',
                mobileFirst     : (pwpc_mobile   == 1)   ? true : false,
                rtl             : (slider_conf.rtl == "true")   ? true : false,
                responsive      : [
                {
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
                    }
                },{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                    }
                },
                {
                    breakpoint: 319,
                    settings: {
                        slidesToShow: 1,
                    }
                }
                ]
            });
        }
    });
});