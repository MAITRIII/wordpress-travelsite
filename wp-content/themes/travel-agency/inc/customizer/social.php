<?php
/**
 * Header Settings
 *
 * @package Travel_Agency
 */

function travel_agency_customize_register_social( $wp_customize ) {
	
    require_once get_template_directory() . '/inc/customizer/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/customizer/repeater/class-control-repeater.php';
    
    $wp_customize->add_section( 'social_setting', array(
        'title'    => __( 'Social Settings', 'travel-agency' ),
        'priority' => 30,
        'panel'    => 'header_setting',
    ) );
    
    /** Enable/Disable Social Links */
    $wp_customize->add_setting(
        'ed_social_links',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_social_links',
		array(
			'section'	  => 'social_setting',
			'label'		  => __( 'Social Links', 'travel-agency' ),
			'description' => __( 'Enable to show social links in header.', 'travel-agency' ),
            'type'        => 'checkbox'
		)		
	);
    
    /** Social Links */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => array(
                    array(
                        'font' => 'fa fa-facebook',
                        'link' => 'https://www.facebook.com/',                        
                    ),
                    array(
                        'font' => 'fa fa-twitter',
                        'link' => 'https://twitter.com/',
                    ),
                    array(
                        'font' => 'fa fa-youtube-play',
                        'link' => 'https://www.youtube.com/',
                    ),
                    array(
                        'font' => 'fa fa-instagram',
                        'link' => 'https://www.instagram.com/',
                    ),
                    array(
                        'font' => 'fa fa-google-plus-circle',
                        'link' => 'https://plus.google.com',
                    ),
                    array(
                        'font' => 'fa fa-odnoklassniki',
                        'link' => 'https://ok.ru/',
                    ),
                    array(
                        'font' => 'fa fa-vk',
                        'link' => 'https://vk.com/',
                    ),
                    array(
                        'font' => 'fa fa-xing',
                        'link' => 'https://www.xing.com/',
                    )
                ),
                'sanitize_callback' => array( 'Travel_Agency_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Travel_Agency_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_setting',				
				'label'	  => __( 'Social Links', 'travel-agency' ),
				'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'travel-agency' ),
                        'description' => __( 'Example: fa-bell', 'travel-agency' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'travel-agency' ),
                        'description' => __( 'Example: http://facebook.com', 'travel-agency' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'travel-agency' ),
                    'field' => 'link'
                )                        
			)
		)
	);
}
add_action( 'customize_register', 'travel_agency_customize_register_social' );