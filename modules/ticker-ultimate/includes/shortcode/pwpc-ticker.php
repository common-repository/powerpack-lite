<?php
/**
 * `pwpc_ticker` Shortcode
 * 
 * @package Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_tu_ticker( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(		
		'limit' 				=> '15',
		'category' 				=> '',
		'ticker_title'			=> __('Latest News', 'powerpack-lite'),
		'color'					=> '#000',
		'background_color'		=> '#2096CD',
		'effect'				=> 'fade',
		'fontstyle'				=> 'normal',
		'timer'					=> 4000,
		'title_color'			=> '#fff',
		'border'				=> 'true',
		'post_type'				=> '',
		'post_cat'				=> '',
	), $atts, 'pwpc_ticker'));

	$ticker_title		= !empty($ticker_title)				? $ticker_title					: '';
    $limit				= (!empty($limit)) 			  		? $limit 						: '15';
    $cat    			= (!empty($category))		  		? $category 					: '';
    $color 				= (!empty($color)) 			  		? $color 						: '#000';
	$background_color   = (!empty($background_color)) 		? $background_color 			: '#2096CD';
	$effect 			= (!empty($effect)) 		  		? $effect 						: 'fade';
	$fontstyle 			= (!empty($fontstyle))  	  		? $fontstyle 					: 'normal';
	$title_color		= (!empty($title_color)) 	  		? $title_color 					: '#fff';
	$border				= ($border == 'false') 	  	  		? 'false' 						: 'true';
	$post_type 			= (!empty($post_type)) 		  		? $post_type 					: PWPCL_TU_POST_TYPE;
	$post_cat 			= (!empty($post_cat)) 		  		? $post_cat 					: PWPCL_TU_CAT;
	$timer				= (!empty($timer)) 	    	  		? $timer 						: '4000';

	// Enqueue required script
	wp_enqueue_script('wpos-ticker-script');
	wp_enqueue_script('pwpc-tu-public-js');

	// Taking some globals
	global $post;

	// Taking some defaults
	$unique 	= pwpcl_get_unique();
	$wrap_cls 	= ($border == 'false') 	? 'wpos-bordernone' : '';
	$wrap_cls 	.= ($effect == 'slide') ? 'pwpc-tu-no-left-margin' : 'pwpc-tu-no-margin';

	// Ticker Cinfiguration
	$ticker_conf = compact( 'effect', 'fontstyle', 'timer');

	// Query Parameter
	$args = array (
		'post_type'     	 	=> $post_type,
		'post_status'			=> array( 'publish' ),
		'order'          		=> 'DESC',
		'orderby'        		=> 'date',
		'posts_per_page' 		=> $limit,
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if( !empty($cat) ) {

		$args['tax_query'] = array(
									array(
										'taxonomy' 	=> $post_cat,
										'field' 	=> 'term_id',
										'terms' 	=> $cat,
									));
	}

	// WP Query
	$query = new WP_Query($args);

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
		
		// Design File
		include(PWPCL_TU_DIR . '/includes/templates/style-1.php');

	} // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pwpc_ticker' shortcode
add_shortcode('pwpc_ticker', 'pwpcl_tu_ticker');