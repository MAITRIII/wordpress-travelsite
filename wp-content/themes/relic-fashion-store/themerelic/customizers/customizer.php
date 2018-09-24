<?php
/**
 * Relic Fashion StoreTheme Customizer
 *
 * @package Relic_Fashion_Store
 */

 /**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function relic_fashion_store_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'relic_fashion_store_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'relic_fashion_store_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'relic_fashion_store_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function relic_fashion_store_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function relic_fashion_store_customize_partial_blogdescription() {
	bloginfo( 'description' );
}



/*************************************************************
*             Call All Panel Section
*************************************************************/
/** homepage woocommerce section hear */
	

$relic_fashion_store_panels   = array( 'header','general', 'home' );
$relic_fashion_store_sections = array( 'woocommerce', 'footer' );
$relic_fashion_store_sub_sections = array(
    'header'     => array( 'logo-brand','top-header', 'main-header' ),
    'home'       => relic_fashion_store_customizer_section(),
    'general'    => array( 'basic','breadcrumb','archive','single' ),
);

foreach( $relic_fashion_store_sections as $section ){
    require get_template_directory() . '/themerelic/customizers/sections/' . $section . '.php';
}

foreach( $relic_fashion_store_panels as $panel ){
   require get_template_directory() . '/themerelic/customizers/panels/' . $panel . '.php';
}

foreach( $relic_fashion_store_sub_sections as $k => $v ){
    foreach( $v as $w ){        
        require get_template_directory() . '/themerelic/customizers/panels/' . $k . '/' . $w . '.php';
    }
}


/*******************************************************
 * Basic Js File enqueue Section
 *******************************************************/
function relic_fashion_store_customize_preview_js() {
	$RelicFashionStoreVer = wp_get_theme();
	$theme_version = $RelicFashionStoreVer->get( 'Version' );
    wp_enqueue_script( 'relic_fashion_store_customizer', get_template_directory_uri() . '/themerelic/customizers/assets/js/customizer.js', array( 'customize-preview', 'customize-selective-refresh' ), esc_attr( $theme_version ), true );
}
add_action( 'customize_preview_init', 'relic_fashion_store_customize_preview_js' );


function relic_fashion_store_customizer_scripts() {
	$RelicFashionStoreVer = wp_get_theme();
	$theme_version = $RelicFashionStoreVer->get( 'Version' );
    wp_enqueue_script( 'relic-fashion-store-homepage-customizer-js', get_template_directory_uri() . '/themerelic/customizers/assets/js/customize-homepage.js', array( 'jquery' ), esc_attr( $theme_version ), true );
}
add_action( 'customize_controls_enqueue_scripts', 'relic_fashion_store_customizer_scripts' );


/*****************************************************
 * Sanitize callback for checkbox
****************************************************/
require get_template_directory() . '/themerelic/customizers/customizer-callback.php';
require get_template_directory() . '/themerelic/customizers/sanitization-functions.php';


/*****************************************************
 * Homepage Settings 
****************************************************/
function relic_fashion_store_customizer_section(){

	//woocommerce class
	if( relic_fashion_store_is_woocommerce_activated() ){
		$relic_fashion_store_woocommerce_section_array = array('single-category-products','single-products','products-tabs','category-and-products');
	}else{
		$relic_fashion_store_woocommerce_section_array = array();
	}

	//Default customizer settings
	$relic_fashion_store_default_section_array = array('slider','service-section','blog','instagram-feed','sort');

	//Marge array
	$relic_fashion_store_homepage_section = array_merge( $relic_fashion_store_woocommerce_section_array,$relic_fashion_store_default_section_array );


	//Retrurn Array File
	return $relic_fashion_store_homepage_section ;
}