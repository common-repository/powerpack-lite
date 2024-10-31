<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Preloader
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Pl_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpcl_pl_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'pwpcl_pl_register_settings') );

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_pl_add_screen_id') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Preloader
	 * @since 1.0
	 */
	function pwpcl_pl_register_menu() {
		add_submenu_page( PWPCL_PAGE_SLUG, __('Preloader Settings', 'powerpack-lite').' - PwPc', __('Preloader', 'powerpack-lite'), 'manage_options', 'pwpc-pl-settings', array($this, 'pwpcl_pl_main_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @subpackage Preloader
	 * @since 1.0
	 */
	function pwpcl_pl_main_page() {
		include_once( PWPCL_PL_DIR . '/includes/admin/settings/pwpc-pl-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @subpackage Preloader
	 * @since 1.0
	 */
	function pwpcl_pl_register_settings() {
		register_setting( 'pwpc_pl_plugin_options', 'pwpc_pl_options', array($this, 'pwpcl_pl_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @subpackage Preloader
	 * @since 1.0
	 */
	function pwpcl_pl_validate_options( $input ) {

		$input['is_preloader']  		= !empty($input['is_preloader']) 		? 1 										: 0;
		$input['plwao_spinner'] 		= isset($input['plwao_spinner']) 		? pwpcl_clean($input['plwao_spinner'])		: 'spinner-1';
		$input['plwao_spinner_size'] 	= !empty($input['plwao_spinner_size']) 	? pwpcl_clean($input['plwao_spinner_size']) : 'medium';

		return $input;
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Preloader
 	 * @since 1.0
	 */
	function pwpcl_pl_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_PL_PAGE_SLUG;

		return $screen_ids;
	}
}

$pwpcl_pl_admin = new PWPCL_Pl_Admin();