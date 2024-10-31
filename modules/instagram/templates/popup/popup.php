<div id="pwpc-iscwp-popup-<?php echo $unique.'-'.$count; ?>" class="pwpc-iscwp-popup-box pwpc-iscwp-popup-design-1 pwpc-iscwp-popup-content mfp-hide" <?php echo $popup_attr; ?>>

	<a href="javascript:void(0);" class="pwpc-iscwp-popup-close wp-iscwp-close-btn mfp-close" title="<?php _e('Close (Esc)', 'pwpc'); ?>"></a>

	<div class="pwpc-iscwp-popup-body">
	<?php if( $media_data ) { include( PWPCL_ISCWP_DIR . '/templates/popup/design-1.php' ); } ?>
	</div>

	<div class="pwpc-loader pwpc-loader-full pwpc-iscwp-loader">
		<div class="pwpc-loading-bar"></div><div class="pwpc-loading-bar"></div><div class="pwpc-loading-bar"></div><div class="pwpc-loading-bar"></div>
	</div>
</div>