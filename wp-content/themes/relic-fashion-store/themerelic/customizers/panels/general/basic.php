<?php
/**
 * General Settings Hear
 *
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_customize_general_settings( $wp_customize ) {
	
    /**
    * General Settings Panel
    */
    $wp_customize->get_section('header_image')->panel = 'general_setting';
    $wp_customize->get_section('header_image' )->priority = 2;

    $wp_customize->get_section('colors')->panel = 'general_setting';
    $wp_customize->get_section('title_tagline' )->priority = 3;

    $wp_customize->get_section('background_image')->panel = 'general_setting';
    $wp_customize->get_section('header_image' )->priority = 4;

}
add_action( 'customize_register', 'relic_fashion_store_customize_general_settings' );