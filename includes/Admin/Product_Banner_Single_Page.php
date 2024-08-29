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
                'label'     => __( 'Product Banner Image', 'banner-image' ),
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
                    'label'         => __('Enable Banner Image', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'checkbox',
                    'placeholder'   => __('Enable Banner Image', 'banner-image'),
                    'field_type'    => 'checkboxfield'
                ),

                // Banner Image
                array(
                    'id'            => 'product_banner_bg_image[]',
                    'label'         => __('Upload Banner Image', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'image',
                    'value'         => '',
                    'field_type'    => 'image'
                ),

                // Banner Sub Heading
                array(
                    'id'            => 'product_banner_subtitle[]',
                    'label'         => __('Banner Sub Heading', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write Banner Sub Heading', 'banner-image'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Banner Title
                array(
                    'id'            => 'product_banner_title[]',
                    'label'         => __('Banner Title', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write Banner Title', 'banner-image'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Short Description
                array(
                    'id'            => 'product_banner_description[]',
                    'label'         => __('Banner Short Description', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write short description', 'banner-image'),
                    'value'         => '',
                    'field_type'    => 'textareafield',
                ),

                // Button Name
                array(
                    'id'            => 'wp_banner_button_name[]',
                    'label'         => __('Button Name', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Write Banner button Name', 'banner-image'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Banner URL
                array(
                    'id'            => 'wp_banner_button_url[]',
                    'label'         => __('Banner URL', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'text',
                    'placeholder'   => __('Add custom URL', 'banner-image'),
                    'value'         => '',
                    'field_type'    => 'textfield',
                ),

                // Enable Banner
                array(
                    'id'            => 'enable_link_full_banner_image[]',
                    'label'         => __('Enable Link full Banner', 'banner-image'),
                    'desc_tip'      => 'true',
                    'type'          => 'checkbox',
                    'placeholder'   => __('Enable Link full Banner', 'banner-image'),
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
                                echo '<button class="pbw-wrap-image-upload-btn button">'.__("Add Image", "banner-image").'</button>';
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
                                            $image_id = '<img width="450" src="'.$image_id.'"><span class="pbw-wrap-image-remove">x</span>';
                                        }else{
                                            $image_id = '';
                                        }
                                        echo '<p class="form-field">';
                                        echo '<label for="product_banner_bg_image">'.$value["label"].'</label>';
                                        echo '<input type="hidden" class="product_banner_bg_image" name="'.$value["id"].'" value="'.$raw_id.'" placeholder="'.$value["label"].'"/>';
                                        echo '<span class="pbw-wrap-image-container">'.$image_id.'</span>';
                                        echo '<button class="pbw-wrap-image-upload-btn button">'.__("Add Image", "banner-image").'</button>';
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
            $data             = array();

            $enable_banner    = $_POST['enable_banner_image'];
            $banner_subtitle  = $_POST['product_banner_subtitle'];
            $banner_title     = $_POST['product_banner_title'];
            $description      = $_POST['product_banner_description'];
            $image_field      = $_POST['product_banner_bg_image'];
            $button_name      = $_POST['wp_banner_button_name'];
            $button_url       = $_POST['wp_banner_button_url'];
            $enable_link_banner = $_POST['enable_link_full_banner_image'];

            $data[] = array (
                'enable_banner_image'       => $enable_banner[0],
                'product_banner_subtitle'   => $banner_subtitle[0],
                'product_banner_title'      => $banner_title[0],
                'product_banner_description' => $description[0],
                'product_banner_bg_image'   => intval($image_field[0]),
                'wp_banner_button_name'     => $button_name[0],
                'wp_banner_button_url'      => $button_url[0],
                'enable_link_full_banner_image' => $enable_link_banner[0],
            );

            $data_json = json_encode( $data, JSON_UNESCAPED_UNICODE );
            banner_image_function()->update_meta($post_id, 'wp_product_banner_image', wp_slash($data_json));
        }

    } //End class bracket
}
