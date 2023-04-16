<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(

    # Enable Product Banner
    array(
        'id'        => 'enable_shop_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Shop Page Banner','wcpb'),
        'desc'      => '<p>'.__('Enable Banner Image','wcpb').'</p>',
    ),

    # Banner Image
    array(
        'id'        => 'shop_page_banner_image',
        'type'      => 'image',
        'value'     => 'true',
        'label'     => __('Upload Banner Image','wcpb'),
    ),

    # Shop Page Banner Sub Heading
    array(
        'id'        => 'shop_page_banner_sub_heading',
        'label'     => __('Banner Sub Heading','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Shop Page Banner Sub Heading', 'wcpb').'</p>',
    ),

    # Shop Page Banner Title 
    array(
        'id'        => 'shop_page_banner_title',
        'label'     => __('Banner Title','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner title', 'wcpb').'</p>',
    ),

    # Shop Page Banner Short Description
    array(
        'id'        => 'shop_page_banner_short_desc',
        'label'     => __('Banner Short Description','wcpb'),
        'type'      => 'textarea', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner short description', 'wcpb').'</p>',
    ),

    # Shop page Banner Button Name
    array(
        'id'        => 'shop_page_banner_button_name',
        'label'     => __('Banner Button Name','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner button name', 'wcpb').'</p>',
    ),

    # Shop Page Banner Button URL
    array(
        'id'        => 'shop_page_banner_button_url',
        'label'     => __('Banner Button URL','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Add button URL', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'enable_link_full_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Link full Banner','wcpb'),
    ),

    # Save Function
    array(
        'id'        => 'wpbi_shop_general_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

wpbi_function()->generator( $arr );
