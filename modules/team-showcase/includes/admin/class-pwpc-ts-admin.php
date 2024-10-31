<?php
/**
 * Admin Class
 *
 * Handles the admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ts_Admin {

	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_ts_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'pwpcl_ts_save_metabox_value') );

		// Filter for team showcase post columns
		add_filter( 'manage_edit-'.PWPCL_TS_POST_TYPE.'_columns', array($this, 'pwpcl_ts_manage_post_columns') );
		add_action( 'manage_'.PWPCL_TS_POST_TYPE.'_posts_custom_column',  array($this, 'pwpcl_ts_post_columns_data'), 10, 2 );

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_ts_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_ts_taxonomy_supports') );
	}

	/**
	 * Team details settings metabox
	 * 
	 * @subpackage Team Showcase
	 * @since 1.0
	 */
	function pwpcl_ts_metabox() {
		add_meta_box( 'pwpc-ts-team-details', __( 'Team Member Details - PwPc', 'powerpack-lite' ), array($this, 'pwpcl_ts_render_team_details') , PWPCL_TS_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Team details settings metabox HTML
	 * 
	 * @subpackage Team Showcase
	 * @since 1.0
	 */
	function pwpcl_ts_render_team_details() {
		include_once( PWPCL_TS_DIR .'/includes/admin/metabox/pwpc-ts-team-details-metabox.php');
	}
	
	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Team Showcase
	 * @since 1.0
	 */
	function pwpcl_ts_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_TS_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = PWPCL_TS_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$member_department 	= isset($_POST['member_department']) 	? pwpcl_clean($_POST['member_department']) 		: '';
		$member_designation = isset($_POST['member_designation']) 	? pwpcl_clean($_POST['member_designation']) 	: '';
		$member_skills 		= isset($_POST['skills']) 				? pwpcl_clean($_POST['skills']) 				: '';
		$member_experience 	= isset($_POST['member_experience']) 	? pwpcl_clean($_POST['member_experience']) 		: '';		
		$tab 				= isset($_POST[$prefix.'tab']) 			? pwpcl_clean($_POST[$prefix.'tab']) 			: '';
		$social 			= array();

		// Validating social fields
		if( !empty( $_POST[$prefix.'social'] ) ) {
			foreach ($_POST[$prefix.'social'] as $social_key => $social_val) {
				if( $social_key == 'mail' ) {
					$social[$social_key] = is_email($social_val) ? $social_val : '';
				} else {
					$social[$social_key] = pwpcl_clean_url($social_val);
				}
			}
		}

		// Updating meta
		update_post_meta($post_id, $prefix.'member_department', $member_department);
		update_post_meta($post_id, $prefix.'member_designation', $member_designation);
		update_post_meta($post_id, $prefix.'skills', $member_skills);
		update_post_meta($post_id, $prefix.'member_experience', $member_experience);
		update_post_meta($post_id, $prefix.'social', $social);
		update_post_meta($post_id, $prefix.'tab', $tab);
	}

	/**
	 * Add extra column to team showcase post list
	 * 
	 * @subpackage Team Showcase
	 * @since 1.0
	 */
	function pwpcl_ts_manage_post_columns( $columns ) {

		$new_columns['pwpc_ts_image'] 	= __( 'Team Member Image', 'powerpack-lite' );
		
		$columns = pwpcl_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to team showcase post list
	 * 
	 * @subpackage Team Showcase
	 * @since 1.0
	 */
	function pwpcl_ts_post_columns_data( $column_name, $post_id ) {

		switch ($column_name) {
			case 'pwpc_ts_image':
				echo get_the_post_thumbnail( $post_id, array(50, 50) );
				break;
		}
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Team Showcase
 	 * @since 1.0
	 */
	function pwpcl_ts_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_TS_POST_TYPE;

		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Team Showcase
 	 * @since 1.0
	 */
	function pwpcl_ts_taxonomy_supports( $supports ) {
		$supports[PWPCL_TS_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_ts_admin = new PWPCL_Ts_Admin();