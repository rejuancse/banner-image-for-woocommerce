<?php
/**
 * Plugin Name: Banner Image for WooCommerce
 * Description: Enhance your WooCommerce store with stunning product banner images. Showcase your products beautifully and boost sales effortlessly!
 * Author:            Rejuan Ahamed
 * Version:           1.0.5
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Text Domain:       banner-image
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Banner_Image_ProductBannerImage {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.4';

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
        load_plugin_textdomain( 'banner-image', false, basename(dirname( __FILE__ )).'/languages/');
    }

    /**
     * Initialize a singleton instance
     * @return \Banner_Image_ProductBannerImage
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
        define( 'Banner_Image_VERSION', self::version );
        define( 'Banner_Image_FILE', __FILE__ );
        define( 'Banner_Image_PATH', __DIR__ );
        define( 'Banner_Image_URL', plugins_url( '', Banner_Image_FILE ) );
        define( 'Banner_Image_ASSETS', Banner_Image_URL . '/assets' );
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'banner_image_installed' );

        if ( ! $installed ) {
            update_option( 'banner_image_installed', time() );
        }

        update_option( 'banner_image_version', Banner_Image_VERSION );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if ( is_admin() ) {
            new Banner_Image\Admin();
        } else {
            new Banner_Image\Frontend();
        }
    }

    /**
     * Registering necessary js and css
     * @ Frontend
     */
    public function frontend_script(){
        wp_enqueue_style( 'biw-front', Banner_Image_URL .'/assets/css/main.css', false, Banner_Image_VERSION );
    }

    public function admin_script(){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'biw-admin', Banner_Image_URL .'/assets/css/admin.css', false, Banner_Image_VERSION );

        wp_enqueue_script( 'biw-scripts', Banner_Image_URL .'/assets/js/admin.js', array('jquery', 'wp-color-picker'), Banner_Image_VERSION, true );
    }
}

/**
 * Initilizes the main plugin
 */
function banner_image_get_product() {
    return Banner_Image_ProductBannerImage::init();
}

// Kick-off the plugin
banner_image_get_product();

if (!function_exists('banner_image_function')) {
    function banner_image_function() {
        return new Banner_Image\Functions();
    }
}
