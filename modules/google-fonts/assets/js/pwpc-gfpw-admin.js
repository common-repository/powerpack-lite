jQuery( document ).ready(function( $ ) {

	$('.pwpc-gfpw-gf-font').select2();

	// Add another font
	$(document).on('click', '.pwpc-gfpw-add-gf-font', function(){
		
		var cls_ele = $(this).closest('.pwpc-gfpw-gf-font-wrp');

		if( cls_ele.find('.pwpc-gfpw-gf-font-row').length >= 5 ){
			alert( PwPc_Gfpw_Admin.restrict_mgs );
			return false;
		}

		$(this).closest('.pwpc-gfpw-gf-font-row').find('.pwpc-gfpw-gf-font').select2('destroy');

		var cln_ele	= $(this).closest('.pwpc-gfpw-gf-font-row').clone();

		cln_ele.find('.pwpc-gfpw-gf-font').val('');
		cln_ele.find('.pwpc-gfpw-gf-font-family i').text('N/A');
		
		cls_ele.append(cln_ele);
		
		cls_ele.find('.pwpc-gfpw-gf-font').select2();
	});

	// Remove font
	$(document).on('click', '.pwpc-gfpw-remove-gf-font', function(){
		var cls_ele 	= $(this).closest('.pwpc-gfpw-gf-font-row');
		var total_ele 	= $('.pwpc-gfpw-gf-font-wrp .pwpc-gfpw-gf-font-row').length;

		if( total_ele > 1 ) {
			cls_ele.remove();
		} else {
			alert( PwPc_Gfpw_Admin.no_remove_msg );
		}

		pwpcl_gfpw_update_site_gf_font();
	});

	// On Change of fonts
	$(document).on('change', '.pwpc-gfpw-gf-font', function() {
		
		var font_family = $(this).find('option:selected').closest('optgroup').attr('label');
		font_family 	= font_family ? font_family : 'N/A';

		$(this).closest('.pwpc-gfpw-gf-font-row').find('.pwpc-gfpw-gf-font-family i').text(font_family);

		pwpcl_gfpw_update_site_gf_font();
	});
});

function pwpcl_gfpw_update_site_gf_font() {

	var font_opts	= '';
	font_opts 		+= '<option value="">'+PwPc_Gfpw_Admin.select_opt+'</option>';

	// Taking site font
	jQuery('.pwpc-gfpw-gf-font-wrp .pwpc-gfpw-gf-font').each(function(index ) {
		var font_val	= jQuery(this).val();
		var font_name	= jQuery(this).find('option:selected').html();

		if( font_val && (font_opts.indexOf('option value="'+font_val+'"') < 0) ) {
			font_opts += '<option value="'+font_val+'">'+font_name+'</option>';
		}
	});

	// Updating site element font
	jQuery('.pwpc-gfpw-font-ele-row .pwpc-gfpw-site-ele-font').each(function(index) {
		var font_val = jQuery.trim( jQuery(this).val() );

		jQuery(this).html(font_opts); // Updating options

		// Remain selected value as it is
		if( font_val != '' && jQuery(this).find("option[value='"+font_val+"']").length > 0 ) {
			jQuery(this).val(font_val);
		} else {
			jQuery(this).val('');
		}
	});
}