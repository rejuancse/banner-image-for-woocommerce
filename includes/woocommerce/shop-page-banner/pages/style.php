<?php
defined( 'ABSPATH' ) || exit;

$arr =  array(
    array(
        'id'        => 'shop_page_banner_text_align',
        'type'      => 'dropdown',
        'option'    => array(
            'left'    => __('Left Align','wcpb'),
            'right'    => __('Right Align','wcpb'),
            'center'    => __('Center Align','wcpb'),
        ),
        'label'     => __('Banner Text Align','wcpb'),
        'desc'      => __('Default text align left.','wcpb'),
    ),

    array (
        'id'        => 'shop_banner_image_height',
        'label'     => __('Banner height', 'wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write height. Ex. 300', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'shop_page_banner_overlay_color',
        'type'      => 'color',
        'label'     => __('Banner Overlay Color','wcpb'),
        'desc'      => __('Select background overlay color.', 'wcpb'),
        'value'     => '',
    ),

    array (
        'id'        => 'shop_page_banner_image_overlay_opacity',
        'label'     => __('Overlay Opacity', 'wcpb'),
        'type'      => 'numberOverlay', 
        'value'     => '',
        'desc'      => '<p>'.__('Write height. Ex. .5', 'wcpb').'</p>',
    ),




    #Sub Heading style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Sub Title Style Settings','wcpb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_subtitle_color',
        'type'      => 'color',
        'label'     => __('Banner subtitle Color','wcpb'),
        'desc'      => __('Select button background color.','wcpb'),
        'value'     => '#000000',
    ),

    # Product Banner subtitle 
    array (
        'id'        => 'shop_banner_subtitle_font_size',
        'label'     => __('Banner subtitle Font Size','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write subtitle font size. Ex. 44', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_subtitle_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','wcpb'),
            '500'    => __('500','wcpb'),
            '600'    => __('600','wcpb'),
            '700'    => __('700','wcpb'),
            '800'    => __('800','wcpb'),
            '900'    => __('900','wcpb'),
        ),
        'label'     => __('Banner subtitle Font Weight','wcpb'),
    ),

    array (
        'id'        => 'shop_banner_subtitle_line_height',
        'label'     => __('Banner subtitle Line Height','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write subtitle line height. Ex. 40', 'wcpb').'</p>',
    ),









    #Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Title Style Settings','wcpb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_title_color',
        'type'      => 'color',
        'label'     => __('Banner Title Color','wcpb'),
        'desc'      => __('Select button background color.','wcpb'),
        'value'     => '#000000',
    ),

    # Product Banner Title 
    array (
        'id'        => 'shop_banner_title_font_size',
        'label'     => __('Banner Title Font Size','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Title font size. Ex. 44', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_title_font_weight',
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
        'id'        => 'shop_banner_title_line_height',
        'label'     => __('Banner Title Line Height','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write Title line height. Ex. 40', 'wcpb').'</p>',
    ),






    # Short description Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Short Description Style Settings','wcpb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_banner_desc_color',
        'type'      => 'color',
        'label'     => __('Banner desc Color','wcpb'),
        'desc'      => __('Select button background color.','wcpb'),
        'value'     => '#000000',
    ),

    # Product Banner desc 
    array (
        'id'        => 'shop_banner_desc_font_size',
        'label'     => __('Banner desc Font Size','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write desc font size. Ex. 44', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_desc_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '300'    => __('300','wcpb'),
            '400'    => __('400','wcpb'),
            '500'    => __('500','wcpb'),
            '600'    => __('600','wcpb'),
            '700'    => __('700','wcpb'),
            '800'    => __('800','wcpb'),
            '900'    => __('900','wcpb'),
        ),
        'label'     => __('Banner desc Font Weight','wcpb'),
    ),

    array (
        'id'        => 'shop_banner_desc_line_height',
        'label'     => __('Banner desc Line Height','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write desc line height. Ex. 40', 'wcpb').'</p>',
    ),


    # Button Style Seperator
    array(
        'type'      => 'seperator',
        'label'     => __('Button Style Settings','wcpb'),
        'top_line'  => 'true',
    ),

    # Button Background Color
    array(
        'id'        => 'shop_page_banner_button_text_color',
        'type'      => 'color',
        'label'     => __('Banner button text Color','wcpb'),
        'desc'      => __('Select button text color.','wcpb'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'shop_page_banner_button_bg_color',
        'type'      => 'color',
        'label'     => __('Button BG Color','wcpb'),
        'desc'      => __('Select button background color.','wcpb'),
        'value'     => '#000000',
    ),

    array(
        'id'        => 'shop_page_banner_button_text_hover_color',
        'type'      => 'color',
        'label'     => __('Button text hover Color','wcpb'),
        'desc'      => __('Select button background color.','wcpb'),
        'value'     => '#ffffff',
    ),

    array(
        'id'        => 'shop_page_banner_button_bg_hover_color',
        'type'      => 'color',
        'label'     => __('Button BG Hover Color','wcpb'),
        'desc'      => __('Select button background hover color.','wcpb'),
        'value'     => '#000000',
    ),

    # Product Banner desc 
    array (
        'id'        => 'shop_banner_button_font_size',
        'label'     => __('Banner button Font Size','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write button font size. Ex. 44', 'wcpb').'</p>',
    ),

    array(
        'id'        => 'shop_banner_button_font_weight',
        'type'      => 'dropdown',
        'option'    => array(
            '400'    => __('400','wcpb'),
            '500'    => __('500','wcpb'),
            '600'    => __('600','wcpb'),
            '700'    => __('700','wcpb'),
            '800'    => __('800','wcpb'),
            '900'    => __('900','wcpb'),
        ),
        'label'     => __('Banner button Font Weight','wcpb'),
    ),

    array (
        'id'        => 'shop_banner_button_line_height',
        'label'     => __('Banner button Line Height','wcpb'),
        'type'      => 'number', 
        'value'     => '',
        'desc'      => '<p>'.__('Write button line height. Ex. 40', 'wcpb').'</p>',
    ),
    

    # Save Function
    array(
        'id'        => 'wpbi_shop_style_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

wpbi_function()->generator( $arr );
