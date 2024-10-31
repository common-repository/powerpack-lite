<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage FAQ
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_register_post_type() {

	$pwpc_faq_labels = apply_filters( 'pwpc_faq_post_labels', array(
		'name'                => __('FAQs', 'powerpack-lite'),
		'singular_name'       => __('FAQ', 'powerpack-lite'),
		'add_new'             => __('Add FAQ', 'powerpack-lite'),
		'add_new_item'        => __('Add New FAQ', 'powerpack-lite'),
		'edit_item'           => __('Edit FAQ', 'powerpack-lite'),
		'new_item'            => __('New FAQ', 'powerpack-lite'),
		'all_items'           => __('All FAQ', 'powerpack-lite'),
		'view_item'           => __('View FAQ', 'powerpack-lite'),
		'search_items'        => __('Search FAQ', 'powerpack-lite'),
		'not_found'           => __('No FAQ found', 'powerpack-lite'),
		'not_found_in_trash'  => __('No FAQ found in Trash', 'powerpack-lite'),
		'parent_item_colon'   => '',
		'menu_name'           => __('FAQ - PwPc', 'powerpack-lite')
	));

	$pwpc_faq_args = array(
		'labels' 				=> $pwpc_faq_labels,
		'public' 				=> true,
		'publicly_queryable'	=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'query_var' 			=> true,
		'rewrite'             	=> array( 
										'slug' 			=> apply_filters('pwpc_faq_post_slug', 'pwpc-faq'),
										'with_front' 	=> false
									),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true,
		'hierarchical' 			=> false,
		'exclude_from_search' 	=> false,
		'menu_icon'   			=> 'dashicons-info',
		'supports' 				=> apply_filters('pwpc_faq_post_supports', array('title', 'editor', 'thumbnail', 'excerpt'))
	);

	// Register faq post type
	register_post_type( PWPCL_FAQ_POST_TYPE, apply_filters( 'pwpc_faq_registered_post_type_args', $pwpc_faq_args ) );
}

// Action to register plugin post type
add_action('init', 'pwpcl_faq_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_register_taxonomies() {

	$pwpc_faq_cat_labels = apply_filters('pwpc_faq_cat_labels', array(
		'name'              => __( 'Category', 'powerpack-lite' ),
		'singular_name'     => __( 'Category', 'powerpack-lite' ),
		'search_items'      => __( 'Search Category', 'powerpack-lite'  ),
		'all_items'         => __( 'All Category', 'powerpack-lite'  ),
		'parent_item'       => __( 'Parent Category', 'powerpack-lite'  ),
		'parent_item_colon' => __( 'Parent Category', 'powerpack-lite'  ),
		'edit_item'         => __( 'Edit Category', 'powerpack-lite'  ),
		'update_item'       => __( 'Update Category', 'powerpack-lite'  ),
		'add_new_item'      => __( 'Add New Category', 'powerpack-lite'  ),
		'new_item_name'     => __( 'New Category Name', 'powerpack-lite'  ),
		'menu_name'         => __( 'FAQ Category', 'powerpack-lite'  ),
	));

	$pwpc_faq_cat_args = array(
		'hierarchical'      => true,
		'labels'            => $pwpc_faq_cat_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
										'slug' 			=> apply_filters('pwpc_faq_cat_slug', 'faq-cat'),
										'with_front' 	=> false,
										'hierarchical' 	=> true,
									),
	);

    // Register faq category
    register_taxonomy( PWPCL_FAQ_CAT, array( PWPCL_FAQ_POST_TYPE ), apply_filters('pwpc_faq_registered_cat', $pwpc_faq_cat_args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'pwpcl_faq_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[PWPCL_FAQ_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'FAQ updated. <a href="%s">View FAQ</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'FAQ updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'FAQ restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'FAQ published. <a href="%s">View FAQ</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'FAQ saved.', 'powerpack-lite' ),
		8 => sprintf( __( 'FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}

// Filter to update faq post message
add_filter( 'post_updated_messages', 'pwpcl_faq_post_updated_messages' );