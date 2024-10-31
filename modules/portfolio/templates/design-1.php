<li class="<?php echo $wrapper_cls; ?>">
	<div class="pwpc-pap-li-inner-wrap">
		<div class="pwpc-pap-portfolio-bg">
			<?php if( $portfolio_img ) { ?>
				<img class="pwpc-pap-portfolio-img" src="<?php echo $portfolio_img; ?>" alt="<?php echo pwpcl_esc_attr(the_title()); ?>" />
			<?php } ?>
		</div>

		<div class="pwpc-pap-title-overlay">
			<div class="pwpc-pap-title-overlay-wrp">
				<span class="pwpc-pap-description"><?php the_title(); ?></span>
				<?php if(!empty($portfolio_cat)) {?>
				<div class="pwpc-pap-cats"><?php echo $portfolio_cat; ?></div>
				<?php } ?>
			</div>
		</div>
		<a href="javascript:void(0)" class="pwpc-pap-thumbnail pwpc-pap-popup-info-link" data-mfp-src="#pwpc-pap-popup-<?php echo $unique; ?>"></a>
	</div>
</li>