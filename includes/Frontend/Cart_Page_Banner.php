<?php

namespace BIW\Frontend;

defined( 'ABSPATH' ) || exit;

class Cart_Page_Banner {

    public function __construct() {
        add_action( 'woocommerce_before_cart_form', [ $this, 'cart_page_banner_image_callback_func' ] );
    }

    public function cart_page_banner_image_callback_func() {
        echo "<div class='cart-banner-message' style='padding: 10px; background-color: #f8f8f8; border: 1px solid #ddd; margin-bottom: 20px; text-align: center;'>Successfully, cart page is working.</div>";
    }

}
