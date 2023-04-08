<?php
namespace WPBI\woocommerce;

class WPBI_Extensions {
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
                echo '<p>'.__( "Quick view data have been Saved.", "wcpb" ).'</p>';
            echo '</div>';
        } ?>

        <form id="wcpb" role="form" method="post" action="">
            <?php
            $arr =  array(
                array(
                    'type'      => 'seperator',
                    'label'     => __('Product Banner Image Settings', 'wcpb'),
                    'top_line'  => 'true',
                ),

                # Enable Product Banner
                array(
                    'id'        => 'enable_product_banner',
                    'type'      => 'checkbox',
                    'value'     => 'true',
                    'label'     => __('Enable Product Banner','wcpb'),
                    'desc'      => '<p>'.__('Enable Banner Image','wcpb').'</p>',
                ),

                # Banner Image
                array(
                    'id'        => 'wpbi_product_banner_image',
                    'type'      => 'image',
                    'value'     => 'true',
                    'label'     => __('Upload Banner Image','wcpb'),
                ),

                # Product Banner SubTitle
                array(
                    'id'        => 'product_banner_subtitle',
                    'label'     => __('Product Banner SubTitle','wcpb'),
                    'type'      => 'text', 
                    'value'     => '',
                    'desc'      => '<p>'.__('Write product page banner title', 'wcpb').'</p>',
                ),

                # Product Banner Title 
                array(
                    'id'        => 'product_banner_title',
                    'label'     => __('Product Banner Title','wcpb'),
                    'type'      => 'text', 
                    'value'     => '',
                    'desc'      => '<p>'.__('Write product page banner title', 'wcpb').'</p>',
                ),

                # Product Banner Short Description
                array(
                    'id'        => 'product_banner_short_text',
                    'label'     => __('Product Banner Short Description','wcpb'),
                    'type'      => 'text', 
                    'value'     => '',
                    'desc'      => '<p>'.__('Write product page banner title', 'wcpb').'</p>',
                ),

                # Product Banner Button Name
                array(
                    'id'        => 'product_banner_button_name',
                    'label'     => __('Product Banner Button Name','wcpb'),
                    'type'      => 'text', 
                    'value'     => '',
                    'desc'      => '<p>'.__('Write banner button name', 'wcpb').'</p>',
                ),

                # Product Banner Button URL
                array(
                    'id'        => 'product_banner_button_url',
                    'label'     => __('Product Banner Button URL','wcpb'),
                    'type'      => 'text', 
                    'value'     => '',
                    'desc'      => '<p>'.__('Add button URL', 'wcpb').'</p>',
                ),

                // #Style Seperator
                array(
                    'type'      => 'seperator',
                    'label'     => __('Style Settings','wcpb'),
                    'top_line'  => 'true',
                ),

                # Button Background Color
                array(
                    'id'        => 'wp_button_bg_color',
                    'type'      => 'color',
                    'label'     => __('Button BG Color','wcpb'),
                    'desc'      => __('Select button background color.','wcpb'),
                    'value'     => '#1adc68',
                ),

                # Close Button Color
                array(
                    'id'        => 'wp_close_button_color',
                    'type'      => 'color',
                    'label'     => __('Modal close button color','wcpb'),
                    'desc'      => __('Select quick view modal close button color.','wcpb'),
                    'value'     => '#2b74aa',
                ),

                # Modal close button hover color
                array(
                    'id'        => 'wp_close_button_hover_color',
                    'type'      => 'color',
                    'label'     => __('Modal close button hover color','wcpb'),
                    'desc'      => __('Select quick view modal close button hover color.','wcpb'),
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

                # Enable Banner
                $styling = sanitize_text_field(wpbi_function()->post('enable_product_banner'));
                wpbi_function()->update_checkbox( 'enable_product_banner', $styling);

                # Image
                $styling = sanitize_text_field(wpbi_function()->post('wpbi_product_banner_image'));
                wpbi_function()->update_checkbox( 'wpbi_product_banner_image', $styling);

                # Banner Title
                $product_status = sanitize_text_field(wpbi_function()->post('product_banner_title'));
                wpbi_function()->update_text('product_banner_title', $product_status);

                $banner_subtitle = sanitize_text_field(wpbi_function()->post('product_banner_subtitle'));
                wpbi_function()->update_text('product_banner_subtitle', $banner_subtitle);

                $short_text = sanitize_text_field(wpbi_function()->post('product_banner_short_text'));
                wpbi_function()->update_text('product_banner_short_text', $short_text);

                $button_name = sanitize_text_field(wpbi_function()->post('product_banner_button_name'));
                wpbi_function()->update_text('product_banner_button_name', $button_name);

                $button_url = sanitize_text_field(wpbi_function()->post('product_banner_button_url'));
                wpbi_function()->update_text('product_banner_button_url', $button_url);

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
WPBI_Extensions::instance();