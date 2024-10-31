<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Recent Post Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get Taxonomies list 
 * 
 * @subpackage Recent Post Slider
 * @since 1.0
 */
function pwpcl_rps_get_category_list( $post_id = 0, $taxonomy = '' ) {
    $output = '';
    $terms  = get_the_terms( $post_id, $taxonomy );

    if( $terms && !is_wp_error($terms) && !empty($taxonomy) ) {
        $output .= '<ul class="post-categories pwpc-rps-post-categories">';
        foreach ( $terms as $term ) {
             $output .= '<li><a href="'.get_term_link($term).'" rel="'.$taxonomy.'"> '.$term->name.' </a></li>';
        }
        $output .= '</ul>';
    }
    return $output;
}