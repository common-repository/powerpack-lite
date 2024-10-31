<?php
/**
 * Add some content to the help tab
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPC_Lite_Admin_Help {

	function __construct() {
	
		// Action to add help tab
		add_action( 'current_screen', array( $this, 'pwpcl_add_help_tabs' ), 50 );
	}

	/**
	 * Add Contextual help tabs.
	 */
	public function pwpcl_add_help_tabs() {

		global $current_screen;

		$screen 		= isset($current_screen->id) ? $current_screen->id : '';
		$main_screens 	= pwpcl_main_screen_ids();

		// If not powerpack main screen then return
		if( !in_array($screen, $main_screens) ) {
			return;
		}

		// Taking some variables
		$tour_link = pwpcl_get_plugin_link('tour');

		$current_screen->add_help_tab( array(
			'id'        => 'pwpc_support_tab',
			'title'     => __( 'Help &amp; Support', 'powerpack-lite' ),
			'content'   =>
				'<h2>' . __( 'Help &amp; Support', 'powerpack-lite' ) . '</h2>' .
				'<p>' . sprintf(
					__( 'Should you need help understanding, using, or extending PowerPack, <a href="%s" target="_blank">please read our documentation</a>. You will find all kinds of resources including snippets, tutorials and much more.', 'powerpack-lite' ),
					'http://docs.wponlinesupport.com/category/powerpack-lite/?utm_source=pwpc_hp'
				) . '</p>' .
				'<p>' . __( 'Before asking for help we recommend you to check plugin documentation.', 'powerpack-lite' ) . '</p>' .
				'<p><a href="http://docs.wponlinesupport.com/category/powerpack-lite/?utm_source=pwpc_hp" target="_blank" class="button button-primary pwpc-icon-btn pwpc-btn"><i class="dashicons dashicons-admin-page"></i> ' . __( 'Plugin Documentation', 'powerpack-lite' ) . '</a> <a href="'.$tour_link.'" class="button button-primary pwpc-icon-btn pwpc-btn"><i class="dashicons dashicons-lightbulb"></i> ' . __( 'Newbie? Take a Tour', 'powerpack-lite' ) . '</a></p>'
		));

		$current_screen->add_help_tab( array(
			'id'        => 'pwpc_bugs_tab',
			'title'     => __( 'Found a bug?', 'powerpack-lite' ),
			'content'   =>
				'<h2>' . __( 'Found a bug?', 'powerpack-lite' ) . '</h2>' .
				'<p>' . sprintf( __( 'If you find a bug within PowerPack you can create a support at WordPress plugin support forum.', 'powerpack-lite' ) ) . '</p>'
		));

		$current_screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'powerpack-lite' ) . '</strong></p>' .
			'<p><a href="' . 'http://powerpack.wponlinesupport.com/?utm_source=pwpc_hp' . '" target="_blank">' . __( 'About PowerPack', 'powerpack-lite' ) . '</a></p>' .
			'<p><a href="'.$tour_link.'">' . __( 'Newbie? Take a Tour', 'powerpack-lite' ) . '</a></p>' .
			'<p><a href="http://docs.wponlinesupport.com/category/powerpack-lite/?utm_source=pwpc_hp" target="_blank">' . __( 'Plugin Documentation', 'powerpack-lite' ) . '</a></p>'
		);
	}
}

$pwpc_lite_admin_help = new PWPC_Lite_Admin_Help();