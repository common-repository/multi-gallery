<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WD_Gallery_ShortCode
{
	public function __construct()
	{
        add_shortcode( 'WD_GALLERY', array(&$this,'WD_Gallery_ShortCode'));
	}

    function WD_Gallery_ShortCode($post)
    {
        ob_start();
        $id = $post['id'];
        $GLOBALS['post_id'] = $id;
        $show_gallery_posts = array( 'p' => $id, 'post_type' => 'wd_gallery', 'orderby' => 'ASC');
        $gallery_loop = new WP_Query( $show_gallery_posts );
        while ( $gallery_loop->have_posts() ) : $gallery_loop->the_post();
            if(isset($id)){
                $data = unserialize(get_post_meta($id,'wd_gallery_'.$id, true));
            }
            $data['title'] = get_the_title();
            echo '<div class="wdMainContainer" id="wdMainContainer'.$id.'" data-post_id="'.$id.'" data-is_active="'.$data['active_lightbox'].'"  data-gallery_type="'.$data['add_lightbox'].'">';
            
            $gallery_type =$data['gallery_type'];
            switch($gallery_type):
                case 'incontent':

                    wp_enqueue_style('compiled',WD_GALLERY_PATH.'lib/incontent/sass-compiled.css');
                    wp_enqueue_script( 'modernizr', WD_GALLERY_PATH . 'lib/incontent/modernizr.js');
                    $this->addSelectedLightBox($data);
                    include 'incontent.php';
                    break;

            endswitch;
            include 'ShortcodeData.php';
            echo '</div>';
        endwhile;
        return ob_get_clean();
    }
    public static function convertHex($hex,$opacity){
        $hex = str_replace('#','',$hex);
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
        return 'rgba('.$r.','.$g.','.$b.','.($opacity/100).')';
    }
    public function hoverScripts(){
        wp_enqueue_style('hover-style',WD_GALLERY_PATH.'lib/shadow/hover-style.css');
        wp_enqueue_style('style',WD_GALLERY_PATH.'lib/shadow/style.css');
    }

    public function addSelectedLightBox($data){
        if($data['active_lightbox']==1){
            switch($data['add_lightbox']){
                case 'swipe_box':
                    $this->swipeBoxScript();break;
            }
        }
        wp_enqueue_script('gallery-custom-js',WD_GALLERY_PATH.'js/gallery_custom_js.js',array('jquery'),null,true);
    }
    public function swipeBoxScript()
    {
        wp_enqueue_style('swipe-box-css',WD_GALLERY_PATH.'lightbox/swipebox/swipebox.css');
        wp_enqueue_script('swipe-box-js',WD_GALLERY_PATH.'lightbox/swipebox/jquery.swipebox.js');
    }
}
?>