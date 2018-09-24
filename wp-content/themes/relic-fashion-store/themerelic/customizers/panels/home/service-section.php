<?php
/**
 * Use: Homepage service area
 * Description: add the service area our homepage section.
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_service_box( $wp_customize ) {
    
    //Service section
    $wp_customize->add_section( 'relic_fashion_store_service_secction', array(
        'title'         => esc_html__( 'Service Box', 'relic-fashion-store' ),
        'description'   => esc_html__('Service Box Section is set the service title, short descriptions and fontawesome icons. Drag "Service Item" sort these position.','relic-fashion-store'),
        'priority'      => 6,
        'panel'         =>'relic_fashion_store_homepage_panel'
    ) );

    //Service section setting create
    $wp_customize->add_setting( 
        new Relic_Fashion_Store_Repeater_Setting( 
            $wp_customize, 
            'relic_fashion_store_service_box_items', 
            array(
                'default' => array(
                    array(
                        'service_icons'     => 'fa fa-truck',
                        'service_title'     => esc_html__('Free Shipping', 'relic-fashion-store'),
                        'service_short_desc'=> esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tincidunt mauris eget maximus. Pellentesque ullamcorper vel neque imperdiet vulputate.', 'relic-fashion-store')                      
                    ),
                    array(
                        'service_icons'     => 'fa fa-close',
                        'service_title'     => esc_html__('Free Cancellation', 'relic-fashion-store'),
                        'service_short_desc'=> esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tincidunt mauris eget maximus. Pellentesque ullamcorper vel neque imperdiet vulputate.', 'relic-fashion-store')  
                    ),
                    array(
                        'service_icons'     => 'fa fa-user',
                        'service_title'     => esc_html__('24/7 Customer Support', 'relic-fashion-store'),
                        'service_short_desc'=> esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tincidunt mauris eget maximus. Pellentesque ullamcorper vel neque imperdiet vulputate.', 'relic-fashion-store') 
                    )
                ),
                'sanitize_callback' => array( 'Relic_Fashion_Store_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Repeater_Control(
			$wp_customize,
			'relic_fashion_store_service_box_items',
			array(
				'section' => 'relic_fashion_store_service_secction',				
				'label'	  => __( 'Service Box Add', 'relic-fashion-store' ),
				'fields'  => array(
                    'service_icons' => array(
                        'type'        => 'font',
                        'label'       => esc_html__( 'Service Box Icons', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Click Service Box Icons And Select the Fontawesome Icons.Eg: fa fa-usd', 'relic-fashion-store' ),
                    ),
                    'service_title' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'Service Box Title', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Type the service title. Eg: BIG SAVING', 'relic-fashion-store' ),
                    ),
                    'service_short_desc' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'Service Box Short Desc', 'relic-fashion-store' ),
                        'description' => esc_html__( 'Type the service sort Desce. Eg: Online 24 hours', 'relic-fashion-store' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => esc_html__( 'Service Items', 'relic-fashion-store' ),
                    'field' => 'link'
                )                        
			)
		)
	);
 

}
add_action( 'customize_register', 'relic_fashion_store_service_box' );