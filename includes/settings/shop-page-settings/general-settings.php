<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(
    # Enable Product Banner
    array(
        'id'        => 'enable_shop_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Shop Page Banner', 'biw'),
        'desc'      => '<p>'.__('Enable Banner Image', 'biw').'</p>',
    ),

    # Banner Image
    array(
        'id'        => 'shop_page_banner_image',
        'type'      => 'image',
        'value'     => 'true',
        'label'     => __('Upload Banner Image','biw'),
    ),

    # Shop Page Banner Sub Heading
    array(
        'id'        => 'shop_page_banner_sub_heading',
        'label'     => __('Banner Sub Heading','biw'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Write Shop Page Banner Sub Heading', 'biw').'</p>',
    ),

    # Shop Page Banner Title
    array(
        'id'        => 'shop_page_banner_title',
        'label'     => __('Banner Title','biw'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Write banner title', 'biw').'</p>',
    ),

    # Shop Page Banner Short Description
    array(
        'id'        => 'shop_page_banner_short_desc',
        'label'     => __('Banner Short Description','biw'),
        'type'      => 'textarea',
        'value'     => '',
        'desc'      => '<p>'.__('Write banner short description', 'biw').'</p>',
    ),

    # Shop page Banner Button Name
    array(
        'id'        => 'shop_page_banner_button_name',
        'label'     => __('Banner Button Name','biw'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Write banner button name', 'biw').'</p>',
    ),

    # Shop Page Banner Button URL
    array(
        'id'        => 'shop_page_banner_button_url',
        'label'     => __('Banner Button URL','biw'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Add button URL', 'biw').'</p>',
    ),

    array(
        'id'        => 'enable_link_full_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Link full Banner','biw'),
    ),

    # Save Function
    array(
        'id'        => 'biw_general_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

biw_function()->generator( $settings );
