<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get social links
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_social_scrvices() {

	$services_arr = array(
							'fb_link' 		=> array(
														'name'	=> __('Facebook', 'powerpack-lite'),
														'desc'	=> __('Enter facebook link.', 'powerpack-lite'),
														'icon'	=> 'fa fa-facebook'
													),
							'gp_link' 		=> array(
														'name'	=> __('Google+', 'powerpack-lite'),
														'desc'	=> __('Enter google plus link.', 'powerpack-lite'),
														'icon'	=> 'fa fa-google-plus'
													),
							'li_link' 		=> array(
														'name' 	=> __('Linkedin', 'powerpack-lite'),
														'desc'	=> __('Enter Linkedin link.', 'powerpack-lite'),
														'icon'	=> 'fa fa-linkedin'
													),
							'tw_link' 		=> array(
														'name' => __('Twitter', 'powerpack-lite'),
														'desc'	=> __('Enter Twitter link.', 'powerpack-lite'),
														'icon'	=> 'fa fa-twitter'
													),
							'mail'		=> array(
													'name' 	=> __('Email', 'powerpack-lite'),
													'desc'	=> __('Enter email address.', 'powerpack-lite'),
													'icon'	=> 'fa fa-envelope'
												),
							'web_link'	=> array(
													'name' 	=> __('Website', 'powerpack-lite'),
													'desc'	=> __('Enter website link.', 'powerpack-lite'),
													'icon'	=> 'fa fa-desktop'
												),
						);

	return apply_filters('pwpc_ts_social_scrvices', $services_arr );
}