<?php
/**
 *Use: Top Header 
 *Description: Top Header Customizer Settings all hear
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_register_top_header_section( $wp_customize ) {
    
    //Top Header Section
    $wp_customize->add_section( 'relic_fashion_store_top_header_setting', array(
        'title'    => esc_html__( 'Top Header Settings', 'relic-fashion-store' ),
        'priority' => 2,
        'panel'    =>'relic_fashion_store_header_settings'
    ) );
    
    /** Enable/Disable Top Header Settings */
    $wp_customize->add_setting(
        'relic_fashion_store_top_header_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
            'transport'         =>'postMessage',
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_top_header_enable',
			array(
				'section'	  => 'relic_fashion_store_top_header_setting',
				'label'		  => esc_html__( 'Disable Top Header', 'relic-fashion-store' ),
				'description' => esc_html__( 'Enable/Disable Top Header Section.', 'relic-fashion-store' ),
			)
		)
	);
    

    /** Top Header Store Address */
    $wp_customize->add_setting(
        'relic_fashion_store_top_header_address',
        array(
            'default'           => esc_html__('Kathamandu , Nepal', 'relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         =>'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_top_header_address',
		array(
			'section'	  => 'relic_fashion_store_top_header_setting',
			'label'		  => esc_html__( 'Store Address', 'relic-fashion-store' ),
			'description' => esc_html__( 'Display the store address section.', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_top_header_address', array(
        'selector' 			=> 'li.relic_fashion_store_top_header_address',
        'render_callback' 	=> 'relic_fashion_store_top_header_address',
    ) );

    /** Top Header Store Email */
    $wp_customize->add_setting(
        'relic_fashion_store_top_header_email',
        array(
            'default'           => esc_html__('themerelic@gmail.com', 'relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         =>'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_top_header_email',
		array(
			'section'	  => 'relic_fashion_store_top_header_setting',
			'label'		  => esc_html__( 'Store Email', 'relic-fashion-store' ),
			'description' => esc_html__( 'Display the store address section.', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_top_header_email', array(
        'selector' 			=> 'li.relic_fashion_store_top_header_email',
        'render_callback' 	=> 'relic_fashion_store_top_header_email',
    ) );

    
    /** Top Header Store Pnone No. */
    $wp_customize->add_setting(
        'relic_fashion_store_top_header_phone_no',
        array(
            'default'           => esc_html__('+977-1234567890', 'relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         =>'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_top_header_phone_no',
		array(
			'section'	  => 'relic_fashion_store_top_header_setting',
			'label'		  => esc_html__( 'Store Email', 'relic-fashion-store' ),
			'description' => esc_html__( 'Display the store phone no.', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_top_header_phone_no', array(
        'selector' 			=> 'li.relic_fashion_store_top_header_phone_no',
        'render_callback' 	=> 'relic_fashion_store_top_header_phone_no',
    ) );

}
add_action( 'customize_register', 'relic_fashion_store_customize_register_top_header_section' );