<?php
/**
 * Use: Homepage Single Products
 * Description: Display single products section on homepage.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_single_product_and_cat( $wp_customize ) {

    //Products Category
    $wp_customize->add_section( 'relic_fashion_store_single_products_sec', array(
        'title'    => esc_html__( 'Single Products', 'relic-fashion-store' ),
        'priority' => 5,
        'panel'    =>'relic_fashion_store_homepage_panel'
    ) );

    
    //Single Products Title Text
    $wp_customize->add_setting(
        'relic_fashion_store_single_product_title_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
        'relic_fashion_store_single_product_title_text',
        array(
            'section'	  => 'relic_fashion_store_single_products_sec',
            'label'		  => esc_html__( 'Single products Title', 'relic-fashion-store' ),
            'description' => esc_html__( 'change the products title.', 'relic-fashion-store' ),
            'type'        => 'text',
            'priority'    => 1
        )		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_single_product_title_text', array(
        'selector' 			=> 'div.single_product_section h2',
        'render_callback' 	=> 'relic_fashion_store_single_product_title_text_callback',
    ) );

    //Single Sort Desc
    $wp_customize->add_setting(
        'relic_fashion_store_single_product_description_text',
        array(
            'default'           => esc_html__('Its that time of the year again.Have a look at whats new in our hats collection.', 'relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
        'relic_fashion_store_single_product_description_text',
        array(
            'section'	  => 'relic_fashion_store_single_products_sec',
            'label'		  => esc_html__( 'Single products Title', 'relic-fashion-store' ),
            'description' => esc_html__( 'change the products title.', 'relic-fashion-store' ),
            'type'        => 'textarea',
            'priority'    => 1
        )		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_single_product_description_text', array(
        'selector' 			=> 'div.single_product_section p.text_des',
        'render_callback' 	=> 'relic_fashion_store_single_product_description_text_callback',
    ) );


    //Single Products Change Btn Text
    $wp_customize->add_setting(
        'relic_fashion_store_single_product_btn_text_change_sec',
        array(
            'default'           => esc_html__('VIEW ALL', 'relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
        'relic_fashion_store_single_product_btn_text_change_sec',
        array(
            'section'	  => 'relic_fashion_store_single_products_sec',
            'label'		  => esc_html__( 'Change Button Text', 'relic-fashion-store' ),
            'description' => esc_html__( 'change the products title.', 'relic-fashion-store' ),
            'type'        => 'text',
            'priority'    => 1
        )		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_single_product_btn_text_change_sec', array(
        'selector' 			=> 'div.single_product_section a.view-all',
        'render_callback' 	=> 'relic_fashion_store_single_product_btn_text_change_sec_callback',
    ) );



    //Category Section Hear 
    $wp_customize->add_setting( 
        'relic_fashion_store_single_products_and_cat_cat_id_select', 
        array(
            'sanitize_callback' => 'relic_fashion_store_sanitize_select',
            'default'           => relic_fashion_store_get_default_products_categories(),
        )
    );
    $wp_customize->add_control( 
        'relic_fashion_store_single_products_and_cat_cat_id_select', 
        array(
            'label'     => esc_html__( 'Select The Category', 'relic-fashion-store' ),
            'section'   => 'relic_fashion_store_single_products_sec',
            'type'      => 'select',
            'choices'   => relic_fashion_store_get_products_categories( ),
            'priority'  => 2
        )
    );

}
add_action( 'customize_register', 'relic_fashion_store_single_product_and_cat' );