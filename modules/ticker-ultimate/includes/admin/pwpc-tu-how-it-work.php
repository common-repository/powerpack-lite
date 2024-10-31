<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_tu_register_design_page');

/**
 * Register plugin design page in admin menu
 *
 * @subpackage Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_register_design_page() {
    add_submenu_page('edit.php?post_type='.PWPCL_TU_POST_TYPE, __('How it works - PwPc Ticker Ultimate', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-tu-about', 'pwpcl_tu_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage Ticker Ultimate
 * @since 1.0
 */
function pwpcl_tu_designs_page() { ?>
    <div class="wrap pwpc-tu-wrap pwpc-hwit-wrap">

        <h2><?php _e('How It Works - Ticker Ultimate', 'powerpack-lite'); ?></h2>

        <div class="pwpc-tu-tab-cnt-wrp">
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
                                                                <li><?php _e('Step-1: This plugin creates Ticker- PwPc tab in WordPress menu section', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-2: Go to Ticker- PwPc and add new ticker', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-3: Now, paste below shortcode in any post or page and your ticker is ready!!!', 'powerpack-lite'); ?></li>
                                                            </ul>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                            <label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
                                                        </th>
                                                        <td>
                                                            <span class="pwpc-shortcode-preview">[pwpc_ticker]</span> – <?php _e('Display post in ticker mode.', 'powerpack-lite'); ?>
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
                                            <a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-ticker-ultimate-with-rss/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>                                            
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
                                                <li>2 predefined designs and various option as in shortcode parameter.</li>
                                                <li>Varios ticker effect</li>
                                                <li>Visual Composer Page builder support</li>
                                                <li>Autoplay Option</li>
                                                <li>Easy Drag & Drop feature to display news in ticker in your desired order</li>
                                                <li>Custom Order and Orderby parameter</li>
                                                <li>Strong shortcode parameters</li>
                                                <li>Fully responsive</li>
                                                <li>100% Multi language</li>
                                            </ul>
                                            <a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=ticker&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
                                            <p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/ticker-ultimate-with-rss/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->
                            
                            <?php do_action('pwpc_help_page_sidebar', 'ticker'); ?>

                        </div><!-- end .postbox-container -->
                    </div><!-- end #post-body -->
                </div>
            </div>
        </div>
    </div><!-- end .wrap -->
<?php
}