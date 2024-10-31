<?php
/**
 * About PowerPack
 *
 * Handles the about us page HTML
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$pwpc_tabs = apply_filters('pwpc_about_tabs', array(
					'pwpc_welcome' 	=> __("About", 'powerpack-lite'),
					'pwpc_update' 	=> __("What's New", 'powerpack-lite'),
				));
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'pwpc_welcome';
?>

<div class="wrap about-wrap pwpc-about-wrap">

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script><!-- FB Script -->

	<script>window.twttr = (function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0],
	    t = window.twttr || {};
	  if (d.getElementById(id)) return t;
	  js = d.createElement(s);
	  js.id = id;
	  js.src = "https://platform.twitter.com/widgets.js";
	  fjs.parentNode.insertBefore(js, fjs);

	  t._e = [];
	  t.ready = function(f) {
	    t._e.push(f);
	  };

	  return t;
	}(document, "script", "twitter-wjs"));</script><!-- Twitter Script -->

	<h1><?php echo __('Welcome to', 'powerpack-lite').' PowerPack '.PWPCL_VERSION; ?></h1>

	<div class="about-text"><?php echo sprintf( __('Congratulations! You are about to use most powerful plugin for %s ever - With most popular modules for frontend and backend by %s.', 'powerpack-lite'), 'WordPress', 'WP Online Support'); ?></div>
	<div class="wp-badge pwpc-page-logo"><?php echo __('Version', 'powerpack-lite') .' '. PWPCL_VERSION; ?></div>

	<a href="https://twitter.com/share" class="twitter-share-button" data-via="wordpress_wpos" data-text="Take your #WordPress site to the next level with PowerPack" data-url="https://www.wponlinesupport.com/" data-size="large">Tweet</a>
	<div style="vertical-align:top;" class="fb-like" data-href="https://www.facebook.com/wponlinesupport/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>

	<?php if( !empty($pwpc_tabs) ) { ?>
	<h2 class="nav-tab-wrapper">
		<?php foreach ($pwpc_tabs as $tab_key => $tab_val) { 

			if( empty($tab_key) ) {
				continue;
			}

			$active_tab_cls	= ($active_tab == $tab_key) ? 'nav-tab-active' : '';
			$tab_link 		= add_query_arg( array( 'page' => 'pwpc-about', 'tab' => $tab_key ), admin_url('admin.php') );
		?>
			<a class="nav-tab <?php echo $active_tab_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_val; ?></a>
		<?php } ?>
	</h2>
	<?php } ?>

	<div class="pwpc-cnt-wrap pwpc-nav-tab-cnt-wrap pwpc-clearfix">
		
		<?php if( $active_tab == 'pwpc_welcome' ) { ?>

		<div class="pwpc-welcome-tab-cnt pwpc-clearfix">
			<h2><?php _e('A Plugin Without Edge', 'powerpack-lite'); ?></h2>
			<p class="lead-description"><?php _e('Everything you need for website from header to footer and take your website to the next level!', 'powerpack-lite'); ?></p>
			<div class="pwpc-intro-image pwpc-columns pwpc-medium-5">
				<img src="<?php echo PWPCL_URL; ?>/assets/images/powerpack-logo.png" alt="PowerPack" />
			</div>
			<div class="pwpc-columns pwpc-medium-7">
				<p><?php _e('The largest Module bundle for WordPress with 20+ addons with Predefined Templates. All addons are totally unique, Developed with passion, Use individually to fit your website.', 'powerpack-lite'); ?></p>
				<p><?php _e('Enable / Disable feature of particular module so enable only those modules which requires to your website and others will not disturb you'); ?> :)</p>
				<p><?php _e('Our module library is growing every week and you will get updates of all.', 'powerpack-lite'); ?></p>
			</div>

			<div class="pwpc-columns pwpc-medium-12">
				<hr/>
				<h2><?php _e('Exciting Modules - Filled With Power', 'powerpack-lite'); ?></h2>
			</div>

			<div class="pwpc-icolumns-wrap pwpc-about-module-wrap pwpc-clearfix clear">
				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Security', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-shield"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('FAQ', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-info"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Logo Showcase', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-format-gallery"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Team Showcase', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-groups"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Post Slider', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-admin-post"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Testimonials', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-format-quote"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Portfolio', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-portfolio"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Video Gallery', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-format-video"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Timeline', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-editor-ul"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Instagram', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-camera"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Ticker Ultimate', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-editor-insertmore"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Google Fonts', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-editor-spellcheck"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Cookie Consent', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-megaphone"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Buttons', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-editor-bold"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('Login Customizer', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-desktop"></i>
					</div>
				</div>

				<div class="pwpc-icolumns pwpc-medium-3 pwpc-about-module">
					<div class="pwpc-about-module-inr">
						<div class="pwpc-about-module-title"><span><?php _e('And More', 'powerpack-lite'); ?></span></div>
						<i class="pwpc-about-module-icon dashicons dashicons-image-filter"></i>
					</div>
				</div>
			</div><!-- end .pwpc-icolumns-wrap -->
		</div><!-- end .pwpc-welcome-tab-cnt -->

		<?php } elseif ( $active_tab == 'pwpc_update' ) { ?>
			
			<div class="pwpc-update-tab-cnt pwpc-clearfix">
				<iframe class="pwpc-changelog-iframe" src="https://wponlinesupport.com/readmefile/powerpack/changelog-lite.html" allowtransparency="true" frameborder="0"></iframe>
			</div>

		<?php } else {
			do_action( 'pwpc_about_tabs_cnt_'.$active_tab, $active_tab );
		} ?>

		<div class="pwpc-columns pwpc-medium-12">
			<p>
				<?php echo __('Thank you for choosing PowerPack', 'powerpack-lite'); ?>,<br/>
				<a href="https://www.wponlinesupport.com/" target="_blank">WP Online Support</a>
			</p>
		</div>
	</div><!-- end .pwpc-nav-tab-cnt-wrap -->

</div><!-- pwpc-about-wrap -->