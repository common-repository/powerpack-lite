jQuery(document).ready(function($) {

	// Add row for group button 
	$(document).on('click', '.pwpc-slw-add-row', function() {
		
		cls_ele 	= $(this).closest('.pwpc-social-table');
		clone_ele	= $(this).closest('.pwpc-slw-social-row').clone();
		
		// Retrieve the highest current key
		var key = highest = -1; 
		cls_ele.find( 'tr.pwpc-slw-social-row' ).each(function() { 
			var current = $(this).data( 'key' );
			
			if( parseInt( current ) > highest ) {
				highest = current;
			}
		});
		key = highest += 1;
		
		clone_ele.attr( 'data-key', key );
		clone_ele.find( 'input' ).val( '' );

		clone_ele.find( 'input, select' ).each(function() {
				var name = $( this ).attr( 'name' );
				var id   = $( this ).attr( 'id' );

				if( name ) {
					name = name.replace(/[0-9]+(?!.*[0-9])/, + key );
					$( this ).attr( 'name', name );
				}

				$(this).attr( 'data-key', key );

				if( typeof id != 'undefined' ) {
					id = id.replace( /(\d+)/, parseInt( key ) );
					$( this ).attr( 'id', id );
				}
			});
		clone_ele.appendTo(cls_ele); // Clone and insert
	});

	// Delete row
	$(document).on('click', '.pwpc-slw-del-row', function() {
		var cls_ele 	= $(this).closest('.pwpc-social-table').find('.pwpc-slw-social-row');
		var num_of_row 	= cls_ele.length;

		if(num_of_row == 1) {
			alert(PWPC_Slw_Admin.sry_msg);
			return false;
		} else {
			$(this).closest('.pwpc-slw-social-row').remove();
		}
	});
});