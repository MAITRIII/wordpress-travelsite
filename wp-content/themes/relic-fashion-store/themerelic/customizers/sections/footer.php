<?php
/**
 * Copyright Settings
 *
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_register_copyright( $wp_customize ) {
    
    //Main Heaer Panel 
    $wp_customize->add_section( 'relic_fashion_store_copyright_section', array(
        'title'    => esc_html__( 'Footer Section', 'relic-fashion-store' ),
        'priority' => 110,
    ) );

    
    //Enable footer payment Section
    $wp_customize->add_setting(
        'relic_fashion_store_payment_logo_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_payment_logo_enable',
			array(
				'section'	  => 'relic_fashion_store_woocommerce_single_page_sections',
				'label'		  => esc_html__( 'Disable Payment Method', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Payment Method.', 'relic-fashion-store' ),
                'priority'    => 1
			)
		)
    );

    //Payment Title
    $wp_customize->add_setting('relic_fashion_store_payment_method_title',array(
        'sanitize_callback' => 'sanitize_text_field', //
        'default'           =>  esc_html__('Accepted Payment Mathods', 'relic-fashion-store')
    ));
    $wp_customize->add_control( 'relic_fashion_store_payment_method_title',array(
        'label'     => esc_html__( 'Payment Method Title', 'relic-fashion-store' ),
        'description'=>esc_html__('Eg:Accepted Payment Mathods','relic-fashion-store'),
        'section'   => 'relic_fashion_store_copyright_section',
        'type'      => 'text',
        'priority'  => 2
    ));
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_payment_method_title', array(
        'selector' 			=> 'div.footer_right p.payment-method',
        'render_callback' 	=> 'relic_fashion_store_payment_method_title_callback',
    ) );


    //add the Accept payment method
    $wp_customize->add_setting('relic_fashion_store_payment_method_support_image', array(
        'default'           =>  get_template_directory_uri() . '/assets/images/footer/payment-logo.png',
        'transport'         => 'refresh',
        'sanitize_callback' => 'relic_fashion_store_sanitize_image',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'relic_fashion_store_payment_method_support_image', array(
        'label'             => esc_html__('Payment Method Accepted', 'relic-fashion-store'),
        'section'           => 'relic_fashion_store_copyright_section',
        'settings'          => 'relic_fashion_store_payment_method_support_image',
        'priority'          => 2
    )));
    

}
add_action( 'customize_register', 'relic_fashion_store_customize_register_copyright' );