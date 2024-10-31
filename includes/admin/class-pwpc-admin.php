<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPC_Lite_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpc_register_menu'), 5 );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pwpc_register_sub_menu'), 99 );

		// Filter to modify wordpress admin footer text
		add_filter( 'admin_footer_text', array( $this, 'pwpc_admin_footer_text' ), 1 );

		// Action add taxonomy hooks
		add_action( 'admin_init', array($this, 'pwpc_admin_taxonomy_hooks') );

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'pwpc_add_post_row_data'), 5, 2 );

		// Action to add menu at admin bar
		add_action( 'admin_bar_menu', array($this, 'pwpc_admin_bar_menu'), 99 );

		// Filter to add plugin action link
		add_filter( 'plugin_action_links_' . PWPCL_BASENAME, array($this, 'pwpc_plugin_action_links') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_register_menu() {
		add_menu_page( __('PowerPack Lite - By WP Online Support', 'powerpack-lite'), __('PowerPack Lite', 'powerpack-lite'), 'manage_options', PWPCL_PAGE_SLUG, array($this, 'pwpc_render_dashboard_page'), PWPCL_URL.'assets/images/powerpack-16.png', 4 );
	}

	/**
	 * Function to register admin sub menus
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_register_sub_menu() {
		// About Page
		add_submenu_page( PWPCL_PAGE_SLUG, __('About', 'powerpack-lite'), __('About', 'powerpack-lite'), 'manage_options', 'pwpc-about', array($this, 'pwpc_render_about_page') );
		
		// Premium features page
		add_submenu_page( PWPCL_PAGE_SLUG, __('Upgrade to PRO - PowerPack', 'powerpack-lite'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'powerpack-lite').'</span>', 'manage_options', 'pwpc-premium', array($this, 'pwpc_render_premium_page') );
	}

	/**
	 * Function to handle the main dashboard page
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_render_dashboard_page() {
		include_once( PWPCL_DIR . '/includes/admin/pwpc-dashboard.php' );
	}

	/**
	 * Function to handle the about page html
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_render_about_page() {
		include_once( PWPCL_DIR . '/includes/admin/pwpc-about.php' );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package Function to handle the about page html
	 * @since 1.2
	 */
	function pwpc_render_premium_page() {
		include_once( PWPCL_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Function to modify WordPress admin footer text
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_admin_footer_text( $footer_text ) {

		$pwpc_screen = is_pwpcl_screen();

		if( $pwpc_screen ) {
			$footer_text = $footer_text .' | '. sprintf( __('Thank you for using <a href="%s" target="_blank">PowerPack Lite</a>. Please <a href="%s" target="_blank">rate us</a>. A huge thanks in advance!', 'powerpack-lite'), 'http://powerpack.wponlinesupport.com/?utm_source=pwpc_fhp', 'https://wordpress.org/support/plugin/powerpack-lite/reviews/#new-post' );
		}
		return $footer_text;
	}

	/**
	 * Admin taxonomy hooks
	 * 
	 * @package PowerPack Lite
 	 * @since 1.0
	 */
	function pwpc_admin_taxonomy_hooks() {

		$tax_supports = PWPC_Lite()->taxonomy_supports; 	// Taxonomy supports

		if( !empty( $tax_supports ) ) {
			foreach ($tax_supports as $tax_key => $tax_data) {
				
				// Taxonomy columns
				if( !empty($tax_key) && isset($tax_data['shortcode_clmn']) ) {

					// Filter to add columns and data in category table
					add_filter('manage_edit-'.$tax_key.'_columns', array($this, 'pwpc_manage_category_columns'));
					add_filter('manage_'.$tax_key.'_custom_column', array($this, 'pwpc_cat_columns_data'), 10, 3);
				}

				// Taxonomy columns
				if( !empty($tax_key) && isset($tax_data['row_data_id']) ) {

					// Filter to add row action in category table
					add_filter( $tax_key.'_row_actions', array($this, 'pwpc_add_tax_row_data'), 5, 2 );
				}
			}
		} // End of if
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package PowerPack Lite
 	 * @since 1.0
	 */
	function pwpc_add_post_row_data( $actions, $post ) {

		$post_support = PWPC_Lite()->post_supports; // Post type supports

		// Post row data filter
		if( isset($post_support[$post->post_type]['row_data_post_id']) ) {
			return array_merge( array( 'pwpc_id' => 'ID: ' . $post->ID ), $actions );
		}
		return $actions;
	}

	/**
	 * Function to add category columns
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_manage_category_columns( $columns ) {

		global $taxonomy;

		$tax_support = PWPC_Lite()->taxonomy_supports; // Taxonomy supports

		$new_columns['pwpc_tax_shortcode'] = isset($tax_support[$taxonomy]['shortcode_clmn']['column_name']) ? $tax_support[$taxonomy]['shortcode_clmn']['column_name'] : __('Category Shortcode', 'powerpack-lite');
		
		$columns = pwpcl_add_array( $columns, $new_columns, 2 );
		
		return $columns;
	}

	/**
	 * Function to add category columns data
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_cat_columns_data( $ouput, $column_name, $tax_id ) {

		global $taxonomy;

		$tax_support = PWPC_Lite()->taxonomy_supports; // Taxonomy supports

		$column_cnt = isset($tax_support[$taxonomy]['shortcode_clmn']['column_cnt']) ? $tax_support[$taxonomy]['shortcode_clmn']['column_cnt'] : '';

		if( $column_name == 'pwpc_tax_shortcode' ){
			$ouput .= str_replace('{cat_id}', $tax_id, $column_cnt);
		}
		return $ouput;
	}

	/**
	 * Function to add category row action
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_add_tax_row_data( $actions, $tag ) {
		return array_merge( array( 'pwpc_id' => 'ID: ' . $tag->term_id ), $actions );
	}

	/**
	 * Function to add menu at admin bar
	 * 
	 * @package PowerPack Lite
 	 * @since 1.0
	 */
	function pwpc_admin_bar_menu() {

		if ( current_user_can( 'manage_options' ) ) {

			global $wp_admin_bar;

			$plugin_link = pwpcl_get_plugin_link();

			$wp_admin_bar->add_menu( array(
				'id'    => 'pwpc-admin-bar-menu',
				'title' => __('PowerPack', 'powerpack-lite'),
				'href'  => $plugin_link,
				'meta'   => array( 'tabindex' => null ),
			));
		}
	}

	/**
	 * Function to add license plugins link
	 * 
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	function pwpc_plugin_action_links( $links ) {

		$config_link 		= pwpcl_get_plugin_link();
		$links['config'] 	= '<a href="' . esc_url($config_link) . '" title="' . esc_attr( __( 'Configure Plugin', 'powerpack-lite' ) ) . '">' . __( 'Configure', 'powerpack-lite' ) . '</a>';

		return $links;
	}
}

$pwpc_lite_admin = new PWPC_Lite_Admin();