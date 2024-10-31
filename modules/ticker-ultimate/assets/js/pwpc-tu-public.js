jQuery( document ).ready(function($) {

    /* Initialize ticker */
    $( '.pwpc-ticker-main' ).each(function( index ) {
        
        var ticker_id   = $(this).attr('id');
        var ticker_conf = $.parseJSON( $(this).closest('.pwpc-ticker').find('.pwpc-ticker-conf').attr('data-conf') );
        
        if( typeof(ticker_id) != 'undefined' && ticker_id != '' && ticker_conf != 'undefined' ) {
            $('#'+ticker_id).wposTicker({
               	effect      : ticker_conf.effect,
                autoplay    : true,
                timer       : parseInt(ticker_conf.timer),
                border      : (ticker_conf.border == 'false') ? false : true,
                fontstyle   : ticker_conf.fontstyle,
            });
        }
    });
});