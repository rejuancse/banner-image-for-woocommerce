<?php

namespace Banner_Image;

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
    }
}