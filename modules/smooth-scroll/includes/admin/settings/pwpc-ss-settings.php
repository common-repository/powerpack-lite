<?php
/**
 * Settings Page
 * 
 * @package PowerPack Lite
 * @subpackage Smooth Scroll
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap pwpc-ss-settings">

<h2><?php _e( 'Smooth Scroll Settings', 'powerpack-lite' ); ?></h2><br />

<?php
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully", "smooth-scroll-by-wpos").'</strong></p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="pwpc-ss-settings-form" class="pwpc-ss-settings-form">

	<?php
	    settings_fields( 'pwpc_ss_plugin_options' );

	    global $pwpc_ss_options;
	?>

	<div id="pwpc-ss-general-settings" class="post-box-container pwpc-ss-general-settings">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

					<!-- Settings box title -->
					<h3 class="hndle">
						<span><?php _e( 'Mouse Wheel Smooth Scroll Settings', 'powerpack-lite' ); ?></span>
					</h3>

					<div class="inside">
						
						<table class="form-table pwpc-ss-general-settings-tbl">
							<tbody>

								<tr>
									<th>
										<label for="pwpc-ss-enable-smooth-scroll"><?php _e('Enable Smooth Scroll', 'powerpack-lite'); ?></label>
									</th>
									<td>
										<input type="checkbox" name="pwpc_ss_options[enable_smooth_scroll]" value="1" class="pwpc-ss-enable-smooth-scroll" id="pwpc-ss-enable-smooth-scroll" <?php checked(pwpcl_ss_get_option('enable_smooth_scroll'), 1); ?> /><br/>
										<span class="description"><?php _e('Check this box if you want to enable Mouse Wheel Smooth Scroll.', 'powerpack-lite'); ?></span>
									</td>
								</tr>

								<tr>
									<th>
										<label for="pwpc-ss-scroll-amount"><?php _e('Scroll Amount', 'powerpack-lite'); ?></label>
									</th>
									<td>
										<input type="number" name="pwpc_ss_options[scroll_amount]" value="<?php echo pwpcl_ss_get_option('scroll_amount'); ?>" class="pwpc-ss-scroll-amount" id="pwpc-ss-scroll-amount" min="50" step="50" /> <span><?php _e('Step Px', 'powerpack-lite'); ?></span><br/>
										<span class="description"><?php _e('Enter number of scroll amount to determine how much portion of page will be scrolled.', 'powerpack-lite'); ?></span>
									</td>
								</tr>

								<tr>
									<th>
										<label for="pwpc-ss-scroll-speed"><?php _e('Scroll Speed', 'powerpack-lite'); ?></label>
									</th>
									<td>
										<input type="number" name="pwpc_ss_options[scroll_speed]" value="<?php echo pwpcl_ss_get_option('scroll_speed'); ?>" class="pwpc-ss-scroll-speed" id="pwpc-ss-scroll-speed" min="0" /> <span><?php _e('Millisecond', 'powerpack-lite'); ?></span><br/>
										<span class="description"><?php _e('Enter scrolling speed.', 'powerpack-lite'); ?></span>
									</td>
								</tr>

								<tr>
									<td colspan="2" valign="top">
										<input type="submit" id="pwpc-ss-settings-submit" name="pwpc-ss-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','powerpack-lite');?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #pwpc-ss-general-settings -->

	<div id="pwpc-ss-general-settings" class="post-box-container pwpc-ss-general-settings">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

					<!-- Settings box title -->
					<h3 class="hndle">
						<span><?php _e( 'Go To Top Scroll', 'powerpack-lite' ); ?></span>
					</h3>
						
					<div class="inside">
						<table class="form-table pwpc-ss-general-settings-tbl">
							<tbody>
								<tr>
									<th>
										<label for="pwpc-ss-enable-gototop"><?php _e('Enable Go To Top Scroll', 'powerpack-lite'); ?></label>
									</th>
									<td>
										<input type="checkbox" name="pwpc_ss_options[enable_goto_top]" value="1" class="pwpc-ss-enable-gototop" id="pwpc-ss-enable-gototop" <?php checked( pwpcl_ss_get_option('enable_goto_top'), 1 ); ?> /><br/>
										<span class="description"><?php _e('Check this box if you want to enable page go to top.', 'powerpack-lite'); ?></span>
									</td>
								</tr>
								
								<tr>
									<th>
										<label for="pwpc-ss-gototop-speed"><?php _e('Scroll Speed', 'powerpack-lite'); ?></label>
									</th>
									<td>
										<input type="number" name="pwpc_ss_options[goto_top_speed]" value="<?php echo pwpcl_ss_get_option('goto_top_speed', 0); ?>" class="pwpc-ss-gototop-speed" id="pwpc-ss-gototop-speed" min="0" /> <span><?php _e('Millisecond', 'powerpack-lite'); ?></span><br/>
										<span class="description"><?php _e('Enter scrolling speed.', 'powerpack-lite'); ?></span>
									</td>
								</tr>

								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="pwpc-ss-settings-submit" name="pwpc-ss-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','powerpack-lite'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>
					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #pwpc-ss-general-settings -->

</form><!-- end .pwpc-ss-settings-form -->

</div><!-- end .pwpc-ss-settings -->