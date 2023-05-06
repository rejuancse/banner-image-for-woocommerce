<?php

defined( 'ABSPATH' ) || exit;

$settings = array (
    'section_title' => array(
        'name'     => __( 'General Settings', 'wppb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_tab_demo_section_title'
    ),

    'disable_shop_page_banner' => array (
        'name' => __( 'Disable Shop page Banner image' ),
        'type' => 'checkbox',
        'desc' => __( 'Disable'),
        'id'	=> 'disable_shop_banner',
        'default' => 'no'
    ),

    'disable_category_page_banner' => array(
        'name' => __( 'Disable Category page Banner image' ),
        'type' => 'checkbox',
        'desc' => __( 'Disable'),
        'id'	=> 'disable_category_banner',
        'default' => 'no'
    ),

    'disable_product_single_page_banner' => array(
        'name' => __( 'Disable product single page Banner image' ),
        'type' => 'checkbox',
        'desc' => __( 'Disable'),
        'id'	=> 'disable_product_single_banner',
        'default' => 'no'
    ),

    'section_end' => array(
        'type' 	=> 'sectionend',
        'id' 	=> 'wc_settings_tab_demo_section_default'
    )
);

return $settings;
