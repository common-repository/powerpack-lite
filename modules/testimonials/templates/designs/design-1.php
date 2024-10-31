<div id="pwpc-tmw-quote-<?php echo $post->ID;?>" class="<?php echo $css_class.' '.$class;?>">
	<?php if ( isset( $pertestimonial_image ) && ( $pertestimonial_image != '' ) && $display_avatar == 'true' ){?>
	<div class="pwpc-tmw-testimonial-left">
		<div class="pwpc-tmw-avtar-image">
			<?php echo $pertestimonial_image; ?>
		</div>
	</div>
	<?php } ?>

	<div class="pwpc-tmw-testimonial-content">
		<i class="fa fa-quote-left"></i>

		<?php if( $show_title == 'true' ) { ?>
		<div class="pwpc-tmw-testimonial-title"><?php the_title(); ?></div>
		<?php } ?>

		<div class="pwpc-tmw-testimonials-text"><em><?php echo get_the_content(); ?></em></div>
	</div>

	<?php if($display_client == 'true' && $pertestimonial_client != ''){?>
		<div class="pwpc-tmw-testimonial-author"><?php echo $author; ?></div>
		<?php } 

		if($display_company == 'true' && $pertestimonial_company != '' || $display_job == 'true' && $pertestimonial_job != ''){?>
			<div class="pwpc-tmw-testimonial-job"><?php echo $testimonial_job; ?></div>
		<?php } ?>
</div>