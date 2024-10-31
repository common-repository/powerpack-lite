<?php
/**
 * Public Class
 *
 * Handles the public side functionality of plugin
 *
 * @package PowerPack Lite
 * @subpackage Preloader
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PWPCL_Pl_Public {

	function __construct() {

		// calling loader in footer
		add_action( 'wp_footer', array($this, 'pwpcl_pl_loader_function') );
	}

	/**
	 * Function to add preloader in footer
	 * 
	 * @subpackage Preloader
	 * @since 1.0
	 */
	function pwpcl_pl_loader_function() {

		$is_preloader = pwpcl_pl_get_option('is_preloader');

		// If preloader is enabled
    	if($is_preloader == 1) {
    		$plwao_spinner 		= pwpcl_pl_get_option('plwao_spinner');
			$plwao_spinner_size = pwpcl_pl_get_option('plwao_spinner_size');
    ?>
			<style type="text/css">
				.pwpc-pl-site-loader{position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;}
				.pwpc-pl-site-loader{background: url(<?php echo PWPCL_PL_URL; ?>assets/images/<?php echo $plwao_spinner_size; ?>/<?php echo $plwao_spinner; ?>.gif) center no-repeat #ffffff;}
			</style>
			<div class="pwpc-pl-site-loader"></div>

	    	<script type="text/javascript">
           	jQuery(window).load(function() {
				jQuery(".pwpc-pl-site-loader").fadeOut('slow'); // Animate loader off screen
			});
	        </script>
	<?php
        }
	}
}

$pwpcl_pl_public = new PWPCL_Pl_Public();