<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = PWPCL_VGP_META_PREFIX; // Metabox prefix

// Getting saved values
$selected_tab 	= get_post_meta($post->ID, $prefix.'tab', true);
$video_mp4 		= get_post_meta($post->ID, $prefix.'video_mp4', true);
$video_wbbm 	= get_post_meta($post->ID, $prefix.'video_wbbm', true);
$video_ogg 		= get_post_meta($post->ID, $prefix.'video_ogg', true);
$video_oth 		= get_post_meta($post->ID, $prefix.'video_oth', true);
?>

<div class="pwpc-htab-main-wrp">
	<ul id="pwpc-htab-tabs" class="pwpc-htab-tabs">
		<li class="pwpc-htab-nav pwpc-htab-active">
			<a href="#pwpc-vgp-html5"><?php _e('HTML5', 'powerpack-lite'); ?></a>
		</li>		
		<li class="pwpc-htab-nav">
			<a href="#pwpc-vgp-oth"><?php _e('Video Link', 'powerpack-lite'); ?></a>
		</li>
	</ul>

	<div id="pwpc-vgp-html5" class="pwpc-vgp-html5 pwpc-htab-cnt" style="display:block;">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="link-for-mp4"><?php _e('video/mp4', 'powerpack-lite'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo pwpcl_esc_attr($video_mp4); ?>" class="large-text" id="link-for-mp4" name="<?php echo $prefix; ?>video_mp4" /><br/>
						<span class="description"><?php _e('ie http://videolink.mp4', 'powerpack-lite'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="link-for-webm"><?php _e('video/webm', 'powerpack-lite'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo pwpcl_esc_attr($video_wbbm); ?>" class="large-text" id="link-for-webm" name="<?php echo $prefix; ?>video_wbbm" /><br/>
						<span class="description"><?php _e('ie http://videolink.webm', 'powerpack-lite'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="link-for-ogg"><?php _e('video/ogg', 'powerpack-lite'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo pwpcl_esc_attr($video_ogg); ?>" class="large-text" id="link-for-ogg" name="<?php echo $prefix; ?>video_ogg" /><br/>
						<span class="description"><?php _e('ie http://videolink.ogg', 'powerpack-lite'); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div><!-- end .pwpc-vgp-html5 -->

	<div id="pwpc-vgp-oth" class="pwpc-vgp-oth pwpc-htab-cnt">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="pwpc-vgp-oth-link"><?php _e('Other Link', 'powerpack-lite'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo pwpcl_esc_attr($video_oth); ?>" class="large-text" id="pwpc-vgp-oth-link" name="<?php echo $prefix; ?>video_oth" /><br/>
						<span class="description"><?php _e('Enter embed link of video.', 'powerpack-lite'); ?> ie https://www.youtube.com/watch?v=07IRBn1oXrU</span>
					</td>
				</tr>
			</tbody>
		</table><!-- end .wtwp-tstmnl-table -->
	</div><!-- end .pwpc-vgp-oth -->

	<input type="hidden" value="<?php echo $selected_tab; ?>" class="pwpc-htab-selected-tab" name="<?php echo $prefix; ?>tab" />
</div><!-- end .pwpc-htab-main-wrp -->