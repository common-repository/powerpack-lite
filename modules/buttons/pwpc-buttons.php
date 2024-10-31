<?php
/**
 * Buttons with Style
 * 
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_BWS_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_BWS_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_BWS_POST_TYPE', 'pwpc_bws' );     // Plugin post type
PWPC_Lite()->define( 'PWPCL_BWS_META_PREFIX', '_pwpc_bws_' ); // Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_install() {

    // Register post type function
    pwpcl_bws_register_post_type();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Update plugin version to option
    update_option( 'pwpc_bws_plugin_version', '1.0' );
}
add_action( 'pwpc_module_activation_hook_btn', 'pwpcl_bws_install' );

// Funcions File
require_once( PWPCL_BWS_DIR .'/includes/pwpc-bws-functions.php' );

// Post Type File
require_once( PWPCL_BWS_DIR . '/includes/pwpc-bws-post-types.php' );

// Script Class File
require_once( PWPCL_BWS_DIR . '/includes/class-pwpc-bws-script.php' );

// Admin Class File
require_once( PWPCL_BWS_DIR . '/includes/admin/class-pwpc-bws-admin.php' );

// Shortcode file
require_once( PWPCL_BWS_DIR . '/includes/shortcode/pwpc-bws-btn.php' );

// How it work file
require_once( PWPCL_BWS_DIR . '/includes/admin/pwpc-bws-how-it-work.php' );