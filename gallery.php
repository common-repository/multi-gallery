<?php
/*
* Plugin Name: Multi Gallery
* Version: 1.3
* Plugin URI: http://webdzier.com/plugins/gallery
* description: The Multi Gallery wordPress plugin provide the multiple types of galleries with multiple lightbox. you can create many types of the galleries and customize them according to you. Multi gallery plugin contains multiple hover effects, google fonts and 3 types galleries.
* Author: webdzier
* Author URI: http://webdzier.com
* Text Domain: wd_gallery
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('WD_GALLERY_PATH',plugin_dir_url (__FILE__ ));
define('WD_GAL_PATH',plugin_dir_path(__FILE__));


add_image_size('wd_gallery_img_300',300, 300, array( 'top', 'center' ));
add_image_size( 'wd_gallery_img_500', 550, 550, array( 'top', 'center' ));

include('partials/WDSettings.php');
include('partials/Shortcode.php');
include('partials/Scripts.php');

register_activation_hook(__FILE__, array('WDSettings','WD_default_settings'));
register_deactivation_hook(__FILE__, array('WDSettings','WD_deactivation_settings'));

$st = new WD_Gallery_ShortCode();
$c = new WDSettings();
$script = new WDEnqueueAllScripts();
?>