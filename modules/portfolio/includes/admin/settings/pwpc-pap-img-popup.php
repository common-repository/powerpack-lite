<?php
/**
 * Image Data Popup
 *
 * @package Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="pwpc-popup-data-wrp pwpc-pap-img-data-wrp pwpc-hide" data-flush="true">
	<div class="pwpc-popup-data-cnt">

		<div class="pwpc-popup-data-cnt-block">
			<div class="pwpc-popup-close pwpc-popup-close-wrp"><img src="<?php echo PWPCL_PAP_URL; ?>assets/images/close.png" alt="<?php _e('Close (Esc)', 'powerpack-lite'); ?>" title="<?php _e('Close (Esc)', 'powerpack-lite'); ?>" /></div>

			<div class="pwpc-popup-body-wrp pwpc-pap-popup-body-wrp">
			</div><!-- end .pwpc-pap-popup-body-wrp -->
			
			<div class="pwpc-img-loader pwpc-pap-img-loader"><?php _e('Please Wait', 'powerpack-lite'); ?> <span class="spinner"></span></div>

		</div><!-- end .pwpc-popup-data-cnt-block -->

	</div><!-- end .pwpc-popup-data-cnt -->
</div><!-- end .pwpc-pap-img-data-wrp -->
<div class="pwpc-popup-overlay pwpc-pap-popup-overlay"></div>