<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage FAQ
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPC_Lite_Faq_Admin {

	function __construct() {

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_faq_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_faq_taxonomy_supports') );
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage FAQ
 	 * @since 1.0
	 */
	function pwpcl_faq_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_FAQ_POST_TYPE;

		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage FAQ
 	 * @since 1.0
	 */
	function pwpcl_faq_taxonomy_supports( $supports ) {
		$supports[PWPCL_FAQ_CAT] = array(
									'row_data_id' => true
									);
		return $supports;
	}
}

$pwpc_lite_faq_admin = new PWPC_Lite_Faq_Admin();