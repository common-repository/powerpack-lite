<?php
/**
 * Plugin generic functions file
 *
 * @package PowerPack Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_esc_attr($data) {
    return esc_attr( $data );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'pwpcl_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_clean_number( $var, $fallback ) {
	$data = absint($var);
	return ( empty($data) && $fallback ) ? $fallback : $data;
}

/**
 * Sanitize url
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_clean_url( $url ) {
	return esc_url_raw( trim($url) );
}

/**
 * Strip Slashes From Array
 *
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_clean_html($data = array(), $flag = false) {

    if($flag != true) {
        $data = pwpcl_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_nohtml_kses($data = array()) {

	if ( is_array($data) ) {

	$data = array_map('pwpcl_nohtml_kses', $data);

	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}

	return $data;
}

/**
 * Function to add array after specific key
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_add_array(&$array, $value, $index, $from_last = false) {

    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }

    return $array;
}

/**
 * Function to unique number value
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Function to get grid column based on grid
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_grid_column( $grid = '' ) {

	if($grid == '2') {
		$grid_clmn = '6';
	} else if($grid == '3') {
		$grid_clmn = '4';
	}  else if($grid == '4') {
		$grid_clmn = '3';
	} else if ($grid == '1') {
		$grid_clmn = '12';
	} else {
		$grid_clmn = '6';
	}
	return $grid_clmn;
}

/**
 * Get PowerPack main screen ids.
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_main_screen_ids() {

	$screen_ids = array(
		PWPCL_SCREEN_ID.'_page_pwpc-about',
		'toplevel_page_pwpc-dashboard',
		PWPCL_SCREEN_ID.'_page_pwpc-license'
	);

	return $screen_ids;
}

/**
 * Get all PowerPack screen ids.
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_screen_ids() {

	$screen_ids = pwpcl_main_screen_ids();

	return apply_filters( 'pwpc_screen_ids', $screen_ids );
}

/**
 * Check it is a plugin screen or not
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function is_pwpcl_screen() {
	global $current_screen;

	$screen_ids 	= pwpcl_get_screen_ids();
	$curr_screen_id = $current_screen ? $current_screen->id : '';
	$curr_post_type = isset($current_screen->post_type) ? $current_screen->post_type : '';

	if( in_array($curr_screen_id, $screen_ids) || in_array($curr_post_type, $screen_ids) ) {
		return true;
	}
	return false;
}

/**
 * Function to get post excerpt
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

    $has_excerpt  = false;
    $word_length  = !empty($word_length) ? $word_length : '55';

    // If post id is passed
    if( !empty($post_id) ) {
        if (has_excerpt($post_id)) {

          $has_excerpt  = true;
          $content    	= get_the_excerpt();

        } else {
          $content = !empty($content) ? $content : get_the_content();
        }
    }

    if( !empty($content) && (!$has_excerpt) ) {
        $content = strip_shortcodes( $content ); // Strip shortcodes
        $content = wp_trim_words( $content, $word_length, $more );
    }
    return $content;
}

/**
 * Function to limit words
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_limit_words($string, $word_limit, $more = '...') {
    $string = wp_trim_words( $string, $word_limit, $more );
    return $string;
}

/**
 * Function to get post featured image
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    // Getting default image
    if( $default_img && empty($image) ) {       
    }

    return $image;
}

/**
 * Function to get post featured image
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_image_src( $attachment_id = '', $size = 'full' ) {

    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( $attachment_id, $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    return $image;
}

/**
 * Function to get old browser
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_old_browser() {
    global $is_IE, $is_safari, $is_edge;

    // Only for safari
    $safari_browser = pwpcl_check_browser_safari();

    if( $is_IE || $is_edge || ($is_safari && (isset($safari_browser['version']) && $safari_browser['version'] <= 7.1)) ) {
        return true;
    }
    return false;
}

/**
 * Determine if the browser is Safari or not (last updated 1.7)
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_check_browser_safari() {

    // Takinf some variables
    $browser    = array();
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

    if (stripos($user_agent, 'Safari') !== false && stripos($user_agent, 'iPhone') === false && stripos($user_agent, 'iPod') === false) {
        $aresult = explode('/', stristr($user_agent, 'Version'));
        if (isset($aresult[1])) {
            $aversion = explode(' ', $aresult[1]);
            $browser['version'] = ($aversion[0]);
        } else {
            $browser['version'] = '';
        }
        $browser['browser'] = 'safari';
    }
    return $browser;
}

/**
 * Function to sort module key array on priority
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_sort_modules_cat($a, $b) {
	$a_priority = (!empty($a['priority']) && $a['priority'] > 0) ? $a['priority'] : 999;
	$b_priority = (!empty($b['priority']) && $b['priority'] > 0) ? $b['priority'] : 999;
	
	if ($a_priority == $b_priority) {
	    return 0;
	}
    return ($a_priority < $b_priority) ? -1 : 1;
}

/**
 * Function to sort module array on name
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_sort_modules($x, $y) {

	if( !isset($x['name']) || !isset($y['name']) ) {
		return false;
	}

    return strcasecmp($x['name'], $y['name']);
}

/**
 * Function to to filter array to get only keys which has zero value
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_zero($var) {
	return( ($var == 0) );
}

/**
 * Function to register plugin modules categories
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_register_module_cats() {
	$module_cats = array(
						'active_modules'=> array(
											'name'		=> __('Active Modules', 'powerpack-lite'),
											'desc'		=> __('Activated modules on your website.' ,'powerpack-lite'),
											'icon'		=> 'dashicons dashicons-dashboard',
											'priority'	=> 1,
										),
						'modules' 		=> array(
											'name'		=> __('Modules', 'powerpack-lite'),
											'desc'		=> __('Enable various modules for your website.' ,'powerpack-lite'),
											'icon'		=> 'dashicons dashicons-admin-plugins',
											'priority'	=> 2,
											'is_filter'	=> true,
										),
						'widgets'		=> array(
											'name'		=> __('Widgets', 'powerpack-lite'),
											'desc'		=> __('Choose from various widgets for your website.' ,'powerpack-lite'),
											'icon'		=> 'dashicons dashicons-schedule',
											'priority'	=> 3,
											'is_filter'	=> true,
										),
						'appearance'	=> array(
											'name'		=> __('Appearance', 'powerpack-lite'),
											'desc'		=> __('Choose styling modules for your website.' ,'powerpack-lite'),
											'icon'		=> 'dashicons dashicons-admin-appearance',
											'priority'	=> 4,
											'is_filter'	=> true,
										),
						'security'	=> array(
											'name'		=> __('Security and Privacy', 'powerpack-lite'),
											'desc'		=> __('Choose security and privacy modules for your website.' ,'powerpack-lite'),
											'icon'		=> 'dashicons dashicons-shield',
											'priority'	=> 5,
											'is_filter'	=> true,
										),
					);

	$module_cats = apply_filters( 'pwpc_register_site_module_cats', $module_cats );
 	uasort($module_cats, "pwpcl_sort_modules_cat"); // sort array on priority

	return $module_cats;
}

/**
 * Function to register plugin modules
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_register_modules() {

	$active_modules 	= pwpcl_active_modules();
	$widget_link 		= admin_url('widgets.php');
	$admin_url 			= admin_url('admin.php');
	$widgets_tab_link	= pwpcl_get_plugin_link( 'main', array('tab' => 'widgets') );

	$modules = array(
						'faq' => array(
										'name'			=> __('FAQ', 'powerpack-lite'),
										'desc'			=> __('Faqs module allows you add, manage and display FAQ on your website. You can use this plugin as a jquery ui accordion.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Faqs module allows you add, manage and display FAQ on your website.', 'powerpack-lite'),
																					__('You can use this plugin as a jquery accordion also.', 'powerpack-lite'),
																					__('This plugin is created with custom post type.', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'		=> 'modules',
										'path'			=> PWPCL_DIR.'modules/faq/pwpc-faq.php',
										'conf_text'		=> __('Configure', 'powerpack-lite'),
										'conf_link'		=> add_query_arg( array('post_type' => 'pwpc_faq', 'page' => 'pwpc-faq-about'), 'edit.php' ),
									),
						'instagram' => array(
										'name'			=> __('Instagram Slider and Carousel Plus Widget', 'powerpack-lite'),
										'desc'			=> __('A fully responsive plugin to display your Instagram pictures in a Grid, Slider and Carousel view with widget.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'title' 	=> __('Instagram Slider and Carousel', 'powerpack-lite'),
																'desc'		=> array(
																					__('A fully responsive plugin to display your Instagram pictures in a Grid, Slider, Carousel or Block view by your Instagram Username.', 'powerpack-lite'),
																					__('This plugin fetches Instagram photo on a periodically time base which you can set from plugin setting page.', 'powerpack-lite'),
																					__('Widgets for Grid view with various options.', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'widget', 'multilanguage', 'responsive')
															),
										'category'		=> 'modules',
										'path'			=> PWPCL_DIR.'modules/instagram/pwpc-instagram.php',
										'conf_link'		=> add_query_arg( array('page' => 'pwpc-iscwp-settings', 'tab' => 'pwpc-iscwp-about'), $admin_url ),
										'widget_link'	=> add_query_arg( array('search' => __('Instagram', 'powerpack-lite')), $widgets_tab_link ),
									),
						'logo_showcase' => array(
										'name'			=> __('Logo Showcase', 'powerpack-lite'),
										'desc'			=> __('Logo Showcase is a fully responsive plugin to display client logo, partners logo, sponsor logo with grid, slider or carousel view.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A fully responsive plugin to display client logo, partners logo, sponsor logo with grid, slider, carousel or filterization view.', 'powerpack-lite'),
																					__('This plugin is created with custom post type.', 'powerpack-lite'),
																					__('[Premium Only] - 15+ predefined designs, 2 Widgets for Slider and Grid view with various options.', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'widget', 'multilanguage', 'responsive')
															),
										'category'		=> 'modules',
										'path'			=> PWPCL_DIR.'modules/logo-showcase/pwpc-logo-showcase.php',
										'conf_link'		=> add_query_arg( array('post_type' => 'pwpc_logoshowcase', 'page' => 'pwpc-ls-about'), 'edit.php' ),
										'widget_link'	=> add_query_arg( array('search' => __('Logo Showcase', 'powerpack-lite')), $widgets_tab_link ),
									),
						'portfolio' => array(
										'name'		=> __('Portfolio & Projects', 'powerpack-lite'),
										'desc'		=> __('Display Portfolio or Projects with title, description and creative Mobile touch slider image gallery.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A fully responsive plugin to display portfolio or projects with title, description and creative Mobile touch slider image gallery.', 'powerpack-lite'),
																					__('[Premium Only] - 15+ predefined designs, Portfolio Filtration and 2 Portfolio Pop-up styles (Inline and Popup).', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'	=> 'modules',
										'path'		=> PWPCL_DIR.'modules/portfolio/pwpc-portfolio.php',
										'conf_link'	=> add_query_arg( array('post_type' => 'pwpc_portfolio', 'page' => 'pwpc-pap-about'), 'edit.php' ),
									),
						'rps' => array(
										'name'			=> __('Responsive Recent Post Slider', 'powerpack-lite'),
										'desc'			=> __('A fully responsive plugin to display posts in a beautiful slideshow. It is best choice and the most eye-catching way to display posts.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A fully responsive plugin to display WordPress default posts in a beautiful slideshow.', 'powerpack-lite'),
																					__('Post Slider and Post Carousel view.', 'powerpack-lite'),
																					__('[Premium Only] - Works with any Custom Post Type, GridBox (Block) view and 3 widgets for post list and slider.', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'widget', 'multilanguage', 'responsive')
															),
										'category'		=> 'modules',
										'path'			=> PWPCL_DIR.'modules/recent-post-slider/pwpc-recent-post-slider.php',
										'conf_link'		=> add_query_arg( array('page' => 'pwpc-rps-about'), $admin_url ),
										'widget_link'	=> add_query_arg( array('search' => __('Responsive Recent Post Slider', 'powerpack-lite')), $widgets_tab_link ),
									),
						'testimonials' => array(
										'name'			=> __('Testimonials', 'powerpack-lite'),
										'desc'			=> __('Display testimonials, reviews or quotes in multiple ways. You can quickly add your testimonials with their name, jobs, pictures and etc.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A fully responsive plugin to display testimonials in a beautiful slideshow and list view.', 'powerpack-lite'),
																					__('Testimonials with front end form submission.', 'powerpack-lite'),
																					__('Widget with testimonials list and slider view.', 'powerpack-lite'),
																					__('20 predefined designs and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'widget', 'multilanguage', 'responsive')
															),
										'category'		=> 'modules',
										'path'			=> PWPCL_DIR.'modules/testimonials/pwpc-testimonials.php',
										'conf_link'		=> add_query_arg( array('post_type' => 'pwpc_testimonial', 'page' => 'pwpc-tmw-about'), 'edit.php' ),
										'widget_link'	=> add_query_arg( array('search' => __('Testimonials', 'powerpack-lite')), $widgets_tab_link ),
									),
						'team_showcase' => array(
										'name'		=> __('Team Showcase', 'powerpack-lite'),
										'desc'		=> __('Team Showcase and Slider allows you to easily create and display your team members & staff and display in a grid or slider view.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Plugin allows you to easily create and display your team members & staff and display in a grid or slider view.', 'powerpack-lite'),
																					__('[Premium Only] - 25 predefined designs, 2 popup designs and theme for team members.', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'widget', 'multilanguage', 'responsive')
															),
										'category'	=> 'modules',
										'path'		=> PWPCL_DIR.'modules/team-showcase/pwpc-team-showcase.php',
										'conf_link'	=> add_query_arg( array('post_type' => 'pwpc_team_showcase', 'page' => 'pwpc-ts-about'), 'edit.php' ),
									),
						'timeline' => array(
										'name'		=> __('Timeline and History Slider', 'powerpack-lite'),
										'desc'		=> __('A fully responsive and advanced WordPress plugin that showcases your life history or your company\'s story.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A fully responsive plugin to display your life story or company story in a Horizontal or Vertical slider with various animations.', 'powerpack-lite'),
																					__('Works with Wordpress default post also.', 'powerpack-lite'),
																					__('[Premium Only] - 5+ predefined designs, Vertical Timeline and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'	=> 'modules',
										'path'		=> PWPCL_DIR.'modules/timeline/pwpc-history-slider.php',
										'conf_link'	=> add_query_arg( array('post_type' => 'pwpc_timeline_slider', 'page' => 'pwpc-hs-about'), 'edit.php' ),
									),
						'video_gallery' => array(
										'name'		=> __('Video Gallery', 'powerpack-lite'),
										'desc'		=> __('Video Gallery is a responsive HTML5, YouTube, Dailymotion, Vimeo and other video gallery in grid or slider view with popup.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A fully responsive plugin to display HTML5, YouTube, Vimeo and other video in a grid or slider view with popup.', 'powerpack-lite'),
																					__('[Premium Only] - 18 predefined designs, Supports JW Player and various video settings like auto play and etc.', 'powerpack-lite'),																					
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'	=> 'modules',
										'path'		=> PWPCL_DIR.'modules/video-gallery/pwpc-video-gallery.php',
										'conf_link'	=> add_query_arg( array('post_type' => 'pwpc_video', 'page' => 'pwpc-vgp-about'), 'edit.php' ),
									),
						'ticker' => array(
										'name'		=> __('Ticker Ultimate with RSS', 'powerpack-lite'),
										'desc'		=> __('Display WordPress Default Post, Custom Post and RSS Post in a ticker mode with Fade, Vertical and Horizontal slider effect.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Display WordPress Default Post or any Custom Post in a ticker mode with Fade, Vertical and Horizontal slider effect.', 'powerpack-lite'),
																					__('[Premium Only] - 2 predefined designs and RSS posts with ticker.', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'	=> 'modules',
										'path'		=> PWPCL_DIR.'modules/ticker-ultimate/pwpc-ticker-ultimate.php',
										'conf_link'	=> add_query_arg( array('post_type' => 'pwpc_ticker', 'page' => 'pwpc-tu-about'), 'edit.php' ),
									),
						'maintenance_mode' => array(
										'name'			=> __('Maintenance Mode', 'powerpack-lite'),
										'desc'			=> __('Maintenance mode or a coming soon page with countdown timer and responsive layout.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A very simple plugin to put your website on maintenance mode with timer.', 'powerpack-lite'),
																					__('Simply enable the maintenance mode from the settings and in few seconds you can put your site in maintenance mode.', 'powerpack-lite'),
																					__('12 timer designs, 5 predefined templates and more...', 'powerpack-lite'),
																				),
																'supports'	=> array( 'multilanguage', 'responsive' )
															),
										'category'		=> 'modules',
										'premium'		=> true,
									),

						// Appearance
						'bais_slider' => array(
										'name'		=> __('Before and After Image Slider', 'powerpack-lite'),
										'desc'		=> __('Before and After Image Slider is a simple plugin that makes it easy to highlight the visual differences between two images.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A very simple module that makes it easy to highlight the visual differences between two images.', 'powerpack-lite'),
																					__('Custom width, After / Before image label and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'	=> 'appearance',
										'premium'	=> true,
									),
						'btn' => array(
										'name'		=> __('Button with Style', 'powerpack-lite'),
										'desc'		=> __('Build custom buttons with icon. Perfect for hyperlinks, downloads, promotions, redirects or create group button.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Build single button or group buttons with icon and hyperlinks.', 'powerpack-lite'),
																					__('Predefined color, style and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('shortcode', 'multilanguage', 'responsive')
															),
										'category'	=> 'appearance',
										'path'		=> PWPCL_DIR.'modules/buttons/pwpc-buttons.php',
										'conf_link'	=> add_query_arg( array('post_type' => 'pwpc_bws', 'page' => 'pwpc-bws-about'), 'edit.php' ),
									),
						'custom_cj' => array(
										'name'		=> __('Custom CSS and JS', 'powerpack-lite'),
										'desc'		=> __('Customize site appearance by easily adding custom CSS or JS code without even having to modify your theme or plugin files.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Customize site appearance by easily adding custom CSS or JS code without even having to modify your theme or plugin files.', 'powerpack-lite'),
																					__('Add CSS or JS globally.', 'powerpack-lite'),
																				)
															),
										'category'	=> 'appearance',
										'path'		=> PWPCL_DIR.'modules/css-js/pwpc-css-js.php',
										'conf_link'	=> add_query_arg( array('page' => 'pwpc-ccj-settings', 'tab' => 'pwpc-ccj-about'), $admin_url ),
									),
						'eis' => array(
										'name'		=> __('Extra Info Sidebar', 'powerpack-lite'),
										'desc'		=> __('This enables toggle button on a website corner. Display your desired information within it via widget.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Display toggle button on a website corner with your desired information within it via widget.', 'powerpack-lite'),
																					__('Customize background color, font color and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('widget', 'multilanguage', 'responsive')
															),
										'category'	=> 'appearance',
										'premium'	=> true,
									),
						'login_customizer' => array(
										'name'		=> __('Login Customizer', 'powerpack-lite'),
										'desc'		=> __('A quick and easy way to customize login screen the way you want. Change login screen color, Upload desired logo and much more.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A quick and easy way to customize login screen the way you want.', 'powerpack-lite'),
																					__('Customize login, register and forgot password form color, form position and etc.', 'powerpack-lite'),
																					__('Customize login screen color, Upload desired logo and much more.', 'powerpack-lite'),
																				),
																'supports'	=> array('multilanguage', 'responsive')
															),
										'category'	=> 'appearance',
										'premium'	=> true,
									),
						'fmgc_columns' => array(
										'name'		=> __('Footer Mega Grid Columns', 'powerpack-lite'),
										'desc'		=> __('Register a widget area for your theme and allows you to add and display widgets in grid view with multiple columns.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Register a widget area for your theme and allows you to add and display widgets in grid view with multiple columns.', 'powerpack-lite'),
																					__('Customize background color, font color and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('widget', 'multilanguage', 'responsive')
															),
										'category'	=> 'appearance',
										'path'		=> PWPCL_DIR.'modules/footer-mega-grid-columns/pwpc-footer-mega-grid-clmns.php',
										'conf_link'	=> add_query_arg( array('page' => 'pwpc-fmgc-settings', 'tab' => 'pwpc-fmgc-about'), $admin_url ),
									),
						'google_fonts' => array(
										'name'		=> __('Google Fonts', 'powerpack-lite'),
										'desc'		=> __('Adds google fonts to any theme without coding and integrates with theme. It allows you to assign fonts for body, heading, em, a tag etc.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('A module to add google fonts to any theme without coding and integrates with theme.', 'powerpack-lite'),
																					__('It allows you to assign fonts for body, heading, em, a tag or etc tags.', 'powerpack-lite'),
																				)
															),
										'category'	=> 'appearance',
										'path'		=> PWPCL_DIR.'modules/google-fonts/pwpc-google-fonts.php',
										'conf_link'	=> add_query_arg( array('page' => 'pwpc-gfpw-settings'), $admin_url ),
									),
						'preloader' => array(
										'name'		=> __('Preloader', 'powerpack-lite'),
										'desc'		=> __('Preloader is a tiny, customizable plugin that gives your site an animated loading screen. It comes with predefined spinner, background color and many more options.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Gives your site an animated loading screen with predefined spinner.', 'powerpack-lite'),
																					__('Customize background color, custom spinner image and more...', 'powerpack-lite'),
																				),
																'supports'	=> array('multilanguage', 'responsive')
															),
										'category'	=> 'appearance',
										'path'		=> PWPCL_DIR.'modules/preloader/pwpc-pageloader.php',
										'conf_link'	=> add_query_arg( array('page' => 'pwpc-pl-settings', 'tab' => 'pwpc-pl-about'), $admin_url ),
									),
						'smooth_scroll' => array(
										'name'		=> __('JQuery Smooth Scroll & Go To Top', 'powerpack-lite'),
										'desc'		=> __('JQuery smooth scroll for website and page back to top functionality with many options.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> array(
																					__('Page Back to Top functionality.', 'powerpack-lite'),
																					__('Page smooth scrolling functionality.', 'powerpack-lite'),
																				)
															),
										'category'	=> 'appearance',
										'path'		=> PWPCL_DIR.'modules/smooth-scroll/pwpc-smooth-scroll.php',
										'conf_link'	=> add_query_arg( array('page' => 'pwpc-ss-settings'), $admin_url ),
									),

						// Security and Privacy
						'cookie_consent' => array(
										'name'			=> __('Cookie Consent', 'powerpack-lite'),
										'desc'			=> __('A simple way to get GDPR Cookie Consent as per EU GDPR/Cookie Law regulations. Display cookie conesnt message on website.', 'powerpack-lite'),
										'extra_info'	=> array(
																'desc'		=> __('A simple way to display GDPR Cookie Consent as per EU GDPR/Cookie Law regulations.', 'powerpack-lite'),
																'supports'	=> array( 'multilanguage', 'responsive' )
															),
										'category'		=> 'security',
										'premium'		=> true,
									),
						'security' => array(
										'name'			=> __('Security', 'powerpack-lite'),
										'desc'			=> __('Secure your website from Brute Force Attacks. Protect your login screen, prevent XML-RPC DDOS attack and hide basic identity of WordPress from hacker.', 'powerpack-lite'),
										'extra_info'	=> array(
																	'desc'		=> array(
																						__('Prevent Brute Force Attacks.', 'powerpack-lite'),
																						__('Prevent XML-RPC DDOS attack.', 'powerpack-lite'),
																						__('Hide WP Login screen.', 'powerpack-lite'),
																						__('Rename WP Login URL.', 'powerpack-lite'),
																						__('Two Factor Authentication for Login Screen.', 'powerpack-lite'),
																						__('Hide basic identity of WordPress from hacker.', 'powerpack-lite'),
																						__('Protect ecommerce store like Woo Commerce and Easy Digital Downloads from Brute Force Attacks.', 'powerpack-lite'),
																					),
																	'supports'	=> array( 'multisite', 'multilanguage', 'responsive' )
																),
										'category'	=> 'security',
										'premium'	=> true,
									),

						// Widgets
						'slw' => array(
										'name'		=> __('Social Links', 'powerpack-lite'),
										'desc'		=> __('Social Links is an easy to use, customizable way to display various social profiles links with icons.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'title' 	=> __('Social Links Widget', 'powerpack-lite'),
																'desc'		=> array(
																					__('Widget allows you to easily display your social profiles.', 'powerpack-lite'),
																					__('[Premium Version] - Get 15 Designs. Customize background color and Icon color.', 'powerpack-lite'),
																				),
																'supports'	=> array('widget', 'multilanguage', 'responsive')
															),
										'category'	=> 'widgets',
										'path'		=> PWPCL_DIR.'modules/social-link-widget/pwpc-social-link.php',
										'conf_link'	=> $widget_link,
									),
						'bhw' => array(
										'name'		=> __('Business Hours', 'powerpack-lite'),
										'desc'		=> __('The Business Hours widget allows you to post your daily working hours and show it to your visitors.' ,'powerpack-lite'),
										'extra_info'	=> array(
																'title' 	=> __('Business Hours Widget', 'powerpack-lite'),
																'desc'		=> array(
																					__('The Business Hours widget allows you to post your daily working hours and show it to your visitors.', 'powerpack-lite'),
																				),
																'supports'	=> array('widget', 'multilanguage', 'responsive')
															),
										'category'	=> 'widgets',
										'premium'	=> true,
									),
						);

	// If RPS is active then load it's widget
	if( isset($active_modules['rps']) ) {
		$modules['rps_widget_list1'] = array(
										'name'		=> __('Responsive Recent Post Slider / List Style 1', 'powerpack-lite'),
										'desc'		=> __('Display latest post items in a list or slider view with various options. You can see \'Latest Post List/Slider 1 - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'parent'	=> 'rps',
										'premium'	=> true
									);

		$modules['rps_widget_list2'] = array(
										'name'		=> __('Responsive Recent Post Slider / List Style 2', 'powerpack-lite'),
										'desc'		=> __('Display latest post items in a list or slider view with various options. You can see \'Latest Post List/Slider 2 - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'parent'	=> 'rps',
										'premium'	=> true
									);

		$modules['rps_widget_slider'] = array(
										'name'		=> __('Responsive Recent Post Slider Widget', 'powerpack-lite'),
										'desc'		=> __('Display latest post items in a slider view with various options. You can see \'Latest Post Slider Widget - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'parent'	=> 'rps',
										'premium'	=> true
									);
	}

	// If testimonial is active then load it's widget
	if( isset($active_modules['testimonials']) ) {
		$modules['tmw_widget_slider'] = array(
										'name'		=> __('Testimonials Slider', 'powerpack-lite'),
										'desc'		=> __('Display testimonials in a slider view with various options. You can see \'Testimonials Slider - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'premium'	=> true,
									);
	}

	// If Instagram is active then load it's widget
	if( isset($active_modules['instagram']) ) {
		$modules['iscwp_widget_grid'] = array(
										'name'			=> __('Instagram Grid', 'powerpack-lite'),
										'desc'			=> __('Display Instagram pictures in grid view. You can see \'Instagram Grid - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'		=> 'widgets',
										'path'			=> PWPCL_DIR.'modules/instagram/includes/widgets/class-pwpc-instagram-grid-widget.php',
										'conf_text'		=> __('Configure Widget', 'powerpack-lite'),
										'conf_link'		=> $widget_link,
									);

		$modules['iscwp_widget_slider'] = array(
										'name'		=> __('Instagram Slider', 'powerpack-lite'),
										'desc'		=> __('Display Instagram pictures in slider view. You can see \'Instagram Slider - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'premium'	=> true
									);
	}

	// If Logo Showcase is active then load it's widget
	if( isset($active_modules['logo_showcase']) ) {
		$modules['ls_widget_grid'] = array(
										'name'		=> __('Logo Showcase Grid', 'powerpack-lite'),
										'desc'		=> __('Display logo in grid view. You can see \'Logo Showcase Grid - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'parent'	=> 'logo_showcase',
										'premium'	=> true,
									);

		$modules['ls_widget_slider'] = array(
										'name'		=> __('Logo Showcase Slider', 'powerpack-lite'),
										'desc'		=> __('Display logo in slider view. You can see \'Logo Showcase Slider - PwPc\' widget at widget screen.' ,'powerpack-lite'),
										'category'	=> 'widgets',
										'parent'	=> 'logo_showcase',
										'premium'	=> true,
									);
	}

	$modules = (array) apply_filters( 'pwpc_register_site_modules', $modules );
	uasort($modules, "pwpcl_sort_modules"); // sort array on name

	return $modules;
}

/**
 * Function to get plugin modules category wise
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_plugin_modules( $status = 'all', $category = '' ) {

	global $pwpc_options;

	$plugin_modules 	= array();
	$modules 			= PWPC_Lite()->register_modules;
	$active_modules 	= PWPC_Lite()->active_modules;
	$module_cats 		= pwpcl_register_module_cats();

	switch ($status) {
		case 'active':
		case 'in_active':
			$status_modules = ($status == 'in_active') ? PWPC_Lite()->inactive_modules : $active_modules;
			if( !empty($status_modules) ) {
				foreach ($status_modules as $module_key => $module_val) {

					$module_cat = isset($modules[$module_key]['category']) ? $modules[$module_key]['category'] : '';

					if( isset($modules[$module_key]) && $module_cat && isset($module_cats[$module_cat]) ) {
						$plugin_modules[$module_cat][$module_key] = $modules[$module_key];
					}
				}
			}
			break;

		default:
			if( !empty($modules) ) {
				foreach ($modules as $module_key => $module_data) {

					// If key is empty then continue
					if( empty($module_key) || empty($module_data['category']) || !isset($module_cats[$module_data['category']]) ) {
						continue;
					}

					$plugin_modules[$module_data['category']][$module_key] = $module_data;

					// Adding active modules
					if( !empty($active_modules) && !empty($active_modules[$module_key]) ) {
						$plugin_modules['active_modules'][$module_key] = $module_data;
					}
				}
			}
			break;
	}

	// If category is passed
	if( $category ) {
		$plugin_modules = isset($plugin_modules[$category]) ? $plugin_modules[$category] : array();
	}

	return $plugin_modules;
}

/**
 * Function to get active plugin modules
 * This is similar of pwpcl_get_active_modules() But this is for a little twik and fix for pwpcl_register_modules()
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_active_modules() {

	global $pwpc_options;

	$result_arr			= array();
	$module_cats 		= pwpcl_register_module_cats();

	if( !empty($module_cats) ) {
		foreach ($module_cats as $module_cat_key => $module_cat_val) {

			$module_cat_key = sanitize_title($module_cat_key);

			if( isset($pwpc_options[$module_cat_key.'_pack']) ) {
				$result_arr = array_merge( $result_arr, $pwpc_options[$module_cat_key.'_pack'] );
				$result_arr = array_filter($result_arr);
			}
		}
	}
	return $result_arr;
}

/**
 * Function to get active plugin modules
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_active_modules( $by_post = false ) {

	global $pwpc_options;

	$result_arr			= array();
	$active_modules		= array();
	$register_modules 	= !empty(PWPC_Lite()->register_modules) ? PWPC_Lite()->register_modules : pwpcl_register_modules();
	$module_cats 		= pwpcl_register_module_cats();
	$pwpc_module_opts	= ($by_post && isset($_POST['pwpc_opts'])) ? pwpcl_clean( $_POST['pwpc_opts'] ) : $pwpc_options;

	if( !empty($module_cats) ) {
		foreach ($module_cats as $module_cat_key => $module_cat_val) {

			$module_cat_key = sanitize_title($module_cat_key);

			if( isset($pwpc_module_opts[$module_cat_key.'_pack']) ) {
				$result_arr = array_merge( $result_arr, $pwpc_module_opts[$module_cat_key.'_pack'] );
				$result_arr = array_filter($result_arr);
			}
		}

		// Checking the result array in registered modules so unnecessary module key will not remain
		if( !empty($result_arr) ) {
			foreach ($result_arr as $res_key => $res_val) {
				if( array_key_exists($res_key, $register_modules) ) {
					$active_modules[$res_key] = $res_val;
				}
			}
		}
	}

	return $active_modules;
}

/**
 * Function to get inactive plugin modules
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_inactive_modules( $by_post = false ) {

	global $pwpc_options;

	$result_arr	= array();

	// If post is passed
	if( $by_post && isset($_POST['pwpc_opts']) ) {

		$module_cats 		= pwpcl_register_module_cats();
		$pwpc_module_opts	= pwpcl_clean( $_POST['pwpc_opts'] );

		if( !empty($module_cats) ) {
			foreach ($module_cats as $module_cat_key => $module_cat_val) {

				$module_cat_key = sanitize_title($module_cat_key);

				if( isset($pwpc_module_opts[$module_cat_key.'_pack']) ) {
					$result_arr 		= ($result_arr + $pwpc_module_opts[$module_cat_key.'_pack']);
					$result_arr 		= array_filter( $result_arr, 'pwpcl_get_zero' );
				}
			}
		}

	} else {

		$active_modules 	= PWPC_Lite()->active_modules;
		$register_modules 	= PWPC_Lite()->register_modules;

		$active_modules_arr 	= array_keys( $active_modules );
		$register_modules_arr 	= array_keys( $register_modules );

		if( !empty($register_modules) ) {
			foreach ($register_modules as $module_key => $module_val) {
				if( !isset( $active_modules[$module_key] ) ) {
					$result_arr[$module_key] = 0;
				}
			}
		}
	}

	return $result_arr;
}

/**
 * Function to get post type supports like sorting and etc
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_post_supports() {
	return apply_filters('pwpcl_post_supports', array());
}

/**
 * Function to get taxonomy supports like sorting and etc
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_taxonomy_supports() {
	return apply_filters('pwpcl_taxonomy_supports', array());
}

/**
 * Function to get plugin links
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_get_plugin_link( $type = 'main', $url_args = array() ) {

	$admin_url 	= admin_url('admin.php');
	$url_args	= is_array( $url_args ) ? $url_args : array();

	switch ($type) {
		case 'current':
			$link = add_query_arg( $url_args );
			break;

		case 'tour':
			$link = add_query_arg( array_merge( array('page' => PWPCL_PAGE_SLUG, 'tab' => 'modules', 'message' => 'pwpc-tutorial'), $url_args ), admin_url('admin.php') );
			break;

		case 'about':
			$link = add_query_arg( array_merge( array('page' => 'pwpc-about'), $url_args ), $admin_url );
			break;
		
		default:
			$link = add_query_arg( array_merge( array('page' => PWPCL_PAGE_SLUG), $url_args ), $admin_url );
			break;
	}
	return apply_filters('pwpcl_get_plugin_link', $link, $type);
}

/**
 * Function to get module supports
 * 
 * @package PowerPack Lite
 * @since 1.0
 */
function pwpcl_module_support_info() {
	$supports = array(
			'multisite' 	=> array(
									'title' => __('Multisite Support', 'powerpack-lite'),
									'icon'	=> 'dashicons-admin-multisite',
									),
			'shortcode' 	=> array(
									'title' => __('Has Shortcode', 'powerpack-lite'),
									'icon'	=> 'dashicons-menu',
									),
			'widget'		=> array(
									'title' => __('Has Widget', 'powerpack-lite'),
									'icon'	=> 'dashicons-welcome-widgets-menus',
									),
			'page_builder'	=> array(
									'title' => __('Has Visual Composer Support', 'powerpack-lite'),
									'icon'	=> 'dashicons-schedule',
									),
			'multilanguage'	=> array(
									'title' => __('100% Multilanguage', 'powerpack-lite'),
									'icon'	=> 'dashicons-translation',
									),
			'responsive'	=> array(
									'title' => __('Fully Responsive', 'powerpack-lite'),
									'icon'	=> 'dashicons-smartphone',
									),
		);
	return apply_filters('pwpcl_module_support_info', $supports);
}