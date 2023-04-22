<?php

defined( 'ABSPATH' ) || exit;

function default_settings() {
    $settings = array(
        'section_title' => array(
            'name'     => __( 'General Settings', 'wcpb' ),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_tab_demo_section_title'
        ),

        'disable_shop_page_banner' => array(
            'name' => __( 'Disable Shop page Banner image' ),
            'type' => 'checkbox',
            'desc' => __( 'Disable'),
            'id'	=> 'disable_shop_banner'
        ),

        'disable_category_page_banner' => array(
            'name' => __( 'Disable Category page Banner image' ),
            'type' => 'checkbox',
            'desc' => __( 'Disable'),
            'id'	=> 'disable_category_banner'
        ),

        'disable_product_single_page_banner' => array(
            'name' => __( 'Disable product single page Banner image' ),
            'type' => 'checkbox',
            'desc' => __( 'Disable'),
            'id'	=> 'disable_product_single_banner'
        ),

        'section_end' => array(
            'type' 	=> 'sectionend',
            'id' 	=> 'wc_settings_tab_demo_section_default'
        )
    );

    return $settings;
}
