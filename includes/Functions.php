<?php

namespace BIFW;

use WP_Query;

defined('ABSPATH') || exit;

class Functions {

    public function generator($arr) {
        require_once BIFW_PATH . '/includes/settings/Generator.php';
        $generator = new settings\Generator;
        $generator->generator($arr);
    }

    public function post($post_item, $nonce_action = '', $nonce_field = '') {
        if (!empty($_POST[$post_item])) {
            if ($nonce_action && $nonce_field) {
                if (isset($_POST[$nonce_field]) && wp_verify_nonce(sanitize_text_field($_POST[$nonce_field]), $nonce_action)) {
                    return sanitize_text_field($_POST[$post_item]);
                } else {
                    return null;
                }
            } else {
                return sanitize_text_field($_POST[$post_item]);
            }
        }
        return null;
    }

    public function update_text($biw_option_name = '', $biw_option_value = null) {
        update_option($biw_option_name, $biw_option_value);
    }

    public function update_checkbox(
        $biw_option_name = '',
        $biw_option_value = null,
        $checked_default_value = 'false'
        ) {
        if (!empty($biw_option_value)) {
            update_option($biw_option_name, $biw_option_value);
        } else {
            update_option($biw_option_name, $checked_default_value);
        }
    }

    public function update_meta(
        $post_id, $meta_name = '',
        $meta_value = '',
        $checked_default_value = ''
        ) {
        if (!empty($meta_value)) {
            update_post_meta($post_id, $meta_name, $meta_value);
        } else {
            update_post_meta($post_id, $meta_name, $checked_default_value);
        }
    }

    public function url($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
}
