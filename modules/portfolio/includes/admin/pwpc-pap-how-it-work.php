<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_pap_register_design_page');

/**
 * Register plugin design page in admin menu
 *
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_register_design_page() {
    add_submenu_page('edit.php?post_type='.PWPCL_PAP_POST_TYPE, __('How it works - PwPc Portfolio and Projects', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-pap-about', 'pwpcl_pap_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @subpackage Portfolio and Projects
 * @since 1.0
 */
function pwpcl_pap_designs_page() { ?>
    <div class="wrap pwpc-pap-wrap pwpc-hwit-wrap">

        <h2><?php _e('How It Works - Portfolio and Projects', 'powerpack-lite'); ?></h2>

        <div class="pwpc-pap-tab-cnt-wrp">
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
                                                                <li><?php _e('Step-1: This plugin creates Portfolio pwpc tab in WordPress menu section', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-2: Go to Projects pwpc add new portfoilo add portfoliio images, project link, portfolio banner and choose your slider setting"', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-3: Now, paste below shortcode in any post or page and your profolio listing is ready !!!', 'powerpack-lite'); ?></li>
                                                            </ul>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                            <label><?php _e('All Shortcodes', 'powerpack-lite'); ?>:</label>
                                                        </th>
                                                        <td>
                                                            <span class="pwpc-shortcode-preview">[pwpc_portfolio]</span> – <?php _e('Portfolio Grid', 'powerpack-lite'); ?>
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
                                            <a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-portfolio-and-projects/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>                                            
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
                                                <li>15+ Pre define Designs.</li>
                                                <li>Display Portfolio with Title, Description and Image Gallery.</li>
                                                <li>Portfolio Grid View.</li>
                                                <li>Portfolio Filtration.</li>
                                                <li>Portfolio Category wise.</li>
                                                <li>Easy Drag-n-Drop Feature to Display Portfolio in desire order.</li>
                                                <li>2 types of pagination (Numeric and Previous-Next)</li>
                                                <li>Strong Shortcode Parameters.</li>
                                                <li>Fully Responsive and Touch Based Slider.</li>
                                                <li>Visual Composer Page Builder Support.</li>
                                                <li>2 Portfolio Pop-up styles (Inline and Popup)</li>
                                                <li>100% Multi language.</li>
                                                <li>Fully Responsive.</li>
                                            </ul>
                                            <a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=portfolio&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
                                            <p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/portfolio-and-projects/?utm_source=pwpc_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->

                            <?php do_action('pwpc_help_page_sidebar', 'portfolio'); ?>
                        </div><!-- end .postbox-container -->
                    </div><!-- end #post-body -->
                </div>
            </div>
        </div>
    </div><!-- end .wrap -->
<?php
}