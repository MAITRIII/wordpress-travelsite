<?php
/**
 * Travel Agency Demo Content Information
 *
 * @package lawyer_landing_page
 */

function travel_agency_customizer_demo_content( $wp_customize ) {
	
    $wp_customize->add_section( 
        'theme_demo_content',
        array(
            'title'    => __( 'Demo Content Import', 'travel-agency' ),
            'priority' => 7,
		)
    );
        
    $wp_customize->add_setting(
		'demo_content_instruction',
		array(
			'sanitize_callback' => 'wp_kses_post'
		)
	);

	$demo_content_description = '<div class="customizer-custom">';
    $demo_content_description .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Demo Import Tutorial', 'travel-agency' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/blog/import-demo-content-rara-themes/' ) . '" target="_blank">' . __( 'here', 'travel-agency' ) . '</a></span>';
	$demo_content_description .= '</div>';

    // $demo_content_description = sprintf( __( 'Travel Agency comes with demo content import feature. You can import the demo content with just one click. For step-by-step video tutorial, %1$sClick here%2$s', 'travel-agency' ), '<a class="documentation" href="' . esc_url( 'https://raratheme.com/blog/import-demo-content-rara-themes/' ) . '" target="_blank">', '</a>' );

	$wp_customize->add_control(
		new Travel_Agency_Info_Text( 
			$wp_customize,
			'demo_content_instruction',
			array(
				'label'       => __( 'About Demo Import' , 'travel-agency' ),
				'section'     => 'theme_demo_content',
				'description' => $demo_content_description
			)
		)
	);
    
	$theme_demo_content_desc = '<div class="customizer-custom">';

	if( ! class_exists( 'RDDI_init' ) ){
		$theme_demo_content_desc .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Plugin required', 'travel-agency' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/plugins/rara-one-click-demo-import/' ) . '" target="_blank">' . __( 'Rara One Click Demo Import', 'travel-agency' ) . '</a></span><br />';
	}

	$theme_demo_content_desc .= '<span class="sticky_info_row download-link"><label class="row-element">' . __( 'Download Demo Content Zip File', 'travel-agency' ) . ': </label><a href="' . esc_url( 'https://raratheme-wbtneb0y4p.netdna-ssl.com/wp-content/uploads/2017/12/travel-agency-demo-content.zip' ) . '" target="_blank" rel="no-follow">' . __( 'Click here', 'travel-agency' ) . '</a></span><br />';

	$theme_demo_content_desc .= '</div>';
	$wp_customize->add_setting( 
        'theme_demo_content_info',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
		)
    );

	// Demo content 
	$wp_customize->add_control( 
        new Travel_Agency_Info_Text( 
            $wp_customize,
            'theme_demo_content_info',
            array(
                'section'     => 'theme_demo_content',
                'description' => $theme_demo_content_desc
    		)
        )
    );

}
add_action( 'customize_register', 'travel_agency_customizer_demo_content' );