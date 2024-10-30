<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<!-- Style used for dynamically change CSS of Gallery-->
<style>
    .wd-gal-label{
        display: <?php if(!isset($data['active_label'])|| $data['active_label']!='on'){echo 'none !important';}?>;
        color: <?php echo $data['label_color'];?> !important;
        font-size: <?php echo $data['label_font_size'];?>px !important;
        font-family: <?php echo $data['label_font_family'];?> !important;
        text-align: <?php echo $data['label_alignment'];?> !important;
    }
    .wd-gal-desc{
        display: <?php if(!isset($data['active_description'])||$data['active_description']!='on'){echo 'none !important';}?>;
        color: <?php echo $data['description_color'];?> !important;
        font-size: <?php echo $data['description_font_size'];?>px !important;
        font-family: <?php echo $data['description_font_family'];?> !important;
        text-align: <?php echo $data['label_alignment'];?> !important;
    }
    .c-width{
        width: <?php echo $GLOBALS['gallery_width'];?>%;
        float: left;
    }

    <?php echo $data['custom_css']; ?>
</style>