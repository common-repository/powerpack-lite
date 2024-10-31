<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Google Fonts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Gfpw_Admin {

	function __construct() {
		
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpcl_gfpw_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'pwpcl_gfpw_register_settings') );

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_gfpw_add_screen_id') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_register_menu() {
		add_submenu_page( PWPCL_PAGE_SLUG, __('Google Fonts Settings', 'powerpack-lite').' - PwPc', __('Google Fonts', 'powerpack-lite'), 'manage_options', 'pwpc-gfpw-settings', array($this, 'pwpcl_gfpw_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_settings_page() {
		include_once( PWPCL_GFPW_DIR . '/includes/admin/settings/pwpc-gfpw-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_register_settings() {
		register_setting( 'pwpc_gfpw_plugin_options', 'pwpc_gfpw_options', array($this, 'pwpcl_gfpw_validate_options') );
	}
	
	/**
	 * Validate Settings Options
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_validate_options( $input ) {

		$input['gf_font'] 		= isset($input['gf_font']) 		? array_unique(pwpcl_clean($input['gf_font'])) 	: '';
		$input['font_element'] 	= isset($input['font_element']) ? pwpcl_clean( $input['font_element'] ) 		: '';

		return $input;
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Google Fonts
 	 * @since 1.0
	 */
	function pwpcl_gfpw_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_GFPW_PAGE_SLUG;

		return $screen_ids;
	}
}

$pwpcl_gfpw_admin = new PWPCL_Gfpw_Admin();