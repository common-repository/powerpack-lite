<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Pap_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_pap_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_pap_front_script') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_pap_admin_script') );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_front_style() {

		wp_enqueue_style( 'wpos-magnific-style' );
		wp_enqueue_style( 'wpos-slick-style' );
		
		wp_register_style( 'pwpc-pap-public-style', PWPCL_PAP_URL.'assets/css/pwpc-pap-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-pap-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_front_script() {

		// Registring portfolio script
		wp_register_script( 'pwpc-pap-portfolio-js', PWPCL_PAP_URL.'assets/js/pwpc-pap-portfolio.js', array('jquery'), PWPCL_VERSION, true );

		// Registring public script
		wp_register_script( 'pwpc-pap-public-js', PWPCL_PAP_URL.'assets/js/pwpc-pap-public.js', array('jquery'), PWPCL_VERSION, true );
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_admin_script( $hook ) {

		global $post_type;

		$registered_posts = array(PWPCL_PAP_POST_TYPE); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {

			// Enqueue required inbuilt sctipt
			wp_enqueue_script( 'jquery-ui-sortable' );

			// Registring admin script
			wp_register_script( 'pwpc-pap-admin-script', PWPCL_PAP_URL.'assets/js/pwpc-pap-admin.js', array('jquery'), PWPCL_VERSION, true );
			wp_enqueue_script( 'pwpc-pap-admin-script' );
			wp_enqueue_media(); // For media uploader
		}
	}
}

$pwpcl_pap_script = new PWPCL_Pap_Script();