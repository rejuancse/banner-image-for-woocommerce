<?php
/**
 * Plugin Name: Product Banner Image for WooCommerce
 * Description: Product Banner Image for WooCommerce is easily manage gift order in woocommerce platform. In this plugin you can easily handle order as a gift.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Rejuan Ahamed
 * Text Domain:       ogpc
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
final class WC_Gift {

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

        do_action('ogpc_before_load');
		$this->run();
		do_action('ogpc_after_load');

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action('wp_enqueue_scripts', [ $this, 'frontend_script' ]); //Add frontend js and css
    }

    /**
     * Initializes a singleton instance
     *
     * @return \WC_Gift
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
        define( 'OGPC_GIFT_VERSION', self::version );
        define( 'OGPC_GIFT_FILE', __FILE__ );
        define( 'OGPC_GIFT_URL', plugins_url( '', OGPC_GIFT_FILE ) );
        define( 'OGPC_GIFT_ASSETS', OGPC_GIFT_URL . '/assets' );
        define( 'OGPC_DIR_URL', plugin_dir_url( OGPC_GIFT_FILE ));
        define( 'OGPC_DIR_PATH', plugin_dir_path( OGPC_GIFT_FILE ));
    }

    public function includes_core() {
		require_once OGPC_DIR_PATH.'includes/Initial_Setup.php';
	}

    //Checking Vendor
	public function run() {
        if ( is_admin() ) {
            $initial_setup = new \WCGT\WC_Gift_Proceed\Initial_Setup();
            
            $ogpc_file = WP_PLUGIN_DIR.'/woocommerce/woocommerce.php';

            if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

            } else {
                $ogpc_file = WP_PLUGIN_DIR.'/woocommerce/woocommerce.php';
                if (file_exists($ogpc_file) ) {
                    add_action( 'admin_notices', array($initial_setup, 'free_plugin_installed_but_inactive_notice') );
                } elseif ( ! file_exists($ogpc_file) ) {
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
            require_once OGPC_DIR_PATH.'includes/Admin.php';
        } else {
            new WCGT\WC_Gift_Proceed\Frontend();
        }
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'wc_gift_proceed_installed' );

        if ( ! $installed ) {
            update_option( 'wc_gift_proceed_installed', time() );
        }

        update_option( 'wc_gift_proceed_version', OGPC_GIFT_VERSION );
    }

    // Activation & Deactivation Hook
	public function initial_activation() {
		$initial_setup = new \WCGT\WC_Gift_Proceed\Initial_Setup();
		register_activation_hook( OGPC_GIFT_FILE, array( $initial_setup, 'initial_plugin_activation' ) );
		register_deactivation_hook( OGPC_GIFT_FILE , array( $initial_setup, 'initial_plugin_deactivation' ) );
	}

    /**
     * Registering necessary js and css
     * @ Frontend
     */
    public function frontend_script(){
        wp_enqueue_style( 'ogpc-css-front', OGPC_DIR_URL .'assets/build/css/main.css', false, OGPC_GIFT_VERSION );
         
        #JS
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'wp-ogpc-front', OGPC_DIR_URL .'assets/build/js/main.js', array('jquery'), OGPC_GIFT_VERSION, true);
        wp_enqueue_media(); 
    }
}

/**
 * Initializes the main plugin
 *
 * @return \WC_Gift
 */
function WCGT_Gift_Proceed() {
    return WC_Gift::init();
}

if (!function_exists('ogpc_function')) {
    function ogpc_function() {
        require_once OGPC_DIR_PATH . 'includes/Functions.php';
        return new \WCGT\WC_Gift_Proceed\Functions();
    }
}

// kick-off the plugin
WCGT_Gift_Proceed();



// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
add_filter( 'woocommerce_product_data_tabs', 'add_my_custom_product_data_tab' );
function add_my_custom_product_data_tab( $product_data_tabs ) {
    $product_data_tabs['product-banner-image'] = array(
        'label'     => __( 'Product Banner Image', 'woocommerce' ),
        'target'    => 'my_custom_product_data',
        'class'     => array( 'show_if_simple' ),
    );
    return $product_data_tabs;
}

/** CSS To Add Custom tab Icon */
function wcpp_custom_style() {?>
<style>
#woocommerce-product-data ul.wc-tabs li.product-banner-image_options a:before { font-family: WooCommerce; content: '\e006'; }
</style>
<?php 
}
add_action( 'admin_head', 'wcpp_custom_style' );

// functions you can call to output text boxes, select boxes, etc.
add_action('woocommerce_product_data_panels', 'woocom_custom_product_data_fields');

function woocom_custom_product_data_fields() {
    global $post;

    // Note the 'id' attribute needs to match the 'target' parameter set above
    ?> 
    <div id = 'my_custom_product_data' class = 'panel woocommerce_options_panel' >
        <div class = 'options_group' > 
            <?php
            // Checkbox
            woocommerce_wp_checkbox(
                array(
                    'id'        => '_checkbox',
                    'label'     => __('Enable Banner', 'woocommerce' ),
                )
            );

            // Text Field
            woocommerce_wp_text_input(
                array(
                'id'            => '_text_field',
                'label'         => __( 'Banner Title', 'woocommerce' ),
                'wrapper_class' => 'show_if_simple', //show_if_simple or show_if_variable
                'placeholder'   => 'Banner Title',
                'desc_tip'      => 'true',
                'description'   => __( 'Enter the custom value here.', 'woocommerce' )
                )
            );

            // Textarea
            woocommerce_wp_textarea_input(
                array (
                'id'            => '_textarea',
                'label'         => __( 'Custom Textarea', 'woocommerce' ),
                'placeholder'   => '',
                'description'   => __( 'Enter the value here.', 'woocommerce' )
                )
            );

            // Number Field
            woocommerce_wp_text_input(
                array(
                    'id'            => '_number_field',
                    'label'         => __( 'Custom Number Field', 'woocommerce' ),
                    'placeholder'   => '',
                    'description'   => __( 'Enter the custom value here.', 'woocommerce' ),
                    'type'          => 'number',
                    'custom_attributes'         => array(
                        'step'      => 'any',
                        'min'       => '15'
                    )
                )
            );

            // woocommerce_wp_image_input(
            //     array(
            //         'id'            => '_image_field',
            //         'label'         => __( 'Upload Banner Image', 'woocommerce' ),
            //         'description'   => __( 'Enter the custom value here.', 'woocommerce' ),
            //         'type'          => 'image',
            //         // 'custom_attributes'         => array(
            //         //     'step'      => 'any',
            //         //     'min'       => '15'
            //         // )
            //     )
            // );

            // Select
            woocommerce_wp_select(
                array(
                'id'                => '_select',
                'label'             => __( 'Custom Select Field', 'woocommerce' ),
                'options'           => array(
                                            'one'           => __( 'Custom Option 1', 'woocommerce' ),
                                            'two'           => __( 'Custom Option 2', 'woocommerce' ),
                                            'three'         => __( 'Custom Option 3', 'woocommerce' )
                                        )
                )
            );
            
        ?> </div>

    </div><?php
}

/** Hook callback function to save custom fields information */
function woocom_save_proddata_custom_fields($post_id) {
    // Save Text Field
    $text_field = $_POST['_text_field'];
    if (!empty($text_field)) {
        update_post_meta($post_id, '_text_field', esc_attr($text_field));
    }

    // Save Number Field
    $number_field = $_POST['_number_field'];
    if (!empty($number_field)) {
        update_post_meta($post_id, '_number_field', esc_attr($number_field));
    }
    // Save Textarea
    $textarea = $_POST['_textarea'];
    if (!empty($textarea)) {
        update_post_meta($post_id, '_textarea', esc_html($textarea));
    }

    // Save Select
    $select = $_POST['_select'];
    if (!empty($select)) {
        update_post_meta($post_id, '_select', esc_attr($select));
    }

    // Save Checkbox
    $checkbox = isset($_POST['_checkbox']) ? 'yes' : 'no';
    update_post_meta($post_id, '_checkbox', $checkbox);

    // Save Hidden field
    $hidden = $_POST['_hidden_field'];
    if (!empty($hidden)) {
        update_post_meta($post_id, '_hidden_field', esc_attr($hidden));
    }
}

add_action( 'woocommerce_process_product_meta_simple', 'woocom_save_proddata_custom_fields'  );

// You can uncomment the following line if you wish to use those fields for "Variable Product Type"
add_action( 'woocommerce_process_product_meta_variable', 'woocom_save_proddata_custom_fields'  );
