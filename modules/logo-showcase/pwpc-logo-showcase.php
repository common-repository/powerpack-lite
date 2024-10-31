<?php
/**
 * Logo Showcase Module
 * 
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_LS_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_LS_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_LS_POST_TYPE', 'pwpc_logoshowcase' ); // Plugin post type name
PWPC_Lite()->define( 'PWPCL_LS_CAT', 'pwpc_logo_cat' );           // Plugin post type name
PWPC_Lite()->define( 'PWPCL_LS_META_PREFIX', '_pwpc_ls_' );       // Plugin metabox prefix

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_install() {

	// Register post type function
	pwpcl_ls_register_post_types();
	pwpcl_ls_register_taxonomies();

	// IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}
add_action( 'pwpc_module_activation_hook_logo_showcase', 'pwpcl_ls_install' );

// Post type file
require_once( PWPCL_LS_DIR . '/includes/pwpc-ls-post-types.php' );

// Script Class
require_once( PWPCL_LS_DIR . '/includes/class-pwpc-ls-script.php' );

// Admin Class
require_once( PWPCL_LS_DIR . '/includes/admin/class-pwpc-ls-admin.php' );

// Shortcode File
require_once( PWPCL_LS_DIR . '/includes/shortcode/pwpc-ls-logo-slider.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( PWPCL_LS_DIR . '/includes/admin/pwpc-ls-how-it-work.php' );
}