<?php
/**
 * 'pwpc_logo_slider' Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `pwpc_logo_slider` shortcode
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_logo_slider( $atts, $content ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> '15',
		'cat_id' 				=> '',
		'cat_name' 				=> '',
		'slides_column' 		=> '4',
		'slides_scroll' 		=> '1',
		'dots' 					=> 'true',
		'arrows' 				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> '3000',
		'speed' 				=> '600',
		'center_mode' 			=> 'false',
		'loop' 					=> 'true',
		'rtl'					=> '',
		'link_target'			=> 'self',
		'show_title' 			=> 'true',
		'image_size' 			=> 'full',
		), $atts, 'pwpc_logo_slider'));

	$limit					= !empty($limit) 					? $limit 						: '15';
	$cat_id					= (!empty($cat_id))					? $cat_id 						: '';
	$slides_scroll 			= !empty($slides_scroll) 			? $slides_scroll 				: 1;
	$dots 					= ($dots == 'false') 				? 'false' 						: 'true';
	$arrows 				= ($arrows == 'false') 				? 'false' 						: 'true';
	$autoplay 				= ($autoplay == 'false') 			? 'false' 						: 'true';
	$autoplay_interval 		= ($autoplay_interval !== '') 		? $autoplay_interval 			: '2000';
	$speed 					= (!empty($speed)) 					? $speed 						: '300';
	$loop 					= ($loop == 'false') 				? 'false' 						: 'true';
	$link_target 			= ($link_target == 'blank') 		? '_blank' 						: '_self';
	$show_title 			= ($show_title == 'false') 			? 'false'						: 'true';
	$image_size 			= (!empty($image_size)) 			? $image_size					: 'original';

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
	wp_enqueue_script( 'pwpc-ls-public-script' );

	// Taking some globals
	global $post;

	// Taking some variables
	$prefix 		= PWPCL_LS_META_PREFIX;
	$unique			= pwpcl_get_unique();

	$main_wrap_cls	= "pwpc-ls-design-1";

	// WP Query Parameters
	$query_args = array(
						'post_type' 			=> PWPCL_LS_POST_TYPE,
						'post_status' 			=> array( 'publish' ),
						'posts_per_page'		=> $limit,
						'order'          		=> 'DESC',
						'orderby'        		=> 'date',
						'ignore_sticky_posts'	=> true,
					);

	// Category Parameter
	if( !empty($cat_id) ) {

		$query_args['tax_query'] = array( 
										array(
											'taxonomy' 			=> PWPCL_LS_CAT, 
											'field' 			=> 'term_id',
											'terms' 			=> $cat_id,
										));
	}

	// WP Query Parameters
	$logo_query = new WP_Query($query_args);
	$post_count = $logo_query->post_count;

	// Slider configuration and taken care of centermode
	$slides_column 		= (!empty($slides_column) && $slides_column <= $post_count) ? $slides_column : $post_count;
	$center_mode		= ($center_mode == 'true' && $slides_column % 2 != 0 && $slides_column != $post_count) ? 'true' : 'false';
	$main_wrap_cls		.= ($center_mode == "true") ? ' pwpc-ls-center-mode' : '';

	// Slider variable
	$logo_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'center_mode', 'loop', 'rtl');

	ob_start();

	// If post is there
	if( $logo_query->have_posts() ) {

		if($cat_name != '') { ?>
		<h3><?php echo $cat_name; ?></h3>
		<?php } ?>

		<div class="pwpc-ls-logo-slider-wrp pwpc-clearfix">
			<div class="pwpc-ls-logo-showcase pwpc-ls-logo-showcase-slider pwpc-ls-logo-slider <?php echo $main_wrap_cls; ?>" id="pwpc-ls-logo-showcase-slider-<?php echo $unique; ?>">

			<?php while ($logo_query->have_posts()) : $logo_query->the_post();

					$feat_image = pwpcl_get_post_featured_image($post->ID, $image_size);
					$logourl 	= get_post_meta( $post->ID, $prefix.'logo_link', true );

					// Include shortcode html file
					include( PWPCL_LS_DIR . '/templates/design-1.php' );

			 	endwhile;
			 ?>
			</div>
			<div class="wpls-logo-showacse-slider-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($logo_conf)); ?>"></div>
		</div>

	<?php
		wp_reset_query(); // Reset WP Query

		$content .= ob_get_clean();
		return $content;
	}
}

// `pwpc_logo_slider` slider shortcode
add_shortcode( 'pwpc_logo_slider', 'pwpcl_ls_logo_slider' );