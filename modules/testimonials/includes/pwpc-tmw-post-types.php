<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_register_post_type () {

	$pwpc_tmw_post_labels = apply_filters( 'pwpc_tmw_testimonials_post_labels', array(
							'name' 					=> __( 'Testimonials', 'powerpack-lite' ),
							'singular_name' 		=> __( 'Testimonial', 'powerpack-lite' ),
							'add_new' 				=> __( 'Add New', 'powerpack-lite' ),
							'add_new_item' 			=> __( 'Add New Testimonial', 'powerpack-lite' ),
							'edit_item' 			=> __( 'Edit Testimonial', 'powerpack-lite' ),
							'new_item' 				=> __( 'New Testimonial', 'powerpack-lite' ),
							'all_items' 			=> __( 'All Testimonials', 'powerpack-lite' ),
							'view_item' 			=> __( 'View Testimonial', 'powerpack-lite' ),
							'search_items' 			=> __( 'Search Testimonials', 'powerpack-lite' ),
							'not_found' 			=> __( 'No Testimonials Found', 'powerpack-lite' ),
							'not_found_in_trash'	=> __( 'No Testimonials Found in Trash', 'powerpack-lite' ),
							'parent_item_colon' 	=> '',
							'featured_image'        => __( 'Testimonial Image', 'powerpack-lite' ),
							'set_featured_image'    => __( 'Set testimonial image', 'powerpack-lite' ),
							'remove_featured_image' => __( 'Remove testimonial image', 'powerpack-lite' ),
							'use_featured_image'    => __( 'Use as testimonial image', 'powerpack-lite' ),
							'insert_into_item'      => __( 'Insert into testimonial', 'powerpack-lite' ),
							'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'powerpack-lite' ),
							'menu_name' 			=> __( 'Testimonials - PwPc', 'powerpack-lite' ),
						));

	$testimonial_args = array(
								'labels' 				=> $pwpc_tmw_post_labels,
								'public' 				=> true,
								'publicly_queryable' 	=> true,
								'show_ui' 				=> true,
								'show_in_menu' 			=> true,
								'query_var' 			=> true,
								'exclude_from_search'	=> false,
								'rewrite' 				=> array( 
																'slug' 			=> apply_filters( 'pwpc_tmw_testimonials_post_slug', 'testimonial' ),
																'with_front' 	=> false
															),
								'capability_type' 		=> 'post',
								'has_archive' 			=> apply_filters( 'pwpc_tmw_testimonials_archive_slug', false ),
								'hierarchical' 			=> false,
								'supports' 				=> apply_filters('pwpc_tmw_post_supports', array('title', 'author' ,'editor', 'thumbnail')),
								'menu_icon' 			=> 'dashicons-format-quote',
							);

	// Register testimonial post type
	register_post_type( PWPCL_TMW_POST_TYPE, apply_filters('pwpc_tmw_testimonials_post_type_args', $testimonial_args) );
}

// Action to register post type
add_action( 'init', 'pwpcl_tmw_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_register_taxonomies() {

	$pwpc_tmw_cat_labels = apply_filters('pwpc_tmw_testimonials_cat_labels', array(
					'name'              => __( 'Category', 'powerpack-lite' ),
					'singular_name'     => __( 'Category', 'powerpack-lite' ),
					'search_items'      => __( 'Search Category', 'powerpack-lite' ),
					'all_items'         => __( 'All Category', 'powerpack-lite' ),
					'parent_item'       => __( 'Parent Category', 'powerpack-lite' ),
					'parent_item_colon' => __( 'Parent Category', 'powerpack-lite' ),
					'edit_item'         => __( 'Edit Category', 'powerpack-lite' ),
					'update_item'       => __( 'Update Category', 'powerpack-lite' ),
					'add_new_item'      => __( 'Add New Category', 'powerpack-lite' ),
					'new_item_name'     => __( 'New Category Name', 'powerpack-lite' ),
					'menu_name'         => __( 'Category', 'powerpack-lite' ),
				));
	
	$pwpc_tmw_cat_args = array(
					'hierarchical'      => true,
					'labels'            => $pwpc_tmw_cat_labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => PWPCL_TMW_CAT ),
				);
	
	// Register testimonial category
	register_taxonomy( PWPCL_TMW_CAT, array( PWPCL_TMW_POST_TYPE ), apply_filters('pwpc_tmw_testimonials_cat_args', $pwpc_tmw_cat_args) );
}

// Action to register taxonomies
add_action( 'init', 'pwpcl_tmw_register_taxonomies');

/**
 * Function to update post message for testimonial post type
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[PWPCL_TMW_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Testimonial updated. <a href="%s">View Testimonial</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'powerpack-lite' ),
		3 => __( 'Custom field deleted.', 'powerpack-lite' ),
		4 => __( 'Testimonial updated.', 'powerpack-lite' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonial restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Testimonial published. <a href="%s">View Testimonial</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'Testimonial saved.', 'powerpack-lite' ),
		8 => sprintf( __( 'Testimonial submitted. <a target="_blank" href="%s">Preview Testimonial</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Testimonial</a>', 'powerpack-lite' ),
		  date_i18n( 'M j, Y @ G:i', strtotime($post->post_date) ), esc_url(get_permalink($post_ID)) ),
		10 => sprintf( __( 'Testimonial draft updated. <a target="_blank" href="%s">Preview Testimonial</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}

// Filter to update testimonial post message
add_filter( 'post_updated_messages', 'pwpcl_tmw_post_updated_messages' );