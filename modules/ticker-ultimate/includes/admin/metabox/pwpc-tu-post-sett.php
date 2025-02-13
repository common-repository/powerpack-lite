<?php
/**
 * Handles 'Ticker' post settings metabox HTML
 *
 * @package Ticker Ultimate
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = PWPCL_TU_META_PREFIX; // Metabox prefix

// Getting saved values
$read_more_link = get_post_meta( $post->ID, $prefix.'more_link', true );
?>

<table class="form-table pwpc-tu-post-sett-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="pwpc-tu-more-link"><?php _e('Read More Link', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_url($read_more_link); ?>" class="large-text pwpc-tu-more-link" id="pwpc-tu-more-link" name="<?php echo $prefix; ?>more_link" /><br/>
				<span class="description"><?php _e('Add custom link for the ticker post. e.g', 'powerpack-lite'); ?> https://www.wponlinesupport.com</span>
			</td>
		</tr>
	</tbody>
</table><!-- end .pwpc-tu-post-sett-table -->