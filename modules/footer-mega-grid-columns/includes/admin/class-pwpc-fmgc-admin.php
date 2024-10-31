<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Footer Mega Grid Columns
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Fmgc_Admin {

	function __construct() {
		
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpcl_fmgc_register_menu') );

		// Register widget sidebar area
		add_action( 'widgets_init', array($this , 'pwpcl_fmgc_widgets_init' ) );

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_fmgc_add_screen_id') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @subpackage Footer Mega Grid Columns
	 * @since 1.0
	 */
	function pwpcl_fmgc_register_menu() {
		add_submenu_page( PWPCL_PAGE_SLUG, __('Footer Mega Grid Columns - PwPc', 'powerpack-lite'), __('Footer Mega Grid', 'powerpack-lite'), 'manage_options', 'pwpc-fmgc-settings', array($this, 'pwpcl_fmgc_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @subpackage Footer Mega Grid Columns
	 * @since 1.0
	 */
	function pwpcl_fmgc_settings_page() {
		include_once( PWPCL_FMGC_DIR . '/includes/admin/pwpc-fmgc-how-it-work.php' );
	}

	/**
	* Function to register widget sidebar area
	* 
	* @subpackage Footer Mega Grid Columns
	* @since 1.0
	*/
	function pwpcl_fmgc_widgets_init() {

		// Some element to filter
		$fmgc_pro_widgets_args = apply_filters('pwpc_fmgc_options_default_values', array(
										'before_widget' => '<aside id="%1$s" class="widget pwpc-icolumns '.pwpcl_fmgc_widgets_cls().' %2$s">',
										'after_widget' 	=> '</aside>',
										'before_title' 	=> '<h4 class="widget-title">',
										'after_title' 	=> '</h4>',
									));

		// Default args
		$fmgc_pro_widgets_default_args = array(
										'name' 			=> __( 'Footer Mega Grid Columns', 'powerpack-lite' ).' - PwPc',
										'id' 			=> 'pwpc-fmgc-widget',
										'description' 	=> __( 'Footer Mega Grid Columns - Register a widget area for your theme and allow you to add and display widgets in your desired grid view.', 'powerpack-lite' ),
										'before_widget' => '<aside id="%1$s" class="widget pwpc-icolumns '.pwpcl_fmgc_widgets_cls().' %2$s">',
										'after_widget' 	=> '</aside>',
										'before_title' 	=> '<h4 class="widget-title">',
										'after_title' 	=> '</h4>',
									);
		$fmgc_pro_widgets_args = wp_parse_args( $fmgc_pro_widgets_args, $fmgc_pro_widgets_default_args );

		register_sidebar( $fmgc_pro_widgets_args ); // Register widget
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Footer Mega Grid Columns
 	 * @since 1.0
	 */
	function pwpcl_fmgc_add_screen_id( $screen_ids ) {
		
		$screen_ids[] = PWPCL_FMGC_PAGE_SLUG;

		return $screen_ids;
	}
}

$pwpcl_fmgc_admin = new PWPCL_Fmgc_Admin();