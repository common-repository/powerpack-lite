<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Vgp_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_vgp_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_vgp_front_script') );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Video Gallery
	 * @since 1.0
	 */
	function pwpcl_vgp_front_style() {

		wp_enqueue_style( 'wpos-magnific-style' );
		wp_enqueue_style( 'wpos-slick-style' );
		
		wp_register_style( 'pwpc-vgp-public-style', PWPCL_VGP_URL.'assets/css/pwpc-vgp-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-vgp-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Video Gallery
	 * @since 1.0
	 */
	function pwpcl_vgp_front_script() {

		// Registring public script
		wp_register_script( 'pwpc-vgp-public-js', PWPCL_VGP_URL.'assets/js/pwpc-vgp-public.js', array('jquery'), PWPCL_VERSION, true );		
	}
}

$pwpcl_vgp_script = new PWPCL_Vgp_Script();