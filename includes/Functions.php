<?php

namespace WCPB\WC_Product_Banner;

use WP_Query;

defined('ABSPATH') || exit;

class Functions {

    public function update_text($option_name = '', $option_value = null) {
        if (!empty($option_value)) {
            update_option($option_name, $option_value);
        }
    }
}
