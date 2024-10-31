<?php
/**
 * Settings Page
 *
 * @package PowerPack Lite
 * @subpackage Preloader
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__('Your changes saved successfully.', 'powerpack-lite').'</strong></p>
		  </div>';
}
?>
<div class="pwpc-pl-settings pwpc-pad-top-20">
	<form action="options.php" method="POST" id="pwpc-pl-settings-form" class="pwpc-pl-settings-form">

		<?php
		    settings_fields( 'pwpc_pl_plugin_options' );

		    // Taking saved options
			$plwao_spinner 		= pwpcl_pl_get_option('plwao_spinner', 'spinner-1');
			$plwao_spinner_size = pwpcl_pl_get_option('plwao_spinner_size', 'medium');
		?>

		<!-- General Settings Starts -->
		<div id="pwpc-pl-general-sett" class="post-box-container pwpc-pl-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'powerpack-lite' ); ?></span>
						</h3>
						
						<div class="inside">
						
							<table class="form-table pwpc-pl-general-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="pwpc-pl-enable-preloader"><?php _e('Enable Site Preloader', 'powerpack-lite'); ?></label>
										</th>
										<td>
											<input id="pwpc-pl-enable-preloader" type="checkbox" name="pwpc_pl_options[is_preloader]" value="1" <?php checked(pwpcl_pl_get_option('is_preloader'),1); ?>/><br/>
											<span class="description"><?php _e('Check this box to enable preloader.','powerpack-lite'); ?></span>
										</td>
									</tr>					

									<tr>
										<th scope="row">
											<label for="pwpc-pl-spinner"><?php _e('Spinner', 'powerpack-lite'); ?></label>
										</th>
										
										<td>
											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-1' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-1">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-1" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-1" <?php checked( 'spinner-1', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-1.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-2' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-2">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-2" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-2" <?php checked( 'spinner-2', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-2.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-3' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-3">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-3" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-3" <?php checked( 'spinner-3', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-3.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-4' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-4">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-4" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-4" <?php checked( 'spinner-4', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-4.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-5' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-5">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-5" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-5" <?php checked( 'spinner-5', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-5.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-6' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-6">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-6" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-6" <?php checked( 'spinner-6', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-6.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-7' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-7">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-7" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-7" <?php checked( 'spinner-7', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-7.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-8' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-8">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-8" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-8" <?php checked( 'spinner-8', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-8.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-9' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-9">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-9" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-9" <?php checked( 'spinner-9', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-9.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-10' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-10">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-10" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-10" <?php checked( 'spinner-10', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-10.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-11' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-11">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-11" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-11" <?php checked( 'spinner-11', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-11.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-12' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-12">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-12" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-12" <?php checked( 'spinner-12', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-12.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-13' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-13">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-13" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-13" <?php checked( 'spinner-13', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-13.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-14' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-14">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-14" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-14" <?php checked( 'spinner-14', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-14.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-15' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-15">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-15" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-15" <?php checked( 'spinner-15', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-15.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-16' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-16">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-16" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-16" <?php checked( 'spinner-16', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-16.gif">
											</label>

											<label class="pwpc-pl-spinner-class <?php if ( $plwao_spinner == 'spinner-17' ){ echo 'pwpc-pl-active'; } ?>" for="pwpc-pl-spinner-17">
												<input class="pwpc-pl-check" id="pwpc-pl-spinner-17" type="radio" name="pwpc_pl_options[plwao_spinner]" value="spinner-17" <?php checked( 'spinner-17', $plwao_spinner ); ?>/>
												<img src="<?php echo PWPCL_PL_URL; ?>assets/images/medium/spinner-17.gif">
											</label>
											<br/>
											<span class="description"><?php _e('Select spinner design.','powerpack-lite'); ?></span>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<label for="pwpc-pl-spinner-size"><?php _e('Spinner Size', 'powerpack-lite'); ?></label>
										</th>
										<td>
											<select id="pwpc-pl-spinner-size" name="pwpc_pl_options[plwao_spinner_size]">
												<option value="small" <?php selected( $plwao_spinner_size, 'small'); ?>><?php _e('Small - (32 x 32)', 'powerpack-lite'); ?></option>
												<option value="medium" <?php selected( $plwao_spinner_size, 'medium'); ?>><?php _e('Medium - (64 x 64)', 'powerpack-lite'); ?></option>
												<option value="large" <?php selected( $plwao_spinner_size, 'large'); ?>><?php _e('Large - (128 x 128)', 'powerpack-lite'); ?></option>
											</select><br/>
											<span class="description"><?php _e('Select spinner size.','powerpack-lite'); ?></span>
										</td>
									</tr>	

									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="pwpc-pl-settings-submit" name="pwpc-pl-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','powerpack-lite'); ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form><!-- end .pwpc-pl-settings-form -->
</div><!-- end .pwpc-pl-settings -->