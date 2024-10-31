<?php
/**
 * Plugin Name: PowerPack Lite
 * Plugin URI: https://www.wponlinesupport.com/plugins
 * Description: Everything you need for website from header to footer. Enhance your website with PowerPack features. Also work with Gutenberg shortcode block. 
 * Author: WP OnlineSupport
 * Author URI: https://www.wponlinesupport.com/
 * Text Domain: powerpack-lite
 * Domain Path: /languages/
 * Version: 1.3
 * 
 * @package WordPress
 * @author WP OnlineSupport
 */

if ( ! class_exists( 'PowerPack_Lite' ) ) :

/**
 * Main PowerPack Class By WP Online Support.
 *
 * @since 1.0
 */
final class PowerPack_Lite {

	/**
	 * @var Instance
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * Plugin Register Modules
	 *
	 * @since 1.0
	 */
	public $register_modules = array();

	/**
	 * Plugin Active Modules
	 *
	 * @since 1.0
	 */
	public $active_modules = array();

	/**
	 * Plugin Inactive Modules
	 *
	 * @since 1.0
	 */
	public $inactive_modules = array();

	/**
	 * Plugin post supports
	 *
	 * @since 1.0
	 */
	public $post_supports;

	/**
	 * Plugin taxonomy supports
	 *
	 * @since 1.0
	 */
	public $taxonomy_supports;

	/**
	 * Main PowerPack Instance.
	 *
	 * Insures that only one instance of PowerPack exists in memory at any one time.
	 * Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0
	 * @uses PowerPack::setup_constants() Setup the constants needed.
	 * @uses PowerPack::includes() Include the required files.
	 * @uses PowerPack::pwpc_plugins_loaded() load the language files.
	 * @see PWPC_Lite()
	 * @return object|PowerPack The one true PowerPack
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'powerpack-lite' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since 1.0
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'powerpack-lite' ), '1.0' );
	}

	/**
	 * Plugin Constructor.
	 */
	public function __construct() {
		$this->setup_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'powerpack_loaded' );
	}

	/**
	 * Setup plugin constants. Basic plugin definitions
	 *
	 * @access private
	 * @since 1.0
	 */
	private function setup_constants() {

		$this->define( 'PWPCL_VERSION', '1.3' );
		$this->define( 'PWPCL_PLUGIN_FILE', __FILE__ );
		$this->define( 'PWPCL_DIR', plugin_dir_path( __FILE__ ) );
		$this->define( 'PWPCL_URL', plugin_dir_url( __FILE__ ) );
		$this->define( 'PWPCL_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'PWPCL_META_PREFIX', '_pwpc_' );
		$this->define( 'PWPCL_PAGE_SLUG', 'pwpc-dashboard' );
	}

	/**
	 * Loads the plugin language files.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function pwpc_load_plugin_textdomain() {
		global $wp_version;

    	// Set filter for plugin's languages directory
	    $pwpc_lang_dir = dirname( plugin_basename( PWPCL_PLUGIN_FILE ) ) . '/languages/';
	    $pwpc_lang_dir = apply_filters( 'pwpc_languages_directory', $pwpc_lang_dir );

	    // Traditional WordPress plugin locale filter.
	    $get_locale = get_locale();

	    if ( $wp_version >= 4.7 ) {
	        $get_locale = get_user_locale();
	    }

	    // Traditional WordPress plugin locale filter
	    $locale = apply_filters( 'plugin_locale',  $get_locale, 'powerpack-lite' );
	    $mofile = sprintf( '%1$s-%2$s.mo', 'powerpack-lite', $locale );

	    // Setup paths to current locale file
	    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( PWPCL_DIR ) . '/' . $mofile;

	    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
	        load_textdomain( 'powerpack-lite', $mofile_global );
	    } else { // Load the default language files
	        load_plugin_textdomain( 'powerpack-lite', false, $pwpc_lang_dir );
	    }
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	public function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 1.0
	 */
	private function includes() {

		global $pwpc_options;

		require_once PWPCL_DIR . 'includes/pwpc-functions.php';
		require_once PWPCL_DIR . 'includes/admin/settings/register-settings.php';
		$pwpc_options = pwpcl_get_settings();

		require_once PWPCL_DIR . 'includes/install.php';
		require_once PWPCL_DIR . 'includes/class-pwpc-script.php';
		
		require_once PWPCL_DIR . 'includes/admin/class-pwpc-admin-help.php';
		require_once PWPCL_DIR . 'includes/admin/class-pwpc-admin-pointers.php';
		require_once PWPCL_DIR . 'includes/admin/pwpc-how-it-work.php';
		require_once PWPCL_DIR . 'includes/admin/class-pwpc-admin.php';
	}

	/**
	 * Hook into actions and filters.
	 * @since  1.0
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'pwpc_plugins_loaded' ), 12 );
		add_action( 'init', array( $this, 'pwpc_init' ), 5 );
		add_action( 'admin_init', array( $this, 'pwpc_admin_init' ), 5 );
	}

	/**
	 * Loads the plugin language files.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function pwpc_plugins_loaded() {

		$this->pwpc_load_plugin_textdomain(); // Load plugin text domain
		$this->define( 'PWPCL_SCREEN_ID', sanitize_title(__('PowerPack Lite', 'powerpack-lite')) ); // Defining page slug after localization

		// If settings is reset
		if(isset($_POST['pwpc_resett_sett']) && !empty($_POST['pwpc_resett_sett'])) {
			
			// Assign old modules to temp cache so deactivation hook is called
			$pwpc_modules_activity = array(							
										'recently_deactive_module'	=> pwpcl_get_active_modules(),
									);
			set_transient( 'pwpc_modules_activity', $pwpc_modules_activity, HOUR_IN_SECONDS );

			pwpcl_default_settings(); // Set default settings
		}

	    // Getting active / inactive modules
	    $this->register_modules = pwpcl_register_modules();
		$this->active_modules 	= pwpcl_get_active_modules();
		$this->inactive_modules = pwpcl_get_inactive_modules();

		$register_modules 		= $this->register_modules;

		// Load active modules
		if( !empty($this->active_modules) ) {
			foreach ($this->active_modules as $module_key => $module_val) {

				$module_key = sanitize_title( $module_key );

				if( !empty($module_val) && !empty($module_key) && isset($register_modules[$module_key]) && !empty($register_modules[$module_key]['path']) ) {
					include_once( $register_modules[$module_key]['path'] );
				}
			}
		} // End of if

		// Deactivation process of module
		$pwpc_modules_activity = get_transient( 'pwpc_modules_activity' );

		if( !empty($pwpc_modules_activity['recently_deactive_module']) ) {

			$recently_deactive_module = $pwpc_modules_activity['recently_deactive_module'];

			// If module is going to be deactive then include uninstall file for deactivation
			foreach ($recently_deactive_module as $deactive_module_key => $deactive_module_val) {

				if( !empty($deactive_module_key) && isset($register_modules[$deactive_module_key]) && !empty($register_modules[$deactive_module_key]['path']) ) {
					$module_path 			= plugin_dir_path( $register_modules[$deactive_module_key]['path'] );
					$module_uninstall_file 	= $module_path.'uninstall.php';
					
					if( $module_path && file_exists($module_uninstall_file) ) {
						include_once( $module_uninstall_file );
					}
				}
			}
		} // End of if
	}

	/**
	 * Init PowerPack when WordPress Initialises.
	 */
	public function pwpc_init() {

		// Before init action.
		do_action( 'before_pwpc_init' );

		// Activation and deactivation hook of module
		$pwpc_modules_activity = get_transient( 'pwpc_modules_activity' );

		if( !empty($pwpc_modules_activity) ) {

			$recently_active_module 	= isset($pwpc_modules_activity['recently_active_module']) 	? $pwpc_modules_activity['recently_active_module'] 		: array();
			$recently_deactive_module 	= isset($pwpc_modules_activity['recently_deactive_module']) ? $pwpc_modules_activity['recently_deactive_module'] 	: array();

			// Module deactivation hook
			if( !empty($recently_deactive_module) ) {
				foreach ($recently_deactive_module as $deactive_module_key => $deactive_module_val) {
					do_action( 'pwpc_module_deactivation_hook_'.$deactive_module_key );
					do_action( 'pwpc_module_deactivation_hook', $deactive_module_key );
				}
			}

			// Module activation hook
			if( !empty($recently_active_module) ) {
				foreach ($recently_active_module as $active_module_key => $active_module_val) {
					do_action( 'pwpc_module_activation_hook_'.$active_module_key );
					do_action( 'pwpc_module_activation_hook', $active_module_key );
				}
			}

			set_transient( 'pwpc_modules_activity', '', HOUR_IN_SECONDS ); // Flush the temp activity
		}

		// Init action.
		do_action( 'pwpc_init' );
	}

	/**
	 * PowerPack init hook at admin side
	 */
	public function pwpc_admin_init() {

		// Before init action.
		do_action( 'before_pwpc_admin_init' );

		$this->post_supports 		= pwpcl_post_supports(); 	// Post type supports
		$this->taxonomy_supports 	= pwpcl_taxonomy_supports(); // Taxonomy supports

		// Init action.
		do_action( 'pwpc_admin_init' );
	}
}

endif; // End if class_exists check.

/**
 *
 * The main function responsible for returning the one true PowerPack
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $pwpc_wpos = PWPC_Lite(); ?>
 *
 * @since 1.0
 * @return object|PowerPack The one true PowerPack Instance.
 */
function PWPC_Lite() {
	return PowerPack_Lite::instance();
}

// Get plugin Running.
PWPC_Lite();

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl54_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'            => 54,
							'file'          => plugin_basename( __FILE__ ),
							'name'          => 'PowerPack',
							'slug'          => 'powerpack-lite',
							'type'          => 'plugin',
							'menu'          => 'pwpc-dashboard',
							'text_domain'   => 'powerpack-lite',
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl54_load();
/* Plugin Wpos Analytics Data Ends */