<?php
/**
 * Public Class
 *
 * Handles the Public side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_CCJ_Public {
	
	function __construct() {		
		
		// Action to add css in perticular post
		add_action('wp_head', array($this, 'pwpcl_ccj_add_custom_css'));

		// Action to add js in perticular post
		add_action('wp_footer', array($this, 'pwpcl_ccj_add_custom_js'));
	}

	/**
	 * Function to save custom style in post
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_add_custom_css() {

		$global_css	= pwpcl_ccj_get_option('global_css'); // get global css

		// Printing CSS
		if( !empty($global_css) ) {
			$css  = '<style type="text/css">'."\n";
			$css .= $global_css;
			$css .= "\n" . '</style>' . "\n";
			echo $css;
		}
	}

	/**
	 * Function to save custom style in post
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_add_custom_js() {

		$global_js = pwpcl_ccj_get_option('global_js');

		// Printing CSS
		if( !empty($global_js) ) {
			$js  = '<script type="text/javascript">'."\n";
			$js .= $global_js;
			$js .= "\n" . '</script>' . "\n";
			echo $js;
		}
	}
}

$pwpcl_ccj_public = new PWPCL_CCJ_Public();