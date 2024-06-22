<?php
defined( 'ABSPATH' ) || exit;

$settings =  array(
    # Enable Product Banner
    array(
        'id'        => 'enable_category_page_banner',
        'type'      => 'checkbox',
        'value'     => 'true',
        'label'     => __('Enable Category Page Banner','biw'),
        'desc'      => '<p>'.__('Enable Banner Image','biw').'</p>',
    ),

    # Save Function
    array(
        'id'        => 'biw_category_settings_admin_tab',
        'type'      => 'hidden',
        'value'     => 'tab_style',
    ),
);

biw_function()->generator( $settings );
