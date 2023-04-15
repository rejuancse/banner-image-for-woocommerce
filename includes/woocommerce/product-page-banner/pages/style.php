<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(

    array(
        'id'        => 'product_banner_text_align',
        'type'      => 'dropdown',
        'option'    => array(
            'left'    => __('Left Align','wcpb'),
            'right'    => __('Right Align','wcpb'),
            'center'    => __('Center Align','wcpb'),
        ),
        'label'     => __('Banner Text Align','wcpb'),
        'desc'      => __('Default text align left.','wcpb'),
    ),

    #Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Title Style Settings','wcpb'),
        'top_line'  => 'true',
    ),

    # Product Banner Title 
    array (
        'id'        => 'product_banner_title_font_size',
        'label'     => __('Banner Title Font Size','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Title font size. Ex. 44', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'product_banner_title_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','wcpb'),
            '500'    => __('500','wcpb'),
            '600'    => __('600','wcpb'),
            '700'    => __('700','wcpb'),
            '800'    => __('800','wcpb'),
            '900'    => __('900','wcpb'),
        ),
        'label'     => __('Banner Title Font Weight','wcpb'),
    ),

    array (
        'id'        => 'product_banner_title_live_height',
        'label'     => __('Banner Title Line Height','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Title line height. Ex. 40', 'wcpb').'</p>',
    ),

    # Button Background Color
    array(
        'id'        => 'wp_button_bg_color',
        'type'      => 'color',
        'label'     => __('Button BG Color','xewc'),
        'desc'      => __('Select button background color.','xewc'),
        'value'     => '#1adc68',
    ),

    # Save Function
    array(
        'id'        => 'wpbi_product_style_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

wpbi_function()->generator( $arr );
