<?php
/**
 * Admin Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Tu_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_tu_post_sett_metabox') );
		
		// Action to save metabox
		add_action( 'save_post', array($this, 'pwpcl_tu_save_meta_box_data') );
		
		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_tu_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_tu_taxonomy_supports') );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @subpackage Ticker Ultimate
	 * @since 1.0
	 */
	function pwpcl_tu_post_sett_metabox() {
		add_meta_box( 'pwpc-tu-post-sett', __( 'Ticker Settings - PwPc', 'powerpack-lite' ), array($this, 'pwpcl_tu_post_sett_mb_content'), PWPCL_TU_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @subpackage Ticker Ultimate
	 * @since 1.0
	 */
	function pwpcl_tu_post_sett_mb_content( $post ) {
		include_once( PWPCL_TU_DIR .'/includes/admin/metabox/pwpc-tu-post-sett.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Ticker Ultimate
	 * @since 1.0
	 */
	function pwpcl_tu_save_meta_box_data( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_TU_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = PWPCL_TU_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$read_more_link = isset($_POST[$prefix.'more_link']) ? pwpcl_clean_url( $_POST[$prefix.'more_link'] ) : '';

		update_post_meta($post_id, $prefix.'more_link', $read_more_link);
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Ticker Ultimate
 	 * @since 1.0
	 */
	function pwpcl_tu_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_TU_POST_TYPE;
		
		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Ticker Ultimate
 	 * @since 1.0
	 */
	function pwpcl_tu_taxonomy_supports( $supports ) {
		$supports[PWPCL_TU_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_tu_admin = new PWPCL_Tu_Admin();