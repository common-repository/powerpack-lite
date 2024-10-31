<div class="pwpc-pap-portfolio-content">

	<?php while ($query->have_posts()) : $query->the_post();

			$unique_thumb 			= pwpcl_pap_get_popup_unique();
			$gallery_imgs 			= get_post_meta( $post->ID, $prefix.'gallery_id', true );
			$arrows 				= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
			$dots 					= get_post_meta( $post->ID, $prefix.'pagination_slider', true );
			$autoplayspeed			= get_post_meta( $post->ID, $prefix.'autoplayspeed_slider', true );
			$speed 					= get_post_meta( $post->ID, $prefix.'speed_slider', true );
			$project_url 			= pwpcl_pap_get_post_link($post->ID);
			$right_cnt_wrp_cls		= !empty($gallery_imgs) ? 'pwpc-col-6' : 'pwpc-col-12';
			$cat_links 				= array();
			$tag_links 				= array();

			$terms 		= get_the_terms( $post->ID, PWPCL_PAP_CAT );
			$tags 		= get_the_terms( $post->ID, PWPCL_PAP_TAG );

			// Portfolio Category
			if( $terms ) {
				foreach ( $terms as $term ) {
					$cat_links[] = '<span>'.$term->name.'</span>';
				}
			}
			$cate_name = join(", ", $cat_links);

			// Portfolio tag
			if($tags) {
				foreach ( $tags as $tag ) {
					$tag_links[] = '<span>'.$tag->name.'</span>';
				}
			}
			$tag_name = join( ", ", $tag_links );
			// Slider configuration
			$slider_conf = compact('dots', 'arrows', 'autoplayspeed', 'speed', 'rtl');
		?>

		<div id="pwpc-pap-popup-<?php echo $unique_thumb; ?>">
			<?php if( !empty($gallery_imgs) ) { ?>
			<div class="pwpc-col-6 pwpc-columns">
				<div class="pwpc-pap-slider-wrapper">
					<div id="pwpc-pap-slider-<?php echo $unique_thumb; ?>" class="pwpc-pap-img-slider pwpc-pap-img-grp">
						<?php foreach ($gallery_imgs as $img_key => $img_data) {
							
							$gallery_img_src 	= pwpcl_get_image_src( $img_data );
							$img_alt_text 		= get_post_meta( $img_data, '_wp_attachment_image_alt', true );
							$img_title			= get_the_title($img_data);
						?>

							<div class="pwpc-pap-portfolio-slide">
								<img src="<?php echo $gallery_img_src; ?>" alt="<?php echo pwpcl_esc_attr($img_alt_text); ?>" />
								<?php if ($img_title) { ?>
									<div class="pwpc-pap-popup-img-info"><?php echo $img_title; ?></div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div class="pwpc-pap-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
				</div>
			</div>
			<?php } ?>

			<div class="<?php echo $right_cnt_wrp_cls; ?> pwpc-columns">
				<div class="pwpc-pap-right-content">

					<div class="pwpc-pap-title"><?php the_title(); ?></div>
					<div class="pwpc-pap-popup-portfolio-content"><?php the_content(); ?></div>

					<?php if(!empty($tag_name) || !empty($cate_name) || $project_url) { ?>
					<table class="pwpc-pap-portfolio-meta-tbl">
						<tbody>
							<?php if(!empty($cate_name)) { ?>
							<tr>
								<th><?php _e('Categories', 'powerpack-lite'); ?> :</th>
								<td>
									<div class="pwpc-pap-popup-cats"><?php echo $cate_name; ?></div>
								</td>
							</tr>
							<?php } ?>

							<?php if(!empty($tag_name)) { ?>
							<tr>
								<th><?php _e('Skills', 'powerpack-lite'); ?> :</th>
								<td>
									<div class="pwpc-pap-popup-tags"><?php echo $tag_name; ?></div>
								</td>
							</tr>
							<?php } ?>

							<?php if($project_url) { ?>
							<tr>
								<th><?php _e('URL', 'powerpack-lite'); ?> :</th>
								<td>
									<a href="<?php echo esc_url($project_url); ?>" class="pwpc-pap-project-url-btn"><?php _e('View Project', 'powerpack-lite') ?></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>