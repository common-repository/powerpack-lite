<?php
/**
 * Settings Page
 *
 * @package PowerPack Lite
 * @subpackage Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$global_css	= pwpcl_ccj_get_option('global_css');
$global_js	= pwpcl_ccj_get_option('global_js');

// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "powerpack-lite").'</strong></p>
		</div>';
}
?>
<div class="pwpc-ccj-settings pwpc-pad-top-20">
	<form action="options.php" method="POST" id="pwpc-ccj-settings-form" class="pwpc-ss-settings-form">

		<?php
		    settings_fields( 'pwpc_ccj_plugin_options' );
		?>

		<!-- Global CSS Settings Starts -->
		<div id="pwpc-ccj-css-sett-wrap" class="pwpc-ccj-css-sett-wrap">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<h3 class="hndle">
							<span><?php _e( 'Global CSS', 'powerpack-lite' ); ?></span>
						</h3>
							
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row"> 
											<label for="pwpc-ccj-global-css"><?php _e('Global CSS', 'powerpack-lite'); ?></label>
										</th>
										<td>
											<textarea id="pwpc-ccj-global-css" name="pwpc_ccj_options[global_css]" class="pwpc-code-editor pwpc-css-editor large-text" data-mode="css"><?php echo esc_textarea( $global_css ); ?></textarea>
											<span class="description"><?php _e('Enter CSS which will be added to whole site.', 'powerpack-lite'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" name="pwpc_ccj_css_sett_submit" class="button button-primary right pwpc-ccj-sett-submit pwpc-ccj-css-sett-submit" value="<?php _e('Save Changes','powerpack-lite'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #pwpc-ccj-css-sett-wrap -->

		<!-- Global JS Settings Starts -->
		<div id="pwpc-ccj-js-sett-wrap" class="pwpc-ccj-js-sett-wrap">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<h3 class="hndle">
							<span><?php _e( 'Global JS', 'powerpack-lite' ); ?></span>
						</h3>

						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row"> 
											<label for="pwpc-ccj-global-js"><?php _e('Global JS', 'powerpack-lite'); ?></label>
										</th>
										<td>
											<textarea id="pwpc-ccj-global-js" name="pwpc_ccj_options[global_js]" class="pwpc-code-editor pwpc-js-editor large-text" data-mode="javascript"><?php echo pwpcl_esc_attr($global_js); ?></textarea>
											<span class="description"><?php _e('Enter JS which will be added to whole site.', 'powerpack-lite'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" name="pwpc_ccj_js_sett_submit" class="button button-primary right pwpc-ccj-sett-submit pwpc-ccj-js-sett-submit" value="<?php _e('Save Changes', 'powerpack-lite'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- .pwpc-ccj-js-sett-wrap -->

	</form><!-- end .cje-settings-form -->
</div><!-- end .pwpc-ccj-settings -->