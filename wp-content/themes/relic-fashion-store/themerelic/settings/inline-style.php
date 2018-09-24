<?php
/**
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_inline_css(){
	$custom_css = "";
    

    //Home Page Slider Section Enable Disable
    if( get_theme_mod( 'relic_fashion_store_slider_hover_products_enable', true ) == true) { 
        $custom_css .= " 
            .page-template-v2 .div_wrapper {
                position: absolute;
                top: 75%;
                left:0;
                width: 100%
            }

            .page-template-v2 header {
                position: absolute !important;
                top: 0;
                left: 0;
                margin: 0;
                z-index: 1;
                width: 100%;
            }


        ";
    }else{
        $custom_css .= " 
            .page-template-v2 .div_wrapper {
                width: 100%;
            }

            //homepage wrapper
            .page-template-v2 header {
                position: relative !important;
                top: 0;
                left: 0;
                margin: 0;
                z-index: 1;
                width: 100%;
            }

            //slider image
            .banner-control {
                height: 450px !important;
            }

        ";
    }


    //Header Image
    $relic_fashion_store_header_image = esc_url( get_header_image() ); 
    $custom_css .= " 
            .header-wrap-2{
                background-image:url('$relic_fashion_store_header_image') !important;
            }

        ";
    
	

	wp_add_inline_style( 'relic-fashion-store-css', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'relic_fashion_store_inline_css' );
