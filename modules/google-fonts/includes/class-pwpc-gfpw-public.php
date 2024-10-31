<?php
/**
 * Public Class
 *
 * Handles the Public side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Google Fonts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Gfpw_Public {

	function __construct() {
		
		// Action to register admin menu
		add_filter( 'body_class', array($this, 'pwpcl_gfpw_add_body_class') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_add_body_class( $classes ) {
		
		$classes[] = 'pwpc-gfpw-fonts';
		
		return $classes;
	}
}

$pwpcl_gfpw_public = new PWPCL_Gfpw_Public();