<?php
/**
 * Google Fonts Module
 * 
 * @package PowerPack Lite
 * @subpackage Google Fonts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage Google Fonts
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_GFPW_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_GFPW_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_GFPW_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-gfpw-settings' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 *
 * @subpackage Google Fonts
 * @since 1.0
 */
function pwpcl_gfpw_install() {

    // Get settings for the plugin
    $pwpc_gfpw_options = get_option( 'pwpc_gfpw_options' );
    
    if( empty( $pwpc_gfpw_options ) ) { // Check plugin version option
        
        // Set default settings
        pwpcl_gfpw_default_settings();
        
        // Update plugin version to option
        update_option( 'pwpc_gfpw_plugin_version', '1.0' );
    }
}
add_action( 'pwpc_module_activation_hook_google_fonts', 'pwpcl_gfpw_install' );

// Taking some globals
global $pwpc_gfpw_options;

// Functions file
require_once( PWPCL_GFPW_DIR . '/includes/pwpc-gfpw-functions.php' );
$pwpc_gfpw_options = pwpcl_get_settings('pwpc_gfpw_options');

// Google fonts file
require_once( PWPCL_GFPW_DIR . '/includes/pwpc-gfpw-google-fonts.php' );

// Script Class
require_once( PWPCL_GFPW_DIR . '/includes/class-pwpc-gfpw-script.php' );

// Admin Class
require_once( PWPCL_GFPW_DIR . '/includes/admin/class-pwpc-gfpw-admin.php' );

// Public Class
require_once( PWPCL_GFPW_DIR . '/includes/class-pwpc-gfpw-public.php' );