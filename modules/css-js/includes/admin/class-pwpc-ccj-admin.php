<?php
/**
 * Admin Class 
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ccj_Admin {

	function __construct() {

		// Action to register admin menu
		add_action('admin_menu', array($this, 'pwpcl_ccj_register_menu'));

		// Action to register plugin settings
		add_action ('admin_init', array($this, 'pwpcl_ccj_register_settings'));

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_ccj_add_screen_id'));
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_register_menu() {
		add_submenu_page( PWPCL_PAGE_SLUG, __('Custom CSS and JS', 'powerpack-lite').' - PwPc', __('Custom CSS and JS', 'powerpack-lite'), 'manage_options', 'pwpc-ccj-settings', array($this, 'pwpcl_ccj_setting_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_setting_page() {
		include_once( PWPCL_CCJ_DIR . '/includes/admin/settings/pwpc-ccj-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_register_settings() {
		register_setting( 'pwpc_ccj_plugin_options', 'pwpc_ccj_options', array($this, 'pwpcl_ccj_validate_settings') );
	}

	/**
	 * Validate Settings Options 
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_validate_settings( $input ) {

		// validate for css
		$input['global_css'] = isset($input['global_css']) ? sanitize_textarea_field( $input['global_css'] ) : '';		
		
		// validate for Js
		$input['global_js'] = isset($input['global_js']) ? pwpcl_clean_html( $input['global_js'], true ) : '';		

		return $input;
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Custom CSS JS
 	 * @since 1.0
	 */
	function pwpcl_ccj_add_screen_id( $screen_ids ) {

		$screen_ids[] = PWPCL_CCJ_PAGE_SLUG;

		return $screen_ids;
	}
}

$pwpcl_ccj_admin = new PWPCL_Ccj_Admin();