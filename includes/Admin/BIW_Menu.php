<?php

namespace BIW\Admin;

/**
 * The Menu handler class
 */
class BIW_Menu {

    /**
     * Initialize the class
     */
    public function __construct() {
        if ( class_exists( 'WooCommerce' ) ) {
            add_action( 'admin_menu', [ $this, 'biw_admin_menu' ] );
            add_action('admin_init', array($this, 'Save_Shop_Page_Settings' ));
            add_action('admin_init', array($this, 'Save_Category_Page_Banner' ));
        }
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function biw_admin_menu() {
        add_menu_page(
            __( 'Product Banner Image', 'biw' ),
            __( 'Shop Page Banner Image', 'biw' ),
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
}
