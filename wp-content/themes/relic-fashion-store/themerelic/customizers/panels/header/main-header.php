<?php
/**
 * Use: Main Header Settings
 * Description: Main header all customizer control setting.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_customize_register_main_header( $wp_customize ) {
    
    //Main Heaer Panel 
    $wp_customize->add_section( 'main_header_setting', array(
        'title'    => esc_html__( 'Main Header Settings', 'relic-fashion-store' ),
        'priority' => 3,
        'panel'    =>'relic_fashion_store_header_settings'
    ) );

    //Header Search box Section
    $wp_customize->add_setting(
        'relic_fashion_store_search_box_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
            'transport'         =>'postMessage',
        )
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_search_box_enable',
			array(
				'section'	  => 'main_header_setting',
				'label'		  => esc_html__( 'Disable Search Section', 'relic-fashion-store' ),
				'description' => esc_html__( 'Enable/Disable Search Box Section.', 'relic-fashion-store' ),
			)
		)
	);


    //Header Wishlist Section
    $wp_customize->add_setting(
        'relic_fashion_store_main_header_wishlist_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
            'transport'         =>'postMessage',
        )
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_main_header_wishlist_enable',
			array(
				'section'	  => 'main_header_setting',
				'label'		  => esc_html__( 'Disable Header Wishlist', 'relic-fashion-store' ),
				'description' => esc_html__( 'Enable/Disable Wishlist Section.', 'relic-fashion-store' ),
			)
		)
    );


    //Header Cart Section
    $wp_customize->add_setting(
        'relic_fashion_store_main_header_add_cart_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
            'transport'         =>'postMessage',
        )
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_main_header_add_cart_enable',
			array(
				'section'	  => 'main_header_setting',
				'label'		  => __( 'Disable Header Cart Section', 'relic-fashion-store' ),
				'description' => __( 'Enable/Disable Header Cart Section.', 'relic-fashion-store' ),
			)
		)
    );

}
add_action( 'customize_register', 'relic_fashion_store_customize_register_main_header' );