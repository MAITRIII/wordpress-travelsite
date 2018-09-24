<?php
/**
 * Relic_Fashion_Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Relic_Fashion_Store
 */
if( !function_exists('relic_fashion_store_file_directory') ){

    function relic_fashion_store_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }//end condtion
    }
}

/*************************************************************************
* Relic Fashion Store Customizer
* @since Relic Fashion Store 1.0.0
*************************************************************************/
if ( ! defined( 'RELIC_FASHION_STORE_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();	
	define ( 'RELIC_FASHION_STORE_THEME_VERSION', $theme_data->get( 'Version' ) );
}
require relic_fashion_store_file_directory('/themerelic/customizers/customizer.php');


/*************************************************************************
* Relic Fashion Store Hooks  
* @since Relic Fashion Store 1.0.0
*************************************************************************/
require relic_fashion_store_file_directory('/themerelic/hooks/footer-hook.php');
require relic_fashion_store_file_directory('/themerelic/hooks/header-hook.php');


// Woocommerce Based Widgets
if( relic_fashion_store_is_woocommerce_activated() ){
    // Woocommerce Hooks
    require relic_fashion_store_file_directory('/themerelic/hooks/woocommerce.php');
}

/*************************************************************************
 * Relic Fashion Store All Functions
 * 
 * @since Relic Fashion Store 1.0.0
 ************************************************************************/
require relic_fashion_store_file_directory('/themerelic/hooks/relic-fashion-store-function.php');#Relic Fashion Store functions


/*************************************************************************
* Relic Fashion Store Core Functions
* @since Relic Fashion Store 1.0.0
*************************************************************************/
require relic_fashion_store_file_directory('/themerelic/core/custom-header.php');
require relic_fashion_store_file_directory('/themerelic/core/template-tags.php');
require relic_fashion_store_file_directory('/themerelic/core/template-functions.php');
require relic_fashion_store_file_directory('/themerelic/core/class-tgm-plugin-activation.php');

/****************************************************************************
 * Relic Fashion Store Metabox File Require
 * 
 * @since Relic Fashion Store 1.0.0
 ****************************************************************************/
require relic_fashion_store_file_directory('/themerelic/metabox/post-layout-metabox.php');




// Setting Page Section 
require relic_fashion_store_file_directory('/themerelic/settings/inline-style.php');

/**
 * Homepage 
 */
require relic_fashion_store_file_directory('/themerelic/template/home/slider.php');
require relic_fashion_store_file_directory('/themerelic/template/home/service-section.php');
require relic_fashion_store_file_directory('/themerelic/template/home/instagram-feed.php');
require relic_fashion_store_file_directory('/themerelic/template/home/blog.php');

// Woocommerce Based Widgets
if( relic_fashion_store_is_woocommerce_activated() ){
    require relic_fashion_store_file_directory('/themerelic/template/home/single-category-products.php');
    require relic_fashion_store_file_directory('/themerelic/template/home/products-tab.php');
    require relic_fashion_store_file_directory('/themerelic/template/home/single-products.php');
    require relic_fashion_store_file_directory('/themerelic/template/home/category-and-products.php');
}

/**
 * Demo Import functions
 */
require relic_fashion_store_file_directory('/themerelic/demo-import/demo-import.php');