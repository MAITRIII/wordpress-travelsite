<?php
/**
 * Use: Homepage Products Tab
 * Description: Display products tab section on homepage.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_customize_register_products_tab( $wp_customize ) {
   
    
    //Products Category
    $wp_customize->add_section( 'relic_fashion_store_products_tab_section', array(
        'title'    => esc_html__( 'Products Tabs', 'relic-fashion-store' ),
        'priority' => 4,
        'panel'    =>'relic_fashion_store_homepage_panel'
	) );
    

    //Products Tab Title
    $wp_customize->add_setting(
        'relic_fashion_store_products_tabs_title',
        array(
            'default'           => esc_html__('POPULAR CATEGORIES', 'relic-fashion-store'),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_products_tabs_title',
		array(
			'section'	  => 'relic_fashion_store_products_tab_section',
			'label'		  => esc_html__( 'Products Tab Header Title', 'relic-fashion-store' ),
			'description' => esc_html__( 'Products Tab Header Title Display', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
	);
	$wp_customize->selective_refresh->add_partial( 'relic_fashion_store_products_tabs_title', array(
        'selector' 			=> '#relic_fashion_store_products_tabs_title',
        'render_callback' 	=> 'relic_fashion_store_get_products_tab_section_title',
    ) );
    
    
    //Category Section Hear 
    $wp_customize->add_setting(
		'relic_fashion_store_products_tabs_multiple_cat', 
		array(
			'default'           => array(relic_fashion_store_get_default_products_categories()),
			'sanitize_callback' => 'relic_fashion_store_sanitize_multiple_check'					
		)
	);

	$wp_customize->add_control(
		new Relic_Fashion_Store_MultiCheck_Control(
			$wp_customize,
			'relic_fashion_store_products_tabs_multiple_cat',
			array(
				'section'     => 'relic_fashion_store_products_tab_section',
				'label'       => esc_html__( 'Products Tab Category', 'relic-fashion-store' ),
                'description' => esc_html__( 'Select the Products Tab Section Categories.', 'relic-fashion-store' ),
				'choices'     => relic_fashion_store_get_products_categories( )
			)
		)
	);

	//Products Category Number of Products
	$wp_customize->add_setting(
        'relic_fashion_store_products_tab_number_of_products',
        array(
            'default'           => 3,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
		'relic_fashion_store_products_tab_number_of_products',
		array(
			'section'	  => 'relic_fashion_store_products_tab_section',
			'label'		  => esc_html__( 'Number of Products', 'relic-fashion-store' ),
			'description' => esc_html__( 'Number of Products Display on Tab Section.', 'relic-fashion-store' ),
            'type'        => 'number'
		)		
    );
    

}
add_action( 'customize_register', 'relic_fashion_store_customize_register_products_tab' );