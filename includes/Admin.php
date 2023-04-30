<?php

include WPBI_DIR_PATH.'includes/woocommerce/banner_settings/banner-general-settings.php';

class WC_Settings_Banner_Image_Plugin extends WC_Settings_Banner_Image_Page {

    /**
     * Constructor
     */
    public function __construct() {
        $this->id    = 'wc-settings-banner-image';

        add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 50 );
        add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );
        add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
        add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
    }

    /**
     * Add plugin options tab
     *
     * @return array
     */
    public function add_settings_tab( $settings_tabs ) {
        $settings_tabs[$this->id] = __( 'Settings Banner Image', 'wcpb' );
        return $settings_tabs;
    }

    /**
     * Get sections
     *
     * @return array
     */
    public function get_sections() {
        $sections = array(
            'category-page-banner-style' 	=> __( 'Category Page Banner Image Style', 'wcpb' ),
            'single-page-banner-style' 		=> __( 'Product Single Page Banner Image Style', 'wcpb' ),
        );

        return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
    }

    /**
     * Get sections
     *
     * @return array
     */
    public function get_settings( $section = null ) {
        switch( $section ) {
            case 'category-page-banner-style' :
				include WPBI_DIR_PATH.'includes/woocommerce/banner_settings/product-category-page-banner-style.php';
            	break;

			case 'single-page-banner-style' :
				include WPBI_DIR_PATH.'includes/woocommerce/banner_settings/product-single-page-banner-style.php';
            	break;

			default:
				include WPBI_DIR_PATH.'includes/woocommerce/banner_settings/default-settings.php';
				break;
        }

        return apply_filters( 'wc_settings_tab_demo_settings', $settings, $section );
    }

    /**
     * Output the settings
     */
    public function output() {
        global $current_section;
        $settings = $this->get_settings( $current_section );
        WC_Admin_Settings::output_fields( $settings );
    }

    /**
     * Save settings
     */
    public function save() {
        global $current_section;
        $settings = $this->get_settings( $current_section );
        WC_Admin_Settings::save_fields( $settings );
    }
}

return new WC_Settings_Banner_Image_Plugin();
