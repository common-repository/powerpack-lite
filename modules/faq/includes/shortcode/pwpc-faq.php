<?php
/**
 * Shortcode File
 *
 * Handles the 'pwpc_faq' shortcode of plugin
 *
 * @package PowerPack Lite
 * @subpackage FAQ
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * 'pwpc_faq' shortcode
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_shortcode( $atts, $content = null ) {

	// Shortcode Parameter
	$default_atts = shortcode_atts(array(
		'limit' 			=> '20',
		'category' 			=> '',
		'single_open'   	=> 'true',
		'transition_speed' 	=> '300',
		), $atts);
	extract($default_atts);

	// Enqueing required script
	wp_enqueue_script( 'pwpcl-faq-public-script' );

	$limit				= !empty($limit) 				? $limit 			: '20';
	$single_open		= !empty($single_open) 			? $single_open 		: 'true';
	$transition_speed	= !empty($transition_speed) 	? $transition_speed : '300';

	// FAQ Configuration
	$faq_conf = compact( 'single_open', 'transition_speed' );

	// Taking some globals
	global $post;

	// Taking some variable
	$unique			= pwpcl_get_unique();
	$main_wrap_cls	= "pwpc-faq-accordion pwpc-faq-accordion-list pwpc-faq-design-1 pwpc-clearfix";

	// WP Query Parameter
	$args = array (
				'post_type'			=> PWPCL_FAQ_POST_TYPE,
				'post_status'		=> array( 'publish' ),
				'orderby'			=> 'date',
				'order'				=> 'DESC',
				'posts_per_page' 	=> $limit,
			);

	// Category Parameter
	if($category != "") {

		$args['tax_query'] = array(
								array(
										'taxonomy' 	=> PWPCL_FAQ_CAT,
										'field' 	=> 'term_id',
										'terms' 	=> $category,										
									));

	}

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	ob_start();

	// If post is there
	if( $query->have_posts() ) { ?>

		<div class="<?php echo $main_wrap_cls; ?>" data-accordion-group>
			<div class="pwpc-faq-accordion-<?php echo $unique; ?> pwpc-faq-main-wrp" id="pwpc-faq-accordion-<?php echo $unique; ?>" data-conf="<?php echo htmlspecialchars(json_encode($faq_conf)); ?>">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="pwpc-faq-main" data-accordion>
						<div class="pwpc-faq-title" data-control>
							<h4><?php the_title(); ?></h4>
						</div>

						<div class="pwpc-faq-cnt-wrp" data-content>
							<div class="pwpc-faq-cnt-inr-wrp">
								<?php if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {
									the_post_thumbnail('thumbnail'); 
								} ?>
								<div class="pwpc-faq-content"><?php the_content(); ?></div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
<?php
	} // End of check have post

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_faq' shortcode
add_shortcode('pwpc_faq', 'pwpcl_faq_shortcode');