<?php

namespace Banner_Image\Admin;

class Shop_Page_Content {

    public function Shop_Page_Banner() {
        if (banner_image_function()->post('wp_settings_page_nonce_field')) {
            echo '<div class="notice notice-success is-dismissible">';
                echo '<p>' . esc_html__("Data have been Saved.", "banner-image") . '</p>';
            echo '</div>';
        }

        $default_file = Banner_Image_PATH . '/includes/settings/shop-page-settings/general-settings.php';
        $style = Banner_Image_PATH . '/includes/settings/shop-page-settings/styles.php';

        $tabs = apply_filters('bifw_bifw_shop_banner_image_page_panel_tabs',
            array(
                'general_settings' => array(
                    'tab_name' => __('General Settings', 'banner-image'),
                    'load_form_file' => $default_file
                ),
                'banner_style' => array(
                    'tab_name' => __('Style', 'banner-image'),
                    'load_form_file' => $style
                )
            )
        );

        $allowed_files = array(
            realpath($default_file),
            realpath($style)
        );

        $current_page = 'general_settings';

        if (!empty($_GET['tab'])) {
            $current_page = sanitize_text_field($_GET['tab']);
        }

        echo '<h2 class="bannerimage-setting-title">' . esc_html__("Shop Page Banner Image Settings", "banner-image") . '</h2>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach ($tabs as $tab => $name) {
            $class = ($tab == $current_page) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='" . esc_url(admin_url('admin.php?page=biw-menu&tab=' . $tab)) . "'>" . esc_html($name['tab_name']) . "</a>";
        }
        echo '</h2>'; ?>

        <form id="biw-form" role="form" method="post" action="">
            <?php
                $request_file = realpath($tabs[$current_page]['load_form_file']);

                if (in_array($request_file, $allowed_files, true)) {
                    include_once $request_file;
                } else {
                    include_once realpath($default_file);
                }

                wp_nonce_field('wp_settings_page_action', 'wp_settings_page_nonce_field');
                submit_button(null, 'primary', 'wp_admin_settings_submit_btn');
            ?>
        </form>
    <?php
    }

    public function Shop_Page_Banner_Save() {
        if (banner_image_function()->post('wp_settings_page_nonce_field') && wp_verify_nonce( sanitize_text_field(banner_image_function()->post('wp_settings_page_nonce_field')), 'wp_settings_page_action' ) ) {
            $current_tab = sanitize_text_field(banner_image_function()->post('biw_general_settings_admin_tab'));
            $current_style_tab = sanitize_text_field(banner_image_function()->post('biw_shop_style_admin_tab'));

            /**
             * General Settings
             */
            if( ! empty($current_tab) ){
                # Enable Banner
                $enable_shop_page_banner = sanitize_text_field(banner_image_function()->post('enable_shop_page_banner'));
                banner_image_function()->update_checkbox( 'enable_shop_page_banner', $enable_shop_page_banner);

                # Image
                $shop_page_banner_image = sanitize_text_field(banner_image_function()->post('shop_page_banner_image'));
                banner_image_function()->update_checkbox( 'shop_page_banner_image', $shop_page_banner_image);

                # Sub heading
                $shop_page_banner_sub_heading = sanitize_text_field(banner_image_function()->post('shop_page_banner_sub_heading'));
                banner_image_function()->update_text('shop_page_banner_sub_heading', $shop_page_banner_sub_heading);

                # Banner Title
                $shop_page_banner_title = sanitize_text_field(banner_image_function()->post('shop_page_banner_title'));
                banner_image_function()->update_text('shop_page_banner_title', $shop_page_banner_title);

                # Shop page banner Shop description
                $shop_page_banner_short_desc = sanitize_text_field(banner_image_function()->post('shop_page_banner_short_desc'));
                banner_image_function()->update_text('shop_page_banner_short_desc', $shop_page_banner_short_desc);

                # Button Name
                $shop_page_banner_button_name = sanitize_text_field(banner_image_function()->post('shop_page_banner_button_name'));
                banner_image_function()->update_text('shop_page_banner_button_name', $shop_page_banner_button_name);

                # Button URL
                $shop_page_banner_button_url = sanitize_text_field(banner_image_function()->post('shop_page_banner_button_url'));
                banner_image_function()->update_text('shop_page_banner_button_url', $shop_page_banner_button_url);

                # Enable Link Full Banner
                $enable_link_full_banner = sanitize_text_field(banner_image_function()->post('enable_link_full_banner'));
                banner_image_function()->update_text('enable_link_full_banner', $enable_link_full_banner);
            }

            /**
             * Style Settings
             */
            if( ! empty( $current_style_tab ) ) {

                $shop_page_banner_text_align = sanitize_text_field(banner_image_function()->post('shop_page_banner_text_align'));
                banner_image_function()->update_text('shop_page_banner_text_align', $shop_page_banner_text_align);

                $shop_banner_image_height = sanitize_text_field(banner_image_function()->post('shop_banner_image_height'));
                banner_image_function()->update_text('shop_banner_image_height', $shop_banner_image_height);

                /*
                * Banner SubTitle Style
                * */
                $shop_banner_subtitle_color = sanitize_text_field(banner_image_function()->post('shop_banner_subtitle_color'));
                banner_image_function()->update_text('shop_banner_subtitle_color', $shop_banner_subtitle_color);

                $shop_banner_subtitle_font_size = sanitize_text_field(banner_image_function()->post('shop_banner_subtitle_font_size'));
                banner_image_function()->update_text('shop_banner_subtitle_font_size', $shop_banner_subtitle_font_size);

                $shop_banner_subtitle_font_weight = sanitize_text_field(banner_image_function()->post('shop_banner_subtitle_font_weight'));
                banner_image_function()->update_text('shop_banner_subtitle_font_weight', $shop_banner_subtitle_font_weight);

                $shop_banner_subtitle_line_height = sanitize_text_field(banner_image_function()->post('shop_banner_subtitle_line_height'));
                banner_image_function()->update_text('shop_banner_subtitle_line_height', $shop_banner_subtitle_line_height);

                /*
                * Banner Title
                * */
                $shop_banner_title_font_size = sanitize_text_field(banner_image_function()->post('shop_banner_title_font_size'));
                banner_image_function()->update_text('shop_banner_title_font_size', $shop_banner_title_font_size);

                $shop_banner_title_line_height = sanitize_text_field(banner_image_function()->post('shop_banner_title_line_height'));
                banner_image_function()->update_text('shop_banner_title_line_height', $shop_banner_title_line_height);

                $title_font_weight = sanitize_text_field(banner_image_function()->post('shop_banner_title_font_weight'));
                banner_image_function()->update_text('shop_banner_title_font_weight', $title_font_weight);

                $shop_banner_title_color = sanitize_text_field(banner_image_function()->post('shop_banner_title_color'));
                banner_image_function()->update_text('shop_banner_title_color', $shop_banner_title_color);

                /*
                * Short Description Style
                * */
                $shop_banner_desc_color = sanitize_text_field(banner_image_function()->post('shop_banner_desc_color'));
                banner_image_function()->update_text('shop_banner_desc_color', $shop_banner_desc_color);

                $shop_banner_desc_font_size = sanitize_text_field(banner_image_function()->post('shop_banner_desc_font_size'));
                banner_image_function()->update_text('shop_banner_desc_font_size', $shop_banner_desc_font_size);

                $shop_banner_desc_line_height = sanitize_text_field(banner_image_function()->post('shop_banner_desc_line_height'));
                banner_image_function()->update_text('shop_banner_desc_line_height', $shop_banner_desc_line_height);

                $desc_font_weight = sanitize_text_field(banner_image_function()->post('shop_banner_desc_font_weight'));
                banner_image_function()->update_text('shop_banner_desc_font_weight', $desc_font_weight);

                /*
                * Button Style
                * */
                $button_text_color = sanitize_text_field(banner_image_function()->post('shop_page_banner_button_text_color'));
                banner_image_function()->update_text('shop_page_banner_button_text_color', $button_text_color);

                $button_bg_color = sanitize_text_field(banner_image_function()->post('shop_page_banner_button_bg_color'));
                banner_image_function()->update_text('shop_page_banner_button_bg_color', $button_bg_color);

                $button_text_hover_color = sanitize_text_field(banner_image_function()->post('shop_page_banner_button_text_hover_color'));
                banner_image_function()->update_text('shop_page_banner_button_text_hover_color', $button_text_hover_color);

                $button_bg_hover_color = sanitize_text_field(banner_image_function()->post('shop_page_banner_button_bg_hover_color'));
                banner_image_function()->update_text('shop_page_banner_button_bg_hover_color', $button_bg_hover_color);

                $button_font_size = sanitize_text_field(banner_image_function()->post('shop_banner_button_font_size'));
                banner_image_function()->update_text('shop_banner_button_font_size', $button_font_size);

                $button_font_weight = sanitize_text_field(banner_image_function()->post('shop_banner_button_font_weight'));
                banner_image_function()->update_text('shop_banner_button_font_weight', $button_font_weight);

                $button_line_height = sanitize_text_field(banner_image_function()->post('shop_banner_button_line_height'));
                banner_image_function()->update_text('shop_banner_button_line_height', $button_line_height);

                $button_padding = sanitize_text_field(banner_image_function()->post('shop_banner_button_padding'));
                banner_image_function()->update_text('shop_banner_button_padding', $button_padding);

                $button_margin = sanitize_text_field(banner_image_function()->post('shop_banner_button_margin'));
                banner_image_function()->update_text('shop_banner_button_margin', $button_margin);
            }
        }
    }
}
