<?php
/**
 * Custom CSS JS Module
 * 
 * @package PowerPack Lite
 * @subpackage Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage Custom CSS JS
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_CCJ_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_CCJ_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_CCJ_META_PREFIX', '_pwpc_ccj_' );                     			// Plugin meta prefix
PWPC_Lite()->define( 'PWPCL_CCJ_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-ccj-settings' ); 	// Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * Does the initial setup, set default values for the plugin options.
 * 
 * @subpackage Custom CSS JS
 * @since 1.0
 */
function pwpcl_ccj_install() {

    // Get settings for the plugin
    $pwpc_ccj_options = get_option( 'pwpc_ccj_options' );
    
    if( empty( $pwpc_ccj_options ) ) { // Check plugin version option
        
        // Default Settings
        pwpcl_ccj_default_settings();

        // Update plugin version to option
        update_option( 'pwpc_ccj_plugin_version', '1.0' );
    }
}
add_action( 'pwpc_module_activation_hook_custom_cj', 'pwpcl_ccj_install' );

global $pwpc_ccj_options;

// Functions file
require_once( PWPCL_CCJ_DIR . '/includes/pwpc-ccj-functions.php' );
$pwpc_ccj_options = pwpcl_get_settings( 'pwpc_ccj_options' );

// Script Class
require_once( PWPCL_CCJ_DIR . '/includes/class-pwpc-ccj-script.php' );

// Admin class
require_once( PWPCL_CCJ_DIR . '/includes/admin/class-pwpc-ccj-admin.php' );

// Public Class
require_once( PWPCL_CCJ_DIR . '/includes/class-pwpc-ccj-public.php' );