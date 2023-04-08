<?php

namespace WPBI\Frontend;

class Product_Page_Banner_Image {
    
    public function __construct() {
        add_action( 'woocommerce_before_shop_loop', array($this, 'product_page_banner_image_callback_func'));
    }

    public function product_page_banner_image_callback_func() { 
        global $post;
        $wp_banner_image   = get_post_meta($post->ID, 'wp_product_banner_image', true);
        $banner_info = json_decode($wp_banner_image, true);

        if (is_array($banner_info)) {
            if (count($banner_info) > 0) {
                foreach ($banner_info as $value) { 
                    if( $value['enable_banner_image'] == 'yes' ) { ?>
                        <div class="wpbi-shadow wpbi-padding15 wpbi-clearfix" 
                        style="background-image: url(<?php echo !empty($value['product_banner_bg_image']) ? wp_get_attachment_url( $value["product_banner_bg_image"] ) : ''; ?>); background-repeat: no-repeat; background-size: cover;">
                            <h2><?php echo wpautop(wp_unslash($value['product_banner_title'])); ?></h2>
                            <div><?php echo wpautop(wp_unslash($value['product_banner_description'])); ?></div>

                            <a href="<?php echo esc_url($value['wp_banner_button_url']); ?>">
                                <?php echo $value['wp_banner_button_name']; ?>
                            </a>
                        </div>
                    <?php
                    }
                }
            }
        } ?>
        
        <div style="clear: both"></div>

        <?php
    }
}
