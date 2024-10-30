<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class getImageText
{
    public static function getText($id,$original_img,$img_500,$img_300,$title,$description)
    {

?>
<li class="img-wrapper">
    <div class="trash" style="float: right;">
        <img src="<?php echo WD_GALLERY_PATH.'img/cross.png';?>">
    </div>
    <div style="width:100%;height:300px;">
        <div class="img-div">
            <img height="200" width="200" src="<?php echo $img_300;?>">
        </div>
        <div class="img-settings" style="float: left;background: #ffffff;width: 100%;">
            <div class="form-group">
                <label><?php _e('Enter Title','multi_gallery');?></label>
                <input type="text" name="title[<?php echo $id;?>]" class="form-control" value="<?php echo isset($title)?$title:''?>">
            </div>
            <div class="form-group">
                <label><?php _e('Enter Short Description','multi_gallery')?></label>
                <textarea class="form-control" name="description[<?php echo $id;?>]"><?php echo isset($description)?$description:''?></textarea>
                <input type="hidden" name="WDImage[<?php echo $id;?>]" value="<?php echo $original_img?>">
                <input type="hidden" name="WDImage_300[<?php echo $id;?>]" value="<?php echo $img_300?>">
                <input type="hidden" name="WDImage_500[<?php echo $id;?>]" value="<?php echo $img_500?>">
            </div>
        </div>
    </div>
</li>
<?php
    }
}
?>