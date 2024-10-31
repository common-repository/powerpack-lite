<?php
/**
 * 'pwpc_insta_grid' Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_iscwp_render_grid( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'username'							=> '',
		'grid'    							=> '3',
		'instagram_link_text' 				=> '',
		'limit'								=> '',
		'offset'							=> '',
		'gallery_height'					=> '',
		'show_caption'						=> 'true',
		'popup'								=> 'true',
		'popup_gallery'						=> 'true',
		'show_likes_count'					=> 'true',
		'show_comments_count'				=> 'true',
		'image_fit' 						=> 'true',
		), $atts, 'pwpc_insta_grid'));

	$username						= !empty($username)					? trim($username) 					: '';
	$grid 							= (!empty($grid) && $grid <= 12) 	? $grid 							: '3';
	$instagram_link_text 			= !empty($instagram_link_text)		? $instagram_link_text 				: __('View On Instagram', 'powerpack-lite');	
	$limit 							= (is_numeric($limit) && $limit >= 0)	? $limit 						: 20;
	$offset 						= (is_numeric($offset) && $offset >= 0)	? $offset 						: '';
	$offset_css						= ($offset != '')					? "padding:{$offset}px;"			: '';
	$popup_gallery					= ($popup_gallery == 'true')		? 'true'							: 'false';
	$gallery_height					= ($gallery_height > 0)				? $gallery_height 					: '';
	$show_caption					= ($show_caption == 'false')		? 'false'							: 'true';
	$popup							= ($popup == 'false')				? 0									: 1;
	$show_likes_count				= ($show_likes_count == 'false')	? 'false'							: 'true';
	$show_comments_count			= ($show_comments_count == 'false')	? 'false'							: 'true';
	$height_css 					= !empty($gallery_height) 			? "height:{$gallery_height}px;" 	: '';
	$image_fit 						= ($image_fit == 'true') 			? 1 								: 0;

	// If no username is passed then return
	if( empty($username) ) {
		return $content;
	}

	// Taking some variables
	$popup_html 	= '';
	$loop_count		= 1;
	$count 			= 1;
	$unique			= pwpcl_get_unique();
	$old_browser	= pwpcl_old_browser();
	$img_size		= pwpcl_insta_img_size( $grid );

	// Extra classes
	$extra_cls			= ($old_browser) 	? ' pwpc-iscwp-old-browser' : '';
	$extra_cls 			.= ($image_fit) 	? ' pwpc-iscwp-image-fit' 	: '';

	// Main wrapper classes
	$main_wrpper_cls	= "pwpc-iscwp-insta-grid pwpc-iscwp-grid-{$grid}";
	$main_wrpper_cls 	.= ($popup) ? ' pwpc-iscwp-popup-gallery' : '';
	$main_wrpper_cls	.= $extra_cls;

	$instagram_link_main = 'https://www.instagram.com/';
	$instagram_data 	 = pwpcl_iscwp_get_user_media( $username );
	$insta_user_media	 = !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

	// User details
	$userdata = array(
			'username' 			=>	(!empty($instagram_data['iscwp_user_data']['username'])) 			? $instagram_data['iscwp_user_data']['username'] 		: '',
			'full_name'			=>	(!empty($instagram_data['iscwp_user_data']['full_name'])) 			? $instagram_data['iscwp_user_data']['full_name'] 		: '',
			'profile_picture'	=>	(!empty($instagram_data['iscwp_user_data']['profile_pic_url']) ) 	? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
		);	

	// Enqueue required script
	if( $popup ) {

		// Popup Configuration
		$popup_conf = compact( 'popup_gallery', 'show_likes_count', 'show_comments_count', 'show_caption', 'instagram_link_text' );

		wp_enqueue_script('wpos-magnific-script');
	}
	if( $popup || ($image_fit && $old_browser) ) {
		wp_enqueue_script('pwpc-iscwp-public-js');
	}

	ob_start();

	if(!empty($insta_user_media)) { ?>

	<div class="pwpc-iscwp-main-wrp pwpc-clearfix">
		<div id="pwpc-iscwp-gallery-<?php echo $unique; ?>" class="<?php echo $main_wrpper_cls; ?> pwpc-clearfix" data-user="<?php echo $username; ?>">
			<div class="pwpc-iscwp-outer-wrap">

				<?php foreach ($insta_user_media as $iscwp_key => $iscwp_data) {

					$iscwp_data 		= pwpcl_iscwp_insta_image_data( $iscwp_data );
					$img_shortcode 		= $iscwp_data['shortcode'];
					$gallery_img_src 	= isset( $iscwp_data['thumbnail_resources'][$img_size] ) ? $iscwp_data['thumbnail_resources'][$img_size] : $iscwp_data['display_url'];
					$iscwp_likes 		= pwpcl_iscwp_format_number( $iscwp_data['like_count'] );
					$iscwp_comments 	= pwpcl_iscwp_format_number( $iscwp_data['comment_count'] );
					$instagram_link 	= $iscwp_data['link'];
					$img_caption 		= $iscwp_data['caption'];
					$iscwp_link_value 	= ($popup) ? 'javascript:void(0);' : $instagram_link;

					// Getting media data
					$media_data 	= pwpcl_iscwp_user_media_data( $username, $img_shortcode );
					$location 		= isset($media_data['location']) 		? $media_data['location'] 		: '';						
					$video_url		= isset($media_data['video_url']) 		? $media_data['video_url'] 		: '';
					$popup_attr 	= (!$media_data) ? "data-shortcode='{$img_shortcode}'" : '';

					$wrpper_cls	   		= "pwpc-iscwp-cnt-wrp pwpc-icol-{$grid} pwpc-columns";
					$wrpper_cls			.= ($loop_count == 1) ? " pwpc-iscwp-first"	: '';

					// Design File
					include( PWPCL_ISCWP_DIR . '/templates/design-1.php' );

					// Creating Popup HTML
					if( $popup ) {
						ob_start();
						include( PWPCL_ISCWP_DIR . '/templates/popup/popup.php' );
						$popup_html .= ob_get_clean();
					}

					// If reach to limit then break
					if($limit == $count) {
						break;
					}

					$count++;
					$loop_count++; // Increment loop count for grid

					// Reset loop count
					if( $loop_count == $grid ) {
						$loop_count = 0;
					}
				} ?>
				</div>
			</div>

			<?php if($popup) { ?>
			<div class="pwpc-iscwp-popup-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
			<?php } ?>
		</div>
		<?php }

	echo $popup_html; // Printing popup html

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_insta_grid' shortcode
add_shortcode('pwpc_insta_grid', 'pwpcl_iscwp_render_grid');