<?php

defined( 'ABSPATH' ) || exit;


function product_single_page_banner_style() {
    $settings = array (
        'section_title' => array(
            'name'     => __( 'Shop Page Banner ', 'wcpb' ),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_tab_demo_title'
        ),

        '' => array(
            'name' => __( 'Enable Free shipping notices' ),
            'type' => 'checkbox',
            'desc' => __( 'Show the free shipping threshold on product page'),
            'id'	=> 'enable'

        ),

        'banner_title' => array(
            'name' => __( 'Banner Title', 'wcpb' ),
            'type' => 'text',
            'desc' => __( 'Default Page Gift Proceed with added', 'wcpb' ),
            'id'   => 'wc_settings_tab_banner_title',
            'default' => ''
        ),

        'banner_short_desc' => array(
            'name' => __( 'Banner Short desc', 'wcpb' ),
            'type' => 'text',
            'desc' => __( 'Default Page Gift Proceed with added', 'wcpb' ),
            'id'   => 'wc_settings_tab_banner_desc',
            'default' => ''
        ),

        'banner_btn_name' => array(
            'name' => __( 'Banner Button Name', 'wcpb' ),
            'type' => 'text',
            'desc' => __( 'Default Page Gift Proceed with added', 'wcpb' ),
            'id'   => 'wc_settings_tab_btn_name',
            'default' => ''
        ),

        'banner_btn_url' => array(
            'name' => __( 'Banner Button URL', 'wcpb' ),
            'type' => 'text',
            'desc' => __( 'Default Page Gift Proceed with added', 'wcpb' ),
            'id'   => 'wc_settings_tab_btn_url',
            'default' => ''
        ),

        'banner_banner_image' => array(
            'name' => __( 'Upload Image', 'wcpb' ),
            'type' => 'image',
            'desc' => __( 'Default Page Gift Proceed with added', 'wcpb' ),
            'id'   => 'wc_settings_tab_banner_image',
            'default' => ''
        ),

        'section_end' => array(
            'type' => 'sectionend',
            'id' 	=> 'wc_settings_tab_shortcode'
        )
    );
    
    return $settings;
}
