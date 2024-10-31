<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage FAQ
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_faq_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.PWPCL_FAQ_POST_TYPE, __('How it works - FAQ', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-faq-about', 'pwpcl_faq_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage FAQ
 * @since 1.0
 */
function pwpcl_faq_designs_page() { ?>

	<div class="wrap pwpc-faq-wrap pwpc-hwit-wrap">

		<h2><?php _e('How It Works - FAQ', 'powerpack-lite'); ?></h2>

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
																<li><?php _e('Step-1. Go to "FAQ PwPc > Add FAQ".', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-2. Add Title, Description and featured image.', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-3. Add FAQ shortcode to Page or Post and display with your desired design.', 'powerpack-lite'); ?></li>
																<li><?php _e('You can create categories under "FAQ PwPc > FAQ Category", assign FAQ post to respective categories and display FAQ category wise with category parameter.', 'powerpack-lite'); ?></li>
															</ul>
														</td>
													</tr>

													<tr>
														<th>
															<label><?php _e('How Shortcode Works', 'powerpack-lite'); ?></label>
														</th>
														<td>
															<ul>
																<li><?php _e('Step-1. Create a page like FAQ OR add the shortcode in any page.', 'powerpack-lite'); ?></li>
																<li><?php _e('Step-2. Put below shortcode as per your need.', 'powerpack-lite'); ?></li>
															</ul>
														</td>
													</tr>

													<tr>
														<th>
															<label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
														</th>
														<td>
															<span class="pwpc-shortcode-preview">[pwpc_faq]</span> – <?php _e('Display FAQ in Page', 'powerpack-lite'); ?>															
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
											<a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-faq/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>
										</div><!-- .inside -->
									</div><!-- #general -->
								</div><!-- .meta-box-sortables ui-sortable -->
							</div><!-- .metabox-holder -->

							<div class="metabox-holder pwpc-pro-box">
								<div class="meta-box-sortables ui-sortable">
									<div class="postbox" style="">
											
										<h3 class="hndle">
											<span><?php _e( 'Premium Features - Upgrade to PRO', 'powerpack-lite' ); ?></span>
										</h3>
										<div class="inside">										
											<ul class="pwpc-pro-box-list">
												<li>15+ predefined design and Custom Colors option as in shortcode parameter.</li>
												<li>FAQ with accordion.</li>
												<li>FAQ with categories grid.</li>
												<li>Visual Composer support.</li>
												<li>Custom ordering with drag and drop.</li>	
												<li>WooCommerce FAQ support. Now you can add Product FAQ to WooCommerce Product page easily.</li>
												<li>Various shortcode parameter for FAQ like Order, Orderby, Limit, Color, Backgrond color, Border color, Active FAQ color, Display specific FAQ, Exclude some FAQ and many more.</li>
												<li>Remain open FAQ on page load.</li>
												<li>Custom CSS option.</li>
												<li>Fully responsive.</li>
												<li>100% Multi language.</li>
											</ul>
											<a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=faq&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
											<p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/faq/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
										</div><!-- .inside -->
									</div><!-- #general -->
								</div><!-- .meta-box-sortables ui-sortable -->
							</div><!-- .metabox-holder -->

							<?php do_action('pwpc_help_page_sidebar', 'faq'); ?>

						</div><!-- #post-container-1 -->

					</div><!-- #post-body -->
				</div><!-- #poststuff -->
			</div><!-- #post-box-container -->
		</div><!-- end .pwpc-faq-tab-cnt-wrp -->
	</div><!-- end .pwpc-faq-wrap -->

<?php
}