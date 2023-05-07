<?php

namespace WPPB;

use WP_Query;

defined('ABSPATH') || exit;

class WPPB_Functions {

    public function generator($arr) {
        require_once WPPB_DIR_PATH . 'settings/Generator.php';
        $generator = new \WPPB\settings\WPPB_Settings_Generator();
        $generator->generator($arr);
    }

    public function post($post_item) {
        if (!empty($_POST[$post_item])) {
            return $_POST[$post_item];
        }
        return null;
    }

    public function update_text($option_name = '', $option_value = null) {
        update_option($option_name, $option_value);
    }

    public function update_checkbox($option_name = '', $option_value = null, $checked_default_value = 'false') {
        if (!empty($option_value)) {
            update_option($option_name, $option_value);
        } else {
            update_option($option_name, $checked_default_value);
        }
    }

    public function update_meta($post_id, $meta_name = '', $meta_value = '', $checked_default_value = '') {
        if (!empty($meta_value)) {
            update_post_meta($post_id, $meta_name, $meta_value);
        } else {
            update_post_meta($post_id, $meta_name, $checked_default_value);
        }
    }

    public function wc_version($version = '3.0') {
        if (class_exists('WooCommerce')) {
            if (version_compare(WC()->version, $version, ">=")) {
                return true;
            }
        }
        return false;
    }

    public function is_woocommerce() {
        $vendor = get_option('vendor_type', 'woocommerce');
        if ($vendor == 'woocommerce') {
            return true;
        } else {
            return false;
        }
    }

    public function url($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
}
