jQuery( document ).ready(function( $ ) {

	// Open Attachment Data Popup
	$(document).on('click', '.pwpc-pap-img-wrp .pwpc-pap-edit-img', function(){

		$('.pwpc-pap-img-data-wrp').show();
		$('.pwpc-pap-popup-overlay').show();
		$('body').addClass('pwpc-no-overflow');
		$('.pwpc-pap-img-loader').show();

		var current_obj 	= $(this);
		var attachment_id 	= current_obj.closest('.pwpc-pap-img-wrp').find('.pwpc-pap-attachment-no').val();

		var data = {
                        action      	: 'pwpcl_pap_get_attachment_edit_form',
                        attachment_id   : attachment_id
                    };
        $.post(ajaxurl,data,function(response) {
			var result = $.parseJSON(response);
			if( result.success == 1 ) {
				$('.pwpc-pap-img-data-wrp  .pwpc-pap-popup-body-wrp').html( result.data );
				$('.pwpc-pap-img-loader').hide();
			}
        });
	});

	// Save Attachment Data
	$(document).on('click', '.pwpc-pap-save-attachment-data', function(){
		var current_obj = $(this);
		current_obj.attr('disabled','disabled');
		current_obj.parent().find('.spinner').css('visibility', 'visible');

		var data = {
                        action      	: 'pwpcl_pap_save_attachment_data',
                        attachment_id   : current_obj.attr('data-id'),
                        form_data		: current_obj.closest('form.pwpc-pap-attachment-form').serialize()
                    };
        $.post(ajaxurl,data,function(response) {
			var result = $.parseJSON(response);
			
			if( result.success == 1 ) {
				current_obj.closest('form').find('.pwpc-pap-success').html(result.msg).fadeIn().delay(3000).fadeOut();
			} else if( result.success == 0 ) {
				current_obj.closest('form').find('.pwpc-pap-error').html(result.msg).fadeIn().delay(3000).fadeOut();
			}
			current_obj.removeAttr('disabled','disabled');
			current_obj.parent().find('.spinner').css('visibility', '');
        });
	});

});