<?php
/**
 * Team Showcase Module
 * 
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_TS_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_TS_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_TS_POST_TYPE', 'pwpc_team_showcase' ); 	// Plugin post type
PWPC_Lite()->define( 'PWPCL_TS_CAT', 'pwpc_ts_cat' ); 				// Plugin category name
PWPC_Lite()->define( 'PWPCL_TS_META_PREFIX', '_pwpc_ts_' ); 			// Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_install() {

    pwpcl_ts_register_post_type();
    pwpcl_ts_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_team_showcase', 'pwpcl_ts_install' );

// Function File
require_once ( PWPCL_TS_DIR . '/includes/pwpc-ts-functions.php' );

// Post Type File
require_once( PWPCL_TS_DIR . '/includes/pwpc-ts-post-types.php' );

// Script Class File
require_once ( PWPCL_TS_DIR . '/includes/class-pwpc-ts-script.php' );

// Admin Class File
require_once ( PWPCL_TS_DIR . '/includes/admin/class-pwpc-ts-admin.php' );

// Shortcode file
require_once( PWPCL_TS_DIR . '/includes/shortcode/pwpc-team-grid.php' );
require_once( PWPCL_TS_DIR . '/includes/shortcode/pwpc-ts-team-slider.php' );

// Template Functions
require_once( PWPCL_TS_DIR . '/includes/pwpc-ts-template-functions.php' );

// Load admin side files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {   
    // Designs file
    include_once( PWPCL_TS_DIR . '/includes/admin/pwpc-ts-how-it-work.php' );
}