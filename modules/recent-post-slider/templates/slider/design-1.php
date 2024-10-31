<div class="pwpc-rps-post-slides">

	<div class="pwpc-rps-post-cnt-pos">
		<div class="pwpc-post-cnt-left pwpc-col-8 pwpc-columns">
			<?php if($show_category == "true" && $cat_list) { ?>
				<div class="pwpc-rps-post-cats-wrap"><?php echo $cat_list; ?></div>
			<?php } ?>

		  	<h2 class="pwpc-rps-post-title">
				<a href="<?php echo $post_link; ?>"><?php the_title(); ?></a>
			</h2>

			<?php if($show_date == "true" || $show_author == 'true') { ?>
				<div class="pwpc-rps-post-date">
					<?php if($show_author == 'true') { ?>
					<span>
						<?php esc_html_e( 'By', 'powerpack-lite' ); ?>
						<?php the_author(); ?>
					</span>
					<?php } ?>
					<?php echo ($show_author == 'true' && $show_date == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($show_date == "true") { echo get_the_date(); } ?>
				</div>

			<?php } ?>

			<?php if($show_content == "true") { ?>
				<div class="pwpc-rps-post-content">
					<div>
						<?php echo pwpcl_get_post_excerpt( $post->ID, get_the_content(), $words_limit, '...' ); ?>
					</div>

					<?php if($showreadmore == 'true') { ?>
						<a class="pwpc-rps-read-more-btn" href="<?php echo $post_link; ?>"><?php esc_html_e($read_more_text); ?></a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div class="pwpc-rps-post-image-wrap pwpc-rps-post-image-bg">
			<?php if( !empty($feat_image) ) { ?>
			<img src="<?php echo $feat_image; ?>" alt="<?php _e('Post Image', 'powerpack-lite'); ?>" class="pwpc-rps-post-img" />
			<?php } ?>
		</div>
		<a class="pwpc-rps-post-link" href="<?php echo $post_link; ?>"></a>
	</div>
</div>