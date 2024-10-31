<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Footer Mega Grid Columns
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Fmgc_Script {
	
	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_fmgc_front_style') );

		// Action to add style at admin side
		add_action( 'admin_print_styles-widgets.php', array($this, 'pwpcl_fmgc_print_admin_style') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @subpackage Footer Mega Grid Columns
	 * @since 1.0
	 */
	function pwpcl_fmgc_front_style() {
		
		// Registring and enqueing public css
		wp_register_style( 'pwpc-fmgc-public-style', PWPCL_FMGC_URL.'assets/css/pwpc-fmgc-public.css', array(), PWPCL_VERSION );
		wp_enqueue_style( 'pwpc-fmgc-public-style' );
	}

	/**
	 * Print admin style on widget page
	 * 
	 * @subpackage Footer Mega Grid Columns
	 * @since 1.0
	 */
	function pwpcl_fmgc_print_admin_style() {

		$style = '';
		$style .= "<style type='text/css'>";
		$style .= ".pwpc-fmgc-widget-opts-wrp{display: none;} #pwpc-fmgc-widget .pwpc-fmgc-widget-opts-wrp{display:block;}";
		$style .= "</style>\n";

		echo $style;
	}
}

$pwpcl_fmgc_script = new PWPCL_Fmgc_Script();