<?php
namespace WPBI\woocommerce;

defined( 'ABSPATH' ) || exit;

class Base {

    /**
     * @var null
     *
     * Instance of this class
     */
    protected static $_instance = null;

    /**
     * @return null|Base
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Base constructor.
     *
     * @hook
     */
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'admin_script')); //Add Additional backend js and css
        add_action('wp_enqueue_scripts', array($this, 'frontend_script')); //Add frontend js and css
    }

    public function admin_script(){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'wpbi-admin', WPBI_DIR_URL .'assets/build/css/admin.css', false, WPBI_VERSION );

        wp_enqueue_script( 'wpbi-jquery-scripts', WPBI_DIR_URL .'assets/build/js/admin.js', array('jquery', 'wp-color-picker'), WPBI_VERSION, true );
    } 

    /**
     * Registering necessary js and css
     * @frontend
     */
    public function frontend_script(){
        // wp_enqueue_script( 'jquery' );
        // wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );

        wp_enqueue_style( 'wpbi-main', WPBI_DIR_URL .'assets/build/css/main.css', false, WPBI_VERSION );
    }
}