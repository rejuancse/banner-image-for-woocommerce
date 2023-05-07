<?php

namespace WPPB\Frontend;

class WPPB_Product_Single_Page_Banner_Image {
    
    public function __construct() {
        add_action( 'woocommerce_before_single_product_summary', array($this, 'bannerimage_callback_func'));
    }

    public function bannerimage_callback_func() { 
        global $post;
        $this->product_single_page_banner_activation_css();

        $wp_banner_image   = get_post_meta($post->ID, 'wp_product_banner_image', true);
        $banner_info = json_decode($wp_banner_image, true); ?>

        <?php
        if (is_array($banner_info)) {
            if (count($banner_info) > 0) {
                foreach ($banner_info as $value) { 
                    if( $value['enable_banner_image'] == 'yes' ) { ?>

                        <?php if( !empty( $value['wp_banner_button_url'] ) && $value['enable_link_full_banner_image'] == 'yes') { ?>
                        <a href="<?php echo esc_url($value['wp_banner_button_url']); ?>" class="wpbi-full-banner-link">
                        <?php } ?>

                            <div class="product-single-page-banner-image" style="background-image: url(<?php echo !empty($value['product_banner_bg_image']) ? wp_get_attachment_url( $value["product_banner_bg_image"] ) : ''; ?>); background-repeat: no-repeat; background-size: cover;">
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
                    <?php
                    }
                }
            }
        } ?>

        <div style="clear: both"></div>

        <?php
    }


    public function product_single_page_banner_activation_css() { 
        $text_align = get_option( 'product_banner_image_align', 'left' );
        $banner_height = get_option( 'product_single_page_banner_height', '280' ); 

        // Title
        $title_color = get_option( 'wc_settings_tab_product_title_color', '#000' );
        $title_font_size = get_option( 'wc_settings_tab_product_title_fontsize', '48' );
        $title_line_weight = get_option( 'wc_settings_tab_product_title_fontweight', '700' );
        $title_line_height = get_option( 'wc_settings_tab_product_title_lineheight', '50' );

        // Sub Title
        $subtitle_color = get_option( 'wc_settings_tab_product_subtitle_color', '#000' );
        $subtitle_font_size = get_option( 'wc_settings_tab_product_subtitle_fontsize', '18' );
        $subtitle_line_weight = get_option( 'product_banner_subtitle_fontweight', '400' );
        $subtitle_line_height = get_option( 'wc_settings_tab_product_subtitle_lineheight', '20' );

        // Short Description
        $desc_color = get_option( 'wc_settings_tab_product_title_color', '#333333' );
        $desc_font_size = get_option( 'wc_settings_tab_product_desc_fontsize', '18' );
        $desc_line_weight = get_option( 'wc_settings_tab_product_desc_fontweight', '400' );
        $desc_line_height = get_option( 'wc_settings_tab_product_desc_lineheight', '24' );

        // Button
        $button_text_color = get_option( 'wc_settings_tab_product_button_text_color', '#ffffff' );
        $button_bg_color = get_option( 'wc_settings_tab_product_button_bg_color', '#000000' );
        $button_text_hover_color = get_option( 'wc_settings_tab_product_button_text_hover_color', '#ffffff' );
        $button_bg_hover_color = get_option( 'wc_settings_tab_product_button_bg_hover_color', '#000000' );
        $button_font_size = get_option( 'wc_settings_tab_product_button_fontsize', '18' );
        $button_font_weight = get_option( 'wc_settings_tab_product_button_fontweight', '400' );
        $button_line_height = get_option( 'wc_settings_tab_product_button_lineheight', '28' ); 
        $button_button_padding = get_option( 'wc_settings_tab_product_button_padding', '10px 30px' ); 
        $button_button_margin = get_option( 'wc_settings_tab_product_button_margin', '0' ); ?>

        <style type="text/css">
            .product-single-page-banner-image {
                position: relative;
                background-repeat: no-repeat; 
                background-size: cover; 
                background-position: center;
                z-index: 1;
                display: flex;
                align-items: center;
                justify-content: <?php echo !empty($text_align) ? esc_attr($text_align) : 'left'; ?>;
                text-align: <?php echo !empty($text_align) ? esc_attr($text_align) : 'left'; ?>;
                height: <?php echo !empty($banner_height) ? esc_attr($banner_height).'px' : '380px'; ?>;
                padding: 30px 92px;
                margin-bottom: 30px;
            }

            @media only screen and (max-width: 767px) {
                .product-single-page-banner-image {
                    padding: 30px 40px;
                    height: 280px;
                }
            }

            /* Sub Title Color */
            .product-single-page-banner-image .banner-content span {
                color: <?php echo !empty($subtitle_color) ? esc_attr($subtitle_color) : '#000000'; ?>;
                font-size: <?php echo !empty($subtitle_font_size) ? esc_attr($subtitle_font_size).'px' : '20px'; ?>;
                line-height: <?php echo !empty($subtitle_line_height) ? esc_attr($subtitle_line_height).'px' : '22px'; ?>;
                font-weight: <?php echo !empty($subtitle_line_weight) ? esc_attr($subtitle_line_weight) : '400'; ?>;
            }

            /* Title Color */
            .product-single-page-banner-image .banner-content h2 {
                margin: 5px 0 10px;
                padding: 0;
                color: <?php echo !empty($title_color) ? esc_attr($title_color) : '#000000'; ?>;
                font-size: <?php echo !empty($title_font_size) ? esc_attr($title_font_size).'px' : '48px'; ?>;
                line-height: <?php echo !empty($title_line_height) ? esc_attr($title_line_height).'px' : '50px'; ?>;
                font-weight: <?php echo !empty($title_line_weight) ? esc_attr($title_line_weight) : '700'; ?>;
            }

            .product-single-page-banner-image .banner-content p {
                margin: 0;
                padding: 0;
                color: <?php echo !empty($desc_color) ? esc_attr($desc_color) : '#000000'; ?>;
                font-size: <?php echo !empty($desc_font_size) ? esc_attr($desc_font_size).'px' : '18px'; ?>;
                line-height: <?php echo !empty($desc_line_height) ? esc_attr($desc_line_height).'px' : '20px'; ?>;
                font-weight: <?php echo !empty($desc_line_weight) ? esc_attr($desc_line_weight) : '400'; ?>;
            }

            .product-single-page-banner-image .banner-content a {
                display: inline-block;
                border-radius: 4px;
                transition: .4s;
                text-decoration: none;
                padding: <?php echo !empty($button_button_padding) ? esc_attr($button_button_padding) : '10px 30px'; ?>;
                margin: <?php echo !empty($button_button_margin) ? esc_attr($button_button_margin) : '15px 0 0'; ?>;
                background-color: <?php echo !empty($button_bg_color) ? esc_attr($button_bg_color) : '#000000'; ?>;
                color: <?php echo !empty($button_text_color) ? esc_attr($button_text_color) : '#fff'; ?>;
                font-size: <?php echo !empty($button_font_size) ? esc_attr($button_font_size).'px' : '18px'; ?>;
                line-height: <?php echo !empty($button_line_height) ? esc_attr($button_line_height).'px' : '30px'; ?>;
                font-weight: <?php echo !empty($button_font_weight) ? esc_attr($button_font_weight) : '400'; ?>;
            }

            .product-single-page-banner-image .banner-content a:hover {
                background-color: <?php echo !empty($button_bg_hover_color) ? esc_attr($button_bg_hover_color) : '#000000'; ?>;
                color: <?php echo !empty($button_text_hover_color) ? esc_attr($button_text_hover_color) : '#fff'; ?>;
            }
        </style>
    <?php }
}
