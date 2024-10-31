<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Recent Post Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Rps_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_rps_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_rps_front_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Recent Post Slider
 	 * @since 1.0
 	 */
	function pwpcl_rps_front_style() {

		wp_enqueue_style( 'wpos-slick-style' );

		// Registring public style
		wp_register_style( 'pwpc-rps-public-style', PWPCL_RPS_URL.'assets/css/pwpc-rps-public.css', null, PWPCL_VERSION );
		wp_enqueue_style('pwpc-rps-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Recent Post Slider
	 * @since 1.0
 	 */
	function pwpcl_rps_front_script() {
		
		// Registring and enqueing public script
		wp_register_script( 'pwpc-rps-public-script', PWPCL_RPS_URL.'assets/js/pwpc-rps-public.js', array('jquery'), PWPCL_VERSION, true );
	}
}

$pwpcl_rps_script = new PWPCL_Rps_Script();