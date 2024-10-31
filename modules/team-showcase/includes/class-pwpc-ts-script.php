<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ts_Script {
	
	function __construct(){

		// Action to add style on frontend
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_ts_front_end_style') );

		// Action to add script on frontend
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_ts_front_end_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Team Showcase
 	 * @since 1.0
 	 */
	function pwpcl_ts_front_end_style() {

		wp_enqueue_style( 'wpos-font-awesome' );
		wp_enqueue_style( 'wpos-magnific-style' );
		wp_enqueue_style( 'wpos-slick-style' );

		// Registring testimonials style
		wp_register_style( 'pwpc-ts-public-style', PWPCL_TS_URL.'assets/css/pwpc-ts-public.css', null, PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-ts-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Team Showcase
	 * @since 1.0
	 */
	function pwpcl_ts_front_end_script() {
			
		// Registring public script
		wp_register_script( 'pwpc-ts-public-script', PWPCL_TS_URL.'assets/js/pwpc-ts-public.js', array('jquery'), PWPCL_VERSION, true );
	}
}

$pwpcl_ts_script = new PWPCL_Ts_Script();