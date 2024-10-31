jQuery( document ).ready(function( $ ) {

	// On click of spinner design
	$( document ).on( 'click', '.pwpc-pl-spinner-class', function() {

		var cur_obj = $(this);

		$('.pwpc-pl-spinner-class').removeClass('pwpc-pl-active');
		$(cur_obj).addClass('pwpc-pl-active');
	});
});