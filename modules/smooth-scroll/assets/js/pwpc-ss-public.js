jQuery(document).ready(function($){

	/* Smooth Scrolling */
	if(PwPcSs.enable_smooth_scroll == '1'){
		var scroll_amount 	=  parseInt(PwPcSs.scroll_amount);
		var scroll_speed 	=  parseInt(PwPcSs.scroll_speed);
		$.scrollSpeed(scroll_amount, scroll_speed);
	}

	if(PwPcSs.enable_goto_top == '1') {
		var goto_top_speed =  parseInt(PwPcSs.goto_top_speed);
		if ($('#pwpc-back-to-top').length > 0) {
			var scrollTrigger = 400,
				backToTop = function () {
					var scrollTop = $(window).scrollTop();
					if (scrollTop > scrollTrigger) {
						$('#pwpc-back-to-top').addClass('pwpc-ss-show');
					} else {
						$('#pwpc-back-to-top').removeClass('pwpc-ss-show');
					}
				};
				backToTop();

				$(window).on('scroll', function () {
					backToTop();
				});

				$('#pwpc-back-to-top').on('click', function (e) {
					e.preventDefault();
					$('html,body').animate({
						scrollTop: 0
					}, goto_top_speed);
				});
		}
	}
});