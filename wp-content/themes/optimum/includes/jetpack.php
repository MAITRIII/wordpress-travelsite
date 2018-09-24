<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package optimum
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */

if(!function_exists( 'optimum_jetpack_setup' )) {
    function optimum_jetpack_setup() {
    	add_theme_support( 'infinite-scroll', array(
    	    'container' => 'content',
    	    'footer'    => 'page',
    	) );
    }
}
add_action( 'after_setup_theme', 'optimum_jetpack_setup' );
