<div id="pwpc-hs-slider-nav-<?php echo $unique; ?>" class="pwpc-hs-slider-nav pwpc-hs-slick-slider" <?php echo $slider_as_nav_for; ?>>
	<?php while ( $query->have_posts() ) : $query->the_post();
		$feat_image = pwpcl_get_post_featured_image( $post->ID, $image_size, true );
	?>
	<div class="pwpc-hs-slider-nav-title <?php echo 'pwpc-hs-slides-'.$slidestoshow; ?>">
		<div class="pwpc-hs-main-title"><?php if(!empty($feat_image)){ ?><img src="<?php echo $feat_image; ?>"><?php } ?></div>
		<div class="pwpc-hs-title"><div><?php echo the_title(); ?></div></div>
	</div>
	<?php endwhile; ?>
</div>

<div class="pwpc-hs-slider-for-<?php echo $unique; ?> pwpc-hs-slider-for pwpc-hs-slick-slider">
	<?php while ( $query->have_posts() ) : $query->the_post();
		$post_link = get_permalink( $post->ID );
	?>
		<div class="pwpc-hs-slider-nav-content">
			<div class="pwpc-hs-slider-nav-wrapper pwpc-clearfix">
				<h2 class="pwpc-hs-content-title">
					<span><?php the_title(); ?></span>
				</h2>

				<div class="pwpc-hs-post-date">
					<span><i class="fa fa-calendar"></i> <?php echo get_the_date($date_format); ?></span>
				</div>

				<?php if($showContent == "true") { ?>
					<div class="pwpc-hs-content">			
						<?php  if($showFullContent == "false" ) { ?>
							<div class="pwpc-hs-tl-content"><?php echo pwpcl_get_post_excerpt( $post->ID, get_the_content(), $words_limit, '...' ); ?></div>
							<?php if($showreadmore == 'true') { ?>
								<a class="pwpc-hs-read-more" href="<?php echo $post_link; ?>"><?php echo esc_html($read_more_text); ?></a>
							<?php }
						} else { ?>
							<div class="pwpc-hs-tl-content pwpc-hs-fullcontent"><?php echo the_content(); ?></div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>