<?php
/**
 * 'pwpc_video_gallery' Shortcode
 * 
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `pwpc_video_gallery` shortcode
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_video_grid_shortcode( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit'    				=> '20',
		'category' 				=> '',
		'grid'     				=> '3',
		'popup_fix'				=> 'true',
		'show_title'    		=> 'true',
		'show_content'  		=> 'false',
		'pagination'			=> 'false',
	), $atts, 'pwpc_video_gallery'));

	$unique 			= pwpcl_get_unique();
	$popup_fix 			= ($popup_fix == 'false') 			? 'false' 		: 'true';
	$show_title 		= ( $show_title == 'false' )		? 'false'		: 'true';
	$show_content 		= ( $show_content == 'true' )		? 'true'		: 'false';
	$limit				= !empty($limit) 					? $limit 		: '20';
	$cat				= (!empty($category))				? $category 	: '';
	$grid 				= !empty($grid) 					? $grid 		: 3;
	$pagination			= ($pagination == 'true')			? 1				: 0;
	$video_grid 		= pwpcl_grid_column( $grid );

	// Popup Configuration
	$popup_conf = compact('popup_fix');

	// Enqueue required script
	wp_enqueue_script( 'wpos-videojs-script' );
	wp_enqueue_script( 'wpos-magnific-script' );
	wp_enqueue_script( 'pwpc-vgp-public-js' );

	// Taking some globals
	global $post;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

	// Taking some variables
	$prefix 	= PWPCL_VGP_META_PREFIX;
	$loop_count = 1;

	// WP Query Parameters
	$query_args = array(
				'post_type'     	 	=> PWPCL_VGP_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'posts_per_page' 		=> $limit,
				'order'         		=> 'DESC',
				'orderby'       		=> 'date',
				'paged'          		=> ($pagination) ? $paged : 1,
				'ignore_sticky_posts'	=> true,
			);

	// Category Parameter
	if( $cat != '' ) {
		$query_args['tax_query'] = array(
									array(
											'taxonomy' 			=> PWPCL_VGP_CAT,
											'field' 			=> 'term_id',
											'terms' 			=> $cat,
								));
	}

	// WP Query
	$video_query 	= new WP_Query($query_args);
	$post_count 	= $video_query->post_count;

	ob_start();

	// If post is there
	if( $video_query->have_posts() ) {
?>

	<div class="pwpc-vgp-video-grid-wrp pwpc-vgp-video-row pwpc-clearfix pwpc-vgp-cols-<?php echo $video_grid; ?>" id="pwpc-vgp-video-grid-<?php echo $unique; ?>">
	<?php while ($video_query->have_posts()) : $video_query->the_post();

			$video_link 		= '';
			$unique_id 			= pwpcl_get_unique();
			$wrap_cls 			= ($loop_count == 1) ? 'pwpc-first' : '';
			$feat_image 		= pwpcl_get_post_featured_image( $post->ID, 'full', true );
			$video_data 		= pwpcl_vgp_get_video_data( $post->ID );
			$video_embed_link	= $video_data['embed_link'];
			$video_content		= get_the_content();

			// If video link is array then get self hosted video
			if( is_array($video_data['link']) ) {
				$wpvideo_video_mp4 	= $video_data['link']['mp4'];
				$wpvideo_video_wbbm = $video_data['link']['webm'];
				$wpvideo_video_ogg 	= $video_data['link']['ogg'];
			} else {
				$video_link = $video_data['link'];
			}
		?>

		<div class="pwpc-vgp-video-wrap pwpc-col-<?php echo $video_grid; ?> pwpc-columns <?php echo $wrap_cls; ?>">
			<div class="pwpc-vgp-video-frame-wrap">
				<div class="pwpc-vgp-video-image-frame-wrap">
					<div class="pwpc-vgp-video-image-frame">
						<a href="javascript:void(0);" data-mfp-src="#video-modal-<?php echo $unique_id; ?>" class="pwpc-vgp-popup-modal">
							<?php if( $feat_image ) { ?>
							<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
							<?php } ?>
							<span class="pwpc-vgp-video-icon"></span>
						</a>
					</div>

					<?php if($show_title == 'true') { ?>
					<div class="pwpc-vgp-video-title"><div class="video-title-text"><?php the_title(); ?></div></div>
					<?php } ?>
				</div>

				<?php if($show_content == 'true' && $video_content) { ?>
				<div class="pwpc-vgp-video-content"><?php the_content(); ?></div>
				<?php } ?>
			</div>

			<div id="video-modal-<?php echo $unique_id; ?>" class="pwpc-vgp-popup-wrp mfp-hide pwpc-vgp-zoom-dialog pwpc-vgp-white-popup-block">
				<?php if( !empty($video_link) ) { ?>
					<iframe src="about:blank" data_src="<?php echo $video_embed_link; ?>" class="wpos-iframe-video" frameborder="0" allowfullscreen></iframe>
				<?php } else { ?>

					<video id="pwpc-vgp-video-<?php echo $unique_id; ?>" class="pwpc-vgp-video-frame video-js vjs-default-skin" width="100%" poster="<?php echo $feat_image; ?>" controls preload="none" data-setup="{}">
						<source src="<?php echo $wpvideo_video_mp4; ?>" type='video/mp4' />
						<source src="<?php echo $wpvideo_video_wbbm; ?>" type='video/webm' />
						<source src="<?php echo $wpvideo_video_ogg; ?>" type='video/ogg' />
					</video>

				<?php } ?>
			</div>
		</div>

		<?php
			$loop_count++;
			if( $loop_count == $grid ) {
				$loop_count = 0;
			}
		endwhile;
	?>
		<?php if($pagination) { ?>
		<div class="pwpc-vgp-paging pwpc-clearfix">
			<div class="pwpc-vgp-pagi-btn pwpc-vgp-prev-btn"><?php previous_posts_link( '&laquo; '.__('Previous', 'html5-videogallery-plus-player') ); ?></div>
			<div class="pwpc-vgp-pagi-btn pwpc-vgp-next-btn"><?php next_posts_link( __('Next', 'html5-videogallery-plus-player').' &raquo;', $video_query->max_num_pages ); ?></div>
		</div>
		<?php } ?>
		<div class="pwpc-vgp-popup-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
	</div>

<?php
		} // end have_post()

		wp_reset_query(); // reset wp query

		$content .= ob_get_clean();
		return $content;
}

// `pwpc_video_gallery` grid shortcode
add_shortcode('pwpc_video_gallery', 'pwpcl_vgp_video_grid_shortcode');