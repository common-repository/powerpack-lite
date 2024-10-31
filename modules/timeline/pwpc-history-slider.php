<?php
/**
 * History Slider Module
 * 
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_HS_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_HS_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_HS_POST_TYPE', 'pwpc_timeline_slider' ); // Plugin post type
PWPC_Lite()->define( 'PWPCL_HS_CAT', 'pwpc-hs-category' ); // Plugin category name
PWPC_Lite()->define( 'PWPCL_HS_META_PREFIX', '_pwpc_hs_'); // Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 *
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_install() {

    pwpcl_hs_register_post_type();
    pwpcl_hs_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_timeline', 'pwpcl_hs_install' );

// Function File
require_once ( PWPCL_HS_DIR . '/includes/pwpc-hs-functions.php' );

// Post Type File
require_once( PWPCL_HS_DIR . '/includes/pwpc-hs-post-types.php' );

// Script Class File
require_once ( PWPCL_HS_DIR . '/includes/class-pwpc-hs-script.php' );

// Admin Class File
require_once ( PWPCL_HS_DIR . '/includes/admin/class-pwpc-hs-admin.php' );

// Shortcode file
require_once( PWPCL_HS_DIR . '/includes/shortcode/pwpc-hs-slider.php' );

// Load admin side files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {   
    // Designs file
    include_once( PWPCL_HS_DIR . '/includes/admin/pwpc-hs-how-it-work.php' );
}