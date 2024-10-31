<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Hs_Script {

	function __construct() {

		// Action to add style on frontend
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_hs_front_end_style') );

		// Action to add script on frontend
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_hs_front_end_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage History Slider
 	 * @since 1.0
 	 */
	function pwpcl_hs_front_end_style() {

		wp_enqueue_style( 'wpos-slick-style' );
		wp_enqueue_style( 'wpos-font-awesome' );
		
		// Registring history/timeline style
		wp_register_style( 'pwpc-hs-public-style', PWPCL_HS_URL.'assets/css/pwpc-hs-public.css', null, PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-hs-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage History Slider
	 * @since 1.0
	 */
	function pwpcl_hs_front_end_script() {

		// Registring public script
		wp_register_script( 'pwpc-hs-public-script', PWPCL_HS_URL.'assets/js/pwpc-hs-public.js', array('jquery'), PWPCL_VERSION, true );
	}
}

$pwpcl_hs_script = new PWPCL_Hs_Script();