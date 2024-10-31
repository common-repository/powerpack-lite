<?php
/**
 * Plugin Dashboard Functionality
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $pwpc_options;

$pwpc_module_cats 	= pwpcl_register_module_cats();
$pwpc_modules 		= pwpcl_plugin_modules();
$active_modules 	= PWPC_Lite()->active_modules;
$active_tab 		= !empty($_GET['tab']) ? $_GET['tab'] : 'active_modules';

// Little tweak to remove `search` param from REQUEST_URI
if( !empty( $_GET['page'] ) && $_GET['page'] == PWPCL_PAGE_SLUG && isset( $_GET['search'] ) ) {
	$_SERVER['REQUEST_URI'] = remove_query_arg( 'search', $_SERVER['REQUEST_URI'] );
}
?>

<div class="wrap pwpc-dashboard-wrap">
	<h2><?php _e('PowerPack Dashboard', 'powerpack-lite'); ?></h2>

	<?php if(isset($_POST['pwpc_resett_sett']) && !empty($_POST['pwpc_resett_sett'])) {

		// Resett message
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>' . __( 'All settings reset successfully.', 'powerpack-lite') . '</strong></p>
			  </div>';
			
	} else if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		
		// Success message
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "powerpack-lite").'</strong></p>
			  </div>';
	}
	?>

	<form action="" method="post" class="pwpc-right">
		<div class="textright">
			<input type="submit" name="pwpc_resett_sett" value="<?php _e('Reset Settings', 'powerpack-lite'); ?>" class="pwpc-btn button button-primary button-large pwpc-reset-sett pwpc-resett-sett-btn" id="pwpc-resett-module-btn" />
		</div>
	</form><!-- Reset settings form -->

	<form action="options.php" method="POST" class="pwpc-module-form" id="pwpc-module-form">

		<?php
		    settings_fields( 'pwpc_module_options' );
		?>

		<div class="textright pwpc-clearfix">
			<input type="submit" name="pwpc_save_module" value="<?php _e('Save Changes', 'powerpack-lite'); ?>" class="pwpc-btn pwpc-save-module-btn button button-primary button-large" id="pwpc-save-module-btn" />
		</div>

		<div class="pwpc-dashboard-header pwpc-clearfix" id="pwpc-dashboard-header">
			<div class="pwpc-dashboard-header-title"><?php _e('PowerPack', 'powerpack-lite'); ?></div>
			<div class="pwpc-dashboard-search-icon"><span class="pwpc-tooltip" title="<?php _e('Search', 'powerpack-lite'); ?>"><i class="dashicons dashicons-search"></i></span></div>
			<div class="pwpc-dashboard-search-wrap pwpc-hide">
				<input class="large-text pwpc-dashboard-search" placeholder="<?php _e('Search for a module', 'powerpack-lite'); ?>" type="text" />
			</div>
		</div><!-- end .pwpc-dashboard-header -->

		<div class="pwpc-module-vtabs-wrap pwpc-clearfix" data-default-tab="pwpc-tab-cnt-modules">
			<?php if( !empty($pwpc_module_cats) && isset($pwpc_module_cats[$active_tab]) && !empty($pwpc_modules) ) { ?>

			<ul class="pwpc-module-vtabs-nav-wrap">
			<?php foreach ($pwpc_module_cats as $module_cat_key => $module_cat_data) {

					// If no module is there for this category then continue
					if( empty($module_cat_key) ) {
						continue;
					}

					$module_cat_key 	= sanitize_title($module_cat_key);
					$module_cat_icon	= !empty($module_cat_data['icon']) ? $module_cat_data['icon'] 	: 'dashicons dashicons-admin-generic';
					$module_name		= !empty($module_cat_data['name']) ? $module_cat_data['name'] 	: __('No Title', 'powerpack-lite');
					$active_tab_cls 	= ($module_cat_key == $active_tab) ? 'pwpc-module-active-vtab'	: '';
					$tab_link			= add_query_arg( array('page' => PWPCL_PAGE_SLUG, 'tab' => $module_cat_key), admin_url('admin.php') );
			?>

				<li class="pwpc-module-vtabs-nav <?php echo $active_tab_cls; ?>" id="pwpc-module-nav-<?php echo $module_cat_key; ?>">
					<a href="<?php echo $tab_link; ?>" data-cls="pwpc-tab-cnt-<?php echo $module_cat_key; ?>"><i class="<?php echo $module_cat_icon; ?>"></i> <?php echo $module_name; ?></a>
				</li>

			<?php } ?>
			</ul><!-- tab navigation -->

			<div class="pwpc-module-cnt-wrp pwpc-tab-cnt-<?php echo $active_tab; ?> pwpc-clearfix">

				<?php
				// Tab content before action
				do_action( 'pwpc_module_tab_cnt_before', $active_tab, $pwpc_module_cats, $pwpc_modules, $active_modules );

				// Tab content action
				do_action( 'pwpc_module_tab_cnt_'.$active_tab, $pwpc_module_cats, $pwpc_modules, $active_modules );

				// Tab content after action
				do_action( 'pwpc_module_tab_cnt_after', $active_tab, $pwpc_module_cats, $pwpc_modules, $active_modules );
				?>

			</div><!-- end .pwpc-module-cnt-wrp -->

			<?php } else { ?>

			<div class="pwpc-no-module"><?php _e('Sorry, something happend wrong.', 'powerpack-lite'); ?></div>

			<?php } ?>

			<div class="pwpc-save-info-wrap pwpc-hide">
				<?php _e('Hey, Sparky some settings has been changed. Do not forget to save.', 'powerpack-lite'); ?>
				<div class="pwpc-save-info-btn-wrap"><input id="pwpc-save-notify-btn" class="pwpc-btn pwpc-save-notify-btn" name="pwpc_save_module" value="<?php _e('Save Changes', 'powerpack-lite'); ?>" type="submit" /><span class="pwpc-save-info-close" title="<?php _e('Close', 'powerpack-lite'); ?>"><i class="dashicons dashicons-dismiss"></i></span></div>
			</div>
		</div><!-- end .pwpc-module-vtabs-wrap -->

		<div class="pwpc-dashboard-footer pwpc-clearfix" id="pwpc-dashboard-footer">
			<?php echo __('PowerPack Lite', 'powerpack-lite') .' '. PWPCL_VERSION; ?>
		</div><!-- end .pwpc-dashboard-footer -->
	</form>
</div><!-- end .wrap -->