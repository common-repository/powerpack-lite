<?php
/**
 * Plugin 'How It Work' Page
 *
 * @package PowerPack Lite
 * @subpackage Footer Mega Grid Columns
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap">

	<h2><?php _e( 'Footer Grid Columns', 'powerpack-lite' ); ?></h2>

	<div class="post-box-container pwpc-hwit-wrap">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2 pwpc-clearfix">

				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">

								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and Shortcode', 'powerpack-lite' ); ?></span>
								</h3>

								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started', 'powerpack-lite'); ?></label>
												</th>
												<td>
													<p><?php _e('This plugin register a widget area for your theme and allows you to add and display widgets in your desired place.', 'powerpack-lite'); ?></p>
													<p><?php _e('This plugin create a "Footer Mega Grid Columns - PwPc" menu tab in WordPress menu and sidebar widget area "Footer Mega Grid Columns - PwPc" in Appearance > Widgets.', 'powerpack-lite'); ?></p>
													<p><?php _e('Go to "Appearance > Widgets", Add any type of widgets in Footer Mega Grid Columns - PwPc Sidebar.', 'powerpack-lite'); ?></p>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Plugin Works', 'powerpack-lite'); ?></label>
												</th>
												<td>
													<?php _e('Paste below code in footer.php file of your active wordpress theme.', 'powerpack-lite'); ?> <br/><br/>
													<code>&lt;?php if( function_exists('pwpc_fmgc_display_widgets') ) { echo pwpc_fmgc_display_widgets(); } ?&gt;</code>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->

				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder pwpc-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php _e('Need Support?', 'powerpack-lite'); ?></span>
								</h3>
								<div class="inside">										
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'powerpack-lite'); ?></p>
									<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-footer-mega-grid-columns/?utm_source=pwpc_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>									
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<div class="metabox-holder pwpc-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php _e( 'Premium Features - Upgrade to PRO', 'powerpack-lite' ); ?></span>
								</h3>
								<div class="inside">										
									<ul class="pwpc-pro-box-list">
										<li>Choose your desired column for widget.</li>
										<li>Add your custom class to widget.</li>
										<li>Setting page for widget area width, color, title and etc.</li>
										<li>100% Multi language.</li>
									</ul>
									<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=insta&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
									<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/footer-mega-grid-columns/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<?php do_action('pwpc_help_page_sidebar', 'fmgc_columns'); ?>

				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
</div><!-- end .wrap -->