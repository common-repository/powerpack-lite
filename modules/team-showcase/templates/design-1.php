<div class="<?php echo $class.' '.$css_class;?>">

	<div class="pwpc-ts-team-member">
		<div class="pwpc-ts-team-img pwpc-ts-team-avatar-bg">
			<?php if ( $teamfeat_image ) { ?>
			<img class="pwpc-ts-team-avatar" src="<?php echo $teamfeat_image; ?>" alt="<?php _e('Image', 'wp-team-showcase-and-slider'); ?>" />
			<?php } ?>

			<?php if($popup == 'true') { ?>
			<div class="pwpc-ts-link-outer">
				<a class="pwpc-ts-popup-link" href="javascript:void(0)" data-mfp-src="#popup-<?php echo $popup_id; ?>"><i class="fa fa-info"></i></a>
			</div>
			<?php
		} ?>
	</div>

	<div class="pwpc-ts-team-detail">
		<div class="pwpc-ts-team-name"><?php the_title(); ?></div>
		<?php if($member_designation != '' || $member_department != '') { ?>
		<div class="pwpc-ts-team-data">
			<?php	
			echo ($member_designation != '' ? $member_designation : '');
			echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
			echo ($member_department != '' ? $member_department : '');
			?>
		</div>
		<?php } ?>
	</div>
	<?php echo pwpcl_ts_member_social_meta($post->ID, $social_limit); ?>
</div>
</div>