<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @subpackage Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_CCJ_Script {
	
	function __construct() {		
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'pwpcl_ccj_admin_script') );
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @subpackage Custom CSS JS
	 * @since 1.0
	 */
	function pwpcl_ccj_admin_script( $hook ) {

		global $post_type;

		if( $hook == PWPCL_CCJ_PAGE_SLUG ) {

			// Common Admin style
			wp_enqueue_style( 'pwpc-admin-style' );


			// WP CSS Code Editor
			wp_enqueue_code_editor( array(
					'type' 			=> 'text/css',
					'codemirror' 	=> array(
						'indentUnit' 	=> 2,
						'tabSize'		=> 2,
					),
				) );

			// WP JS Code Editor
			wp_enqueue_code_editor( array(
					'type' 			=> 'json',
					'codemirror' 	=> array(
						'indentUnit' 	=> 2,
						'tabSize'		=> 2,
					),
				) );

			wp_enqueue_script( 'pwpc-admin-js' );
		}
	}
}

$pwpcl_ccj_script = new PWPCL_CCJ_Script();