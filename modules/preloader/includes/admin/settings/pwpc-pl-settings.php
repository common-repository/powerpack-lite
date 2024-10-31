<?php
/**
 * Settings Page
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.4
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Plugin tabs
$plugins_sett_tab = array(
						'pwpc-pl-settings' 	=> __('Plugin Settings', 'powerpack-lite'),
						'pwpc-pl-about' 		=> __('How It Works', 'powerpack-lite')
					);

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'pwpc-pl-settings';
?>

<div class="wrap">

	<h2><?php _e( 'Preloader for Website', 'powerpack-lite' ); ?></h2><br />

	<h2 class="nav-tab-wrapper">
		<?php foreach ($plugins_sett_tab as $tab_key => $tab_val) { 
			$tab_url 		= add_query_arg( array( 'page' => 'pwpc-pl-settings', 'tab' => $tab_key ), admin_url('admin.php') );
			$active_tab_cls = ($tab == $tab_key) ? 'nav-tab-active' : '';
		?>
			<a class="nav-tab <?php echo $active_tab_cls; ?>" href="<?php echo $tab_url; ?>"><?php echo $tab_val; ?></a>
		<?php } ?>
	</h2>

	<?php
	// Plugin files
	if( $tab == 'pwpc-pl-about' ) {
		include_once( PWPCL_PL_DIR . '/includes/admin/pwpc-pl-how-it-work.php' );
	} else {
		include_once( PWPCL_PL_DIR . '/includes/admin/settings/pwpc-pl-plugin-settings.php' );
	}
	?>

</div><!-- end .wrap -->