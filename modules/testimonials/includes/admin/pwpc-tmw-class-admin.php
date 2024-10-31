<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Tmw_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_tmw_add_testimonial_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'pwpcl_tmw_save_metabox_value') );

		// Action to add custom column to Testimonials listing
		add_filter( 'manage_posts_columns', array($this, 'pwpcl_tmw_posts_columns'), 10, 2 );

		// Action to add custom column data to Testimonials listing
		add_action('manage_'.PWPCL_TMW_POST_TYPE.'_posts_custom_column', array($this, 'pwpcl_tmw_post_columns_data'), 10, 2);

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_tmw_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_tmw_taxonomy_supports') );
	}

	/**
	 * Function to register metabox
	 * 
	 * @subpackage Testimonials
	 * @since 1.0
	 */
	function pwpcl_tmw_add_testimonial_metabox() {
		add_meta_box( 'testimonial-details', __( 'Testimonial Details - PwPc', 'powerpack-lite' ), array($this, 'pwpcl_tmw_meta_box_content'), PWPCL_TMW_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle metabox content
	 * 
	 * @subpackage Testimonials
	 * @since 1.0
	 */
	function pwpcl_tmw_meta_box_content() {
		include_once( PWPCL_TMW_DIR .'/includes/admin/metabox/pwpc-tmw-testimonial-metabox-html.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Testimonials
	 * @since 1.0
	 */
	function pwpcl_tmw_save_metabox_value( $post_id ){

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_TMW_POST_TYPE ) )              					// Check if current post type is supported.
		{
			return $post_id;
		}

		$prefix = PWPC_TMW_META_PREFIX; // Taking metabox prefix

		// Getting saved values
		$client 	= isset($_POST[$prefix.'testimonial_client']) 	? pwpcl_clean( $_POST[$prefix.'testimonial_client'] ) 	: '';
		$job 		= isset($_POST[$prefix.'testimonial_job'])		? pwpcl_clean( $_POST[$prefix.'testimonial_job'] ) 		: '';
		$company 	= isset($_POST[$prefix.'testimonial_company']) 	? pwpcl_clean( $_POST[$prefix.'testimonial_company'] ) 	: '';
		$url 		= isset($_POST[$prefix.'testimonial_url']) 		? pwpcl_clean_url( $_POST[$prefix.'testimonial_url'] ) 	: '';

		update_post_meta($post_id, $prefix.'testimonial_client', $client);
		update_post_meta($post_id, $prefix.'testimonial_job', $job);
		update_post_meta($post_id, $prefix.'testimonial_company', $company);
		update_post_meta($post_id, $prefix.'testimonial_url', $url);
	}

	/**
	 * Add custom column to Testimonials listing page
	 * 
	 * @subpackage Testimonials
	 * @since 1.0
	 */
	function pwpcl_tmw_posts_columns( $columns, $post_type ) {

		if( $post_type == PWPCL_TMW_POST_TYPE ) {

			$new_columns['pwpc_tmw_image'] = __('Image', 'powerpack-lite');

			$columns = pwpcl_add_array( $columns, $new_columns, 1, true);
		}
		return $columns;
	}

	/**
	 * Add custom column data to Testimonials listing page
	 * 
	 * @subpackage Testimonials
 	 * @since 1.0
	 */
	function pwpcl_tmw_post_columns_data( $column, $post_id ) {

		if($column == 'pwpc_tmw_image') {
			$value = pwpcl_get_post_featured_image($post_id, 40 ,'square');
			if($value != '') {
				echo '<img class="wp-post-image pwpc-tmw-avatar-image" height="40" width="40" src="'.$value.'" alt="" />';
			}
		}
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Testimonials
 	 * @since 1.0
	 */
	function pwpcl_tmw_add_screen_id( $screen_ids ) {

		$screen_ids[] = PWPCL_TMW_POST_TYPE;

		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Testimonials
 	 * @since 1.0
	 */
	function pwpcl_tmw_taxonomy_supports( $supports ) {
		$supports[PWPCL_TMW_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_tmw_admin = new PWPCL_Tmw_Admin();