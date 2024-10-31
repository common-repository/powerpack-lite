<?php
/**
 * Portfolio and Projects Module
 * 
 * @package PowerPack Lite
 * @subpackage Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_PAP_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_PAP_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_PAP_POST_TYPE', 'pwpc_portfolio' );   // Plugin post type
PWPC_Lite()->define( 'PWPCL_PAP_CAT', 'pwpc_pap_cat' );       	// Plugin category name
PWPC_Lite()->define( 'PWPCL_PAP_TAG', 'pwpc_pap_tag' );       	// Plugin category name
PWPC_Lite()->define( 'PWPCL_PAP_META_PREFIX', '_pwpc_pap_' ); 	// Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_install() {

    pwpcl_pap_register_post_types();
    pwpcl_pap_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_portfolio', 'pwpcl_pap_install' );

// Function File
require_once ( PWPCL_PAP_DIR . '/includes/pwpc-pap-functions.php' );

// Post Type File
require_once( PWPCL_PAP_DIR . '/includes/pwpc-pap-post-types.php' );

// Script Class File
require_once ( PWPCL_PAP_DIR . '/includes/class-pwpc-pap-script.php' );

// Admin Class File
require_once ( PWPCL_PAP_DIR . '/includes/admin/class-pwpc-pap-admin.php' );

// Shortcode file
require_once( PWPCL_PAP_DIR . '/includes/shortcode/pwpc-pap-portfolio.php' );

// How it work file
include_once( PWPCL_PAP_DIR . '/includes/admin/pwpc-pap-how-it-work.php' );