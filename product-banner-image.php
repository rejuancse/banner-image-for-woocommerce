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


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class WC_Banner_Image {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * Class construcotr
     */
    private function __construct() {
        $this->define_constants();
        $this->includes_core();
        $this->initial_activation();

        do_action('wcpb_before_load');
		$this->run();
		do_action('wcpb_after_load');

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action('wp_enqueue_scripts', [ $this, 'frontend_script' ]); //Add frontend js and css
    }

    /**
     * Initializes a singleton instance
     *
     * @return \WC_Banner_Image
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'WCPB_GIFT_VERSION', self::version );
        define( 'WCPB_GIFT_FILE', __FILE__ );
        define( 'WCPB_GIFT_URL', plugins_url( '', WCPB_GIFT_FILE ) );
        define( 'WCPB_GIFT_ASSETS', WCPB_GIFT_URL . '/assets' );
        define( 'WCPB_DIR_URL', plugin_dir_url( WCPB_GIFT_FILE ));
        define( 'WCPB_DIR_PATH', plugin_dir_path( WCPB_GIFT_FILE ));
    }

    public function includes_core() {
		require_once WCPB_DIR_PATH.'includes/Initial_Setup.php';
	}

    //Checking Vendor
	public function run() {
        if ( is_admin() ) {
            $initial_setup = new \WCPB\WC_Product_Banner\Initial_Setup();
            
            $wcpb_file = WP_PLUGIN_DIR.'/woocommerce/woocommerce.php';

            if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

            } else {
                $wcpb_file = WP_PLUGIN_DIR.'/woocommerce/woocommerce.php';
                if (file_exists($wcpb_file) ) {
                    add_action( 'admin_notices', array($initial_setup, 'free_plugin_installed_but_inactive_notice') );
                } elseif ( ! file_exists($wcpb_file) ) {
                    add_action( 'admin_notices', array($initial_setup, 'free_plugin_not_installed') );
                }
            }
        }
	}

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if ( is_admin() ) {
            require_once WCPB_DIR_PATH.'includes/Admin.php';
        } else {
            new WCPB\WC_Product_Banner\Frontend();
        }
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'wc_product_banner_installed' );

        if ( ! $installed ) {
            update_option( 'wc_product_banner_installed', time() );
        }

        update_option( 'wc_product_banner_version', WCPB_GIFT_VERSION );
    }

    // Activation & Deactivation Hook
	public function initial_activation() {
		$initial_setup = new \WCPB\WC_Product_Banner\Initial_Setup();
		register_activation_hook( WCPB_GIFT_FILE, array( $initial_setup, 'initial_plugin_activation' ) );
		register_deactivation_hook( WCPB_GIFT_FILE , array( $initial_setup, 'initial_plugin_deactivation' ) );
	}

    /**
     * Registering necessary js and css
     * @ Frontend
     */
    public function frontend_script(){
        wp_enqueue_style( 'wcpb-css-front', WCPB_DIR_URL .'assets/build/css/main.css', false, WCPB_GIFT_VERSION );
         
        #JS
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'wp-wcpb-front', WCPB_DIR_URL .'assets/build/js/main.js', array('jquery'), WCPB_GIFT_VERSION, true);
        wp_enqueue_media(); 
    }
}

/**
 * Initializes the main plugin
 *
 * @return \WC_Banner_Image
 */
function WCPB_Product_Banner_Image() {
    return WC_Banner_Image::init();
}

if (!function_exists('wcpb_function')) {
    function wcpb_function() {
        require_once WCPB_DIR_PATH . 'includes/Functions.php';
        return new \WCPB\WC_Product_Banner\Functions();
    }
}

// kick-off the plugin
WCPB_Product_Banner_Image();


// add_action( 'woocommerce_after_shop_loop_item', 'ace_shop_page_add_quantity_field', 12 );
/**
 * Display QTY Input before add to cart link.
 */
// function custom_wc_template_loop_quantity_input() {
//     // Global Product.
//     global $product;

//     // Check if the product is not null, is purchasable, is a simple product, is in stock, and not sold individually.
//     if ( $product && $product->is_purchasable() && $product->is_type( 'simple' ) && $product->is_in_stock() && ! $product->is_sold_individually() ) {
//         woocommerce_quantity_input(
//             array(
//                 'min_value' => 1,
//                 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity(),
//             )
//         );
//     }
// }
// add_action( 'woocommerce_after_shop_loop_item', 'custom_wc_template_loop_quantity_input', 9 );

// /**
//  * Add JS script in <head/> tag.
//  */
// function custom_wc_add_qty_change_script() {
//     ?>
//     <script>
//         (function ($) {
//             $(document).on("change", "li.product .quantity input.qty", function (e) {
//                 e.preventDefault();
//                 var add_to_cart_button = $(this).closest("li.product").find("a.add_to_cart_button");
//                 // For AJAX add-to-cart actions.
//                 add_to_cart_button.attr("data-quantity", $(this).val());
//                 // For non-AJAX add-to-cart actions.
//                 add_to_cart_button.attr("href", "?add-to-cart=" + add_to_cart_button.attr("data-product_id") + "&quantity=" + $(this).val());
//             });
//         })(jQuery);
//     </script>
//     <?php
// }
// add_action( 'wp_head', 'custom_wc_add_qty_change_script', 20 );