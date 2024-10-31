<?php
/**
 * Settings Page
 *
 * @package Custom CSS JS
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Plugin tabs
$plugins_sett_tab = array(
						'pwpc-ccj-settings' 	=> __('Plugin Settings', 'powerpack-lite'),
						'pwpc-ccj-about' 		=> __('How It Works', 'powerpack-lite')
					);

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'pwpc-ccj-settings';
?>

<div class="wrap pwpc-sett-wrap">

	<h2><?php _e( 'Custom CSS - JS Settings', 'powerpack-lite' ); ?></h2><br />

	<h2 class="nav-tab-wrapper">
		<?php foreach ($plugins_sett_tab as $tab_key => $tab_val) { 
			$tab_url 		= add_query_arg( array( 'page' => 'pwpc-ccj-settings', 'tab' => $tab_key ), admin_url('admin.php') );
			$active_tab_cls = ($tab == $tab_key) ? 'nav-tab-active' : '';
		?>
			<a class="nav-tab <?php echo $active_tab_cls; ?>" href="<?php echo $tab_url; ?>"><?php echo $tab_val; ?></a>
		<?php } ?>
	</h2>

	<?php
	// Plugin files
	if( $tab == 'pwpc-ccj-about' ) {
		include_once( PWPCL_CCJ_DIR . '/includes/admin/pwpc-ccj-how-it-work.php' );
	} else {
		include_once( PWPCL_CCJ_DIR . '/includes/admin/settings/pwpc-ccj-plugin-settings.php' );
	}
	?>

</div><!-- end .wrap -->