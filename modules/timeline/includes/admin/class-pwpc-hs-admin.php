<?php
/**
 * Admin Class
 *
 * Handles the admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Hs_Admin {

	function __construct() {

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_hs_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_hs_taxonomy_supports') );
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage History Slider
 	 * @since 1.0
	 */
	function pwpcl_hs_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_HS_POST_TYPE;

		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage History Slider
 	 * @since 1.0
	 */
	function pwpcl_hs_taxonomy_supports( $supports ) {
		$supports[PWPCL_HS_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_hs_admin = new PWPCL_Hs_Admin();