<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Social Link Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Slw_Admin {
	
	function __construct() {

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_slw_add_screen_id') );
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Social Link Widget
 	 * @since 1.0
	 */
	function pwpcl_slw_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = 'widgets';

		return $screen_ids;
	}
}

$pwpcl_slw_admin = new PWPCL_Slw_Admin();