<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage Testimonials
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_tmw_register_design_page');

/**
 * Register plugin design page in admin menu
 *
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_register_design_page() {
    add_submenu_page( 'edit.php?post_type='.PWPCL_TMW_POST_TYPE, __('How it works - Testimonials PwPc', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-tmw-about', 'pwpcl_tmw_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage Testimonials
 * @since 1.0
 */
function pwpcl_tmw_designs_page() { ?>
    <div class="wrap pwpc-tmw-wrap pwpc-hwit-wrap">

        <h2><?php _e('How It Works - Testimonials', 'powerpack-lite'); ?></h2>

        <div class="pwpc-tmw-tab-cnt-wrp">
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
                                                            <p><?php _e('WP Testimonial Plugin is used to display testimonials, reviews or quotes in a slider, carousel or grid view.', 'powerpack-lite'); ?></p>
                                                            <p><?php _e('This plugin contains Grid and Slider shortcodes.', 'powerpack-lite'); ?></p>
                                                            <hr/>

                                                            <ul>
                                                                <li><?php _e('Step-1. Go to "Testimonials – PwPc > Add New" in admin menu.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-2. Add Testimonial title, Testimonial image, description and etc.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-3. Add relevant shortcode to Page or Post and display with your desired design.', 'powerpack-lite'); ?></li>
                                                            </ul>
                                                            <p><?php _e('You can create categories under "Testimonials – PwPc > Category", assign Testimonial post to respective categories and display category wise with category parameter.', 'powerpack-lite'); ?></p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                            <label><?php _e('How Shortcode Works', 'powerpack-lite'); ?></label>
                                                        </th>
                                                        <td><?php _e('Create a page or post and add below shortcodes in that.', 'powerpack-lite'); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                            <label><?php _e('All Shortcodes', 'powerpack-lite'); ?>:</label>
                                                        </th>
                                                        <td>
                                                            <span class="pwpc-shortcode-preview">[pwpc_testimonials]</span> – <?php _e('Testimonials Grid', 'powerpack-lite'); ?><br/>
                                                            <span class="pwpc-shortcode-preview">[pwpc_testimonials_slider]</span> – <?php _e('Testimonials Slider', 'powerpack-lite'); ?>                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->
                        </div><!-- #post-body-content -->
                        
                        <!--Need Support -->
                        <div id="postbox-container-1" class="postbox-container">
                            <div class="metabox-holder pwpc-pro-box">
                                <div class="meta-box-sortables ui-sortable">
                                    <div class="postbox">
                                        <h3 class="hndle">
                                            <span><?php _e('Need Support?', 'powerpack-lite'); ?></span>
                                        </h3>
                                        <div class="inside">                                        
                                            <p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'powerpack-lite'); ?></p>
                                            <a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-testimonials/?utm_source=pwpc_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>                                            
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
                                                <li>20 Predefined Designs.</li>
                                                <li>Testimonial front-end submission form.</li>
                                                <li>Star Rating Field.</li>
                                                <li>Testimonial Slider Widget.</li>
                                                <li>Display testimonials using 15+ testimonial widget designs.</li>
                                                <li>Display Testimonial categories wise.</li>
                                                <li>Easy Drag-n-Drop feature to display Testimonial in your desire order.</li>
                                                <li>Strong Shortcode Parameters.</li>
                                                <li>Visual Composer Page Builder Support.</li>
                                                <li>Fully Responsive.</li>
                                                <li>100% Multi language.</li>
                                            </ul>
                                            <a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=testimonial&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
                                            <p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/testimonials/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a> </p>                                
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->

                            <?php do_action('pwpc_help_page_sidebar', 'testimonials'); ?>

                        </div><!-- #post-container-1 -->

                    </div><!-- #post-body -->
                </div><!-- #poststuff -->
            </div><!-- #post-box-container -->
        </div><!-- end .pwpc-tmw-tab-cnt-wrp -->
    </div><!-- end .pwpc-tmw-wrap -->
<?php
}