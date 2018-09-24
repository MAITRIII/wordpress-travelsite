<?php
/**
 * Front Page Template
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relic Fashion Store
 */
get_header();


//Fontpage settings
if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page
    include( get_home_template() );
}else{ 
    relic_fashion_store_homepage_slider_section();#Slider Section
    ?>
    <div class="div_wrapper"> 
    <?php 
        //Loop the Calling Functions
        foreach( get_theme_mod('relic_fashion_store_home_page_sort',relic_fashion_store_default_sort_data()) as $homepage_item ){
            $homepage_function = $homepage_item;
            $homepage_function();
        }
}

get_footer();