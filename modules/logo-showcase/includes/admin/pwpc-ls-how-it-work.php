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
add_action('admin_menu', 'pwpcl_ls_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.PWPCL_LS_POST_TYPE, __('How it works - Logo Showcase', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-ls-about', 'pwpcl_ls_about_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage Logo Showcase
 * @since 1.0
 */
function pwpcl_ls_about_page() { ?>

	<div class="wrap pwpc-ls-wrap pwpc-hwit-wrap">

		<h2><?php _e('How It Works - Logo Showcase', 'powerpack-lite'); ?></h2>

		<div class="pwpc-ls-tab-cnt-wrp">
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
																<li><?php _e('Step-1. Go to "Logo Showcase > Add New".', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-2. Add Logo title, logo image and etc.', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-3. Add relevant shortcode to Page or Post and display with your desired design.', 'powerpack-lite'); ?></li>																
															</ul>
															<p><?php _e('You can create categories under "Logo Showcase - PwPc > Category", assign logo showcase post to respective categories and display Logo Showcase category wise with category parameter.', 'powerpack-lite'); ?></p>
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
															<span class="pwpc-shortcode-preview">[pwpc_logo_slider]</span> – <?php _e('Logo Showcase Slider', 'powerpack-lite'); ?> <br />															
															<span class="pwpc-shortcode-preview">[pwpc_logo_slider center_mode="true" slides_column="3"]</span> – <?php _e('Logo Showcase Slider with Center Mode effect', 'powerpack-lite'); ?>
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
											<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-logo-showcase/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>											
										</div><!-- .inside -->
									</div><!-- #general -->
								</div><!-- .meta-box-sortables ui-sortable -->
							</div><!-- .metabox-holder -->

							<div class="metabox-holder pwpc-pro-box">
								<div class="meta-box-sortables ui-sortable">
									<div class="postbox">
										<h3 class="hndle">
											<span><?php _e( 'Upgrate to Pro', 'powerpack-lite' ); ?></span>
										</h3>
										<div class="inside">										
											<ul class="pwpc-pro-box-list">
												<li>15+ predefined designs for logo showcase.</li>
												<li>3 types of shortcodes for Grid, Carousel and Filter view.</li>
												<li>Drag & Drop order change.</li>
												<li>Display logo showcase in a grid view.</li>
												<li>Display logo with filtration.</li>
												<li>Display logo showcase in slider view.</li>
												<li>Display logo showcase in center mode view.</li>
												<li>Logo Showcase With Ticker Mode.</li>
												<li>2 Widgets- Slider and Grid view.</li>
												<li>Display Logo with title and description.</li>
												<li>Display logo showcase categories wise.</li>
												<li>Set image size for logo among WordPress image size.</li>
												<li>Visual Composer support.</li>
												<li>Logo Showcase with tool-tip with 5 tool-tip theme and various parameters.</li>
												<li>Custom CSS option.</li>
												<li>Fully responsive.</li>
												<li>100% Multi language.</li>
											</ul>
											<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/wp-logo-showcase-responsive-slider/?utm_source=pwpc_lite_hp&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>	
											<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/logo-showcase/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a>			</p>								
										</div><!-- .inside -->
									</div><!-- #general -->
								</div><!-- .meta-box-sortables ui-sortable -->
							</div><!-- .metabox-holder -->

							<?php do_action('pwpc_help_page_sidebar', 'logo_showcase'); ?>

						</div><!-- #post-container-1 -->

					</div><!-- #post-body -->
				</div><!-- #poststuff -->
			</div><!-- #post-box-container -->
		</div><!-- end .pwpc-ls-tab-cnt-wrp -->
	</div><!-- end .pwpc-ls-wrap -->

<?php
}