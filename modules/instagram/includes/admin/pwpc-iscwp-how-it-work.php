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
													<li><?php _e('This plugin is as easy as 123!!!', 'powerpack-lite'); ?></li>
													<li><?php _e('Just paste below shortcode in any post or page and add your instagram username to shortcode.', 'powerpack-lite'); ?></li>
												</ul>
											</td>
										</tr>

										<tr>
											<th>
												<label><?php _e('How Shortcode Works', 'powerpack-lite'); ?></label>
											</th>
											<td>
												<?php _e('Create a page or post and put below shortcode as per your need.', 'powerpack-lite'); ?>
											</td>
										</tr>

										<tr>
											<th>
												<label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
											</th>
											<td>
												<span class="pwpc-shortcode-preview">[pwpc_insta_grid username="instagram"]</span> – <?php _e('Instagram Grid', 'powerpack-lite'); ?> <br />
												<span class="pwpc-shortcode-preview">[pwpc_insta_slider username="instagram"]</span> – <?php _e('Instagram Slider', 'powerpack-lite'); ?>												
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
								<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-instagram-slider-and-carousel-plus-widget/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>
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
									<li>10+ predefined designs and various option as in shortcode parameter.</li>
									<li>Instagram Grid View.</li>
									<li>Instagram Slider View.</li>
									<li>Instagram Grid Box (Block) View.</li>
									<li>Instagram User details.</li>
									<li>Custom cache time option.</li>
									<li>Instagram Slider Widget.</li>
									<li>Display Photo / Video latest comment.</li>
									<li>Visual Composer Page Builder Support.</li>
									<li>Fully Responsive.</li>
									<li>100% Multi language.</li>
								</ul>
								<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=insta&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
								<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/instagram-slider-and-carousel-plus-widget/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
							</div><!-- .inside -->
						</div><!-- #general -->
					</div><!-- .meta-box-sortables ui-sortable -->
				</div><!-- .metabox-holder -->

				<?php do_action('pwpc_help_page_sidebar', 'instagram'); ?>

			</div><!-- #post-container-1 -->
		</div><!-- #post-body -->
	</div><!-- #poststuff -->
</div><!-- #post-box-container -->