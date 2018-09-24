<?php
/**
 * Use: Homepage Blog Section
 * Description: display blog section section all customizer settings.
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_register_blog_section( $wp_customize ) {
    
    //Products Category
    $wp_customize->add_section( 'relic_fashion_store_blog_section', array(
        'title'    => esc_html__( 'Blog Section', 'relic-fashion-store' ),
        'priority' => 7,
        'panel'    =>'relic_fashion_store_homepage_panel'
	) );

	//Load More Blog Button Enable
    $wp_customize->add_setting(
        'relic_fashion_store_blog_info_left_section_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_blog_info_left_section_enable',
			array(
				'section'	  => 'relic_fashion_store_blog_section',
				'label'		  => esc_html__( 'Disable blog info', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Blog Info Section.', 'relic-fashion-store' ),
                'priority' => 1,
			)
		)
    );

    //Display Date Metabox
    $wp_customize->add_setting(
        'relic_fashion_store_blog_date_metabox',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_blog_date_metabox',
			array(
				'section'	  => 'relic_fashion_store_blog_section',
				'label'		  => esc_html__( 'Disable Date Metabox', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Date Metabox.', 'relic-fashion-store' ),
                'priority' => 2,
			)
		)
    );

    

    //Display Auther Section
    $wp_customize->add_setting(
        'relic_fashion_store_blog_author_metabox',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_blog_author_metabox',
			array(
				'section'	  => 'relic_fashion_store_blog_section',
				'label'		  => esc_html__( 'Disable Author Metabox', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Author Metabox.', 'relic-fashion-store' ),
                'priority' => 3,
			)
		)
    );


    //Viewer Section Enable
    $wp_customize->add_setting(
        'relic_fashion_store_blog_comments_metabox',
        array(
            'default'           => true,
            'sanitize_callback' => 'relic_fashion_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Relic_Fashion_Store_Toggle_Control( 
			$wp_customize,
			'relic_fashion_store_blog_comments_metabox',
			array(
				'section'	  => 'relic_fashion_store_blog_section',
				'label'		  => esc_html__( 'Disable Comment Metabox', 'relic-fashion-store' ),
                'description' => esc_html__( 'Enable/Disable Viewer Section.', 'relic-fashion-store' ),
                'priority' => 4,
			)
		)
    );

    
    

	//Blog Header Title
	$wp_customize->add_setting(
        'relic_fashion_store_blog_header_title',
        array(
            'default'           => esc_html__('RECENT BLOGS','relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_blog_header_title',
		array(
			'section'	  => 'relic_fashion_store_blog_section',
			'label'		  => esc_html__( 'Blog Header Title', 'relic-fashion-store' ),
			'description' => esc_html__( 'Type your blog header title.Ex: RECENT BLOGS', 'relic-fashion-store' ),
            'type'        => 'text',
            'priority'    => 5,
		)		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_blog_header_title', array(
        'selector' 			=> 'div.blog_item_word h4',
        'render_callback' 	=> 'relic_fashion_store_blog_header_title_callback',
    ) );

    //Blog Read More Text Change
	$wp_customize->add_setting(
        'relic_fashion_store_blog_desc_text',
        array(
            'default'           => esc_html__('Check all our blog posts','relic-fashion-store'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_blog_desc_text',
		array(
			'section'	  => 'relic_fashion_store_blog_section',
			'label'		  => esc_html__( 'Change Blog Description.', 'relic-fashion-store' ),
			'description' => esc_html__( 'Eg:Check all our blog posts', 'relic-fashion-store' ),
            'type'        => 'text',
            'priority'    => 6,
		)		
    );
    $wp_customize->selective_refresh->add_partial( 'relic_fashion_store_blog_desc_text', array(
        'selector' 			=> 'div.blog_item_word a',
        'render_callback' 	=> 'relic_fashion_store_blog_desc_text_callback',
    ) );

	/** Select Blog Section Hear */
	$wp_customize->add_setting( 
        'relic_fashion_store_post_category_select', 
        array(
			'default' => esc_html__('all','relic-fashion-store'),
            'sanitize_callback' => 'relic_fashion_store_sanitize_select'
        )
    );
     
    $wp_customize->add_control( 
        'relic_fashion_store_post_category_select', 
        array(
			'label'         => esc_html__( 'Select Post Category', 'relic-fashion-store' ),
			'description'   => esc_html__( 'Select The Post Category in All Section Hear.', 'relic-fashion-store' ),
            'section'       => 'relic_fashion_store_blog_section',
            'type'          => 'select',
            'choices'       => relic_fashion_store_get_post_categories( ),
            'priority'      => 7,
        )
	); 
	

	//Number of Homepage Blog
	$wp_customize->add_setting(
        'relic_fashion_store_blog_number_of_post',
        array(
            'default'           => 2,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
		'relic_fashion_store_blog_number_of_post',
		array(
			'section'	  => 'relic_fashion_store_blog_section',
			'label'		  => esc_html__( 'Number of Post', 'relic-fashion-store' ),
			'description' => esc_html__( 'Number of Post Display on Tab Section.', 'relic-fashion-store' ),
            'type'        => 'number',
            'priority'      => 8,
		)		
    );

}
add_action( 'customize_register', 'relic_fashion_store_customize_register_blog_section' );