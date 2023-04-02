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
            $cat = $wp_query->get_queried_object();
            $category_banner_image = get_term_meta( $cat->term_id, 'category-image-id', true );
            $image_url = wp_get_attachment_url( $category_banner_image );
            $term_meta = get_option("taxonomy_$cat->term_id"); ?>

            <?php if( isset( $term_meta['banner_image_visiblity'] ) && 'yes' == $term_meta['banner_image_visiblity'] ) { ?> 
                <div class="wpbi-shadow wpbi-clearfix" 
                style="background-image: url(<?php echo $image_url; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <h2><?php echo wpautop(wp_unslash($term_meta['category_banner_title'])); ?></h2>
                    <span><?php echo wpautop(wp_unslash($term_meta['category_banner_short_desc'])); ?></span>

                    <!-- <a href="<?php// echo esc_url($value['wp_banner_button_url']); ?>">
                        <?php //echo $value['wp_banner_button_name']; ?>
                    </a> -->
                </div>
            <?php } ?>

        <?php } ?>

        <div style="clear: both"></div>

        <?php

    }
}
