<?php
namespace WPBI\woocommerce;

class WPBI_Product_Banner_Image_Extensions {
    /**
     * @var null
     *
     * Instance of this class
     */
    protected static $_instance = null;

    /**
     * @return null|WPBI
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('admin_menu', array($this, 'wpbi_add_product_banner_image'));
        add_action('admin_init', array($this, 'save_menu_settings' ));
    }

    public function wpbi_add_product_banner_image(){
        add_submenu_page(
            'edit.php?post_type=product',
            __( 'Product Banner Image' ),
            __( 'Product Banner Image' ),
            'manage_woocommerce', // Required user capability
            'product-banner-image',
            array($this, 'generate_product_page_banner_image')
        );
    }

    /**
     * Display a custom menu page
     */
    public function generate_product_page_banner_image(){
        if (wpbi_function()->post('wp_settings_page_nonce_field')){
            echo '<div class="notice notice-success is-dismissible">';
                echo '<p>'.__( "Product Page Banner Image data have been Saved.", "wcpb" ).'</p>';
            echo '</div>';
        }

        $default_file = WPBI_DIR_PATH.'includes/woocommerce/product-page-banner/pages/general-settings.php';
        $style = WPBI_DIR_PATH.'includes/woocommerce/product-page-banner/pages/style.php';

        // Settings Tab With slug and Display name
        $tabs = apply_filters('product_banner_image_page_panel_tabs', array(
                'general_settings' 	=> array(
                    'tab_name'          => __('General Settings','WPBI'),
                    'load_form_file'    => $default_file
                ),
                'banner_style'  => array (
                    'tab_name'          => __('Style','WPBI'),
                    'load_form_file'    => $style
                )
            )
        );

        $current_page = 'general_settings';

        if( ! empty($_GET['tab']) ){
            $current_page = sanitize_text_field($_GET['tab']);
        }

        // Print the Tab Title
        echo '<h2 class="bannerimage-setting-title">'.__( "Product Banner Image Settings", "wcpb" ).'</h2>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach( $tabs as $tab => $name ){
            $class = ( $tab == $current_page ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='edit.php?post_type=product&page=product-banner-image&tab=$tab'>{$name['tab_name']}</a>";
        }
        echo '</h2>'; ?>

        <form id="wcpb" role="form" method="post" action="">
            <?php
                //Load tab file
                $request_file = $tabs[$current_page]['load_form_file'];

                if (array_key_exists(trim(esc_attr($current_page)), $tabs)){
                    if (file_exists($default_file)){
                        include_once $request_file;
                    }else{
                        include_once $default_file;
                    }
                } else {
                    include_once $default_file;
                }
                
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

            $current_tab = sanitize_text_field(wpbi_function()->post('wpbi_product_general_settings_admin_tab'));
            $current_style_tab = sanitize_text_field(wpbi_function()->post('wpbi_product_style_admin_tab'));

            if( ! empty($current_tab) ){
                /**
                 * General Settings
                 */
                # Enable Banner
                $styling = sanitize_text_field(wpbi_function()->post('enable_product_banner'));
                wpbi_function()->update_checkbox( 'enable_product_banner', $styling);

                # Image
                $styling = sanitize_text_field(wpbi_function()->post('wpbi_product_banner_image'));
                wpbi_function()->update_checkbox( 'wpbi_product_banner_image', $styling);

                # Banner Title
                $product_status = sanitize_text_field(wpbi_function()->post('product_banner_title'));
                wpbi_function()->update_text('product_banner_title', $product_status);

                $short_text = sanitize_text_field(wpbi_function()->post('product_banner_short_text'));
                wpbi_function()->update_text('product_banner_short_text', $short_text);

                $button_name = sanitize_text_field(wpbi_function()->post('product_banner_button_name'));
                wpbi_function()->update_text('product_banner_button_name', $button_name);

                $button_url = sanitize_text_field(wpbi_function()->post('product_banner_button_url'));
                wpbi_function()->update_text('product_banner_button_url', $button_url);

                $button_text_color = sanitize_text_field(wpbi_function()->post('wp_close_button_color'));
                wpbi_function()->update_text('wp_close_button_color', $button_text_color);
            }

            # Style.
            if( ! empty( $current_style_tab ) ) {
                $button_bg_color = sanitize_text_field(wpbi_function()->post('wp_button_bg_color'));
                wpbi_function()->update_text('wp_button_bg_color', $button_bg_color);

                $product_banner_text_align = sanitize_text_field(wpbi_function()->post('product_banner_text_align'));
                wpbi_function()->update_text('product_banner_text_align', $product_banner_text_align);

                $product_banner_title_font_size = sanitize_text_field(wpbi_function()->post('product_banner_title_font_size'));
                wpbi_function()->update_text('product_banner_title_font_size', $product_banner_title_font_size);





                $button_bg_hover_color = sanitize_text_field(wpbi_function()->post('wp_close_button_hover_color'));
                wpbi_function()->update_text('wp_close_button_hover_color', $button_bg_hover_color);
            }
        }
    }
}

WPBI_Product_Banner_Image_Extensions::instance();
