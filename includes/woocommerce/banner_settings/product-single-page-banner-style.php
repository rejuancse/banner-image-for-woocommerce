<?php

defined( 'ABSPATH' ) || exit;

$settings =  array(

    'section_title' => array(
        'name'     => __( 'Product Single Page Banner ', 'wppb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_product_general_option'
    ),

    'product_banner_text_align' => array(
        'title'     => __( 'Banner Text Align', 'wppb' ),
        'id'        => 'product_banner_image_align',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            'left'      =>  __('Left Align','wppb'),
            'center'    => __('Center Align','wppb'),
            'right'     => __('Right Align','wppb'),
        ),
        'desc_tip' => true,
    ),

    'product_banner_height' => array(
        'title'     => __( 'Banner height', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 300', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'product_single_page_banner_height',
        'css'       => 'min-width:300px;'
    ),

    'product_overview_sectionend' => array (
        'type'      => 'sectionend',
        'id'        => 'wc_settings_product_general_option'
    ),

    /*
    * Sub Title Section
    * */ 
    'section_banner_subtitle' => array (
        'name'     => __( 'Sub Title Style Settings', 'wppb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_product_banner_subtitle'
    ),

    'product_banner_subtitle_color' => array(
        'name' 		=> __( 'Banner subtitle Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_subtitle_color',
        'css'      => 'width:6em;',
        'default'  => '#000000',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_subtitle_fontsize' => array(
        'title'     => __( 'Banner subtitle Font Size', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 300', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_subtitle_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '28'
    ),

    'product_banner_subtitle_fontweight' => array(
        'title'     => __( 'Banner Text Align', 'wppb' ),
        'id'        => 'wc_settings_tab_product_subtitle_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wppb'),
            '500' => __('500','wppb'),
            '600' => __('600','wppb'),
            '700' => __('700','wppb'),
            '800' => __('800','wppb'),
            '900' => __('900','wppb'),
        ),
        'desc_tip' => true,
    ),

    'product_banner_subtitle_lineheight' => array(
        'title'     => __( 'Banner subtitle Line Height', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write subtitle line height. Ex. 52', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_subtitle_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '52'
    ),

    // Section end
    'product_subtitle_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_product_banner_subtitle'
    ),

    /*
    * Title Section
    **/ 
    'section_banner_product_title' => array (
        'name'     => __( 'Title Style Settings', 'wppb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_product_banner_title'
    ),

    'product_banner_title_color' => array(
        'name' 		=> __( 'Banner Title Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_title_color',
        'css'      => 'width:6em;',
        'default'  => '#ed1c24',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_title_fontsize' => array(
        'title'     => __( 'Banner Title Font Size', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 80', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_title_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '92'
    ),

    'product_banner_title_fontweight' => array(
        'title'     => __( 'Banner Text Align', 'wppb' ),
        'id'        => 'wc_settings_tab_product_title_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wppb'),
            '500' => __('500','wppb'),
            '600' => __('600','wppb'),
            '700' => __('700','wppb'),
            '800' => __('800','wppb'),
            '900' => __('900','wppb'),
        ),
        'desc_tip' => true,
    ),

    'product_banner_title_lineheight' => array(
        'title'     => __( 'Banner subtitle Line Height', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write subtitle line height. Ex. 28', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_title_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '28'
    ),

    // Section end
    'product_title_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_product_banner_title'
    ),

    /*
    * Short Description Section
    **/ 
    'section_banner_product_desc' => array (
        'name'     => __( 'Short Description Style Settings', 'wppb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_product_banner_desc'
    ),

    'product_banner_desc_color' => array(
        'name' 		=> __( 'Banner desc Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_title_color',
        'css'      => 'width:6em;',
        'default'  => '#363636',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_desc_fontsize' => array(
        'title'     => __( 'Banner desc Font Size', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 20', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_desc_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '20'
    ),

    'product_banner_desc_fontweight' => array(
        'title'     => __( 'Banner desc Font Weight', 'wppb' ),
        'id'        => 'wc_settings_tab_product_desc_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wppb'),
            '500' => __('500','wppb'),
            '600' => __('600','wppb'),
            '700' => __('700','wppb'),
            '800' => __('800','wppb'),
            '900' => __('900','wppb'),
        ),
        'desc_tip' => true,
    ),

    'product_banner_desc_lineheight' => array(
        'title'     => __( 'Banner desc Line Height', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write desc line height. Ex. 20', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_desc_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '40'
    ),

    // Section end
    'product_desc_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_product_banner_desc'
    ),

    /*
    * Button Section
    **/ 
    'product_banner_button_sectionstart' => array (
        'name'     => __( 'Button Style Settings', 'wppb' ),
        'type'     => 'title',
        'desc'     => '',
        'id'       => 'wc_settings_product_banner_button'
    ),

    'product_banner_button_text_color' => array(
        'name' 		=> __( 'Button BG Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_button_text_color',
        'css'      => 'width:6em;',
        'default'  => '#ffffff',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_button_bg_color' => array(
        'name' 		=> __( 'Button BG Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_button_bg_color',
        'css'      => 'width:6em;',
        'default'  => '#7f54b3',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_button_text_hover_color' => array(
        'name' 		=> __( 'Button text hover Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_button_text_hover_color',
        'css'      => 'width:6em;',
        'default'  => '#ffffff',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_button_bg_hover_color' => array(
        'name' 		=> __( 'Button BG Hover Color', 'wppb' ),
        'type' 		=> 'color',
        'id'   	=> 'wc_settings_tab_product_button_bg_hover_color',
        'css'      => 'width:6em;',
        'default'  => '#7f54b3',
        'autoload' => false,
        'desc_tip' => true,
    ),

    'product_banner_button_fontsize' => array(
        'title'     => __( 'Banner button Font Size', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write height. Ex. 20', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_button_fontsize',
        'css'       => 'min-width:300px;',
        'default'   => '18'
    ),

    'product_banner_button_fontweight' => array(
        'title'     => __( 'Banner button Font Weight', 'wppb' ),
        'id'        => 'wc_settings_tab_product_button_fontweight',
        'class'     => 'wc-enhanced-select',
        'css'       => 'min-width:300px;',
        'default'   => 'left',
        'type'      => 'select',
        'options'   => array(
            '400' =>  __('400','wppb'),
            '500' => __('500','wppb'),
            '600' => __('600','wppb'),
            '700' => __('700','wppb'),
            '800' => __('800','wppb'),
            '900' => __('900','wppb'),
        ),
        'desc_tip' => true,
    ),

    'product_banner_button_lineheight' => array(
        'title'     => __( 'Banner button Line Height', 'wppb' ),
        'type'      => 'number',
        'desc'      => __( 'Write desc line height. Ex. 20', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_button_lineheight',
        'css'       => 'min-width:300px;',
        'default'   => '20'
    ),

    'product_banner_button_padding' => array(
        'title'     => __( 'Banner Button Padding', 'wppb' ),
        'type'      => 'text',
        'desc'      => __( 'Add button Padding. Ex. 10px 20px 10px 20px', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_button_padding',
        'css'       => 'min-width:300px;',
        'default'   => '10px 30px 10px 30px'
    ),

    'product_banner_button_margin' => array(
        'title'     => __( 'Banner Button Margin', 'wppb' ),
        'type'      => 'text',
        'desc'      => __( 'Add button Padding. Ex. 10px 20px 10px 20px', 'wppb' ),
        'desc_tip'  => true,
        'id'        => 'wc_settings_tab_product_button_margin',
        'css'       => 'min-width:300px;',
        'default'   => '10px 30px 10px 30px'
    ),

    // Section end
    'section_product_button_sectionend' => array(
        'type'      => 'sectionend',
        'id'        => 'wc_settings_product_banner_button'
    ),
);

return $settings;
