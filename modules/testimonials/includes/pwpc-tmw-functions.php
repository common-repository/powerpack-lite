<?php
/**
 * Functions File
 *
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get user image
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_get_image( $id, $size, $style = "wtwp-circle" ) {

	$response = '';

	if ( has_post_thumbnail( $id ) ) {
		// If not a string or an array, and not an integer, default to 150x9999.
		if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
			$size = array( intval( $size ), intval( $size ) );
		} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
			$size = array( 100, 100 );
		}
		
		$response = get_the_post_thumbnail( intval( $id ), $size, array('class' => $style) );
		
	} else {
		
		$testimonial_email = get_post_meta( $id, '_testimonial_email', true );

		if ( $testimonial_email != '' && is_email( $testimonial_email ) ) {
			$response = get_avatar( $testimonial_email, $size );
		}
	}
	return $response;
}