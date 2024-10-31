<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Tu_Script {

	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_tu_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_tu_front_script') );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Ticker Ultimate
	 * @since 1.0
	 */
	function pwpcl_tu_front_style() {

		// Registring public style
		wp_register_style( 'pwpc-tu-public-style', PWPCL_TU_URL.'assets/css/pwpc-tu-public.css', null, PWPCL_VERSION );
		wp_enqueue_style('pwpc-tu-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Ticker Ultimate
	 * @since 1.0
	 */
	function pwpcl_tu_front_script() {
		
		// Registring public script
		wp_register_script( 'pwpc-tu-public-js', PWPCL_TU_URL . 'assets/js/pwpc-tu-public.js', array('jquery'), PWPCL_VERSION, true );
	}
}

$pwpcl_tu_script = new PWPCL_Tu_Script();