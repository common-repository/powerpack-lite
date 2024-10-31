<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ls_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_ls_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_ls_front_script') );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpcl_ls_front_style() {

		wp_enqueue_style( 'wpos-slick-style' );

		// Registring and enqueing public css
		wp_register_style( 'pwpc-ls-public-style', PWPCL_LS_URL.'assets/css/pwpc-ls-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-ls-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpcl_ls_front_script() {

		// Registring public js
		wp_register_script( 'pwpc-ls-public-script', PWPCL_LS_URL.'assets/js/pwpc-ls-public.js', array('jquery'), PWPCL_VERSION, true );
		wp_localize_script( 'pwpc-ls-public-script', 'PwPcLs', array(
															'is_mobile' 		=>	(wp_is_mobile()) ? 1 : 0,
															'is_rtl' 			=>	(is_rtl()) ? 1 : 0,
														));
	}
}

$pwpcl_ls_script = new PWPCL_Ls_Script();