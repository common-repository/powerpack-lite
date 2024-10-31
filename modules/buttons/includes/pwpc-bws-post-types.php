<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_register_post_type() {

	$bws_post_lbls = apply_filters( 'pwpc_bws_post_labels', array(
								'name'                 	=> __('Button', 'powerpack-lite'),
								'singular_name'        	=> __('Button', 'powerpack-lite'),
								'add_new'              	=> __('Add Button', 'powerpack-lite'),
								'add_new_item'         	=> __('Add New Button', 'powerpack-lite'),
								'edit_item'            	=> __('Edit Button', 'powerpack-lite'),
								'new_item'             	=> __('New Button', 'powerpack-lite'),
								'view_item'            	=> __('View Button', 'powerpack-lite'),
								'search_items'         	=> __('Search Button', 'powerpack-lite'),
								'all_items'				=> __('All Buttons', 'powerpack-lite'),
								'not_found'            	=> __('No Button found', 'powerpack-lite'),
								'not_found_in_trash'   	=> __('No Button found in trash', 'powerpack-lite'),
								'parent_item_colon'    	=> '',
								'menu_name'            	=> __('Button - PwPc', 'powerpack-lite'),
							));

	$bws_post_args = array(
		'labels'				=> $bws_post_lbls,
		'public'              	=> false,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> false,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-editor-bold',
		'supports'            	=> apply_filters('pwpc_bws_post_supports', array('title')),
	);

	// Register slick slider post type
	register_post_type( PWPCL_BWS_POST_TYPE, apply_filters( 'pwpc_bws_registered_post_type_args', $bws_post_args ) );
}

// Action to register plugin post type
add_action('init', 'pwpcl_bws_register_post_type');

/**
 * Function to update post message for button
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_post_updated_messages( $messages ) {

	global $post;

	$messages[PWPCL_BWS_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Button updated.', 'powerpack-lite' ) ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'Button updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Button restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Button published.', 'powerpack-lite' ) ),
		7 => __( 'Button saved.', 'powerpack-lite' ),
		8 => sprintf( __( 'Button submitted.', 'powerpack-lite' ) ),
		9 => sprintf( __( 'Button scheduled for: <strong>%1$s</strong>.', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Button draft updated.', 'powerpack-lite' ) ),
	);

	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'pwpcl_bws_post_updated_messages' );