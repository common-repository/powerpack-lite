<?php
/**
 * Smooth Scroll Module
 * 
 * @package PowerPack Lite
 * @subpackage Smooth Scroll
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_SS_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_SS_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_SS_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-ss-settings' );

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @subpackage Smooth Scroll
 * @since 1.0
 */
function pwpcl_ss_install() {

	// Get settings for the plugin
	$pwpc_ss_options = get_option( 'pwpc_ss_options' );
	
	if( empty( $pwpc_ss_options ) ) { // Check plugin version option
		
		// Default Settings
		pwpcl_ss_default_settings();

		// Update plugin version to option
		update_option( 'pwpc_ss_plugin_version', '1.0' );
	}
}
add_action( 'pwpc_module_activation_hook_smooth_scroll', 'pwpcl_ss_install' );

global $pwpc_ss_options;

// Script file
require_once( PWPCL_SS_DIR . '/includes/class-pwpc-ss-script.php' );

// Function file
require_once( PWPCL_SS_DIR . '/includes/pwpc-ss-functions.php' );
$pwpc_ss_options = pwpcl_get_settings('pwpc_ss_options');

// Admin Class
require_once( PWPCL_SS_DIR . '/includes/admin/class-pwpc-ss-admin.php' );

// Public Class
require_once( PWPCL_SS_DIR . '/includes/class-pwpc-ss-public.php' );