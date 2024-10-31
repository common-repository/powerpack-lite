<div class="<?php echo $wrpper_cls; ?>" style="<?php echo $offset_css; ?>" data-item-index="<?php echo $count; ?>">
	<div class="pwpc-iscwp-inr-wrp">
		<div class="pwpc-iscwp-img-wrp" style="<?php echo $height_css; ?>">

			<img class="pwpc-iscwp-img" src="<?php echo $gallery_img_src; ?>" alt="" />

			<?php if(($show_likes_count =='true' || $show_comments_count == 'true') && (!empty($iscwp_comments) || !empty($iscwp_likes))) { ?>
				<div class="pwpc-iscwp-meta">
					<div class="iscmp-meta-mid-wrap">
						<div class="pwpc-iscwp-meta-inner-wrap">
							<?php if($show_likes_count == 'true' && !empty($iscwp_likes)) { ?>
								<div class="pwpc-iscwp-likes-num<?php if($iscwp_comments <= 0){ echo ' iscwp-only-likes'; } ?>">
									<i class="fa fa-heart faa-pulse animated"></i> <span class="iscwp-like-count"><?php echo $iscwp_likes;?></span>
								</div>
							<?php } ?>

							<?php if($show_comments_count == 'true' && !empty($iscwp_comments)) { ?>
								<div class="pwpc-iscwp-meta-comment">
									<i class="fa fa-comment"></i> <span class="iscwp-cmnt-count"><?php echo $iscwp_comments; ?></span>
			 					</div>
			 				<?php } ?>
			 			</div>
		 			</div>
				</div>
			<?php } ?>
			<a class="pwpc-iscwp-img-link" href="<?php echo $iscwp_link_value; ?>" data-mfp-src="#pwpc-iscwp-popup-<?php echo $unique.'-'.$count; ?>"></a>
		</div>
	</div>
</div>