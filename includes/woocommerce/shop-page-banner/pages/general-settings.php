<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(

    # Enable Product Banner
    array(
        'id'        => 'enable_shop_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Shop Page Banner','wppb'),
        'desc'      => '<p>'.__('Enable Banner Image','wppb').'</p>',
    ), 

    # Banner Image
    array(
        'id'        => 'shop_page_banner_image',
        'type'      => 'image',
        'value'     => 'true',
        'label'     => __('Upload Banner Image','wppb'),
    ),

    # Shop Page Banner Sub Heading
    array(
        'id'        => 'shop_page_banner_sub_heading',
        'label'     => __('Banner Sub Heading','wppb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Shop Page Banner Sub Heading', 'wppb').'</p>',
    ),

    # Shop Page Banner Title 
    array(
        'id'        => 'shop_page_banner_title',
        'label'     => __('Banner Title','wppb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner title', 'wppb').'</p>',
    ),

    # Shop Page Banner Short Description
    array(
        'id'        => 'shop_page_banner_short_desc',
        'label'     => __('Banner Short Description','wppb'),
        'type'      => 'textarea', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner short description', 'wppb').'</p>',
    ),

    # Shop page Banner Button Name
    array(
        'id'        => 'shop_page_banner_button_name',
        'label'     => __('Banner Button Name','wppb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner button name', 'wppb').'</p>',
    ),

    # Shop Page Banner Button URL
    array(
        'id'        => 'shop_page_banner_button_url',
        'label'     => __('Banner Button URL','wppb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Add button URL', 'wppb').'</p>',
    ),

    array(
        'id'        => 'enable_link_full_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Link full Banner','wppb'),
    ),

    # Save Function
    array(
        'id'        => 'wpbi_shop_general_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

wppb_function()->generator( $settings );
