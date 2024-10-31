<?php
/**
 * RecentPostSlider Module
 * 
 * @package PowerPack Lite
 * @subpackage Recent Post Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

PWPC_Lite()->define( 'PWPCL_RPS_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_RPS_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_RPS_POST_TYPE', 'post' ); 			// Plugin post type
PWPC_Lite()->define( 'PWPCL_RPS_CAT', 'category' ); 			// Plugin category name
PWPC_Lite()->define( 'PWPCL_RPS_META_PREFIX', '_pwpc_rps_' ); 	// Plugin meta prefix
PWPC_Lite()->define( 'PWPCL_RPS_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-rps-about' );

// Function File
require_once ( PWPCL_RPS_DIR . '/includes/pwpc-rps-functions.php' );

// Script Class File
require_once ( PWPCL_RPS_DIR . '/includes/class-pwpc-rps-script.php' );

// Admin Class File
require_once ( PWPCL_RPS_DIR . '/includes/admin/class-pwpc-rps-admin.php' );

// Shortcode File
require_once( PWPCL_RPS_DIR . '/includes/shortcode/pwpc-recent-post-slider.php' );
require_once( PWPCL_RPS_DIR . '/includes/shortcode/pwpc-rps-post-carousel.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( PWPCL_RPS_DIR . '/includes/admin/pwpc-rps-how-it-work.php' );
}