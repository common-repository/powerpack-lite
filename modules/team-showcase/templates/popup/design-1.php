<div id="popup-<?php echo $popup_id; ?>" class="pwpc-ts-popup-box <?php echo $popup_cls; ?> pwpc-ts-popup-content pwpc-clearfix mfp-hide">
	<?php $socialicon = pwpcl_ts_member_social_meta($post->ID, 'all');
	if (!empty($socialicon)) { ?>
	<div class="div-left-panel">
		<?php echo $socialicon; ?>
	</div>
	<?php } ?>

	<div class="div-right-panel">

		<div class="pwpc-ts-popup-header pwpc-ts-team-avatar-bg">

			<?php if( $teamfeat_image ) { ?>
			<img class="pwpc-ts-team-avatar" src="<?php echo $teamfeat_image ?>" alt="<?php _e('Team Image', 'wp-team-showcase-and-slider'); ?>"/>
			<?php } ?>

			<a href="javascript:void(0)" class="pwpc-ts-popup-close pwpc-ts-close-btn mfp-close" title="<?php _e('Close (Esc)', 'wp-team-showcase-and-slider') ?>"></a>

			<div class="pwpc-ts-popup-member-info">

				<div class="pwpc-ts-popup-member-name"><?php the_title(); ?></div>	

				<?php if($member_designation != '' || $member_department != '') { ?>
				<div class="pwpc-ts-popup-member-job">
					<?php 
					echo ($member_designation != '' ? $member_designation : '');
					echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
					echo ($member_department != '' ? $member_department : ''); ?>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="pwpc-ts-popup-body">

			<?php if($skills != '' || $member_experience != '') { ?>
			<div class="pwpc-ts-member-info">
				<?php
				echo ($skills != '' ? $skills : '');
				echo ($skills != '' && $member_experience != '' ? ' - ' : '');
				echo ($member_experience != '' ? $member_experience : '');
				?>
			</div>
			<?php }

			the_content();
			?>
		</div>
	</div>
</div>