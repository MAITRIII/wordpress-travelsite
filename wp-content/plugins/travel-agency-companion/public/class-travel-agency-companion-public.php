<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       raratheme.com
 * @since      1.0.0
 *
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/public
 * @author     raratheme <raratheme.com>
 */
class Travel_Agency_Companion_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Travel_Agency_Companion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Travel_Agency_Companion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.7' );
        wp_enqueue_style( 'odometer', plugin_dir_url( __FILE__ ) . 'css/odometer.css', null );
        wp_enqueue_style( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', null, '2.2.1' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/travel-agency-companion-public.css', array(), $this->version, 'all' );
		
        $bg_image = get_theme_mod( 'activities_bg_image', TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img2.jpg' );

        if( $bg_image ){
            $custom_css = '
                    .activities:after{
                        background: url( ' . esc_url( $bg_image ) . ' ) no-repeat;
                    }';
            wp_add_inline_style( $this->plugin_name, $custom_css );
        }
        
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Travel_Agency_Companion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Travel_Agency_Companion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_script( 'odometer', plugin_dir_url( __FILE__ ) . 'js/odometer.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'waypoint', plugin_dir_url( __FILE__ ) . 'js/waypoint.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array( 'jquery' ), '2.2.1', true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/travel-agency-companion-public.js', array( 'jquery' ), $this->version, false );
        
        $array = array( 'rtl' => is_rtl() );
    
        wp_localize_script( $this->plugin_name, 'tac_data', $array );
	}
    
    /**
	 * Add section in plugin to front page. 
	 *
	 * @since    1.0.0
	 */
    public function front_page_sections(){
        $sections      = array();
        $ed_banner     = get_theme_mod( 'ed_banner', true );
        $ed_about      = get_theme_mod( 'ed_about_section', true );
        $ed_activities = get_theme_mod( 'ed_activities_section', true );
        $ed_popular    = get_theme_mod( 'ed_popular_section', true );
        $ed_whyus      = get_theme_mod( 'ed_why_us_section', true );
        $ed_featured   = get_theme_mod( 'ed_feature_section', true );
        $ed_stat       = get_theme_mod( 'ed_stat_section', true );
        $ed_deal       = get_theme_mod( 'ed_deal_section', true );
        $ed_cta        = get_theme_mod( 'ed_cta_section', true );
        $ed_blog       = get_theme_mod( 'ed_blog_section', true );
        
        if( $ed_banner ) array_push( $sections, 'sections/banner' );
        if( $ed_about ) array_push( $sections, 'about' );
        if( $ed_activities ) array_push( $sections, 'activities' );
        if( $ed_popular ) array_push( $sections, 'popular' );
        if( $ed_whyus ) array_push( $sections, 'our-feature' );
        if( $ed_featured ) array_push( $sections, 'featured-trip' );
        if( $ed_stat ) array_push( $sections, 'stats' );
        if( $ed_deal ) array_push( $sections, 'deals' );
        if( $ed_cta ) array_push( $sections, 'cta' );
        if( $ed_blog ) array_push( $sections, 'sections/blog' );
        
        return $sections;
    }

}