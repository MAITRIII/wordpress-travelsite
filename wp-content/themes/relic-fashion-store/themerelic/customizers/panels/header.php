<?php
/**
 * Header  Settings
 *
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_register_header( $wp_customize ) {
    
    $wp_customize->add_panel( 'relic_fashion_store_header_settings', array(
        'title'      => esc_html__( 'Logo & Header Settings', 'relic-fashion-store' ),
        'priority'   => 1
    ) );
        
}
add_action( 'customize_register', 'relic_fashion_store_customize_register_header' );