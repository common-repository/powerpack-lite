<?php
/**
 * Widget API: PWPC Social link
 *
 * @package PowerPack Lite
 * @subpackage Social Link Widget
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Widget Registration.
 *
 * Register Pwpc Social Icons widget.
 *
 */
function pwpcl_slw_load_widget() {
    register_widget( 'Pwpcl_Slw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'pwpcl_slw_load_widget' );

class Pwpcl_Slw_Widget extends WP_Widget {

    var $defaults;

    /**
     * Sets up a new widget instance.
     * 
     * @subpackage Social Link Widget
     * @since 1.0
    */
    function __construct() {

        $widget_ops = array('classname' => 'pwpc-slw-links', 'description' => __('Display social links with icons.', 'powerpack-lite') );
        parent::__construct( 'Pwpcl_Slw_Widget', __('Social Icons - PwPc', 'powerpack-lite'), $widget_ops );

        // Default widget option values
        $this->defaults = apply_filters( 'pwpc_slw_widget_default_opts', array(
            'title'                 =>  __('Connect With Us', 'powerpack-lite'),
            'sub_title'             => '',
            'link_target'           => 'blank',
            'slw_socials'           => array(),
        ));
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @subpackage Social Link Widget
     * @since 1.0
    */
    function update($new_instance, $old_instance) {
        
        $instance = $old_instance;

        $instance['title']              = pwpcl_clean($new_instance['title']);        
        $instance['sub_title']          = pwpcl_clean($new_instance['sub_title']);
        $instance['link_target']        = pwpcl_clean($new_instance['link_target']);
        $instance['slw_socials']        = array();
        
        // Social Fields
        if( !empty($new_instance['slw_socials']) ) {
            foreach ($new_instance['slw_socials'] as $slw_key => $slw_val) {
                
                // If link is empty then skip it
                if( empty($slw_val['link']) ) {
                    continue;
                }

                $instance['slw_socials'][$slw_key]['name'] = isset($slw_val['name']) ? pwpcl_clean($slw_val['name'])        : '';
                $instance['slw_socials'][$slw_key]['link'] = isset($slw_val['link']) ? pwpcl_clean_url( $slw_val['link'] )  : '';
            }
        }

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @subpackage Social Link Widget
     * @since 1.0
    */
    function form($instance) {
        
        $instance           = wp_parse_args( (array) $instance, $this->defaults );
        $get_social_link    = pwpcl_slw_get_social_icons();
        $social_data        = !empty($instance['slw_socials']) ? $instance['slw_socials'] : array('0' => '');
    ?>
        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'powerpack-lite' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo pwpcl_esc_attr($instance['title']); ?>" />
        </p>

        <!-- Sub Title -->
        <p>
            <label for="<?php echo $this->get_field_id( 'sub_title' ); ?>"><?php _e( 'Sub Title', 'powerpack-lite' ); ?>:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'sub_title' ); ?>" name="<?php echo $this->get_field_name( 'sub_title' ); ?>" type="text" value="<?php echo pwpcl_esc_attr($instance['sub_title']); ?>" />
        </p>

        <div class="pwpc-sub-sett-title"><i class="dashicons dashicons-admin-generic"></i> <?php _e('Social Icon Settings', 'powerpack-lite'); ?></div>

        <?php if(!empty($social_data)) { ?>
            <table class="form-table pwpc-social-table">
                <tbody>
                    <?php foreach ($social_data as $social_key => $social_data) {

                        $icon_name = isset($social_data['name'])  ? $social_data['name']  : '';
                        $icon_link = isset($social_data['link'])  ? $social_data['link']  : '';
                    ?>
                    <tr class="pwpc-slw-social-row" data-key="<?php echo $social_key; ?>">
                        <td class="pwpc-slw-inr-social-row">
                            <table class="form-table">
                                <tbody>
                                    <tr>
                                        <td><?php _e('Social Icons', 'powerpack-lite'); ?></td>
                                        <td>
                                            <select name="<?php echo $this->get_field_name( 'slw_socials' ); ?>[<?php echo $social_key; ?>][name]" class="widefat">
                                            <?php
                                                foreach ($get_social_link as $pwpc_icon_key => $pwpc_icon_data) {
                                            ?>
                                                    <option value="<?php echo $pwpc_icon_key;?>" <?php selected($icon_name,$pwpc_icon_key);?>><?php echo $pwpc_icon_data['label'];?></option>     
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </td>
                                        <td class="pwpc-slw-act-row" rowspan="2">                                            
                                            <span class="pwpc-slw-act-btn pwpc-slw-add-row" title="<?php _e('Add Row', 'powerpack-lite'); ?>"><i class="dashicons dashicons-plus-alt"></i></span>
                                            <span class="pwpc-slw-act-btn pwpc-slw-del-row" title="<?php _e('Delete Row', 'powerpack-lite'); ?>"><i class="dashicons dashicons-trash"></i></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php _e('Link', 'powerpack-lite'); ?></td>
                                        <td>
                                            <input type="text" name="<?php echo $this->get_field_name( 'slw_socials' ); ?>[<?php echo $social_key; ?>][link]" value="<?php echo $icon_link; ?>" class="widefat" placeholder="<?php _e('Social Link', 'powerpack-lite'); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table><!-- end of inner table -->
                        </td>
                    </tr>
            <?php   } ?>
                </tbody>                 
            </table> 
        <?php } ?>

        <!-- Link Target Field -->
        <p>
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Link Target', 'powerpack-lite'); ?>:</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>">
                <option value=""><?php _e('Open in Same Window', 'powerpack-lite') ?></option>
                <option value="blank" <?php selected( $instance['link_target'], 'blank' ); ?> ><?php _e('Open in New Window', 'powerpack-lite') ?></option>
            </select>
        </p>
        <?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @subpackage Social Link Widget
    * @since 1.0
    */
    function widget($widget_args, $instance) {

        $instance           = wp_parse_args( (array) $instance, $this->defaults );
        $social_icons       = pwpcl_slw_get_social_icons();
        $unique             = pwpcl_get_unique();

        extract($widget_args, EXTR_SKIP);

        $title          = $instance['title'];
        $sub_title      = $instance['sub_title'];
        $slw_socials    = $instance['slw_socials'];
        $link_target    = ($instance['link_target'] == 'blank') ? '_blank' : '_self';

        // Start Widget Output
        echo $before_widget;
        
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
    ?>
        <div class="pwpc-slw-links-widget">

            <?php if( $sub_title ) { ?>
            <div class="pwpc-slw-sub-heading"><?php echo $sub_title; ?></div>
            <?php } ?>

            <div class="pwpc-icon-style pwpc-social-icons">
            <?php if(!empty( $slw_socials )) {
                    foreach($slw_socials as $social_key => $social_val) {

                        $social_slug = isset($social_val['name']) ? $social_val['name'] : '';
                        $social_link = isset($social_val['link']) ? $social_val['link'] : '';

                        if( $social_slug && $social_link && isset($social_icons[$social_slug]) ) {

                            $social_icon = isset($social_icons[$social_slug]['icon']) ? $social_icons[$social_slug]['icon'] : '';
            ?>
                            <a class="pwpc-social-icon-link pwpc-social-link-<?php echo $social_slug; ?>" href="<?php echo esc_url($social_link); ?>" target="<?php echo $link_target; ?>"><i class="pwpc-social-icon pwpc-social-<?php echo $social_slug.' '.$social_icon; ?>"></i></a>
            <?php
                        }
                    }
                } // End of main if
            ?>
            </div>
    </div>

    <?php
        echo $after_widget;
    }
}