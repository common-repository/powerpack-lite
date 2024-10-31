<?php
/**
 * FAQ Module
 * 
 * @package PowerPack Lite
 * @subpackage FAQ
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage FAQ
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_FAQ_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_FAQ_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_FAQ_POST_TYPE', 'pwpc_faq' );     // Plugin post type
PWPC_Lite()->define( 'PWPCL_FAQ_CAT', 'pwpc_faq_cat' );       // Plugin category name

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup, set default values for the plugin options.
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_install() {

    pwpcl_faq_register_post_type();
    pwpcl_faq_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_faq', 'pwpcl_faq_install' );

// Post Type File
require_once( PWPCL_FAQ_DIR . '/includes/pwpc-faq-post-types.php' );

// Script Class File
require_once ( PWPCL_FAQ_DIR . '/includes/class-pwpc-faq-script.php' );

// Admin Class File
require_once ( PWPCL_FAQ_DIR . '/includes/admin/pwpc-faq-class-admin.php' );

// Shortcode File
require_once( PWPCL_FAQ_DIR . '/includes/shortcode/pwpc-faq.php' );

// Load admin side files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {   
    // Designs file
    include_once( PWPCL_FAQ_DIR . '/includes/admin/pwpc-faq-how-it-work.php' );
}