<?php
/**
 * Functions File
 *
 * @package PowerPack Lite
 * @subpackage Smooth Scroll
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Smooth Scroll
 * @since 1.0
 */
function pwpcl_ss_default_settings() {

	global $pwpc_ss_options;

	$pwpc_ss_options = array(
								'enable_smooth_scroll'	=> '0',
								'scroll_amount' 		=> '300',
								'scroll_speed'			=> '800',		
								'enable_goto_top'	 	=> '0',			
								'goto_top_speed'		=> '700',
							);

	$default_options = apply_filters('pwpc_ss_options_default_values', $pwpc_ss_options );

	// Update default options
	update_option( 'pwpc_ss_options', $default_options );

	// Overwrite global variable when option is update
	$pwpc_ss_options = pwpcl_get_settings('pwpc_ss_options');
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Smooth Scroll
 * @since 1.0
 */
function pwpcl_ss_get_option( $key = '', $default = false ) {
	global $pwpc_ss_options;
	return pwpcl_get_option( $pwpc_ss_options, $key, $default, 'smooth_scroll' );
}