<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_register_post_types() {

	$pwpc_vgp_labels =  apply_filters( 'pwpc_vgp_post_labels', array(
		'name'                	=> __('Video Gallery', 'powerpack-lite'),
		'singular_name'       	=> __('Video Gallery', 'powerpack-lite'),
		'add_new'             	=> __('Add New', 'powerpack-lite'),
		'add_new_item'        	=> __('Add New Video', 'powerpack-lite'),
		'edit_item'           	=> __('Edit Video', 'powerpack-lite'),
		'new_item'            	=> __('New Video', 'powerpack-lite'),
		'all_items'           	=> __('All Video', 'powerpack-lite'),
		'view_item'           	=> __('View Video Gallery', 'powerpack-lite'),
		'search_items'        	=> __('Search Video', 'powerpack-lite'),
		'not_found'           	=> __('No Video Gallery found', 'powerpack-lite'),
		'not_found_in_trash'  	=> __('No Video Gallery found in Trash', 'powerpack-lite'),
		'parent_item_colon'   	=> '',
		'featured_image'		=> __('Video Poster Image', 'powerpack-lite'),
		'set_featured_image'	=> __('Set Video Poster Image', 'powerpack-lite'),
		'remove_featured_image'	=> __('Remove Video Poster Image', 'powerpack-lite'),
		'use_featured_image'	=> __('Use as Video Poster Image', 'powerpack-lite'),
		'menu_name'           	=> __('Video Gallery', 'powerpack-lite').' - PwPc',
	));

	$video_gallery_args = array(
		'labels' 				=> $pwpc_vgp_labels,
		'public' 				=> false,
		'publicly_queryable'	=> false,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'query_var' 			=> false,
		'capability_type' 		=> 'post',
		'has_archive' 			=> false,
		'menu_icon'   			=> 'dashicons-format-video',
		'hierarchical' 			=> false,
		'supports' 				=> apply_filters('pwpc_vgp_post_supports', array('title', 'editor', 'thumbnail')),
	);

	// Register Video Gallery post type
	register_post_type( PWPCL_VGP_POST_TYPE, apply_filters( 'pwpc_vgp_post_type_args', $video_gallery_args ) );
}

// Action to register post type
add_action('init', 'pwpcl_vgp_register_post_types');

/**
 * Function to register taxonomy
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_register_taxonomies() {

    $cat_labels = apply_filters('pwpc_vgp_cat_labels', array(
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
    ));

    $cat_args = array(
    	'public'			=> false,
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );

    // Register Video Gallery category
    register_taxonomy( PWPCL_VGP_CAT, array( PWPCL_VGP_POST_TYPE ), apply_filters('pwpc_vgp_cat_args', $cat_args) );
}

// Action to register taxonomy
add_action( 'init', 'pwpcl_vgp_register_taxonomies');

/**
 * Function to update post messages
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_post_updated_messages( $messages ) {
	
	global $post;
	
	$messages[PWPCL_VGP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Video updated.', 'powerpack-lite' ) ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'Video updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Video restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Video published.', 'powerpack-lite' ) ),
		7 => __( 'Video saved.', 'powerpack-lite' ),
		8 => sprintf( __( 'Video submitted.', 'powerpack-lite' ) ),
		9 => sprintf( __( 'Video scheduled for: <strong>%1$s</strong>.', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Video draft updated.', 'powerpack-lite' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'pwpcl_vgp_post_updated_messages' );