<?php
namespace WCPB\WC_Product_Banner;

defined( 'ABSPATH' ) || exit;

if (! class_exists('Initial_Setup')) {

    class Initial_Setup {

        public function __construct() {
            add_action('wp_ajax_install_woocommerce_plugin',     array($this, 'install_woocommerce_plugin'));
            add_action('admin_action_activate_woocommerce_free', array($this, 'activate_woocommerce_free'));
        }

        /**
         * Deactivation Hook
         */
        public function initial_plugin_deactivation(){

        }

        public function activation_css() {
            ?>
            <style type="text/css">
                .wcpb-install-notice{
                    padding: 20px;
                }
                .wcpb-install-notice-inner{
                    display: flex;
                    align-items: center;
                }
                .wcpb-install-notice-inner .button{
                    padding: 5px 30px;
                    height: auto;
                    line-height: 20px;
                    text-transform: capitalize;
                }
                .wcpb-install-notice-content{
                    flex-grow: 1;
                    padding-left: 20px;
                    padding-right: 20px;
                }
                .wcpb-install-notice-icon img{
                    width: 64px;
                    border-radius: 4px;
                    display: block;
                }
                .wcpb-install-notice-content h2{
                    margin-top: 0;
                    margin-bottom: 5px;
                }
                .wcpb-install-notice-content p{
                    margin-top: 0;
                    margin-bottom: 0px;
                    padding: 0;
                }
            </style>
            
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    'use strict';
                    $(document).on('click', '.install-wcpb-button', function(e){
                        e.preventDefault();
                        var $btn = $(this);
                        $.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {install_plugin: 'woocommerce', action: 'install_woocommerce_plugin'},
                            beforeSend: function(){
                                $btn.addClass('updating-message');
                            },
                            success: function (data) {
                                $('.install-wcpb-button').remove();
                                $('#wcpb_install_msg').html(data);
                            },
                            complete: function () {
                                $btn.removeClass('updating-message');
                            }
                        });
                    });
                });
            </script>
            <?php
        }
        
        /**
         * Show notice if there is no woocommerce
         */
        public function free_plugin_installed_but_inactive_notice(){
            $this->activation_css();
            ?>
            <div class="notice notice-error wcpb-install-notice">
                <div class="wcpb-install-notice-inner">
                    <div class="wcpb-install-notice-icon">
                        <img src="<?php echo WCPB_GIFT_URL.'/assets/src/images/gift-card.png'; ?>" alt="logo" />
                    </div>
                    <div class="wcpb-install-notice-content">
                        <h2><?php _e('Thanks for using WooCommerce Product Banner Image', 'wcpb'); ?></h2>
                        <?php 
                            printf(
                                '<p>%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s</p>', 
                                __('You must have','wcpb'), 
                                'https://wordpress.org/plugins/woocommerce/', 
                                __('WooCommerce','wcpb'), 
                                __('installed and activated on this website in order to use WooCommerce Product Banner Image.','wcpb')
                            );
                        ?>
                        <a href="#" target="_blank"><?php _e('Learn more about WooCommerce Product Banner Image', 'wcpb'); ?></a>
                    </div>
                    <div class="wcpb-install-notice-button">
                        <a  class="button button-primary" href="<?php echo add_query_arg(array('action' => 'activate_woocommerce_free'), admin_url()); ?>"><?php _e('Activate WooCommerce', 'wcpb'); ?></a>
                    </div>
                </div>
            </div>
            <?php
        }
    
        public function free_plugin_not_installed(){
            include( ABSPATH . 'wp-admin/includes/plugin-install.php' );
            $this->activation_css();
            ?>
            <div class="notice notice-error wcpb-install-notice">
                <div class="wcpb-install-notice-inner">
                    <div class="wcpb-install-notice-icon">
                        <img src="<?php echo WCPB_GIFT_URL.'/assets/src/images/gift-card.png'; ?>" alt="logo" />
                    </div>
                    <div class="wcpb-install-notice-content">
                        <h2><?php _e('Thanks for using WooCommerce Product Banner Image', 'wcpb'); ?></h2>
                        <?php 
                            printf(
                                '<p>%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s</p>', 
                                __('You must have', 'wcpb'), 
                                'https://wordpress.org/plugins/woocommerce/', 
                                __('WooCommerce','wcpb'), 
                                __('installed and activated on this website in order to use WooCommerce Product Banner Image.','wcpb')
                            );
                        ?>
                        <a href="#" target="_blank"><?php _e('Learn more about WooCommerce Product Banner Image', 'wcpb'); ?></a>
                    </div>
                    <div class="wcpb-install-notice-button">
                        <a class="install-wcpb-button button button-primary" data-slug="woocommerce" href="<?php echo add_query_arg(array('action' => 'install_woocommerce_free'), admin_url()); ?>"><?php _e('Install WooCommerce', 'wcpb'); ?></a>
                    </div>
                </div>
                <div id="wcpb_install_msg"></div>
            </div>
            <?php
        }

        public function activate_woocommerce_free() {
            activate_plugin('woocommerce/woocommerce.php' );
            wp_redirect(admin_url('admin.php?page=wc-settings&tab=settings-product-banner-image'));
		    exit();
        }

        public function install_woocommerce_plugin(){
            include(ABSPATH . 'wp-admin/includes/plugin-install.php');
            include(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
    
            if ( ! class_exists('Plugin_Upgrader')){
                include(ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php');
            }
            if ( ! class_exists('Plugin_Installer_Skin')) {
                include( ABSPATH . 'wp-admin/includes/class-plugin-installer-skin.php' );
            }
    
            $plugin = 'woocommerce';
    
            $api = plugins_api( 'plugin_information', array(
                'slug'      => $plugin,
                'fields'    => array(
                    'short_description' => false,
                    'sections'          => false,
                    'requires'          => false,
                    'last_updated'      => false,
                    'compatibility'     => false,
                ),
            ) );
    
            if ( is_wp_error( $api ) ) {
                wp_die( $api );
            }
    
            $title = sprintf( __('Installing Plugin: %s'), $api->name . ' ' . $api->version );
            $nonce = 'install-plugin_' . $plugin;
            $url = 'update.php?action=install-plugin&plugin=' . urlencode( $plugin );
    
            $upgrader = new \Plugin_Upgrader( new \Plugin_Installer_Skin( compact('title', 'url', 'nonce', 'plugin', 'api') ) );
            $upgrader->install($api->download_link);
            die();
        }
        
        public static function wc_low_version(){
            printf(
                '<div class="notice notice-error is-dismissible"><p>%1$s <a target="_blank" href="%2$s">%3$s</a> %4$s</p></div>', 
                __('Your','wcpb'), 
                'https://wordpress.org/plugins/woocommerce/', 
                __('WooCommerce','wcpb'), 
                __('version is below then 3.0, please update.','wcpb') 
            );
        }
    }
}
