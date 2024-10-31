<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Smooth Scroll
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_SS_Script {
	
	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_ss_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_ss_front_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */
	function pwpcl_ss_front_style() {

		// Registring and enqueing public css
		wp_register_style( 'pwpc-ss-public-css', PWPCL_SS_URL.'assets/css/pwpc-ss-public.css', null, PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-ss-public-css' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */
	function pwpcl_ss_front_script() {

		global $pwpc_ss_options;

		// Registring mouse wheel script
		if ($pwpc_ss_options['enable_smooth_scroll'] == 1) {
			wp_register_script( 'pwpc-ss-mouse-wheel-scroll-js', PWPCL_SS_URL.'assets/js/mousewheel-smooth-scroll.js', array('jquery'), PWPCL_VERSION, true );
			wp_enqueue_script( 'pwpc-ss-mouse-wheel-scroll-js');
		}

		// Registring public script
		wp_register_script( 'pwpc-ss-public-js', PWPCL_SS_URL.'assets/js/pwpc-ss-public.js', array('jquery'), PWPCL_VERSION, true );
		wp_localize_script( 'pwpc-ss-public-js', 'PwPcSs', array(
															'enable_smooth_scroll' 	=> pwpcl_ss_get_option('enable_smooth_scroll'),
															'scroll_amount' 		=> pwpcl_ss_get_option('scroll_amount'),
															'scroll_speed' 			=> pwpcl_ss_get_option('scroll_speed'),
															'enable_goto_top' 		=> pwpcl_ss_get_option('enable_goto_top'),
															'goto_top_speed' 		=> pwpcl_ss_get_option('goto_top_speed'),
														));
		wp_enqueue_script( 'pwpc-ss-public-js');
	}
}

$pwpcl_ss_script = new PWPCL_SS_Script();