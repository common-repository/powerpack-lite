<?php
/**
 * Adds and controls pointers for contextual help/tutorials
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPC_Lite_Admin_Pointers {

	public function __construct() {

		// Action to print script at footer
		add_action( 'admin_footer', array($this, 'pwpc_setup_pointers_for_screen'), 25 );
	}

	/**
	 * Setup pointers for screen.
	 */
	public function pwpc_setup_pointers_for_screen() {
		if ( ! $screen = get_current_screen() ) {
			return;
		}

		if( $screen->id == 'toplevel_page_pwpc-dashboard' ) {
			$this->pwpc_product_help_tutorial();
		}
	}

	/**
	 * Pointers for creating a product.
	 */
	public function pwpc_product_help_tutorial() {
		
		if ( isset($_GET['message']) && $_GET['message'] == 'pwpc-tutorial' && !isset($_GET['settings-updated']) && current_user_can('manage_options') ) {
			
			// These pointers will chain - they will not be shown at once.
			$pointers = array(
				'pointers' => array(
					'title' => array(
						'target'       	=> ".pwpc-dashboard-header",
						'previous'		=> '',
						'next'         	=> 'search',
						'next_trigger'	=> array(),
						'options'      	=> array(
							'content' 	=> '<h3>' . esc_html__( 'Welcome to PowerPack', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'You are about to use most powerful plugin for WordPress ever - With most popular modules for frontend and backend by WP Online Support.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'top',
								'align' => 'left',
							),
						),
					),
					'search' => array(
						'target'       => ".pwpc-dashboard-search-icon",
						'next'         => 'active-module',
						'previous'		=> 'title',
						'next_trigger' => array(),
						'options'      => array(
							'content'  => '<h3>' . esc_html__( 'Module Search', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'You can easily search your favourite modules by clicking the search icon.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'Start typing module name and it will pick module within current tab.', 'powerpack-lite' ) . '</p>',
							'position' => array(
								'edge'  => 'right',
								'align' => 'left',
							),
						),
					),
					'active-module' => array(
						'target'       	=> "#pwpc-module-nav-active_modules",
						'next'         	=> 'modules',
						'previous'		=> 'search',
						'next_trigger' 	=> array(),
						'options'  		=> array(
							'content'  	=> '<h3>' . esc_html__( 'Modules Categories - Active Modules', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'These are the various categories of modules. e.g Site modules, Widgets, Styling modules and etc.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'This is the Active module category. Your activated modules will be displayed over here.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'So you do not have to find active modules from each tab. You can easily manipulate over here.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'left',
								'align' => 'left',
							),
						),
					),
					'modules' => array(
						'target'       	=> "#pwpc-module-nav-modules",
						'next'         	=> 'site-module',
						'previous'		=> 'active-module',
						'next_trigger' 	=> array(),
						'options' 		=> array(
							'content'  	=> '<h3>' . esc_html__( 'Site Modules', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'This is the site modules category.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'Here you can see various modules like FAQ, Logoshowcase, Team Showcase or etc.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'You can find with search functionality.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'left',
								'align' => 'left',
							),
						),
					),
					'site-module' => array(
						'target'       	=> ".pwpc-site-modules-wrap .pwpc-site-module-wrap:first",
						'next'         	=> 'activate_module',
						'previous'		=> 'modules',
						'next_trigger' 	=> array(),
						'options' 		=> array(
							'content'  	=> '<h3>' . esc_html__( 'Site Module', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'This one of the site module. e.g FAQ', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'Module holds its respective name and description so you will be cleared from that.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'You can find more information about it by hovering the mouse on info button.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'bottom',
								'align' => 'middle',
							),
						),
					),
					'activate_module' => array(
						'target'       	=> ".pwpc-site-modules-wrap .pwpc-site-module-wrap:first .pwpc-check-slider",
						'next'         	=> 'save_module',
						'previous'		=> 'site-module',
						'next_trigger' 	=> array(),
						'options' 		=> array(
							'content'  	=> '<h3>' . esc_html__( 'Enable Module!', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'This is enable / disabled switch of module.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'Once you click, It will be turned to green means a sign of activation.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'Once you click module do not forget to save from top right \'Save Changes\' button.', 'powerpack-lite' ) . '</p>' .
											'<p>' . esc_html__( 'Once module is enabled, it\'s respective menu will be appeared at admin side. e.g If you enable FAQ then FAQ - PwPc menu will be appeared.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'left',
								'align' => 'left',
							),
						),
					),
					'save_module' => array(
						'target'       	=> "#pwpc-save-module-btn",
						'next'         	=> 'reset_module',
						'previous'		=> 'activate_module',
						'next_trigger' 	=> array(),
						'options' 		=> array(
							'content'  	=> '<h3>' . esc_html__( 'Save Settings', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'When you enable / disable module, hit the "Save Changes" button to make it live.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'right',
								'align' => 'right',
							),
						),
					),
					'reset_module' => array(
						'target'       	=> "#pwpc-resett-module-btn",
						'next'         	=> '',
						'previous'		=> 'save_module',
						'next_trigger' 	=> array(),
						'options' 		=> array(
							'content'  	=> '<h3>' . esc_html__( 'Reset Settings', 'powerpack-lite' ) . '</h3>' .
											'<p>' . esc_html__( 'Deactive all modules at just one click.', 'powerpack-lite' ) . '</p>',
							'position' 	=> array(
								'edge'  => 'right',
								'align' => 'right',
							),
						),
					),
				),
			);
			$this->pwpc_enqueue_pointers( $pointers );
		} // End of if
	}

	/**
	 * Adds pointer scripts
	 *
	 * @package PowerPack Lite
	 * @since 1.0
	 */
	public function pwpc_enqueue_pointers( $pointers ) {
		$pointers 		= wp_json_encode( $pointers );
		$dismis_btn 	= '<a style="padding:0 0 0 10px;" class="pwpc-close-help" href="#"><i class="dashicons dashicons-dismiss"></i> '.__('Dismiss', 'powerpack-lite').'</a>';
		$prev_btn 		= '<a style="padding:0 10px 0 0;" class="pwpc-prev-help" href="#"><i class="dashicons dashicons-arrow-left-alt"></i> '.__('Previous', 'powerpack-lite').'</a>';
		$next_btn 		= '<a style="padding:0 10px 0 0;" class="pwpc-next-help" href="#"><i class="dashicons dashicons-arrow-right-alt"></i> '.__('Next', 'powerpack-lite').'</a>';

		wp_enqueue_style( 'wp-pointer' );
		wp_enqueue_script( 'wp-pointer' );

		echo "<script type='text/javascript'>
			jQuery( function( $ ) {
				var prev 	= 0;
				var closed 	= 0;
				var count 	= 1;
				var pwpc_pointers = {$pointers};

				setTimeout( init_pwpc_pointers, 800 );

				function init_pwpc_pointers() {
					$.each( pwpc_pointers.pointers, function( i ) {
						show_pwpc_pointer( i );
						count++;
						return false;
					});
				}

				function show_pwpc_pointer( id ) {
					var pointer = pwpc_pointers.pointers[ id ];
					var options = $.extend( pointer.options, {
						buttons: function( event, t ) {

							if( count == 1 ) {
								var button = $('<div>{$dismis_btn} {$next_btn}</div>');
							} else if( pointer.next && pointer.previous ) {
								var button = $('<div>{$dismis_btn} {$next_btn} {$prev_btn}</div>');
							} else if( pointer.next ) {
								var button = $('<div>{$dismis_btn} {$next_btn}</div>');
							} else {
								var button = $('<div>{$dismis_btn} {$prev_btn}</div>');
							}

							return button.bind( 'click.pointer', function(e) {
								e.preventDefault();

								if( $(e.target).hasClass('pwpc-prev-help') || $(e.target).hasClass('dashicons-arrow-left-alt') ) {
									prev = 1;
								} else {
									prev = 0;
								}

								if( $(e.target).hasClass('pwpc-close-help') || $(e.target).hasClass('dashicons-dismiss') ) {
									closed = 1;
								}

								t.element.pointer('close');
							});
						},
						close: function() {
							if ( pointer.previous && prev ) {
								show_pwpc_pointer( pointer.previous );
							} else if ( pointer.next && !closed ) {
								show_pwpc_pointer( pointer.next );
							}
						}
					});
					var this_pointer = $( pointer.target ).pointer( options );
					this_pointer.pointer( 'open' );

					if ( pointer.next_trigger ) {
						$( pointer.next_trigger.target ).on( pointer.next_trigger.event, function() {
							setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
						});
					}
				}
			});
		</script>";
	}
}

$pwpc_lite_admin_pointers = new PWPC_Lite_Admin_Pointers();