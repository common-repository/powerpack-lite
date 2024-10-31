<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Bws_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_bws_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'pwpcl_bws_save_metabox_value') );

		// Action to add custom column to Slider listing
		add_filter( 'manage_posts_columns', array($this, 'pwpcl_bws_manage_posts_columns'), 10, 2 );

		// Action to add custom column data to Slider listing
		add_action('manage_'.PWPCL_BWS_POST_TYPE.'_posts_custom_column', array($this, 'pwpcl_bws_post_columns_data'), 10, 2);

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_bws_add_screen_id') );

		// Add some support to post like sorting and etc
		add_filter( 'pwpcl_post_supports', array($this, 'pwpcl_bws_post_supports') );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @subpackage Buttons with Style
	 * @since 1.0
	 */
	function pwpcl_bws_post_sett_metabox() {
		add_meta_box( 'pwpc-bws-post-sett', __( 'Buttons With Style Settings - PwPc', 'powerpack-lite' ), array($this, 'pwpc_bws_post_sett_mb_content'), PWPCL_BWS_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @subpackage Buttons with Style
	 * @since 1.0
	 */
	function pwpc_bws_post_sett_mb_content() {
		include_once( PWPCL_BWS_DIR .'/includes/admin/metabox/pwpc-bws-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Buttons with Style
	 * @since 1.0
	 */
	function pwpcl_bws_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_BWS_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = PWPCL_BWS_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$choice_button_type = isset($_POST[$prefix.'choice_button_type']) 	? pwpcl_clean($_POST[$prefix.'choice_button_type']) : '';
		$button_type 		= isset($_POST[$prefix.'button_type']) 			? pwpcl_clean($_POST[$prefix.'button_type']) 		: '';
		$button_class 		= isset($_POST[$prefix.'button_class']) 		? pwpcl_clean($_POST[$prefix.'button_class']) 		: '';
		$button_style 		= isset($_POST[$prefix.'button_style']) 		? pwpcl_clean($_POST[$prefix.'button_style']) 		: '';
		$button_size 		= isset($_POST[$prefix.'button_size']) 			? pwpcl_clean($_POST[$prefix.'button_size']) 		: '';
		$button_link_target = isset($_POST[$prefix.'button_link_target']) 	? pwpcl_clean($_POST[$prefix.'button_link_target']) : '';

		// Simple button settings
		$button_name 			= isset($_POST[$prefix.'button_name']) 			? pwpcl_clean( $_POST[$prefix.'button_name'] ) 			: '';
		$button_link 			= isset($_POST[$prefix.'button_link']) 			? pwpcl_clean_url( $_POST[$prefix.'button_link'] ) 		: '';		
		$extra_cls 				= isset($_POST[$prefix.'extra_cls']) 			? sanitize_html_class( $_POST[$prefix.'extra_cls'] ) 	: '';

		update_post_meta($post_id, $prefix.'choice_button_type', $choice_button_type);
		update_post_meta($post_id, $prefix.'button_name', $button_name);
		update_post_meta($post_id, $prefix.'button_link', $button_link);
		update_post_meta($post_id, $prefix.'button_type', $button_type);
		update_post_meta($post_id, $prefix.'button_class', $button_class);
		update_post_meta($post_id, $prefix.'button_style', $button_style);
		update_post_meta($post_id, $prefix.'button_size', $button_size);		
		update_post_meta($post_id, $prefix.'button_link_target', $button_link_target);
		update_post_meta($post_id, $prefix.'extra_cls', $extra_cls);
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @subpackage Buttons with Style
	 * @since 1.0
	 */
	function pwpcl_bws_manage_posts_columns( $columns, $post_type ) {

		if( $post_type == PWPCL_BWS_POST_TYPE ) {
			$new_columns['pwpc_bws_shortcode'] 	= __( 'Shortcode', 'powerpack-lite' );	   

		    $columns = pwpcl_add_array( $columns, $new_columns, 1, true );
		}
	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @subpackage Buttons with Style
	 * @since 1.0
	 */
	function pwpcl_bws_post_columns_data( $column, $post_id ) {

		$prefix = PWPCL_BWS_META_PREFIX; // Taking metabox prefix

	    switch ($column) {
			case 'pwpc_bws_shortcode':			
				$shortcode_string = '';
				$shortcode_string .= '[pwpc_bws_btn id="'.$post_id.'"]';
				echo $shortcode_string;
				break;
		}
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Buttons With Style Pro
 	 * @since 1.0
	 */
	function pwpcl_bws_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_BWS_POST_TYPE;

		return $screen_ids;
	}

	/**
	 * Function to add support to post like sorting etc
	 * 
	 * @subpackage Buttons With Style Pro
 	 * @since 1.0
	 */
	function pwpcl_bws_post_supports( $supports ) {

		$supports[PWPCL_BWS_POST_TYPE] = array(
											'row_data_post_id' => true
										);
		return $supports;
	}
}

$pwpcl_bws_admin = new PWPCL_Bws_Admin();