<div class="pwpc-iscwp-left-panel">
	<?php if( $video_url ) { ?>
		<video id="iscwp-player-<?php echo $count;?>" class="pwpc-iscwp-video" controls preload="false" poster="<?php echo esc_url($iscwp_data['display_url']); ?>">
			<source src="<?php echo $video_url; ?>" type="video/mp4"></source>
		</video>
	<?php } else { ?>
		<img class="pwpc-iscwp-popup-img" src="<?php echo esc_url($iscwp_data['display_url']); ?>" alt="" />
	<?php } ?>
</div>

<div class="pwpc-iscwp-right-panel">
	<div class="pwpc-iscwp-right-wrap">

		<div class="pwpc-iscwp-user-head-box">
			<div class="pwpc-iscwp-user-head-box-inner">
				<a class="pwpc-iscwp-user-img" href="<?php echo $instagram_link_main.$username;?>">
					<img src="<?php echo $userdata['profile_picture'];?>" class="iscwp-img-user" alt="<?php _e('Profile Picture', 'powerpack-lite'); ?>" />
				</a>
				<a href="<?php echo $instagram_link_main.$username; ?>" class="pwpc-iscwp-username"><?php echo $userdata['username'];?></a>
				<div class="pwpc-iscwp-insta-link-wrap">
					<a href="<?php echo $instagram_link;?>" class="pwpc-iscwp-view-on-insta-link"><?php esc_html_e($instagram_link_text); ?></a>
				</div>
			</div>

			<div class="pwpc-iscwp-popup-meta">
				<?php if($show_likes_count == 'true') { ?>
					<div class="pwpc-iscwp-popup-meta-row pwpc-iscwp-popup-heart">
						<span class="likes"> <i class="fa fa-heart"></i> <?php echo $iscwp_likes; ?></span>
					</div>
				<?php }

				if($show_comments_count == 'true') { ?>
					<div class="pwpc-iscwp-popup-meta-row  pwpc-iscwp-popup-heart-comment">
						<span class="comments"> <i class="fa fa-comment"></i> <?php echo $iscwp_comments; ?></span>
					</div>
				<?php } ?>

				<?php if(!empty($location)) { ?>
					<div class="pwpc-iscwp-popup-meta-row">
						<span class="location">
							<i class="fa fa-map-marker"></i> <?php echo $location; ?>
						</span>
					</div>
				<?php } ?>
			</div>

			<?php if( isset($img_caption) && $show_caption == 'true') { ?>
			<div class="pwpc-iscwp-caption-text"><?php echo nl2br( $img_caption ); ?></div>
			<?php } ?>
		</div>
	</div>
</div>