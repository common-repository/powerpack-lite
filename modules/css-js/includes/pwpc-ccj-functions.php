<?php
/**
 * Plugin generic functions file 
 *
 * @package PowerPack Lite
 * @subpackage Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Custom CSS JS
 * @since 1.0 
 */
function pwpcl_ccj_default_settings() {

	global $pwpc_ccj_options;

	$pwpc_ccj_options = array(
							'global_css' 		=> '',
							'global_js'			=> '',
						);
	
	$default_options = apply_filters('pwpc_ccj_options_default_values', $pwpc_ccj_options );
	
	// Update default options
	update_option( 'pwpc_ccj_options', $default_options );
	
	// Overwrite global variable when option is update
	$pwpc_ccj_options = pwpcl_get_settings( 'pwpc_ccj_options' );
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Custom CSS JS
 * @since 1.0
 */
function pwpcl_ccj_get_option( $key = '', $default = false ) {
	global $pwpc_ccj_options;
	return pwpcl_get_option( $pwpc_ccj_options, $key, $default, 'custom_cj' );
}