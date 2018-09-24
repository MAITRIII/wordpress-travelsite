<?php
/**
 * Home Page Sort Settings
 *
 * @package Relic Fashion Store
 */
function relic_fashion_store_homepage_short( $wp_customize ){
    
    /** Homepage Sort Section */   
    $wp_customize->add_section( 'relic_fashion_store_homepage_short', array(
        'title'    => esc_html__( 'Sort Home Page Section', 'relic-fashion-store' ),
        'priority' => 10,
        'panel'    => 'relic_fashion_store_homepage_panel',
    ) ); 
    
    /** Homepage Sort Settings*/
    $wp_customize->add_setting(
		'relic_fashion_store_home_page_sort', 
		array(
			'default' => relic_fashion_store_default_sort_data(),
			'sanitize_callback' => 'relic_fashion_store_sanitize_sortable',						
		)
	);

    /** Homepage Sort Controls */
	$wp_customize->add_control(
		new Relic_Fashion_Store_Drag_Section_Control(
			$wp_customize,
			'relic_fashion_store_home_page_sort',
			array(
				'section'     => 'relic_fashion_store_homepage_short',
				'label'       => esc_html__( 'Homepage Sort Sections', 'relic-fashion-store' ),
				'description' => esc_html__( 'Sort or toggle home page sections.', 'relic-fashion-store' ),
				'choices'     => relic_fashion_store_sort_data()
			)
		)
	);
    
}
add_action( 'customize_register', 'relic_fashion_store_homepage_short' );

//Woocommerce File
function relic_fashion_store_sort_data(){
	
	//Woocommerce Activate file
	if( relic_fashion_store_is_woocommerce_activated() ){
		$woocommerce_section = array(
			'relic_fashion_store_single_category_and_products_section'  => esc_html__( 'Single Category and Products', 'relic-fashion-store' ),
			'relic_fashion_store_single_categry_products'				=> esc_html__( 'Single Category Products','relic-fashion-store'),
			'relic_fashion_store_products_tabs'							=> esc_html__( 'Products Tabs', 'relic-fashion-store' ),
			'relic_fashion_store_single_products_section'				=> esc_html__( 'Single Products','relic-fashion-store' ),
		);
	}else{
		$woocommerce_section = array();
	}	
	
	//Default Section
	$default_section = array(
		'relic_fashion_store_service_section'      					=> esc_html__( 'Service Box', 'relic-fashion-store' ),
		'relic_fashion_store_blog_section'           				=> esc_html__( 'Blog Section', 'relic-fashion-store' ),
		'relic_fashion_store_instagram_feed_section' 				=> esc_html__( 'Instagram Feed', 'relic-fashion-store' ),
	);

	//merge array value 
	$all_section_sort = array_merge($woocommerce_section,$default_section);

	return $all_section_sort;
}


//Sort Default Data
function relic_fashion_store_default_sort_data(){
	
	//Woocommerce Activate file
	if( relic_fashion_store_is_woocommerce_activated() ){
		$woocommerce_section = array(
			'relic_fashion_store_single_category_and_products_section',
			'relic_fashion_store_single_categry_products',
			'relic_fashion_store_products_tabs',
			'relic_fashion_store_single_products_section',
		);
	}else{
		$woocommerce_section = array();
	}	
	
	//Default Section
	$default_section = array(
		'relic_fashion_store_service_section',
		'relic_fashion_store_blog_section' ,
		'relic_fashion_store_instagram_feed_section',
	);

	//merge array value 
	$all_section_sort = array_merge($woocommerce_section,$default_section);

	return $all_section_sort;
}