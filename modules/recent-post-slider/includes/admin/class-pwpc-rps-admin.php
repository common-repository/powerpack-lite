<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Recent Post Slider
 * @since 1.0
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Rps_Admin {

	function __construct() {

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpc_rps_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpc_rps_taxonomy_supports') );
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Recent Post Slider
	 * @since 1.0
	*/
	function pwpc_rps_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_RPS_POST_TYPE;
		$screen_ids[] = PWPCL_RPS_PAGE_SLUG;

		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Recent Post Slider
 	 * @since 1.0
	 */
	function pwpc_rps_taxonomy_supports( $supports ) {
		$supports[PWPCL_RPS_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_rps_admin = new PWPCL_Rps_Admin();