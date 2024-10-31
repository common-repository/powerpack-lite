<?php
/**
 * Public Class
 *
 * Handles the Public side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Smooth Scroll
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ss_Public {
	
	function __construct() {

		// Action to add go to top button html
		add_action( 'wp_footer', array($this, 'pwpcl_ss_footer_gotoTop') );
	}

	/**
	 * Function to add script in footer
	 * 
	 * @subpackage Smooth Scroll
	 * @since 1.0
	 */	
	function pwpcl_ss_footer_gotoTop() {
		
		$enable_goto_top = pwpcl_ss_get_option('enable_goto_top');

		if($enable_goto_top == 1) {
			echo '<a href="#" id="pwpc-back-to-top" title="'.__('Back to top', 'powerpack-lite').'">&uarr;</a>';
		}
	}
}

$pwpcl_ss_public = new PWPCL_Ss_Public();