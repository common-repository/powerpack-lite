<?php
/**
 * How it Work Page HTML
 *
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_bws_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.PWPCL_BWS_POST_TYPE, __('How it works', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-bws-about', 'pwpcl_bws_how_it_work_page' );
}

/**
 * Function to get 'How It Works' HTML
 *
 * @subpackage Buttons with Style
 * @since 1.0
 */
function pwpcl_bws_how_it_work_page() { ?>

	<div class="wrap pwpc-bws-wrap pwpc-hwit-wrap">

		<h2><?php _e('How It Works - Buttons With Style', 'powerpack-lite'); ?></h2>

		<div class="pwpc-faq-tab-cnt-wrp">
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
																<li><?php _e('Step-1. Go to "Button – PwPc > Add Button".', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-2. Add Title and do necessary settings like button color, button font, button link and etc.', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-3. Add button shortcode to any Page or Post.', 'powerpack-lite'); ?></li>																
															</ul>
														</td>
													</tr>

													<tr>
														<th>
															<label><?php _e('How Shortcode Works', 'powerpack-lite'); ?></label>
														</th>
														<td><?php _e('Add below shortcode with valid id in any page or post. You can find button shortcode at Button listing page.', 'powerpack-lite'); ?></td>
													</tr>

													<tr>
														<th>
															<label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
														</th>
														<td>
															<span class="pwpc-shortcode-preview">[pwpc_bws_btn id="XX"]</span> – <?php _e('Display Button', 'powerpack-lite'); ?>
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
											<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-button-with-style/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>											
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
												<li>Group Buttons.</li>
												<li>Create multiple group buttons.</li>
											</ul>
											<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=insta&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
											<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/button-with-style/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
										</div><!-- .inside -->
									</div><!-- #general -->
								</div><!-- .meta-box-sortables ui-sortable -->
							</div><!-- .metabox-holder -->

							<?php do_action('pwpc_help_page_sidebar', 'bws'); ?>

						</div><!-- #post-container-1 -->

					</div><!-- #post-body -->
				</div><!-- #poststuff -->
			</div><!-- #post-box-container -->
		</div><!-- end .pwpc-faq-tab-cnt-wrp -->
	</div><!-- end .pwpc-bws-wrap -->

<?php }