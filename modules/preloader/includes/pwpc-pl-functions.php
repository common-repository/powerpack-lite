<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Preloader
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @subpackage Preloader
 * @since 1.0
 */
function pwpcl_pl_default_settings() {

    global $pwpc_pl_options;

    $pwpc_pl_options = array(
        'is_preloader'          => 0,
        'plwao_spinner'         => 'spinner-1',
        'plwao_spinner_size'    => 'medium',
    );

    $default_options = apply_filters('pwpc_pl_options_default_values', $pwpc_pl_options );

    // Update default options
    update_option( 'pwpc_pl_options', $default_options );

    // Overwrite global variable when option is update
    $pwpc_pl_options = pwpcl_get_settings('pwpc_pl_options');
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @subpackage Preloader
 * @since 1.0
 */
function pwpcl_pl_get_option( $key = '', $default = false ) {
    global $pwpc_pl_options;
    return pwpcl_get_option( $pwpc_pl_options, $key, $default, 'preloader' );
}