<?php
/**
 * Instagram Slider and Carousel Plus Widget Module
 * 
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage Instagram
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_ISCWP_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_ISCWP_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_ISCWP_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-iscwp-settings' );

// Functions file
require_once( PWPCL_ISCWP_DIR . '/includes/pwpc-iscwp-functions.php' );

// Script Class File
require_once( PWPCL_ISCWP_DIR . '/includes/class-pwpc-iscwp-script.php' );

// Admin Class
require_once( PWPCL_ISCWP_DIR . '/includes/admin/class-pwpc-iscwp-admin.php' );

// Public Class
require_once( PWPCL_ISCWP_DIR . '/includes/class-pwpc-iscwp-public.php' );

// Shortcode File
require_once( PWPCL_ISCWP_DIR . '/includes/shortcode/pwpc-iscwp-grid.php' );
require_once( PWPCL_ISCWP_DIR . '/includes/shortcode/pwpc-iscwp-slider.php' );