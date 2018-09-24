<?php
/**
 * Woocommerce Settings
 *
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_customize_woocommerce_settings( $wp_customize ) {

    $wp_customize->add_panel( 'relic_fashion_store_woocommerce', array(
        'title'      => esc_html__( 'Woocommerce Settings', 'relic-fashion-store' ),
        'priority'   => 100
    ) );

    //Woocommerce General Settings Settings
    $wp_customize->add_section( 'relic_fashion_store_woocommerce_general_settings', array(
        'title'    => esc_html__( 'General Settings', 'relic-fashion-store' ),
        'priority' => 2,
        'panel'    => 'relic_fashion_store_woocommerce'
    ) );

    //Add to Cart Button
    $wp_customize->add_setting(
        'relic_fashion_store_woocommerce_addtocart_text',
        array(
            'default'           => esc_html__('Add To Cart', 'relic-fashion-store' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         =>'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_woocommerce_addtocart_text',
		array(
			'section'	  => 'relic_fashion_store_woocommerce_general_settings',
			'label'		  => esc_html__( 'Add To Cart Button Text Change', 'relic-fashion-store' ),
			'description' => esc_html__( 'Change the add to cart button text change.', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
    );


    /***********************************************************
     * Woocommerce Shop page
     ************************************************************/
    $wp_customize->add_section( 'relic_fashion_store_woocommerce_shop_page_sections', array(
        'title'    => esc_html__( 'Shop Page Settings', 'relic-fashion-store' ),
        'priority' => 2,
        'panel'    => 'relic_fashion_store_woocommerce'
    ) );


    //Woocommerce Shop Page Settings
    $wp_customize->add_setting(
        'woocommerce_shop_page_products_count',
        array(
            'default'           => 12,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
    );
    $wp_customize->add_control(
		'woocommerce_shop_page_products_count',
		array(
			'section'	  => 'relic_fashion_store_woocommerce_shop_page_sections',
			'label'		  => esc_html__( 'Shop Page Products', 'relic-fashion-store' ),
			'description' => esc_html__( 'Number of products in shop page.', 'relic-fashion-store' ),
            'type'        => 'number',
            'priority'    => 1
		)		
    );
    
    //  Number of Gallery page Thumbnail Column
    $wp_customize->add_setting('woocommerce_shop_gallery_page_thumnbail_column',array(
        'default'           =>4,
        'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint' //
    ));
    $wp_customize->add_control( 'woocommerce_shop_gallery_page_thumnbail_column',array(
        'label' => esc_html__( 'Number of Gallery page Thumbnail Column', 'relic-fashion-store' ),
        'description'   =>  esc_html__('Product gallery thumnbail columns.','relic-fashion-store'),
        'section' => 'relic_fashion_store_woocommerce_shop_page_sections',
        'type' => 'number',
        'priority'  =>2,
    ));

    //  Number of Column
    $wp_customize->add_setting('woocommerce_shop_page_column_count',array(
        'default'           =>3,
        'sanitize_callback' => 'relic_fashion_store_sanitize_select' //
    ));
    $wp_customize->add_control( 'woocommerce_shop_page_column_count',array(
        'label'         => esc_html__( 'Number of Products Column', 'relic-fashion-store' ),
        'description'   =>  esc_html__('Default loop columns on product archives.','relic-fashion-store'),
        'section'       => 'relic_fashion_store_woocommerce_shop_page_sections',
        'type'          => 'select',
        'choices'       => array(
                            '1'     => esc_html__('1 Column','relic-fashion-store'),
                            '2'     => esc_html__('2 Columns','relic-fashion-store'),
                            '3'     => esc_html__('3 Columns','relic-fashion-store'),
                            '4'     => esc_html__('4 Columns','relic-fashion-store'),
                            '5'     => esc_html__('5 Columns','relic-fashion-store'),
                            '6'     => esc_html__('6 Columns','relic-fashion-store'),
                        ),
        'priority'  =>3,
    ));

    //Archive page settings
    $wp_customize->add_setting(
        'relic_fashion_store_woocommerce_shop_sidebar',
        array(
            'default' => esc_html__('left-sidebar','relic-fashion-store'),
            'sanitize_callback' => 'relic_fashion_store_sanitize_radio'
        )
    );
    $wp_customize->add_control( new Relic_Fashion_Store_Radio_Control(
        $wp_customize, 
        'relic_fashion_store_woocommerce_shop_sidebar', 
        array(
            'type'          => 'radio',
            'label'         => esc_html__( 'Shop PageSidebar', 'relic-fashion-store' ),
            'description'   => esc_html__( 'Shop page sidebar layout.', 'relic-fashion-store' ),
            'section'       => 'relic_fashion_store_woocommerce_shop_page_sections',
            'priority'      => 7,
            'choices'       => array(
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layout/right-sidebar.png',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layout/left-sidebar.png',
                    'full-width'    => get_template_directory_uri() . '/assets/images/layout/no-sidebar.png',
                )
           )
        )
    );

    
    /***********************************************************
     * Single Page Settings
     ************************************************************/
    $wp_customize->add_section( 'relic_fashion_store_woocommerce_single_page_sections', array(
        'title'    => esc_html__( 'Single Page Settings', 'relic-fashion-store' ),
        'priority' => 1,
        'panel'    => 'relic_fashion_store_woocommerce'
    ) );

    //Woocommerce Social Share in Single page
    $wp_customize->add_setting(
        'relic_fashion_store_social_share_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_social_share_enable',
			array(
				'section'	  => 'relic_fashion_store_woocommerce_single_page_sections',
				'label'		  => esc_html__( 'Disable Social Share', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Social Share.', 'relic-fashion-store' ),
                'priority'    => 1
			)
		)
    );

    //  Single Page Related Products Count
    $wp_customize->add_setting('woocommerce_single_page_related_products_count',array(
        'default'           =>3,
        'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint' //
    ));
    $wp_customize->add_control( 'woocommerce_single_page_related_products_count',array(
        'label' => esc_html__( 'Related Products Count', 'relic-fashion-store' ),
        'section' => 'relic_fashion_store_woocommerce_single_page_sections',
        'type' => 'number',
        'priority'  =>2,
    ));

    //  Single Page Related Products Columns
    $wp_customize->add_setting('woocommerce_single_page_related_products_column',array(
        'default'           =>3,
        'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint' //
    ));
    $wp_customize->add_control( 'woocommerce_single_page_related_products_column',array(
        'label' => esc_html__( 'Related Products Columns', 'relic-fashion-store' ),
        'section' => 'relic_fashion_store_woocommerce_single_page_sections',
        'type' => 'number',
        'priority'  =>3,
    ));

    //Archive page settings
    $wp_customize->add_setting(
        'relic_fashion_store_woocommerce_singlepage_sidebar',
        array(
            'default' =>'full-width',
            'sanitize_callback' => 'relic_fashion_store_sanitize_radio'
        )
    );
    $wp_customize->add_control( new Relic_Fashion_Store_Radio_Control(
        $wp_customize, 
        'relic_fashion_store_woocommerce_singlepage_sidebar', 
        array(
            'type'          => 'radio',
            'label'         => esc_html__( 'Single Page Sidebar', 'relic-fashion-store' ),
            'description'   => esc_html__( 'Display Single Page Sidebar.', 'relic-fashion-store' ),
            'section'       => 'relic_fashion_store_woocommerce_single_page_sections',
            'priority'      => 7,
            'choices'       => array(
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layout/right-sidebar.png',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layout/left-sidebar.png',
                    'full-width'    => get_template_directory_uri() . '/assets/images/layout/no-sidebar.png',
                )
           )
        )
    );

}
add_action( 'customize_register', 'relic_fashion_store_customize_woocommerce_settings' );