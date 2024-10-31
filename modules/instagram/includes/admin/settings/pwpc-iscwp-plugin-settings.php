<?php
/**
 * Settings Page
 *
 * @subpackage Instagram
 * @since 1.0.0
 */

// Taking some variables
$stored_transient 	= get_option('pwpc_iscwp_cache_transient');

// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
	<p><strong>'.__("Your changes saved successfully.", "powerpack-lite").'</strong></p>
		  </div>';
}
?>
<div class="pwpc-iscwp-settings pwpc-pad-top-20">
	<form action="options.php" method="POST" id="pwpc-iscwp-frm-settings-form" class="pwpc-iscwp-frm-settings-form">

		<?php
		    settings_fields( 'pwpc_iscwp_plugin_options' );
		?>

		<!-- Flush Settings Starts -->
		<div id="pwpc-iscwp-cache-tbl" class="post-box-container pwpc-iscwp-cache-tbl">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Flush Cache', 'powerpack-lite' ); ?></span>
						</h3>

						<div class="inside pwpc-iscwp-cache-user" id="pwpc-iscwp-cache-user">

							<table class="form-table">
								<tbody>
								<tr>
									<td colspan="2">
										<input type="button" value="<?php _e('Flush All Cache', 'powerpack-lite'); ?>" class="button button-secondary right iscwp-crl-all-cache" />
									</td>
								</tr>

								<?php if( $stored_transient ) {
									foreach ($stored_transient as $user) {
										$user 		= explode('_', $user);
										$user_key	= end($user);
								?>
										<tr class="pwpc-iscwp-user-cache-row">
											<th scope="row">
												<b><?php echo $user_key; ?></b>
											</th>
											<td>
												<div class="pwpc-iscwp-ajax-btn-wrap">
													<input type="button" value="<?php _e('Clear Cache', 'powerpack-lite'); ?>" class="button button-secondary iscwp-crl-cache" data-user="<?php echo $user_key; ?>" />
													<span class="spinner pwpc-no-float"></span>
												</div>
											</td>
										</tr>
								<?php }
								} ?>
									<tr class="pwpc-iscwp-cache-empty <?php if($stored_transient){echo 'pwpc-hide';} ?>">
										<td><?php _e('No cache data found.', 'powerpack-lite'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Flush Settings end -->
	</form><!-- end .pwpc-iscwp-frm-settings-form -->
</div><!-- end .pwpc-iscwp-settings -->