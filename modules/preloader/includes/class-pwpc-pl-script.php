<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Preloader for Website Pro - WPOS
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Pl_Script {

	function __construct() {

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_pl_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_pl_admin_script') );
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Preloader for Website Pro - WPOS
	 * @since 1.0.0
	 */
	function pwpcl_pl_admin_style( $hook ) {
		
		// Pages array
		$pages_array = array( PWPCL_PL_PAGE_SLUG );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {
			
			// Enqueu built in style for color picker
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Preloader for Website Pro - WPOS
	 * @since 1.0.0
	 */
	function pwpcl_pl_admin_script( $hook ) {
		
		// Pages array
		$pages_array = array( PWPCL_PL_PAGE_SLUG );
		
		if( in_array($hook, $pages_array) ) {
			
			// Enqueu built-in script for color picker
			wp_enqueue_script( 'wp-color-picker' );

			// Registring admin script
			wp_register_script( 'pwpc-pl-admin-script', PWPCL_PL_URL.'assets/js/pwpc-pl-admin.js', array('jquery'), PWPCL_VERSION, true );
			wp_enqueue_script( 'pwpc-pl-admin-script' );
			wp_enqueue_media(); // For media uploader
		}
	}
}

$pwpcl_pl_script = new PWPCL_Pl_Script();