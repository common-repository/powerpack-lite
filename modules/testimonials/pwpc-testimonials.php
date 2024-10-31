<?php
/**
 * Testimonials Module
 * 
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_TMW_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_TMW_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_TMW_POST_TYPE', 'pwpc_testimonial' ); 	// Plugin post type
PWPC_Lite()->define( 'PWPCL_TMW_CAT', 'pwpc_tmw_cat' ); 			// Plugin category name
PWPC_Lite()->define( 'PWPC_TMW_META_PREFIX', '_pwpc_tmw_' ); 		// Plugin meta prefix

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 *
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_install() {

    pwpcl_tmw_register_post_type();
    pwpcl_tmw_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_testimonials', 'pwpcl_tmw_install' );

global $pwpc_tmw_form_error;

// Function File
require_once ( PWPCL_TMW_DIR . '/includes/pwpc-tmw-functions.php' );

// Post Type File
require_once( PWPCL_TMW_DIR . '/includes/pwpc-tmw-post-types.php' );

// Script Class File
require_once ( PWPCL_TMW_DIR . '/includes/class-pwpc-tmw-script.php' );

// Admin Class File
require_once ( PWPCL_TMW_DIR . '/includes/admin/pwpc-tmw-class-admin.php' );

// Shortcode File
require_once( PWPCL_TMW_DIR . '/includes/shortcode/pwpc-tmw-testimonial-grid.php' );
require_once( PWPCL_TMW_DIR . '/includes/shortcode/pwpc-tmw-testimonial-slider.php' );

// Load admin side files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {   
    // Designs file
    include_once( PWPCL_TMW_DIR . '/includes/admin/pwpc-tmw-how-it-work.php' );
}