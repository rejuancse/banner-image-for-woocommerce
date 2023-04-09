<?php

namespace WPBI\Frontend;

class Product_Page_Banner_Image {
    
    public function __construct() {
        add_action( 'woocommerce_before_shop_loop', array($this, 'product_page_banner_image_callback_func'));
    }

    public function product_page_banner_image_callback_func() { 
        if(is_shop()) {
            $enable_banner = get_option( 'enable_product_banner', 'desc' );
            $wpbi_product_banner_image = get_option( 'wpbi_product_banner_image', 9 );
            $image_url = wp_get_attachment_url( $wpbi_product_banner_image );
            $banner_title = get_option( 'product_banner_title', 'desc' );
            $banner_short_text = get_option( 'product_banner_short_text', 'desc' );
            $button_name = get_option( 'product_banner_button_name', 'desc' );
            $button_url = get_option( 'product_banner_button_url', 'desc' ); ?>

            <?php if( isset( $enable_banner ) && 'true' == $enable_banner ) { ?> 
                <div class="wpbi-shadow wpbi-clearfix" 
                style="background-image: url(<?php echo $image_url; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <h2><?php echo $banner_title; ?></h2>
                    <span><?php echo $banner_short_text; ?></span>

                    <a href="<?php echo esc_url($button_url); ?>">
                        <?php echo $button_name; ?>
                    </a>
                </div>
            <?php } 
        } ?>
        
        <div style="clear: both"></div>

        <?php
    }
}
