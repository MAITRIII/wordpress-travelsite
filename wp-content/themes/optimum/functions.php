<?php
/**
 * optimum functions and definitions
 *
 * @package optimum
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 750; /* pixels */


if ( ! function_exists( 'optimum_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function optimum_setup() {
    global $cap, $content_width;

    /**
     * Add default posts and comments RSS feed links to head
    */
    add_theme_support( 'automatic-feed-links' );

    /**
     * Enable support for Post Thumbnails on posts and pages
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
    add_theme_support( 'post-thumbnails' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
  	 * Enable support for custom logo.
  	 */
  	add_theme_support( 'custom-logo', array(
  		'height'      => 200,
  		'width'       => 140,
  		'flex-height' => true,
  	) );

    /**
     * Enable support for Post Formats
    */
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

    /**
     * Setup the WordPress core custom background feature.
    */
    add_theme_support( 'custom-background', apply_filters( 'optimum_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

 /* Add Menu Support */
    add_theme_support('menus');
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', 'optimum')
        )
    );

    //Enable support for custom header.
    $defaults = array(
    'width'         => 1600,
    'height'        => 300,
    'flex-height'            => false,
    'flex-width'             => false,
    'default-image'          => get_template_directory_uri() .'/includes/images/banner.jpg',
    );
    add_theme_support( 'custom-header', $defaults );


    /* Add Post Thumbnails Support and Related Image Sizes */
    add_theme_support('optimum-post-thumbnails');
    add_image_size('optimum-blog-page', 732, 9999, false);                  // For Blog Page
    add_image_size('optimum-default-page', 1140, 9999, false);              // Default Page and Full Width Page
    add_image_size('optimum-blog-post-thumb', 732, 447, true);              // For Home Blog Section and Gallery Slider on Single and Blog Page

  /**
   * Make theme available for translation
   * Translations can be filed in the /languages/ directory
   * If you're building a theme based on optimum, use a find and replace
   * to change 'optimum' to the name of your theme in all the template files
  */
  load_theme_textdomain( 'optimum', get_template_directory() . '/languages' );

}
endif; // optimum_setup
add_action( 'after_setup_theme', 'optimum_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 */
function optimum_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'optimum' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Sidebar Footer', 'optimum' ),
        'id'            => 'sidebar-footer',
        'before_widget' => '<aside id="%1$s" class="widget %2$s col-3">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

}
add_action( 'widgets_init', 'optimum_widgets_init' );


/**
 * Register google fonts.
 */
function optimum_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
  $http_protocol = is_ssl() ? 'https' : 'http';
	$lora_font = _x( 'on', 'Lora font: on or off', 'optimum' );

	if ( 'off' !== $lora_font ) {
		$font_families = array();

		$font_families[] = 'Lora:400,400i,700,700i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, $http_protocol.'://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles
 *
 */
function optimum_scripts() {

    wp_enqueue_style( 'lora', optimum_fonts_url(), array(), null );

    // load bootstrap css
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.css' );

    // load fontawesome css
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/includes/font-awesome/css/font-awesome.css' );

    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/includes/css/owl.carousel.css' );
    wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/includes/css/owl.theme.default.css' );
    wp_enqueue_style( 'optimum-animations', get_template_directory_uri() . '/includes/css/animations.css' );
    wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/includes/css/meanmenu.css' );
    wp_enqueue_style( 'optimum-theme-style', get_template_directory_uri() . '/includes/css/theme-style.css' );

    // load optimum styles
    wp_enqueue_style( 'optimum-style', get_stylesheet_uri() );

    // load bootstrap js
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.js', array('jquery') );

    // load bootstrap wp js
    wp_enqueue_script( 'bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

    wp_enqueue_script( 'optimum-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

    // Load the html5 shiv.
    wp_enqueue_script( 'html5', get_template_directory_uri() . '/includes/js/html5.js', array(), '20130115', true );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'optimum-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }

    wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/includes/js/smoothscroll.js', array('jquery') );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/includes/js/owl.carousel.js', array('jquery') );
    wp_enqueue_script( 'appear', get_template_directory_uri() . '/includes/js/jquery.appear.js', array('jquery') );
    wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/includes/js/jquery.meanmenu.js', array('jquery') );
    wp_enqueue_script( 'velocity', get_template_directory_uri() . '/includes/js/jquery.velocity.js', array('jquery') );
    wp_enqueue_script( 'optimum-appear-config', get_template_directory_uri() . '/includes/js/appear.config.js', array('jquery') );

    // Theme main js
    wp_enqueue_script( 'optimum-themejs', get_template_directory_uri() . '/includes/js/main.js', array('jquery') );

}
add_action( 'wp_enqueue_scripts', 'optimum_scripts' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';


// Optimum theme options
function optimum_get_options( $id, $default = false ) {
   // assigning theme name
   $themename = get_option( 'stylesheet' );
   $themename = preg_replace("/\W/", "_", strtolower( $themename ) );
   $themename_option_slug = 'optimum_theme_options';

   // getting options value
   $optimum_options = get_theme_mod( $themename_option_slug );
   if ( isset( $optimum_options[ $id ] ) ) {
      return $optimum_options[ $id ];
   } else {
      return $default;
   }
}

/* Theme Social media icons  */
if( !function_exists( 'optimum_socialmedia_navs' ) ){
    function optimum_socialmedia_navs() {
        return array(
            'om_twitter_url' => 'fa fa-twitter',
            'om_facebook_url' => 'fa fa-facebook',
            'om_google_plus_url' => 'fa fa-google-plus',
            'om_linkedin_url' => 'fa fa-linkedin',
            'om_instagram_url' => 'fa fa-instagram',
            'om_youtube_url' => 'fa fa-youtube',
            'om_skype_url' => 'fa fa-skype',
            'om_dribbble_url' => 'fa fa-dribbble',
            'om_digg_url' => 'fa fa-digg',
            'om_github_url' => 'fa fa-github',
            'om_delicious_url' => 'fa fa-delicious',
            'om_reddit_url' => 'fa fa-reddit',
            'om_pinterest_url' => 'fa fa-pinterest',
            'om_rss_url' => 'fa fa-rss'
        );
    }
}

/* Theme Home Slider  */
if( !function_exists( 'optimum_home_slider' ) ){
    function optimum_home_slider() {
        return array(
            'item_1' => array(
                'image' => 'om_slider_image_1',
                'description' => 'om_slider_description_1',
            ),
            'item_2' => array(
                'image' => 'om_slider_image_2',
                'description' => 'om_slider_description_2',
            ),
            'item_3' => array(
                'image' => 'om_slider_image_3',
                'description' => 'om_slider_description_3',
            ),
            'item_4' => array(
                'image' => 'om_slider_image_4',
                'description' => 'om_slider_description_4',
            ),
        );
    }
}
