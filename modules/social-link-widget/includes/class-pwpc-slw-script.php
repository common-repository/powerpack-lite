<?php
/**
 * Handles plugins Script and Style functionality
 *
 * @package PowerPack Lite
 * @subpackage Social Link Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Slw_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_slw_front_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_slw_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Social Link Widget
	 * @since 1.0
	 */
	function pwpcl_slw_front_style() {
		
		wp_enqueue_style( 'wpos-font-awesome' );

		// Registring and enqueing public css
		wp_register_style( 'pwpc-slw-public-style', PWPCL_SLW_URL.'assets/css/pwpc-slw-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-slw-public-style' );
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @subpackage Social Link Widget
	 * @since 1.0
	 */
	function pwpcl_slw_admin_script( $hook ) {

		// Pages array
		$pages_array = array('widgets.php' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'pwpc-slw-admin-script', PWPCL_SLW_URL.'assets/js/pwpc-slw-admin.js', array('jquery'), PWPCL_VERSION, true );
			wp_localize_script( 'pwpc-slw-admin-script', 'PWPC_Slw_Admin', array(
																		'sry_msg' => __('Sorry, One entry should be there.', 'powerpack-lite'),
																	));
			wp_enqueue_script( 'pwpc-slw-admin-script' );
		}
	}
}

$pwpcl_slw_script = new PWPCL_Slw_Script();