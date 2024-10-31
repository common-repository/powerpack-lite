<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPC_Lite_Script {

	function __construct() {

		// Action to define global javascript variable
		add_action( 'wp_print_scripts', array($this, 'pwpcl_global_script'), 5 );

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_front_styles') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pwpcl_front_scripts') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_admin_styles') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_admin_scripts') );
	}

	/**
	 * Function to define global javascript variable
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpcl_global_script() {

		$pwpc_rtl 			= (is_rtl()) 			? 1 : 0;
		$pwpc_mobile 		= (wp_is_mobile()) 		? 1 : 0;
		$pwpcl_old_browser 	= pwpcl_old_browser() 	? 1 : 0;
		$pwpc_ajaxurl 		= admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) );

		$script  = "<script type='text/javascript'>";
		$script .= "var pwpc_is_rtl = {$pwpc_rtl};";
		$script .= "var pwpc_mobile = {$pwpc_mobile};";
		$script .= "var pwpcl_old_browser = {$pwpcl_old_browser};";
		$script .= "var pwpc_ajaxurl = '{$pwpc_ajaxurl}';";
		$script .= "</script>";

		echo $script;
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpcl_front_styles() {

		// Registring and enqueing font awesome css
		if( !wp_style_is( 'wpos-font-awesome', 'registered' ) ) {
			wp_register_style( 'wpos-font-awesome', PWPCL_URL.'assets/css/font-awesome.min.css', null, PWPCL_VERSION );
		}

		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', PWPCL_URL.'assets/css/magnific-popup.css', array(), PWPCL_VERSION );
		}

		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', PWPCL_URL.'assets/css/slick.css', array(), PWPCL_VERSION );
		}

		// Registring and enqueing video js css
		if( !wp_style_is( 'wpos-videojs-style', 'registered' ) ) {
			wp_register_style( 'wpos-videojs-style', PWPCL_URL.'assets/css/video-js.css', array(), PWPCL_VERSION );
		}

		// Registring and enqueing tooltip css
		if( !wp_style_is( 'wpos-tooltip-style', 'registered' ) ) {
			wp_register_style( 'wpos-tooltip-style', PWPCL_URL.'assets/css/tooltipster.min.css', null, PWPCL_VERSION );
		}

		// Registring public style
		wp_register_style( 'pwpc-public-style', PWPCL_URL.'assets/css/pwpc-public.css', null, PWPCL_VERSION );
		wp_enqueue_style('pwpc-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpcl_front_scripts() {

		// Enqueue built in script
		wp_enqueue_script( 'jquery' );

		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', PWPCL_URL.'assets/js/slick.min.js', array('jquery'), PWPCL_VERSION, true );
		}

		// Registring video js script
		if( !wp_script_is( 'wpos-videojs-script', 'registered' ) ) {
			wp_register_script( 'wpos-videojs-script', PWPCL_URL.'assets/js/video.js', array('jquery'), PWPCL_VERSION, true );
		}

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', PWPCL_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), PWPCL_VERSION, true );
		}

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-ticker-script', 'registered' ) ) {
			wp_register_script( 'wpos-ticker-script', PWPCL_URL.'assets/js/pwpc-ticker.js', array('jquery'), PWPCL_VERSION, true );
		}

		// Registring tooltip script
		if( !wp_script_is( 'wpos-tooltip-script', 'registered' ) ) {
			wp_register_script( 'wpos-tooltip-script', PWPCL_URL.'assets/js/tooltipster.min.js', array('jquery'), PWPCL_VERSION, true );
		}

		// Filter JS
		if( !wp_script_is( 'wpos-filter-script', 'registered' ) ) {
			wp_register_script( 'wpos-filter-script', PWPCL_URL.'assets/js/jquery.mixitup.min.js', array('jquery'), PWPCL_VERSION, true );
		}

		// Registring magnific popup script
		wp_register_script( 'pwpc-public-script', PWPCL_URL.'assets/js/pwpc-public.js', array('jquery'), PWPCL_VERSION, true );
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpcl_admin_styles( $hook ) {

		global $current_screen;

		$pwpc_screen 	= is_pwpcl_screen();
		$screen_id 		= $current_screen ? $current_screen->id : '';

		// Registring select 2 style
		wp_register_style( 'pwpc-select2-style', PWPCL_URL.'assets/css/select2.min.css', null, PWPCL_VERSION );

		// Registring select 2 style
		wp_register_style( 'pwpc-tooltip-style', PWPCL_URL.'assets/css/tooltipster.min.css', null, PWPCL_VERSION );

		// Registring admin script on dashboard page
	    if( $screen_id == 'toplevel_page_pwpc-dashboard' ) {
			wp_enqueue_style( 'pwpc-tooltip-style' );
		}

		// If page is plugin setting page then enqueue script
		if( $pwpc_screen ) {

			// Registring admin script
			wp_register_style( 'pwpc-admin-style', PWPCL_URL.'assets/css/pwpc-admin.css', null, PWPCL_VERSION );
			wp_enqueue_style( 'pwpc-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpcl_admin_scripts( $hook ) {

		global $current_screen, $post_type, $wp_query, $wp_version;

		$post_support 	= PWPC_Lite()->post_supports; // Post type supports
		$pwpc_screen 	= is_pwpcl_screen();
		$screen_id    	= $current_screen ? $current_screen->id : '';
		$new_ui 		= $wp_version >= '3.5' ? '1' : '0';		

		// Filter JS
		wp_register_script( 'pwpc-filter-script', PWPCL_URL.'assets/js/jquery.mixitup.min.js', array('jquery'), PWPCL_VERSION, true );

		// Registring select 2 script
		wp_register_script( 'pwpc-select2-script', PWPCL_URL.'assets/js/select2.min.js', array('jquery'), PWPCL_VERSION, true );

		// Registring tooltip script
		wp_register_script( 'pwpc-tooltip-script', PWPCL_URL.'assets/js/tooltipster.min.js', array('jquery'), PWPCL_VERSION, true );

	    // Registring admin script on dashboard page
	    if( $screen_id == 'toplevel_page_pwpc-dashboard' ) {
			wp_enqueue_script( 'pwpc-filter-script' );
			wp_enqueue_script( 'pwpc-tooltip-script' );
		}

		// If page is plugin setting page then enqueue script
		if( $pwpc_screen ) {

			// Registring admin script
			wp_register_script( 'pwpc-admin-js', PWPCL_URL.'assets/js/pwpc-admin.js', array('jquery'), PWPCL_VERSION, true );
			wp_localize_script( 'pwpc-admin-js', 'PWPCAdmin', array(
															'new_ui' 				=>	$new_ui,
															'is_mobile' 			=> (wp_is_mobile()) ? 1 : 0,
															'syntax_highlighting'	=> ( 'false' === wp_get_current_user()->syntax_highlighting ) ? 0 : 1,
															'reset_msg'				=> __('Click OK to reset all options. All settings will be lost!', 'powerpack-lite'),
															'all_img_delete_text'	=> __('Are you sure to remove all images from this gallery!', 'powerpack-lite'),
														));
			wp_enqueue_script( 'pwpc-admin-js' );
		}
	}
}

$pwpc_lite_script = new PWPC_Lite_Script();