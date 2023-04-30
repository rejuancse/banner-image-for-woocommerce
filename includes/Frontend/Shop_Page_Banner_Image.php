<?php

namespace WPBI\Frontend;

class Shop_Page_Banner_Image {
    
    public function __construct() {
        add_action( 'woocommerce_before_shop_loop', array( $this, 'product_page_banner_image_callback_func' ) );
    }

    public function product_page_banner_image_callback_func() {
        $this->product_banner_activation_css();

        if(is_shop()) {
            $enable_banner = get_option( 'enable_product_banner', 'true' );
            $shop_page_banner_image = get_option( 'shop_page_banner_image', 9 );
            $image_url = wp_get_attachment_url( $shop_page_banner_image );
            $sub_heading = get_option( 'shop_page_banner_sub_heading', 'desc' );
            $banner_title = get_option( 'product_banner_title', 'desc' );
            $banner_short_text = get_option( 'shop_page_banner_short_desc', 'desc' );
            $enable_link_full_banner = get_option( 'enable_link_full_banner', 'true' );
            $button_name = get_option( 'product_banner_button_name', 'desc' );
            $button_url = get_option( 'product_banner_button_url', 'desc' ); ?>

            <?php if( isset( $enable_banner ) && 'true' == $enable_banner ) { ?> 
                <?php if( !empty( $button_url ) && $enable_link_full_banner == 'true') { ?>
                <a href="<?php echo esc_url($button_url); ?>" class="wpbi-full-banner-link">
                <?php } ?>

                    <div class="product-banner-image-wrap" style="background-image: url(<?php echo $image_url; ?>);">
                        <div class="banner-content">
                            <?php if( !empty( $sub_heading ) ) { ?>
                                <span><?php echo esc_html($sub_heading); ?></span>
                            <?php } ?>

                            <?php if( !empty( $banner_title ) ) { ?>
                                <h2><?php echo esc_html($banner_title); ?></h2>
                            <?php } ?>

                            <?php if( !empty( $banner_short_text ) ) { ?>
                                <p><?php echo esc_html($banner_short_text); ?></p>
                            <?php } ?>

                            <?php if( !empty( $button_url ) && $enable_link_full_banner !== 'true') { ?>
                                <a href="<?php echo esc_url($button_url); ?>">
                                    <?php echo esc_html($button_name); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                <?php if( !empty( $button_url ) && $enable_link_full_banner == 'true') { ?>
                </a>
                <?php } ?>
            <?php } 
        } ?>
        
        <div style="clear: both"></div>
        <?php
    }

    public function product_banner_activation_css() { 
        $text_align = get_option( 'shop_page_banner_text_align', 'left' );
        $banner_height = get_option( 'shop_banner_image_height', '250' );
        $overlay_color = get_option( 'shop_page_banner_overlay_color', '#000000' );
        $overlay_opacity = get_option( 'shop_page_banner_image_overlay_opacity', '.5' );

        // Title
        $subtitle_color = get_option( 'shop_banner_subtitle_color', '#000' );
        $subtitle_font_size = get_option( 'shop_banner_subtitle_font_size', '36' );
        $subtitle_line_weight = get_option( 'shop_banner_subtitle_font_weight', '400' );
        $subtitle_line_height = get_option( 'shop_banner_subtitle_line_height', '36' );

        // Sub Title
        $title_color = get_option( 'shop_banner_title_color', '#000' );
        $title_font_size = get_option( 'shop_banner_title_font_size', '28' );
        $title_line_weight = get_option( 'shop_banner_title_font_weight', '400' );
        $title_line_height = get_option( 'shop_banner_title_line_height', '35' );

        // Short Description
        $desc_color = get_option( 'shop_banner_desc_color', '#000000' );
        $desc_font_size = get_option( 'shop_banner_desc_font_size', '18' );
        $desc_line_weight = get_option( 'shop_banner_desc_font_weight', '400' );
        $desc_line_height = get_option( 'shop_banner_desc_line_height', '28' );

        // Button
        $button_text_color = get_option( 'shop_page_banner_button_text_color', '#ffffff' );
        $button_bg_color = get_option( 'shop_page_banner_button_bg_color', '#000000' );
        $button_text_hover_color = get_option( 'shop_page_banner_button_text_hover_color', '#ffffff' );
        $button_bg_hover_color = get_option( 'shop_page_banner_button_bg_hover_color', '#000000' );
        $button_font_size = get_option( 'shop_banner_button_font_size', '18' );
        $button_font_weight = get_option( 'shop_banner_button_font_weight', '400' );
        $button_line_height = get_option( 'shop_banner_button_line_height', '28' ); 
        $button_button_padding = get_option( 'shop_banner_button_padding', '10px 30px' ); 
        $button_button_margin = get_option( 'shop_banner_button_margin', '0' ); ?>

        <style type="text/css">
            .product-banner-image-wrap {
                position: relative;
                background-repeat: no-repeat; 
                background-size: cover; 
                background-position: center;
                z-index: 1;
                display: flex;
                align-items: center;
                justify-content: <?php echo $text_align; ?>;
                text-align: <?php echo $text_align; ?>;
                height: <?php echo $banner_height; ?>px;
                padding: 30px 92px;
                margin-bottom: 30px;
            }

            .product-banner-image-wrap:before {
                content: '';
                position: absolute;
                width: 100%;
                z-index: -1;
                height: 100%;
                left: 0;
                top: 0;
                background-color: <?php echo $overlay_color; ?>;
                opacity: <?php echo $overlay_opacity; ?>;
            }

            /* Sub Title Color */
            .product-banner-image-wrap .banner-content span {
                color: <?php echo $subtitle_color; ?>;
                font-size: <?php echo !empty($subtitle_font_size) ? $subtitle_font_size.'px' : '56px'; ?>;
                line-height: <?php echo !empty($subtitle_line_height) ? $subtitle_line_height.'px' : '56px'; ?>;
                font-weight: <?php echo !empty($subtitle_line_weight) ? $subtitle_line_weight : '700'; ?>;
            }

            /* Title Color */
            .product-banner-image-wrap .banner-content h2 {
                margin: 0;
                padding: 0;
                color: <?php echo $title_color; ?>;
                font-size: <?php echo !empty($title_font_size) ? $title_font_size.'px' : '56px'; ?>;
                line-height: <?php echo !empty($title_line_height) ? $title_line_height.'px' : '56px'; ?>;
                font-weight: <?php echo !empty($title_line_weight) ? $title_line_weight : '700'; ?>;
            }

            .banner-content p {
                margin: 0;
                padding: 0;
                color: <?php echo $desc_color; ?>;
                font-size: <?php echo !empty($desc_font_size) ? $desc_font_size.'px' : '56px'; ?>;
                line-height: <?php echo !empty($desc_line_height) ? $desc_line_height.'px' : '56px'; ?>;
                font-weight: <?php echo !empty($desc_line_weight) ? $desc_line_weight : '700'; ?>;
            }

            .banner-content a {
                display: inline-block;
                border-radius: 4px;
                transition: .4s;
                text-decoration: none;
                padding: <?php echo !empty($button_button_padding) ? $button_button_padding : '10px 30px'; ?>;
                margin: <?php echo !empty($button_button_margin) ? $button_button_margin : '10px 30px'; ?>;
                background-color: <?php echo !empty($button_bg_color) ? $button_bg_color : '#000000'; ?>;
                color: <?php echo !empty($button_text_color) ? $button_text_color : '#fff'; ?>;
                font-size: <?php echo !empty($button_font_size) ? $button_font_size.'px' : '18px'; ?>;
                line-height: <?php echo !empty($button_line_height) ? $button_line_height.'px' : '30px'; ?>;
                font-weight: <?php echo !empty($button_font_weight) ? $button_font_weight : '400'; ?>;
            }

            .banner-content a:hover {
                background-color: <?php echo !empty($button_bg_hover_color) ? $button_bg_hover_color : '#000000'; ?>;
                color: <?php echo !empty($button_text_hover_color) ? $button_text_hover_color : '#fff'; ?>;
            }
        </style>
    <?php }
}
