<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Iscwp_Script {

	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_iscwp_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_iscwp_front_script') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_iscwp_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpcl_iscwp_front_style() {

		wp_enqueue_style( 'wpos-font-awesome' );
		wp_enqueue_style( 'wpos-magnific-style' );
		wp_enqueue_style( 'wpos-slick-style' );
		
		// Registring and enqueing public css
		wp_register_style( 'iscwp-pro-public-css', PWPCL_ISCWP_URL.'assets/css/pwpc-iscwp-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'iscwp-pro-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpcl_iscwp_front_script() {

		// Registring public script 
		wp_register_script( 'pwpc-iscwp-public-js', PWPCL_ISCWP_URL.'assets/js/pwpc-iscwp-public.js', array('jquery'), PWPCL_VERSION, true );		
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpcl_iscwp_admin_script( $hook ) {

		$pages_array = array(PWPCL_ISCWP_PAGE_SLUG);

		if(in_array($hook, $pages_array)) {
			wp_register_script( 'iscwp-admin-script', PWPCL_ISCWP_URL.'assets/js/pwpc-iscwp-admin.js', array('jquery'), PWPCL_VERSION, true );
			wp_enqueue_script('iscwp-admin-script');
		}
	}
}

$pwpcl_iscwp_script = new PWPCL_Iscwp_Script();