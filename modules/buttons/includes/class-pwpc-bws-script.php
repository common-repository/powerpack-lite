<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Bws_Script {

	function __construct() {

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_bws_front_style') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Buttons with Style
	 * @since 1.0
	 */
	function pwpcl_bws_front_style() {

		wp_enqueue_style( 'wpos-font-awesome' );

		// Registring and enqueing slick slider css
		wp_register_style( 'pwpc-bws-public-style', PWPCL_BWS_URL.'assets/css/pwpc-bws-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-bws-public-style' );
	}
}

$pwpcl_bws_script = new PWPCL_Bws_Script();