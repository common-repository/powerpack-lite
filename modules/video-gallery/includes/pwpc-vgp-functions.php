<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Get embed URL from the link
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_get_embed_url( $url ) {
	
	// Taking some defaults
	$result_url = false;

	if(empty($url)) return $result_url;

	// Youtube
	if( strpos( $url, 'youtube' ) !== false ) {
		
		$url_data = parse_url($url);
		
		if( !empty($url_data['query']) ) {
			$decode_url_data 	= parse_str( $url_data['query'], $output );
			$result_url 		= !empty($output['v']) ? 'https://www.youtube.com/embed/'.$output['v'] : '';
		}
	}

	// Youtube Short URL
	if( strpos( $url, 'youtu.be' ) !== false || (strpos( $url, 'youtube' ) !== false && strpos( $url, '/embed/' ) !== false) ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data) ) {
			$decode_url_data 	= explode('/', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://www.youtube.com/embed/'.end($decode_url_data) : '';
		}
	}

	// Vimeo
	if( strpos( $url, 'vimeo' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data['path']) ) {
			$decode_url_data 	= explode('/', $url_data['path']);
			$result_url 		= !empty($decode_url_data) ? 'https://player.vimeo.com/video/'.end($decode_url_data) : '';
		}
	}

	// Daily Motion
	if( strpos( $url, 'dailymotion' ) !== false ) {
		
		$url_data = explode('/', $url);

		if( !empty($url_data) ) {
			$decode_url_data 	= explode('_', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://www.dailymotion.com/embed/video/'.current($decode_url_data) : '';
		}
	}

	// Daily Motion Short URL
	if( strpos( $url, 'dai.ly' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data) ) {
			$decode_url_data 	= explode('/', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://www.dailymotion.com/embed/video/'.end($decode_url_data) : '';
		}
	}

	$result_url = !empty($result_url) ? $result_url : $url;

	return $result_url;
}

/**
 * Function to get video link
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_get_video_data( $post_id = '' ) {

	$prefix 	= PWPCL_VGP_META_PREFIX;
	$video_link = '';

	if( empty($post_id) ) return $video_link;

	// Other link
	if( empty($video_link) ) {
		$video_link = get_post_meta($post_id, $prefix.'video_oth', true);
	}

	// HTML5 video
	if( empty($video_link) ) {
		$video_link['mp4'] 	= get_post_meta($post_id, $prefix.'video_mp4', true);
		$video_link['webm'] = get_post_meta($post_id, $prefix.'video_wbbm', true);
		$video_link['ogg'] 	= get_post_meta($post_id, $prefix.'video_ogg', true);
	}

	$video_data = array(
						'link' 			=> $video_link,
						'embed_link'	=> !is_array($video_link) ? pwpcl_vgp_get_embed_url($video_link) : false,
					);

	return $video_data;
}