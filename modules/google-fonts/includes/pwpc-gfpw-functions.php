<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Google Fonts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @subpackage Google Fonts
 * @since 1.0
 */
function pwpcl_gfpw_default_settings() {

    global $pwpc_gfpw_options;

    $pwpc_gfpw_options = array(
        'gf_font'       => array(),
        'font_element'  => array(),
    );
    
    $default_options = apply_filters('pwpc_gfpw_options_default_values', $pwpc_gfpw_options );
    
    // Update default options
    update_option( 'pwpc_gfpw_options', $default_options );
    
    // Overwrite global variable when option is update
    $pwpc_gfpw_options = pwpcl_get_settings('pwpc_gfpw_options');
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @subpackage Google Fonts
 * @since 1.0
 */
function pwpcl_gfpw_get_option( $key = '', $default = false ) {
    global $pwpc_gfpw_options;
    return pwpcl_get_option( $pwpc_gfpw_options, $key, $default, 'google_fonts' );
}

/**
 * Google Fonts Elements
 * 
 * @subpackage Google Fonts
 * @since 1.0
 */
function pwpcl_gfpw_fonts_elements($data = array()) {
    $elements = array(
                            'body'          => __('Body Font', 'powerpack-lite'),
                            'h1'            => __('H1 Font', 'powerpack-lite'),
                            'h2'            => __('H2 Font', 'powerpack-lite'),
                            'h3'            => __('H3 Font', 'powerpack-lite'),
                            'h4'            => __('H4 Font', 'powerpack-lite'),
                            'h5'            => __('H5 Font', 'powerpack-lite'),
                            'h6'            => __('H6 Font', 'powerpack-lite'),
                            'p'             => __('P Font', 'powerpack-lite'),
                            'a'             => __('Hyperlink Font', 'powerpack-lite'),
                            'blockquote'    => __('Blockquote Font', 'powerpack-lite'),
                            'pre'           => __('Pre Font', 'powerpack-lite'),
                            'code'          => __('Code Font', 'powerpack-lite'),
                            'button'        => __('Button Font', 'powerpack-lite'),
                            'input'         => __('Input Types Font', 'powerpack-lite'),
                            'ol'            => __('Ordered List Font', 'powerpack-lite'),
                            'ul'            => __('Unordered List Font', 'powerpack-lite'),
                            'label'         => __('Label Font', 'powerpack-lite'),
                        );

    return apply_filters( 'pwpc_gfpw_fonts_elements', $elements);
}

/**
 * Get Google Fonts Data
 * 
 * @subpackage Google Fonts
 * @since 1.0
 */
function pwpcl_gfpw_get_font_data($font = '') {

    $font_data = array();

    $font_data_arr = explode(':', $font);
    preg_match("|\d+|", $font, $font_weight_arr); // Getting numeric value from string

    $font_weight    = isset($font_weight_arr[0])    ? $font_weight_arr[0] : '';
    $font_style     = isset($font_data_arr[1])      ? str_replace($font_weight, '', $font_data_arr[1]) : '';

    // Font Data
    $font_data['font_family']   = isset($font_data_arr[0]) ? $font_data_arr[0] : '';
    $font_data['font_style']    = $font_style;
    $font_data['font_weight']   = $font_weight;

    return $font_data;
}