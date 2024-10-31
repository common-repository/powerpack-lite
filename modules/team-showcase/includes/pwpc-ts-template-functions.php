<?php
/**
 * Templates Functions
 *
 * Handles to manage templates of plugin
 * 
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Handles the team member social profiles
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_member_social_meta( $post_id = '', $limit = 6 ) {

	// Taking some variables
	$social_html 		= '';
	$social_inr_html	= '';
	$count 				= 1;

	if( empty($post_id) || empty($limit) ) {
		return $social_html;
	}

	$prefix = PWPCL_TS_META_PREFIX; // Metabox prefix

	$social_services 	= pwpcl_ts_social_scrvices(); // Getting social service
	$social 			= get_post_meta( $post_id, $prefix.'social', true );
	$social 			= !empty($social) ? $social : array();

	// If social meta are not empty
	if( !empty($social_services) ) {
		foreach ($social_services as $s_key => $social_data) {
			
			$social_link = isset($social[$s_key]) ? $social[$s_key] : '';
			
			if( empty($social_link) ) continue;
			
			$fa_icon 		= isset($social_data['icon']) ? $social_data['icon'] : 'fa fa-link';
			$social_link 	= ( $s_key == 'mail' ) ? 'mailto:'.$social_link : esc_url($social_link);

			$social_inr_html .= '
							<li>
								<a href="'.$social_link.'" target="_blank">
									<i class="'.$fa_icon.'"></i>
								</a>
							</li>';
			
			// Limit no of social links
			if( $limit != 'all' && $limit == $count ) {
				break;
			}

			$count++;

		} // End of for each

		// Wrapping the HTML
		if( !empty($social_inr_html) ) {
			$social_html .= '<div class="pwpc-ts-member-social">
								<ul>'.$social_inr_html.'</ul>
							</div><!-- end .pwpc-ts-member-social -->';
		}

	} // End of if

	return $social_html;
}