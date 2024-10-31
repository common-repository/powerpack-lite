<?php
/**
 * Ticker Ultimate Module
 * 
 * @package PowerPack Lite
 * @subpackage Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_TU_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_TU_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_TU_POST_TYPE', 'pwpc_ticker' );   // Plugin post type
PWPC_Lite()->define( 'PWPCL_TU_CAT', 'pwpc_ticker_cat' );     // Plugin category name
PWPC_Lite()->define( 'PWPCL_TU_META_PREFIX', '_pwpc_tu_' ); 	// Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 * 
 * @subpackage Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_install() {

    pwpcl_tu_register_post_type();
    pwpcl_tu_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_ticker', 'pwpcl_tu_install' );

// Function File
require_once ( PWPCL_TU_DIR . '/includes/pwpc-tu-functions.php' );

// Plugin Post type file
require_once( PWPCL_TU_DIR . '/includes/pwpc-tu-post-types.php' );

// Script Class File
require_once ( PWPCL_TU_DIR . '/includes/class-pwpc-tu-script.php' );

// Admin Class File
require_once ( PWPCL_TU_DIR . '/includes/admin/class-pwpc-tu-admin.php' );

// Shortcodes
require_once( PWPCL_TU_DIR . '/includes/shortcode/pwpc-ticker.php');

// How it work file
require_once( PWPCL_TU_DIR . '/includes/admin/pwpc-tu-how-it-work.php' );