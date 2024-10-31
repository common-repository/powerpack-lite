<?php
/**
 * Install Function
 *
 * @package PowerPack Lite
 * @since 1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package PowerPack Lite
 * @since 1.0.0
 */
function pwpcl_install() {

	// Deactivate free version
	if( is_plugin_active('powerpack-wpos/powerpack-wpos.php') ) {
		add_action('update_option_active_plugins', 'pwpcl_deactivate_pro_version');
	}

	pwpcl_run_install();

	// Getting active modules
	$active_modules = pwpcl_get_active_modules();

	// To call all active modules activation hook
	if( !empty($active_modules) ) {
		$pwpc_modules_activity = array(
									'recently_active_module' => $active_modules,
								);
		set_transient( 'pwpc_modules_activity', $pwpc_modules_activity, HOUR_IN_SECONDS );
	}

	do_action( 'pwpc_activation_hook' );
}
register_activation_hook( PWPCL_PLUGIN_FILE, 'pwpcl_install' );

/**
 * Deactivate free plugin
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_deactivate_pro_version() {
	deactivate_plugins('powerpack-wpos/powerpack-wpos.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_plugin_admin_notice() {

	global $pagenow;

	$dir				= WP_PLUGIN_DIR . '/powerpack-wpos/powerpack-wpos.php';
	$notice_transient	= get_transient( 'pwpc_install_notice' );

	// If PRO plugin is active and free plugin exist
	if ( $notice_transient == false && file_exists($dir) && $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {

		$notice_link = add_query_arg( array('message' => 'pwpc-install-notice'), admin_url('plugins.php') );

		echo '<div id="message" class="updated notice" style="position:relative;">
				<p><strong>Thank you for activating PowerPack Lite</strong>.<br /> It looks like you had Pro version <strong>(<em>PowerPack</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';
	}
}

// Action to display notice
add_action( 'admin_notices', 'pwpcl_plugin_admin_notice');

/**
 * Run the Install process
 *
 * @since  1.0
 */
function pwpcl_run_install() {

	global $wpdb, $pwpc_options;

	// Get settings for the plugin
	$pwpc_options = get_option( 'pwpc_opts' );
	
	if( empty( $pwpc_options ) ) { // Check plugin version option
		
		// set default settings
		pwpcl_default_settings();

		// Update plugin version to option
		update_option( 'pwpc_plugin_version', '1.0' );
	}
}

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
register_deactivation_hook( PWPCL_PLUGIN_FILE, 'pwpcl_uninstall' );

/**
 * Plugin Deactivation
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_uninstall() {
	// Plugin deactivation process
}

/**
 * Set redirect transition on update or activation
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_set_welcome_page_redirect() {

	// return if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) )
		return;

	// Add the transient to redirect
	set_transient( '_pwpc_activation_redirect', true, 30 );
}
//add_action('pwpc_activation_hook', 'pwpcl_set_welcome_page_redirect');

/**
 * Redirect to welcome page when plugin is activated
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_welcome_page_redirect() {

	// If plugin notice is dismissed
	if( isset($_GET['message']) && $_GET['message'] == 'pwpc-install-notice' ) {
		set_transient( 'pwpc_install_notice', true, 604800 );
	}

	// return if no activation redirect
	if ( ! get_transient( '_pwpc_activation_redirect' ) ) {
		return;
	}

	// Delete the redirect transient
	delete_transient( '_pwpc_activation_redirect' );

	// return if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}

	$redirect_link = pwpcl_get_plugin_link('about');

	// Redirect to about page
	wp_safe_redirect( $redirect_link );
}
add_action( 'admin_init', 'pwpcl_welcome_page_redirect' );