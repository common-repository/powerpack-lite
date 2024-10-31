<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = PWPCL_LS_META_PREFIX; // Metabox prefix

// Getting saved values
$logo_link 	= get_post_meta( $post->ID, $prefix.'logo_link', true );
?>

<table class="form-table pwpc-ls-metabox-tbl">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="pwpc-ls-logo-link"><?php _e('Logo Link', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_url($logo_link); ?>" class="large-text pwpc-ls-logo-link" id="pwpc-ls-logo-link" name="<?php echo $prefix; ?>logo_link" /><br/>
				<span class="description"><?php _e('Enter link url for logo. i.e https://www.wponlinesupport.com', 'powerpack-lite'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .pwpc-ls-metabox-tbl -->