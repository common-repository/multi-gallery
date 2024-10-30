<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if($data['active_title']=='on'){ ?>
    <div style="width:100%;">
        <div style="text-align: <?php echo $data['title_alignment']; ?>"><h2 style="color: <?php echo $data['title_color']; ?>;font-size: <?php echo $data['title_font_size'].'px'; ?>;font-family: <?php echo $data['title_font_family']; ?>;margin: 10px 0;"><?php echo _e($data['title'],'multi_gallery'); ?></h2></div>
    </div>
<?php } ?>

    <section class="wrapper cl wd-clearfix" style="background: <?php echo $data['container_bg_color'];?>;padding: 10px;">
        <?php
        $GLOBALS['hover_color'] = $data['incontent_hover_color'];
        $GLOBALS['incontent_effects'] = $data['incontent_effects'];
        $GLOBALS['active_lightbox'] = $data['active_lightbox'];
        $width='33.33';
        $gallery_column = $data['gallery_column'];
        if($gallery_column=='gallery2c'){$width=50;}
        if($gallery_column=='gallery3c'){$width=33.33;}
        if($gallery_column=='gallery4c'){$width=25;}
        if($gallery_column=='gallery5c'){$width=20;}
        if($gallery_column=='gallery6c'){$width=16.66;}

        $GLOBALS['gallery_width'] = $width;

        array_map(function($ele,$title,$description,$original_img)
        {
            $active_lightbox = $GLOBALS['active_lightbox'];
            $hover_color = $GLOBALS['hover_color'];
            $incontent_effects = $GLOBALS['incontent_effects'];
            ?><div class="c-width">
                <div class="pic">
                    <img src="<?php echo $ele;?>" class="pic-image wd-img" alt="Pic"/>
                    <?php if($active_lightbox){ ?>
                        <a href="<?php echo $original_img;?>"  rel="fancybox-thumb"  data-lightbox-gallery="gallery1" data-rel="prettyPhoto[pp_gal]" class="light_set  wd_light<?php echo $GLOBALS['post_id'];?>" title="<?php echo _e($title,'gallery');?>">
                    <?php } ?>
                        <span class="pic-caption <?php echo $incontent_effects;?>" style="background: <?php echo WD_Gallery_ShortCode::convertHex($hover_color,60);?>">
                            <h1 class="pic-title wd-gal-label"><?php echo _e($title,'multi_gallery');?></h1>
                            <p class="wd-gal-desc"><?php echo _e($description,'multi_gallery');?></p>
                    </span>
                    <?php if($active_lightbox){ echo '</a>';} ?>
                </div>
            </div>
            <?php
            return true;

        },$data['WDImage_500'],$data['WDtitle'],$data['WDdescription'],$data['WDImage']);
        ?>
    </section>