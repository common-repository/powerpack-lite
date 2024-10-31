<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_register_post_types() {
	
	$ls_post_labels =  apply_filters( 'pwpc_ls_post_labels', array(
									'name'                	=> __('Logo Showcase', 'powerpack-lite'),
									'singular_name'       	=> __('Logo Showcase', 'powerpack-lite'),
									'add_new'             	=> __('Add New', 'powerpack-lite'),
									'add_new_item'        	=> __('Add New Logo Showcase', 'powerpack-lite'),
									'edit_item'           	=> __('Edit Logo Showcase', 'powerpack-lite'),
									'new_item'            	=> __('New Logo Showcase', 'powerpack-lite'),
									'all_items'           	=> __('All Logo Showcase', 'powerpack-lite'),
									'view_item'           	=> __('View Logo Showcase', 'powerpack-lite'),
									'search_items'        	=> __('Search Logo', 'powerpack-lite'),
									'not_found'           	=> __('No Logo Showcase found', 'powerpack-lite'),
									'not_found_in_trash'  	=> __('No Logo Showcase found in Trash', 'powerpack-lite'),
									'parent_item_colon'   	=> '',
									'menu_name'           	=> __('Logo Showcase - PwPc', 'powerpack-lite'),
									'featured_image'		=> __('Logo Image', 'powerpack-lite'),
									'set_featured_image'	=> __('Set Logo Image', 'powerpack-lite'),
									'remove_featured_image'	=> __('Remove logo image', 'powerpack-lite'),
									'use_featured_image'	=> __('Use as logo image', 'powerpack-lite'),
								));

	$ls_post_args = array(
							'labels' 				=> $ls_post_labels,
							'public' 				=> false,
							'menu_icon'   			=> 'dashicons-images-alt2',
							'show_ui' 				=> true,
							'show_in_menu' 			=> true,
							'query_var' 			=> false,
							'capability_type' 		=> 'post',
							'hierarchical' 			=> false,
							'supports' 				=> apply_filters('pwpc_ls_post_supports', array('title', 'thumbnail'))
						);

	// Register Logo Showcase post type
	register_post_type( PWPCL_LS_POST_TYPE, apply_filters( 'PWPCL_LS_POST_TYPE_args', $ls_post_args ) );
}

// Action to register post type
add_action('init', 'pwpcl_ls_register_post_types');

/**
 * Function to register taxonomy
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_register_taxonomies() {
	
    $cat_labels = apply_filters('PWPCL_LS_CAT_labels', array(
        'name'              => __( 'Logo Category', 'powerpack-lite' ),
        'singular_name'     => __( 'Logo Category', 'powerpack-lite' ),
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
    
    // Register Logo Showcase category
    register_taxonomy( PWPCL_LS_CAT, array( PWPCL_LS_POST_TYPE ), $cat_args );
}

// Action to register taxonomy
add_action( 'init', 'pwpcl_ls_register_taxonomies');

/**
 * Function to update post messages
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[PWPCL_LS_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Logo Showcase updated.', 'powerpack-lite' ) ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'Logo Showcase updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Logo Showcase restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Logo Showcase published.', 'powerpack-lite' ) ),
		7 => __( 'Logo Showcase saved.', 'powerpack-lite' ),
		8 => sprintf( __( 'Logo Showcase submitted.', 'powerpack-lite' ) ),
		9 => sprintf( __( 'Logo Showcase scheduled for: <strong>%1$s</strong>.', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Logo Showcase draft updated.', 'powerpack-lite' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'pwpcl_ls_post_updated_messages' );