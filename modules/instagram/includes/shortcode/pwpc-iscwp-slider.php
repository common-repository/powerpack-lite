<?php
/**
 * 'pwpc_insta_slider' Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_iscwp_render_slider( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'username'							=> '',
		'instagram_link_text' 				=> '',
		'limit'								=> '',
		'offset'							=> '',		
		'popup'								=> 'true',
		'popup_gallery'						=> 'true',
		'gallery_height'					=> '',
		'show_caption'						=> 'true',
		'show_likes_count'					=> 'true',
		'show_comments_count'				=> 'true',
		'slidestoshow' 						=> 3,
		'slidestoscroll' 					=> 1,
		'loop' 								=> 'true',
		'dots'     							=> 'true',
		'arrows'     						=> 'true',
		'autoplay'     						=> 'true',
		'autoplay_interval' 				=> 3000,
		'speed'             				=> 300,
		'image_fit' 						=> 'true',
		), $atts, 'pwpc_insta_slider'));

	$username						= !empty($username)					? trim($username) 					: '';	
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
	$slidestoshow 					= !empty($slidestoshow) 			? $slidestoshow 					: 3;
	$slidestoshow 					= ( $limit<=$slidestoshow ) 		? $limit 							: $slidestoshow;
	$slidestoscroll 				= !empty($slidestoscroll) 			? $slidestoscroll 					: 1;
	$loop 							= ( $loop == 'false' ) 				? 'false' 							: 'true';
	$dots 							= ( $dots == 'false' ) 				? 'false' 							: 'true';
	$arrows 						= ( $arrows == 'false' ) 			? 'false' 							: 'true';
	$autoplay 						= ( $autoplay == 'false' ) 			? 'false' 							: 'true';
	$autoplay_interval 				= (!empty($autoplay_interval)) 		? $autoplay_interval 				: 3000;
	$speed 							= (!empty($speed)) 					? $speed 							: 300;
	$height_css 					= !empty($gallery_height) 			? "height:{$gallery_height}px;" 	: '';
	$image_fit 						= ($image_fit == 'true') 			? 1 								: 0;

	// If no username is passed then return
	if( empty($username) ) {
		return $content;
	}

	// Enqueue required script
	if( $popup ) {
		
		// Popup Configuration
		$popup_conf = compact( 'popup_gallery', 'show_likes_count', 'show_comments_count', 'show_caption', 'instagram_link_text' );

		wp_enqueue_script('wpos-magnific-script');
	}
	wp_enqueue_script('wpos-slick-jquery');
	wp_enqueue_script('pwpc-iscwp-public-js');

	// Taking some variables
	$popup_html 	= '';
	$count 			= 1;	
	$unique			= pwpcl_get_unique();
	$old_browser	= pwpcl_old_browser();
	$img_size		= pwpcl_insta_img_size( $slidestoshow );

	$instagram_link_main = 'https://www.instagram.com/';
	$instagram_data 	 = pwpcl_iscwp_get_user_media( $username );
	$insta_user_media	 = !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

	// Extra classes
	$extra_cls			= ($old_browser) 			? ' pwpc-iscwp-old-browser' 	: '';
	$extra_cls 			.= ($image_fit) 			? ' pwpc-iscwp-image-fit' 		: '';

	$wrpper_cls			= "pwpc-iscwp-cnt-wrp";

	$main_wrpper_cls	= "pwpc-iscwp-gallery-slider";
	$main_wrpper_cls 	.= ($popup) 				? ' pwpc-iscwp-popup-gallery' 	: '';
	$main_wrpper_cls	.= $extra_cls;

	// User details
	$userdata = array(
			'username' 			=>	(!empty($instagram_data['iscwp_user_data']['username'])) 			? $instagram_data['iscwp_user_data']['username'] 		: '',
			'full_name'			=>	(!empty($instagram_data['iscwp_user_data']['full_name'])) 			? $instagram_data['iscwp_user_data']['full_name'] 		: '',
			'profile_picture'	=>	(!empty($instagram_data['iscwp_user_data']['profile_pic_url']) ) 	? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
		);

	// Slider configuration
	$slider_conf = compact('slidestoshow', 'slidestoscroll', 'loop', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed');

	ob_start();

	// If data there
	if(!empty($insta_user_media)) { ?>

	<div class="pwpc-iscwp-insta-slider-wrp pwpc-iscwp-main-wrp pwpc-clearfix">
		<div id="pwpc-iscwp-gallery-<?php echo $unique; ?>" class="<?php echo $main_wrpper_cls; ?>" data-user="<?php echo $username; ?>">
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

				// Design File
				include( PWPCL_ISCWP_DIR . '/templates/design-1.php' );

				// Creating Popup HTML
				if( $popup ) {
					ob_start();
					include( PWPCL_ISCWP_DIR . '/templates/popup/popup.php' );
					$popup_html .= ob_get_clean();
				}

				if( $limit == $count ) {
					break;
				}

				$count++;
			} ?>
		</div>
		<div class="pwpc-iscwp-gallery-slider-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>

		<?php if( $popup ) { ?>
		<div class="pwpc-iscwp-popup-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode( $popup_conf )); ?>"></div>
		<?php } ?>
	</div>
<?php }

	echo $popup_html; // Printing popup html

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_insta_slider' shortcode
add_shortcode('pwpc_insta_slider', 'pwpcl_iscwp_render_slider');