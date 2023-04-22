<?php

defined( 'ABSPATH' ) || exit;


function product_category_page_banner_style() {
    $settings = array (
        'section_title' => array(
            'name'     => __( 'Gift Order Style', 'wcpb' ), 
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_tab_section_style'
        ),

        'button_text_color' => array(
            'name' 		=> __( 'Gift Button text Color', 'wcpb' ),
            'type' 		=> 'color',
            'desc'     => sprintf( __( 'The base color for Gift button. Default %s.', 'wcpb' ), '<code>#7f54b3</code>' ),
            'id'   	=> 'wc_settings_tab_btn_text_color',
            'css'      => 'width:6em;',
            'default'  => '#7f54b3',
            'autoload' => false,
            'desc_tip' => true,
        ),

        'bgColor' => array(
            'name' 		=> __( 'Gift Button BG Color', 'wcpb' ),
            'type' 		=> 'color',
            'desc'     => sprintf( __( 'The base color for Gift button. Default %s.', 'wcpb' ), '<code>#7f54b3</code>' ),
            'id'   	=> 'wc_settings_tab_btn_bg_color',
            'css'      => 'width:6em;',
            'default'  => '#7f54b3',
            'autoload' => false,
            'desc_tip' => true,
        ),

        'borderColor' => array(
            'name' 		=> __( 'Gift Button Border Color', 'wcpb' ),
            'type' 		=> 'color',
            'desc'     => sprintf( __( 'The base border color for Gift button. Default %s.', 'wcpb' ), '<code>#7f54b3</code>' ),
            'id'   	=> 'wc_settings_tab_btn_border_color',
            'css'      => 'width:6em;',
            'default'  => '#7f54b3',
            'autoload' => false,
            'desc_tip' => true,
        ),

        'section_order_end' => array(
            'type' => 'sectionend',
            'id' 	=> 'button_style_end'
        ),

        'separator_Title' => array(
            'title' 	=> __( 'Gift Proceed Checkout page Style', 'wcpb' ),
            'type'  	=> 'title',
            'id'    	=> 'separator_checkout_title',
            'desc'     	=> '',
        ),

        'gift_checkout_title_color' => array(
            'name' 		=> __( 'Gift Button text Color', 'wcpb' ),
            'type' 		=> 'color',
            'desc'     => sprintf( __( 'The base color for Gift button. Default %s.', 'wcpb' ), '<code>#7f54b3</code>' ),
            'id'   	=> 'wc_settings_gift_checkout_title_color',
            'css'      => 'width:6em;',
            'default'  => '#5ba403',
            'autoload' => false,
            'desc_tip' => true,
        ),

        'section_end' => array(
            'type' => 'sectionend',
            'id' 	=> 'wc_settings_tab_demo_end-section-1'
        )
    );

    return $settings;
}
