<?php
namespace Banner_Image\Admin;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Product_Banner_Single_Page' ) ) {
    class Product_Banner_Single_Page {

        protected static $_instance = null;
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {
            add_filter( 'woocommerce_product_data_tabs', array($this, 'wp_banner_image_data_tab') );
            add_action( 'woocommerce_product_data_panels', array( $this, 'promotional_banner_image_data_fields' ) );
            add_action( 'woocommerce_process_product_meta',  array($this, 'save_banner_info_action'));
        }

        public function wp_banner_image_data_tab( $product_data_tabs ) {
            $product_data_tabs['product-banner-image'] = array(
                'label'     => __( 'Product Banner Image', 'banner-image-for-woocommerce' ),
                'target'    => 'banner_image_options',
                'class'     => array( 'show_if_simple' ),
            );
            return $product_data_tabs;
        }

        /*
        * Add BannerImage tab Content(Woocommerce).
        * Only show the fields under BannerImage Tab
        */
        function promotional_banner_image_data_fields($post_id){
            global $post;

            $var = get_post_meta($post->ID, 'wp_product_banner_image', true);
            $data_array = json_decode($var, true);

            $woocommerce_meta_field = array(

                // Enable Banner
                array(
                    'id'            => 'enable_banner_image[]',
                    'label'         => __('Enable Banner Image', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'checkbox',
                    'placeholder'   => __('Enable Banner Image', 'banner-image-for-woocommerce'),
                    'field_type'    => 'checkboxfield'
                ),

                // Banner Image
                array(
                    'id'            => 'product_banner_bg_image[]',
                    'label'         => __('Upload Banner Image', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'image',
                    'value'         => '',
                    'field_type'    => 'image'
                ),

                // Banner Sub Heading
                array(
                    'id'            => 'product_banner_subtitle[]',
                    'label'         => __('Banner Sub Heading', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write Banner Sub Heading', 'banner-image-for-woocommerce'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Banner Title
                array(
                    'id'            => 'product_banner_title[]',
                    'label'         => __('Banner Title', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write Banner Title', 'banner-image-for-woocommerce'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Short Description
                array(
                    'id'            => 'product_banner_description[]',
                    'label'         => __('Banner Short Description', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write short description', 'banner-image-for-woocommerce'),
                    'value'         => '',
                    'field_type'    => 'textareafield',
                ),

                // Button Name
                array(
                    'id'            => 'wp_banner_button_name[]',
                    'label'         => __('Button Name', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write Banner button Name', 'banner-image-for-woocommerce'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Banner URL
                array(
                    'id'            => 'wp_banner_button_url[]',
                    'label'         => __('Banner URL', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Add custom URL', 'banner-image-for-woocommerce'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Enable Banner
                array(
                    'id'            => 'enable_link_full_banner_image[]',
                    'label'         => __('Enable Link full Banner', 'banner-image-for-woocommerce'),
                    'desc_tip'      => 'true',
                    'type'          => 'checkbox',
                    'placeholder'   => __('Enable Link full Banner', 'banner-image-for-woocommerce'),
                    'field_type'    => 'checkboxfield'
                ),
            );
            ?>

            <div id='banner_image_options' class='panel woocommerce_options_panel'>
                <?php
                $display = 'block';
                $meta_count = is_array($data_array) ? count($data_array) : 0;
                $field_count = count($woocommerce_meta_field);
                if ( $meta_count > 0 ){ $display = 'none'; }

                /*
                * Print without value of BannerImage System for clone group
                */
                if( $meta_count == '0' ) {
                    echo "<div class='banner_image_wrap'>";
                    echo "<div class='banner_image_field_wrap'>";

                    foreach ($woocommerce_meta_field as $value) {
                        switch ($value['field_type']) {
                            case 'textareafield':
                                woocommerce_wp_textarea_input($value);
                                break;

                            case 'checkboxfield':
                                woocommerce_wp_checkbox($value);
                                break;

                            case 'image':
                                echo '<p class="form-field">';
                                echo '<label for="product_banner_bg_image">' . esc_attr($value["label"]) . '</label>';
                                echo '<input type="hidden" class="product_banner_bg_image" name="'.esc_attr($value['id']).'" value="" placeholder="'.esc_attr($value["label"]).'"/>';
                                echo '<span class="pbw-wrap-image-container"></span>';
                                echo '<button class="pbw-wrap-image-upload-btn button">'.esc_html__("Add Image", "banner-image-for-woocommerce").'</button>';
                                echo '</p>';
                                break;

                            default:
                                woocommerce_wp_text_input($value);
                                break;
                        }
                    }

                    echo "</div>";
                    echo "</div>";
                }

                /*
                * Print with value of BannerImage System
                */
                if ($meta_count > 0) {
                    if (is_array($data_array) && !empty($data_array)) {
                        foreach ($data_array as $k => $v) {
                            echo "<div class='banner_image_wrap Alex'>";
                            echo "<div class='banner_image_field_wrap'>";
                            foreach ($woocommerce_meta_field as $value) {
                                if(isset( $v[str_replace('[]', '', $value['id'])] )){
                                    $value['value'] = $v[str_replace('[]', '', $value['id'])];
                                }else{
                                    $value['value'] = '';
                                }
                                switch ($value['field_type']) {

                                    case 'textareafield':
                                        $value['value'] = wp_unslash($value['value']);
                                        woocommerce_wp_textarea_input($value);
                                        break;

                                    case 'checkboxfield':
                                        woocommerce_wp_checkbox($value);
                                        break;

                                    case 'image':
                                        $image_id = $value['value'];
                                        $raw_id = $image_id;
                                        if( $image_id!=0 && $image_id!='' ){
                                            $image_id = wp_get_attachment_url( $image_id );
                                            $image_id = '<img width="450" src="'.esc_url($image_id).'"><span class="pbw-wrap-image-remove">x</span>';
                                        }else{
                                            $image_id = '';
                                        }
                                        echo '<p class="form-field">';
                                        echo '<label for="product_banner_bg_image">'.esc_html($value["label"]).'</label>';
                                        echo '<input type="hidden" class="product_banner_bg_image" name="'.esc_attr($value["id"]).'" value="'.esc_attr($raw_id).'" placeholder="'.esc_attr($value["label"]).'"/>';
                                        echo '<span class="pbw-wrap-image-container">'.wp_kses_post($image_id).'</span>';
                                        echo '<button class="pbw-wrap-image-upload-btn button">'.esc_html__("Add Image", "banner-image-for-woocommerce").'</button>';
                                        echo '</p>';
                                        break;

                                    default:
                                        woocommerce_wp_text_input($value);
                                        break;
                                }
                            }
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
                ?>
            </div>

            <?php
        }

        /*
        * Save BannerImage tab Data(Woocommerce).
        * Update Post Meta for BannerImage Tab
        */
        function save_banner_info_action($post_id) {
            // Verify nonce for security
            if ( ! isset( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['woocommerce_meta_nonce'] ) ), 'woocommerce_meta_data' ) ) {
                return;
            }

            $data = array();

            // Helper function to sanitize POST array data
            $sanitize_post_array = function( $key, $sanitize_callback = 'sanitize_text_field', $default = array( '' ) ) {
                if ( isset( $_POST[$key] ) ) {
                    // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash -- wp_unslash is applied before array_map
                    // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized via array_map below
                    $post_data = wp_unslash( $_POST[$key] );
                    return array_map( $sanitize_callback, $post_data );
                }
                return $default;
            };

            // Sanitize all POST data with appropriate functions
            $enable_banner    = $sanitize_post_array( 'enable_banner_image', 'sanitize_text_field' );
            $banner_subtitle  = $sanitize_post_array( 'product_banner_subtitle', 'sanitize_text_field' );
            $banner_title     = $sanitize_post_array( 'product_banner_title', 'sanitize_text_field' );
            $description      = $sanitize_post_array( 'product_banner_description', 'sanitize_textarea_field' );
            $image_field      = $sanitize_post_array( 'product_banner_bg_image', 'absint', array( 0 ) );
            $button_name      = $sanitize_post_array( 'wp_banner_button_name', 'sanitize_text_field' );
            $button_url       = $sanitize_post_array( 'wp_banner_button_url', 'esc_url_raw' );
            $enable_link_banner = $sanitize_post_array( 'enable_link_full_banner_image', 'sanitize_text_field' );

            $data[] = array (
                'enable_banner_image'         => $enable_banner[0],
                'product_banner_subtitle'     => $banner_subtitle[0],
                'product_banner_title'        => $banner_title[0],
                'product_banner_description'  => $description[0],
                'product_banner_bg_image'     => $image_field[0],
                'wp_banner_button_name'       => $button_name[0],
                'wp_banner_button_url'        => $button_url[0],
                'enable_link_full_banner_image' => $enable_link_banner[0],
            );

            $data_json = json_encode( $data, JSON_UNESCAPED_UNICODE );
            banner_image_function()->update_meta($post_id, 'wp_product_banner_image', wp_slash($data_json));
        }

    } //End class bracket
}
