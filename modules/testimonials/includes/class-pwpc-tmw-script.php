<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Tmw_Script {

	function __construct(){

		// Action to add style on frontend
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_tmw_front_end_style') );

		// Action to add script on frontend
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_tmw_front_end_script') ); 
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Testimonials
 	 * @since 1.0
 	 */
	function pwpcl_tmw_front_end_style() {

		wp_enqueue_style( 'wpos-font-awesome' );
		wp_enqueue_style( 'wpos-slick-style' );

		// Registring testimonials style
		wp_register_style( 'pwpc-tmw-public-style', PWPCL_TMW_URL.'assets/css/pwpc-tmw-public.css', null, PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-tmw-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Testimonials
	 * @since 1.0
	 */
	function pwpcl_tmw_front_end_script() {
			
		// Registring public script
		wp_register_script( 'pwpc-tmw-public-script', PWPCL_TMW_URL.'assets/js/pwpc-tmw-public.js', array('jquery'), PWPCL_VERSION, true );
	}
}

$pwpcl_tmw_script = new PWPCL_Tmw_Script();