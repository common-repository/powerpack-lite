<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Footer Mega Grid Columns
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
* Function to add column class to widget area
* 
* @subpackage Footer Mega Grid Columns
* @since 1.0
*/
function pwpcl_fmgc_widgets_cls( $sidebar_id = 'pwpc-fmgc-widget' ) {
	global $_wp_sidebars_widgets;

	$sidebars_widgets_count = $_wp_sidebars_widgets;

	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) {
		$widget_count 	= count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'pwpc-widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );

		switch ($widget_count) {
			case '1':
			case '2':
			case '3':
				$widget_classes .= ' pwpc-icol-'.$widget_count;
				break;
			
			default:
				$widget_classes .= ' pwpc-icol-4';
				break;
		}
		return $widget_classes;
	}
}

/**
* Function to display widget area
* 
* @subpackage Footer Mega Grid Columns
* @since 1.0
*/
if ( !function_exists('pwpc_fmgc_display_widgets') ) {

	function pwpc_fmgc_display_widgets() {

		if ( is_active_sidebar( 'pwpc-fmgc-widget' ) ) : ?>
			<div class="pwpc-fmgc-mega-col">
				<div class="pwpc-fmgc-mega-col-wrap">
		           <?php dynamic_sidebar( 'pwpc-fmgc-widget' ); ?>
				 </div>  
			</div>
		<?php endif;
	}
}