<?php

namespace BIFW;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     */
    function __construct() {
        new Admin\Initial_Setup();
        new Admin\BIFW_Menu();
        new Admin\BIFW_Category_Banner_Image();
    }
}
