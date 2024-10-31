<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_register_post_type() {
	
	$pwpc_ts_labels = apply_filters('pwpc_ts_post_labels', array(
		'name'                 	=> __('Team Showcase', 'powerpack-lite'),
		'singular_name'        	=> __('Team Showcase', 'powerpack-lite'),
		'all_items'				=> __('All Team Members', 'powerpack-lite'),
		'add_new'              	=> __('Add New Member', 'powerpack-lite'),
		'add_new_item'         	=> __('Add New Member', 'powerpack-lite'),
		'edit_item'            	=> __('Edit Member', 'powerpack-lite'),
		'new_item'             	=> __('New Member', 'powerpack-lite'),
		'view_item'            	=> __('View Member', 'powerpack-lite'),
		'search_items'         	=> __('Search Members','powerpack-lite'),
		'not_found'            	=> __('No Member found', 'powerpack-lite'),
		'not_found_in_trash'   	=> __('No Members found in Trash', 'powerpack-lite'),
		'menu_name' 			=> __('Team Showcase - PwPc', 'powerpack-lite'),
		'featured_image'		=> __('Team Member Image', 'powerpack-lite'),
		'set_featured_image'	=> __('Set Team Member Image', 'powerpack-lite'),
		'remove_featured_image'	=> __('Remove Team Member Image', 'powerpack-lite'),
		'use_featured_image'	=> __('Use as Team Member Image', 'powerpack-lite'),
	));
	
	$pwpc_ts_args = array(
		'labels'              => $pwpc_ts_labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 
										'slug' 			=> apply_filters('pwpc_ts_post_slug', 'team-showcase'),
										'with_front' 	=> false
									),
		'capability_type'     	=> 'post',
		'has_archive'         	=> false,
		'hierarchical'        	=> false,
		'menu_icon'   			=> 'dashicons-groups',
		'supports'            	=> apply_filters('pwpc_ts_post_supports', array('title', 'editor', 'thumbnail', 'excerpt'))
	);

	// Register team showcase post type
	register_post_type( PWPCL_TS_POST_TYPE, apply_filters('pwpc_ts_registered_post', $pwpc_ts_args) );
}

// Action to register plugin post type
add_action('init', 'pwpcl_ts_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_register_taxonomies() {
	
	$pwpc_ts_cat_lbls = apply_filters('pwpc_ts_cat_labels', array(
								'name'              => __( 'Category', 'powerpack-lite' ),
								'singular_name'     => __( 'Category', 'powerpack-lite' ),
								'search_items'      => __( 'Search Category', 'powerpack-lite' ),
								'all_items'         => __( 'All Categories', 'powerpack-lite' ),
								'parent_item'       => __( 'Parent Category', 'powerpack-lite' ),
								'parent_item_colon' => __( 'Parent Category', 'powerpack-lite' ),
								'edit_item'         => __( 'Edit Category', 'powerpack-lite' ),
								'update_item'       => __( 'Update Category', 'powerpack-lite' ),
								'add_new_item'      => __( 'Add New Category', 'powerpack-lite' ),
								'new_item_name'     => __( 'New Category Name', 'powerpack-lite' ),
								'menu_name'         => __( 'Category', 'powerpack-lite' ),
							));
	
	$pwpc_ts_cat_args = array(
		'hierarchical'      => true,
		'labels'            => $pwpc_ts_cat_lbls,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
										'slug' 			=> apply_filters('pwpc_ts_cat_slug', 'tsas-category'),
										'with_front' 	=> false,
										'hierarchical' 	=> true,
									),
	);
	
	// Register team showcase category
	register_taxonomy( PWPCL_TS_CAT, array( PWPCL_TS_POST_TYPE ), apply_filters('pwpc_ts_registered_cat', $pwpc_ts_cat_args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'pwpcl_ts_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[PWPCL_TS_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Team Member updated. <a href="%s">View Team Member</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'Team Member updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Team Member restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Team Member published. <a href="%s">View Team Member</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'Team Member saved.', 'powerpack-lite' ),
		8 => sprintf( __( 'Team Member submitted. <a target="_blank" href="%s">Preview Team Member</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Team Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team Member</a>', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime($post->post_date) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Team Member draft updated. <a target="_blank" href="%s">Preview Team Member</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}

// Filter to update team showcase post message
add_filter( 'post_updated_messages', 'pwpcl_ts_post_updated_messages' );