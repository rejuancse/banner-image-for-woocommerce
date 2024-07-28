<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(
    # Enable Product Banner
    array(
        'id'        => 'enable_category_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Category Page Banner', 'banner-image'),
        'desc'      => __('Enable Banner Image', 'banner-image'),
    ),

    # Save Function
    array(
        'id'        => 'biw_category_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

banner_image_function()->generator( $settings );
