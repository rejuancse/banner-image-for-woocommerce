<?php

namespace Banner_Image\Admin;

class Product_Single_Page_Settings {
    public function Product_Single_Page_Banner() {
        if (banner_image_function()->post('wp_settings_page_nonce_field')) {
            echo '<div class="notice notice-success is-dismissible">';
                echo '<p>' . esc_html__("Data have been Saved.", "banner-image") . '</p>';
            echo '</div>';
        }

        $style = Banner_Image_PATH . '/includes/settings/product-single-page-settings/styles.php';

        $tabs = apply_filters('single_banner_image_page_panel_tabs',
            array(
                'banner_style' => array(
                    'tab_name' => __( 'Style', 'banner-image' ),
                    'load_form_file' => $style
                )
            )
        );

        $allowed_files = array(
            realpath($style)
        );

        $current_page = 'banner_style';

        if (!empty($_GET['tab'])) {
            $current_page = sanitize_text_field($_GET['tab']);
        }

        echo '<h2 class="bannerimage-setting-title">' . esc_html__("Product Single Page Banner Style", "banner-image") . '</h2>';
        ?>

        <form id="promotionalbanner-form" role="form" method="post" action="">
            <?php
                $request_file = realpath($tabs[$current_page]['load_form_file']);

                if (in_array($request_file, $allowed_files, true)) {
                    include_once $request_file;
                } else {
                    include_once $default_file;
                }

                wp_nonce_field('wp_settings_page_action', 'wp_settings_page_nonce_field');
                submit_button(null, 'primary', 'wp_admin_settings_submit_btn');
            ?>
        </form>
    <?php
    }

    public function Product_Single_Page_Banner_Save() {
        if (banner_image_function()->post('wp_settings_page_nonce_field') && wp_verify_nonce( sanitize_text_field(banner_image_function()->post('wp_settings_page_nonce_field')), 'wp_settings_page_action' ) ) {
            $current_style_tab = sanitize_text_field(banner_image_function()->post('promotionalbanner_product_single_style_admin_tab'));

            /**
             * Style Settings
             */
            if( ! empty( $current_style_tab ) ) {

                $product_single_page_banner_text_align = sanitize_text_field(banner_image_function()->post('product_single_page_banner_text_align'));
                banner_image_function()->update_text('product_single_page_banner_text_align', $product_single_page_banner_text_align);

                $product_single_banner_image_height = sanitize_text_field(banner_image_function()->post('product_single_banner_image_height'));
                banner_image_function()->update_text('product_single_banner_image_height', $product_single_banner_image_height);

                /*
                * Banner SubTitle Style
                * */
                $product_single_banner_subtitle_color = sanitize_text_field(banner_image_function()->post('product_single_banner_subtitle_color'));
                banner_image_function()->update_text('product_single_banner_subtitle_color', $product_single_banner_subtitle_color);

                $product_single_banner_subtitle_font_size = sanitize_text_field(banner_image_function()->post('product_single_banner_subtitle_font_size'));
                banner_image_function()->update_text('product_single_banner_subtitle_font_size', $product_single_banner_subtitle_font_size);

                $product_single_banner_subtitle_font_weight = sanitize_text_field(banner_image_function()->post('product_single_banner_subtitle_font_weight'));
                banner_image_function()->update_text('product_single_banner_subtitle_font_weight', $product_single_banner_subtitle_font_weight);

                $product_single_banner_subtitle_line_height = sanitize_text_field(banner_image_function()->post('product_single_banner_subtitle_line_height'));
                banner_image_function()->update_text('product_single_banner_subtitle_line_height', $product_single_banner_subtitle_line_height);

                /*
                * Banner Title
                * */
                $product_single_banner_title_font_size = sanitize_text_field(banner_image_function()->post('product_single_banner_title_font_size'));
                banner_image_function()->update_text('product_single_banner_title_font_size', $product_single_banner_title_font_size);

                $product_single_banner_title_line_height = sanitize_text_field(banner_image_function()->post('product_single_banner_title_line_height'));
                banner_image_function()->update_text('product_single_banner_title_line_height', $product_single_banner_title_line_height);

                $title_font_weight = sanitize_text_field(banner_image_function()->post('product_single_banner_title_font_weight'));
                banner_image_function()->update_text('product_single_banner_title_font_weight', $title_font_weight);

                $product_single_banner_title_color = sanitize_text_field(banner_image_function()->post('product_single_banner_title_color'));
                banner_image_function()->update_text('product_single_banner_title_color', $product_single_banner_title_color);

                /*
                * Short Description Style
                * */
                $product_single_banner_desc_color = sanitize_text_field(banner_image_function()->post('product_single_banner_desc_color'));
                banner_image_function()->update_text('product_single_banner_desc_color', $product_single_banner_desc_color);

                $product_single_banner_desc_font_size = sanitize_text_field(banner_image_function()->post('product_single_banner_desc_font_size'));
                banner_image_function()->update_text('product_single_banner_desc_font_size', $product_single_banner_desc_font_size);

                $product_single_banner_desc_line_height = sanitize_text_field(banner_image_function()->post('product_single_banner_desc_line_height'));
                banner_image_function()->update_text('product_single_banner_desc_line_height', $product_single_banner_desc_line_height);

                $desc_font_weight = sanitize_text_field(banner_image_function()->post('product_single_banner_desc_font_weight'));
                banner_image_function()->update_text('product_single_banner_desc_font_weight', $desc_font_weight);

                /*
                * Button Style
                * */
                $button_text_color = sanitize_text_field(banner_image_function()->post('product_single_page_banner_button_text_color'));
                banner_image_function()->update_text('product_single_page_banner_button_text_color', $button_text_color);

                $button_bg_color = sanitize_text_field(banner_image_function()->post('product_single_page_banner_button_bg_color'));
                banner_image_function()->update_text('product_single_page_banner_button_bg_color', $button_bg_color);

                $button_text_hover_color = sanitize_text_field(banner_image_function()->post('product_single_page_banner_button_text_hover_color'));
                banner_image_function()->update_text('product_single_page_banner_button_text_hover_color', $button_text_hover_color);

                $button_bg_hover_color = sanitize_text_field(banner_image_function()->post('product_single_page_banner_button_bg_hover_color'));
                banner_image_function()->update_text('product_single_page_banner_button_bg_hover_color', $button_bg_hover_color);

                $button_font_size = sanitize_text_field(banner_image_function()->post('product_single_banner_button_font_size'));
                banner_image_function()->update_text('product_single_banner_button_font_size', $button_font_size);

                $button_font_weight = sanitize_text_field(banner_image_function()->post('product_single_banner_button_font_weight'));
                banner_image_function()->update_text('product_single_banner_button_font_weight', $button_font_weight);

                $button_line_height = sanitize_text_field(banner_image_function()->post('product_single_banner_button_line_height'));
                banner_image_function()->update_text('product_single_banner_button_line_height', $button_line_height);

                $button_padding = sanitize_text_field(banner_image_function()->post('product_single_banner_button_padding'));
                banner_image_function()->update_text('product_single_banner_button_padding', $button_padding);

                $button_margin = sanitize_text_field(banner_image_function()->post('product_single_banner_button_margin'));
                banner_image_function()->update_text('product_single_banner_button_margin', $button_margin);
            }
        }
    }
}
