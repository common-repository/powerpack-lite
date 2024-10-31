<div class="pwpc-rps-post-slides">		
	<div class="pwpc-rps-post-grid-content <?php if ( !has_post_thumbnail() ) { echo 'pwpc-rps-no-thumb-img'; } ?>">				
		<?php if( !empty($feat_image) ) { ?>
			<div class="pwpc-rps-post-image-wrap pwpc-rps-post-image-bg">		
				<a href="<?php echo $post_link; ?>">
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" class="pwpc-rps-post-img" />
				</a>		
			</div>
		<?php } ?>		
		<h2 class="pwpc-rps-post-title">
			<a href="<?php echo $post_link; ?>"><?php the_title(); ?></a>
		</h2>
		<?php if($show_category == "true" && $cat_list) { ?>
				<div class="pwpc-rps-post-cats-wrap"><?php echo $cat_list; ?></div>
			<?php }  
		  if($show_date == "true" || $show_author == 'true') { ?>
			<div class="pwpc-rps-post-date">
	  			<?php if($show_author == 'true') { ?> <span><?php  esc_html_e( 'By', 'powerpack-lite' ); ?> <?php the_author(); ?></span><?php } ?>
	  			<?php echo ($show_author == 'true' && $show_date == 'true') ? '&nbsp;/&nbsp;' : '' ?>
	  			<?php if($show_date == "true") { echo get_the_date(); } ?>
	  		</div>
		<?php }
		if($show_content == "true") { ?>
			<div class="pwpc-rps-post-content">
				<div><?php echo pwpcl_get_post_excerpt( $post->ID, get_the_content(), $words_limit, '...' ); ?></div>
				<?php if($showreadmore == 'true') { ?>
				<a class="pwpc-rps-read-more-btn" href="<?php echo $post_link; ?>"><?php esc_html_e( $read_more_text ); ?></a>
				<?php } ?>
			</div>
		<?php } ?> 		
	</div>
</div>