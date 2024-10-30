<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WDEnqueueAllScripts
{
   public function __construct()
    {
        add_action( 'admin_enqueue_scripts', array(&$this,'WDEnqueueStylesAndScripts') );
        add_action('wp_enqueue_scripts', array(&$this,'WDEnqueueScriptOnView'));
    }

/*
 * Enqueue all scripts and styles
 * */
function WDEnqueueStylesAndScripts() {

        global $typenow;
    if($typenow=='wd_gallery'){
        // Add the color picker css file
        wp_enqueue_style( 'wp-color-picker' );
        // Make sure to add the wp-color-picker dependecy to js file
        wp_enqueue_script(array( 'jquery', 'wp-color-picker' ));

        wp_enqueue_style( 'bootstrap_css', WD_GALLERY_PATH . 'bootstrap/css/bootstrap.css', false, '1.0.0' );
        wp_enqueue_style( 'gallery_css', WD_GALLERY_PATH . 'css/gallery.css', false, '1.0.0' );

        wp_enqueue_script( 'gallery_js', WD_GALLERY_PATH . 'js/gallery.js', array('jquery-ui-sortable','jquery'), '1.0.0' ,true);
        wp_enqueue_media();
    }
}


function WDEnqueueScriptOnView()
{
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'WD_Gallery') ) {
        wp_enqueue_script( 'jquery');
//        wp_enqueue_style('bootstrap-style',WD_GALLERY_PATH.'bootstrap/css/bootstrap.css');
        wp_enqueue_style('front-style',WD_GALLERY_PATH.'css/front-style.css');

    }
}
}