<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(
    # Enable Product Banner
    array(
        'id'        => 'enable_shop_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Shop Page Banner','banner-image'),
        'desc'      => '<p>'.__('Enable Banner Image','banner-image').'</p>',
    ),

    # Banner Image
    array(
        'id'        => 'shop_page_banner_image',
        'type'      => 'image',
        'value'     => 'true',
        'label'     => __('Upload Banner Image','banner-image'),
    ),

    # Shop Page Banner Sub Heading
    array(
        'id'        => 'shop_page_banner_sub_heading',
        'label'     => __('Banner Sub Heading','banner-image'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Write Shop Page Banner Sub Heading', 'banner-image').'</p>',
    ),

    # Shop Page Banner Title
    array(
        'id'        => 'shop_page_banner_title',
        'label'     => __('Banner Title','banner-image'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Write banner title', 'banner-image').'</p>',
    ),

    # Shop Page Banner Short Description
    array(
        'id'        => 'shop_page_banner_short_desc',
        'label'     => __('Banner Short Description','banner-image'),
        'type'      => 'textarea',
        'value'     => '',
        'desc'      => '<p>'.__('Write banner short description', 'banner-image').'</p>',
    ),

    # Shop page Banner Button Name
    array(
        'id'        => 'shop_page_banner_button_name',
        'label'     => __('Banner Button Name','banner-image'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Write banner button name', 'banner-image').'</p>',
    ),

    # Shop Page Banner Button URL
    array(
        'id'        => 'shop_page_banner_button_url',
        'label'     => __('Banner Button URL','banner-image'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Add button URL', 'banner-image').'</p>',
    ),

    array(
        'id'        => 'enable_link_full_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Link full Banner','banner-image'),
    ),

    # Save Function
    array(
        'id'        => 'biw_general_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

banner_image_function()->generator( $settings );
