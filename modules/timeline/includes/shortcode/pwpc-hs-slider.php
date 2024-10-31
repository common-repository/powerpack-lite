<?php
/**
 * 'pwpc_timeline_slider' Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_hs_timeline_slider( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit'    				=> '15',
		'category' 				=> '',
		'slidestoshow'			=> '3',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',
		'autoplay'     			=> 'false',
		'adaptiveheight'		=> 'true',
		'autoplay_interval' 	=> '3000',
		'speed'             	=> '300',
		'show_full_content' 	=> 'false',
		'show_content' 			=> 'true',
		'words_limit' 			=> '70',
		'show_read_more' 		=> 'true',
		'read_more_text'		=> '',
		'post_type'				=> PWPCL_HS_POST_TYPE,
		'image_size'			=> 'full',
		'rtl'					=> '',
	), $atts, 'pwpc_timeline_slider'));

	$supported_posts	= pwpcl_hs_supported_post_types();
	$supported_post_cat = pwpcl_hs_supported_post_types_category();
	$posts_per_page 	= !empty($limit) 						? $limit 						: '15';
	$slidestoshow 		= !empty($slidestoshow) 				? $slidestoshow 				: '3';
	$cat 				= (!empty($category))					? $category						: '';
	$dots 				= ( $dots == 'false' )					? 'false' 						: 'true';
	$arrows 			= ( $arrows == 'false' )				? 'false' 						: 'true';
	$autoplay 			= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$adaptiveheight 	= ( $adaptiveheight == 'false' ) 		? 'false' 						: 'true';
	$autoplayInterval	= !empty( $autoplay_interval ) 			? $autoplay_interval 			: '3000';
	$speed 				= !empty( $speed ) 						? $speed 						: '300';
	$showFullContent 	= ( $show_full_content == 'true' ) 		? 'true' 						: 'false';
	$showContent 		= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$words_limit 		= !empty($words_limit) 					? $words_limit 					: 20;
	$showreadmore 		= ( $show_read_more == 'false' ) 		? 'false' 						: 'true';
	$read_more_text 	= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'powerpack-lite');
	$post_type 			= ($post_type && (array_key_exists(trim($post_type), $supported_posts))) 	? trim($post_type) 					: PWPCL_HS_POST_TYPE;
	$post_type_cat 		= ($post_type && (array_key_exists(trim($post_type), $supported_post_cat))) ? $supported_post_cat[$post_type] 	: PWPCL_HS_CAT;

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'pwpc-hs-public-script' );

	// Taking some variables
	$unique 			= pwpcl_get_unique();
	$slider_as_nav_for 	= "data-slider-nav-for='pwpc-hs-slider-for-{$unique}'";

	// Taking some globals
	global $post;

	// WP Query Parameters
	$args = array ( 
		'post_type'      	=> $post_type,
		'post_status'		=> array( 'publish' ),
		'order'          	=> 'DESC',
		'orderby'        	=> 'date',
		'posts_per_page' 	=> $posts_per_page,
	);

	// Category Parameter
	if($cat != '') {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> $post_type_cat,
									'field' 	=> 'term_id',
									'terms' 	=> $cat,
							));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	$date_format	= get_option( 'date_format' );

	// Slider configuration
	$slidestoshow 	= (!empty($slidestoshow) && $slidestoshow <= $post_count) 	? $slidestoshow : $post_count;
	$nav_centermode	= ($slidestoshow % 2 == 0 || $slidestoshow == $post_count) 	? 'false' : 'true';
	$slider_conf 	= compact('dots', 'arrows', 'autoplay', 'autoplayInterval', 'speed', 'adaptiveheight', 'slidestoshow', 'nav_centermode', 'rtl');

	ob_start();

	if ( $query->have_posts() ) : ?>

		<div class="pwpc-hs-slider-wrp pwpc-clearfix">
			<div class="pwpc-hs-slider-inner-wrp pwpc-hs-slider-design pwpc-clearfix">
				<?php
					// Design File
					include( PWPCL_HS_DIR . '/templates/slider/design-1.php' );
				?>
			</div>
			<div class="pwpc-hide pwpc-hs-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>
	<?php endif; // end if

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_timeline_slider' shortcode
add_shortcode('pwpc_timeline_slider', 'pwpcl_hs_timeline_slider');