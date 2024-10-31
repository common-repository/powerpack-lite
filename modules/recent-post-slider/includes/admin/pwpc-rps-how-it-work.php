<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_rps_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_rps_register_design_page() {
	add_submenu_page( PWPCL_PAGE_SLUG, __('Recent Post Slider', 'powerpack-lite'), __('Recent Post Slider', 'powerpack-lite'), 'edit_posts', 'pwpc-rps-about', 'pwpcl_rps_about_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_rps_about_page() { ?>

	<div class="wrap pwpc-rps-wrap pwpc-hwit-wrap">

		<h2><?php _e('How It Works - Recent Post Slider', 'powerpack-lite'); ?></h2>

		<div class="post-box-container">
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">

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
															<li><?php _e('Responsive Recent Post Slider is a responsive plugin to display posts in a beautiful slideshow.', 'powerpack-lite'); ?></li>
															<li><?php _e('Plugin takes post from WordPress default post section and display in a slider and carousel view.', 'powerpack-lite'); ?></li>
														</ul>
														<?php _e('This plugin contains two types of shortcodes.', 'powerpack-lite'); ?>
													</td>
												</tr>

												<tr>
													<th>
														<label><?php _e('How Shortcode Works', 'powerpack-lite'); ?></label>
													</th>
													<td>
														<?php _e('Create a page or post and add below shortcodes in that.', 'powerpack-lite'); ?>
													</td>
												</tr>

												<tr>
													<th>
														<label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
													</th>
													<td>
														<span class="pwpc-shortcode-preview">[pwpc_rps_post_slider]</span> – <?php _e('Post Slider', 'powerpack-lite'); ?><br/>
														<span class="pwpc-shortcode-preview">[pwpc_rps_post_carousel]</span> – <?php _e('Post Carousel Slider', 'powerpack-lite'); ?>														
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
										<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-responsive-recent-post-slider/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>										
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
											<li>25+ predefined designs and various option as in shortcode parameter.</li>
											<li>Posts Slider View.</li>
											<li>Posts Carousel View.</li>										
											<li>Posts Grid Box (Block) View.</li>
											<li>Works with any Custom Post Type.</li>
											<li>Custom "Read More" link.</li>
											<li>3 types of different widgets.</li>											
											<li>Easy Drag & Drop feature to display posts in your desired order.</li>											
											<li>Strong Shortcode Parameters.</li>
											<li>Visual Composer Page Builder Support.</li>
											<li>Fully Responsive.</li>
											<li>100% Multi language.</li>
										</ul>
										<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=insta&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
										<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/responsive-recent-post-slider/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
									</div><!-- .inside -->
								</div><!-- #general -->
							</div><!-- .meta-box-sortables ui-sortable -->
						</div><!-- .metabox-holder -->

						<?php do_action('pwpc_help_page_sidebar', 'rps'); ?>

					</div><!-- #post-container-1 -->

				</div><!-- #post-body -->
			</div><!-- #poststuff -->
		</div><!-- #post-box-container -->
	</div><!-- end .pwpc-rps-wrap -->

<?php
}