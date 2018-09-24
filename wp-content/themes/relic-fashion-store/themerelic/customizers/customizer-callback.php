<?php
/**
 * Relic Fashion Store customizer callback functions live change
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Relic_Fashion_Store
 */

/***********************************************************************
 * Top Header Section 
 ********************************************************************/
/** Top Header Address */
if( ! function_exists( 'relic_fashion_store_top_header_address' ) ) {
    //Top Header address
    function relic_fashion_store_top_header_address(){
        return get_theme_mod( 'relic_fashion_store_top_header_address', esc_html__( 'KATHAMANDU , NEPAL', 'relic-fashion-store' ) );
    }
}

/** Top Header Email */
if( ! function_exists( 'relic_fashion_store_top_header_email' ) ) {
    //Top Header email
    function relic_fashion_store_top_header_email(){
        return get_theme_mod( 'relic_fashion_store_top_header_email', esc_html__( 'THEMERELIC@GMAIL.COM', 'relic-fashion-store' ) );
    }
}

/** Top Header phone no */
if( ! function_exists( 'relic_fashion_store_top_header_phone_no' ) ) {
    //Top Header email
    function relic_fashion_store_top_header_phone_no(){
        return get_theme_mod( 'relic_fashion_store_top_header_phone_no', esc_html__( '+977-1234567890', 'relic-fashion-store' ) );
    }
}


/********************************************************************
 *                  Homepage Callback Value
 *********************************************************************/
/** Blog Section */
//Blog section title
if( ! function_exists( 'relic_fashion_store_blog_header_title_callback' ) ) {
    //Blog Section Title
    function relic_fashion_store_blog_header_title_callback(){
        return get_theme_mod( 'relic_fashion_store_blog_header_title', esc_html__( 'RECENT BLOGS', 'relic-fashion-store' ) );
    }
}

//Blog section short desc
if( ! function_exists( 'relic_fashion_store_blog_desc_text_callback' ) ) {
    //Blog Section Title
    function relic_fashion_store_blog_desc_text_callback(){
        return get_theme_mod( 'relic_fashion_store_blog_desc_text', esc_html__( 'Check all our blog posts', 'relic-fashion-store' ) );
    }
}

/** Single Products Section */
//Single Products Title
if( ! function_exists( 'relic_fashion_store_single_product_title_text_callback' ) ) {
    //Single Products Section
    function relic_fashion_store_single_product_title_text_callback(){
        return get_theme_mod( 'relic_fashion_store_single_product_title_text' );
    }
}

//Section Description
if( ! function_exists( 'relic_fashion_store_single_product_description_text_callback' ) ) {
    //Single Products Section
    function relic_fashion_store_single_product_description_text_callback(){
        return get_theme_mod( 'relic_fashion_store_single_product_description_text' );
    }
}

//Button Text Change
if( ! function_exists( 'relic_fashion_store_single_product_btn_text_change_sec_callback' ) ) {
    //Single Products Section
    function relic_fashion_store_single_product_btn_text_change_sec_callback(){
        return get_theme_mod( 'relic_fashion_store_single_product_btn_text_change_sec', esc_html__( 'VIEW ALL', 'relic-fashion-store' ) );
    }
}

/** Instagram Feed */
if( ! function_exists( 'relic_fashion_store_instagram_feed_title_callback' ) ) {
    //Instagram Feed
    function relic_fashion_store_instagram_feed_title_callback(){
        return get_theme_mod( 'relic_fashion_store_instagram_feed_title', esc_html__( 'INSTAGRAM FEED', 'relic-fashion-store' ) );
    }
}


/** Products Tab */
if( ! function_exists( 'relic_fashion_store_get_products_tab_section_title' ) ) {
    /**
     * Display product tab
    */
    function relic_fashion_store_get_products_tab_section_title(){
        return get_theme_mod( 'relic_fashion_store_products_tabs_title', esc_html__( 'POPULAR CATEGORIES', 'relic-fashion-store' ) );
    }
}



/************************************************************************
*                       Footer Sections Hear
*************************************************************************/

/** Footer Payment Method */
if( ! function_exists( 'relic_fashion_store_payment_method_title_callback' ) ) {
    /**
     * Footer Payment Method
    */
    function relic_fashion_store_payment_method_title_callback(){
        return get_theme_mod( 'relic_fashion_store_payment_method_title', esc_html__( 'Accepted Payment Method', 'relic-fashion-store' ) );
    }
}
