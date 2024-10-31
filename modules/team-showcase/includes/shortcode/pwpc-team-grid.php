<?php
/**
 * Shortcode File
 *
 * Handles the 'pwpc_team' shortcode of plugin
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * 'pwpc_team' shortcode
 * 
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_team_showcase( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 			=> '15',
		'category' 			=> '',
		'grid' 				=> '2',
		'popup' 			=> 'true',
		'social_limit'		=> '6',
		'pagination' 		=> 'false',
		'image_fit'			=> 'true',
	), $atts, 'pwpc_team'));

	$limit 				= !empty($limit) 					? $limit 		: 15;
	$category 			= (!empty($category))				? $category 	: '';
	$grid 				= !empty($grid) 					? $grid 		: 1;
	$popup 				= ( $popup == 'false' ) 			? 'false' 		: 'true';
	$pagination 		= ($pagination == 'true')			? 1				: 0;
	$image_fit			= ($image_fit == 'false')			? 0 			: 1;

	// Taking some globals
	global $post, $paged;

	// Taking variables
	$count 				= 1;
	$popup_html 		= '';
	$unique				= pwpcl_get_unique();
	$old_browser		= pwpcl_old_browser();
	$per_row 			= pwpcl_grid_column( $grid );
	$prefix 			= PWPCL_TS_META_PREFIX; // Meta prefix

	// Enqueus required script
	if( $popup == 'true' ) {
		wp_enqueue_script('wpos-magnific-script');
	}
	if( $popup == 'true' || ( $old_browser && $image_fit ) ) {
		wp_enqueue_script( 'pwpc-ts-public-script' );
	}

	// Class variables
	$class 				= 'pwpc-ts-team-grid pwpc-col-'.$per_row.' pwpc-columns';

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
		'post_status'		=> array( 'publish' ),
		'order'         	=> 'DESC',
		'orderby'        	=> 'date',
		'posts_per_page'	=> $limit,
		'paged'          	=> ($pagination) ? $paged : 1,
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
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

		<div class="pwpc-ts-team-wrp pwpc-ts-team-grid-wrp pwpc-clearfix">
			<div class="pwpc-ts-teamshowcase-grid pwpc-ts-teamshowcase <?php echo $wrpper_cls; ?> pwpc-clearfix" id="pwpc-ts-teamshowcase-<?php echo $unique; ?>">

		<?php  while ( $query->have_posts() ) : $query->the_post();

				$popup_id = pwpcl_get_unique();

				// Taking some member details
				$teamfeat_image 	= wp_get_attachment_url( get_post_thumbnail_id() );
				$member_designation = get_post_meta($post->ID, $prefix.'member_designation', true);
				$member_department 	= get_post_meta($post->ID, $prefix.'member_department', true); 
				$skills 			= get_post_meta($post->ID, $prefix.'skills', true);
				$member_experience 	= get_post_meta($post->ID, $prefix.'member_experience', true); 

				// CSS class
				$css_class 	= ( $count % $grid  == 1 ) ? 'pwpc-ts-first' : '';
				$css_class	.= empty($teamfeat_image) ? ' pwpc-ts-no-img' : '';

				// Including file
				include( PWPCL_TS_DIR . '/templates/design-1.php' );

		        // Creating Popup HTML
				if( $popup == 'true' ) {
					ob_start();
					include( PWPCL_TS_DIR . '/templates/popup/design-1.php' );
					$popup_html .= ob_get_clean();
				}

				$count++;
	          	endwhile;
		?>
			</div>

			<?php if($pagination && ($query->max_num_pages > 1) ) { ?>
			<div class="pwpc-ts-paging pwpc-clearfix">
				<div class="pwpc-ts-pagi-btn pwpc-ts-prev-btn"><?php previous_posts_link( '&laquo; '.__('Previous', 'powerpack-lite') ); ?></div>
				<div class="pwpc-ts-pagi-btn pwpc-ts-next-btn"><?php next_posts_link( __('Next', 'powerpack-lite').' &raquo;', $query->max_num_pages ); ?></div>
			</div>
			<?php } ?>
		</div>

	<?php
		echo $popup_html; // Printing popup html

	} // End of have posts

	wp_reset_query(); // Reset wp query

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_team' shortcode
add_shortcode('pwpc_team', 'pwpcl_ts_team_showcase');