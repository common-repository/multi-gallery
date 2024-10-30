
jQuery(document).ready(function(){
    jQuery(".showTabs").on('click',function(){
        var id = jQuery(this).data('id');
        jQuery(".tabs").attr('style','display:none');
        jQuery("#"+id).attr('style','display:block');
    });
});

(function( $ ) {

    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.colorp').wpColorPicker();
    });
    /*
    * set description default words in textbox on click default button
    * */
    $(".default_desc_words").on('click',function(){
       var words = $(this).data('words');
        $("#description_words").val(words);
    });

})( jQuery );

var media_uploader = null;

function openMediaUploaderImage()
{
    media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: true
    });
    var imageSection = jQuery("#imageSection");
    var imgSaveDiv = jQuery("#imgSaveDiv");
    media_uploader.on("insert", function(){
        var selection = media_uploader.state().get("selection");
        selection.map( function( attachment ) {
        jQuery.post(ajaxurl, {ImageData:attachment.id,action:'WD_gallery_thumbnails'}, function(response) {
            imageSection.append(response);
        });
        });
    });
    media_uploader.on('select', function() {
        media_uploader.Jcrop();
    });
    media_uploader.open();

    media_uploader.open();
}
jQuery(document).find("#add_media").on('click',openMediaUploaderImage);

jQuery(document).on('click','.trash',function(){
   var $this = jQuery(this);
    $this.parent('.img-wrapper').fadeOut(500,function(){
        jQuery(this).remove();
    });
});

jQuery(function() {
    jQuery( "#imageSection" ).sortable({
        opacity: 0.6,
        revert: true,
        cursor: 'move'
    });
});

jQuery(document).on("click","input[name=gallery_type]",function(){

    var gal_effects = jQuery(".gal_effects");
    var gal_transparent = jQuery(".gal_transparent");
    var  bg_color = jQuery(".bg_color_tr");
    var  img_border_col = jQuery(".img_border_col");
    var value = jQuery(this).val();
    if(value=='shadow'){
        bg_color.hide();
    }else{
        bg_color.show();
    }

    if(value=='masonry'){
        img_border_col.show();
    }else{
        img_border_col.hide();
    }

    if(value=='transparent_image'){
        gal_effects.hide();
        gal_transparent.show();
    }else{
        gal_transparent.hide();
    }


});