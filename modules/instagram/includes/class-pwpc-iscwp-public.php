<?php
/**
 * Public Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Iscwp_Public {

	function __construct() {

		// Ajax call to update attachment data
		add_action( 'wp_ajax_pwpcl_iscwp_get_media_data', array($this, 'pwpcl_iscwp_get_media_data') );
		add_action( 'wp_ajax_nopriv_pwpcl_iscwp_get_media_data', array( $this, 'pwpcl_iscwp_get_media_data') );
	}

	/**
	 * Get Insta Media Data
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function pwpcl_iscwp_get_media_data() {

		// Taking passed data
		extract( $_POST['shrt_param'] );
		$shortcode 	= trim($_POST['shortcode']);
		$username 	= trim($_POST['user']);

		// Taking some defaults		
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'powerpack-lite');

		if( $shortcode && $username ) {

			$transient_key 		= "pwpc_iscwp_media_data_{$username}";

			$stored_transient 	= get_transient( $transient_key ); // Getting cache value
			$stored_transient	= !empty($stored_transient) ? json_decode($stored_transient, true) : array();

			if( $stored_transient === false || empty($stored_transient[$shortcode]) ) {

				$api_url 		= "https://www.instagram.com/p/{$shortcode}/?__a=1";
				$response_data 	= pwpcl_iscwp_insta_request( $api_url );

				if( $response_data['body'] ) {
					
					$response_arr 					= json_decode($response_data['body'], true);
					$stored_transient[$shortcode]	= $response_arr;

					// Stored media data into cache
					set_transient( $transient_key, json_encode($stored_transient), 259200 );
				}
			}

			// Getting user data for popup info
			$instagram_link_main 	= 'https://www.instagram.com/';
			$instagram_data 		= pwpcl_iscwp_get_user_media( $username );
			$insta_user_media 		= !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

			if( $insta_user_media ) {

				// User details
				$userdata = array(
					'username' 			=>	(!empty($instagram_data['iscwp_user_data']['username'])) 			? $instagram_data['iscwp_user_data']['username'] 		: '',
					'full_name'			=>	(!empty($instagram_data['iscwp_user_data']['full_name'])) 			? $instagram_data['iscwp_user_data']['full_name'] 		: '',
					'profile_picture'	=>	(!empty($instagram_data['iscwp_user_data']['profile_pic_url']) ) 	? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
				);

				$media_node_data 	= wp_list_pluck( $insta_user_media, 'node' );
				$media_id_data 		= wp_list_pluck( $media_node_data, 'shortcode' );
				$media_ref_key 		= array_search($shortcode, $media_id_data);
				$media_ref_data		= isset($insta_user_media[$media_ref_key]) ? $insta_user_media[$media_ref_key] : '';

				$iscwp_data 		= pwpcl_iscwp_insta_image_data( $media_ref_data );						
				$gallery_img_src 	= $iscwp_data['standard_img'];
				$iscwp_likes 		= pwpcl_iscwp_format_number( $iscwp_data['like_count'] );
				$iscwp_comments 	= pwpcl_iscwp_format_number( $iscwp_data['comment_count'] );
				$instagram_link 	= $iscwp_data['link'];
				$img_caption 		= $iscwp_data['caption'];

				// Getting media data
				$media_data 	= pwpcl_iscwp_user_media_data( $username, $shortcode );
				$location 		= isset($media_data['location']) 		? $media_data['location'] 		: '';				
				$video_url		= isset($media_data['video_url']) 		? $media_data['video_url'] 		: '';

				ob_start();
				include( PWPCL_ISCWP_DIR . '/templates/popup/design-1.php' );
				$data = ob_get_clean();

				$result['success'] 	= 1;
				$result['data'] 	= $data;
				$result['msg'] 		= __('Success', 'powerpack-lite');
			}

		} // End of check username and shortcode

		echo json_encode( $result );
		exit;
	}
}

$pwpcl_iscwp_public = new PWPCL_Iscwp_Public();