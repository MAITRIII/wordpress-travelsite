<?php
/**
 * Home page Panel Settings
 *
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_register_homepage( $wp_customize ) {
    
    $wp_customize->add_panel( 'relic_fashion_store_homepage_panel', array(
        'title'      => esc_html__( 'Frontpage Settings', 'relic-fashion-store' ),
        'priority'   => 35
    ) );
        
}
add_action( 'customize_register', 'relic_fashion_store_customize_register_homepage' );