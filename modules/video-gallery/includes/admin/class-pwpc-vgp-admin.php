<?php
/**
 * Admin Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Vgp_Admin {
	
	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_vgp_post_sett_metabox') );
		
		// Action to save metabox
		add_action( 'save_post', array($this, 'pwpcl_vgp_save_meta_box_data') );
		
		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_vgp_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_vgp_taxonomy_supports') );
	}

	/**
	 * video Post Settings Metabox
	 * 
	 * @subpackage Video Gallery
	 * @since 1.0
	 */
	function pwpcl_vgp_post_sett_metabox() {
		add_meta_box( 'pwpc-vgp-post-sett', __( 'Video Gallery and Player Settings - PwPc', 'powerpack-lite' ), array($this, 'pwpcl_vgp_post_sett_mb_content'), PWPCL_VGP_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @subpackage Video Gallery
	 * @since 1.0
	 */
	function pwpcl_vgp_post_sett_mb_content( $post ) {
		include_once( PWPCL_VGP_DIR .'/includes/admin/metabox/pwpc-vgp-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Video Gallery
	 * @since 1.0
	 */
	function pwpcl_vgp_save_meta_box_data( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_VGP_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = PWPCL_VGP_META_PREFIX; // Taking metabox prefix
		
		// Taking variables		
		$video_mp4 	= isset($_POST[$prefix.'video_mp4']) 	? pwpcl_clean_url( $_POST[$prefix.'video_mp4'] ) 	: '';
		$video_wbbm = isset($_POST[$prefix.'video_wbbm']) 	? pwpcl_clean_url( $_POST[$prefix.'video_wbbm'] ) 	: '';
		$video_ogg 	= isset($_POST[$prefix.'video_ogg'])	? pwpcl_clean_url( $_POST[$prefix.'video_ogg'] ) 	: '';
		$video_oth 	= isset($_POST[$prefix.'video_oth']) 	? pwpcl_clean_url( $_POST[$prefix.'video_oth'] ) 	: '';
		$tab 		= isset($_POST[$prefix.'tab']) 			? pwpcl_clean($_POST[$prefix.'tab']) : '';
		
		update_post_meta($post_id, $prefix.'video_mp4', $video_mp4);
		update_post_meta($post_id, $prefix.'video_wbbm', $video_wbbm);
		update_post_meta($post_id, $prefix.'video_ogg', $video_ogg);
		update_post_meta($post_id, $prefix.'video_oth', $video_oth);
		update_post_meta($post_id, $prefix.'tab', $tab);
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Video Gallery
 	 * @since 1.0
	 */
	function pwpcl_vgp_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_VGP_POST_TYPE;
		
		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Video Gallery
 	 * @since 1.0
	 */
	function pwpcl_vgp_taxonomy_supports( $supports ) {
		$supports[PWPCL_VGP_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_vgp_admin = new PWPCL_Vgp_Admin();