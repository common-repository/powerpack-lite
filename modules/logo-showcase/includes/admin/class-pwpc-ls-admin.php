<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Ls_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'pwpcl_ls_post_sett_metabox'), 10, 2 );

		// Action to save metabox value
		add_action( 'save_post', array($this, 'pwpcl_ls_save_meta_box_data') );

		// Action to add custom column to Logo listing
		add_filter( 'manage_posts_columns', array($this, 'pwpcl_ls_posts_columns'), 10, 2 );

		// Action to add custom column data to Logo listing
		add_action('manage_'.PWPCL_LS_POST_TYPE.'_posts_custom_column', array($this, 'pwpcl_ls_post_columns_data'), 10, 2);

		// Filter to add screen id
		add_filter('pwpc_screen_ids', array( $this, 'pwpcl_ls_add_screen_id') );

		// Add some support to taxonomy like shortcode column and etc
		add_filter( 'pwpcl_taxonomy_supports', array($this, 'pwpcl_ls_taxonomy_supports') );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpcl_ls_post_sett_metabox( $post_type, $post ) {
		add_meta_box( 'pwpc-ls-post-sett', __('Logo Showcase Settings - PwPc', 'powerpack-lite'), array($this, 'pwpc_ls_post_sett_mb_content'), PWPCL_LS_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpc_ls_post_sett_mb_content( $post ) {
		include_once( PWPCL_LS_DIR .'/includes/admin/metabox/pwpc-ls-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpcl_ls_save_meta_box_data( $post_id ){

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  PWPCL_LS_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = PWPCL_LS_META_PREFIX; // Taking metabox prefix

		// Taking data		
		$logo_link 	= isset($_POST[$prefix.'logo_link']) ? pwpcl_clean_url( $_POST[$prefix.'logo_link'] ) : '';

		// Updating Post Meta
		update_post_meta( $post_id, $prefix.'logo_link', $logo_link );
	}

	/**
	 * Add custom column to Logo listing page
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpcl_ls_posts_columns( $columns, $post_type ) {

		if( $post_type == PWPCL_LS_POST_TYPE ) {
			$new_columns['pwpc_ls_image'] = __( 'Image', 'powerpack-lite' );
		    $columns = pwpcl_add_array( $columns, $new_columns, 1, true );
		}
	    return $columns;
	}

	/**
	 * Add custom column data to Logo listing page
	 * 
	 * @subpackage Logo Showcase
	 * @since 1.0
	 */
	function pwpcl_ls_post_columns_data( $column, $post_id ) {

	    switch ($column) {

	    	case 'pwpc_ls_image':
	    		$logo_image = pwpcl_get_post_featured_image( $post_id, array(50, 50) );
	    		if( $logo_image ) {
	    			echo "<img src='{$logo_image}' class='pwpc-ls-logo-image' alt='' />";
	    		}
				break;
	    }
	}

	/**
	 * Function to add screen id
	 * 
	 * @subpackage Logo Showcase
 	 * @since 1.0
	 */
	function pwpcl_ls_add_screen_id( $screen_ids ) {

		$screen_ids[] = PWPCL_LS_POST_TYPE;

		return $screen_ids;
	}

	/**
	 * Function to add support to taxonomy like shortcode column etc
	 * 
	 * @subpackage Logo Showcase
 	 * @since 1.0
	 */
	function pwpcl_ls_taxonomy_supports( $supports ) {
		$supports[PWPCL_LS_CAT] = array(
									'row_data_id' => true
									);
		return $supports;
	}
}

$pwpcl_ls_admin = new PWPCL_Ls_Admin();