<?php
/**
 * `pwpc_testimonials` Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle testimonial shortcode
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_testimonial_grid( $atts, $content ) {
	
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'grid' 					=> 2,
		'category' 				=> '',
		'display_client' 		=> 'true',
		'display_avatar' 		=> 'true',
		'display_job' 			=> 'true',
		'display_company' 		=> 'true',
		'image_style'       	=> 'circle',
		'size' 					=> 100,
		'show_title'			=> 'true',
	), $atts, 'pwpc_testimonials'));

	$limit 				= !empty($limit) 					? $limit 						: '20';
	$grid 				= ($grid > 0 && $grid <= 4) 		? $grid 						: 3;
	$cat 				= (!empty($category))				? $category 					: '';
	$display_client 	= ( $display_client == 'true' ) 	? 'true' 						: 'false';
	$display_avatar 	= ( $display_avatar == 'true' ) 	? 'true' 						: 'false';
	$display_job 		= ( $display_job == 'true' ) 		? 'true' 						: 'false';
	$display_company	= ( $display_company == 'true' ) 	? 'true' 						: 'false';
	$show_title 		= ( $show_title == 'true' ) 		? 'true' 						: 'false';
	$image_style 		= ( $image_style == 'circle' ) 		? 'pwpc-tmw-circle' 			: 'pwpc-tmw-square';
	$size 				= !empty($size) 					? $size 						: '300';

	// Taking some globals
	global $post;

	// Taking some variables
	$prefix 	= PWPC_TMW_META_PREFIX;
	$count 		= 0;
	$tmw_grid	= pwpcl_grid_column( $grid );
	$class 		= ' pwpc-col-'.$tmw_grid.' pwpc-columns ';

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
	if($cat != '') {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> PWPCL_TMW_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $cat,
							));
	}

	// WP Query
	$query = new WP_Query($args);

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

		<div class="pwpc-tmw-testimonials-wrp pwpc-tmw-testimonials-list pwpc-tmw-design pwpc-clearfix">
		
		<?php while ( $query->have_posts() ) : $query->the_post();

				$count++;
				$css_class = 'pwpc-tmw-quote';
				$css_class .= ( $count % $grid  == 1 ) ? ' pwpc-tmw-first' 	: '';
				$css_class .= ( $count % $grid  == 0 ) ? ' pwpc-tmw-last' 	: '';

				$pertestimonial_image 	= pwpcl_tmw_get_image($post->ID, $size, $image_style);
				$pertestimonial_client 	= get_post_meta($post->ID, $prefix.'testimonial_client', true);
				$pertestimonial_job 	= get_post_meta($post->ID, $prefix.'testimonial_job', true);
				$pertestimonial_company = get_post_meta($post->ID, $prefix.'testimonial_company', true);
				$pertestimonial_url 	= get_post_meta($post->ID, $prefix.'testimonial_url', true);

				// Add a CSS class if no image is available.
				if ( isset( $pertestimonial_image ) && ( $pertestimonial_image == '' ) ) {
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

			endwhile; ?>

		</div>

	<?php } // end of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'sp_testimonials' Testimonial shortcode
add_shortcode( 'pwpc_testimonials', 'pwpcl_tmw_testimonial_grid' );