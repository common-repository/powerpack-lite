<?php
/**
 * Shortcode File
 *
 * Handles the 'pwpc_team_slider' shortcode of plugin
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * 'pwpc_team_slider' shortcode
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_team_showcase_slider( $atts, $content = null ) {

    // Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 			=> '15',
		'category' 			=> '',
		'slides_column' 	=> '3',
		'slides_scroll' 	=> '1',
		'dots' 				=> 'true',
		'arrows' 			=> 'true',
		'autoplay' 			=> 'true',
		'autoplay_interval' => '3000',
		'speed' 			=> '500',
		'popup' 			=> 'true',
		'social_limit'		=> '6',
		'image_fit'			=> 'true',
		'rtl'				=> '',
		), $atts, 'pwpc_team_slider'));
	
	$unique				= pwpcl_get_unique();
	$limit 				= !empty($limit) 					? $limit 			: 15;
	$category 			= (!empty($category))				? $category 		: '';
	$popup 				= ( $popup == 'false' ) 			? 'false' 			: 'true';
	$slides_column 		= !empty($slides_column) 			? $slides_column 	: 3;
	$slides_scroll 		= !empty($slides_scroll) 			? $slides_scroll 	: 1;
	$autoplay 			= ($autoplay == 'false') 			? 'false' 			: 'true';
	$dots 				= ($dots == 'false') 				? 'false' 			: 'true';
	$arrows 			= ($arrows == 'false') 				? 'false' 			: 'true';
	$autoplay_interval 	= !empty($autoplay_interval) 		? $autoplay_interval: '3000';
	$speed 				= !empty($speed) 					? $speed 			: '500';
	$image_fit			= ($image_fit == 'false')			? 0 : 1;

	// Enqueus required script
	if( $popup == 'true' ) {
		wp_enqueue_script('wpos-magnific-script');
	}
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'pwpc-ts-public-script' );

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Taking some globals
	global $post;

	// Taking some variables
	$popup_html 	= '';
	$style_offset	= '';
	$old_browser	= pwpcl_old_browser();
	$prefix 		= PWPCL_TS_META_PREFIX; // Meta prefix

	// Class variables
	$class 				= '';
	$wrpper_cls			= '';
	$wrpper_cls 		.= ($popup == 'true') 	? ' pwpc-ts-popup' 			: '';
	$wrpper_cls			.= ($old_browser) 		? ' pwpc-ts-old-browser' 	: '';
	$wrpper_cls			.= ($image_fit) 		? ' pwpc-ts-image-fit' 		: '';

	$popup_cls			= '';
	$popup_cls			.= ($image_fit) 		? ' pwpc-ts-image-fit' 		: '';
	$popup_cls			.= ($old_browser) 		? ' pwpc-ts-old-browser' 	: '';

	// Query Parameter
	$args = array (
		'post_type'      	=> PWPCL_TS_POST_TYPE,
		'order'         	=> 'DESC',
		'orderby'        	=> 'date',
		'posts_per_page'	=> $limit,
		'post_status'		=> array( 'publish' ),
	);

	// Category Parameter
	if( !empty($category) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> PWPCL_TS_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $category,
							));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	// Slider configuration
	$slides_column = (!empty($slides_column) && $slides_column <= $post_count) ? $slides_column : $post_count;	

	// Slider and Popup configuration
	$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl');

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>
		
		<div class="pwpc-ts-team-wrp pwpc-ts-team-slider-wrp wptsasp-clearfix">
			<div class="pwpc-ts-teamshowcase pwpc-ts-team-slider pwpc-ts-teamshowcase-slider <?php echo $wrpper_cls; ?>" id="pwpc-ts-team-slider-<?php echo $unique; ?>" ><?php				
				
				while ( $query->have_posts() ) : $query->the_post();

					// Taking some member details
	              	$teamfeat_image 	= wp_get_attachment_url( get_post_thumbnail_id() );
	              	$member_designation = get_post_meta($post->ID, $prefix.'member_designation', true);
	              	$member_department 	= get_post_meta($post->ID, $prefix.'member_department', true); 
	              	$skills 			= get_post_meta($post->ID, $prefix.'skills', true);
	              	$member_experience 	= get_post_meta($post->ID, $prefix.'member_experience', true); 

	              	$facebook_link 		= get_post_meta($post->ID, $prefix.'facebook_link', true);
	              	$google_link 		= get_post_meta($post->ID, $prefix.'google_link', true); 
	              	$likdin_link 		= get_post_meta($post->ID, $prefix.'likdin_link', true);
	              	$twitter_link 		= get_post_meta($post->ID, $prefix.'twitter_link', true);

	              	$popup_id 	= pwpcl_get_unique(); // Creating popup unique id
	              	$css_class 	= 'pwpc-team-slide';
	              	$css_class	.= empty($teamfeat_image) ? ' pwpc-ts-no-img' : '';

					// Including file
	              	include( PWPCL_TS_DIR . '/templates/design-1.php' );

					// Creating Popup HTML
	              	if( $popup == 'true' ) {
	              		ob_start();
	              		include( PWPCL_TS_DIR . '/templates/popup/design-1.php' );
	              		$popup_html .= ob_get_clean();
	              	}

	              	endwhile;
	            ?>
	        </div>
	        <div class="pwpc-hide pwpc-ts-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
	    </div>

		<?php echo $popup_html; // Printing popup html

	} // End of have posts

	wp_reset_query(); // Reset WP Query
	
	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_team_slider' shortcode
add_shortcode( 'pwpc_team_slider', 'pwpcl_ts_team_showcase_slider' );