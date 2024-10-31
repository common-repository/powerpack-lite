<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_register_post_type() {

  	// 'Ticker' post type
	$pwpc_tu_ticker_labels = array(
		'name'                 => __('Ticker', 'powerpack-lite'),
		'singular_name'        => __('Ticker', 'powerpack-lite'),
		'all_items'             => __('All Ticker', 'powerpack-lite'),
		'add_new'              => __('Add Ticker', 'powerpack-lite'),
		'add_new_item'         => __('Add New Ticker', 'powerpack-lite'),
		'edit_item'            => __('Edit Ticker', 'powerpack-lite'),
		'new_item'             => __('New Ticker', 'powerpack-lite'),
		'view_item'            => __('View Ticker', 'powerpack-lite'),
		'search_items'         => __('Search Ticker', 'powerpack-lite'),
		'not_found'            => __('No Tickers found', 'powerpack-lite'),
		'not_found_in_trash'   => __('No Tickers found in Trash', 'powerpack-lite'),
		'parent_item_colon'    => '',
		'menu_name'            => __('Ticker', 'powerpack-lite').' - PwPc',
	);

	$pwpc_tu_ticker_args = array(
		'labels'              	=> $pwpc_tu_ticker_labels,
		'public'              	=> false,
		'show_ui'             	=> true,
		'show_in_menu'        	=> true, 
		'query_var'           	=> true,
		'rewrite'             	=> false,
		'capability_type'   	=> 'post',
		'hierarchical'      	=> false,
		'menu_icon'         	=> 'dashicons-editor-insertmore',
		'supports'          	=> apply_filters('pwpc_tu_post_supports', array('title')),
	);

	// Register wp_ticker post type
    register_post_type( PWPCL_TU_POST_TYPE, apply_filters('pwpc_tu_register_post_type_ticker', $pwpc_tu_ticker_args) );
}

// Action to register plugin post type
add_action('init', 'pwpcl_tu_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_register_taxonomies() {

    $cat_labels = array(
        'name'              => __( 'Category', 'powerpack-lite' ),
        'singular_name'     => __( 'Category', 'powerpack-lite' ),
        'search_items'      => __( 'Search Category', 'powerpack-lite' ),
        'all_items'         => __( 'All Category', 'powerpack-lite' ),
        'parent_item'       => __( 'Parent Category', 'powerpack-lite' ),
        'parent_item_colon' => __( 'Parent Category:', 'powerpack-lite' ),
        'edit_item'         => __( 'Edit Category', 'powerpack-lite' ),
        'update_item'       => __( 'Update Category', 'powerpack-lite' ),
        'add_new_item'      => __( 'Add New Category', 'powerpack-lite' ),
        'new_item_name'     => __( 'New Category Name', 'powerpack-lite' ),
        'menu_name'         => __( 'Category', 'powerpack-lite' ),
    );

    $cat_args = array(
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'public'			=> false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );

    // Register 'ticker-category' taxonomies
    register_taxonomy( PWPCL_TU_CAT, array( PWPCL_TU_POST_TYPE ), apply_filters('pwpc_tu_register_category_ticker', $cat_args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'pwpcl_tu_register_taxonomies');

/**
 * Function to update post message for ticker post type
 * 
 * @package Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[PWPCL_TU_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Ticker updated.', 'powerpack-lite' ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'Ticker updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Ticker restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => __( 'Ticker published.', 'powerpack-lite' ),
		7 => __( 'Ticker saved.', 'powerpack-lite' ),
		8 => __( 'Ticker submitted.', 'powerpack-lite' ),
		9 => sprintf( __( 'Ticker scheduled for: <strong>%1$s</strong>.', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => __( 'Ticker draft updated.', 'powerpack-lite' ),
	);
	
	return $messages;
}

// Filter to update ticker post message
add_filter( 'post_updated_messages', 'pwpcl_tu_post_updated_messages' );