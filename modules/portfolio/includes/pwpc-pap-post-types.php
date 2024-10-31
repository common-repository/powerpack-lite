<?php
/**
 * Register Post type functionality
 *
 * @package PowerPack Lite
 * @subpackage Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_register_post_types() {
	
	$pwpc_pap_post_lbls = apply_filters( 'pwpc_pap_post_labels', array(
								'name'                 	=> __('Portfolios & Projects', 'powerpack-lite'),
								'singular_name'        	=> __('Portfolio', 'powerpack-lite'),
								'all_items'             => __('All Portfolios', 'powerpack-lite'),
                                'add_new'              	=> __('Add Portfolio', 'powerpack-lite'),
								'add_new_item'         	=> __('Add New Portfolio', 'powerpack-lite'),
								'edit_item'            	=> __('Edit Portfolio', 'powerpack-lite'),
								'new_item'             	=> __('New Portfolio', 'powerpack-lite'),
								'view_item'            	=> __('View Portfolio', 'powerpack-lite'),
								'search_items'         	=> __('Search Portfolio', 'powerpack-lite'),
								'not_found'            	=> __('No Portfolio found', 'powerpack-lite'),
								'not_found_in_trash'   	=> __('No Portfolio found in Trash', 'powerpack-lite'),
								'menu_name'           	=> __('Portfolio - PwPc', 'powerpack-lite'),
                                'featured_image'        => __('Portfolio Cover Image', 'powerpack-lite'),
                                'set_featured_image'    => __('Set Portfolio Cover Image', 'powerpack-lite'),
                                'remove_featured_image' => __('Remove Portfolio Cover Image', 'powerpack-lite'),
                                'use_featured_image'    => __('Use as Portfolio Cover Image', 'powerpack-lite'),
							));

	$pwpc_pap_slider_args = array(
        'labels'            => $pwpc_pap_post_lbls,
        'public'            => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array( 
                                        'slug'       => apply_filters('pwpc_pap_portfolio_post_slug', 'wp-portfolio'),
                                        'with_front' => false
                                    ),
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_icon'			=> 'dashicons-portfolio',
        'supports'          => apply_filters('pwpc_pap_post_supports', array('title', 'editor', 'thumbnail')),
	);

	// Register portfolio post type
	register_post_type( PWPCL_PAP_POST_TYPE, apply_filters( 'pwpc_pap_registered_post_type_args', $pwpc_pap_slider_args ) );
}

// Action to register post type
add_action('init', 'pwpcl_pap_register_post_types');

/**
 * Function to register taxonomy
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_register_taxonomies() {
    
    // Register Portfolio Category
    $cat_labels = apply_filters('pwpcl_pap_cat_labels', array(
                    'name'              => __( 'Portfolio Categories', 'powerpack-lite' ),
                    'singular_name'     => __( 'Category', 'powerpack-lite' ),
                    'search_items'      => __( 'Search Portfolio Category', 'powerpack-lite' ),
                    'all_items'         => __( 'All Category', 'powerpack-lite' ),
                    'parent_item'       => __( 'Parent Category', 'powerpack-lite' ),
                    'parent_item_colon' => __( 'Parent Category:', 'powerpack-lite' ),
                    'edit_item'         => __( 'Edit Portfolio Category', 'powerpack-lite' ),
                    'update_item'       => __( 'Update Portfolio Category', 'powerpack-lite' ),
                    'add_new_item'      => __( 'Add New Portfolio Category', 'powerpack-lite' ),
                    'new_item_name'     => __( 'New Category Name', 'powerpack-lite' ),
                    'menu_name'         => __( 'Categories', 'powerpack-lite' ),
    ));

    $cat_args = array(
        'labels'            => $cat_labels,
    	'public'			=> true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => apply_filters('pwpc_pap_portfolio_cat_slug', 'portfolio-cat')),
    );

    register_taxonomy( PWPCL_PAP_CAT, array(PWPCL_PAP_POST_TYPE), apply_filters('pwpc_pap_register_portfolio_cat', $cat_args) );

    // Register Portfolio tag (Skill)
    $tag_labels = apply_filters('pwpcl_pap_tag_labels', array(
        'name'                          => __( 'Portfolio Skills', 'powerpack-lite' ),
        'singular_name'                 => __( 'Skill', 'powerpack-lite' ),
        'search_items'                  =>  __( 'Search Portfolio Skills', 'powerpack-lite' ),
        'popular_items'                 => __( 'Popular Skills', 'powerpack-lite' ),
        'all_items'                     => __( 'All Skills', 'powerpack-lite' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'edit_item'                     => __( 'Edit Portfolio Skill', 'powerpack-lite' ), 
        'update_item'                   => __( 'Update Portfolio Skill', 'powerpack-lite' ),
        'add_new_item'                  => __( 'Add New Portfolio Skill', 'powerpack-lite' ),
        'new_item_name'                 => __( 'New Skill Name', 'powerpack-lite' ),
        'separate_items_with_commas'    => __( 'Separate skills with commas', 'powerpack-lite' ),
        'add_or_remove_items'           => __( 'Add or remove portfolios', 'powerpack-lite' ),
        'choose_from_most_used'         => __( 'Choose from the most used portfolios', 'powerpack-lite' ),
        'menu_name'                     => __( 'Skills', 'powerpack-lite' ),
    ));

    $tag_args = array(
        'labels'                => $tag_labels,
        'hierarchical'          => false,
        'show_ui'               => true,
        'query_var'             => true,
        'show_admin_column'     => true,
        'rewrite'               => array('slug' => apply_filters('pwpc_pap_portfolio_tag_slug', 'portfolio-skill')),
    );
    
    register_taxonomy( PWPCL_PAP_TAG, array( PWPCL_PAP_POST_TYPE ), apply_filters('pwpc_pap_register_portfolio_tag', $tag_args) );
}

// Action to register taxonomy
add_action( 'init', 'pwpcl_pap_register_taxonomies');

/**
 * Function to update post messages
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_post_updated_messages( $messages ) {
	
	global $post, $post_ID;

     $messages[PWPCL_PAP_POST_TYPE] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __( 'Portfolio updated. <a href="%s">View Portfolio</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
        2 => __( 'Custom field updated.', 'powerpack-lite' ),
        3 => __( 'Custom field deleted.', 'powerpack-lite' ),
        4 => __( 'Portfolio updated.', 'powerpack-lite' ),
        5 => isset( $_GET['revision'] ) ? sprintf( __( 'Portfolio restored to revision from %s', 'powerpack-lite' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __( 'Portfolio published. <a href="%s">View Portfolio</a>', 'powerpack-lite' ), esc_url( get_permalink( $post_ID ) ) ),
        7 => __( 'Portfolio saved.', 'powerpack-lite' ),
        8 => sprintf( __( 'Portfolio submitted. <a target="_blank" href="%s">Preview Portfolio</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        9 => sprintf( __( 'Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>', 'powerpack-lite' ),
          date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        10 => sprintf( __( 'Portfolio draft updated. <a target="_blank" href="%s">Preview Portfolio</a>', 'powerpack-lite' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'pwpcl_pap_post_updated_messages' );