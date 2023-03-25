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
        wp_enqueue_style( 'wpbi-wpbi-css', WPBI_DIR_URL .'assets/css/wpbi.css', false, WPBI_VERSION );
        wp_enqueue_script( 'wpbi-jquery-scripts', WPBI_DIR_URL .'assets/js/wpbi.min.js', array('jquery','wp-color-picker'), WPBI_VERSION, true );
    } 

    /**
     * Registering necessary js and css
     * @frontend
     */
    public function frontend_script(){
        wp_enqueue_style( 'wpbi-css-front', WPBI_DIR_URL .'assets/css/wpbi-front.css', false, WPBI_VERSION );
        wp_enqueue_style( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );
        
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
        wp_enqueue_script( 'wpbi-jquery-scripts-front', WPBI_DIR_URL .'assets/js/wpbi-front.js', array('jquery'), WPBI_VERSION, true);
        wp_localize_script( 'wpbi-jquery-scripts-front', 'wpbi_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_media();
    }
}