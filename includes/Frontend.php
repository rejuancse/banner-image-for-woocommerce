<?php

namespace BIW;

/**
 * Frontend handler class
 */
class Frontend {

    /**
     * Initialize the class
     */
    function __construct() {
        new Frontend\Shop_Page_Banner_Image();
        new Frontend\Category_Page_Banner_image();
        new Frontend\Product_Single_Page_Banner();
        new Frontend\Checkout_Page_Banner();
        new Frontend\Cart_Page_Banner();
    }
}
