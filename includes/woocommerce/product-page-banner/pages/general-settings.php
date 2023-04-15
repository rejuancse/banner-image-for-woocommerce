<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(

    # Enable Product Banner
    array(
        'id'        => 'enable_product_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Product Banner','wcpb'),
        'desc'      => '<p>'.__('Enable Banner Image','wcpb').'</p>',
    ),

    # Banner Image
    array(
        'id'        => 'wpbi_product_banner_image',
        'type'      => 'image',
        'value'     => 'true',
        'label'     => __('Upload Banner Image','wcpb'),
    ),

    # Product Banner Title 
    array(
        'id'        => 'product_banner_title',
        'label'     => __('Product Banner Title','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write product page banner title', 'wcpb').'</p>',
    ),

    # Product Banner Short Description
    array(
        'id'        => 'product_banner_short_text',
        'label'     => __('Product Banner Short Description','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write product page banner title', 'wcpb').'</p>',
    ),

    # Product Banner Button Name
    array(
        'id'        => 'product_banner_button_name',
        'label'     => __('Product Banner Button Name','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Write banner button name', 'wcpb').'</p>',
    ),

    # Product Banner Button URL
    array(
        'id'        => 'product_banner_button_url',
        'label'     => __('Product Banner Button URL','wcpb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Add button URL', 'wcpb').'</p>',
    ),

    # Save Function
    array(
        'id'        => 'wpbi_product_general_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

wpbi_function()->generator( $arr );
