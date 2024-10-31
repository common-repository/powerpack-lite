<?php
/**
 * Social Link Widget
 * 
 * @package PowerPack Lite
 * @subpackage Social Link Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package Social Link Widget
 * @since 1.0
 */
PWPC_Lite()->define( 'PWPCL_SLW_DIR', dirname( __FILE__ ) );
PWPC_Lite()->define( 'PWPCL_SLW_URL', plugin_dir_url( __FILE__ ) );

// Functions file
require_once( PWPCL_SLW_DIR .'/includes/pwpc-slw-functions.php' );

// Script Class
require_once( PWPCL_SLW_DIR . '/includes/class-pwpc-slw-script.php' );

// Admin Class
require_once( PWPCL_SLW_DIR . '/includes/admin/class-pwpc-slw-admin.php' );

// Widget Class
require_once( PWPCL_SLW_DIR . '/includes/widgets/pwpc-social-link-widget.php' );