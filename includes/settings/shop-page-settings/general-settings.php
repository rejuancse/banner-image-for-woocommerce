<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(
    # Enable Product Banner
    array(
        'id'        => 'enable_shop_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Shop Page Banner', 'banner-image-for-woocommerce'),
        'desc'      => __('Enable Banner Image', 'banner-image-for-woocommerce'),
    ),

    # Banner Image
    array(
        'id'        => 'shop_page_banner_image',
        'type'      => 'image',
        'value'     => 'true',
        'label'     => __('Upload Banner Image','banner-image-for-woocommerce'),
    ),

    # Shop Page Banner Sub Heading
    array(
        'id'        => 'shop_page_banner_sub_heading',
        'label'     => __('Banner Sub Heading','banner-image-for-woocommerce'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => __('Write Shop Page Banner Sub Heading', 'banner-image-for-woocommerce'),
    ),

    # Shop Page Banner Title
    array(
        'id'        => 'shop_page_banner_title',
        'label'     => __('Banner Title','banner-image-for-woocommerce'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => __('Write banner title', 'banner-image-for-woocommerce'),
    ),

    # Shop Page Banner Short Description
    array(
        'id'        => 'shop_page_banner_short_desc',
        'label'     => __('Banner Short Description','banner-image-for-woocommerce'),
        'type'      => 'textarea',
        'value'     => '',
        'desc'      => __('Write banner short description', 'banner-image-for-woocommerce'),
    ),

    # Shop page Banner Button Name
    array(
        'id'        => 'shop_page_banner_button_name',
        'label'     => __('Banner Button Name','banner-image-for-woocommerce'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => __('Write banner button name', 'banner-image-for-woocommerce'),
    ),

    # Shop Page Banner Button URL
    array(
        'id'        => 'shop_page_banner_button_url',
        'label'     => __('Banner Button URL','banner-image-for-woocommerce'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => __('Add button URL', 'banner-image-for-woocommerce'),
    ),

    array(
        'id'        => 'enable_link_full_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Link full Banner','banner-image-for-woocommerce'),
    ),

    # Save Function
    array(
        'id'        => 'biw_general_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

banner_image_function()->generator( $settings );
