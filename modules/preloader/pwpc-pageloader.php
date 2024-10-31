<?php
/**
 * Preloader Module
 * 
 * @package PowerPack Lite
 * @subpackage Preloader
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_PL_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_PL_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_PL_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-pl-settings' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @subpackage Preloader
 * @since 1.0
 */
function pwpcl_pl_install() {

    // Get settings for the plugin
    $pwpc_pl_options = get_option( 'pwpc_pl_options' );
    
    if( empty( $pwpc_pl_options ) ) { // Check plugin version option
        
        // Set default settings
        pwpcl_pl_default_settings();
        
        // Update plugin version to option
        update_option( 'pwpc_pl_plugin_version', '1.0' );
    }
}
add_action( 'pwpc_module_activation_hook_preloader', 'pwpcl_pl_install' );

// Taking some globals
global $pwpc_pl_options;

// Functions file
require_once( PWPCL_PL_DIR . '/includes/pwpc-pl-functions.php' );
$pwpc_pl_options = pwpcl_get_settings('pwpc_pl_options');

// Script file
require_once( PWPCL_PL_DIR . '/includes/class-pwpc-pl-script.php' );

// Admin file
require_once( PWPCL_PL_DIR . '/includes/admin/class-pwpc-pl-admin.php' );

// Public file
require_once( PWPCL_PL_DIR . '/includes/class-pwpc-pl-public.php' );