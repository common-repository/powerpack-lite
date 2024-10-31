<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get button type
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_button_type() {
	$button_type= array(
						'button'		=> __('Simple Button', 'powerpack-lite'),
						'button_group'	=> __('Group Button', 'powerpack-lite')
					);

	return apply_filters('pwpc_bws_button_type', $button_type );
}

/**
 * Function to get button style type
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_btn_style_type() {
	$button_type= array(
						'square'	=> __('Square', 'powerpack-lite'),
						'radius'	=> __('Radius', 'powerpack-lite'),
						'round'		=> __('Round', 'powerpack-lite')
					);
	return apply_filters('pwpc_bws_btn_style_type', $button_type );
}

/**
 * Function to get button class
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_clr_class() {
	$button_class = array(
						'black' 				=> __('Black', 'powerpack-lite'),
						'white'					=> __('White', 'powerpack-lite'),
						'light-grey'			=> __('Light Grey', 'powerpack-lite'),
						'grey'					=> __('Grey', 'powerpack-lite'),
						'azure'					=> __('Azure', 'powerpack-lite'),
						'moderate-green'		=> __('Moderate Green', 'powerpack-lite'),
						'soft-red'				=> __('Soft Red', 'powerpack-lite'),
						'green'					=> __('Green', 'powerpack-lite'),
						'bright-yellow' 		=> __('Bright Yellow', 'powerpack-lite'),
						'cyan'					=> __('Cyan', 'powerpack-lite'),
						'orange'				=> __('Orange', 'powerpack-lite'),
						'moderate-violet'		=> __('Moderate Violet', 'powerpack-lite'),
						'dark-magenta'			=> __('Dark Magenta', 'powerpack-lite'),
						'dark-grayish-orange'	=> __('Dark Grayish Orange', 'powerpack-lite'),
						'moderate-blue'			=> __('Moderate Blue', 'powerpack-lite'),
						'blue'					=> __('Blue', 'powerpack-lite'),
						'red'					=> __('Red', 'powerpack-lite'),
						'cyan'					=> __('Cyan', 'powerpack-lite'),
						'magenta' 				=> __('Magenta', 'powerpack-lite'),
						'lime'					=> __('Lime', 'powerpack-lite'),
						'pink'					=> __('Pink', 'powerpack-lite'),
						'vivid-yellow'			=> __('Vivid Yellow', 'powerpack-lite'),
						'lime-green' 			=> __('Lime Green', 'powerpack-lite'),
						'yellow'				=> __('Yellow', 'powerpack-lite'),
					);
	return apply_filters('pwpc_bws_clr_class', $button_class );
}

/**
 * Function to get button style
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_btn_style_cls() {
	$button_style = array(
						'plane'		=> __('Plane','powerpack-lite'),
						'hollow'	=> __('Border','powerpack-lite'),
						'shadow'	=> __('Shadow','powerpack-lite'),
					);
	return apply_filters('pwpc_bws_btn_style_cls', $button_style );
}

/**
 * Function to get button size
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_btn_sizes() {
	$button_sizes = array(
						'tiny'		=> __('Small', 'powerpack-lite'),
						'small'		=> __('Medium', 'powerpack-lite'),
						'large'		=> __('Large', 'powerpack-lite'),
						'expand'	=> __('Expand', 'powerpack-lite'),
					);
	
	return apply_filters('pwpc_bws_btn_sizes', $button_sizes );
}

/**
 * Function to get buton post meta
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_btn_post_sett( $post_id = '' ) {

	$prefix = PWPCL_BWS_META_PREFIX; // Metabox prefix

	$grp_btn_data						= array();
	$post_meta['button_name'] 			= get_post_meta( $post_id, $prefix.'button_name', true );
	$post_meta['button_link'] 			= get_post_meta( $post_id, $prefix.'button_link', true );
	$post_meta['button_style_type'] 	= get_post_meta( $post_id, $prefix.'button_type', true );
	$post_meta['button_class'] 			= get_post_meta( $post_id, $prefix.'button_class', true );
	$post_meta['button_style'] 			= get_post_meta( $post_id, $prefix.'button_style', true );
	$post_meta['button_size'] 			= get_post_meta( $post_id, $prefix.'button_size', true );
	$post_meta['button_icon_size'] 		= get_post_meta( $post_id, $prefix.'button_icon_size', true );
	$post_meta['button_link_target'] 	= get_post_meta( $post_id, $prefix.'button_link_target', true );
	$post_meta['extra_cls'] 			= get_post_meta( $post_id, $prefix.'extra_cls', true );
	$post_meta['grp_btn_data'] 			= get_post_meta( $post_id, $prefix.'grp_btn_data', true );
	
	// Remove is data is not set
	if( !empty($post_meta['grp_btn_data']) ) {
		foreach ($post_meta['grp_btn_data'] as $grp_key => $grp_val) {
			if( (isset($grp_val['name']) && trim($grp_val['name']) != '') || (!empty($grp_val['icon_cls']))  ) {
				$grp_btn_data[$grp_key] = $grp_val;
			}
		}
	}

	$post_meta['grp_btn_data'] = $grp_btn_data;

	return $post_meta;
}