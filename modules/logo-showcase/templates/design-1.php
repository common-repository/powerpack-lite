<?php
/**
 * Design 1 HTML
 *
 * @package PowerPack Lite
 * @subpackage Logo Showcase
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>
<div class="pwpc-ls-logo-cnt" title="<?php the_title(); ?>">
	<div class="pwpc-ls-fix-box">
	<?php if ($logourl != '') { ?>
		<a href="<?php echo esc_url($logourl); ?>" target="<?php echo $link_target; ?>">
			<img class="pwpc-ls-logo-img" src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
		</a>
	<?php } else { ?>
		<img class="pwpc-ls-logo-img" src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
	<?php } ?>
	</div>

	<?php if($show_title == "true") { ?>
	<div class="pwpc-ls-logo-title"><?php the_title(); ?></div>
	<?php } ?>
</div>