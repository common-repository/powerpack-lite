<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Google Fonts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Gfpw_Script {
	
	function __construct() {

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_gfpw_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_gfpw_admin_script') );

		// Action to add script at admin side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_gfpw_front_style') );

		// Action to add custom CSS
		add_action( 'wp_head', array($this, 'pwpcl_gfpw_front_custom_style') );
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_admin_style( $hook ) {

		$pages_arr = array( PWPCL_GFPW_PAGE_SLUG );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_arr) ) {
			
			wp_enqueue_style( 'pwpc-select2-style' );			
		}
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_admin_script( $hook ) {

		$pages_arr = array( PWPCL_GFPW_PAGE_SLUG );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_arr) ) {
			
			wp_enqueue_script( 'pwpc-select2-script' );
			
			// Registring admin script
			wp_register_script( 'pwpc-gfpw-admin-script', PWPCL_GFPW_URL.'assets/js/pwpc-gfpw-admin.js', array('jquery'), PWPCL_VERSION, true );
			wp_localize_script( 'pwpc-gfpw-admin-script', 'PwPc_Gfpw_Admin', array(
																	'no_remove_msg' => __('Sorry, You can not delete this', 'powerpack-lite'),
																	'select_opt' 	=> __('-- Select Font --', 'powerpack-lite'),
																	'reset_msg'		=> __('Click OK to reset all options. All settings will be lost!', 'powerpack-lite'),
																	'restrict_mgs'	=> __('Sorry, Only five google fonts are allowed in Free version. Upgrade to Pro for unlimited fonts.', 'powerpack-lite'),
																));
			wp_enqueue_script( 'pwpc-gfpw-admin-script' );
		}
	}

	/**
	 * Enqueue front scripts
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_front_style() {

		$gf_site_fonts = pwpcl_gfpw_get_option( 'gf_font' );

		if( !empty($gf_site_fonts) ) {
			
			$gf_fonts = implode('|', $gf_site_fonts);
			
			if( !empty($gf_fonts) ) {
				$gf_font_url 	= add_query_arg( array('family' => $gf_fonts), 'https://fonts.googleapis.com/css' );

				// Google Fonts URL
				wp_register_style( 'pwpc-gfpw-font-style', $gf_font_url, null, PWPCL_VERSION );
				wp_enqueue_style( 'pwpc-gfpw-font-style' );
			}
		}
	}

	/**
	 * Enqueue front scripts
	 * 
	 * @subpackage Google Fonts
	 * @since 1.0
	 */
	function pwpcl_gfpw_front_custom_style() {

		// Taking some variables
		$site_font_elements	= pwpcl_gfpw_get_option('font_element');

		if( !empty($site_font_elements) ) {

			$css = '<style type="text/css">' . "\n";

			foreach ($site_font_elements as $font_ele => $font_val) {
				if( !empty($font_ele) && !empty($font_val) ) {

					$font_data = pwpcl_gfpw_get_font_data($font_val);

					// For opening element (In some cses we need different)
					switch ($font_ele) {
						case 'body':
							$css_target = "body, body.pwpc-gfpw-fonts{";
							break;

						case 'button':
							$css_target = "button,.pwpc-gfpw-fonts button,input[type='button'],.pwpc-gfpw-fonts input[type='button'],input[type='submit'],.pwpc-gfpw-fonts input[type='submit']{";
							break;

						case 'input':
							$css_target = "input:not([type]), input[type='text'], input[type='date'], input[type='datetime'], input[type='datetime-local'], input[type='month'], input[type='week'], input[type='email'], input[type='number'], input[type='search'], input[type='tel'], input[type='time'], input[type='url'], input[type='color'], textarea{";
							break;
						
						default:
							$css_target = "{$font_ele},.pwpc-gfpw-fonts {$font_ele}{";
							break;
					}
					$css .= apply_filters( 'pwpc_gfpw_font_ele_css_target', $css_target, $font_ele );

					if( !empty($font_data['font_family']) ) {
						$css .= 'font-family:'.$font_data['font_family'].';';
					}
					if( !empty($font_data['font_weight']) ) {
						$css .= 'font-weight:'.$font_data['font_weight'].';';
					}
					$css .= apply_filters( 'pwpc_gfpw_font_ele_css', '', $font_ele );
					$css .= '}';
				}
			}

			$css .= "\n" . '</style>' . "\n";
			echo $css;
		}
	}
}

$pwpcl_gfpw_script = new PWPCL_Gfpw_Script();