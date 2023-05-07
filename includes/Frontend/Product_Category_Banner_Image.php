<?php

namespace WPBI\Frontend;

class Product_Category_Page_Banner_Image {
    
    public function __construct() {
        add_action( 'woocommerce_before_shop_loop', array($this, 'woocommerce_product_category_banner_image'));
    }
    // woocommerce_before_shop_loop, woocommerce_before_main_content

    public function woocommerce_product_category_banner_image($term_id) {

        /**
        * Display Banner image on category page
        */
        if ( is_product_category() ){
            global $wp_query;
            $this->product_category_page_banner_activation_css();

            $cat = $wp_query->get_queried_object();
            $category_banner_image = get_term_meta( $cat->term_id, 'category-image-id', true );
            $image_url = wp_get_attachment_url( $category_banner_image );
            $term_meta = get_option("taxonomy_$cat->term_id"); ?>

            <?php if( isset( $term_meta['banner_image_visiblity'] ) && 'yes' == $term_meta['banner_image_visiblity'] ) { ?> 
                <?php if( $term_meta['category_banner_full_link'] == 'yes') { ?>
                    <a href="<?php echo esc_url($term_meta['category_banner_Button_url']); ?>" class="wpbi-full-banner-link">
                <?php } ?>

                    <div class="product-category-page-banner-image" style="background-image: url(<?php echo !empty($image_url) ? esc_url( $image_url ) : ''; ?>); background-repeat: no-repeat; background-size: cover;">
                        <div class="banner-content">
                            <?php if( !empty( $term_meta['category_banner_subtitle'] ) ) { ?>
                                <span><?php echo esc_html($term_meta['category_banner_subtitle']); ?></span>
                            <?php } ?>

                            <?php if( !empty( $term_meta['category_banner_title'] ) ) { ?>
                                <h2><?php echo esc_html($term_meta['category_banner_title']); ?></h2>
                            <?php } ?>

                            <?php if( !empty( $term_meta['category_banner_short_desc'] ) ) { ?>
                                <?php echo wpautop(wp_unslash($term_meta['category_banner_short_desc'])); ?>
                            <?php } ?>

                            <?php if( !empty( $term_meta['category_banner_Button_url'] ) && $term_meta['category_banner_full_link'] !== 'yes' ) { ?>
                                <a href="<?php echo esc_url($term_meta['category_banner_Button_url']); ?>">
                                    <?php echo $term_meta['category_banner_Button_Name']; ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                <?php if( !empty( $term_meta['wp_banner_button_url'] ) && $term_meta['category_banner_full_link'] == 'yes') { ?>
                    </a>
                <?php } ?>
                
                <div style="clear: both"></div>
            <?php } ?>
        <?php } ?>
        
        <?php
    }

    public function product_category_page_banner_activation_css() { 
        $text_align = get_option( 'category_banner_image_align', 'left' );
        $banner_height = get_option( 'category_single_page_banner_height', '280' );

        // Title
        $title_color = get_option( 'wc_settings_tab_category_title_color', '#000' );
        $title_font_size = get_option( 'wc_settings_tab_category_title_fontsize', '48' );
        $title_line_weight = get_option( 'wc_settings_tab_category_title_fontweight', '700' );
        $title_line_height = get_option( 'wc_settings_tab_category_title_lineheight', '50' );

        // Sub Title
        $subtitle_color = get_option( 'wc_settings_tab_category_subtitle_color', '#000' );
        $subtitle_font_size = get_option( 'wc_settings_tab_category_subtitle_fontsize', '20' );
        $subtitle_line_weight = get_option( 'wc_settings_tab_category_subtitle_fontweight', '400' );
        $subtitle_line_height = get_option( 'wc_settings_tab_category_subtitle_lineheight', '24' );

        // Short Description
        $desc_color = get_option( 'wc_settings_tab_category_desc_color', '#333333' );
        $desc_font_size = get_option( 'wc_settings_tab_category_desc_fontsize', '18' );
        $desc_line_weight = get_option( 'wc_settings_tab_category_desc_fontweight', '400' );
        $desc_line_height = get_option( 'wc_settings_tab_category_desc_lineheight', '22' );

        // Button
        $button_text_color = get_option( 'wc_settings_tab_category_button_text_color', '#ffffff' );
        $button_bg_color = get_option( 'wc_settings_tab_category_button_bg_color', '#000000' );
        $button_text_hover_color = get_option( 'wc_settings_tab_category_button_text_hover_color', '#ffffff' );
        $button_bg_hover_color = get_option( 'wc_settings_tab_category_button_bg_hover_color', '#000000' );
        $button_font_size = get_option( 'wc_settings_tab_category_button_fontsize', '18' );
        $button_font_weight = get_option( 'wc_settings_tab_category_button_fontweight', '400' );
        $button_line_height = get_option( 'wc_settings_tab_category_button_lineheight', '28' ); 
        $button_button_padding = get_option( 'wc_settings_tab_category_button_padding', '0' ); 
        $button_button_margin = get_option( 'wc_settings_tab_category_button_margin', '0' ); ?>

        <style type="text/css">
            .product-category-page-banner-image {
                position: relative;
                background-repeat: no-repeat; 
                background-size: cover; 
                background-position: center;
                z-index: 1;
                display: flex;
                align-items: center;
                justify-content: <?php echo !empty($text_align) ? $text_align : 'left'; ?>;
                text-align: <?php echo !empty($text_align) ? $text_align : 'left'; ?>;
                height: <?php echo !empty($banner_height) ? $banner_height.'px' : '380px'; ?>;
                padding: 30px 92px;
                margin-bottom: 30px;
            }

            @media only screen and (max-width: 767px) {
                .product-category-page-banner-image {
                    padding: 30px 40px;
                    height: 280px;
                }
            }

            .product-category-page-banner-image:before {
                content: '';
                position: absolute;
                width: 100%;
                z-index: -1;
                height: 100%;
                left: 0;
                top: 0;
            }

            /* Sub Title Color */
            .product-category-page-banner-image .banner-content span {
                color: <?php echo !empty($subtitle_color) ? $subtitle_color : '#000000'; ?>;
                font-size: <?php echo !empty($subtitle_font_size) ? $subtitle_font_size.'px' : '20px'; ?>;
                line-height: <?php echo !empty($subtitle_line_height) ? $subtitle_line_height.'px' : '22px'; ?>;
                font-weight: <?php echo !empty($subtitle_line_weight) ? $subtitle_line_weight : '500'; ?>;
            }

            /* Title Color */
            .product-category-page-banner-image .banner-content h2 {
                margin: 5px 0 15px;
                padding: 0;
                color: <?php echo !empty($title_color) ? $title_color : '#000000'; ?>;
                font-size: <?php echo !empty($title_font_size) ? $title_font_size.'px' : '48px'; ?>;
                line-height: <?php echo !empty($title_line_height) ? $title_line_height.'px' : '50px'; ?>;
                font-weight: <?php echo !empty($title_line_weight) ? $title_line_weight : '700'; ?>;
            }

            .product-category-page-banner-image .banner-content p {
                margin: 0;
                padding: 0;
                color: <?php echo !empty($desc_color) ? $desc_color : '#000000'; ?>;
                font-size: <?php echo !empty($desc_font_size) ? $desc_font_size.'px' : '18px'; ?>;
                line-height: <?php echo !empty($desc_line_height) ? $desc_line_height.'px' : '20px'; ?>;
                font-weight: <?php echo !empty($desc_line_weight) ? $desc_line_weight : '400'; ?>;
            }

            .product-category-page-banner-image .banner-content a {
                display: inline-block;
                border-radius: 4px;
                transition: .4s;
                text-decoration: none;
                padding: <?php echo !empty($button_button_padding) ? $button_button_padding : '10px 30px'; ?>;
                margin: <?php echo !empty($button_button_margin) ? $button_button_margin : '0'; ?>;
                background-color: <?php echo !empty($button_bg_color) ? $button_bg_color : '#000000'; ?>;
                color: <?php echo !empty($button_text_color) ? $button_text_color : '#fff'; ?>;
                font-size: <?php echo !empty($button_font_size) ? $button_font_size.'px' : '18px'; ?>;
                line-height: <?php echo !empty($button_line_height) ? $button_line_height.'px' : '30px'; ?>;
                font-weight: <?php echo !empty($button_font_weight) ? $button_font_weight : '400'; ?>;
            }

            .product-category-page-banner-image .banner-content a:hover {
                background-color: <?php echo !empty($button_bg_hover_color) ? $button_bg_hover_color : '#000000'; ?>;
                color: <?php echo !empty($button_text_hover_color) ? $button_text_hover_color : '#fff'; ?>;
            }
        </style>
    <?php }
}
