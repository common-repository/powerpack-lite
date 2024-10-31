jQuery(document).ready(function($){

	/* Initialize magnific on video grid */
	$( '.pwpc-vgp-video-grid-wrp' ).each(function( index ) {
		var pupup_id   = $(this).attr('id');
		var pupup_conf = $.parseJSON( $(this).find('.pwpc-vgp-popup-conf').attr('data-conf') );	

		jQuery('#'+pupup_id+ ' .pwpc-vgp-popup-modal').magnificPopup({		
			type: 'inline',
			mainClass: 'pwpc-mfp-popup pwpc-vgp-mfp-popup pwpc-vgp-mfp-zoom-in',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: (pupup_conf.popup_fix) == "true" ? true : 0,
			callbacks: {
				change: function(item) {
						
						$('.pwpc-vgp-popup-wrp .wpos-iframe-video-opened').each(function( index ) {
							$(this).attr('src', 'about:blank');
							$(this).removeClass('wpos-iframe-video-opened');
						});

						wp_vgp_refresh_html5_video();

						var frame_obj 			= this.content.find('.wpos-iframe-video');
						var frame_orginal_src 	= frame_obj.attr('data_src');

						if( typeof(frame_orginal_src) != 'undefined' ) {
							frame_obj.addClass('wpos-iframe-video-opened');
							frame_obj.attr('src', frame_orginal_src);
						}
					},
				close: function() {
					var frame_obj = this.content.find('.wpos-iframe-video');
					frame_obj.attr('src', 'about:blank');
					frame_obj.removeClass('wpos-iframe-video-opened');

					wp_vgp_refresh_html5_video();
				}
			}
		});
	});
});

// Function to pause HTML5 video
function wp_vgp_refresh_html5_video() {
	jQuery('.pwpc-vgp-popup-wrp .pwpc-vgp-video-frame').each(function( index ) {
		if (!jQuery(this).get(0).paused) {
			jQuery(this).get(0).pause();
		}
	});
}