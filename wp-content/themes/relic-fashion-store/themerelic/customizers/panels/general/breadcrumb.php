<?php
/**
 * Breadcrumb Settings
 *
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_customize_breadcrumb_settings( $wp_customize ) {

    //Breadcrumb Panel
    $wp_customize->add_section( 'relic_fashion_store_breadcrumb_sections', array(
        'title'    => esc_html__( 'Breadcrumb Settings', 'relic-fashion-store' ),
        'priority' => 81,
        'panel'    =>'general_setting'
    ) );

    //Breadcrumb Enable
    $wp_customize->add_setting(
        'relic_fashion_store_breadcrumbs_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_breadcrumbs_enable',
			array(
				'section'	  => 'relic_fashion_store_breadcrumb_sections',
				'label'		  => esc_html__( 'Disable Breadcrumb Sections', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Breadcrumb Sections.', 'relic-fashion-store' ),
                'priority'    => 1
			)
		)
    );


}
add_action( 'customize_register', 'relic_fashion_store_customize_breadcrumb_settings' );