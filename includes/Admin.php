<?php

namespace Banner_Image;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     */
    function __construct() {
        new Admin\Initial_Setup();
        new Admin\Banner_Image_Menu();
        new Admin\Banner_Image_Category_Banner();
    }
}
