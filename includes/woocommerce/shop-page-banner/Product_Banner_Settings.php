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
        add_action('admin_menu', array($this, 'wpbi_add_shop_banner_image'));
        add_action('admin_init', array($this, 'save_menu_settings' ));
    }

    public function wpbi_add_shop_banner_image(){
        add_submenu_page(
            'edit.php?post_type=product',
            __( 'Product Banner Image' ),
            __( 'Product Banner Image' ),
            'manage_woocommerce', // Required user capability
            'product-banner-image',
            array($this, 'generate_shop_page_banner_image')
        );
    }

    /**
     * Display a custom menu page
     */
    public function generate_shop_page_banner_image(){
        if (wpbi_function()->post('wp_settings_page_nonce_field')){
            echo '<div class="notice notice-success is-dismissible">';
                echo '<p>'.__( "Shop Page Banner Image data have been Saved.", "wcpb" ).'</p>';
            echo '</div>';
        }

        $default_file = WPBI_DIR_PATH.'includes/woocommerce/shop-page-banner/pages/general-settings.php';
        $style = WPBI_DIR_PATH.'includes/woocommerce/shop-page-banner/pages/style.php';

        // Settings Tab With slug and Display name
        $tabs = apply_filters('shop_banner_image_page_panel_tabs', array(
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
        echo '<h2 class="bannerimage-setting-title">'.__( "Shop Page Banner Image Settings", "wcpb" ).'</h2>';
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

            $current_tab = sanitize_text_field(wpbi_function()->post('wpbi_shop_general_settings_admin_tab'));
            $current_style_tab = sanitize_text_field(wpbi_function()->post('wpbi_shop_style_admin_tab'));

            /**
             * General Settings
             */
            if( ! empty($current_tab) ){
                # Enable Banner
                $enable_shop_page_banner = sanitize_text_field(wpbi_function()->post('enable_shop_page_banner'));
                wpbi_function()->update_checkbox( 'enable_shop_page_banner', $enable_shop_page_banner);

                # Image
                $shop_page_banner_image = sanitize_text_field(wpbi_function()->post('shop_page_banner_image'));
                wpbi_function()->update_checkbox( 'shop_page_banner_image', $shop_page_banner_image);

                # Sub heading
                $shop_page_banner_sub_heading = sanitize_text_field(wpbi_function()->post('shop_page_banner_sub_heading'));
                wpbi_function()->update_text('shop_page_banner_sub_heading', $shop_page_banner_sub_heading);
                
                # Banner Title
                $shop_page_banner_title = sanitize_text_field(wpbi_function()->post('shop_page_banner_title'));
                wpbi_function()->update_text('shop_page_banner_title', $shop_page_banner_title);

                # Shop page banner Shop description
                $shop_page_banner_short_desc = sanitize_text_field(wpbi_function()->post('shop_page_banner_short_desc'));
                wpbi_function()->update_text('shop_page_banner_short_desc', $shop_page_banner_short_desc);

                # Button Name
                $shop_page_banner_button_name = sanitize_text_field(wpbi_function()->post('shop_page_banner_button_name'));
                wpbi_function()->update_text('shop_page_banner_button_name', $shop_page_banner_button_name);

                # Button URL
                $shop_page_banner_button_url = sanitize_text_field(wpbi_function()->post('shop_page_banner_button_url'));
                wpbi_function()->update_text('shop_page_banner_button_url', $shop_page_banner_button_url);
            }

            /**
             * Style Settings
             */
            if( ! empty( $current_style_tab ) ) {

                $shop_page_banner_text_align = sanitize_text_field(wpbi_function()->post('shop_page_banner_text_align'));
                wpbi_function()->update_text('shop_page_banner_text_align', $shop_page_banner_text_align);

                $shop_page_banner_overlay_color = sanitize_text_field(wpbi_function()->post('shop_page_banner_overlay_color'));
                wpbi_function()->update_text('shop_page_banner_overlay_color', $shop_page_banner_overlay_color);

                $banner_image_overlay_opacity = sanitize_text_field(wpbi_function()->post('shop_page_banner_image_overlay_opacity'));
                wpbi_function()->update_text('shop_page_banner_image_overlay_opacity', $banner_image_overlay_opacity);





                // Banner Title
                $shop_banner_subtitle_color = sanitize_text_field(wpbi_function()->post('shop_banner_subtitle_color'));
                wpbi_function()->update_text('shop_banner_subtitle_color', $shop_banner_subtitle_color);

                $shop_banner_subtitle_font_size = sanitize_text_field(wpbi_function()->post('shop_banner_subtitle_font_size'));
                wpbi_function()->update_text('shop_banner_subtitle_font_size', $shop_banner_subtitle_font_size);

                $shop_banner_subtitle_font_weight = sanitize_text_field(wpbi_function()->post('shop_banner_subtitle_font_weight'));
                wpbi_function()->update_text('shop_banner_subtitle_font_weight', $shop_banner_subtitle_font_weight);

                $shop_banner_subtitle_line_height = sanitize_text_field(wpbi_function()->post('shop_banner_subtitle_line_height'));
                wpbi_function()->update_text('shop_banner_subtitle_line_height', $shop_banner_subtitle_line_height);



                // Banner Title
                $shop_banner_title_font_size = sanitize_text_field(wpbi_function()->post('shop_banner_title_font_size'));
                wpbi_function()->update_text('shop_banner_title_font_size', $shop_banner_title_font_size);

                $shop_banner_title_line_height = sanitize_text_field(wpbi_function()->post('shop_banner_title_line_height'));
                wpbi_function()->update_text('shop_banner_title_line_height', $shop_banner_title_line_height);

                $title_font_weight = sanitize_text_field(wpbi_function()->post('shop_banner_title_font_weight'));
                wpbi_function()->update_text('shop_banner_title_font_weight', $title_font_weight);

                $shop_banner_title_color = sanitize_text_field(wpbi_function()->post('shop_banner_title_color'));
                wpbi_function()->update_text('shop_banner_title_color', $shop_banner_title_color);

                // Short Description Style
                $shop_banner_desc_color = sanitize_text_field(wpbi_function()->post('shop_banner_desc_color'));
                wpbi_function()->update_text('shop_banner_desc_color', $shop_banner_desc_color);

                $shop_banner_desc_font_size = sanitize_text_field(wpbi_function()->post('shop_banner_desc_font_size'));
                wpbi_function()->update_text('shop_banner_desc_font_size', $shop_banner_desc_font_size);

                $shop_banner_desc_line_height = sanitize_text_field(wpbi_function()->post('shop_banner_desc_line_height'));
                wpbi_function()->update_text('shop_banner_desc_line_height', $shop_banner_desc_line_height);

                $desc_font_weight = sanitize_text_field(wpbi_function()->post('shop_banner_desc_font_weight'));
                wpbi_function()->update_text('shop_banner_desc_font_weight', $desc_font_weight);








                // Button Style
                $button_text_color = sanitize_text_field(wpbi_function()->post('shop_page_banner_button_text_color'));
                wpbi_function()->update_text('shop_page_banner_button_text_color', $button_text_color);

                $button_bg_color = sanitize_text_field(wpbi_function()->post('shop_page_banner_button_bg_color'));
                wpbi_function()->update_text('shop_page_banner_button_bg_color', $button_bg_color);

                $button_text_hover_color = sanitize_text_field(wpbi_function()->post('shop_page_banner_button_text_hover_color'));
                wpbi_function()->update_text('shop_page_banner_button_text_hover_color', $button_text_hover_color);

                $button_bg_hover_color = sanitize_text_field(wpbi_function()->post('shop_page_banner_button_bg_hover_color'));
                wpbi_function()->update_text('shop_page_banner_button_bg_hover_color', $button_bg_hover_color);

                $button_font_size = sanitize_text_field(wpbi_function()->post('shop_banner_button_font_size'));
                wpbi_function()->update_text('shop_banner_button_font_size', $button_font_size);

                $button_font_weight = sanitize_text_field(wpbi_function()->post('shop_banner_button_font_weight'));
                wpbi_function()->update_text('shop_banner_button_font_weight', $button_font_weight);

                $button_line_height = sanitize_text_field(wpbi_function()->post('shop_banner_button_line_height'));
                wpbi_function()->update_text('shop_banner_button_line_height', $button_line_height);
            }
        }
    }
}

WPBI_Product_Banner_Image_Extensions::instance();
