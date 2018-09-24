<?php
/**
 * Relic Fashion Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Relic_Fashion_Store
 */
class Relic_Fashion_Store_Functions{
	
	public function __construct(){
		/** Add Action */
		add_action( 'after_setup_theme',array($this,'relic_fashion_store_setup'));
		add_action( 'after_setup_theme',array($this,'relic_fashion_store_content_width') , 0 );
		add_action( 'widgets_init',array($this,'relic_fashion_store_widgets_init') );
		add_action( 'wp_enqueue_scripts',array($this,'relic_fashion_store_scripts') );
		add_action( 'tgmpa_register',array($this,'relic_fashion_store_register_required_plugins'));//Register

	}

	public function relic_fashion_store_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Relic Fashion Store, use a find and replace
		 * to change 'relic-fashion-store' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'relic-fashion-store', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/public ality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		* Editor style.
		*/
		add_editor_style( 'assets/css/admin-editer-style.css' );

		/**
		*Add Custom Image Size
		*
		*/
		add_image_size('relic-fashion-store-blog',400,290, true);

		/**
		 * Menu Register Hear
		 */
		register_nav_menus( array(
			'top-menu' => esc_html__( 'Top Menu', 'relic-fashion-store' ),
			'main-menu'	=> esc_html__('Primary Menu','relic-fashion-store'),
		) );

		/**
		 * Filter the except length to 20 words.
		 * @param int $length Excerpt length.
		 * @return int (Maybe) modified excerpt length.
		 */
		function relic_fashion_store_custom_excerpt_length( $length ) {
			if ( is_admin() ) {
				return $length;
			}
			return get_theme_mod('relic_fashion_store_the_excerpt_word_limit', 20);
		}
		add_filter( 'excerpt_length', 'relic_fashion_store_custom_excerpt_length', 999 );

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
		add_theme_support( 'custom-background', apply_filters( 'relic_fashion_store_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 350,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 * Priority 0 to make it available to lower priority callbacks.
	 * @global int $content_width
	 */
	public function relic_fashion_store_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'relic_fashion_store_content_width', 640 );
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function relic_fashion_store_widgets_init() {
		//Right Sidebar Register
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'relic-fashion-store' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
		
		//Left Sidebar Register
		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'relic-fashion-store' ),
			'id'            => 'left-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

		//Woocommerce sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Woocommerce Sidebar', 'relic-fashion-store' ),
			'id'            => 'woocommerce-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

		//Footer Widget 1 Register
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets 1', 'relic-fashion-store' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

		//Footer Widget 2 Register
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets 2', 'relic-fashion-store' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

		//Footer Widget 3 Register
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets 3', 'relic-fashion-store' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

		//Footer Widget 4 Register
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets 4', 'relic-fashion-store' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'relic-fashion-store' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}

	/******************************************************************
	* 					Enqueue scripts and styles.
	*******************************************************************/
	public function relic_fashion_store_scripts() {
		//Theme Version Check
		$RelicFashionStoreVer = wp_get_theme();
		$theme_version = $RelicFashionStoreVer->get( 'Version' );

		//Google Fonts Enqueue
		$relic_fashion_store_google_fonts_list = array('Poppins','Montserrat');
		foreach(  $relic_fashion_store_google_fonts_list as $google_font ){
			wp_enqueue_style( 'google-fonts-'.$google_font, '//fonts.googleapis.com/css?family='.$google_font.':300italic,400italic,700italic,400,700,300', false ); 
		}

		//Enqueu The Style File
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.min.css', array(), esc_attr( $theme_version ) );#font-awesome
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), esc_attr( $theme_version ) );#font-awesome
		wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/assets/library/owl-carousel/css/owl.carousel.css', array(), esc_attr( $theme_version ) );#owl.carousel
		
		//Reset css file
		wp_enqueue_style( 'relic-fashion-store-style', get_stylesheet_uri() );# Enqueu main File
		
		wp_enqueue_style( 'relic-fashion-store-reset', get_template_directory_uri() . '/assets/css/reset.css', array(), esc_attr( $theme_version ) );#Relic Fashion Store
		wp_enqueue_style( 'relic-fashion-store-css', get_template_directory_uri() . '/assets/css/fashion-store.css', array(), esc_attr( $theme_version ) );#Relic Fashion Store

		//Enqueu The JS File
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/library/owl-carousel/js/owl.carousel.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'relic-fashion-store-main-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), esc_attr( $theme_version), true );
		//Core File Eneueue
		wp_enqueue_script( 'relic-fashion-store-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $theme_version), true );
		wp_enqueue_script( 'relic-fashion-store-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), esc_attr( $theme_version), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'menu-js', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), esc_attr( $theme_version), true );
		

		//Relic Fashion Store Ajax Call
		wp_register_script('relic-fashion-store-ajax', get_template_directory_uri() . '/assets/js/relic-fashion-store-ajaxcall.js', array('jquery'), esc_attr( $theme_version), true );
			$localize = array(
				'ajaxurl' => admin_url('admin-ajax.php'),
			);
		wp_localize_script('relic-fashion-store-ajax', 'RELIC_FASHION_STORE', $localize);
		wp_enqueue_script('relic-fashion-store-ajax');

	}


	/******************************************************************
	 * 			Relic Fashion Store Plugin required
	 ******************************************************************/
	public function relic_fashion_store_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 */
		$plugins = array(

	        array(
	            'name' => esc_attr__( "WooCommerce", 'relic-fashion-store'),
	            'slug' => 'woocommerce',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'YITH WooCommerce Quick View', 'relic-fashion-store'),
	            'slug' => 'yith-woocommerce-quick-view',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'YITH WooCommerce Compare', 'relic-fashion-store'),
	            'slug' => 'yith-woocommerce-compare',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'YITH WooCommerce Wishlist', 'relic-fashion-store'),
	            'slug' => 'yith-woocommerce-wishlist',
	            'required' => false,
	        ),
	        array(
	            'name' => esc_attr__( 'Grid/List View for WooCommerce', 'relic-fashion-store'),
	            'slug' => 'grid/list-view-for-woocommerce',
	            'required' => false,
			),
			array(
				'name' => esc_attr__( 'One Click Demo Import', 'relic-fashion-store'),
				'slug' => 'one-click-demo-import',
				'required' => false,
			),
			array(
				'name' => esc_attr__( 'Contact Form 7', 'relic-fashion-store'),
				'slug' => 'contact-form-7',
				'required' => false,
			),
			
	        

	    );

		/*
		 * Array of configuration settings. Amend each line as needed. 
		*/
		$config = array(
			'id'           => 'relic-fashion-store',                 
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'has_notices'  => true,                    
			'dismissable'  => true,                    
			'dismiss_msg'  => '',                       
			'is_automatic' => false,                   
			'message'      => '',                      
			
		);

		tgmpa( $plugins, $config );
	}
	

}
$Relic_Fashion_Store_Functions = new Relic_Fashion_Store_Functions();


/**************************************************************
 * Relic Fashiion Store Woocommerce Activated
 *************************************************************/
function relic_fashion_store_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

//Require file
//define theme version

require get_template_directory() . '/themerelic/customizers/custom-controls/custom-control.php';
require get_template_directory() . '/themerelic/init.php';#Implement the Custom Header feature.




/**************************************************************************************
 * Relic Fashion Store Products Tab Ajax Call Function Hear
 *************************************************************************************/
add_action( "wp_ajax_nopriv_category_tab_products", 'relic_fashion_store_category_tab_products' );
add_action( 'wp_ajax_category_tab_products','relic_fashion_store_category_tab_products');
if ( ! function_exists( 'relic_fashion_store_category_tab_products' ) ) {  
	function relic_fashion_store_category_tab_products(){
		
		//Ajax Call Products Display Hear
		
		$tab_category_id = $_POST['post_id']; 
		$tab_product_count = $_POST['prduct_count']; 
		$html = ob_start();
	?>
	    <div  class=" pro_right tab-content current">
			<div id="products-tab-slider-ajax" class="row products-tab-slider1 owl-carousel owl-theme">
			<!-- Products Loop -->
				<?php
					$product_args = array(
						'post_type' => 'product',
						'tax_query' => array(
							array(
								'taxonomy'  => 'product_cat',
								'field'     => 'term_id', 
								'terms'     => $tab_category_id // First Element's Value                                                            
							),
                            array(
                                'taxonomy' => 'product_visibility',
                    			'field' => 'name',
                    			'terms' => 'exclude-from-catalog',
                    			'operator'	=>	'NOT IN'
                            )
						),
						'posts_per_page' => $tab_product_count
					);
					$query = new WP_Query($product_args);
					if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
				?>
					<div class="item col-sm-12 col-md-12 col-lg-12  products-full">
						<?php echo wc_get_template_part( 'content', 'product' ); ?>
					</div>
				<?php } } wp_reset_postdata(); ?>
			</div>
		</div><!-- End Tab Section -->
     <?php
     
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
    	exit;
	}
}
