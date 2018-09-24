<?php
/**
 * Archive page Settings
 *
 * @package Relic_Fashion_Store
 * Use: Single page customizer settings.
 */
function relic_fashion_store_customize_single_page_settings( $wp_customize ) {

    //Main Heaer Panel 
    $wp_customize->add_section( 'relic_fashion_store_single_page_settings', array(
        'title'    => esc_html__( 'Single Page && Page', 'relic-fashion-store' ),
        'priority' => 82,
        'panel'    =>'general_setting'
    ) );

    //Single page Relate
    $wp_customize->add_setting(
        'relic_fashion_store_related_post_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_related_post_enable',
			array(
				'section'	  => 'relic_fashion_store_single_page_settings',
				'label'		  => esc_html__( 'Disable The Related Post.', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Related Post', 'relic-fashion-store' ),
                'priority'    => 2
			)
		)
    );

    //Relate Post Count
    $wp_customize->add_setting('relic_fashion_store_single_page_related_post_count',array(
        'default'           => 3,
        'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint' //
    ));
    $wp_customize->add_control( 'relic_fashion_store_single_page_related_post_count',array(
        'label' => esc_html__( 'Number of Related Post', 'relic-fashion-store' ),
        'description'=>esc_html__('Display the Releted Post Count.','relic-fashion-store'),
        'section' => 'relic_fashion_store_single_page_settings',
        'type' => 'number',
        'priority'  => 3,
    ));

    //  Related Post Text Change
    $wp_customize->add_setting('relic_fashion_store_related_post_text_change',array(
        'sanitize_callback' => 'sanitize_text_field', //
        'default'           =>  esc_html__('Related','relic-fashion-store')
    ));
    $wp_customize->add_control( 'relic_fashion_store_related_post_text_change',array(
        'label'     => esc_html__( 'Related Post Text Header Text Change', 'relic-fashion-store' ),
        'description'=>esc_html__('Change the Related Header Text Change.','relic-fashion-store'),
        'section'   => 'relic_fashion_store_single_page_settings',
        'type'      => 'text',
        'priority'  => 4
    ));

    //Single page settings
    $wp_customize->add_setting(
        'relic_fashion_store_single_page_layout_option',
        array(
            'default' =>'right-sidebar',
            'sanitize_callback' => 'relic_fashion_store_sanitize_radio'
        )
    );
    $wp_customize->add_control( new Relic_Fashion_Store_Radio_Control(
        $wp_customize, 
        'relic_fashion_store_single_page_layout_option', 
        array(
            'type'          => 'radio',
            'label'         => esc_html__( 'Single page sidebar', 'relic-fashion-store' ),
            'description'   => esc_html__( 'Single page sidebar layout.', 'relic-fashion-store' ),
            'section'       => 'relic_fashion_store_single_page_settings',
            'priority'      => 7,
            'choices'       => array(
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layout/right-sidebar.png',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layout/left-sidebar.png',
                    'no-sidebar'    => get_template_directory_uri() . '/assets/images/layout/no-sidebar.png',
                    'both-sidebar'    => get_template_directory_uri() . '/assets/images/layout/both-sidebar.png'
                )
           )
        )
    );


    

}
add_action( 'customize_register', 'relic_fashion_store_customize_single_page_settings' );