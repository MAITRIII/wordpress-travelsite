<?php
/**
 *Slider Settings
 *
 *Use: Homepage slider section products.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_customize_register_slider( $wp_customize ) {
    
    //Slider Section 
    $wp_customize->add_section( 'relic_fashion_store_slider_section', array(
        'title'    => esc_html__( 'Slider Settings', 'relic-fashion-store' ),
        'priority' => 1,
        'panel'    =>'relic_fashion_store_homepage_panel'
    ) );

    /**
     * Slider Section Disable
     */
    $wp_customize->add_setting(
        'relic_fashion_store_slider_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_slider_enable',
			array(
				'section'	  => 'relic_fashion_store_slider_section',
				'label'		  => esc_html__( 'Disable Homepage Slider', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable homepage slider section.', 'relic-fashion-store' ),
                'priority'    => 1,
			)
		)
    );


    /*****************************************************
     * Slider Categories List
     *****************************************************/
    $wp_customize->add_setting(
        'relic_fashion_store_slider_hover_products_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_slider_hover_products_enable',
			array(
				'section'	  => 'relic_fashion_store_slider_section',
				'label'		  => esc_html__( 'Disable Slider Overlap', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable overlap the another section in slider section.', 'relic-fashion-store' ),
                'priority'    => 1,
			)
		)
    );
    
    /*****************************************************
     * Custom Add Slider 
     *****************************************************/
    $wp_customize->add_setting( 
        new Relic_Fashion_Store_Repeater_Setting( 
            $wp_customize, 
            'relic_fashion_store_slider_items', 
            array(
                'default' => array(
                        array(
                            'slider_text'       => esc_html__('Up To 30% Summer Sale Now Starting at $45.00', 'relic-fashion-store'),
                            'slider_links'      => esc_url('https://relic-fashion-store.com/links'),
                            'slider_btn_text'   => esc_html__('EXPLORE', 'relic-fashion-store'),
                            'slider_image'      => get_template_directory_uri().'/assets/images/homepage/slider-image-first.jpg',                       
                        ),
                        array(
                            'slider_text'   => esc_html__('The new collection  is here!', 'relic-fashion-store'),
                            'slider_links'  => esc_url('https://relic-fashion-store.com/links'),
                            'slider_btn_text'  => esc_html__('Shop Now', 'relic-fashion-store'),
                            'slider_image'  => get_template_directory_uri().'/assets/images/homepage/slider-image-first.jpg'                  
                        )
                    )
                ,
                'sanitize_callback' => array( 'Relic_Fashion_Store_Repeater_Setting', 'sanitize_repeater_setting' ),
                            
            ) 
        ) 
    ); 
    $wp_customize->add_control(
		new Relic_Fashion_Store_Repeater_Control(
			$wp_customize,
			'relic_fashion_store_slider_items',
			array(
                'section' => 'relic_fashion_store_slider_section',
                'priority'    => 4,				
                'label'	  => esc_html__( 'Slider Add', 'relic-fashion-store' ),
                'description' => esc_html__( 'Add the slider items.add the same size images.', 'relic-fashion-store' ),
				'fields'  => array(
                    'slider_text' => array(
                        'type'        => 'textarea',
                        'label'       => esc_html__( 'Slider Text', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Sider Text Type Hear.', 'relic-fashion-store' ),
                    ),
                    'slider_btn_text' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'Slider Button Text', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Change the slider button text change.ex:EXPLORE.', 'relic-fashion-store' ),
                    ),
                    'slider_links' => array(
                        'type'        => 'url',
                        'label'       => esc_html__( 'Slider Button Links', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Slider Links Section.EX: www.relic-fashion-store.com/links', 'relic-fashion-store' ),
                    ),
                    'slider_image' => array(
                        'type'        => 'image',
                        'label'       => esc_html__( 'Slider Image Upload', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Upload the slider image', 'relic-fashion-store' ),
                    ),
                    
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => esc_html__( 'Slider Item', 'relic-fashion-store' ),
                    'field' => 'slider'
                )                        
			)
		)
    );

    

}
add_action( 'customize_register', 'relic_fashion_store_customize_register_slider' );