<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get supported post types
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_supported_post_types() {
	$post_arr = array(
						'post'				=> 'post',
						PWPCL_HS_POST_TYPE	=> PWPCL_HS_POST_TYPE,
				);

	return apply_filters('pwpc_hs_supported_post_types', $post_arr );
}

/**
 * Function to get supported post type category
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_supported_post_types_category() {
	$cat_arr = array(
					'post'				=> 'category',
					PWPCL_HS_POST_TYPE	=> PWPCL_HS_CAT,
				);

	return apply_filters('pwpc_hs_supported_post_types_cats', $cat_arr );
}