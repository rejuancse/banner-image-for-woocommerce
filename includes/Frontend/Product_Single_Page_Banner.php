<?php

namespace Banner_Image\Frontend;

class Product_Single_Page_Banner {

    public function __construct() {
        add_action( 'woocommerce_before_single_product', array($this, 'banner_image_callback_func'));
        add_action( 'wp_enqueue_scripts', array( $this, 'product_single_page_banner_activation_css' ) );
    }

    public function banner_image_callback_func() {
        global $post;

        $wp_banner_image   = get_post_meta($post->ID, 'wp_product_banner_image', true);
        $banner_info = json_decode($wp_banner_image, true); ?>

        <?php
        if (is_array($banner_info)) {
            if (count($banner_info) > 0) {
                foreach ($banner_info as $value) {
                    if( $value['enable_banner_image'] == 'yes' ) { ?>
                        <div class="is-layout-constrained product-single-page">
                            <?php if( !empty( $value['wp_banner_button_url'] ) && $value['enable_link_full_banner_image'] == 'yes') { ?>
                                <a href="<?php echo esc_url($value['wp_banner_button_url']); ?>" class="pbw-wrap-full-banner-link alignwide">
                            <?php } ?>

                                <div class="product-single-page-banner-image alignwide" style="background-image: url(<?php echo !empty($value['product_banner_bg_image']) ? wp_get_attachment_url( $value["product_banner_bg_image"] ) : ''; ?>); background-repeat: no-repeat; background-size: cover;">
                                    <div class="banner-content">
                                        <?php if( !empty( $value['product_banner_subtitle'] ) ) { ?>
                                            <span><?php echo esc_html($value['product_banner_subtitle']); ?></span>
                                        <?php } ?>

                                        <?php if( !empty( $value['product_banner_title'] ) ) { ?>
                                            <h2><?php echo esc_html( $value['product_banner_title'] ); ?></h2>
                                        <?php } ?>

                                        <?php if( !empty( $value['product_banner_description'] ) ) { ?>
                                            <?php echo wpautop(wp_unslash($value['product_banner_description'])); ?>
                                        <?php } ?>

                                        <?php if( !empty( $value['wp_banner_button_name'] ) && $value['enable_link_full_banner_image'] !== 'yes' ) { ?>
                                            <a href="<?php echo esc_url($value['wp_banner_button_url']); ?>">
                                                <?php echo $value['wp_banner_button_name']; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php if( !empty( $value['wp_banner_button_url'] ) && $value['enable_link_full_banner_image'] == 'yes') { ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php
                    }
                }
            }
        } ?>

        <div style="clear: both"></div>

        <?php
    }


    public function product_single_page_banner_activation_css() {
        $text_align = get_option( 'product_single_page_banner_text_align', 'left' );
        $banner_height = get_option( 'product_single_banner_image_height', '280' );

        // Title
        $title_color = get_option( 'product_single_banner_title_color', '#000' );
        $title_font_size = get_option( 'product_single_banner_title_font_size', '48' );
        $title_line_weight = get_option( 'product_single_banner_title_font_weight', '700' );
        $title_line_height = get_option( 'product_single_banner_title_line_height', '50' );

        // Sub Title
        $subtitle_color = get_option( 'product_single_banner_subtitle_color', '#000' );
        $subtitle_font_size = get_option( 'product_single_banner_subtitle_font_size', '18' );
        $subtitle_line_weight = get_option( 'product_single_banner_subtitle_font_weight', '400' );
        $subtitle_line_height = get_option( 'product_single_banner_subtitle_line_height', '20' );

        // Short Description
        $desc_color = get_option( 'product_single_banner_desc_color', '#333333' );
        $desc_font_size = get_option( 'product_single_banner_desc_font_size', '18' );
        $desc_line_weight = get_option( 'product_single_banner_desc_font_weight', '400' );
        $desc_line_height = get_option( 'product_single_banner_desc_line_height', '24' );

        // Button
        $button_text_color = get_option( 'product_single_page_banner_button_text_color', '#ffffff' );
        $button_bg_color = get_option( 'product_single_page_banner_button_bg_color', '#000000' );
        $button_text_hover_color = get_option( 'product_single_page_banner_button_text_hover_color', '#ffffff' );
        $button_bg_hover_color = get_option( 'product_single_page_banner_button_bg_hover_color', '#000000' );
        $button_font_size = get_option( 'product_single_banner_button_font_size', '18' );
        $button_font_weight = get_option( 'product_single_banner_button_font_weight', '400' );
        $button_line_height = get_option( 'product_single_banner_button_line_height', '28' );
        $button_button_padding = get_option( 'product_single_banner_button_padding', '10px 30px' );
        $button_button_margin = get_option( 'product_single_banner_button_margin', '0' );

        // Register and enqueue the stylesheet
        wp_register_style('single-page-banner-image', Banner_Image_URL . '/assets/css/single-page-banner-image.css', false, Banner_Image_VERSION);
        wp_enqueue_style('single-page-banner-image');

        $custom_css = "
            .product-single-page-banner-image {
                justify-content: " . (!empty($text_align) ? esc_attr($text_align) : 'left') . ";
                text-align: " . (!empty($text_align) ? esc_attr($text_align) : 'left') . ";
                height: " . (!empty($banner_height) ? esc_attr($banner_height) . 'px' : '380px') . ";
            }

            /* Sub Title Color */
            .product-single-page-banner-image .banner-content span {
                color: " . (!empty($subtitle_color) ? esc_attr($subtitle_color) : '#000000') . ";
                font-size: " . (!empty($subtitle_font_size) ? esc_attr($subtitle_font_size) . 'px' : '20px') . ";
                line-height: " . (!empty($subtitle_line_height) ? esc_attr($subtitle_line_height) . 'px' : '22px') . ";
                font-weight: " . (!empty($subtitle_line_weight) ? esc_attr($subtitle_line_weight) : '400') . ";
            }

            /* Title Color */
            .product-single-page-banner-image .banner-content h2 {
                color: " . (!empty($title_color) ? esc_attr($title_color) : '#000000') . ";
                font-size: " . (!empty($title_font_size) ? esc_attr($title_font_size) . 'px' : '48px') . ";
                line-height: " . (!empty($title_line_height) ? esc_attr($title_line_height) . 'px' : '50px') . ";
                font-weight: " . (!empty($title_line_weight) ? esc_attr($title_line_weight) : '700') . ";
            }

            .product-single-page-banner-image .banner-content p {
                color: " . (!empty($desc_color) ? esc_attr($desc_color) : '#000000') . ";
                font-size: " . (!empty($desc_font_size) ? esc_attr($desc_font_size) . 'px' : '18px') . ";
                line-height: " . (!empty($desc_line_height) ? esc_attr($desc_line_height) . 'px' : '20px') . ";
                font-weight: " . (!empty($desc_line_weight) ? esc_attr($desc_line_weight) : '400') . ";
            }

            .product-single-page-banner-image .banner-content a {
                padding: " . (!empty($button_button_padding) ? esc_attr($button_button_padding) : '10px 30px') . ";
                margin: " . (!empty($button_button_margin) ? esc_attr($button_button_margin) : '15px 0 0') . ";
                background-color: " . (!empty($button_bg_color) ? esc_attr($button_bg_color) : '#000000') . ";
                color: " . (!empty($button_text_color) ? esc_attr($button_text_color) : '#fff') . ";
                font-size: " . (!empty($button_font_size) ? esc_attr($button_font_size) . 'px' : '18px') . ";
                line-height: " . (!empty($button_line_height) ? esc_attr($button_line_height) . 'px' : '30px') . ";
                font-weight: " . (!empty($button_font_weight) ? esc_attr($button_font_weight) : '400') . ";
            }

            .product-single-page-banner-image .banner-content a:hover {
                background-color: " . (!empty($button_bg_hover_color) ? esc_attr($button_bg_hover_color) : '#000000') . ";
                color: " . (!empty($button_text_hover_color) ? esc_attr($button_text_hover_color) : '#fff') . ";
            }
        ";

        // Add the inline style to the registered stylesheet
        wp_add_inline_style('single-page-banner-image', $custom_css);
    }
}
