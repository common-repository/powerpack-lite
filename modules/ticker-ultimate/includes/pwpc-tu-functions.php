<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get post external link or permalink
 * 
 * @package Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_get_post_link( $post_id = '' ) {

    $post_link = '';

    if( !empty($post_id) ) {
        $prefix     = PWPCL_TU_META_PREFIX;
        $post_link  = get_post_meta( $post_id, $prefix.'more_link', true );
    }

    return $post_link;
}

/**
 * Add Http in url if not exist
 * 
 * @package Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_add_http($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}