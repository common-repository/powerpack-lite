<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = PWPCL_PAP_META_PREFIX; // Metabox prefix

// Getting meta values
$gallery_imgs 	= get_post_meta( $post->ID, $prefix.'gallery_id', true );
$project_url 	= get_post_meta( $post->ID, $prefix.'project_url', true );

// Slider meta and setting some default value for meta
$arrow_slider 				= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
$pagination_slider 			= get_post_meta( $post->ID, $prefix.'pagination_slider', true );
$autoplayspeed_slider 		= get_post_meta( $post->ID, $prefix.'autoplayspeed_slider', true );
$speed_slider 				= get_post_meta( $post->ID, $prefix.'speed_slider', true );

$no_img_cls					= !empty($gallery_imgs) 			? 'pwpc-hide' 			: '';
$arrow_slider 				= ($arrow_slider != '') 			? $arrow_slider 		: 1;
$pagination_slider 			= ($pagination_slider != '') 		? $pagination_slider 	: 1;
$autoplayspeed_slider 		= (!empty($autoplayspeed_slider)) 	? $autoplayspeed_slider : 3000 ;
$speed_slider 				= (!empty($speed_slider)) 			? $speed_slider 		: 300 ;
?>

<table class="form-table pwpc-pap-post-sett-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="pwpc-pap-project-link"><?php _e('Portfolio Link', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="url" id="pwpc-pap-project-link" class="large-text pwpc-pap-project-link" name="<?php echo $prefix ?>project_url" value="<?php echo esc_url($project_url); ?>"><br/>
				<span class="description"><?php _e('Enter portfolio link.', 'powerpack-lite'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-pap-gallery-imgs"><?php _e('Choose Portfolio Gallery Images', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary pwpc-icon-btn pwpc-pap-img-uploader pwpc-image-upload" id="pwpc-pap-gallery-imgs" data-multiple="true" data-button-text="<?php _e('Add to Gallery', 'powerpack-lite'); ?>" data-title="<?php _e('Add Images to Gallery', 'powerpack-lite'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php _e('Gallery Images', 'powerpack-lite'); ?></button>
				<button type="button" class="button button-secondary pwpc-icon-btn pwpc-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php _e('Remove Gallery Images', 'powerpack-lite'); ?></button><br/>
				
				<div class="pwpc-gallery-imgs-prev pwpc-img-preview pwpc-pap-gallery-imgs-prev">
					<?php if( !empty($gallery_imgs) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url 		= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="pwpc-pap-img-wrp pwpc-gallery-img-wrp">
								<div class="pwpc-pap-img-tools pwpc-img-tools">
									<span class="pwpc-tool-icon pwpc-pap-tool-icon pwpc-pap-edit-img dashicons dashicons-edit" title="<?php _e('Edit Image in Popup', 'powerpack-lite'); ?>"></span>
									<a href="<?php echo $attachment_edit_link; ?>" target="_blank" title="<?php _e('Edit Image', 'powerpack-lite'); ?>"><span class="pwpc-tool-icon pwpc-pap-tool-icon pwpc-pap-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="pwpc-tool-icon pwpc-pap-tool-icon pwpc-gallery-del-img dashicons dashicons-no" title="<?php _e('Remove Image', 'powerpack-lite'); ?>"></span>
								</div>
								<img class="pwpc-gallery-img pwpc-pap-img" src="<?php echo $attachment_url; ?>" alt="" />
								<input type="hidden" class="pwpc-pap-attachment-no" name="pwpc_pap_img[]" value="<?php echo $img_data; ?>" />
							</div><!-- end .pwpc-pap-img-wrp -->
					<?php }
					} ?>
					<p class="pwpc-no-img-placeholder pwpc-pap-no-img-placeholder <?php echo $no_img_cls; ?>"><?php _e('No Gallery Images', 'powerpack-lite'); ?></p>
				</div>
				<span class="description"><?php _e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'powerpack-lite'); ?></span>
			</td>
		</tr>

		<tr>
			<th colspan="2">
				<div class="pwpc-sub-sett-title"><?php _e('Portfolio Gallery Slider Settings', 'powerpack-lite'); ?></div>
			</th>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-pap-slider-arrow"><?php _e('Slider Arrow', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="checkbox" value="1" name="<?php echo $prefix; ?>arrow_slider" id="pwpc-pap-slider-arrow" class="pwpc-pap-slider-arrow" <?php checked( 1, $arrow_slider ); ?> /><br/>
				<span class="description"><?php _e('Check this box to enable gallery slider arrow.','powerpack-lite'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-pap-slider-pagination"><?php _e('Slider Pagination Dots', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo $prefix; ?>pagination_slider" value="1" id="pwpc-pap-slider-pagination" class="pwpc-pap-slider-pagination" <?php checked( 1, $pagination_slider ); ?> /><br/>
				<span class="description"><?php _e('Check this box to enable gallery slider pagination dots.','powerpack-lite'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-pap-autoplay-interval"><?php _e('Autoplay Interval', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="number" name="<?php echo $prefix; ?>autoplayspeed_slider" value="<?php echo $autoplayspeed_slider; ?>" id="pwpc-pap-autoplay-interval" class="small-text pwpc-pap-autoplay-interval" step="100" min="0" /> <?php _e('Milisecond', 'powerpack-lite'); ?><br/>
				<span class="description"><?php _e('Enter slider autoplay interval.','powerpack-lite'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-pap-slider-speed"><?php _e('Speed', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="number" name="<?php echo $prefix; ?>speed_slider" value="<?php echo $speed_slider; ?>" id="pwpc-pap-slider-speed" class="pwpc-pap-slider-speed small-text" step="50" min="0" /><br/>
				<span class="description"><?php _e('Enter slider speed.', 'powerpack-lite'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .pwpc-pap-post-sett-table -->

<script type="text/html" id="tmpl-pwpc-pap-img-gallery">
	<div class="pwpc-gallery-img-wrp pwpc-pap-img-wrp">
        <div class="pwpc-img-tools pwpc-pap-img-tools">
            <span class="pwpc-tool-icon pwpc-pap-tool-icon pwpc-pap-edit-img dashicons dashicons-edit" title="<?php _e('Edit Image in Popup', 'powerpack-lite'); ?>"></span>
            <a href="{{data.attachment_edit_link}}" target="_blank" title="<?php _e('Edit Image', 'powerpack-lite'); ?>"><span class="pwpc-tool-icon pwpc-pap-tool-icon pwpc-pap-edit-attachment dashicons dashicons-visibility"></span></a>
            <span class="pwpc-tool-icon pwpc-pap-tool-icon pwpc-gallery-del-img dashicons dashicons-no" title="<?php _e('Remove Image', 'powerpack-lite'); ?>"></span>
        </div>
        <img class="pwpc-gallery-img pwpc-pap-img" src="{{data.attachment_url}}" alt="" />
        <input type="hidden" class="pwpc-pap-attachment-no" name="pwpc_pap_img[]" value="{{data.attachment_id}}" />
    </div>
</script>