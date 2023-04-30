<?php

defined( 'ABSPATH' ) || exit;

$settings =  array(

    'section_title' => array(
        'name'     => __( 'Category Page Banner ', 'wcpb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_category_general_option'
    ),

    'category_banner_text_align' => array(
        'title'     => __( 'Banner Text Align', 'wcpb' ),
        'id'        => 'category_banner_image_align',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            'left'      =>  __('Left Align','wcpb'),
            'center'    => __('Center Align','wcpb'),
            'right'     => __('Right Align','wcpb'),
        ),
        'desc_tip' => true,
    ),

    'category_banner_height' => array(
        'title'     => __( 'Banner height', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 300', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'category_single_page_banner_height',
        'css'       => 'min-width:300px;'
    ),

    'category_banner_overlay_color' => array(
        'name' 		=> __( 'Overlay Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_btn_border_color',
        'css'      => 'width:6em;',
        'default'  => '#000000',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_overview_sectionend' => array (
        'type'      => 'sectionend',
        'id'        => 'wc_settings_category_general_option'
    ),

    /*
    * Sub Title Section
    * */ 
    'section_banner_subtitle' => array (
        'name'     => __( 'Sub Title Style Settings', 'wcpb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_category_banner_subtitle'
    ),

    'category_banner_subtitle_color' => array(
        'name' 		=> __( 'Banner subtitle Font Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_subtitle_color',
        'css'      => 'width:6em;',
        'default'  => '#000000',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_subtitle_fontsize' => array(
        'title'     => __( 'Banner subtitle Font Size', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 28', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_subtitle_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '28'
    ),

    'category_banner_subtitle_fontweight' => array(
        'title'     => __( 'Banner Text Align', 'wcpb' ),
        'id'        => 'wc_settings_tab_category_subtitle_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wcpb'),
            '500' => __('500','wcpb'),
            '600' => __('600','wcpb'),
            '700' => __('700','wcpb'),
            '800' => __('800','wcpb'),
            '900' => __('900','wcpb'),
        ),
        'desc_tip' => true,
    ),

    'category_banner_subtitle_lineheight' => array(
        'title'     => __( 'Banner subtitle Line Height', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write subtitle line height. Ex. 52', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_subtitle_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '52'
    ),

    // Section end
    'category_subtitle_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_category_banner_subtitle'
    ),

    /*
    * Title Section
    **/ 
    'section_banner_category_title' => array (
        'name'     => __( 'Title Style Settings', 'wcpb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_category_banner_title'
    ),

    'category_banner_title_color' => array(
        'name' 		=> __( 'Banner Title Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_title_color',
        'css'      => 'width:6em;',
        'default'  => '#ed1c24',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_title_fontsize' => array(
        'title'     => __( 'Banner Title Font Size', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 80', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_title_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '92'
    ),

    'category_banner_title_fontweight' => array(
        'title'     => __( 'Banner Text Align', 'wcpb' ),
        'id'        => 'wc_settings_tab_category_title_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wcpb'),
            '500' => __('500','wcpb'),
            '600' => __('600','wcpb'),
            '700' => __('700','wcpb'),
            '800' => __('800','wcpb'),
            '900' => __('900','wcpb'),
        ),
        'desc_tip' => true,
    ),

    'category_banner_title_lineheight' => array(
        'title'     => __( 'Banner subtitle Line Height', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write subtitle line height. Ex. 40', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_title_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '28'
    ),

    // Section end
    'category_title_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_category_banner_title'
    ),


    /*
    * Short Description Section
    **/ 
    'section_banner_category_desc' => array (
        'name'     => __( 'Short Description Style Settings', 'wcpb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_category_banner_desc'
    ),

    'category_banner_desc_color' => array(
        'name' 		=> __( 'Banner desc Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_title_color',
        'css'      => 'width:6em;',
        'default'  => '#363636',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_desc_fontsize' => array(
        'title'     => __( 'Banner desc Font Size', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 20', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_desc_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '20'
    ),

    'category_banner_desc_fontweight' => array(
        'title'     => __( 'Banner desc Font Weight', 'wcpb' ),
        'id'        => 'wc_settings_tab_category_desc_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wcpb'),
            '500' => __('500','wcpb'),
            '600' => __('600','wcpb'),
            '700' => __('700','wcpb'),
            '800' => __('800','wcpb'),
            '900' => __('900','wcpb'),
        ),
        'desc_tip' => true,
    ),

    'category_banner_desc_lineheight' => array(
        'title'     => __( 'Banner desc Line Height', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write desc line height. Ex. 40', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_desc_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '40'
    ),

    // Section end
    'category_desc_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_category_banner_desc'
    ),

    /*
    * Button Section
    **/ 
    'category_banner_button_sectionstart' => array (
        'name'     => __( 'Button Style Settings', 'wcpb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_category_banner_button'
    ),

    'category_banner_button_text_color' => array(
        'name' 		=> __( 'Button BG Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_button_text_color',
        'css'      => 'width:6em;',
        'default'  => '#ffffff',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_button_bg_color' => array(
        'name' 		=> __( 'Button BG Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_button_bg_color',
        'css'      => 'width:6em;',
        'default'  => '#7f54b3',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_button_text_hover_color' => array(
        'name' 		=> __( 'Button text hover Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_button_text_hover_color',
        'css'      => 'width:6em;',
        'default'  => '#ffffff',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_button_bg_hover_color' => array(
        'name' 		=> __( 'Button BG Hover Color', 'wcpb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_category_button_bg_hover_color',
        'css'      => 'width:6em;',
        'default'  => '#7f54b3',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'category_banner_button_fontsize' => array(
        'title'     => __( 'Banner button Font Size', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 20', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_button_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '18'
    ),

    'category_banner_button_fontweight' => array(
        'title'     => __( 'Banner button Font Weight', 'wcpb' ),
        'id'        => 'wc_settings_tab_category_button_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wcpb'),
            '500' => __('500','wcpb'),
            '600' => __('600','wcpb'),
            '700' => __('700','wcpb'),
            '800' => __('800','wcpb'),
            '900' => __('900','wcpb'),
        ),
        'desc_tip' => true,
    ),

    'category_banner_button_lineheight' => array(
        'title'     => __( 'Banner button Line Height', 'wcpb' ),
        'type'      => 'number',
        'desc'      => __( 'Write desc line height. Ex. 20', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_button_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '20'
    ),

    'category_banner_button_padding' => array(
        'title'     => __( 'Banner Button Padding', 'wcpb' ),
        'type'      => 'text',
        'desc'      => __( 'Add button Padding. Ex. 10px 20px 10px 20px', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_button_padding',
        'css'       => 'min-width:300px;',
        'default'   => '10px 30px 10px 30px'
    ),

    'category_banner_button_margin' => array(
        'title'     => __( 'Banner Button Margin', 'wcpb' ),
        'type'      => 'text',
        'desc'      => __( 'Add button Padding. Ex. 10px 20px 10px 20px', 'wcpb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_category_button_margin',
        'css'       => 'min-width:300px;',
        'default'   => '10px 30px 10px 30px'
    ),

    // Section end
    'section_category_button_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_category_banner_button'
    ),

);

return $settings;
