<?php

namespace Banner_Image\Admin;

class Category_Page_Settings {
    public function Category_Page_Banner() {
        if (banner_image_function()->post('wp_settings_page_nonce_field')) {
            echo '<div class="notice notice-success is-dismissible">';
                echo '<p>' . esc_html__("Data have been Saved.", "banner-image") . '</p>';
            echo '</div>';
        }

        $default_file = Banner_Image_PATH . '/includes/settings/category-page-settings/general-settings.php';
        $style = Banner_Image_PATH . '/includes/settings/category-page-settings/styles.php';

        $tabs = apply_filters('bifw_bifw_shop_banner_image_page_panel_tabs',
            array(
                'general_settings' => array(
                    'tab_name' => __('General Settings','banner-image'),
                    'load_form_file' => $default_file
                ),
                'banner_style' => array(
                    'tab_name' => __('Style','banner-image'),
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

        echo '<h2 class="bannerimage-setting-title">' . esc_html__("Category Page Banner Image Settings", "banner-image") . '</h2>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach ($tabs as $tab => $name) {
            $class = ($tab == $current_page) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='" . esc_url(admin_url('admin.php?page=biw-product-category&tab=' . $tab)) . "'>" . esc_html($name['tab_name']) . "</a>";
        }
        echo '</h2>'; ?>

        <form id="biw-form" role="form" method="post" action="">
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

    public function Category_Page_Banner_Save() {
        if (banner_image_function()->post('wp_settings_page_nonce_field') &&
        wp_verify_nonce( sanitize_text_field(banner_image_function()->post('wp_settings_page_nonce_field')), 'wp_settings_page_action' )
        ) {
            $current_tab = sanitize_text_field(banner_image_function()->post('biw_category_settings_admin_tab'));
            $current_style_tab = sanitize_text_field(banner_image_function()->post('biw_category_style_admin_tab'));

            /**
             * General Settings
             */
            if( ! empty($current_tab) ){
                # Enable Banner
                $enable_category_page_banner = sanitize_text_field(banner_image_function()->post('enable_category_page_banner'));
                banner_image_function()->update_checkbox( 'enable_category_page_banner', $enable_category_page_banner);
            }

            /**
             * Style Settings
             */
            if( ! empty( $current_style_tab ) ) {

                $category_banner_text_align = sanitize_text_field(banner_image_function()->post('category_banner_text_align'));
                banner_image_function()->update_text('category_banner_text_align', $category_banner_text_align);

                $category_banner_height = sanitize_text_field(banner_image_function()->post('category_banner_height'));
                banner_image_function()->update_text('category_banner_height', $category_banner_height);

                /*
                * Banner SubTitle Style
                * */
                $category_banner_subtitle_color = sanitize_text_field(banner_image_function()->post('category_banner_subtitle_color'));
                banner_image_function()->update_text('category_banner_subtitle_color', $category_banner_subtitle_color);

                $category_banner_subtitle_fontsize = sanitize_text_field(banner_image_function()->post('category_banner_subtitle_fontsize'));
                banner_image_function()->update_text('category_banner_subtitle_fontsize', $category_banner_subtitle_fontsize);

                $category_banner_subtitle_fontweight = sanitize_text_field(banner_image_function()->post('category_banner_subtitle_fontweight'));
                banner_image_function()->update_text('category_banner_subtitle_fontweight', $category_banner_subtitle_fontweight);

                $category_banner_subtitle_lineheight = sanitize_text_field(banner_image_function()->post('category_banner_subtitle_lineheight'));
                banner_image_function()->update_text('category_banner_subtitle_lineheight', $category_banner_subtitle_lineheight);

                /*
                * Banner Title
                * */
                $category_banner_title_fontsize = sanitize_text_field(banner_image_function()->post('category_banner_title_fontsize'));
                banner_image_function()->update_text('category_banner_title_fontsize', $category_banner_title_fontsize);

                $category_banner_title_lineheight = sanitize_text_field(banner_image_function()->post('category_banner_title_lineheight'));
                banner_image_function()->update_text('category_banner_title_lineheight', $category_banner_title_lineheight);

                $category_banner_title_fontweight = sanitize_text_field(banner_image_function()->post('category_banner_title_fontweight'));
                banner_image_function()->update_text('category_banner_title_fontweight', $category_banner_title_fontweight);

                $category_banner_title_color = sanitize_text_field(banner_image_function()->post('category_banner_title_color'));
                banner_image_function()->update_text('category_banner_title_color', $category_banner_title_color);

                /*
                * Short Description Style
                * */
                $category_banner_desc_color = sanitize_text_field(banner_image_function()->post('category_banner_desc_color'));
                banner_image_function()->update_text('category_banner_desc_color', $category_banner_desc_color);

                $category_banner_desc_fontsize = sanitize_text_field(banner_image_function()->post('category_banner_desc_fontsize'));
                banner_image_function()->update_text('category_banner_desc_fontsize', $category_banner_desc_fontsize);

                $category_banner_desc_lineheight = sanitize_text_field(banner_image_function()->post('category_banner_desc_lineheight'));
                banner_image_function()->update_text('category_banner_desc_lineheight', $category_banner_desc_lineheight);

                $category_banner_desc_fontweight = sanitize_text_field(banner_image_function()->post('category_banner_desc_fontweight'));
                banner_image_function()->update_text('category_banner_desc_fontweight', $category_banner_desc_fontweight);

                /*
                * Button Style
                * */
                $category_banner_button_text_color = sanitize_text_field(banner_image_function()->post('category_banner_button_text_color'));
                banner_image_function()->update_text('category_banner_button_text_color', $category_banner_button_text_color);

                $category_banner_button_bg_color = sanitize_text_field(banner_image_function()->post('category_banner_button_bg_color'));
                banner_image_function()->update_text('category_banner_button_bg_color', $category_banner_button_bg_color);

                $category_banner_button_text_hover_color = sanitize_text_field(banner_image_function()->post('category_banner_button_text_hover_color'));
                banner_image_function()->update_text('category_banner_button_text_hover_color', $category_banner_button_text_hover_color);

                $category_banner_button_bg_hover_color = sanitize_text_field(banner_image_function()->post('category_banner_button_bg_hover_color'));
                banner_image_function()->update_text('category_banner_button_bg_hover_color', $category_banner_button_bg_hover_color);

                $category_banner_button_fontsize = sanitize_text_field(banner_image_function()->post('category_banner_button_fontsize'));
                banner_image_function()->update_text('category_banner_button_fontsize', $category_banner_button_fontsize);

                $category_banner_button_fontweight = sanitize_text_field(banner_image_function()->post('category_banner_button_fontweight'));
                banner_image_function()->update_text('category_banner_button_fontweight', $category_banner_button_fontweight);

                $category_banner_button_lineheight = sanitize_text_field(banner_image_function()->post('category_banner_button_lineheight'));
                banner_image_function()->update_text('category_banner_button_lineheight', $category_banner_button_lineheight);

                $category_banner_button_padding = sanitize_text_field(banner_image_function()->post('category_banner_button_padding'));
                banner_image_function()->update_text('category_banner_button_padding', $category_banner_button_padding);

                $category_banner_button_margin = sanitize_text_field(banner_image_function()->post('category_banner_button_margin'));
                banner_image_function()->update_text('category_banner_button_margin', $category_banner_button_margin);
            }
        }
    }
}
