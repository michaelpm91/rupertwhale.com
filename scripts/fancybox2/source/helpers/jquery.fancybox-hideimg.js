 /*!
 * Hide image helper for fancyBox
 * Put an invisible div in front of your image to make it slightly more difficult to download.
 * version: 1.0.0
 * @requires fancyBox v2.0 or later
 *
 * Usage:
 *     $(".fancybox").fancybox({
 *         helpers : { 
 *             hideimg: {}
 *         }
 *     });
 *
 * Options:
 *     tpl - HTML template
 *
 */
(function ($) {

    // Add hideimg helper object
    $.fancybox.helpers.hideimg = {
        tpl : '<div class="fancybox-item fancybox-hideimg"></div>',

        afterShow: function(opts, obj){
            // variables
            $.fancybox.image = $.fancybox.inner.find('.fancybox-image');
            
            // create invisible div that stays on top of the image
            $(opts.tpl || this.tpl).appendTo($.fancybox.inner)
                .css({position: 'absolute', width: '100%', height: '100%', top: 0, left: 0})
                
                // forward mouse events to the image
                .bind('mousemove mousedown mouseup', function(e){
                    e.target = $.fancybox.image[0];
                    $.fancybox.image.trigger(e);
                    
                    // also copy relevant CSS rules
                    $(this).css({ cursor: $.fancybox.image.css('cursor') });
                });
            
        }
    };

}(jQuery));
