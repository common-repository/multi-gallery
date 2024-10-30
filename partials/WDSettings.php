<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WDSettings
{
	public function __construct()
	{
        add_action( 'init', array(&$this,'WDCreatePostCustom') );
        add_action( 'add_meta_boxes', array(&$this,'WDMetaBoxRegister') );
        add_action( 'save_post', array(&$this,'WDMetaBoxSave') );
        add_action( 'wp_ajax_WD_gallery_thumbnails', array(&$this,'WDGalleryGetThumbnailsData') );
        add_action('media_buttons_context', array(&$this,'WD_gallery_create_button'),17);
        add_action('admin_footer', array(&$this,'WD_gallery_generate_popup'));
        add_action('in_admin_header',array(&$this,'WDShowAdminHeaderInfo'));
	}

	public function WDCreatePostCustom() {
	  register_post_type( 'wd_gallery',
		array(
		  'labels' => array(
			'name' => __( 'Multi Gallery'),
			'singular_name' => __( 'Multi Gallery'),
			'all_items'           => __( 'All Galleries', 'gallery_wd' ),
			'view_item'           => __( 'View Galleries', 'gallery_wd' ),
			'add_new_item'        => __( 'Add New Gallery', 'gallery_wd' ),
			'add_new'             => __( 'Add New Gallery', 'gallery_wd' ),
			'edit_item'           => __( 'Edit Gallery','gallery_wd'),
			),
		  'public' => true,
		  'has_archive' => true,
		  'supports'=>array('title'),
        'menu_icon' =>WD_GALLERY_PATH.'img/wd-gallery.png',
		)
	  );
	}

	/**
	 * Register meta box(es).
	 */
	function WDMetaBoxRegister() {
		add_meta_box( 'wd_gallery_mb', __( 'Galleries ', 'gallery_wd' ), array(&$this,'WDMetaBoxRegisterCallBack'), 'wd_gallery' );
        add_meta_box( 'wd_gallery_mb_settings', __( 'Gallery Settings', 'gallery_wd' ), array(&$this,'WDMetaBoxSettingsCallBack'), 'wd_gallery' );

        add_meta_box('wd_shortcode_meta_box', 'WD Gallery insert in any post/page',array(&$this, 'WDShortcodeMetaBoxCallback'),'wd_gallery','side','low');
        add_meta_box('rate_us_meta_box', ' We need your reviews in order to improve our services',array(&$this, 'WD_rate_us_meta_box'),
            'wd_gallery','side','low');
	}

    public function WD_rate_us_meta_box(){
        ?>
        <img src="<?php echo WD_GALLERY_PATH; ?>img/rate-us.png">
        <div class="wd-gallery-rate-us-div">
            <?php printf( __('<a href="%s" class="wd-gallery-rate-us-button button button-primary button-large" target="_blank">RATE US</a>',
                'gallery'),'http://wordpress.org/plugins/multi-gallery'); ?>
        </div>
    <?php
    }
	 
	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function WDMetaBoxRegisterCallBack( $post ) {
        // Display code/markup goes here. Don't forget to include nonces!
        $curr_val = unserialize(get_post_meta($post->ID,'wd_gallery_'.$post->ID,true));

        if(!isset($curr_val['gallery_type'])){
            $curr_val = unserialize(get_option("WD_Default_Settings"));
        }
		include('Metaboxes.php');
	}

    function WDMetaBoxSettingsCallBack($post)
    {
        // Display code/markup goes here. Don't forget to include nonces!
        $curr_val = unserialize(get_post_meta($post->ID,'wd_gallery_'.$post->ID,true));

        if(!isset($curr_val['gallery_type'])){
            $curr_val = unserialize(get_option("WD_Default_Settings"));
        }
        include('Settings-Metaboxes.php');
    }

    function WDShortcodeMetaBoxCallback()
    {
        echo '<input type="text" style="background: #f1f1f1; color:#000;" onclick="jQuery(this).select()" value="[WD_GALLERY id='.get_the_ID().']" readonly/>';
    }
	 
	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID
	 */
	function WDMetaBoxSave( $post_id ) {
		// Save logic goes here. Don't forget to include nonce checks!
        global $post;
        $fields = array('active_title','title_alignment','title_color','title_font_size','title_font_family',
            'container_bg_color','active_label','label_alignment','label_color','label_bg_color','label_font_size',
            'label_font_family','gallery_type', 'active_description','description_color','description_bg_color',
            'description_font_size','description_font_family','incontent_hover_color','incontent_effects',
            'gallery_column','custom_css','active_lightbox','add_lightbox'
        );
        // Get our form field
        if( $_POST ) :
            foreach($fields as $field){
                if(isset($_POST[$field])){
                    $data[$field]  = esc_attr( $_POST[$field] );
                }
                else{
                    $data[$field]  = '';
                }
            }
            $all_content = array('WDImage'=>'WDImage','WDImage_300'=>'WDImage_300','WDImage_500'=>'WDImage_500','title'=>'WDtitle','description'=>'WDdescription');
            foreach($all_content as $field=>$name){
                if(isset($_POST[$field])){
                    foreach($_POST[$field] as $key=>$value){
                        $data[$name][$key]  = esc_attr( $value );
                    }
                }
            }

            // Update post meta
            update_post_meta($post_id, 'wd_gallery_'.$post_id, serialize($data));
        endif;
	}

    public static function getAllFonts()
    {
        $font_deault=array('Arial','_arial_black','Courier New','georgia','grande','_helvetica_neue','_impact','_lucida','_OpenSansBold','_palatino','_sans','Sans-Serif','_tahoma','_times','_trebuchet','_verdana');
        return $font_deault;
    }

    public function WDGalleryGetThumbnailsData()
    {
        $post = $_POST['ImageData'];
        $wd_img_url=wp_get_attachment_image_src($post,'WD_original_image',true);
        $wd_img_300=wp_get_attachment_image_src($post,'wd_gallery_img_300',true);
        $wd_img_500=wp_get_attachment_image_src($post,'wd_gallery_img_500',true);
        $data['id'] = $post;
        $data['original_img'] =$wd_img_url[0];
        $data['img_500'] =$wd_img_500[0];
        $data['img_300'] =$wd_img_300[0];
        $data['title'] = $data['description'] = '';
        require_once(WD_GAL_PATH.'partials/ajaxGallery.php');
        getImageText::getText($post,$wd_img_url[0],$wd_img_500[0],$wd_img_300[0],'','');
        wp_die();
    }

    public static function WD_default_settings()
    {
        $setting_array=serialize(array(
            'active_title'=>'on',
            'title_alignment'=>'center',
            'title_color'=>'#fff',
            'title_font_size'=>'25',
            'title_font_family'=>'_arial_black',
            'container_bg_color'=>'#3c4d5d',
            'active_label'=>'on',
            'label_alignment'=>'center',
            'label_color'=>'#fff',
            'label_font_size'=>'25',
            'label_font_family'=>'_arial_black',

            'gallery_type'=>'incontent',
            'active_description'=>'on',
            'description_color'=>'#fff',
            'description_font_size'=>'14',
            'description_font_family'=>'_arial_black',
            'incontent_hover_color'=>'#536775',
            'incontent_effects'=>'open-up',
            'gallery_column'=>'gallery3c',
            'custom_css'=>'',
            'active_lightbox' =>'1',
            'add_lightbox'=>'fancy_box'
        ));
        add_option("WD_Default_Settings",$setting_array);
    }


    public static function WD_deactivation_settings()
    {
        delete_option('WD_Default_Settings');
    }

    public function WD_gallery_create_button($context){
        $context .= '<a class="button thickbox"  title="'."Select a Gallery to insert into post".'"
	href="#TB_inline?width=400&inlineId=WD_gal_popup" style="    background: #337ac6;
    border: 1px #337ac6;
    border-radius: 0;
    color: #fff;">
	<span class="wp-media-buttons-icon" style="background: url('.WD_GALLERY_PATH.'img/wd-gallery.png);
	 background-repeat: no-repeat; background-position: left bottom;">
	 </span>
	Gallery Shortcode</a>';
        return $context;
    }

public function WD_gallery_generate_popup(){
    ?>
    <div id="WD_gal_popup" style="display:none;">
        <h2 align="center">Gallery Shortcode</h2>
        <?php
        $All_posts_count = wp_count_posts('wd_gallery')->publish;
        $WD_q= array('post_type'=>'wd_gallery','posts_per_page'=>$All_posts_count);
        $WD_gal_short=new wp_Query($WD_q);
        if($WD_gal_short->have_posts()){?>

            <label><?php _e('Gallery Title :','multi_gallery'); ?></label><br>
            <select id="WD_sel_a_gel" style="margin:15px 0;">
                <?php
                while($WD_gal_short->have_posts()):$WD_gal_short->the_post();
                    ?>
                    <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
                <?php
                endwhile;
                ?>
            </select><br>
            <button class="button-primary WD_gal_insert_sort"><?php _e('Insert Shortcode','multi_gallery'); ?></button>
        <?php }else{
            ?>
            <h2 align="center"><?php printf(__('<a href="%s" style="color:orange;" title="Create new Gallery">Before Create Gallery</a>','multi_gallery'),admin_url('post-new.php?post_type=wd_gallery')); ?></h2>
        <?php
        }
        ?>
    </div>
    <script type="text/javascript">
        jQuery(function(){
            jQuery(".WD_gal_insert_sort").click(function(){
                var WD_selected_gal = jQuery("#WD_sel_a_gel option:selected").val();
                window.send_to_editor('<p>[WD_GALLERY id='+WD_selected_gal+']</p>');
                tb_remove();
            });
        });
    </script>
<?php
}


    public function WDShowAdminHeaderInfo()
    {
        if(get_post_type()=='wd_gallery'){
            ?>
            <div class="wd-header" style="width:100%;height:180px;background: url('<?php echo WD_GALLERY_PATH;?>img/admin_header.jpg') 50% 0 repeat fixed;">

                <div class="admin-header">
                    <div class="header-cont">

                        <div style="padding-bottom: 15px;">
                            <a class="wd-rate-us" href="<?php echo esc_url('http://wordpress.org/plugins/multi-gallery');?>" target="_blank">
                                <span class="dashicons dashicons-star-filled"></span>
                                <span class="dashicons dashicons-star-filled"></span>
                                <span class="dashicons dashicons-star-filled"></span>
                                <span class="dashicons dashicons-star-filled"></span>
                                <span class="dashicons dashicons-star-filled"></span>
                            </a>
                        </div>

                        <a href="<?php echo esc_url('http://webdzier.com/demo/plugins/gallery-pro');?>" class="btn btn-primary btn-rate rate-yellow" target="_blank"><span class="dashicons dashicons-visibility"></span> View Demo</a>

                        <a href="<?php echo esc_url('http://webdzier.com/amember/login');?>" class="btn btn-primary btn-rate rate-red" target="_blank" style="width: 200px !important;"><span class="dashicons dashicons-format-chat"></span> Support Forum</a>

                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>