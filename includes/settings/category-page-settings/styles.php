<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(
    array(
        'id'        => 'category_banner_text_align',
        'type'      => 'dropdown',
        'option'    => array(
            'left'    => __('Left Align','banner-image'),
            'right'    => __('Right Align','banner-image'),
            'center'    => __('Center Align','banner-image'),
        ),
        'label'     => __('Banner Text Align','banner-image'),
        'desc'      => __('Default text align left.','banner-image'),
    ),

    array (
        'id'        => 'category_banner_height',
        'label'     => __('Banner height', 'banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write height. Ex. 300', 'banner-image'),
    ),

    #Sub Heading style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Sub Title Style Settings','banner-image'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'category_banner_subtitle_color',
        'type'      => 'color',
        'label'     => __('Banner subtitle Color','banner-image'),
        'desc'      => __('Select button background color.','banner-image'),
        'value'     => '#000000',
    ),

    # Product Banner subtitle
    array (
        'id'        => 'category_banner_subtitle_fontsize',
        'label'     => __('Banner subtitle Font Size','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write subtitle font size. Ex. 44', 'banner-image'),
    ),

    array(
        'id'        => 'category_banner_subtitle_fontweight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','banner-image'),
            '500'    => __('500','banner-image'),
            '600'    => __('600','banner-image'),
            '700'    => __('700','banner-image'),
            '800'    => __('800','banner-image'),
            '900'    => __('900','banner-image'),
        ),
        'label'     => __('Banner subtitle Font Weight','banner-image'),
    ),

    array (
        'id'        => 'category_banner_subtitle_lineheight',
        'label'     => __('Banner subtitle Line Height','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write subtitle line height. Ex. 40', 'banner-image'),
    ),

    #Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Title Style Settings','banner-image'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'category_banner_title_color',
        'type'      => 'color',
        'label'     => __('Banner Title Color','banner-image'),
        'desc'      => __('Select button background color.','banner-image'),
        'value'     => '#000000',
    ),

    # Product Banner Title
    array (
        'id'        => 'category_banner_title_fontsize',
        'label'     => __('Banner Title Font Size','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write Title font size. Ex. 44', 'banner-image'),
    ),

    array(
        'id'        => 'category_banner_title_fontweight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','banner-image'),
            '500'    => __('500','banner-image'),
            '600'    => __('600','banner-image'),
            '700'    => __('700','banner-image'),
            '800'    => __('800','banner-image'),
            '900'    => __('900','banner-image'),
        ),
        'label'     => __('Banner Title Font Weight','banner-image'),
    ),

    array (
        'id'        => 'category_banner_title_lineheight',
        'label'     => __('Banner Title Line Height','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write Title line height. Ex. 40', 'banner-image'),
    ),

    # Short description Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Short Description Style Settings','banner-image'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'category_banner_desc_color',
        'type'      => 'color',
        'label'     => __('Banner desc Color','banner-image'),
        'desc'      => __('Select button background color.','banner-image'),
        'value'     => '#000000',
    ),

    # Product Banner desc
    array (
        'id'        => 'category_banner_desc_fontsize',
        'label'     => __('Banner desc Font Size','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write desc font size. Ex. 44', 'banner-image'),
    ),

    array(
        'id'        => 'category_banner_desc_fontweight',
        'type'      => 'dropdown',
        'option'    => array(
            '300'    => __('300','banner-image'),
            '400'    => __('400','banner-image'),
            '500'    => __('500','banner-image'),
            '600'    => __('600','banner-image'),
            '700'    => __('700','banner-image'),
            '800'    => __('800','banner-image'),
            '900'    => __('900','banner-image'),
        ),
        'label'     => __('Banner desc Font Weight','banner-image'),
    ),

    array (
        'id'        => 'category_banner_desc_lineheight',
        'label'     => __('Banner desc Line Height','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write desc line height. Ex. 40', 'banner-image'),
    ),

    # Button Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Button Style Settings','banner-image'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'category_banner_button_text_color',
        'type'      => 'color',
        'label'     => __('Banner button text Color','banner-image'),
        'desc'      => __('Select button text color.','banner-image'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'category_banner_button_bg_color',
        'type'      => 'color',
        'label'     => __('Button BG Color','banner-image'),
        'desc'      => __('Select button background color.','banner-image'),
        'value'     => '#000000',
    ),

    array(
        'id'        => 'category_banner_button_text_hover_color',
        'type'      => 'color',
        'label'     => __('Button text hover Color','banner-image'),
        'desc'      => __('Select button background color.','banner-image'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'category_banner_button_bg_hover_color',
        'type'      => 'color',
        'label'     => __('Button BG Hover Color','banner-image'),
        'desc'      => __('Select button background hover color.','banner-image'),
        'value'     => '#000000',
    ),

    # Product Banner desc
    array (
        'id'        => 'category_banner_button_fontsize',
        'label'     => __('Banner button Font Size','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write button font size. Ex. 44', 'banner-image'),
    ),

    array(
        'id'        => 'category_banner_button_fontweight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','banner-image'),
            '500'    => __('500','banner-image'),
            '600'    => __('600','banner-image'),
            '700'    => __('700','banner-image'),
            '800'    => __('800','banner-image'),
            '900'    => __('900','banner-image'),
        ),
        'label'     => __('Banner button Font Weight','banner-image'),
    ),

    array (
        'id'        => 'category_banner_button_lineheight',
        'label'     => __('Banner button Line Height','banner-image'),
        'type'      => 'number',
        'value'     => '',
        'desc'      => __('Write button line height. Ex. 40', 'banner-image'),
    ),

    array (
        'id'        => 'category_banner_button_padding',
        'label'     => __('Banner Button Padding', 'banner-image'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => __('Add button Padding. Ex. 10px 20px 10px 20px', 'banner-image'),
    ),

    array (
        'id'        => 'category_banner_button_margin',
        'label'     => __('Banner Button Margin', 'banner-image'),
        'type'      => 'text',
        'value'     => '',
        'desc'      => __('Add button margin. Ex. 10px 20px 10px 20px', 'banner-image'),
    ),

    # Save Function
    array(
        'id'        => 'biw_category_style_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

banner_image_function()->generator( $arr );
