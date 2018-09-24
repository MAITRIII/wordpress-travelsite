<?php
/**
 * seolib functions and definitions
 * Please browse readme.txt for credits and forking information
 *
 * @package seolib
 */


if ( ! function_exists( 'seolib_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */


function seolib_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on seolib, use a find and replace
	 * to change 'seolib' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'seolib', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270);
	add_image_size( 'seolib-full-width', 1038, 576, true );
	
	
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
            'primary' => esc_html__( 'Top Primary Menu', 'seolib' ),
    ) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'seolib_custom_background_args', array(
		'default-color' => 'f5f5f5',
		'default-image' => '',
		) ) );

}


endif; // seolib_setup
add_action( 'after_setup_theme', 'seolib_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 */
function seolib_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seolib_content_width', 640 );
}
add_action( 'after_setup_theme', 'seolib_content_width', 0 );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

function seolib_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'seolib' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Widgets here will appear in your sidebar', 'seolib' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="sidebar-headline-wrapper"><div class="widget-title-lines"></div><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
		) );
}
add_action( 'widgets_init', 'seolib_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seolib_scripts ( $in_footer ) {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css',true );  

	wp_enqueue_style( 'seolib-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css',true );   
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js',array('jquery'),'',true);  

	wp_enqueue_script( 'jquery-seolib-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );

	wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js', array(),'3.7.3',false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'seolib_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load custom nav walker
 */
if(!class_exists('wp_bootstrap_navwalker')){
	require get_template_directory() . '/inc/navwalker.php';
}


function seolib_google_fonts() {
	$query_args = array(

		'family' => 'Merriweather:700,700i|Lato:400,400italic,600'
		);
    wp_enqueue_style( 'seolib-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
}

add_action('wp_enqueue_scripts', 'seolib_google_fonts');


function seolib_new_excerpt_more( $more ) {
	if ( is_admin() ) {return $more;}$link = sprintf( '',esc_url( get_permalink( get_the_ID() ) ));
	return ' &hellip; ' . $link;

}
add_filter( 'excerpt_more', 'seolib_new_excerpt_more' );




/**
*
* Custom Logo in the top menu
*
**/
function seolib_logo() {
	add_theme_support('custom-logo', array(
		'size' => 'seolib-logo',
		'flex-height'            => true,
		));
}

add_action('after_setup_theme', 'seolib_logo');


/**
*
* New Footer Widgets
*
**/

function seolib_footer_widget_left_init() {

	register_sidebar( array(
		'name' => esc_html__('Footer Widget left', 'seolib'),
		'id' => 'footer_widget_left',
		'description'   => esc_html__( 'Widgets here will appear in your footer', 'seolib' ),
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'seolib_footer_widget_left_init' );

function seolib_footer_widget_middle_init() {

	register_sidebar( array(
		'name' => esc_html__('Footer Widget middle', 'seolib'),
		'id' => 'footer_widget_middle',
		'description'   => esc_html__( 'Widgets here will appear in your footer', 'seolib' ),
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'seolib_footer_widget_middle_init' );

function seolib_footer_widget_right_init() {

	register_sidebar( array(
		'name' => esc_html__('Footer Widget right', 'seolib'),
		'id' => 'footer_widget_right',
		'before_widget' => '<div class="footer-widgets">',
		'description'   => esc_html__( 'Widgets here will appear in your footer', 'seolib' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );
}
add_action( 'widgets_init', 'seolib_footer_widget_right_init' );


