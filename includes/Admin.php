<?php

namespace BIW;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     */
    function __construct() {
        new Admin\Initial_Setup();
        new Admin\BIW_Menu();
        new Admin\BIW_Category_Banner_Image();
    }
}
