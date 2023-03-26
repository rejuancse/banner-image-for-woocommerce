<?php
/**
 * Plugin Name: Product Banner Image for WooCommerce
 * Description: Product Banner Image for WooCommerce is easily manage gift order in woocommerce platform. In this plugin you can easily handle order as a gift.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Rejuan Ahamed
 * Text Domain:       wcpb
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
define('WPBI_FILE', __FILE__);
define('WPBI_VERSION', '1.0.0');
define('WPBI_DIR_URL', plugin_dir_url( WPBI_FILE ));
define('WPBI_DIR_PATH', plugin_dir_path( WPBI_FILE ));
define('WPBI_BASENAME', plugin_basename( WPBI_FILE ));
/**
* Load Text Domain Language
*/
add_action('init', 'wpbi_language_load');
function wpbi_language_load(){
    load_plugin_textdomain('wcpb', false, basename(dirname( WPBI_FILE )).'/languages/');
}

if (!function_exists('wpbi_function')) {
    function wpbi_function() {
        require_once WPBI_DIR_PATH . 'includes/Functions.php';
        return new \WPBI\Functions();
    }
}

if (!class_exists( 'Product_Banner_Image' )) {
    require_once WPBI_DIR_PATH . 'includes/Product_Banner_Image.php';
    new \WPBI\Product_Banner_Image();
}




add_action('woocommerce_before_single_product_summary', function() {

    defined( 'ABSPATH' ) || exit;
    
    global $post;
    $campaign_rewards   = get_post_meta($post->ID, 'wpbi_reward', true);
    $campaign_rewards_a = json_decode($campaign_rewards, true);
    if (is_array($campaign_rewards_a)) {
        if (count($campaign_rewards_a) > 0) {
            foreach ($campaign_rewards_a as $key => $value) { ?>
                <div class="wpneo-shadow wpneo-padding15 wpneo-clearfix" 
                style="background-image: url(<?php echo !empty($value['wp_product_banner_image_image_field']) ? wp_get_attachment_url( $value["wp_product_banner_image_image_field"] ) : ''; ?>); background-repeat: no-repeat; background-size: cover;">
                    <div><?php echo wpautop(wp_unslash($value['wp_product_banner_image_description'])); ?></div>
                </div>
            <?php
            }
        }
    }
    ?>
    <div style="clear: both"></div>

    <?php
} );