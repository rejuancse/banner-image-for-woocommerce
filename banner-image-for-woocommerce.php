<?php
/**
 * Plugin Name: Banner Image for WooCommerce
 * Description: Enhance your WooCommerce store with stunning product banner images. Showcase your products beautifully and boost sales effortlessly!
 * Version:           1.0.1
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Rejuan Ahamed
 * Text Domain:       biw
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class BIFW_ProductBannerImage {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.1';

    /**
     * Class construcotr
     */
    private function __construct() {
        $this->define_constants();
        add_action( 'init', [ $this, 'biw_language_load' ] );
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action('admin_enqueue_scripts', [ $this, 'admin_script' ]);
        add_action('wp_enqueue_scripts', [ $this, 'frontend_script' ]);
    }

    /**
    * Load Text Domain Language
    */
    function biw_language_load(){
        load_plugin_textdomain( 'biw', false, basename(dirname( __FILE__ )).'/languages/');
    }

    /**
     * Initialize a singleton instance
     * @return \BIFW_ProductBannerImage
     */
    public static function init() {
        static $instance = false;

        if( ! $instance ) {
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
        define( 'BIFW_VERSION', self::version );
        define( 'BIFW_FILE', __FILE__ );
        define( 'BIFW_PATH', __DIR__ );
        define( 'BIFW_URL', plugins_url( '', BIFW_FILE ) );
        define( 'BIFW_ASSETS', BIFW_URL . '/assets' );
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'biw_installed' );

        if ( ! $installed ) {
            update_option( 'biw_installed', time() );
        }

        update_option( 'biw_version', BIFW_VERSION );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if ( is_admin() ) {
            new BIFW\Admin();
        } else {
            new BIFW\Frontend();
        }
    }

    /**
     * Registering necessary js and css
     * @ Frontend
     */
    public function frontend_script(){
        wp_enqueue_style( 'biw-front', BIFW_URL .'/assets/css/main.css', false, BIFW_VERSION );
    }

    public function admin_script(){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'biw-admin', BIFW_URL .'/assets/css/admin.css', false, BIFW_VERSION );

        wp_enqueue_script( 'biw-scripts', BIFW_URL .'/assets/js/admin.js', array('jquery', 'wp-color-picker'), BIFW_VERSION, true );
    }
}

/**
 * Initilizes the main plugin
 */
function biw_product_banner_image() {
    return BIFW_ProductBannerImage::init();
}

// Kick-off the plugin
biw_product_banner_image();

if (!function_exists('biw_function')) {
    function biw_function() {
        return new BIFW\Functions();
    }
}
