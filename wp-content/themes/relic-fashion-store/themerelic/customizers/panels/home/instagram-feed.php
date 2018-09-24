<?php
/**
 * Use: Homepage Instagram Feed
 * Description: Display instagram post images.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_instagram_feed( $wp_customize ) {
	   
	//Instagram Feed Section
    $wp_customize->add_section( 'relic_fashion_store_instagram_feed', array(
        'title'    => esc_html__( 'Instagram Feed', 'relic-fashion-store' ),
        'priority' => 8,
        'panel'    =>'relic_fashion_store_homepage_panel'
	) );

	/** Instagram Feed Title */
	$wp_customize->add_setting(
        'relic_fashion_store_instagram_feed_title',
        array(
            'default'           => esc_html__('INSTAGRAM FEED', 'relic-fashion-store'),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_instagram_feed_title',
		array(
			'section'	  => 'relic_fashion_store_instagram_feed',
			'label'		  => esc_html__( 'Instagram Feed Title', 'relic-fashion-store' ),
			'description' => esc_html__( 'Instagram Feed Title Display', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
	);
	$wp_customize->selective_refresh->add_partial( 'relic_fashion_store_instagram_feed_title', array(
        'selector' 			=> 'div.instagram_feed h5',
        'render_callback' 	=> 'relic_fashion_store_instagram_feed_title_callback',
    ) );
	
	/** Instagram Feed Tocken ID */
	$wp_customize->add_setting(
        'relic_fashion_store_instagram_feed_tocken_id',
        array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'relic_fashion_store_instagram_feed_tocken_id',
		array(
			'section'	  => 'relic_fashion_store_instagram_feed',
			'label'		  => esc_html__( 'Instagram Tocken ID', 'relic-fashion-store' ),
			'description' => esc_html__( 'Go to this site take your token id: http://instagram.pixelunion.net/', 'relic-fashion-store' ),
            'type'        => 'text'
		)		
    );
	
	/** Instagram Post Count */
	$wp_customize->add_setting(
        'relic_fashion_store_instagram_feed_post_count',
        array(
            'default'           => 8,
            'sanitize_callback' => 'relic_fashion_store_sanitize_number_absint',
        )
	);
	$wp_customize->add_control(
		'relic_fashion_store_instagram_feed_post_count',
		array(
			'section'	  => 'relic_fashion_store_instagram_feed',
			'label'		  => esc_html__( 'Number of Post', 'relic-fashion-store' ),
			'description' => esc_html__( 'Instagram image count hear.', 'relic-fashion-store' ),
            'type'        => 'number'
		)		
    );
  

}
add_action( 'customize_register', 'relic_fashion_store_instagram_feed' );