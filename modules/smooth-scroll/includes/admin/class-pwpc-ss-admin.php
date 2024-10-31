<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Smooth Scroll
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ss_Admin {
	
	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpcl_ss_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'pwpcl_ss_register_settings') );

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_ss_add_screen_id') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */
	function pwpcl_ss_register_menu() {
		add_submenu_page( PWPCL_PAGE_SLUG, __('Smooth Scroll - PwPc', 'powerpack-lite'), __('Smooth Scrolling', 'powerpack-lite'), 'manage_options', 'pwpc-ss-settings', array($this, 'pwpcl_ss_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */
	function pwpcl_ss_settings_page() {
		include_once( PWPCL_SS_DIR . '/includes/admin/settings/pwpc-ss-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */
	function pwpcl_ss_register_settings() {
		register_setting( 'pwpc_ss_plugin_options', 'pwpc_ss_options', array($this, 'pwpcl_ss_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */
	function pwpcl_ss_validate_options( $input ) {

		$input['enable_smooth_scroll'] 		= isset($input['enable_smooth_scroll']) ? 1 : 0;
		$input['scroll_amount']				= isset($input['scroll_amount']) 		? pwpcl_clean_number($input['scroll_amount'], 300) 	: '';
		$input['scroll_speed']				= isset($input['scroll_speed']) 		? pwpcl_clean_number($input['scroll_speed'], 800) 	: '';

		$input['enable_goto_top'] 			= isset($input['enable_goto_top']) 		? 1 : 0;
		$input['goto_top_speed']			= isset($input['goto_top_speed']) 		? pwpcl_clean_number($input['goto_top_speed'], 700) : '';
		
		return $input;
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Smooth Scroll
 	 * @since 1.0
	 */
	function pwpcl_ss_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_SS_PAGE_SLUG;

		return $screen_ids;
	}
}

$pwpcl_ss_admin = new PWPCL_Ss_Admin();