<?php

/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_register_post_type() {
    
    $pwpc_hs_labels = array(
        'name'                 => __('Timeline Slider', 'powerpack-lite'),
        'singular_name'        => __('Timeline Slider', 'powerpack-lite'),
        'all_items'            => __('All Timeline', 'powerpack-lite'),
        'add_new'              => __('Add Timeline', 'powerpack-lite'),
        'add_new_item'         => __('Add New Timeline', 'powerpack-lite'),
        'edit_item'            => __('Edit Timeline', 'powerpack-lite'),
        'new_item'             => __('New Timeline', 'powerpack-lite'),
        'view_item'            => __('View Timeline', 'powerpack-lite'),
        'search_items'         => __('Search Timeline', 'powerpack-lite'),
        'not_found'            =>  __('No Items found', 'powerpack-lite'),
        'not_found_in_trash'   => __('No Items found in Trash', 'powerpack-lite'), 
        'parent_item_colon'    => '',
        'featured_image'        => __( 'Timeline Cover Image', 'powerpack-lite' ),
        'set_featured_image'    => __( 'Set Timeline Cover Image', 'powerpack-lite' ),
        'remove_featured_image' => __( 'Remove Timeline Cover Image', 'powerpack-lite' ),
        'use_featured_image'    => __( 'Use as Timeline Cover Image', 'powerpack-lite' ),
        'insert_into_item'      => __( 'Insert into Timeline', 'powerpack-lite' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Timeline', 'powerpack-lite' ),
    	'menu_name'            => __( 'Timeline - PwPc', 'powerpack-lite' )
    );

    $pwpc_hs_args = array(
        'labels'              => $pwpc_hs_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'show_in_menu'        => true, 
        'query_var'           => true,
        'rewrite'             => array( 
        							'slug'       => apply_filters('pwpc_hs_post_slug', 'timeline-history'),
        							'with_front' => false
    							),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
    	'menu_icon'           => 'dashicons-editor-ul',
        'supports'            => apply_filters('pwpc_hs_post_supports', array('title', 'editor', 'thumbnail')),
    );

    // Register post type
    register_post_type( PWPCL_HS_POST_TYPE, apply_filters('pwpc_hs_register_post_type', $pwpc_hs_args) );
}

// Action to register plugin post type
add_action('init', 'pwpcl_hs_register_post_type');

/**
 * Function to register plugin category
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_register_taxonomies() {

    $labels = array(
        'name'              => __( 'Category', 'powerpack-lite' ),
        'singular_name'     => __( 'Category', 'powerpack-lite' ),
        'search_items'      => __( 'Search Category', 'powerpack-lite' ),
        'all_items'         => __( 'All Category', 'powerpack-lite' ),
        'parent_item'       => __( 'Parent Category', 'powerpack-lite' ),
        'parent_item_colon' => __( 'Parent Category' , 'powerpack-lite' ),
        'edit_item'         => __( 'Edit Category', 'powerpack-lite' ),
        'update_item'       => __( 'Update Category', 'powerpack-lite' ),
        'add_new_item'      => __( 'Add New Category', 'powerpack-lite' ),
        'new_item_name'     => __( 'New Category Name', 'powerpack-lite' ),
        'menu_name'         => __( 'Category', 'powerpack-lite' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => apply_filters('pwpc_hs_cat_slug', 'timeline-cat') ),
    );

    // Register taxonomy
    register_taxonomy( PWPCL_HS_CAT, array( PWPCL_HS_POST_TYPE), apply_filters('pwpc_hs_register_cat', $args) );
}

// Action to register plugin post taxonomy
add_action( 'init', 'pwpcl_hs_register_taxonomies');

/**
 * Function to update post message for timeline post type
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_post_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages[PWPCL_HS_POST_TYPE] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __( 'Timeline updated. <a href="%s">View Timeline</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
        2 => __( 'Custom field updated.', 'powerpack-lite' ),
        3 => __( 'Custom field deleted.', 'powerpack-lite' ),
        4 => __( 'Timeline updated.', 'powerpack-lite' ),
        5 => isset( $_GET['revision'] ) ? sprintf( __( 'Timeline restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __( 'Timeline published. <a href="%s">View Timeline</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
        7 => __( 'Timeline saved.', 'powerpack-lite' ),
        8 => sprintf( __( 'Timeline submitted. <a target="_blank" href="%s">Preview Timeline</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        9 => sprintf( __( 'Timeline scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Timeline</a>', 'powerpack-lite' ),
          date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        10 => sprintf( __( 'Timeline draft updated. <a target="_blank" href="%s">Preview Timeline</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );

    return $messages;
}

// Filter to update news post message
add_filter( 'post_updated_messages', 'pwpcl_hs_post_updated_messages' );