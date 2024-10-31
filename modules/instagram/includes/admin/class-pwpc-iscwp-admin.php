<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Iscwp_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpcl_iscwp_register_menu') );

		// Ajax call to update attachment data
		add_action( 'wp_ajax_pwpcl_iscwp_clear_cache', array($this, 'pwpcl_iscwp_clear_cache'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_pwpcl_iscwp_clear_all_cache', array($this, 'pwpcl_iscwp_clear_all_cache'));

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_iscwp_add_screen_id') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpcl_iscwp_register_menu() {
		add_submenu_page( PWPCL_PAGE_SLUG, __('Instagram Feed', 'powerpack-lite').' - PwPc', __('Instagram Feed', 'powerpack-lite'), 'manage_options', 'pwpc-iscwp-settings', array($this, 'pwpc_iscwp_setting_page'), 'dashicons-camera' );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpc_iscwp_setting_page() {
		include_once( PWPCL_ISCWP_DIR . '/includes/admin/settings/pwpc-iscwp-settings.php' );
	}

	/**
	 * delete user cache
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpcl_iscwp_clear_cache() {

		// Extracting the variables
		extract($_POST);

		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'powerpack-lite');

		if(isset($user_name) && $user_name != '') {

			$transient 		= "pwpc_iscwp_media_{$user_name}";
			delete_transient( "pwpc_iscwp_media_{$user_name}" );
			delete_transient( "pwpc_iscwp_media_data_{$user_name}" );

			$users 				= get_option('pwpc_iscwp_cache_transient');
			$srch_user 			= array_search($transient, $users);
			unset($users[$srch_user]);

			update_option( 'pwpc_iscwp_cache_transient', $users );

			$result['success'] 	= 1;
			$result['msg'] 		= __('Cache Cleared', 'powerpack-lite');
		};

		echo json_encode($result);
		exit;
	}

	/**
	 * Fulsh all user cache
	 * 
	 * @subpackage Instagram
	 * @since 1.0
	 */
	function pwpcl_iscwp_clear_all_cache() {

		extract($_POST);

		$result 			= array();
		$users 				= get_option('pwpc_iscwp_cache_transient');
		$result['success'] 	= 0;

		if( $users ) {

			foreach($users as $transt_key => $transient) {

				delete_transient( $transient );
				delete_transient("pwpc_iscwp_media_data_{$transt_key}");

				$srch_user = array_search($transient, $users);
				unset($users[$srch_user]);

				update_option( 'pwpc_iscwp_cache_transient', $users);
			}

			$result['success'] 	= 1;
			$result['msg'] 		= __('Cache Cleared', 'powerpack-lite');
		} else {
			$result['msg'] 		= __('Sorry, No cache data found', 'powerpack-lite');
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Instagram
 	 * @since 1.0
	 */
	function pwpcl_iscwp_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_ISCWP_PAGE_SLUG;

		return $screen_ids;
	}
}

$pwpcl_iscwp_admin = new PWPCL_Iscwp_Admin();