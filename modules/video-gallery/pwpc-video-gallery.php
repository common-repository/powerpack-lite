<?php
/**
 * Video Gallery Module
 * 
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_VGP_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_VGP_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_VGP_POST_TYPE', 'pwpc_video' );   // Plugin post type
PWPC_Lite()->define( 'PWPCL_VGP_CAT', 'pwpc_vgp_cat' );       // Plugin category name
PWPC_Lite()->define( 'PWPCL_VGP_META_PREFIX', '_pwpc_vgp_' ); // Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 *
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_install() {

   	pwpcl_vgp_register_post_types();
    pwpcl_vgp_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
    
}
add_action( 'pwpc_module_activation_hook_video_gallery', 'pwpcl_vgp_install' );

// Function File
require_once ( PWPCL_VGP_DIR . '/includes/pwpc-vgp-functions.php' );

// Post Type File
require_once( PWPCL_VGP_DIR . '/includes/pwpc-vgp-post-types.php' );

// Script Class File
require_once ( PWPCL_VGP_DIR . '/includes/class-pwpc-vgp-script.php' );

// Admin Class File
require_once ( PWPCL_VGP_DIR . '/includes/admin/class-pwpc-vgp-admin.php' );

// Shortcode file
require_once( PWPCL_VGP_DIR . '/includes/shortcode/pwpc-vgp-grid.php' );

// Load admin side files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {   
    // Designs file
    include_once( PWPCL_VGP_DIR . '/includes/admin/pwpc-vgp-how-it-work.php' );
}