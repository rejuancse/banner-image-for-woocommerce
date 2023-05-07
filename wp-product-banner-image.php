<?php
/**
 * Plugin Name: Product Banner Image for WooCommerce
 * Description: Product Banner Image for WooCommerce is easily manage gift order in woocommerce platform. In this plugin you can easily handle order as a gift.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Rejuan Ahamed
 * Text Domain:       wppb
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


defined( 'ABSPATH' ) || exit;

/**
* Support for Multi Network Site
*/
if( !function_exists('is_plugin_active_for_network') ){
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

/**
* @Type
* @Version
* @Directory URL
* @Directory Path
* @Plugin Base Name
*/
define('WPPB_FILE', __FILE__);
define('WPPB_VERSION', '1.0.0');
define('WPPB_DIR_URL', plugin_dir_url( WPPB_FILE ));
define('WPPB_DIR_PATH', plugin_dir_path( WPPB_FILE ));

/**
* Load Text Domain Language
*/
add_action('init', 'wpbi_language_load');
function wpbi_language_load(){
    load_plugin_textdomain('wppb', false, basename(dirname( WPPB_FILE )).'/languages/');
}

if (!function_exists('wppb_function')) {
    function wppb_function() {
        require_once WPPB_DIR_PATH . 'includes/WPPB_Functions.php';
        return new \WPPB\WPPB_Functions();
    }
}

if (!class_exists( 'WPPB_Product_Banner_Image' )) {
    require_once WPPB_DIR_PATH . 'includes/WPPB_Product_Banner_Image.php';
    new \WPPB\WPPB_Product_Banner_Image();
}
