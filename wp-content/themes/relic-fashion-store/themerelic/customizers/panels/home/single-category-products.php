<?php
/**
 * Use: Homepage Single Category Products
 * Description: Display single category products customizer settings.
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_single_category_products( $wp_customize ) {
   
    //Products Category
    $wp_customize->add_section( 'products_and_category_slider_section', array(
        'title'    => __( 'Single Category Products', 'relic-fashion-store' ),
        'priority' => 3,
        'panel'    =>'relic_fashion_store_homepage_panel',

	) );
    
    //Single Category Products
    $wp_customize->add_setting( 
        'relic_fashion_store_single_category_id_select', 
        array(
            'sanitize_callback' => 'relic_fashion_store_sanitize_select',
            'default'           => relic_fashion_store_get_default_products_categories(),
        )
    );
     
    $wp_customize->add_control( 
        'relic_fashion_store_single_category_id_select', 
        array(
            'label' => esc_html__( 'Select The Category', 'relic-fashion-store' ),
            'section' => 'products_and_category_slider_section',
            'type' => 'select',
            'choices' => relic_fashion_store_get_products_categories( ),
            'priority'          => 2,
            'transport'         =>'postMessage',
        )
    ); 

	//Products Category Number of Products
	$wp_customize->add_setting(
        'relic_fashion_store_single_category_porducts_count',
        array(
            'default'           => 4,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
		'relic_fashion_store_single_category_porducts_count',
		array(
			'section'	  => 'products_and_category_slider_section',
			'label'		  => esc_html__( 'Number of Products', 'relic-fashion-store' ),
			'description' => esc_html__( 'Single category products number of products display.', 'relic-fashion-store' ),
            'type'        => 'number',
            'priority'          => 3
		)		
    );

    

}
add_action( 'customize_register', 'relic_fashion_store_single_category_products' );