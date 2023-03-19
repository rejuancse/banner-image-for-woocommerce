<?php

namespace WCPB\WC_Product_Banner\Frontend;

class Shortcode {
    
    public function __construct() {
        add_shortcode( 'product_banner_image', [ $this, 'shortcode_callback_func' ] );
    }

    public function shortcode_callback_func( $atts, $content = '' ) { 

        ob_start(); ?>

        Banner Image.

        <?php
        $output = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();
        return $output;
    }
}
