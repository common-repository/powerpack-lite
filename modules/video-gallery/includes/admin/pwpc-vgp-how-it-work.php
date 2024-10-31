<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage Video Gallery
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_vgp_register_design_page');

/**
 * Register plugin design page in admin menu
 *
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_register_design_page() {
    add_submenu_page('edit.php?post_type='.PWPCL_VGP_POST_TYPE, __('How it works - Video Gallery PwPc', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-vgp-about', 'pwpcl_vgp_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage Video Gallery
 * @since 1.0
 */
function pwpcl_vgp_designs_page() { ?>
    <div class="wrap pwpc-vgp-wrap pwpc-hwit-wrap">

        <h2><?php _e('How It Works - Video Gallery', 'powerpack-lite'); ?></h2>

        <div class="pwpc-vgp-tab-cnt-wrp">
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
                                                            <label><?php _e('Getting Started', 'powerpack-lite'); ?>:</label>
                                                        </th>
                                                        <td>
                                                            <ul>
                                                                <li><?php _e('Step-1: This plugin create a "Video Gallery Pro" in WordPress menu section.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-2: Click on "Video Gallery - PwPc > Add new"', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-3: Add Video title, link, and video poster image.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-4: You can also create the categories under "Video Gallery Pro > Category". Assign the video under respective category and use category shortcode to display multiple video galleries. ', 'powerpack-lite'); ?></li>
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
                                                            <label><?php _e('All Shortcodes', 'powerpack-lite'); ?>:</label>
                                                        </th>
                                                        <td>
                                                            <span class="pwpc-shortcode-preview">[pwpc_video_gallery]</span> – <?php _e('Video Gallery Grid View', 'powerpack-lite'); ?>                                                            
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
                                            <a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-video-gallery/?utm_source=pwpc_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .metabox-holder -->

                            <div class="metabox-holder pwpc-pro-box">
                                <div class="meta-box-sortables ui-sortable">
                                    <div class="postbox">
                                        <h3 class="hndle">
                                            <span><?php _e( 'Premium Features - Upgrade to PRO', 'powerpack-lite' ); ?></span>
                                        </h3>
                                        <div class="inside">                                        
                                            <ul class="pwpc-pro-box-list">
                                                <li>18+ Predefined Designs.</li>
                                                <li>Grid View.</li>
                                                <li>Slider/Carousel View.</li>
                                                <li>Carousel with center mode effect.</li>
                                                <li>Multiple display with category.</li>
                                                <li>Numeric Pagination.</li>
                                                <li>Easy Drag & Drop feature to display in your desired order.</li>
                                                <li>Popup Gallery Mode.</li>
                                                <li>Visual Composer Page Builder Support.</li>
                                                <li>Various Video settings like autoplay video and many more.</li>
                                                <li>Fully Responsive.</li>
                                                <li>100% Multi language.</li>
                                            </ul>
                                            <a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=video&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>   
                                            <p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/video-gallery/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>                                
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->

                            <?php do_action('pwpc_help_page_sidebar', 'video-gallery'); ?>

                        </div><!-- end .postbox-container -->
                    </div><!-- end #post-body -->
                </div>
            </div>
        </div>
    </div><!-- end .wrap -->
<?php
}