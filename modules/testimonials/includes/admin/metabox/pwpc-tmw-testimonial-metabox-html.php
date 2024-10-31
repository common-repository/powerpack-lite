<?php
/**
 * Handles testimonial metabox HTML
 *
 * @package WP Testimonials with rotator widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = PWPC_TMW_META_PREFIX; // Metabox prefix

// Getting saved values
$client 	= get_post_meta( $post->ID, $prefix.'testimonial_client', true );
$job 		= get_post_meta( $post->ID, $prefix.'testimonial_job', true );
$company 	= get_post_meta( $post->ID, $prefix.'testimonial_company', true );
$url 		= get_post_meta( $post->ID, $prefix.'testimonial_url', true );
?>

<table class="form-table pwpc-tstmnl-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="pwpc-client-name"><?php _e('Client Name', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo pwpcl_esc_attr($client); ?>" class="regular-text" id="pwpc-client-name" name="<?php echo $prefix; ?>testimonial_client" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-job-title"><?php _e('Job Title', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo pwpcl_esc_attr($job); ?>" class="regular-text" id="pwpc-job-title" name="<?php echo $prefix; ?>testimonial_job" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-company"><?php _e('Company', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo pwpcl_esc_attr($company); ?>" class="regular-text" id="pwpc-company" name="<?php echo $prefix; ?>testimonial_company" />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-url"><?php _e('URL', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo esc_url($url); ?>" class="regular-text" id="pwpc-url" name="<?php echo $prefix; ?>testimonial_url" />
			</td>
		</tr>
	</tbody>
</table><!-- end .pwpc-tstmnl-table -->