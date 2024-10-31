<?php
/**
 * Popup Image Data HTML
 *
 * @package Portfolio and Projects
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$prefix = PWPCL_PAP_META_PREFIX;

// Taking some values
$alt_text 			= get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
$attachment_link 	= get_post_meta( $attachment_id, $prefix.'attachment_link', true );
?>

<div class="pwpc-popup-title pwpc-pap-popup-title"><?php _e('Edit Image', 'powerpack-lite'); ?></div>
	
<div class="pwpc-pap-popup-body pwpc-popup-body">

	<form method="post" class="pwpc-pap-attachment-form">
		
		<?php if( !empty($attachment_post->guid) ) { ?>
		<div class="pwpc-popup-img-preview pwpc-pap-popup-img-preview">
			<img src="<?php echo $attachment_post->guid; ?>" alt="" />
		</div>
		<?php } ?>
		<a href="<?php echo get_edit_post_link( $attachment_id ); ?>" target="_blank" class="pwpc-icon-btn button right"><i class="dashicons dashicons-edit"></i> <?php _e('Edit Image From Attachment Page', 'powerpack-lite'); ?></a>

		<table class="form-table">
			<tr>
				<th><label for="pwpc-pap-attachment-title"><?php _e('Title', 'powerpack-lite'); ?>:</label></th>
				<td>
					<input type="text" name="pwpc_pap_attachment_title" value="<?php echo pwpcl_esc_attr($attachment_post->post_title); ?>" class="large-text pwpc-pap-attachment-title" id="pwpc-pap-attachment-title" />
					<span class="description"><?php _e('Enter image title.', 'powerpack-lite'); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="pwpc-pap-attachment-alt-text"><?php _e('Alternative Text', 'powerpack-lite'); ?>:</label></th>
				<td>
					<input type="text" name="pwpc_pap_attachment_alt" value="<?php echo pwpcl_esc_attr($alt_text); ?>" class="large-text pwpc-pap-attachment-alt-text" id="pwpc-pap-attachment-alt-text" />
					<span class="description"><?php _e('Enter image alternative text.', 'powerpack-lite'); ?></span>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="right">
					<div class="pwpc-pap-success pwpc-success pwpc-hide"></div>
					<div class="pwpc-pap-error pwpc-error pwpc-hide"></div>
					<span class="spinner pwpc-pap-spinner pwpc-spinner"></span>
					<button type="button" class="button button-primary pwpc-icon-btn pwpc-pap-save-attachment-data" data-id="<?php echo $attachment_id; ?>"><i class="dashicons dashicons-yes"></i> <?php _e('Save Changes', 'powerpack-lite'); ?></button>
					<button type="button" class="button pwpc-popup-close pwpc-pap-popup-close"><?php _e('Close', 'powerpack-lite'); ?></button>
				</td>
			</tr>
		</table>
	</form><!-- end .pwpc-pap-attachment-form -->

</div><!-- end .pwpc-pap-popup-body -->