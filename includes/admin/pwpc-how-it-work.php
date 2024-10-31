<?php
/**
 * Plugin How it work functionality (Common)
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add common sidebar in help page
add_action( 'pwpc_help_page_sidebar', 'pwpcl_help_page_common_sidebar' );

/**
 * Function ot add common sidebar in help page
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_help_page_common_sidebar() { ?>

	<div class="metabox-holder pwpc-pro-box">
        <div class="meta-box-sortables ui-sortable">
            <div class="postbox">
                <h3 class="hndle">
                    <span><?php _e('Need PRO Support?', 'powerpack-lite'); ?></span>
                </h3>
                <div class="inside">
                    <p><?php _e('Hire our experts for any WordPress task.', 'powerpack-lite'); ?></p>
                    <p><a class="button button-primary pwpc-button-full" href="https://www.wponlinesupport.com/wordpress-support/?utm_source=pwpc_lite_hp&event=projobs" target="_blank"><?php _e('Hire Us', 'powerpack-lite'); ?></a></p>
                </div><!-- .inside -->
            </div><!-- #general -->
        </div><!-- .meta-box-sortables ui-sortable -->
    </div><!-- .metabox-holder -->

    <!-- Help to improve this plugin! -->
    <div class="metabox-holder">
        <div class="meta-box-sortables ui-sortable">
            <div class="postbox">
                    <h3 class="hndle">
                        <span><?php _e( 'Help to improve this plugin!', 'powerpack-lite' ); ?></span>
                    </h3>
                    <div class="inside">
                        <p><?php _e('Enjoyed this plugin? You can help by rate this plugin', 'powerpack-lite'); ?> <a href="https://wordpress.org/support/plugin/powerpack-lite/reviews/#new-post" target="_blank"><?php _e('5 stars!', 'powerpack-lite'); ?></a></p>
                    </div><!-- .inside -->
            </div><!-- #general -->
        </div><!-- .meta-box-sortables ui-sortable -->
    </div><!-- .metabox-holder -->

<?php
}