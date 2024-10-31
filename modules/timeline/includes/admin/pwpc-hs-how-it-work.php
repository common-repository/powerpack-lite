<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage History Slider
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_hs_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_register_design_page() {
    add_submenu_page('edit.php?post_type='.PWPCL_HS_POST_TYPE, __('How it works - PwPc Timeline', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-hs-about', 'pwpcl_hs_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage History Slider
 * @since 1.0
 */
function pwpcl_hs_designs_page() { ?>
    <div class="wrap pwpc-ts-wrap pwpc-hwit-wrap">

        <h2><?php _e('How It Works - Timeline and History Slider', 'powerpack-lite'); ?></h2>

        <div class="pwpc-ts-tab-cnt-wrp">
            <div class="post-box-container">
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-2">
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
                                                                <li><?php _e('Step-1) Go to "Timeline – PwPc > Add Timeline".', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-2) Add timeline title, description and featured image and etc.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-3) Also you can display multiple timeline with category shortcode. Just go to "Timeline – PwPc > Timeline Category" and create the category.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Assign the timeline post to respective category and use the category shortcode to display.', 'powerpack-lite'); ?></li>
                                                            </ul>
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
                                                            <label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
                                                        </th>
                                                        <td>
                                                            <span class="pwpc-shortcode-preview">[pwpc_timeline_slider]</span> – <?php _e('Timeline Horizontal Slider', 'powerpack-lite'); ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="postbox-container-1" class="postbox-container">
                            <div class="metabox-holder pwpc-pro-box">
                                <div class="meta-box-sortables ui-sortable">
                                    <div class="postbox">
                                        <h3 class="hndle">
                                            <span><?php _e('Need Support?', 'powerpack-lite'); ?></span>
                                        </h3>
                                        <div class="inside">
                                            <p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'powerpack-lite'); ?></p>
                                            <a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-timeline-and-history-slider/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="metabox-holder pwpc-pro-box">
                                <div class="meta-box-sortables ui-sortable">
                                    <div class="postbox">
                                        <h3 class="hndle">
                                            <span><?php _e( 'Premium Features - Upgrade to PRO', 'powerpack-lite' ); ?></span>
                                        </h3>
                                        <div class="inside">                                        
                                            <ul class="pwpc-pro-box-list">
                                                <li>12+ Predefined Designs.</li>
                                                <li>Vertical and Horizontal Timeline.</li>
                                                <li>Works with WordPress default POST.</li>
                                                <li>Timeline Category Management – Add stories in specific category.</li>
                                                <li>Timeline Stories Content Format – Add font awesome icon to display timeline stories format.</li>
                                                <li>Timeline Scrolling Navigation – Quickly and easily navigate your timeline with a beautiful scrolling navigation inside your timeline.</li>
                                                <li>Visual Composer Page Builder Support.</li>
                                                <li>Easy Drag & Drop to display timeline in your desired order.</li>
                                                <li>Strong shortcode parameters.</li>
                                                <li>Fully Responsive.</li>
                                                <li>100% Multi language.</li>
                                            </ul>
                                            <a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=timeline&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>   
                                            <p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/powerpack-lite/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a>         </p>                                
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->

                            <?php do_action('pwpc_help_page_sidebar', 'timeline'); ?>

                        </div><!-- end .postbox-container-1 -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end .wrap -->
<?php
}