<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="row">
    <div class="col-md-12 border">
        <button type="button" id="add_media" class="btn btn-primary pull-right"><?php _e('Add Media','multi_gallery');?></button>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <ul id="imageSection">
            <?php
            require_once(WD_GAL_PATH.'partials/ajaxGallery.php');
            if(isset($curr_val['WDImage'])){
            foreach($curr_val['WDImage'] as $key=>$value){//echo '<pre>';print_r($value);die;
                $id = $key;
                getImageText::getText($id,$value,$curr_val['WDImage_500'][$id],$curr_val['WDImage_300'][$id],$curr_val['WDtitle'][$id],$curr_val['WDdescription'][$id]);

            }}?>
        </ul>

    </div>
</div>