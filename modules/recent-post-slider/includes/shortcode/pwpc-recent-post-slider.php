<?php
/**
 * 'pwpc_rps_post_slider' Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Recent Post Slider
 * @since 1.0
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_rps_render_post_slider( $atts, $content = null ) {

    // Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'show_date' 			=> 'true',
		'show_category' 		=> 'true',
		'show_content' 			=> 'true',
		'show_author' 			=> 'true',
		'words_limit' 			=> '20',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',
		'autoplay'     			=> 'true',
		'autoplay_interval' 	=> '3000',
		'speed'             	=> '600',
		'rtl'					=> '',
		'show_read_more'   		=> 'true',
		'read_more_text'		=> '',
		'sticky_posts' 			=> 'false',
		'image_size' 			=> 'full',
		'image_fit'				=> 'true',
		), $atts, 'pwpc_rps_post_slider'));

	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$category 				= (!empty($category))					? $category 					: '';
	$show_date 				= ( $show_date == 'false' ) 			? 'false'						: 'true';
	$show_category 			= ( $show_category == 'false' )			? 'false' 						: 'true';
	$show_content 			= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$show_author 			= ( $show_author == 'false')			? 'false'						: 'true';
	$words_limit 			= !empty( $words_limit ) 				? $words_limit 					: 20;
	$dots 					= ( $dots == 'false' ) 					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'false' ) 				? 'false' 						: 'true';
	$autoplay 				= ( $autoplay == 'false' ) 				? 'false' 						: 'true';
	$autoplay_interval 		= !empty($autoplay_interval) 			? $autoplay_interval 			: '3000';
	$speed 					= !empty($speed) 						? $speed 						: '600';
	$showreadmore 			= ( $show_read_more == 'false' )		? 'false' 						: 'true';
	$read_more_text 		= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'powerpack-lite');
	$sticky_posts 			= ( $sticky_posts == 'true' ) 			? false 						: true;
	$image_size 			= !empty($image_size) 					? $image_size 			 		: 'full';
	$image_fit				= ($image_fit == 'false')				? 0 : 1;

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'pwpc-rps-public-script' );

	// Taking some global
	global $post;

	// Taking some variables
	$unique				= pwpcl_get_unique();
	$old_browser		= pwpcl_old_browser();

	$slider_cls 		= "pwpc-rps-post-slider pwpc-rps-post-slider-js pwpc-rps-design-1";
	$slider_cls			.= ($image_fit) 	? ' pwpc-rps-image-fit' 	: '';
	$slider_cls			.= ($old_browser) 	? ' pwpc-rps-old-browser' : '';

	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl');

	// WP Query Parameters
	$args = array (
		'post_type'      		=> PWPCL_RPS_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'orderby'        		=> 'date',
		'order'          		=> 'DESC',
		'posts_per_page' 		=> $posts_per_page,
		'ignore_sticky_posts'	=> $sticky_posts,
	);

 	// Category Parameter
	if($category != "") {
		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> PWPCL_RPS_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $category,
							));
	}

	// WP Query
	$query = new WP_Query($args);

	ob_start();

	// If post is there
	if ( $query->have_posts() ) : ?>

		<div class="pwpc-rps-slider-wrp pwpc-clearfix">
			<div id="pwpc-rps-slider-<?php echo $unique; ?>" class="<?php echo $slider_cls; ?>">
				<?php while ( $query->have_posts() ) : $query->the_post();

					$post_id 		= isset($post->ID) ? $post->ID : '';
					$post_link 		= esc_url( get_permalink( $post_id ) );
					$cat_list		= pwpcl_rps_get_category_list($post->ID, PWPCL_RPS_CAT);
					$feat_image 	= pwpcl_get_post_featured_image( $post->ID, $image_size );

	            	// Include shortcode html file
					include( PWPCL_RPS_DIR . '/templates/slider/design-1.php' );

					endwhile;
				?>
			</div>
			<div class="pwpc-rps-slider-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>

	<?php
	endif; // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_rps_post_slider' shortcode
add_shortcode( 'pwpc_rps_post_slider', 'pwpcl_rps_render_post_slider' );