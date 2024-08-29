<?php

namespace Banner_Image\Admin;

/**
 * The Menu handler class
 */
class Banner_Image_Menu {

    /**
     * Initialize the class
     */
    public function __construct() {
        if ( class_exists( 'WooCommerce' ) ) {
            add_action( 'admin_menu', [ $this, 'biw_admin_menu' ] );
            add_action('admin_init', array($this, 'Save_Shop_Page_Settings' ));
            add_action('admin_init', array($this, 'Save_Category_Page_Banner' ));
            add_action('admin_init', array($this, 'Save_Product_Single_Page_Banner' ));
        }
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function biw_admin_menu() {
        add_menu_page(
            __( 'Product Banner Image', 'banner-image' ),
            __( 'Shop Page Banner Image', 'banner-image' ),
            'manage_options', 'biw-menu',
            [ $this, 'biw_shop_page_callback_func' ],
            'dashicons-superhero',
        );

        add_submenu_page(
            'biw-menu',                            // parent slug
            'Product Category Banner Image Title',  // page title
            'Product Category Banner',              // menu title
            'manage_options',                       // capability
            'biw-product-category',                // slug
            [ $this, 'biw_category_page_callback_func' ] // callback
        );

        add_submenu_page (
            'biw-menu',                                 // parent slug
            'Product Single Page Banner',               // page title
            'Product Single Page Banner',               // menu title
            'manage_options',                           // capability
            'pbw-product-single-page',                  // slug
            [ $this, 'pbw_single_page_callback_func' ]  // callback
        );
    }

    /**
     * Render the plugin page -> Shop Page
     *
     * @return void
     */
    public function biw_shop_page_callback_func() {
        $Shop_Page_Content = new Shop_Page_Content();
        $Shop_Page_Content->Shop_Page_Banner();
    }

    /**
     * Add Shop Page settings action
     */
    public function Save_Shop_Page_Settings() {
        $Shop_Page_Content = new Shop_Page_Content();
        $Shop_Page_Content->Shop_Page_Banner_Save();
    }

    /**
     * Render the plugin page -> Category Page
     *
     * @return void
     */
    public function biw_category_page_callback_func() {
        $Category_Page_Settings = new Category_Page_Settings();
        $Category_Page_Settings->Category_Page_Banner();
    }


    /**
     * Render the plugin page -> Category Page
     *
     * @return void
     */
    public function Save_Category_Page_Banner() {
        $Category_Page_Settings = new Category_Page_Settings();
        $Category_Page_Settings->Category_Page_Banner_Save();
    }

    /**
     * Render the plugin page -> Product Single Page
     *
     * @return void
     */
    public function pbw_single_page_callback_func() {
        $Product_Single_Page_Settings = new Product_Single_Page_Settings();
        $Product_Single_Page_Settings->Product_Single_Page_Banner();
    }

    /**
     * Add Product Single Page settings action
     */
    public function Save_Product_Single_Page_Banner() {
        $Product_Single_Page_Settings = new Product_Single_Page_Settings();
        $Product_Single_Page_Settings->Product_Single_Page_Banner_Save();
    }
}
