<?php
/**
 * Handles team member details metabox HTML
 *
 * @package PowerPack Lite
 * @subpackage Team Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = PWPCL_TS_META_PREFIX; // Metabox prefix

$social_services = pwpcl_ts_social_scrvices(); // Getting social service

// Getting saved values
$selected_tab 		= get_post_meta($post->ID, $prefix.'tab', true);
$member_department 	= get_post_meta( $post->ID, $prefix.'member_department', true );
$member_designation = get_post_meta( $post->ID, $prefix.'member_designation', true );
$member_skills 		= get_post_meta( $post->ID, $prefix.'skills', true );
$member_experience 	= get_post_meta( $post->ID, $prefix.'member_experience', true );
$social 			= get_post_meta( $post->ID, $prefix.'social', true );
$social 			= !empty($social) ? $social : array();
?>

<div class="pwpc-htab-main-wrp pwpc-ts-tab-main-wrp">
	<ul id="pwpc-htab-tabs" class="pwpc-htab-tabs">
		<li class="pwpc-htab-nav pwpc-htab-active">
			<a href="#pwpc-ts-mdetails"><?php _e('Member Details', 'wp-team-showcase-and-slider'); ?></a>
		</li>
		<li class="pwpc-htab-nav">
			<a href="#pwpc-ts-sdetails"><?php _e('Social Details', 'wp-team-showcase-and-slider'); ?></a>
		</li>
	</ul>

	<div id="pwpc-ts-mdetails" class="pwpc-ts-mdetails pwpc-htab-cnt" style="display:block;">
		<table class="form-table pwpc-ts-team-detail-tbl">
			<tbody>

				<tr valign="top">
					<th scope="row">
						<label for="pwpc-ts-mdepartment"><?php _e('Member Department', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo pwpcl_esc_attr($member_department); ?>" class="large-text pwpc-ts-mdepartment" id="pwpc-ts-mdepartment" name="member_department" /><br/>
						<span class="description"><?php _e('Enter team member department.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="pwpc-ts-mdesignation"><?php _e('Member Designation', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo pwpcl_esc_attr($member_designation); ?>" class="large-text pwpc-ts-mdesignation" id="pwpc-ts-mdesignation" name="member_designation" /><br/>
						<span class="description"><?php _e('Enter team member designation.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="pwpc-ts-mskills"><?php _e('Skills', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo pwpcl_esc_attr($member_skills); ?>" class="large-text pwpc-ts-mskills" id="pwpc-ts-mskills" name="skills" /><br/>
						<span class="description"><?php _e('Enter team member skills.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="pwpc-ts-mexperience"><?php _e('Member Experience', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo pwpcl_esc_attr($member_experience); ?>" class="large-text pwpc-ts-mexperience" id="pwpc-ts-mexperience" name="member_experience" /><br/>
						<span class="description"><?php _e('Enter team member experience.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

			</tbody>
		</table>
	</div>

	<div id="pwpc-ts-sdetails" class="pwpc-ts-sdetails pwpc-htab-cnt">
		<table class="form-table pwpc-ts-sdetails-tbl">
			<tbody>

				<?php
				if( !empty($social_services) ) {
					foreach ($social_services as $social_name => $social_data) {
						
						if( empty($social_data) ) continue;
						
						$service_name 	= isset($social_data['name']) 	? $social_data['name'] 	: '';
						$service_desc 	= isset($social_data['desc'])	? $social_data['desc'] 	: '';
						$social_val 	= isset($social[$social_name]) 	? $social[$social_name] : '';
				?>
						<tr valign="top" class="pwpc-ts-social-row">
							<th scope="row">
								<label for="pwpc-ts-<?php echo $service_name; ?>"><?php echo $service_name; ?></label>
							</th>
							<td>
								<input type="text" name="<?php echo $prefix.'social['.$social_name.']'; ?>" value="<?php echo $social_val; ?>" class="large-text pwpc-ts-<?php echo $service_name; ?>" id="pwpc-ts-<?php echo $service_name; ?>" /><br/>
								<span class="description"><?php echo $service_desc; ?></span>
							</td>
						</tr>
			<?php	}
				}
				?>
			</tbody>
		</table>
	</div>
	<input type="hidden" value="<?php echo $selected_tab; ?>" class="pwpc-htab-selected-tab" name="<?php echo $prefix; ?>tab" />
</div>