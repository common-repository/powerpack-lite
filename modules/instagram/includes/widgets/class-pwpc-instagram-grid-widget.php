<?php
/**
 * Widget API: Instagram Grid Widget Class
 *
 * @package PowerPack Lite
 * @subpackage Instagram
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pwpcl_iscwp_insta_grid_widget() {
    register_widget( 'Pwpcl_Iscwp_Insta_Grid_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'pwpcl_iscwp_insta_grid_widget' );

class Pwpcl_Iscwp_Insta_Grid_Widget extends WP_Widget {

    var $defaults;

    /**
     * Sets up a new widget instance.
     *
     * @subpackage Instagram
     * @since 1.0
     */
    function __construct() {
        $widget_ops = array('classname' => 'pwpc-iscwp-insta-widget pwpc-clearfix', 'description' => __('Display Instagram pictures in grid view.', 'powerpack-lite') );
        parent::__construct( 'pwpcl_iscwp_insta_grid', __('Instagram Grid', 'powerpack-lite').' - PwPc', $widget_ops );

        $this->defaults = array(
            'title'                         => __('Instagram Photos', 'powerpack-lite'),
            'username'                      => '',
            'grid'                          => 2,
            'popup_gallery'                 => 1,
            'instagram_link_text'           => __('View On Instagram','powerpack-lite'),
            'limit'                         => 10,
            'offset'                        => 2,
            'gallery_height'                => '',
            'show_caption'                  => 1,
            'popup'                         => 1,
            'show_likes_count'              => 1,
            'show_comments_count'           => 0,
            'image_fit'                     => 0,
        );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @subpackage Instagram
     * @since 1.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']                          = isset($new_instance['title']) ? pwpcl_clean($new_instance['title']) : '';
        $instance['grid']                           = (!empty($new_instance['grid']) && $new_instance['grid'] <= 12) ? $new_instance['grid'] : '1';
        $instance['username']                       = isset($new_instance['username'])              ? pwpcl_clean( $new_instance['username'] ) : '';
        $instance['instagram_link_text']            = !empty($new_instance['instagram_link_text'])  ? pwpcl_clean( $new_instance['instagram_link_text'] )     : __('View On Instagram','powerpack-lite');
        $instance['limit']                          = isset($new_instance['limit'])                 ? pwpcl_clean_number( $new_instance['limit'], 10 )        : '';
        $instance['offset']                         = isset($new_instance['offset'])                ? pwpcl_clean_number( $new_instance['offset'] )           : '';
        $instance['gallery_height']                 = !empty($new_instance['gallery_height'])       ? pwpcl_clean_number( $new_instance['gallery_height'] )   : '';
        $instance['image_fit']                      = isset($new_instance['image_fit'])             ? 1 : 0;
        $instance['popup_gallery']                  = isset($new_instance['popup_gallery'])         ? 1 : 0;
        $instance['show_caption']                   = isset($new_instance['show_caption'])          ? 1 : 0;
        $instance['popup']                          = isset($new_instance['popup'])                 ? 1 : 0;
        $instance['show_likes_count']               = isset($new_instance['show_likes_count'])      ? 1 : 0;
        $instance['show_comments_count']            = isset($new_instance['show_comments_count'])   ? 1 : 0;

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @subpackage Instagram
     * @since 1.0
     */
    function form($instance) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
?>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo pwpcl_esc_attr($instance['title']); ?>" />
        </p>

        <!-- Username -->
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e( 'Username', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo pwpcl_esc_attr($instance['username']); ?>" />
            <span><em><?php _e( 'Enter instagram username. e.g instagram', 'powerpack-lite' ); ?></em></span>
        </p>

        <!-- Number of Grid -->
        <p>
            <label for="<?php echo $this->get_field_id('grid'); ?>"><?php _e( 'Grid', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('grid'); ?>" name="<?php echo $this->get_field_name('grid'); ?>" type="number" value="<?php echo $instance['grid']; ?>" min="1" max="12" />
        </p>

        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Number of Photos', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" min="1" />
        </p>

        <!-- Design Offset -->
        <p>
            <label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e( 'Design Offset', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="number" value="<?php echo $instance['offset']; ?>" min="0" />
            <span><em><?php _e( 'Enter offset value. The space around the image.', 'powerpack-lite' ); ?></em></span>
        </p>

        <!-- Number of gallery height -->
        <p>
            <label for="<?php echo $this->get_field_id('gallery_height'); ?>"><?php _e( 'Gallery Height', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('gallery_height'); ?>" name="<?php echo $this->get_field_name('gallery_height'); ?>" type="number" value="<?php echo $instance['gallery_height']; ?>" min="1" />
        </p>

        <!-- Select instagram link text -->
        <p>
            <label for="<?php echo $this->get_field_id('instagram_link_text'); ?>"><?php _e( 'Instagram Redirect Link Text', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram_link_text'); ?>" name="<?php echo $this->get_field_name('instagram_link_text'); ?>" type="text" value="<?php echo pwpcl_esc_attr($instance['instagram_link_text']); ?>" />
        </p>

        <!-- Select popup -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup' ); ?>" name="<?php echo $this->get_field_name( 'popup' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup' ); ?>"><?php _e( 'Popup', 'powerpack-lite' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable popup.', 'powerpack-lite' ); ?></em></span>
        </p>

        <!-- Select popup gallery -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_gallery' ); ?>" name="<?php echo $this->get_field_name( 'popup_gallery' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_gallery'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_gallery' ); ?>"><?php _e( 'Popup Gallery', 'powerpack-lite' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable Prev/Next gallery mode for popup.', 'powerpack-lite' ); ?></em></span>
        </p>

        <!-- Select show caption -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_caption' ); ?>" name="<?php echo $this->get_field_name( 'show_caption' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_caption'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_caption' ); ?>"><?php _e( 'Show Image Caption', 'powerpack-lite' ); ?></label>
        </p>

        <!-- Select show likes count -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_likes_count' ); ?>" name="<?php echo $this->get_field_name( 'show_likes_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_likes_count'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_likes_count' ); ?>"><?php _e( 'Show Likes Count', 'powerpack-lite' ); ?></label>
        </p>

        <!-- Select show comments count -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_comments_count' ); ?>" name="<?php echo $this->get_field_name( 'show_comments_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_comments_count'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_comments_count' ); ?>"><?php _e( 'Show Comments Count', 'powerpack-lite' ); ?></label>
        </p>

        <!-- Image Fit -->
        <p>
            <input id="<?php echo $this->get_field_id( 'image_fit' ); ?>" name="<?php echo $this->get_field_name( 'image_fit' ); ?>" type="checkbox" value="1" <?php checked( $instance['image_fit'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'image_fit' ); ?>"><?php _e( 'Image Fit', 'powerpack-lite' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to fill image in a whole div.', 'powerpack-lite' ); ?></em></span>
        </p>
<?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @subpackage Instagram
    * @since 1.0
    */
    function widget( $insta_grid_args, $instance ) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract($insta_grid_args, EXTR_SKIP);

        $title                          = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $username                       = $instance['username'];
        $grid                           = $instance['grid'];
        $instagram_link_text            = $instance['instagram_link_text'];        
        $popup                          = $instance['popup'];
        $popup_gallery                  = ( isset($instance['popup_gallery']) && ($instance['popup_gallery'] == 1) ) ? "true" : "false";
        $limit                          = $instance['limit'];
        $offset_css                     = ($instance['offset'] != '') ? "padding:{$instance['offset']}px;" : '';        
        $gallery_height                 = $instance['gallery_height'];
        $show_caption                   = ( isset($instance['show_caption']) && ($instance['show_caption'] == 1) ) ? "true" : "false";
        $show_likes_count               = ( isset($instance['show_likes_count']) && ($instance['show_likes_count'] == 1) ) ? "true" : "false";
        $show_comments_count            = ( isset($instance['show_comments_count']) && ($instance['show_comments_count'] == 1) ) ? "true" : "false";    
        $height_css                     = !empty($gallery_height)           ? "height:{$gallery_height}px;"     : '';
        $image_fit                      = $instance['image_fit'];
        $old_browser                    = pwpcl_old_browser();

        // If no username is passed then return
        if( empty($username) ) {
            return;
        }        

        // Enqueue required script
        if( $popup ) {
            
            // Popup Configuration
            $popup_conf = compact( 'popup_gallery', 'show_likes_count', 'show_comments_count', 'show_caption', 'instagram_link_text' );

            wp_enqueue_script('wpos-magnific-script');
        }
        if( $popup || ($image_fit && $old_browser) ) {
            wp_enqueue_script('pwpc-iscwp-public-js');
        }

        // Taking some variables
        $popup_html          = '';
        $loop_count          = 1;
        $count               = 1;
        $unique              = pwpcl_get_unique();

        // Extra classes
        $extra_cls          = ($old_browser)            ? ' pwpc-iscwp-old-browser'     : '';
        $extra_cls          .= ($image_fit)             ? ' pwpc-iscwp-image-fit'       : '';

        $main_wrpper_cls    = "pwpc-iscwp-instagram-grid-widget pwpc-iscwp-insta-grid pwpc-iscwp-grid-{$grid} pwpc-clearfix";
        $main_wrpper_cls    .= ($popup)                 ? ' pwpc-iscwp-popup-gallery'    : '';
        $main_wrpper_cls    .= $extra_cls;

        $instagram_link_main = 'https://www.instagram.com/';
        $instagram_data      = pwpcl_iscwp_get_user_media( $username );
        $insta_user_media    = !empty($instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges']) ? $instagram_data['iscwp_data']['edge_owner_to_timeline_media']['edges'] : '';

        // User details
        $userdata = array(
                'username'          =>  (!empty($instagram_data['iscwp_user_data']['username']))            ? $instagram_data['iscwp_user_data']['username']        : '',
                'full_name'         =>  (!empty($instagram_data['iscwp_user_data']['full_name']))           ? $instagram_data['iscwp_user_data']['full_name']       : '',
                'profile_picture'   =>  (!empty($instagram_data['iscwp_user_data']['profile_pic_url']) )    ? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
            );

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        if(!empty($insta_user_media)) { ?>
            
            <div class="pwpc-iscwp-main-wrp pwpc-clearfix">
                <div class="<?php echo $main_wrpper_cls; ?>" id="pwpc-iscwp-gallery-<?php echo $unique; ?>" data-user="<?php echo $username; ?>">
                    <div class="pwpc-iscwp-outer-wrap">

                        <?php foreach ($insta_user_media as $iscwp_key => $iscwp_data) {

                            $iscwp_data         = pwpcl_iscwp_insta_image_data( $iscwp_data );
                            $img_shortcode      = $iscwp_data['shortcode'];
                            $gallery_img_src    = isset( $iscwp_data['thumbnail_resources'][640] ) ? $iscwp_data['thumbnail_resources'][640] : $iscwp_data['display_url'];
                            $iscwp_likes        = pwpcl_iscwp_format_number( $iscwp_data['like_count'] );
                            $iscwp_comments     = pwpcl_iscwp_format_number( $iscwp_data['comment_count'] );
                            $instagram_link     = $iscwp_data['link'];
                            $img_caption        = $iscwp_data['caption'];
                            $iscwp_link_value   = ($popup) ? 'javascript:void(0);' : $instagram_link;

                            // Getting media data
                            $media_data     = pwpcl_iscwp_user_media_data( $username, $img_shortcode );
                            $location       = isset($media_data['location'])        ? $media_data['location']       : '';                       
                            $video_url      = isset($media_data['video_url'])       ? $media_data['video_url']      : '';
                            $popup_attr     = (!$media_data) ? "data-shortcode='{$img_shortcode}'" : '';

                            $wrpper_cls         = "pwpc-iscwp-cnt-wrp pwpc-icol-{$grid} pwpc-columns";
                            $wrpper_cls         .= ($loop_count == 1) ? " pwpc-iscwp-first" : '';

                            // Design File
                            include( PWPCL_ISCWP_DIR . '/templates/design-1.php' );

                            // Creating Popup HTML
                            if( $popup ) {
                                ob_start();
                                include( PWPCL_ISCWP_DIR . '/templates/popup/popup.php' );
                                $popup_html .= ob_get_clean();
                            }
                            
                            if($limit == $count) {
                                break;
                            }

                            $count++;
                            $loop_count++; // Increment loop count for grid
                            
                            // Reset loop count
                            if( $loop_count == $grid ) {
                                $loop_count = 0;
                            }
                        } ?>
                    </div><?php
                    
                    if( $popup ) { ?>
                        <div class="pwpc-iscwp-popup-conf pwpc-hide" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
                    <?php } ?>
                </div>
            </div>
<?php
        }
        echo $popup_html; // Printing popup html

        echo $after_widget;
    }
}