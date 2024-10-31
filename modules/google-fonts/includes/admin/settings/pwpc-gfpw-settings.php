<?php
/**
 * Settings Page
 *
 * @package PowerPack Lite
 * @subpackage Google Fonts
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap pwpc-gfpw-settings">
	
	<h2><?php _e( 'Google Fonts Settings', 'powerpack-lite' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "powerpack-lite").'</strong></p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="pwpc-gfpw-settings-form" class="pwpc-gfpw-settings-form">
		
		<?php
		    settings_fields( 'pwpc_gfpw_plugin_options' );

		    global $pwpc_gfpw_options;
		    
			// Taking some variables
			$gfpf_google_fonts 	= pwpcl_gfpw_google_fonts('simplified');
			$font_elements		= pwpcl_gfpw_fonts_elements();
			$gf_site_fonts 		= pwpcl_gfpw_get_option( 'gf_font', array('0' => '') );
			$site_font_elements	= pwpcl_gfpw_get_option('font_element');
		?>
		
		<!-- General Settings Starts -->
		<div id="pwpc-gfpw-general-sett" class="post-box-container pwpc-gfpw-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'General Settings', 'powerpack-lite' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table pwpc-gfpw-general-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="pwpc-gfpw-gf-font"><?php _e('Google Fonts', 'powerpack-lite'); ?></label>
										</th>
										<td>
											<div class="pwpc-gfpw-gf-font-wrp">
											<?php
											// Loop of selected stored fonts
											if( !empty($gf_site_fonts) ) {
												foreach ($gf_site_fonts as $gf_site_font_key => $gf_site_font_val) {

													$font_data 		= pwpcl_gfpw_get_font_data($gf_site_font_val);
													$font_family 	= !empty($font_data['font_family']) ? $font_data['font_family'] : __('N/A', 'powerpack-lite');
											?>

												<div class="pwpc-gfpw-gf-font-row">
													
													<span class="pwpc-gfpw-gf-font-family"><?php _e('Font Family', 'powerpack-lite') ?> - <i><?php echo $font_family; ?></i></span>

													<select name="pwpc_gfpw_options[gf_font][]" class="pwpc-gfpw-select-box pwpc-gfpw-gf-font">
														<option value=""><?php _e('-- Select Font --', 'powerpack-lite'); ?></option>
														<?php
														// Loop of google fonts
														if( !empty($gfpf_google_fonts) ) {
															foreach ($gfpf_google_fonts as $gf_key => $gf_val) {
														?>
														
														<optgroup label="<?php echo $gf_key; ?>">
															
															<?php 
															// Loop of fonts variants
															if( !empty($gf_val) ) {
																foreach ($gf_val as $variant_key => $variant_val) {					
															?>

															<option value="<?php echo $variant_key; ?>" <?php selected( $variant_key, $gf_site_font_val ); ?>><?php echo $gf_key.' - '.$variant_val; ?></option>

															<?php
																}
															} ?>

														</optgroup>

														<?php }
														}
														?>
													</select>
													<span class="pwpc-gfpw-icon pwpc-gfpw-add-gf-font-icon pwpc-gfpw-add-gf-font" title="<?php _e('Add Font', 'powerpack-lite'); ?>"><i class="dashicons dashicons-plus-alt"></i></span>
													<span class="pwpc-gfpw-icon pwpc-gfpw-remove-gf-font-icon pwpc-gfpw-remove-gf-font" title="<?php _e('Remove Font', 'powerpack-lite'); ?>"><i class="dashicons dashicons-dismiss"></i></span>
												</div><!-- end .pwpc-gfpw-gf-font-row -->

											<?php
												}
											}
											?>
											</div><!-- end .pwpc-gfpw-gf-font-wrp -->
											<span class="description"><?php _e('Select google fonts which you want to load on site.', 'powerpack-lite'); ?></span>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<label for="pwpc-gfpw-gf-font"><?php _e('Apply Google Fonts to Element', 'powerpack-lite'); ?></label>
										</th>
										<td>
										<?php
											if( !empty($font_elements) ){
												foreach ($font_elements as $ele_key => $ele_value) {
										?>
												<div class="pwpc-gfpw-font-ele-row">
													<label for="pwpc-gfpw-ele-<?php echo $ele_key; ?>" class="pwpc-gfpw-ele"><?php echo $ele_value; ?></label>
													<select name="pwpc_gfpw_options[font_element][<?php echo $ele_key; ?>]" id="pwpc-gfpw-ele-<?php echo $ele_key; ?>" class="pwpc-gfpw-select-box pwpc-gfpw-site-ele-font">
														<option value=""><?php _e('-- Select Font --', 'powerpack-lite'); ?></option>

														<?php
														// Loop of selected stored fonts
														if( !empty($gf_site_fonts) ) {
															foreach ($gf_site_fonts as $gf_site_font_key => $gf_site_font_val) {

																// If empty then return
																if( empty($gf_site_font_val) ) {
																	continue;
																}

																$font_data 		= pwpcl_gfpw_get_font_data($gf_site_font_val);
																$font_family 	= $font_data['font_family'];
																$font_name		= (!empty($font_family) && !empty($gfpf_google_fonts[$font_family][$gf_site_font_val])) ? $font_family.' - '.$gfpf_google_fonts[$font_family][$gf_site_font_val] : __('N/A', 'powerpack-lite');
																$ele_font		= isset($site_font_elements[$ele_key]) ? $site_font_elements[$ele_key] : '';
													?>
														
														<option value="<?php echo $gf_site_font_val; ?>" <?php selected( $ele_font, $gf_site_font_val ); ?>><?php echo $font_name; ?></option>

													<?php	} // End of foreach
														} // End of if
														?>
													</select>
												</div><!-- end .pwpc-gfpw-font-ele-row -->
										<?php	}
											}
											?>
											<br/>
											<span class="description"><?php _e('Select google font for site element.', 'powerpack-lite'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="pwpc-gfpw-settings-submit" name="pwpc-gfpw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','powerpack-lite'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #pwpc-gfpw-general-sett -->
		<!-- General Settings Ends -->
		
	</form><!-- end .pwpc-gfpw-settings-form -->
	
</div><!-- end .pwpc-gfpw-settings -->