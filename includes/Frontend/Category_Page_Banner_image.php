<?php

namespace Banner_Image\Frontend;

class Category_Page_Banner_image {

    public function __construct() {
        add_action( 'woocommerce_before_shop_loop', array($this, 'biw_product_category_banner_image'));
        add_action( 'wp_enqueue_scripts', array( $this, 'biw_product_category_banner_activation_css' ) );
    }

    public function biw_product_category_banner_image($term_id) {
        /**
        * Display Banner image on category page
        */
        if ( is_product_category() ){
            global $wp_query;

            $enable_banner = get_option( 'enable_category_page_banner', 'true' );
            $cat = $wp_query->get_queried_object();
            $category_banner_image = get_term_meta( $cat->term_id, 'category-image-id', true );
            $image_url = wp_get_attachment_url( $category_banner_image );
            $term_meta = get_option("banner_image_taxonomy_$cat->term_id"); ?>

            <?php if( isset( $enable_banner ) && 'true' == $enable_banner ) {
                if (isset($term_meta['category_banner_full_link']) && $term_meta['category_banner_full_link'] == 'yes' && !empty($term_meta['banner_image_category_button_url'])) {
                    $url = isset($term_meta['banner_image_category_button_url']) ? $term_meta['banner_image_category_button_url'] : '';
                    if (!is_string($url)) {
                        $url = '';
                    }
                    ?>
                    <a href="<?php echo esc_url($url); ?>" class="wpbi-full-banner-link">
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
                                <p><?php echo wp_kses_post(wp_unslash($term_meta['category_banner_short_desc'])); ?></p>
                            <?php } ?>

                            <?php
                            if( !empty( $term_meta['banner_image_category_button_url'] ) &&
                                $term_meta['category_banner_full_link'] !== 'yes' &&
                                !empty($term_meta['banner_image_category_button']) ) {
                            ?>
                                <a href="<?php echo esc_url($term_meta['banner_image_category_button_url']); ?>">
                                    <?php echo esc_html($term_meta['banner_image_category_button']); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                <?php if ( is_array($term_meta) && !empty($term_meta['banner_image_category_button_url']) && $term_meta['category_banner_full_link'] == 'yes' ) { ?>
                    </a>
                <?php } ?>

                <div style="clear: both"></div>
            <?php } ?>
        <?php } ?>

        <?php
    }

    public function biw_product_category_banner_activation_css() {
        $text_align = get_option( 'category_banner_text_align', 'left' );
        $banner_height = get_option( 'category_banner_height', '280' );

        // Title
        $title_color = get_option( 'category_banner_title_color', '#000' );
        $title_font_size = get_option( 'category_banner_title_fontsize', '48' );
        $title_line_weight = get_option( 'category_banner_title_fontweight', '700' );
        $title_line_height = get_option( 'category_banner_title_lineheight', '50' );

        // Sub Title
        $subtitle_color = get_option( 'category_banner_subtitle_color', '#000' );
        $subtitle_font_size = get_option( 'category_banner_subtitle_fontsize', '20' );
        $subtitle_line_weight = get_option( 'category_banner_subtitle_fontweight', '400' );
        $subtitle_line_height = get_option( 'category_banner_subtitle_lineheight', '24' );

        // Short Description
        $desc_color = get_option( 'category_banner_desc_color', '#333333' );
        $desc_font_size = get_option( 'category_banner_desc_fontsize', '18' );
        $desc_line_weight = get_option( 'category_banner_desc_fontweight', '400' );
        $desc_line_height = get_option( 'category_banner_desc_lineheight', '22' );

        // Button
        $button_text_color = get_option( 'category_banner_button_text_color', '#ffffff' );
        $button_bg_color = get_option( 'category_banner_button_bg_color', '#000000' );
        $button_text_hover_color = get_option( 'category_banner_button_text_hover_color', '#ffffff' );
        $button_bg_hover_color = get_option( 'category_banner_button_bg_hover_color', '#000000' );
        $button_font_size = get_option( 'category_banner_button_fontsize', '18' );
        $button_font_weight = get_option( 'category_banner_button_fontweight', '400' );
        $button_line_height = get_option( 'category_banner_button_lineheight', '28' );
        $button_button_padding = get_option( 'category_banner_button_padding', '0' );
        $button_button_margin = get_option( 'category_banner_button_margin', '0' );

        // Register and enqueue the stylesheet
        wp_register_style('category-page-banner-image', Banner_Image_URL . '/assets/css/category-page-banner-image.css', false, Banner_Image_VERSION);
        wp_enqueue_style('category-page-banner-image');

        // Construct the custom CSS string
        $custom_css = "
            .product-category-page-banner-image {
                justify-content: " . (!empty($text_align) ? esc_attr($text_align) : 'left') . ";
                text-align: " . (!empty($text_align) ? esc_attr($text_align) : 'left') . ";
                height: " . (!empty($banner_height) ? esc_html($banner_height) . 'px' : '380px') . ";
            }

            /* Sub Title Color */
            .product-category-page-banner-image .banner-content span {
                color: " . (!empty($subtitle_color) ? esc_attr($subtitle_color) : '#000000') . ";
                font-size: " . (!empty($subtitle_font_size) ? esc_attr($subtitle_font_size) . 'px' : '20px') . ";
                line-height: " . (!empty($subtitle_line_height) ? esc_html($subtitle_line_height) . 'px' : '22px') . ";
                font-weight: " . (!empty($subtitle_line_weight) ? esc_attr($subtitle_line_weight) : '500') . ";
            }

            /* Title Color */
            .product-category-page-banner-image .banner-content h2 {
                color: " . (!empty($title_color) ? esc_attr($title_color) : '#000000') . ";
                font-size: " . (!empty($title_font_size) ? esc_html($title_font_size) . 'px' : '48px') . ";
                line-height: " . (!empty($title_line_height) ? esc_attr($title_line_height) . 'px' : '50px') . ";
                font-weight: " . (!empty($title_line_weight) ? esc_attr($title_line_weight) : '700') . ";
            }

            .product-category-page-banner-image .banner-content p {
                color: " . (!empty($desc_color) ? esc_attr($desc_color) : '#000000') . ";
                font-size: " . (!empty($desc_font_size) ? esc_attr($desc_font_size) . 'px' : '18px') . ";
                line-height: " . (!empty($desc_line_height) ? esc_attr($desc_line_height) . 'px' : '20px') . ";
                font-weight: " . (!empty($desc_line_weight) ? esc_attr($desc_line_weight) : '400') . ";
            }

            .product-category-page-banner-image .banner-content a {
                padding: " . (!empty($button_button_padding) ? esc_attr($button_button_padding) : '10px 30px') . ";
                margin: " . (!empty($button_button_margin) ? esc_attr($button_button_margin) : '15px 0 0') . ";
                background-color: " . (!empty($button_bg_color) ? esc_attr($button_bg_color) : '#000000') . ";
                color: " . (!empty($button_text_color) ? esc_attr($button_text_color) : '#fff') . ";
                font-size: " . (!empty($button_font_size) ? esc_attr($button_font_size) . 'px' : '18px') . ";
                line-height: " . (!empty($button_line_height) ? esc_attr($button_line_height) . 'px' : '30px') . ";
                font-weight: " . (!empty($button_font_weight) ? esc_attr($button_font_weight) : '400') . ";
            }

            .product-category-page-banner-image .banner-content a:hover {
                background-color: " . (!empty($button_bg_hover_color) ? esc_attr($button_bg_hover_color) : '#000000') . ";
                color: " . (!empty($button_text_hover_color) ? esc_attr($button_text_hover_color) : '#fff') . ";
            }
        ";

        // Add the inline style to the registered stylesheet
        wp_add_inline_style('category-page-banner-image', $custom_css);

    }
}
