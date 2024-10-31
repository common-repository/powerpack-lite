<?php
/**
 * Plugin 'How It Work' Page
 *
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>
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
												<ul>
													<li><?php _e('This module is as easy as 123!!!', 'powerpack-lite'); ?></li>
													<li><?php _e("Just go to 'Plugin Settings', enable it and do relevant settings. That's it.", 'powerpack-lite'); ?></li>
												</ul>
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
								<span><?php _e( 'Need Support?', 'powerpack-lite' ); ?></span>
							</h3>
							<div class="inside">
								<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'powerpack-lite'); ?></p>
								<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-preloader/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>								
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
									<li>Upload your custom loader.</li>
									<li>Apply your desired color to loader area.</li>
								</ul>
								<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=preloader&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
								<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/preloader/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
							</div><!-- .inside -->
						</div><!-- #general -->
					</div><!-- .meta-box-sortables ui-sortable -->
				</div><!-- .metabox-holder -->

				<?php do_action('pwpc_help_page_sidebar', 'preloader'); ?>

			</div><!-- #post-container-1 -->
		</div><!-- #post-body -->
	</div><!-- #poststuff -->
</div><!-- #post-box-container -->