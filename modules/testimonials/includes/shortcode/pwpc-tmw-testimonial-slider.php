<?php
/**
 * `pwpc_testimonials_slider` Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle testimonial slider shortcode
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_testimonial_slider( $atts, $content ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'slides_column'     	=> 1,
		'slides_scroll'     	=> 1,
		'adaptive_height'		=> 'false',
		'category' 				=> '',
		'display_client' 		=> 'true',
		'display_avatar' 		=> 'true',
		'display_job' 			=> 'true',
		'display_company' 		=> 'true',
		'image_style'       	=> 'circle',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',
		'autoplay'     			=> 'true',
		'autoplay_interval' 	=> 3000,
		'speed'             	=> 300,
		'size' 					=> 100,
		'show_title'			=> 'true',
		'rtl'					=> false,
	), $atts, 'pwpc_testimonials_slider'));

	$limit 				= !empty($limit) 					? $limit 						: 20;
	$slides_column 		= !empty($slides_column) 			? $slides_column				: '1';
	$slides_scroll 		= !empty($slides_scroll) 			? $slides_scroll 				: '1';
	$cat 				= (!empty($category))				? $category 					: '';
	$display_client 	= ( $display_client == 'true' ) 	? 'true' 						: 'false';
	$display_avatar 	= ( $display_avatar == 'true' ) 	? 'true' 						: 'false';
	$display_job 		= ( $display_job == 'true' ) 		? 'true' 						: 'false';
	$display_company	= ( $display_company == 'true' ) 	? 'true' 						: 'false';
	$show_title 		= ( $show_title == 'true' ) 		? 'true' 						: 'false';
	$image_style 		= ( $image_style == 'circle' ) 		? 'pwpc-tmw-circle' 			: 'pwpc-tmw-square';
	$dots 				= ( $dots == 'true' ) 				? 'true' 						: 'false';
	$arrows 			= ( $arrows == 'true' ) 			? 'true' 						: 'false';
	$autoplay 			= ( $autoplay == 'true' ) 			? 'true' 						: 'false';
	$autoplay_interval 	= !empty($autoplay_interval) 		? $autoplay_interval 			: '2000';
	$speed 				= !empty($speed) 					? $speed 						: '300';
	$size 				= !empty($size) 					? $size 						: '100';
	$adaptive_height 	= ( $adaptive_height == 'true' ) 	? 'true' 						: 'false';

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
	$prefix 			= PWPC_TMW_META_PREFIX;
	$class 				= '';
	$unique				= pwpcl_get_unique();

	// Enqueing required script
	wp_enqueue_script('wpos-slick-jquery');
	wp_enqueue_script('pwpc-tmw-public-script');

	// Query Parameter
	$args = array (
		'post_type'      		=> PWPCL_TMW_POST_TYPE,
		'post_status'			=> array( 'publish' ),
		'orderby'        		=> 'date',
		'order'          		=> 'DESC',
		'posts_per_page' 		=> $limit,
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> PWPCL_TMW_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $cat,
								));
	}

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	// Slider configuration and taken care of centermode
	$slides_column 		= (!empty($slides_column) && $slides_column <= $post_count) ? $slides_column : $post_count;
	
	$wrpper_cls			= "pwpc-tmw-design pwpc-tmw-slider-clmn-{$slides_column}";

	// Slider configuration
	$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'adaptive_height', 'rtl');

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

		<div class="pwpc-tmw-slider-wrp">
			<div class="pwpc-tmw-testimonials-slider pwpc-tmw-testimonials-slidelist <?php echo $wrpper_cls; ?>" id="pwpc-tmw-testimonials-<?php echo $unique; ?>">
				
				<?php while ( $query->have_posts() ) : $query->the_post();

					$css_class = 'pwpc-tmw-quote';

					$pertestimonial_image 	= pwpcl_tmw_get_image($post->ID, $size, $image_style);
					$pertestimonial_client 	= get_post_meta($post->ID, $prefix.'testimonial_client', true);
					$pertestimonial_job 	= get_post_meta($post->ID, $prefix.'testimonial_job', true);
					$pertestimonial_company = get_post_meta($post->ID, $prefix.'testimonial_company', true);
					$pertestimonial_url 	= get_post_meta($post->ID, $prefix.'testimonial_url', true);

					// Add a CSS class if no image is available.
					if ( isset( $pertestimonial_image ) && ( $pertestimonial_image ==  '' ) ) {
						$css_class .= ' pwpc-tmw-no-image';
					}

					$testimonial_job = ($display_job == 'true' && $pertestimonial_job != '') ? $pertestimonial_job : "";
					$testimonial_job .= ($display_company == 'true' && $pertestimonial_company != '' && $display_job == 'true' && $pertestimonial_job != '') ? " / ": "";

					if( $display_company == 'true' && $pertestimonial_company != '' ){
						$testimonial_job .= (!empty($pertestimonial_url)) ? '<a href="'.esc_url($pertestimonial_url).'" target="_blank">'.$pertestimonial_company.'</a>' : $pertestimonial_company;
					}

					$author = ($display_client == 'true' && $pertestimonial_client != '') ? '<strong>'.$pertestimonial_client.'</strong>' : "";

					// Include shortcode html file
					include( PWPCL_TMW_DIR . '/templates/designs/design-1.php' );

				endwhile;
				?>
			</div>
			<div class="pwpc-hide pwpc-tmw-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>

		<?php } // End of have_post()
		
		wp_reset_query(); // Reset WP Query

		$content .= ob_get_clean();
		return $content;
}

// Testimonial slider shortcode
add_shortcode( 'pwpc_testimonials_slider', 'pwpcl_tmw_testimonial_slider' );