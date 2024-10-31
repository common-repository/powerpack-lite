jQuery( document ).ready(function( $ ) {

    $(".pwpc-dashboard-wrap .pwpc-module-check").click( function() {

        var cls_ele = $(this).closest('.pwpc-site-module-wrap');

        if( $(this).is(':checked') ) {
            cls_ele.addClass('pwpc-site-module-active');
        } else {
            cls_ele.removeClass('pwpc-site-module-active');
        }
        cls_ele.find('.pwpc-site-module-conf-wrap').slideToggle();
    });

    /* Show save notice */
    $('.pwpc-dashboard-wrap .pwpc-module-cnt-wrp').find('input:not(.pwpc-no-chage), select:not(.pwpc-no-chage), textarea:not(.pwpc-no-chage), checkbox:not(.pwpc-no-chage)').bind('keydown change', function(){

        var anim_bottom = '50px';
        if( PWPCAdmin.is_mobile == 1 ) {
            anim_bottom = 0;
        }

        $('.pwpc-save-info-wrap').show().animate({bottom: anim_bottom}, 500);
        $('.pwpc-save-info-wrap .pwpc-save-notify-btn').focus();
    });

    /* Hide save notice */
    $(document).on('click', '.pwpc-save-info-wrap .pwpc-save-info-close', function(){
        $(this).closest('.pwpc-save-info-wrap').fadeOut( "slow", function() {
            $(this).css({bottom:''});
        });
    });

    /* Search Toggle */
    $(document).on('click', '.pwpc-dashboard-search-icon', function(e) {
        e.preventDefault();
        var cls_ele = $(this).closest('.pwpc-dashboard-header');

        cls_ele.find('.pwpc-dashboard-search-wrap').stop().slideToggle();
        cls_ele.find('.pwpc-dashboard-search').val('').focus().trigger('keyup');

        $('.pwpc-no-module-search').hide();
    });

    /* Esc key press */
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {

            var sort_cat_val = $('.pwpc-module-sort-cat').val();

            $('.pwpc-no-module-search').hide();
            $('.pwpc-dashboard-header .pwpc-dashboard-search-wrap').slideUp();

            if( sort_cat_val ) {
                $('.pwpc-site-modules-wrap .pwpc-site-module-'+sort_cat_val).fadeIn();
            } else {
                $('.pwpc-site-modules-wrap .pwpc-site-module-wrap').fadeIn();
            }

            pwpc_hide_popup();
        }
    });

    var timer;
    var timeOut = 300; /* delay after last keypress to execute filter */

    /* Module Search */
    $('.pwpc-dashboard-search').keyup(function(event) {

        /* If element is focused and esc key is pressed */
        if (event.keyCode == 27) {
            return true;
        }

        clearTimeout(timer); /* if we pressed the key, it will clear the previous timer and wait again */
        timer = setTimeout(function() {

            var search_value    = $('.pwpc-dashboard-search').val().toLowerCase();
            var sort_cat_val    = $('.pwpc-module-sort-cat').val();
            var loop_part       = $('.pwpc-site-modules-wrap .pwpc-site-module-wrap');
            var zebra = 'odd';

            if( sort_cat_val ) {
                loop_part = $('.pwpc-site-modules-wrap .pwpc-site-module-'+sort_cat_val);
            }

            loop_part.each(function(index) {

                var contents = $(this).find('.pwpc-site-module-title span').html().toLowerCase();
                var desc_cnt = $(this).find('.pwpc-site-module-desc').html().toLowerCase();

                if (contents.indexOf(search_value) !== -1 || desc_cnt.indexOf(search_value) !== -1) {
                    $(this).fadeIn('slow');

                    if (zebra == 'odd') {
                        zebra = 'even';
                    } else {
                        zebra = 'odd';
                    }
                } else {
                    $(this).hide();
                }
            });

            if( $('.pwpc-site-modules-wrap .pwpc-site-module-wrap:visible').length <= 0 ) {
                $('.pwpc-no-module-search').fadeIn();
            } else {
                $('.pwpc-no-module-search').hide();
            }

        }, timeOut);
    });

    /* Horizontal Tab */
    $( document ).on( "click", ".pwpc-htab-nav a", function() {

        $(".pwpc-htab-nav").removeClass('pwpc-htab-active');

        $(this).parent('.pwpc-htab-nav ').addClass("pwpc-htab-active");

        $(".pwpc-htab-cnt").hide();

        var selected_tab = $(this).attr("href");

        $(selected_tab).show();

        $('.pwpc-htab-selected-tab').val(selected_tab);

        return false;
    });

    /* Remain selected horizontal tab for user */
    if( $('.pwpc-htab-selected-tab').length > 0 ) {
        var sel_tab = $('.pwpc-htab-selected-tab').val();

        if( typeof(sel_tab) !== 'undefined' && sel_tab != ''  ) {
            $('.pwpc-htab-nav [href="'+sel_tab+'"]').click();
        }
    }

    /* Module category filter */
    $( document ).on( 'change', '.pwpc-module-sort-cat', function() {
        var ele_val = $(this).val();

        $('.pwpc-dashboard-search').val('');
        $('.pwpc-no-module-search').hide();

        /* MixItUp plugin */
        var filter_val = ele_val ? '.pwpc-site-module-'+ele_val : '.pwpc-site-module-wrap';
        if( $(filter_val).length > 0 ) {
            $('.pwpc-site-modules-inr-wrap').mixItUp('filter', filter_val);
        }
    });

    /* MixItUp plugin */
    if( $('.pwpc-site-modules-inr-wrap').length > 0 ) {
        $('.pwpc-site-modules-inr-wrap').mixItUp({
            selectors: {
                target: '.pwpc-site-module-wrap',
            }
        });
    }

    /* Color Picker */
    if( $('.pwpc-color-box').length > 0 ) {
        $('.pwpc-color-box').wpColorPicker();
    }
    /* Widget Color Picker */
    if( $('#widgets-right .widget .pwpc-wcolor-box').length > 0 ) {
        $('.pwpc-wcolor-box').wpColorPicker();
    }

    /* Tooltip */
    if( $('.pwpc-tooltip').length > 0 ) {

        $('.pwpc-tooltip').each( function( attachment, index ) {

            var tooltip_cnt = $(this).attr('data-tooltip-content');
            tooltip_cnt = ( $(tooltip_cnt).length > 0 ) ? $(tooltip_cnt) : null;

            $(this).tooltipster({
                maxWidth: 500,
                content: tooltip_cnt,
                contentCloning: true,
                animation: 'grow',
                theme: 'pwpc-tooltipster tooltipster-punk',
                interactive: true,
                repositionOnScroll: true,
            });
        });
    }

    /* Media Uploader */
    $( document ).on( 'click', '.pwpc-image-upload', function() {
        
        var imgfield, showfield, multiple_img;
        imgfield        = jQuery(this).prev('input').attr('id');
        showfield       = jQuery(this).parents('td').find('.pwpc-img-preview');
        multiple_img    = jQuery(this).attr('data-multiple');
        multiple_img    = (typeof(multiple_img) != 'undefined' && multiple_img == 'true') ? true : false;

        if(typeof wp == "undefined" || PWPCAdmin.new_ui != '1' ) {
            
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            
            window.original_send_to_editor = window.send_to_editor;
            window.send_to_editor = function(html) {
                
                if(imgfield) {
                    
                    var mediaurl = $('img',html).attr('src');
                    $('#'+imgfield).val(mediaurl);
                    showfield.html('<img src="'+mediaurl+'" />');
                    tb_remove();
                    imgfield = '';
                    
                } else {
                    window.original_send_to_editor(html);
                }
            };
            return false;
            
        } else {
            
            var file_frame;
            
            /* New media uploader */
            var button = jQuery(this);

            /* If the media frame already exists, reopen it. */
            if ( file_frame ) {
                file_frame.open();
              return;
            }

            if( multiple_img == true ) {
                
                /* Create the media frame. */
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: button.data( 'title' ),
                    button: {
                        text: button.data( 'button-text' ),
                    },
                    multiple: true
                });
                
            } else {

                /* Create the media frame. */
                file_frame = wp.media.frames.file_frame = wp.media({
                    frame: 'post',
                    state: 'insert',
                    title: button.data( 'title' ),
                    button: {
                        text: button.data( 'button-text' ),
                    },
                    multiple: false  /* Set to true to allow multiple files to be selected */
                });
            }
    
            file_frame.on( 'menu:render:default', function(view) {
                /* Store our views in an object. */
                var views = {};
    
                /* Unset default menu items */
                view.unset('library-separator');
                view.unset('gallery');
                view.unset('featured-image');
                view.unset('embed');
    
                /* Initialize the views in our view object. */
                view.set(views);
            });

            /* When an image is selected, run a callback. */
            file_frame.on( 'select', function() {
                
                /* Get selected size from media uploader */
                var selected_size = $('.attachment-display-settings .size').val();
                var selection = file_frame.state().get('selection');
                
                selection.each( function( attachment, index ) {
                    
                    attachment = attachment.toJSON();

                    /* Selected attachment url from media uploader */
                    var attachment_id = attachment.id ? attachment.id : '';
                    if( attachment_id && attachment.sizes && multiple_img == true ) {
                        
                        var attachment_url          = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                        var attachment_edit_link    = attachment.editLink ? attachment.editLink : '';
                        var template                = wp.template('pwpc-pap-img-gallery');
                        
                        showfield.append( template({
                                                    attachment_edit_link : attachment_edit_link,
                                                    attachment_url : attachment_url,
                                                    attachment_id : attachment_id,
                                                })
                        );
                        showfield.find('.pwpc-pap-no-img-placeholder').hide();
                    }
                });
            });
    
            /* When an image is selected, run a callback. */
            file_frame.on( 'insert', function() {
    
                /* Get selected size from media uploader */
                var selected_size = $('.attachment-display-settings .size').val();
                var selection = file_frame.state().get('selection');

                selection.each( function( attachment, index ) {
                    attachment = attachment.toJSON();
                    
                    /* Selected attachment url from media uploader */
                    var attachment_url = attachment.sizes[selected_size].url;
                        
                    $('#'+imgfield).val(attachment_url);
                    showfield.html('<img src="'+attachment_url+'" alt="" />');
                });
            });
    
            file_frame.open();
        }
    });

    /* Clear Media */
    $( document ).on( 'click', '.pwpc-image-clear', function() {
        $(this).parent().find('.pwpc-img-upload-input').val('');
        $(this).parent().find('.pwpc-img-preview').html('');
    });

    /* Reset Settings Button */
    $( document ).on( 'click', '.pwpc-reset-sett', function() {
        var ans;
        ans = confirm(PWPCAdmin.reset_msg);

        if(ans) {
            return true;
        } else {
            return false;
        }
    });

    /* Drag and Drop */
    if( $('.pwpc-gallery-imgs-prev').length > 0 ) {
        $('.pwpc-gallery-imgs-prev').sortable({
            items: '.pwpc-gallery-img-wrp',
            cursor: 'move',
            scrollSensitivity:40,
            forcePlaceholderSize: true,
            forceHelperSize: false,
            helper: 'clone',
            opacity: 0.8,
            placeholder: 'pwpc-gallery-img-placeholder',
            containment: '.form-table',
            start:function(event,ui){
                ui.item.css('background-color','#f6f6f6');
            },
            stop:function(event,ui){
                ui.item.removeAttr('style');
            }
        });
    }

    /* Remove All Gallery Image */
    $(document).on('click', '.pwpc-del-gallery-imgs', function() {

        var ans = confirm(PWPCAdmin.all_img_delete_text);

        if(ans) {
            $('.pwpc-gallery-imgs-prev .pwpc-gallery-img-wrp').remove();
            $('.pwpc-no-img-placeholder').fadeIn();
        }
    });

    /* Remove Single Gallery Image */
    $(document).on('click', '.pwpc-gallery-del-img', function(){
        $(this).closest('.pwpc-gallery-img-wrp').fadeOut(300, function(){ 
            $(this).remove();
            
            if( $('.pwpc-gallery-img-wrp').length == 0 ) {
                $('.pwpc-no-img-placeholder').show();
            }
        });
    });

    /* Close Popup */
    $(document).on('click', '.pwpc-popup-close', function(){
        pwpc_hide_popup();
    });

    /* WP Code Editor */
    if( PWPCAdmin.syntax_highlighting == 1 ) {
        jQuery('.pwpc-code-editor').each( function() {
            
            var cur_ele     = jQuery(this);
            var data_mode   = cur_ele.attr('data-mode');
            data_mode       = data_mode ? data_mode : 'css';

            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: data_mode,
                }
            );
            var editor = wp.codeEditor.initialize( cur_ele, editorSettings );

            /* When post metabox is toggle */
            $(document).on('postbox-toggled', function( event, ele ) {
                if( $(ele).hasClass('closed') ) {
                    return;
                }

                if( $(ele).find('.pwpc-code-editor').length > 0 ) {
                    editor.codemirror.refresh();
                }
            });
        });
    }
});

(function($) {
    /* When Page is fully loaded */
    $( window ).load(function() {
        var module_search = pwpc_get_url_parameter('search');
        if( typeof(module_search) !== 'undefined' && module_search != '' ) {
            $('.pwpc-dashboard-search-icon').trigger('click');
            $('.pwpc-dashboard-search').val(module_search).trigger('keyup');
        }
    });
})(jQuery);

/* Function to hide popup */
function pwpc_hide_popup() {
    jQuery('.pwpc-popup-data-wrp').hide();
    jQuery('.pwpc-popup-overlay').hide();
    jQuery('body').removeClass('pwpc-no-overflow');

    if( jQuery('.pwpc-popup-data-wrp').attr('data-flush') ) {
        jQuery('.pwpc-popup-data-wrp .pwpc-popup-body-wrp').html('');
    }
}

/* Update callback on widget */
jQuery(document).on('widget-added widget-updated', pwpc_on_update_widget);
function pwpc_on_update_widget( event, widget ) {
    if( widget.find( '.pwpc-wcolor-box' ).length > 0 ) {
        widget.find( '.pwpc-wcolor-box' ).wpColorPicker();
    }
}

function pwpc_get_url_parameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        result,
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            result = sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            return result.replace(/\+/g, ' ');
        }
    }
}