<?php
namespace WPBI;

defined( 'ABSPATH' ) || exit;

final class Product_Banner_Image {

	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		$this->includes_core();
		$this->include_addons();
		$this->initial_activation();
		do_action('wpbi_before_load');
		$this->run();
		do_action('wpbi_after_load');
		
		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

	// Include Core
	public function includes_core() {
		require_once WPBI_DIR_PATH.'includes/Initial_Setup.php';
	}

	//Checking Vendor
	public function run() {
		if( wpbi_function()->is_woocommerce() ) {
			$initial_setup = new \WPBI\Initial_Setup();
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {
				if ( wpbi_function()->wc_version() ) {

					$disable_shop_banner = get_option( "disable_shop_banner" );
					$disable_category_banner = get_option( "disable_category_banner" );
					$disable_product_single_banner = get_option( "disable_product_single_banner" );

					require_once WPBI_DIR_PATH.'includes/woocommerce/Base.php';
					new \WPBI\woocommerce\Base();

					if( $disable_product_single_banner != 'yes' ) {
						require_once WPBI_DIR_PATH.'includes/woocommerce/product-single-page-banner/SinglePageBanner.php';
						new \WPBI\woocommerce\Product_Single_Page_Banner_Image();
					}

					if( $disable_category_banner != 'yes' ) {
						require_once WPBI_DIR_PATH.'includes/woocommerce/category-page-banner/CategoryBanner.php';
					}

					if( $disable_shop_banner != 'yes' ) {
						require_once WPBI_DIR_PATH.'includes/woocommerce/shop-page-banner/Product_Banner_Settings.php';
					}
					
				} else {
					add_action( 'admin_notices', array( $initial_setup , 'wc_low_version' ) );
					deactivate_plugins( plugin_basename( __FILE__ ) );
				}
			} else {
				$cf_file = WP_PLUGIN_DIR.'/woocommerce/woocommerce.php';
				if (file_exists($cf_file) && ! is_plugin_active('woocommerce/woocommerce.php')) {
					add_action( 'admin_notices', array($initial_setup, 'free_plugin_installed_but_inactive_notice') );
				} elseif ( ! file_exists($cf_file) ) {
					add_action( 'admin_notices', array($initial_setup, 'free_plugin_not_installed') );
				}
			}
		}else{
			// Local Code
		}
	}

	/**
     * Initialize the plugin Front View 
     *
     * @return void
     */
	public function init_plugin() {
		if ( is_admin() ) {
            require_once WPBI_DIR_PATH.'includes/Admin.php';
        } else {
			require_once WPBI_DIR_PATH . 'includes/Frontend/Shop_Page_Banner_Image.php';
			require_once WPBI_DIR_PATH . 'includes/Frontend/Product_Single_Page_Banner_Image.php';
			require_once WPBI_DIR_PATH . 'includes/Frontend/Product_Category_Banner_Image.php';

			new \WPBI\Frontend\Shop_Page_Banner_Image();
			new \WPBI\Frontend\Product_Single_Page_Banner_Image();
			new \WPBI\Frontend\Product_Category_Page_Banner_Image();
		}
    }

	// Include Addons directory
	public function include_addons() {
		$addons_dir = array_filter(glob(WPBI_DIR_PATH.'addons/*'), 'is_dir');
		if (count($addons_dir) > 0) {
			foreach( $addons_dir as $key => $value ) {
				$addon_dir_name = str_replace(dirname($value).'/', '', $value);
				$file_name = WPBI_DIR_PATH . 'addons/'.$addon_dir_name.'/'.$addon_dir_name.'.php';
				if ( file_exists($file_name) ) {
					include_once $file_name;
				}
			}
		}
	}

	// Activation & Deactivation Hook
	public function initial_activation() {
		$initial_setup = new \WPBI\Initial_Setup();
		register_activation_hook( WPBI_FILE, array( $initial_setup, 'initial_plugin_activation' ) );
		register_deactivation_hook( WPBI_FILE , array( $initial_setup, 'initial_plugin_deactivation' ) );
	}
}
