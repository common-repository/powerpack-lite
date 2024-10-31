(function($) {

    /* Before - After Image Slider */
    jQuery(window).load(function() {

        $( '.pwpc-bais-container' ).each(function( index ) {

            var bais_id     = $(this).attr('id');
            var bais_conf    = $.parseJSON( $(this).closest('.pwpc-bais-container-wrap').find('.pwpc-bais-conf').attr('data-conf') );

            $('#'+bais_id).twentytwenty({
                default_offset_pct: bais_conf.offset, 
                orientation: bais_conf.orientation,
                before_label: bais_conf.before_label,
                after_label: bais_conf.after_label,
            });
        });
    });

})(jQuery);

jQuery( document ).ready(function( $ ) {

    /* Extra Info Sidebar Starts */
    $(document).on('click', '#pwpc-eis-toggle', function() {

        var cls_ele     = $(this).closest('.pwpc-eis-wrapper');
        var slider_id   = cls_ele.find('.slick-slider').attr('id');

        cls_ele.toggleClass('pwpc-eis-is-open');

        if( cls_ele.hasClass('pwpc-eis-top-left') || cls_ele.hasClass('pwpc-eis-top-right') ) {
            cls_ele.addClass('open');
        } else {
            cls_ele.removeClass('open');
        }

        $('.pwpc-eis-inner-main-wrap').slideToggle("slow", "linear", function() {
            if(cls_ele.hasClass('pwpc-eis-is-open')) {
                
                var container_height    = cls_ele.find('.pwpc-eis-inner-wrap').outerHeight();
                var win_height          = $(window).height();
                
                if( container_height >= win_height ){
                    cls_ele.addClass('open');
                }

                if( typeof(slider_id) != 'undefined' ) {
                    $('#'+slider_id).slick('setPosition');
                }
            } else {
                cls_ele.removeClass('open');
            }
        });

        if( typeof(slider_id) != 'undefined' ) {
            $('#'+slider_id).slick('setPosition');
        }
    });
    /* Extra Info Sidebar Ends */

});