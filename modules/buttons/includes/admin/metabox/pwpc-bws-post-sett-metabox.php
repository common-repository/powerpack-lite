<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package PowerPack Lite
 * @subpackage Buttons with Style
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

// Taking some variables
$prefix 				= PWPCL_BWS_META_PREFIX; // Metabox prefix
$choice_butons 			= pwpcl_bws_button_type();
$button_type 			= pwpcl_bws_btn_style_type();
$button_class 			= pwpcl_bws_clr_class();
$button_style 			= pwpcl_bws_btn_style_cls();
$button_size 			= pwpcl_bws_btn_sizes();

// Getting saved values
$choice_button_type 	= get_post_meta( $post->ID, $prefix.'choice_button_type', true );
$button_style_type 		= get_post_meta( $post->ID, $prefix.'button_type', true );
$btn_clr_cls 			= get_post_meta( $post->ID, $prefix.'button_class', true );
$btn_style_type 		= get_post_meta( $post->ID, $prefix.'button_style', true );
$btn_size 				= get_post_meta( $post->ID, $prefix.'button_size', true );
$button_link_target 	= get_post_meta( $post->ID, $prefix.'button_link_target', true );
$simple_btn_name 		= get_post_meta( $post->ID, $prefix.'button_name', true );
$simple_btn_link 		= get_post_meta( $post->ID, $prefix.'button_link', true );
$extra_cls 				= get_post_meta( $post->ID, $prefix.'extra_cls', true );
?>

<table class="form-table pwpc-bws-post-sett-tbl">
	<tbody>
		<!-- Button Type -->
		<tr valign="top">
			<th scope="row">
				<label for="pwpc-bws-btn-type"><?php _e('Button Type', 'powerpack-lite'); ?></label>
			</th>
			<td>
				<select name="<?php echo $prefix; ?>choice_button_type" id="pwpc-bws-btn-type" class="pwpc-bws-select-box pwpc-bws-btn-type">
				<?php
				if( !empty($choice_butons) ) {
					foreach ($choice_butons as $btn_key => $btn_val) {
							$disabled_data = ($btn_key == 'button_group') ? 'disabled="disabled" title="'.__('Upgrade to Premium', 'powerpack-lite').'"' : '';
							echo '<option value="'.$btn_key.'" '.selected($choice_button_type, $btn_key).' '.$disabled_data.'>'.$btn_val.'</option>';
						}
					}
				?>
				</select><br/>
				<span class="description"><?php _e('Select button type.', 'powerpack-lite'); ?></span>
			</td>
		</tr>

		<!-- Simple button settings -->
		<tr valign="top">
			<td colspan="2" class="pwpc-bws-no-padding">
				<table class="form-table pwpc-bws-simple-btn-sett">
					<tbody>
						<tr>
							<th colspan="2">
								<div class="pwpc-sub-sett-title"><?php _e('Simple Button Settings', 'powerpack-lite'); ?></div>
							</th>
						</tr>
						<tr>
							<th><label for="pwpc-bws-simple-btn-name"><?php echo __('Button Text','powerpack-lite');?></label></th>
							<td>
								<input type="text" name="<?php echo $prefix;?>button_name" value="<?php echo pwpcl_esc_attr($simple_btn_name); ?>" class="regular-text pwpc-bws-simple-btn-name" id="pwpc-bws-simple-btn-name" /><br/>
								<span class="description"><?php _e('Enter button text like. eg. My Button', 'powerpack-lite'); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="pwpc-bws-simple-btn-link"><?php echo __('Button Link','powerpack-lite');?></label></th>
							<td>
								<input type="text" name="<?php echo $prefix;?>button_link" value="<?php echo esc_url($simple_btn_link); ?>" class="regular-text pwpc-bws-simple-btn-link" id="pwpc-bws-simple-btn-link" /><br/>
								<span class="description"><?php _e('Enter button link. eg. https://www.wponlinesupport.com.', 'powerpack-lite'); ?></span>
							</td>
						</tr>
					</tbody>
				</table><!-- End of simple button settings -->
			</td>
		</tr>
	</tbody>
</table><!-- end .pwpc-bws-post-sett-tbl -->

<table class="form-table pwpc-bws-post-sett-tbl">
	<tbody>
		<tr>
			<th colspan="4">
				<div class="pwpc-sub-sett-title"><?php _e('Button Settings', 'powerpack-lite'); ?></div>
			</th>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-bws-btn-clr-class"><?php _e('Button Color', 'powerpack-lite'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_class" class="pwpc-bws-select-box pwpc-bws-btn-clr-class" id="pwpc-bws-btn-clr-class">
					<?php
					if( !empty($button_class) ) {
						foreach ($button_class as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_clr_cls,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button color.', 'powerpack-lite'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-bws-btn-style-type"><?php _e('Button Type', 'powerpack-lite'); ?></label>
			</th>
			<td class="row-meta">
				<select name="<?php echo $prefix;?>button_type" class="pwpc-bws-select-box pwpc-bws-btn-style-type" id="pwpc-bws-btn-style-type">
					<?php
					if( !empty($button_type) ) {
						foreach ($button_type as $key => $value) {
							echo '<option value="'.$key.'" '.selected($button_style_type,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button type.', 'powerpack-lite'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-bws-btn-style-cls"><?php _e('Button Style', 'powerpack-lite'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_style" id="pwpc-bws-btn-style-cls" class="pwpc-bws-select-box pwpc-bws-btn-style-cls">
					<?php
					if( !empty($button_style) ) {
						foreach ($button_style as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_style_type,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button style.', 'powerpack-lite'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-bws-btn-size"><?php _e('Button Size', 'powerpack-lite'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_size" id="pwpc-bws-btn-size" class="pwpc-bws-select-box pwpc-bws-btn-size">
					<?php
					if( !empty($button_size) ) {
						foreach ($button_size as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_size,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button size.', 'powerpack-lite'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="pwpc-bws-btn-link-target"><?php _e('Button Target', 'powerpack-lite'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_link_target" id="pwpc-bws-btn-link-target" class="pwpc-bws-select-box pwpc-bws-btn-link-target">
					<option value="_self" <?php selected($button_link_target, '_self'); ?>><?php _e('Same Tab', 'powerpack-lite'); ?></option>
					<option value="_blank" <?php selected($button_link_target, '_blank'); ?>><?php _e('New Tab', 'powerpack-lite'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Select link behaviour.', 'powerpack-lite'); ?></span>
			</td>			
		</tr>

		<tr>
			<th><label for="pwpc-bws-extra-cls"><?php echo __('Button Extra CSS Class','powerpack-lite');?></label></th>
			<td>
				<input type="text" name="<?php echo $prefix;?>extra_cls" value="<?php echo pwpcl_esc_attr($extra_cls); ?>" class="regular-text pwpc-bws-extra-cls" id="pwpc-bws-extra-cls" /><br/>
				<span class="description"><?php _e('Enter extra css class if you want to apply.', 'powerpack-lite'); ?></span>
			</td>
		</tr>

	</tbody>
</table><!-- end .pwpc-bws-post-sett-tbl -->