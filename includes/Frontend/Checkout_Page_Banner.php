<?php

namespace BIW\Frontend;

defined( 'ABSPATH' ) || exit;

class Checkout_Page_Banner {

    public function __construct() {
        add_action( 'woocommerce_before_checkout_form', [ $this, 'bannerimage_callback_func' ] );
    }

    public function bannerimage_callback_func() {
        echo "<div class='checkout-banner-message' style='padding: 10px; background-color: #f8f8f8; border: 1px solid #ddd; margin-bottom: 20px; text-align: center;'>
                Successfully, check page is working
              </div>";


        var_dump('EEE');
        die();
    }
}
