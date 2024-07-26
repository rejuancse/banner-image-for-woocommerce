<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(
    array(
        'id'        => 'shop_page_banner_text_align',
        'type'      => 'dropdown',
        'option'    => array(
            'left'    => __('Left Align', 'biw'),
            'right'    => __('Right Align', 'biw'),
            'center'    => __('Center Align', 'biw'),
        ),
        'label'     => __('Banner Text Align', 'biw'),
        'desc'      => __('Default text align left.', 'biw'),
    ),

    array (
        'id'        => 'shop_banner_image_height',
        'label'     => __('Banner height', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write height. Ex. 300', 'biw').'</p>',
    ),

    #Sub Heading style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Sub Title Style Settings', 'biw'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_subtitle_color',
        'type'      => 'color',
        'label'     => __('Banner subtitle Color', 'biw'),
        'desc'      => __('Select button background color.', 'biw'),
        'value'     => '#000000',
    ),

    # Product Banner subtitle
    array (
        'id'        => 'shop_banner_subtitle_font_size',
        'label'     => __('Banner subtitle Font Size', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write subtitle font size. Ex. 44', 'biw').'</p>',
    ),

    array(
        'id'        => 'shop_banner_subtitle_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('300', 'biw'),
            '400'    => __('400', 'biw'),
            '500'    => __('500', 'biw'),
            '600'    => __('600', 'biw'),
            '700'    => __('700', 'biw'),
            '800'    => __('800', 'biw'),
            '900'    => __('900', 'biw'),
        ),
        'label'     => __('Banner subtitle Font Weight', 'biw'),
    ),

    array (
        'id'        => 'shop_banner_subtitle_line_height',
        'label'     => __('Banner subtitle Line Height', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write subtitle line height. Ex. 40', 'biw').'</p>',
    ),

    #Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Title Style Settings', 'biw'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_title_color',
        'type'      => 'color',
        'label'     => __('Banner Title Color', 'biw'),
        'desc'      => __('Select button background color.', 'biw'),
        'value'     => '#000000',
    ),

    # Product Banner Title
    array (
        'id'        => 'shop_banner_title_font_size',
        'label'     => __('Banner Title Font Size', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write Title font size. Ex. 44', 'biw').'</p>',
    ),

    array(
        'id'        => 'shop_banner_title_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400', 'biw'),
            '500'    => __('500', 'biw'),
            '600'    => __('600', 'biw'),
            '700'    => __('700', 'biw'),
            '800'    => __('800', 'biw'),
            '900'    => __('900', 'biw'),
        ),
        'label'     => __('Banner Title Font Weight', 'biw'),
    ),

    array (
        'id'        => 'shop_banner_title_line_height',
        'label'     => __('Banner Title Line Height', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write Title line height. Ex. 40', 'biw').'</p>',
    ),

    # Short description Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Short Description Style Settings', 'biw'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_desc_color',
        'type'      => 'color',
        'label'     => __('Banner desc Color', 'biw'),
        'desc'      => __('Select button background color.', 'biw'),
        'value'     => '#000000',
    ),

    # Product Banner desc
    array (
        'id'        => 'shop_banner_desc_font_size',
        'label'     => __('Banner desc Font Size', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write desc font size. Ex. 44', 'biw').'</p>',
    ),

    array(
        'id'        => 'shop_banner_desc_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '300'    => __('300', 'biw'),
            '400'    => __('400', 'biw'),
            '500'    => __('500', 'biw'),
            '600'    => __('600', 'biw'),
            '700'    => __('700', 'biw'),
            '800'    => __('800', 'biw'),
            '900'    => __('900', 'biw'),
        ),
        'label'     => __('Banner desc Font Weight', 'biw'),
    ),

    array (
        'id'        => 'shop_banner_desc_line_height',
        'label'     => __('Banner desc Line Height', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write desc line height. Ex. 40', 'biw').'</p>',
    ),

    # Button Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Button Style Settings', 'biw'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_page_banner_button_text_color',
        'type'      => 'color',
        'label'     => __('Banner button text Color', 'biw'),
        'desc'      => __('Select button text color.', 'biw'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'shop_page_banner_button_bg_color',
        'type'      => 'color',
        'label'     => __('Button BG Color', 'biw'),
        'desc'      => __('Select button background color.', 'biw'),
        'value'     => '#000000',
    ),

    array(
        'id'        => 'shop_page_banner_button_text_hover_color',
        'type'      => 'color',
        'label'     => __('Button text hover Color', 'biw'),
        'desc'      => __('Select button background color.', 'biw'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'shop_page_banner_button_bg_hover_color',
        'type'      => 'color',
        'label'     => __('Button BG Hover Color', 'biw'),
        'desc'      => __('Select button background hover color.', 'biw'),
        'value'     => '#000000',
    ),

    # Product Banner desc
    array (
        'id'        => 'shop_banner_button_font_size',
        'label'     => __('Banner button Font Size', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write button font size. Ex. 44', 'biw').'</p>',
    ),

    array(
        'id'        => 'shop_banner_button_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400', 'biw'),
            '500'    => __('500', 'biw'),
            '600'    => __('600', 'biw'),
            '700'    => __('700', 'biw'),
            '800'    => __('800', 'biw'),
            '900'    => __('900', 'biw'),
        ),
        'label'     => __('Banner button Font Weight', 'biw'),
    ),

    array (
        'id'        => 'shop_banner_button_line_height',
        'label'     => __('Banner button Line Height', 'biw'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => '<p>'.__('Write button line height. Ex. 40', 'biw').'</p>',
    ),

    array (
        'id'        => 'shop_banner_button_padding',
        'label'     => __('Banner Button Padding', 'biw'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Add button Padding. Ex. 10px 20px 10px 20px', 'biw').'</p>',
    ),

    array (
        'id'        => 'shop_banner_button_margin',
        'label'     => __('Banner Button Margin', 'biw'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => '<p>'.__('Add button margin. Ex. 10px 20px 10px 20px', 'biw').'</p>',
    ),

    # Save Function
    array(
        'id'        => 'biw_shop_style_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

biw_function()->generator( $arr );
