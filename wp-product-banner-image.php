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




// if ( is_admin() ) {
//     add_action( 'admin_menu', 'add_products_menu_entry', 100 );
// }

// function add_products_menu_entry() {
//     add_submenu_page(
//         'edit.php?post_type=product',
//         __( 'Product Grabber' ),
//         __( 'Grab New' ),
//         'manage_woocommerce', // Required user capability
//         'ddg-product',
//         'generate_grab_product_page'
//     );
// }

// function generate_grab_product_page() {
//   echo "<h2>Hello, it worked! :-)</h2>";
// }
?>


<?php

defined( 'ABSPATH' ) || exit;

class Xwoo_Extensions {
    /**
     * @var null
     *
     * Instance of this class
     */
    protected static $_instance = null;

    /**
     * @return null|XEWC
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('admin_menu', array($this, 'xewc_add_quick_view_page'));
        add_action('admin_init', array($this, 'save_menu_settings' ));
    }

    public function xewc_add_quick_view_page(){
        add_submenu_page(
            'edit.php?post_type=product',
            __( 'Product Grabber' ),
            __( 'Grab New' ),
            'manage_woocommerce', // Required user capability
            'ddg-product',
            array($this, 'generate_grab_product_page')
        );
    }

    /**
     * Display a custom menu page
     */
    public function generate_grab_product_page(){
        if (wpbi_function()->post('wp_settings_page_nonce_field')){
            echo '<div class="notice notice-success is-dismissible">';
                echo '<p>'.__( "Quick view data have been Saved.", "xewc" ).'</p>';
            echo '</div>';
        } ?>

        <form id="xewc" role="form" method="post" action="">
            <?php
            $arr =  array(
                array(
                    'type'      => 'seperator',
                    'label'     => __('WooCommerce Quick View Settings', 'xewc'),
                    'top_line'  => 'true',
                ),
                # Enable Quick View
                array(
                    'id'        => 'wp_quick_view',
                    'type'      => 'checkbox',
                    'value'     => 'true',
                    'label'     => __('Enable Quick View','xewc'),
                ),
                # Enable Quick View on mobile device
                array(
                    'id'        => 'mobile_quick_view',
                    'type'      => 'checkbox', 
                    'value'     => 'true',
                    'label'     => __('Enable Quick View on mobile','xewc'),
                    'desc'      => '<p>'.__('Enable quick view features on mobile device too','xewc').'</p>',
                ),
                # Enable Quick View on mobile device
                array(
                    'id'        => 'btn_quick_view',
                    'type'      => 'text', 
                    'value'     => 'Quick View',
                    'label'     => __('Quick View Button Label','xewc'),
                    'desc'      => '<p>'.__('Label for the quick view button in the WooCommerce loop.','xewc').'</p>',
                ),

                // #Style Seperator
                array(
                    'type'      => 'seperator',
                    'label'     => __('Style Settings','xewc'),
                    'top_line'  => 'true',
                ),

                # Button Background Color
                array(
                    'id'        => 'wp_button_bg_color',
                    'type'      => 'color',
                    'label'     => __('Button BG Color','xewc'),
                    'desc'      => __('Select button background color.','xewc'),
                    'value'     => '#1adc68',
                ),
                # Close Button Color
                array(
                    'id'        => 'wp_close_button_color',
                    'type'      => 'color',
                    'label'     => __('Modal close button color','xewc'),
                    'desc'      => __('Select quick view modal close button color.','xewc'),
                    'value'     => '#2b74aa',
                ),
                # Modal close button hover color
                array(
                    'id'        => 'wp_close_button_hover_color',
                    'type'      => 'color',
                    'label'     => __('Modal close button hover color','xewc'),
                    'desc'      => __('Select quick view modal close button hover color.','xewc'),
                    'value'     => '#2554ec',
                ),
                # Save Function
                array(
                    'id'        => 'wp_xewc_quick_view_admin_tab',
                    'type'      => 'hidden',
                    'value'     => 'tab_style',
                ),
            );

            wpbi_function()->generator( $arr );
            //Load tab file
            // include_once XEWC_DIR_PATH.'extensions/quickview/classes/quick-view-tab.php';
            
            wp_nonce_field( 'wp_settings_page_action', 'wp_settings_page_nonce_field' );
            submit_button( null, 'primary', 'wp_admin_settings_submit_btn' );
            ?>
        </form>
        <?php
    }

    /**
     * Add menu settings action
     */
    public function save_menu_settings() {
        
        if (wpbi_function()->post('wp_settings_page_nonce_field') && wp_verify_nonce( sanitize_text_field(wpbi_function()->post('wp_settings_page_nonce_field')), 'wp_settings_page_action' ) ){

            $current_tab = sanitize_text_field(wpbi_function()->post('wp_xewc_quick_view_admin_tab'));

            if( ! empty($current_tab) ){
                /**
                 * General Settings
                 */
                $styling = sanitize_text_field(wpbi_function()->post('wp_quick_view'));
                wpbi_function()->update_checkbox( 'wp_quick_view', $styling);

                $mobile_view = sanitize_text_field(wpbi_function()->post('mobile_quick_view'));
                wpbi_function()->update_text('mobile_quick_view', $mobile_view);

                $product_status = sanitize_text_field(wpbi_function()->post('btn_quick_view'));
                wpbi_function()->update_text('btn_quick_view', $product_status);

                # Style.
                $button_bg_color = sanitize_text_field(wpbi_function()->post('wp_button_bg_color'));
                wpbi_function()->update_text('wp_button_bg_color', $button_bg_color);

                $button_bg_hover_color = sanitize_text_field(wpbi_function()->post('wp_close_button_hover_color'));
                wpbi_function()->update_text('wp_close_button_hover_color', $button_bg_hover_color);

                $button_text_color = sanitize_text_field(wpbi_function()->post('wp_close_button_color'));
                wpbi_function()->update_text('wp_close_button_color', $button_text_color);
            }
        }
    }

}
Xwoo_Extensions::instance();
