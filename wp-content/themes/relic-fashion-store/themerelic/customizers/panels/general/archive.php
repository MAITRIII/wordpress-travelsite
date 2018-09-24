<?php
/**
 * Archive page Settings
 *
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_customize_archive_page_settings( $wp_customize ) {

    //Main Heaer Panel 
    $wp_customize->add_section( 'relic_fashion_store_archive_page_settings', array(
        'title'    => esc_html__( 'Archive & Blog Page', 'relic-fashion-store' ),
        'priority' => 82,
        'panel'    =>'general_setting'
    ) );

    //Archive page date-metabox
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_feedback_thumbnail',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_archive_page_feedback_thumbnail',
			array(
				'section'	  => 'relic_fashion_store_archive_page_settings',
				'label'		  => esc_html__( 'Disable Default fallback Images', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Default Fallback Images.', 'relic-fashion-store' ),
                'priority'    => 1
			)
		)
    );

    //Archive page date-metabox
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_date_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_archive_page_date_enable',
			array(
				'section'	  => 'relic_fashion_store_archive_page_settings',
				'label'		  => esc_html__( 'Disable Archive Date', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Archive Date.', 'relic-fashion-store' ),
                'priority'    => 1
			)
		)
    );

    //Archive page category
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_category_metabox_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_archive_page_category_metabox_enable',
			array(
				'section'	  => 'relic_fashion_store_archive_page_settings',
				'label'		  => esc_html__( 'Disable the Category Metabox', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Category Metabox', 'relic-fashion-store' ),
                'priority'    => 2
			)
		)
    );

    //Archive page date-metabox
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_author_metabox_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_archive_page_author_metabox_enable',
			array(
				'section'	  => 'relic_fashion_store_archive_page_settings',
				'label'		  => esc_html__( 'Disable the Author Metabox', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Author Metabox', 'relic-fashion-store' ),
                'priority'    => 2
			)
		)
    );

    //Archive page comment metabox
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_comments_metabox_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_archive_page_comments_metabox_enable',
			array(
				'section'	  => 'relic_fashion_store_archive_page_settings',
				'label'		  => esc_html__( 'Disable the Comment Metabox', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Comment Metabox', 'relic-fashion-store' ),
                'priority'    => 2
			)
		)
    );

    //Archive page social share metabox
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_social_share_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_archive_page_social_share_enable',
			array(
				'section'	  => 'relic_fashion_store_archive_page_settings',
				'label'		  => esc_html__( 'Disable the Social Share', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Social Share', 'relic-fashion-store' ),
                'priority'    => 2
			)
		)
    );
    

    //Archive Excerpt archive page
    $wp_customize->add_setting(
        'relic_fashion_store_the_excerpt_word_limit',
        array(
            'default'           => 20,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_the_excerpt_word_limit',
		array(
			'section'	  => 'relic_fashion_store_archive_page_settings',
			'label'		  => esc_html__( 'Word Limit Excerpt', 'relic-fashion-store' ),
			'description' => esc_html__( 'Number of excerpt limit word.', 'relic-fashion-store' ),
            'type'        => 'number',
            'priority'    => 6
		)		
    );

    //Archive page settings
    $wp_customize->add_setting(
        'relic_fashion_store_archive_page_sidebar',
        array(
            'default' =>'right-sidebar',
            'sanitize_callback' => 'relic_fashion_store_sanitize_radio'
        )
    );

    $wp_customize->add_control( new Relic_Fashion_Store_Radio_Control(
        $wp_customize, 
        'relic_fashion_store_archive_page_sidebar', 
        array(
            'type'          => 'radio',
            'label'         => esc_html__( 'Archive page Sidebar', 'relic-fashion-store' ),
            'description'   => esc_html__( 'Relic fashion store sidebar layout.', 'relic-fashion-store' ),
            'section'       => 'relic_fashion_store_archive_page_settings',
            'priority'      => 7,
            'choices'       => array(
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layout/right-sidebar.png',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layout/left-sidebar.png',
                    'full-width'    => get_template_directory_uri() . '/assets/images/layout/no-sidebar.png',
                    'both-sidebar'  => get_template_directory_uri() . '/assets/images/layout/both-sidebar.png'
                )
           )
        )
    );
}
add_action( 'customize_register', 'relic_fashion_store_customize_archive_page_settings' );