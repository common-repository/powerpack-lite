<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to unique number value
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_get_thumb_unique() {
    
    static $unique1 = 0;
    $unique1++;

    return $unique1;
}

/**
 * Function to unique number value
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_get_popup_unique() {
    
    static $unique2 = 0;
    $unique2++;

    return $unique2;
}

/**
 * Function to get post external link or permalink
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_get_post_link( $post_id = '' ) {

    $post_link = '';

    if( !empty($post_id) ) {

        $prefix = PWPCL_PAP_META_PREFIX;

        $post_link = get_post_meta( $post_id, $prefix.'project_url', true );
    }
    
    return $post_link;
}