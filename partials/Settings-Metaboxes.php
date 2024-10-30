<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>


<div class="row">

        <div class="panel-body">
            <h4>
                <?php _e('Select a Gallery','multi_gallery');?>
            </h4>
            <div class="form-group sel_gal_type">
                <?php
                $gal_type = isset($curr_val['gallery_type'])?$curr_val['gallery_type']:'incontent';
                ?>
                <div class="side-corner-tag ribben-free">
                    <input type="radio" name="gallery_type" value="incontent" id="incontent" checked<?php //if($gal_type=='incontent'){echo 'checked';} ?>>
                    <label for="incontent" class="gal">
                        <img src="<?php echo WD_GALLERY_PATH.'img/incontent.png';?>">
                        <h5 class="gal-name">Incontent</h5>
                    </label>
                    <p><span>Free</span></p>
                </div>




                <div class="side-corner-tag">
                    <input type="radio" disabled="disabled">
                    <label for="shadow" class="gal">
                        <img src="<?php echo WD_GALLERY_PATH.'img/shadow.png';?>">
                        <h5 class="gal-name">Shadow</h5>
                    </label>
                    <p><span>PRO</span></p>
                </div>

                <div class="side-corner-tag">
                    <input type="radio" disabled="disabled">
                    <label for="transparent_image" class="gal">
                        <img src="<?php echo WD_GALLERY_PATH.'img/transparent.png';?>" >
                        <h5 class="gal-name">Transparent</h5>
                    </label>
                    <p><span>PRO</span></p>
                </div>

            </div>
        </div>
</div>


<div class="row">
<div class="gal-settings-panel">

    <div class="panel-body">
        <div class="col-md-3">
            <div class="panel-body">
                <div class="form-group"><a href="javascript:void(0)" class="btn btn-primary showTabs" data-id="generalSettings"><?php _e('General Settings','multi_gallery');?></a></div>

                <div class="form-group"><a href="javascript:void(0)" class="btn btn-primary showTabs" data-id="gallerySettings"><?php _e('Gallery Settings','multi_gallery');?></a></div>

                <div class="form-group"><a href="javascript:void(0)" class="btn btn-primary showTabs" data-id="labelSettings"><?php _e('Label Settings','multi_gallery');?></a></div>

                <div class="form-group"><a href="javascript:void(0)" class="btn btn-primary showTabs" data-id="descriptionSettings"><?php _e('Description Settings','multi_gallery');?></a></div>

                <div class="form-group"><a href="javascript:void(0)" class="btn btn-primary showTabs" data-id="customcssSettings"><?php _e('Custom CSS','multi_gallery');?></a></div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel-body">
                    <div id="generalSettings" class="tabs" >
                        <h1><?php _e('General Settings Sections','multi_gallery');?></h1>
                        <?php
                        $title_settings = array('active_title','title_alignment','title_color','title_font_size','title_font_family','gallery_column','container_bg_color');
                        foreach($title_settings as $setting){
                            $curr_val[$setting] = isset($curr_val[$setting])?$curr_val[$setting]:'';
                        }
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php _e('Show Title','multi_gallery');?></th>
                                    <th><input type="checkbox" class="" id="active_title" name="active_title" <?php if($curr_val['active_title']=='on'){echo 'checked';} ?>></th>
                                </tr>
                                <tr>
                                    <th><?php _e('Title Alignment','multi_gallery');?></th>
                                    <th>
                                        <input type="radio" class="" id="title_alignment" name="title_alignment" value="left" <?php if($curr_val['title_alignment']=='left'){echo 'checked';} ?>> <?php _e('Left','multi_gallery');?> &nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type="radio" class="" id="title_alignment" name="title_alignment" value="center" <?php if($curr_val['title_alignment']=='center'){echo 'checked';} ?>> <?php _e('Center','multi_gallery');?>     &nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type="radio" class="" id="title_alignment" name="title_alignment" value="right" <?php if($curr_val['title_alignment']=='right'){echo 'checked';} ?>> <?php _e('Right','multi_gallery');?>&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php _e('Title Color','multi_gallery');?></th>
                                    <th>
                                        <?php
                                        $color1 = '#fff';
                                        $color2 = '#000';
                                        $color3 = '#4285f4';
                                        ?>
                                        <input type="radio" id="title_color1" name="title_color" value="<?php echo $color1;?>"
                                            <?php if($curr_val['title_color']==$color1){echo 'checked';}; ?>>
                                        <span class="color-radio" style="background:<?php echo $color1;?>;">White</span>

                                        <input type="radio" id="title_color2" name="title_color" value="<?php echo $color2;?>"
                                            <?php if($curr_val['title_color']==$color2){echo 'checked';}; ?>>
                                        <span class="color-radio" style="background:<?php echo $color2;?>;"></span>

                                        <input type="radio" id="title_color3" name="title_color" value="<?php echo $color3;?>"
                                            <?php if($curr_val['title_color']==$color3){echo 'checked';}; ?>>
                                        <span class="color-radio" style="background:<?php echo $color3;?>;"></span>
                                    </th>
                                </tr>

                                <tr>
                                    <th><?php _e('Title Font Size','multi_gallery');?></th>
                                    <th><input type="number" class="form-control" id="title_font_size" name="title_font_size" value="<?php echo $curr_val['title_font_size']; ?>"></th>
                                </tr>

                                <tr>
                                    <th><?php _e('Title Font Family','multi_gallery');?></th>
                                    <th>
                                        <select id="title_font_family" name="title_font_family" class="form-control">
                                            <?php $all_family = WDSettings::getAllFonts(); ?>
                                            <optgroup label="select">
                                                <?php
                                                foreach($all_family as $value): ?>
                                                    <option value="<?php echo $value;?>" <?php if($curr_val['title_font_family']==$value): echo 'selected';endif; ?>><?php _e(ucfirst(trim(str_replace('_',' ',$value))),'multi_gallery');?></option>
                                                <?php endforeach;?>
                                            </optgroup>
                                        </select>
                                    </th>
                                </tr>

                                <tr>
                                    <th><?php _e('Select Column','multi_gallery');?></th>
                                    <th><select class="form-control" id="gallery_column" name="gallery_column">
                                            <option value="gallery2c" <?php if($curr_val['gallery_column']=='gallery2c'){echo'selected';}?>><?php _e('Two Column','multi_gallery');?></option>
                                            <option value="gallery3c" <?php if($curr_val['gallery_column']=='gallery3c'){echo'selected';}?>><?php _e('Three Column','multi_gallery');?></option>
                                            <option value="gallery4c" <?php if($curr_val['gallery_column']=='gallery4c'){echo'selected';}?>><?php _e('Four Column','multi_gallery');?></option>
                                            <option disabled="disabled"><?php _e('Five Column (Available in Pro)','multi_gallery');?></option>
                                            <option disabled="disabled"><?php _e('Six Column (Available in Pro)','multi_gallery');?></option>
                                        </select>
                                    </th>
                                </tr>


                                <tr class="bg_color_tr" style="display: <?php if($gal_type=='shadow'){ echo 'none'; }?>">
                                    <th><?php _e('Select Container Background Color','gallery');?></th>
                                    <th>

                                        <?php
                                        $color1 = '#fff';
                                        $color2 = '#A3E4D7';
                                        $color3 = '#D0D3D4';
                                        ?>

                                        <input type="radio" id="container_bg_color" name="container_bg_color" value="<?php echo $color1;?>"
                                            <?php if($curr_val['container_bg_color']==$color1){echo 'checked';}; ?>>
                                        <span class="color-radio" style="background:<?php echo $color1;?>;">White</span>

                                        <input type="radio" id="container_bg_color2" name="container_bg_color" value="<?php echo $color2;?>"
                                            <?php if($curr_val['container_bg_color']==$color2){echo 'checked';}; ?>>
                                        <span class="color-radio" style="background:<?php echo $color2;?>;"></span>

                                        <input type="radio" id="container_bg_color3" name="container_bg_color" value="<?php echo $color3;?>"
                                            <?php if($curr_val['container_bg_color']==$color3){echo 'checked';}; ?>>
                                        <span class="color-radio" style="background:<?php echo $color3;?>;"></span>


                                    </th>
                                </tr>

                            </thead>
                        </table>
                    </div>

                    <!--Gallery Settings -->
                    <div id="gallerySettings" class="tabs" >
                        <h1><?php _e('Gallery Settings Sections','multi_gallery');?></h1>
                        <?php
                        $title_settings = array('gallery_type','incontent_effects','incontent_hover_color','active_lightbox','add_lightbox');
                        foreach($title_settings as $setting){
                            $curr_val[$setting] = isset($curr_val[$setting])?$curr_val[$setting]:'';
                        }
                        ?>
                        <table class="table">
                            <thead>
                            <!-- In Content Gallery Settings Start -->

                            <?php
                            $color1 = '#394a5a';
                            $color2 = '#81bfc7';
                            $color3 = '#8a3da0';
                            ?>

                            <tr class="gal_incontent">
                                <th><?php _e('Select Image Hover Color','multi_gallery');?></th>
                                <th>
                                    <input type="radio" class="" id="incontent_hover_color1" name="incontent_hover_color" value="<?php echo $color1; ?>"
                                        <?php if($curr_val['incontent_hover_color']==$color1){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color1;?>;"></span>

                                    <input type="radio" class="" id="incontent_hover_color2" name="incontent_hover_color" value="<?php echo $color2; ?>"
                                        <?php if($curr_val['incontent_hover_color']==$color2){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color2;?>;"></span>


                                    <input type="radio" class="" id="incontent_hover_color3" name="incontent_hover_color" value="<?php echo $color3; ?>"
                                        <?php if($curr_val['incontent_hover_color']==$color3){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color3;?>;"></span>

                                </th>
                            </tr>

                            <tr class="gal_incontent gal_effects" style="display: <?php if($gal_type=='transparent_image'){ echo 'none'; }?>">
                                <th><?php _e('Select Gallery Effects','multi_gallery');?></th>
                                <th>
                                    <select class="form-control" id="incontent_effects" name="incontent_effects">
                                        <?php
                                        $effects = array(
                                            'bottom-to-top'=>'Bottom to Top',
                                            'top-to-bottom'=>'Top to Bottom',
                                            '1'=>'Left to Right (Available in Pro)',
                                            '2'=>'Right to Left (Available in Pro)',
                                            '3'=>'Rotate In (Available in Pro)',
                                            '4'=>'Rotate Out (Available in Pro)',
                                            '5'=>'Open Up (Available in Pro)',
                                            '6'=>'Open Down (Available in Pro)',
                                            '7'=>'Open Left (Available in Pro)',
                                            '8'=>'Open Right (Available in Pro)',
                                            '9'=>'Come Left (Available in Pro)',
                                            '10'=>'Come Right (Available in Pro)');
                                        foreach($effects as $key=>$value){
                                        ?>
                                        <option value="<?php echo $key;?>"
                                            <?php if($curr_val['incontent_effects']==$key){echo 'selected';} ?>
                                            <?php if($key!="bottom-to-top" && $key!="top-to-bottom"){echo 'disabled';} ?>
                                            ><?php _e($value,'gallery');?></option>
                                        <?php } ?>
                                    </select>
                                </th>
                            </tr>

                            <tr>
                                <th><?php _e('Show LightBox in Gallery','multi_gallery');?></th>
                                <th>
                                    <input type="checkbox" id="active_lightbox" name="active_lightbox" value="1" <?php if($curr_val['active_lightbox']==1){echo'checked';} ?>>
                                </th>
                            </tr>

                            <tr>
                                <th><?php _e('Select Gallery LightBox','multi_gallery');?></th>
                                <th>
                                    <select class="form-control" id="add_lightbox" name="add_lightbox">
                                        <?php
                                        $lightBox = array('swipe_box'=>'Swipe Box','nivo_box'=>'Nivo Box (Available in Pro)','pretty_photo'=>'Pretty Photo (Available in Pro)','fancy_box'=>'Fancy Box (Available in Pro)');
                                        foreach($lightBox as $key=>$value){
                                            ?>
                                            <option value="<?php echo $key;?>" <?php if('swipe_box'==$key){echo 'selected';}else{echo 'disabled';} ?>><?php _e($value,'multi_gallery');?></option>
                                        <?php } ?>
                                    </select>
                                </th>
                            </tr>

                            <!-- Incontent Gallery Settings End -->
                            </thead>
                        </table>
                    </div>



                    <div id="labelSettings" class="tabs">
                        <h1><?php _e('Label Settings Sections','multi_gallery');?></h1>
                        <?php
                        $label_settings = array('active_label','label_alignment','label_color','label_bg_color','label_font_size','label_font_family');
                        foreach($label_settings as $setting){
                            $curr_val[$setting] = isset($curr_val[$setting])?$curr_val[$setting]:'';
                        }
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php _e('Show Label','gallery');?></th>
                                <th><input type="checkbox" class="" id="active_label" name="active_label" <?php if($curr_val['active_label']=='on'){echo 'checked';} ?>></th>
                            </tr>
                            <tr>
                                <th><?php _e('Label Alignment','multi_gallery');?></th>
                                <th>
                                    <input type="radio" class="" id="label_alignment" name="label_alignment" value="left" <?php if($curr_val['label_alignment']=='left'){echo 'checked';} ?>> <?php _e('Left','multi_gallery');?> &nbsp&nbsp&nbsp&nbsp&nbsp
                                    <input type="radio" class="" id="label_alignment" name="label_alignment" value="center" <?php if($curr_val['label_alignment']=='center'){echo 'checked';} ?>> <?php _e('Center','multi_gallery');?>&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <input type="radio" class="" id="label_alignment" name="label_alignment" value="right" <?php if($curr_val['label_alignment']=='right'){echo 'checked';} ?>> <?php _e('Right','multi_gallery');?>&nbsp&nbsp&nbsp&nbsp&nbsp
                                </th>
                            </tr>
                            <tr>

                                <?php
                                $color1 = '#fff';
                                $color2 = '#000';
                                $color3 = '#4285f4';
                                ?>

                                <th><?php _e('Label Color','multi_gallery');?></th>
                                <th>
                                    <input type="radio" class="" id="label_color1" name="label_color" value="<?php echo $color1; ?>"
                                    <?php if($curr_val['label_color']==$color1){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color1;?>;">White</span>

                                    <input type="radio" class="" id="label_color2" name="label_color" value="<?php echo $color2; ?>"
                                        <?php if($curr_val['label_color']==$color2){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color2;?>;"></span>

                                    <input type="radio" class="" id="label_color3" name="label_color" value="<?php echo $color3; ?>"
                                        <?php if($curr_val['label_color']==$color3){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color3;?>;"></span>

                                </th>

                            </tr>

                            <tr>
                                <th><?php _e('Font Size','multi_gallery');?></th>
                                <th><input type="number" class="form-control" id="label_font_size" name="label_font_size" value="<?php echo $curr_val['label_font_size']; ?>"></th>
                            </tr>

                            <tr>
                                <th><?php _e('Font Family','multi_gallery');?></th>
                                <th>
                                    <select id="label_font_family" name="label_font_family" class="form-control">
                                        <?php $all_family = WDSettings::getAllFonts(); ?>
                                        <optgroup label="select">
                                            <?php
                                            foreach($all_family as $value): ?>
                                                <option value="<?php echo $value;?>" <?php if($curr_val['label_font_family']==$value): echo 'selected';endif; ?>><?php _e(ucfirst(trim(str_replace('_',' ',$value))),'multi_gallery');?></option>
                                            <?php endforeach;?>
                                        </optgroup>
                                    </select>
                                </th>
                            </tr>

                            </thead>
                        </table>
                    </div>

                    <!--Description settings-->
                    <div id="descriptionSettings" class="tabs">
                        <h1><?php _e('Description Settings Sections','multi_gallery');?></h1>
                        <?php
                        $description_settings = array('active_description','description_color','description_bg_color','description_font_size','description_font_family');
                        foreach($description_settings as $setting){
                            $curr_val[$setting] = isset($curr_val[$setting])?$curr_val[$setting]:'';
                        }
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php _e('Show Description','multi_gallery');?></th>
                                <th><input type="checkbox" class="" id="active_description" name="active_description" <?php if($curr_val['active_description']=='on'){echo 'checked';} ?>></th>
                            </tr>
                            <tr>
                                <th><?php _e('Description Color','multi_gallery');?></th>
                                <th>

                                    <?php
                                    $color1 = '#fff';
                                    $color2 = '#000';
                                    $color3 = '#4285f4';
                                    ?>
                                    <input type="radio" class="" id="description_color1" name="description_color" value="<?php echo $color1; ?>"
                                    <?php if($curr_val['description_color']==$color1){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color1;?>;">White</span>

                                    <input type="radio" class="" id="description_color2" name="description_color" value="<?php echo $color2; ?>"
                                    <?php if($curr_val['description_color']==$color2){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color2;?>;"></span>

                                    <input type="radio" class="" id="description_color3" name="description_color" value="<?php echo $color3; ?>"
                                    <?php if($curr_val['description_color']==$color3){echo 'checked';}; ?>>
                                    <span class="color-radio" style="background:<?php echo $color3;?>;"></span>

                                </th>
                            </tr>

                            <tr>
                                <th><?php _e('Font Size','multi_gallery');?></th>
                                <th><input type="number" class="form-control" id="description_font_size" name="description_font_size" value="<?php echo $curr_val['description_font_size']; ?>"></th>
                            </tr>

                            <tr>
                                <th><?php _e('Font Family','multi_gallery');?></th>
                                <th>
                                    <select id="label_font_family" name="description_font_family" class="form-control">
                                        <?php $all_family = WDSettings::getAllFonts(); ?>
                                        <optgroup label="select">
                                            <?php
                                            foreach($all_family as $value): ?>
                                                <option value="<?php echo $value;?>" <?php if($curr_val['description_font_family']==$value): echo 'selected';endif; ?>><?php _e(ucfirst(trim(str_replace('_',' ',$value))),'multi_gallery');?></option>
                                            <?php endforeach;?>
                                        </optgroup>
                                    </select>
                                </th>
                            </tr>

                            </thead>
                        </table>
                    </div>

                    <!-- Custom CSS Panel-->

                    <div id="customcssSettings" class="tabs">
                        <h1><?php _e('Custom CSS Sections','multi_gallery');?></h1>
                        <?php
                            $curr_val['custom_css'] = isset($curr_val['custom_css'])?$curr_val['custom_css']:'';
                        ?>
                        <div class="form-info">
                            <label><?php _e('Enter Custom CSS','multi_gallery');?></label>

                                <textarea class="form-control" id="custom_css" name="custom_css" rows="10" cols="20">
                                    <?php echo isset($curr_val['custom_css'])?$curr_val['custom_css']:''; ?>
                                </textarea>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Used for gallery path in js-->
<script>
    var WD_GALLERY_PATH = '<?php echo WD_GALLERY_PATH;?>';
</script>