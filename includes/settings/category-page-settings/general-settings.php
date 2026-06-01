<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(
    # Enable Product Banner
    array(
        'id'        => 'enable_category_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Category Page Banner', 'banner-image-for-woocommerce'),
        'desc'      => __('Enable Banner Image', 'banner-image-for-woocommerce'),
    ),

    # Save Function
    array(
        'id'        => 'biw_category_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

banner_image_function()->generator( $settings );
