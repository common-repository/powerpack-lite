<?php
/**
 * Admin Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_PAP_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_pap_post_sett_metabox') );
		
		// Action to save metabox
		add_action( 'save_post', array($this, 'pwpcl_pap_save_meta_box_data') );
		
		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_pap_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_pap_taxonomy_supports') );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this, 'pwpcl_pap_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_pwpcl_pap_get_attachment_edit_form', array($this, 'pwpcl_pap_get_attachment_edit_form'));
		
		// Ajax call to update attachment data
		add_action( 'wp_ajax_pwpcl_pap_save_attachment_data', array($this, 'pwpcl_pap_save_attachment_data'));
	}

	/**
	 * Portfolio Post Settings Metabox
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_post_sett_metabox() {
		add_meta_box( 'pwpc-pap-post-sett', __( 'Portfolio and Projects Settings - PwPc', 'powerpack-lite' ), array($this, 'pwpcl_pap_post_sett_mb_content'), PWPCL_PAP_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_post_sett_mb_content( $post ) {
		include_once( PWPCL_PAP_DIR .'/includes/admin/metabox/pwpc-pap-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_save_meta_box_data( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_PAP_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = PWPCL_PAP_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$gallery_imgs 			= isset($_POST['pwpc_pap_img']) ? array_map( 'intval', (array) $_POST['pwpc_pap_img'] ) : '';

		// Getting Slider Variables
		$arrow_slider 		  	= isset($_POST[$prefix.'arrow_slider']) 		  	? 1 	: 0;
		$pagination_slider 	  	= isset($_POST[$prefix.'pagination_slider']) 	 	? 1 	: 0;
		$autoplayspeed_slider 	= !empty($_POST[$prefix.'autoplayspeed_slider']) 	? pwpcl_clean_number( $_POST[$prefix.'autoplayspeed_slider'], 3000 ) 	: '';
		$speed_slider 		  	= isset($_POST[$prefix.'speed_slider']) 		  	? pwpcl_clean_number( $_POST[$prefix.'speed_slider'], 300 ) 			: '';
		$project_link 		  	= isset($_POST[$prefix.'project_url']) 		  		? pwpcl_clean_url( $_POST[$prefix.'project_url'] ) 						: '';

		update_post_meta($post_id, $prefix.'gallery_id', $gallery_imgs);
		update_post_meta($post_id, $prefix.'project_url', $project_link);

		// Updating Slider settings
 		update_post_meta($post_id, $prefix.'arrow_slider', $arrow_slider);
 		update_post_meta($post_id, $prefix.'pagination_slider', $pagination_slider);
 		update_post_meta($post_id, $prefix.'autoplayspeed_slider', $autoplayspeed_slider);
 		update_post_meta($post_id, $prefix.'speed_slider', $speed_slider);
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Portfolio and Projects
 	 * @since 1.0
	 */
	function pwpcl_pap_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_PAP_POST_TYPE;
		
		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Portfolio and Projects
 	 * @since 1.0
	 */
	function pwpcl_pap_taxonomy_supports( $supports ) {
		$supports[PWPCL_PAP_CAT] = array(
										'row_data_id' => true
									);
		return $supports;
	}

	/**
	 * Image data popup HTML
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_image_update_popup_html() {

		global $post_type;

		$registered_posts = array(PWPCL_PAP_POST_TYPE); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {
			include_once( PWPCL_PAP_DIR .'/includes/admin/settings/pwpc-pap-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_get_attachment_edit_form() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'powerpack-lite');
		$attachment_id 		= !empty($_POST['attachment_id']) ? pwpcl_clean_number($_POST['attachment_id']) : '';

		if( !empty($attachment_id) ) {
			$attachment_post = get_post( $_POST['attachment_id'] );

			if( !empty($attachment_post) ) {
				
				ob_start();

				// Popup Data File
				include( PWPCL_PAP_DIR . '/includes/admin/settings/pwpc-pap-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'powerpack-lite');
				$result['data']		= $attachment_data;
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @subpackage Portfolio and Projects
	 * @since 1.0
	 */
	function pwpcl_pap_save_attachment_data() {

		$prefix 			= PWPCL_PAP_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'powerpack-lite');
		$attachment_id 		= !empty($_POST['attachment_id']) ? pwpcl_clean_number($_POST['attachment_id']) : '';
		$form_data 			= parse_str($_POST['form_data'], $form_data_arr);

		if( !empty($attachment_id) && !empty($form_data_arr) ) {

			// Getting attachment post
			$pwpc_pap_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset($pwpc_pap_attachment_post->post_type) && $pwpc_pap_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> !empty($form_data_arr['pwpc_pap_attachment_title']) ? $form_data_arr['pwpc_pap_attachment_title'] : $pwpc_pap_attachment_post->post_name,
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {

					update_post_meta( $attachment_id, '_wp_attachment_image_alt', pwpcl_clean($form_data_arr['pwpc_pap_attachment_alt']) );

					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'powerpack-lite');
				}
			}
		}
		echo json_encode($result);
		exit;
	}
}

$pwpcl_pap_admin = new PWPCL_PAP_Admin();