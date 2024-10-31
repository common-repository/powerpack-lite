<?php
/**
 * 'pwpc_portfolio' Shortcode
 * 
 * @subpackage  Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_pap_portfolio_shortcode( $atts, $content = '') {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'grid' 					=> 3,
		'limit' 				=> '20',
		'category' 				=> '',
		'link'					=> 'true',
		'image_size'			=> 'full',
		'image_fit'				=> 'true',
		'rtl'					=> '',
	), $atts, 'pwpc_portfolio'));

	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$main_grid 				= (!empty($grid) && $grid <= 4) 		? $grid 						: 3;
	$cat 					= (!empty($category))					? $category 					: '';
	$link 					= ($link == 'true')						? 1								: 0;	
	$image_size				= (!empty($image_size)) 				? $image_size 					: 'full';	
	$grid 					= pwpcl_grid_column($grid);
	$image_fit				= ($image_fit == 'true') ? true : false;

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 1;
	} elseif ( $rtl == 'true' ) {
		$rtl = 1;
	} else {
		$rtl = 0;
	}

	// Required enqueue_script
	wp_enqueue_script('pwpc-pap-portfolio-js');
	wp_enqueue_script('wpos-slick-jquery');
	wp_enqueue_script('pwpc-pap-public-js');

	// Thumb conf
	$thumb_conf = compact('main_grid');

	// Taking some variables
	$count 			= 1;
	$prefix 		= PWPCL_PAP_META_PREFIX;
	$unique_main 	= pwpcl_get_unique();
	$old_browser	= pwpcl_old_browser();
	
	$main_wrp_cls 	= "pwpc-pap-thumbs pwpc-pap-portfolio-inline";
	$main_wrp_cls	.= ($old_browser) 		? ' pwpc-pap-old-browser' 		: '';
	$main_wrp_cls	.= ($image_fit) 		? ' pwpc-pap-image-fit' 		: '';

	// Taking some globals
	global $post;

	// Query Parameter
	$args = array ( 
				'post_type'      		=> PWPCL_PAP_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'orderby'        		=> 'date', 
				'order'          		=> 'DESC',
				'posts_per_page' 		=> $posts_per_page,
				'ignore_sticky_posts'	=> true,
			);

	// Category Parameter
	if( !empty($cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> PWPCL_PAP_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $cat,
								));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();
?>

	<div class="pwpc-pap-main-wrapper pwpc-clearfix">		
		<ul id="pwpc-pap-thumbs-<?php echo $unique_main; ?>" class="<?php echo $main_wrp_cls; ?> pwpc-clearfix">

			<?php while ($query->have_posts()) : $query->the_post();

				$unique 				= pwpcl_pap_get_thumb_unique();
				$portfolio_img 			= pwpcl_get_post_featured_image($post->ID, $image_size );
				$terms 					= get_the_terms( $post->ID, PWPCL_PAP_CAT );
				$wrapper_cls 			= "pwpc-pap-portfolio-wrp thum-list pwpc-columns pwpc-col-{$grid}";
				$wrapper_cls 			.= (!$portfolio_img) ? ' pwpc-pap-no-image' : '';
				$cat_data 				= array();

				if( $count == 1 ) {
					$wrapper_cls .= ' pwpc-pap-first';
				} elseif ( $count == $main_grid ) {
					$count = 0;
					$wrapper_cls .= ' pwpc-pap-last';
				}

				if( $terms ) {
					foreach ( $terms as $term ) {
						$cat_data[] = '<span>'.$term->name.'</span>';
					}
				}
				$portfolio_cat = join(", ", $cat_data);

				// Include design file				
				include( PWPCL_PAP_DIR . '/templates/design-1.php' );

				$count++;
			endwhile;
			?>
			<div class="pwpc-pap-thumb-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($thumb_conf)); ?>"></div>
		</ul>

		<?php
		// Portfolio popup design file
		include( PWPCL_PAP_DIR . '/templates/popup/inline-portfolio.php' );
		?>
	</div>

<?php
	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_portfolio' shortcode
add_shortcode('pwpc_portfolio', 'pwpcl_pap_portfolio_shortcode');