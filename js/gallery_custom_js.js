

(function($){

    function addLightBoxWD(wd_lightbox){

        var is_active = $(wd_lightbox).data('is_active');
        if(is_active!=1){
            return true;
        }
        var lightbox = $(wd_lightbox).data('gallery_type');
        var post_id = $(wd_lightbox).data('post_id');

        var lightbox_obj = $(wd_lightbox).find("a.wd_light"+post_id);
        if(lightbox=='swipe_box'){

            lightbox_obj.swipebox({
                hideBarsDelay:0,
                hideCloseButtonOnMobile : false
            });

        }else if(lightbox=='nivo_box'){
            lightbox_obj.nivoLightbox({ effect: 'slide' });

        }else if(lightbox=='pretty_photo'){

            lightbox_obj.prettyPhoto({
                animation_speed: 'fast', /* fast/slow/normal */
                slideshow: 2000, /* false OR interval time in ms */
                autoplay_slideshow: false, /* true/false */
                opacity: 0.80  /* Value between 0 and 1 */
            });

        }else if(lightbox=='fancy_box'){
            lightbox_obj.fancybox({
                openEffect  : 'none',
                closeEffect : 'none',
                helpers : {
                    media : {}
                }
            });
        }
    }
    $(document).ready(function(){
        $(".wdMainContainer").each(function(i,ele){
            addLightBoxWD(ele);
        });
    })

})(jQuery);

function changeActualSize(){
    var wd_img = jQuery("img.wd-img");
    jQuery.each(wd_img,function(i,ele){
        var image = jQuery(ele);
        var img_height = image.height();
        var img_width = image.width();
        var wd_media_pic = image.parent('.wd-media,.gallery-image,.pic,.item');

        if(jQuery("#my-gallery-container").length){
//            img_height = img_height+15;
            img_width = img_width+15;
        }

        wd_media_pic.prop("style","max-height:"+img_height+"px;max-width:"+img_width+"px");
    });
}

jQuery(window).load(function () {
    changeActualSize();
    jQuery(".wd-img").attr("style","visibility:visible")
});

