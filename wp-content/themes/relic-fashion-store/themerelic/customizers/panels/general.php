<?php
/**
 * General  Settings
 *
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_register_general( $wp_customize ) {
    
    $wp_customize->add_panel( 'general_setting', array(
        'title'      => esc_html__( 'General Settings', 'relic-fashion-store' ),
        'priority'   => 35
    ) );
        
}
add_action( 'customize_register', 'relic_fashion_store_customize_register_general' );