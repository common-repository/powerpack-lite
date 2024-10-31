<?php
/**
 * Footer Mega Grid Columns Module
 * 
 * @package PowerPack Lite
 * @subpackage Footer Mega Grid Columns
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @subpackage Footer Mega Grid Columns
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_FMGC_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_FMGC_URL', plugin_dir_url( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_FMGC_PAGE_SLUG', PWPCL_SCREEN_ID.'_page_pwpc-fmgc-settings' );

// Functions File
require_once( PWPCL_FMGC_DIR . '/includes/pwpc-fmgc-functions.php' );

// Script Class File
require_once( PWPCL_FMGC_DIR . '/includes/class-pwpc-fgmc-scripts.php' );

// Admin Class File
require_once( PWPCL_FMGC_DIR . '/includes/admin/class-pwpc-fmgc-admin.php' );