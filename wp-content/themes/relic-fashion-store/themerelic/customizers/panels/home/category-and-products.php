<?php
/**
 * Use: Homepage Single Category And Products
 * Description: Display single category and products section on homepage.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_single_category_and_products( $wp_customize ) {

    //Products Category
    $wp_customize->add_section( 'relic_fashion_store_single_category_and_products', array(
        'title'    => esc_html__( 'Single Category and Products', 'relic-fashion-store' ),
        'priority' => 2,
        'panel'    =>'relic_fashion_store_homepage_panel'
    ) );


    //Single Products Change Btn Text
    $wp_customize->add_setting(
        'relic_fashion_store_single_product_btn_text',
        array(
            'default'           => esc_html__('VIEW ALL', 'relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
        'relic_fashion_store_single_product_btn_text',
        array(
            'section'	  => 'relic_fashion_store_single_category_and_products',
            'label'		  => esc_html__( 'Change the button text', 'relic-fashion-store' ),
            'description' => esc_html__( 'Change the button text.', 'relic-fashion-store' ),
            'type'        => 'text',
            'priority'    => 1
        )		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_single_product_btn_text', array(
        'selector' 			=> 'section#homepage_single_category_and_products_cat_id_select .pro_add a',
        'render_callback' 	=> 'relic_fashion_store_single_product_btn_text_callback',
    ) );


    //Category Section Hear 
    $wp_customize->add_setting( 
        'relic_fashion_store_single_category_and_products_cat_id_select', 
        array(
            'sanitize_callback' => 'relic_fashion_store_sanitize_select',
            'default'           => relic_fashion_store_get_default_products_categories(),
        )
    );
    
    $wp_customize->add_control( 
        'relic_fashion_store_single_category_and_products_cat_id_select', 
        array(
            'label'     => esc_html__( 'Select The Category', 'relic-fashion-store' ),
            'section'   => 'relic_fashion_store_single_category_and_products',
            'type'      => 'select',
            'choices'   => relic_fashion_store_get_products_categories( ),
            'priority'  => 2
        )
    );

    //Products Category Number of Products
	$wp_customize->add_setting(
        'relic_fashion_store_products_single_category_and_products_count',
        array(
            'default'           => 3,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
		'relic_fashion_store_products_single_category_and_products_count',
		array(
			'section'	  => 'relic_fashion_store_single_category_and_products',
			'label'		  => esc_html__( 'Number of Products', 'relic-fashion-store' ),
			'description' => esc_html__( 'Number of products display on category on this section.', 'relic-fashion-store' ),
            'type'        => 'number'
		)		
    );

}
add_action( 'customize_register', 'relic_fashion_store_single_category_and_products' );