<style>
	#pwpc-ticker-<?php echo $unique; ?> {border-color: <?php echo $background_color; ?>;}
	#pwpc-ticker-<?php echo $unique; ?> .pwpc-tu-label {background: <?php echo $background_color; ?>;}
	#pwpc-ticker-<?php echo $unique; ?> .pwpc-tu-label > span {border-color: transparent transparent transparent <?php echo $background_color; ?>}
	#pwpc-ticker-<?php echo $unique; ?> .pwpc-ticker-block > ul > li > .pwpc-tu-news{color: <?php echo $color; ?>;}
	#pwpc-ticker-<?php echo $unique; ?> .pwpc-ticker-block > ul > li > .pwpc-tu-news:hover{color: <?php echo $background_color; ?>}
	#pwpc-ticker-<?php echo $unique; ?> .pwpc-tu-label .pwpc-tu-title-lbl{background-color: <?php echo $background_color; ?>;color: <?php echo $title_color; ?>}
</style>

<div class="pwpc-ticker pwpc-ticker-main pwpc-tu-style-one-ticker <?php echo $wrap_cls; ?> pwpc-clearfix" id="pwpc-ticker-<?php echo $unique; ?>">
	<div class="wpos-ticker-title pwpc-tu-label">
		<?php if( $ticker_title ) { ?>
		<div class="pwpc-tu-title-lbl"><?php echo $ticker_title; ?></div>
		<?php } ?>
		<span></span>
	</div>

	<div class="pwpc-ticker-block">
		<ul>
			<?php while ( $query->have_posts() ) : $query->the_post();
					$post_link = pwpcl_tu_get_post_link( $post->ID );
			?>
				<li>
					<?php if( !empty($post_link) ) { ?>
						<a class="pwpc-tu-news" href="<?php echo esc_url($post_link); ?>"><?php the_title(); ?></a>
					<?php } else { ?>
						<span class="pwpc-tu-news"><?php the_title(); ?></span>
					<?php } ?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

	<div class="wpos-ticker-navi pwpc-tu-navi">
    	<span></span>
        <span></span>
    </div>        
    <div class="pwpc-hide pwpc-ticker-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($ticker_conf)); ?>"></div>
</div>