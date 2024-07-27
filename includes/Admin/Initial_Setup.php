<?php
namespace BIFW\Admin;

defined( 'ABSPATH' ) || exit;

class Initial_Setup {

    public function __construct() {
        add_action( 'admin_notices', [ $this, 'biw_wc_requirement_notice' ] );
    }

    /**
     * Require woocommerce admin message
     * */
    function biw_wc_requirement_notice() {

        if ( ! class_exists( 'WooCommerce' ) ) {
            $text = esc_html__( 'WooCommerce', 'biw' );

            $link    = esc_url( add_query_arg( array(
                'tab'       => 'plugin-information',
                'plugin'    => 'woocommerce',
                'TB_iframe' => 'true',
                'width'     => '640',
                'height'    => '500',
            ), admin_url( 'plugin-install.php' ) ) );
            $message = wp_kses( __( "<strong>Product Banner Image for Woocommerce</strong> is an add-on of ", 'biw' ), array( 'strong' => array() ) );

            printf( '<div class="%1$s"><p>%2$s <a class="thickbox open-plugin-details-modal" href="%3$s"><strong>%4$s</strong></a></p></div>', 'notice notice-error', $message, $link, $text );
        }
    }
}
