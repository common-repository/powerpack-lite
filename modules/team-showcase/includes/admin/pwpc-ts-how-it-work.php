<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pwpcl_ts_register_design_page');

/**
 * Register plugin design page in admin menu
 *
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_register_design_page() {
    add_submenu_page('edit.php?post_type='.PWPCL_TS_POST_TYPE, __('How it works - PwPc Team Showcase', 'powerpack-lite'), __('How It Works', 'powerpack-lite'), 'edit_posts', 'pwpc-ts-about', 'pwpcl_ts_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package PowerPack
 * @subpackage Team Showcase
 * @since 1.0
 */
function pwpcl_ts_designs_page() { ?>
    <div class="wrap pwpc-ts-wrap pwpc-hwit-wrap">

        <h2><?php _e('How It Works - Team Showcase', 'powerpack-lite'); ?></h2>

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
                                                                <li><?php _e('Step-1: This plugin create a Team Showcase tab in WordPress menu section".', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-2: Go to Team Showcase Pro add new team member, member details, member socials and member image.', 'powerpack-lite'); ?></li>
                                                                <li><?php _e('Step-3: Now, paste below shortcode in any page and your team listing is ready.', 'powerpack-lite'); ?></li>
                                                            </ul>
                                                        </td>
                                                    </tr>                                              

                                                    <tr>
                                                        <th>
                                                            <label><?php _e('All Shortcodes', 'powerpack-lite'); ?></label>
                                                        </th>
                                                        <td>
                                                            <span class="pwpc-shortcode-preview">[pwpc_team]</span> – <?php _e(' Grid view ', 'powerpack-lite'); ?><br>
                                                            <span class="pwpc-shortcode-preview">[pwpc_team_slider]</span> – <?php _e('Slider view ', 'powerpack-lite'); ?>
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
                                            <a class="button button-primary pwpc-button-full" href="http://docs.wponlinesupport.com/powerpack-lite-team-showcase/?utm_source=pwpc_lite_hp" target="_blank"><?php _e('Documentation', 'powerpack-lite'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end .metabox-holder -->

                            <div class="metabox-holder pwpc-pro-box">
                                <div class="meta-box-sortables ui-sortable">
                                    <div class="postbox" style="">
                                            
                                        <h3 class="hndle">
                                            <span><?php _e( 'Premium Features - Upgrade to PRO', 'powerpack-lite' ); ?></span>
                                        </h3>
                                        <div class="inside">
                                            <ul class="pwpc-pro-box-list">                                                
                                                <li>25 stunning and cool designs.</li>
                                                <li>Display team member in a grid view.</li>
                                                <li>Display team member in a slider view.</li>
                                                <li>Display team member details in a popup.</li>
                                                <li>2 popup designs for team members.</li>
                                                <li>2 popup theme (Light – Dark) for team members.</li>
                                                <li>Slider CenterMode support.</li>
                                                <li>Slider RTL support.</li>
                                                <li>Display team showcase categories wise.</li>
                                                <li>Drag & Drop team members to display in your desired order.</li>
                                                <li>Visual Composer Page Builder Support.</li>
                                                <li>Strong shortcode parameters.</li>
                                                <li>Fully Responsive.</li>
                                                <li>100% Multilanguage.</li>
                                            </ul>
                                            <a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wp-plugin/powerpack-wp-online-support/?utm_source=pwpc_lite_hp&utm_medium=team_showcase&event=go_premium" target="_blank"><?php _e('Go Premium ', 'powerpack-lite'); ?></a>
                                            <p><a class="button button-primary pwpc-button-full" href="http://powerpack.wponlinesupport.com/live/powerpack-plugin/team-showcase/?utm_source=pwpc_lite_hp&event=demo" target="_blank"><?php _e('View PRO Demo ', 'powerpack-lite'); ?></a></p>                                
                                        </div><!-- .inside -->
                                    </div><!-- #general -->
                                </div><!-- .meta-box-sortables ui-sortable -->
                            </div><!-- .metabox-holder -->

                            <?php do_action('pwpc_help_page_sidebar', 'team_showcase'); ?>

                        </div><!-- #post-container-1 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}