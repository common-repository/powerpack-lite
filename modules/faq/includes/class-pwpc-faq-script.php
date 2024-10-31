<?php
/**
 * Script Class
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage FAQ
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPC_Lite_Faq_Script {

	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'pwpcl_faq_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'pwpcl_faq_front_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage FAQ
 	 * @since 1.0
	 */
	function pwpcl_faq_front_style() {

		// Registring public style
		wp_register_style( 'pwpcl-faq-public-style', PWPCL_FAQ_URL.'assets/css/pwpc-faq-public.css', null, PWPCL_VERSION );
		wp_enqueue_style('pwpcl-faq-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage FAQ
 	 * @since 1.0
	 */
	function pwpcl_faq_front_script() {

		// Registring public script
		wp_register_script( 'pwpcl-faq-public-script', PWPCL_FAQ_URL.'assets/js/pwpc-faq-public.js', array('jquery'), PWPCL_VERSION, true );
	}
}

$pwpc_lite_faq_script = new PWPC_Lite_Faq_Script();