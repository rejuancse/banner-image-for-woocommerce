<?php
namespace WPPB\woocommerce;

defined( 'ABSPATH' ) || exit;

class WPPB_Base {

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
        add_action('wp_enqueue_scripts', array($this, 'wppb_frontend_script')); //Add frontend js and css
    }

    public function admin_script(){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'wpbi-admin', WPPB_DIR_URL .'assets/build/css/admin.css', false, WPPB_VERSION );

        wp_enqueue_script( 'wpbi-jquery-scripts', WPPB_DIR_URL .'assets/build/js/admin.js', array('jquery', 'wp-color-picker'), WPPB_VERSION, true );
    } 

    /**w
     * Registering necessary js and css
     * @frontend
     */
    public function wppb_frontend_script(){
        wp_enqueue_style( 'wpbi-main', WPPB_DIR_URL .'assets/build/css/main.css', false, WPPB_VERSION );
    }
}