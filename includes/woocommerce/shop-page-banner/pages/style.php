<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(
    array(
        'id'        => 'shop_page_banner_text_align',
        'type'      => 'dropdown', 
        'option'    => array(
            'left'    => __('Left Align','wppb'),
            'right'    => __('Right Align','wppb'),
            'center'    => __('Center Align','wppb'),
        ),
        'label'     => __('Banner Text Align','wppb'),
        'desc'      => __('Default text align left.','wppb'),
    ),

    array (
        'id'        => 'shop_banner_image_height',
        'label'     => __('Banner height', 'wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write height. Ex. 300', 'wppb').'</p>',
    ),

    array( 
        'id'        => 'shop_page_banner_overlay_color',
        'type'      => 'color',
        'label'     => __('Banner Overlay Color','wppb'),
        'desc'      => __('Select background overlay color.', 'wppb'),
        'value'     => '',
    ),

    array (
        'id'        => 'shop_page_banner_image_overlay_opacity',
        'label'     => __('Overlay Opacity', 'wppb'),
        'type'      => 'numberOverlay', 
        'value'     => '',
        'desc'      => '<p>'.__('Write height. Ex. .5', 'wppb').'</p>',
    ),

    #Sub Heading style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Sub Title Style Settings','wppb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_subtitle_color',
        'type'      => 'color',
        'label'     => __('Banner subtitle Color','wppb'),
        'desc'      => __('Select button background color.','wppb'),
        'value'     => '#000000',
    ),

    # Product Banner subtitle 
    array (
        'id'        => 'shop_banner_subtitle_font_size',
        'label'     => __('Banner subtitle Font Size','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write subtitle font size. Ex. 44', 'wppb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_subtitle_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','wppb'),
            '500'    => __('500','wppb'),
            '600'    => __('600','wppb'),
            '700'    => __('700','wppb'),
            '800'    => __('800','wppb'),
            '900'    => __('900','wppb'),
        ),
        'label'     => __('Banner subtitle Font Weight','wppb'),
    ),

    array (
        'id'        => 'shop_banner_subtitle_line_height',
        'label'     => __('Banner subtitle Line Height','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write subtitle line height. Ex. 40', 'wppb').'</p>',
    ),

    #Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Title Style Settings','wppb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_title_color',
        'type'      => 'color',
        'label'     => __('Banner Title Color','wppb'),
        'desc'      => __('Select button background color.','wppb'),
        'value'     => '#000000',
    ),

    # Product Banner Title 
    array (
        'id'        => 'shop_banner_title_font_size',
        'label'     => __('Banner Title Font Size','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Title font size. Ex. 44', 'wppb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_title_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','wppb'),
            '500'    => __('500','wppb'),
            '600'    => __('600','wppb'),
            '700'    => __('700','wppb'),
            '800'    => __('800','wppb'),
            '900'    => __('900','wppb'),
        ),
        'label'     => __('Banner Title Font Weight','wppb'),
    ),

    array (
        'id'        => 'shop_banner_title_line_height',
        'label'     => __('Banner Title Line Height','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Title line height. Ex. 40', 'wppb').'</p>',
    ),

    # Short description Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Short Description Style Settings','wppb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_desc_color',
        'type'      => 'color',
        'label'     => __('Banner desc Color','wppb'),
        'desc'      => __('Select button background color.','wppb'),
        'value'     => '#000000',
    ),

    # Product Banner desc 
    array (
        'id'        => 'shop_banner_desc_font_size',
        'label'     => __('Banner desc Font Size','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write desc font size. Ex. 44', 'wppb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_desc_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '300'    => __('300','wppb'),
            '400'    => __('400','wppb'),
            '500'    => __('500','wppb'),
            '600'    => __('600','wppb'),
            '700'    => __('700','wppb'),
            '800'    => __('800','wppb'),
            '900'    => __('900','wppb'),
        ),
        'label'     => __('Banner desc Font Weight','wppb'),
    ),

    array (
        'id'        => 'shop_banner_desc_line_height',
        'label'     => __('Banner desc Line Height','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write desc line height. Ex. 40', 'wppb').'</p>',
    ),

    # Button Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Button Style Settings','wppb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_page_banner_button_text_color',
        'type'      => 'color',
        'label'     => __('Banner button text Color','wppb'),
        'desc'      => __('Select button text color.','wppb'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'shop_page_banner_button_bg_color',
        'type'      => 'color',
        'label'     => __('Button BG Color','wppb'),
        'desc'      => __('Select button background color.','wppb'),
        'value'     => '#000000',
    ),

    array(
        'id'        => 'shop_page_banner_button_text_hover_color',
        'type'      => 'color',
        'label'     => __('Button text hover Color','wppb'),
        'desc'      => __('Select button background color.','wppb'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'shop_page_banner_button_bg_hover_color',
        'type'      => 'color',
        'label'     => __('Button BG Hover Color','wppb'),
        'desc'      => __('Select button background hover color.','wppb'),
        'value'     => '#000000',
    ),

    # Product Banner desc 
    array (
        'id'        => 'shop_banner_button_font_size',
        'label'     => __('Banner button Font Size','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write button font size. Ex. 44', 'wppb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_button_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','wppb'),
            '500'    => __('500','wppb'),
            '600'    => __('600','wppb'),
            '700'    => __('700','wppb'),
            '800'    => __('800','wppb'),
            '900'    => __('900','wppb'),
        ),
        'label'     => __('Banner button Font Weight','wppb'),
    ),

    array (
        'id'        => 'shop_banner_button_line_height',
        'label'     => __('Banner button Line Height','wppb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write button line height. Ex. 40', 'wppb').'</p>',
    ),


    array (
        'id'        => 'shop_banner_button_padding',
        'label'     => __('Banner Button Padding', 'wppb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Add button Padding. Ex. 10px 20px 10px 20px', 'wppb').'</p>',
    ),

    array (
        'id'        => 'shop_banner_button_margin',
        'label'     => __('Banner Button Margin', 'wppb'),
        'type'      => 'text', 
        'value'     => '',
        'desc'      => '<p>'.__('Add button margin. Ex. 10px 20px 10px 20px', 'wppb').'</p>',
    ),

    # Save Function
    array(
        'id'        => 'wpbi_shop_style_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

wpbi_function()->generator( $arr );
