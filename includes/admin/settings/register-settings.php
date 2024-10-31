<?php
/**
 * Plugin setting functions file
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_default_settings() {

    global $pwpc_options;

    $pwpc_options = array();

    $default_options = apply_filters('pwpc_options_default_values', $pwpc_options );

    // Update default options
    update_option( 'pwpc_opts', $default_options );

    // Overwrite global variable when option is update
    $pwpc_options = pwpcl_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_settings( $key = 'pwpc_opts' ) {

    $options    = get_option( $key );
    $settings   = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_option( $opt_key = '', $key = '', $default = false, $unique = 'powerpack' ) {

    $value = ! empty( $opt_key[ $key ] ) ? $opt_key[ $key ] : $default;
    $value = apply_filters( 'pwpcl_get_option', $value, $key, $default, $opt_key, $unique );

    return apply_filters( 'pwpcl_get_option_' . $key, $value, $key, $default, $opt_key, $unique );
}

// Action to register plugin settings
add_action ( 'admin_init', 'pwpcl_register_module_settings' );

/**
 * Function register setings
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_register_module_settings() {
	register_setting( 'pwpc_module_options', 'pwpc_opts', 'pwpcl_validate_module_options' );
}

/**
 * Validate Settings Options
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_validate_module_options( $input = array() ) {

	global $pwpc_options;

	// Taking some variables
	$input = $input ? $input : array();

	$doing_save = false;
	if ( ! empty( $_POST['_wp_http_referer'] ) ) {
		$doing_save = true;
	}

	if ( $doing_save ) {
		parse_str( $_POST['_wp_http_referer'], $referrer ); // Pull out the tab
		$tab = isset( $referrer['tab'] ) ? $referrer['tab'] : 'modules';

		// Run a general sanitization for the tab for special fields
		$input = apply_filters( 'pwpc_settings_sanitize', $input );
		$input = apply_filters( 'pwpc_settings_' . $tab . '_sanitize', $input );
	}

	// Merge our new settings with the existing
	$output = array_merge( $pwpc_options, $input );

	$old_active_modules = PWPC_Lite()->active_modules;
	$new_active_modules = pwpcl_get_active_modules(true); // Get recently active modules

	$old_inactive_modules = PWPC_Lite()->inactive_modules;
	$new_inactive_modules = pwpcl_get_inactive_modules(true); // Get recently inactive modules

	$recently_active_module 	= array_diff_assoc($new_active_modules, $old_active_modules);
	$recently_deactive_module 	= array_diff_assoc($new_inactive_modules, $old_inactive_modules);

	$pwpc_modules_activity = array(
							'recently_active_module' 	=> $recently_active_module,
							'recently_deactive_module'	=> $recently_deactive_module
						);

	set_transient( 'pwpc_modules_activity', $pwpc_modules_activity, HOUR_IN_SECONDS );

	return $output;
}

/**
 * Render plugin modules
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_render_modules( $tab, $module_cats, $modules, $active_modules ) {

	// If no module is there then continue
	if( empty($tab) || empty($modules[$tab]) ) {
		return false;
	}

	$count 					= 1;
	$supports_info 			= pwpcl_module_support_info();
	$module_name 			= !empty($module_cats[$tab]['name']) ? $module_cats[$tab]['name'] : __('No Title', 'powerpack-lite');
	$cat_active_module 		= pwpcl_plugin_modules( 'active', $tab );
	$cat_inactive_module 	= pwpcl_plugin_modules( 'in_active', $tab );
	$cat_active_module_no	= count( $cat_active_module );
	$cat_inactive_module_no	= count( $cat_inactive_module );
?>

	<div class="pwpc-module-info-wrap">
		<div class="pwpc-module-title"><?php echo $module_name; ?></div>
		<?php if( !empty($module_cats[$tab]['desc']) ) { ?>
		<span class="pwpc-module-desc description"><?php echo $module_cats[$tab]['desc']; ?></span>
		<?php } ?>
	</div><!-- end .pwpc-module-info-wrap -->

	<div class="pwpc-site-modules-wrap pwpc-clearfix">
		<div class="pwpc-site-modules-inr-wrap pwpc-icolumns-wrap">

			<div class="pwpc-icolumns pwpc-medium-12 pwpc-module-sort-cat-wrap">
			<?php if( $tab == 'active_modules' ) {

				// Getting active category (Alt : array_columns)
				$active_cats = array_map(function($element){return $element['category'];}, $modules['active_modules']);
			?>
				<select class="pwpc-module-sort-cat pwpc-no-chage">
					<option value=""><?php _e('Select Category', 'powerpack-lite'); ?></option>
					<?php foreach ($module_cats as $module_cat_key => $module_cat_data) {

						// If no module is there for this category or no module is active for this category then continue
						if( empty($module_cat_key) || !isset($modules[$module_cat_key]) || empty($module_cat_data['is_filter']) || !in_array($module_cat_key, $active_cats) ) {
							continue;
						}

						$module_cat_name = !empty($module_cat_data['name']) ? $module_cat_data['name'] : $module_cat_key;
					?>
					<option value="<?php echo $module_cat_key; ?>" class="pwpc-module-filtr-cat" data-filter=".pwpc-site-module-<?php echo $module_cat_key; ?>"><?php echo $module_cat_name; ?></option>
					<?php } ?>
				</select>
			<?php } else {
				$active_disabled 	= empty($cat_active_module_no) ? 'disabled="disabled" title="'.__('No Module is Enabled', 'powerpack-lite').'"' 		: '';
				$inactive_disabled 	= empty($cat_inactive_module_no) ? 'disabled="disabled" title="'.__('No Module is Disabled', 'powerpack-lite').'"' 	: '';
			?>
				<select class="pwpc-module-sort-cat pwpc-no-chage">
					<option value=""><?php _e('Select All', 'powerpack-lite'); ?></option>
					<option value="active" <?php echo $active_disabled; ?>><?php _e('Enabled', 'powerpack-lite'); ?></option>
					<option value="inactive" <?php echo $inactive_disabled; ?>><?php _e('Disabled', 'powerpack-lite'); ?></option>
				</select>
			<?php } ?>
			</div><!-- end .pwpc-module-sort-cat-wrap -->

			<?php foreach ($modules[$tab] as $sub_module_key => $sub_module_data) {

				// If no module is there then continue
				if( empty($sub_module_key) ) {
					continue;
				}

				$sub_module_key 	= sanitize_title($sub_module_key);
				$sub_module_cat 	= $sub_module_data['category'];
				$sub_module_name 	= !empty($sub_module_data['name']) ? $sub_module_data['name'] : __('No Title', 'powerpack-lite');
				$sub_module_name 	= !empty($sub_module_data['premium']) ? $sub_module_name.' - <a href="https://www.wponlinesupport.com/pricing/#fndtn-lifetime" target="_blank">'.__('Premium Only', 'powerpack-lite').'</a>' : $sub_module_name;
				$conf_text			= !empty($sub_module_data['conf_text']) ? $sub_module_data['conf_text'] : __('Configure', 'powerpack-lite');
				$is_active_module 	= isset($active_modules[$sub_module_key]) ? 1 : 0;

				$module_cls = "pwpc-site-module-{$sub_module_cat} pwpc-site-module-{$sub_module_key}";
				$module_cls	.= ($is_active_module) ? ' pwpc-site-module-active' : ' pwpc-site-module-inactive';
				$module_cls .= !empty($sub_module_data['premium']) ? ' pwpc-site-module-premium' : '';
			?>

			<div class="pwpc-site-module-wrap pwpc-medium-6 <?php echo $module_cls; ?>">
				<div class="pwpc-site-module-data-wrap">					
					<div class="pwpc-site-module-title">
						<div class="pwpc-site-module-act">
							<?php if( !empty($sub_module_data['extra_info']) ) { ?>
							<i class="pwpc-tooltip pwpc-module-extra-info dashicons dashicons-info" data-tooltip-content="#<?php echo $sub_module_key; ?>-tooltip-content"></i>
							<?php } ?>
							<?php if( !empty($sub_module_data['path']) ) { ?>
							<input type="hidden" name="pwpc_opts[<?php echo $sub_module_cat; ?>_pack][<?php echo $sub_module_key; ?>]" value="0" />
							<label class="pwpc-check-switch pwpc-module-check-switch"><input type="checkbox" name="pwpc_opts[<?php echo $sub_module_cat; ?>_pack][<?php echo $sub_module_key; ?>]" value="1" class="pwpc-module-check" <?php checked( $is_active_module, 1 ); ?> data-module="<?php echo $sub_module_key; ?>" /><div class="pwpc-check-slider pwpc-check-switch-round"></div></label>
							<?php } ?>
						</div>
						<span><?php echo $sub_module_name; ?></span>
					</div>

					<div class="pwpc-site-module-desc"><?php echo $sub_module_data['desc']; ?></div>

					<?php if( $is_active_module && (!empty($sub_module_data['conf_link']) || !empty($sub_module_data['widget_link'])) ) { ?>
					<div class="pwpc-site-module-conf-wrap">
						<?php if( !empty($sub_module_data['conf_link']) ) { ?>
						<span class="pwpc-site-module-conf">
							<i class="dashicons dashicons-admin-generic"></i>
							<a href="<?php echo $sub_module_data['conf_link']; ?>"><?php echo $conf_text; ?></a>
						</span>
						<?php } ?>

						<?php if( !empty($sub_module_data['widget_link']) ) { ?>
						<span class="pwpc-site-module-widget">
							<i class="dashicons dashicons-schedule"></i>
							<a href="<?php echo $sub_module_data['widget_link']; ?>"><?php _e('Widgets', 'powerpack-lite'); ?></a>
						</span>
						<?php } ?>
					</div>
					<?php } ?>

					<?php if( !empty($sub_module_data['extra_info']) ) { ?>
					<div class="pwpc-tooltip-content pwpc-hide">
						<div id="<?php echo $sub_module_key; ?>-tooltip-content">
							<?php
							// If info is array then process else print simply
							if( is_array( $sub_module_data['extra_info'] ) ) {
								$info_title = !empty($sub_module_data['extra_info']['title']) ? $sub_module_data['extra_info']['title'] : $sub_module_name;
							?>
								<div class="pwpc-tooltip-title"><h3><?php echo $info_title; ?></h3></div>

								<?php if(!empty($sub_module_data['extra_info']['desc'])) { ?>
								<ul class="pwpc-info-features">
									<?php echo "<li>" . implode("</li><li>", (array)$sub_module_data['extra_info']['desc']) . "</li>" ?>
								</ul>
								<?php } ?>

								<?php if(!empty($sub_module_data['extra_info']['supports'])) { ?>
								<div class="pwpc-info-supports">
								<?php foreach ($sub_module_data['extra_info']['supports'] as $supp_key => $supp_val) {

									if( !isset($supports_info[$supp_val]) ) {
										continue;
									}

									$supports_title = isset($supports_info[$supp_val]['title']) ? $supports_info[$supp_val]['title'] 	: '';
									$supports_icon 	= !empty($supports_info[$supp_val]['icon']) ? $supports_info[$supp_val]['icon'] 	: 'dashicons-admin-generic';

									echo "<i title='{$supports_title}' class='dashicons {$supports_icon}'></i>";
								} ?>
								</div>
								<?php } ?>

							<?php } else {
								echo $sub_module_data['extra_info'];
							}
							?>
						</div>
					</div>
					<?php } // End of extra info ?>
				</div>
			</div><!-- end .pwpc-site-module-wrap -->

			<?php
				$count++;
			} ?>
			<div class="pwpc-columns pwpc-medium-12 pwpc-hide pwpc-no-module-search"><?php _e('Sorry, nothing matched to your search criteria. Please refine you search or search category.', 'powerpack-lite'); ?></div>
		</div><!-- end .pwpc-site-modules-inr-wrap -->
	</div><!-- end .pwpc-site-modules-wrap -->
<?php
}
add_action( 'pwpc_module_tab_cnt_before', 'pwpcl_render_modules', 10, 4 );

/**
 * Render active module tab cnt when no module is active
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_render_active_module_cnt( $module_cats, $modules, $active_modules ) {

	// If module is active then return
	if( !empty($active_modules) ) {
		return false;
	}

	$module_link 		= add_query_arg( array('page' => PWPCL_PAGE_SLUG, 'tab' => 'modules'), admin_url('admin.php') );
	$widgets_link 		= add_query_arg( array('page' => PWPCL_PAGE_SLUG, 'tab' => 'widgets'), admin_url('admin.php') );
	$appearance_link 	= add_query_arg( array('page' => PWPCL_PAGE_SLUG, 'tab' => 'appearance'), admin_url('admin.php') );
	$tour_link 			= pwpcl_get_plugin_link('tour');
?>

	<div class="pwpc-module-welcome-wrap pwpc-clearfix">
		<div class="pwpc-module-welcome-logo"><img src="<?php echo PWPCL_URL.'assets/images/powerpack-icon.png'?>" alt="" /></div>

		<div class="pwpc-module-welcome-text">
			<?php _e('You have no module active!', 'powerpack-lite'); ?> <br />
			<?php _e('Activate and Enjoy', 'powerpack-lite'); ?>
		</div>

		<div class="pwpc-module-welcome-btn-group">
			<a class="pwpc-welcome-btn" href="<?php echo $module_link; ?>">
				<i class="dashicons dashicons-admin-plugins"></i> <?php _e('Add Modules', 'powerpack-lite'); ?>
			</a>

			<a class="pwpc-welcome-btn pwpc-btn-green" href="<?php echo $widgets_link; ?>">
				<i class="dashicons dashicons-schedule"></i> <?php _e('Add Widgets', 'powerpack-lite'); ?>
			</a>

			<a class="pwpc-welcome-btn pwpc-btn-yellow" href="<?php echo $appearance_link; ?>">
				<i class="dashicons dashicons-admin-appearance"></i> <?php _e('Site Appearance', 'powerpack-lite'); ?>
			</a>

			<br/><br/>
			<a class="pwpc-welcome-btn pwpc-btn-red pwpc-btn-large" href="<?php echo $tour_link; ?>">
				<i class="dashicons dashicons-lightbulb"></i> <?php _e('Start a Tour', 'powerpack-lite'); ?>
			</a>
		</div>
	</div><!-- end .pwpc-module-welcome-wrap -->

<?php
}
add_action( 'pwpc_module_tab_cnt_active_modules', 'pwpcl_render_active_module_cnt', 10, 3 );