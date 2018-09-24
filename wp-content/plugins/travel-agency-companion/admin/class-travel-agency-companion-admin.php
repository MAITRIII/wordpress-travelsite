<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       raratheme.com
 * @since      1.0.0
 *
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/admin
 * @author     raratheme <raratheme.com>
 */
class Travel_Agency_Companion_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/travel-agency-companion-admin.css', array(), $this->version, 'all' );
    	wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.7' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
         wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/travel-agency-companion-admin.js', array( 'jquery' ), $this->version, false );
	}
    
    /**
     * Register Customizer Control Scripts
    */
    public function customize_enqueue_scripts(){
        wp_enqueue_style( 'repeater-css', plugin_dir_url( __FILE__ ) . 'css/repeater.css', null );
        wp_enqueue_script( 'customizer', plugin_dir_url( __FILE__ ) . 'js/customizer.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'repeater', plugin_dir_url( __FILE__ ) . 'js/repeater.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), false, true );
    }
    
	/**
     * List out font awesome icon list
    */
    function travel_agency_get_icon_list(){
	    require_once TRAVEL_AGENCY_COMPANION_BASE_PATH . '/includes/assets/fontawesome.php';
        if( $fontawesome ){ ?>
            <div class="font-awesome-list-template">
                <div class="font-awesome-list">
                    <ul class="font-group">
                    <?php
                        foreach( $fontawesome as $font ){
                            echo '<li><i class="fa ' . esc_attr( $font ) . '"></i></li>';
                        }
                    ?>
                    </ul>
                </div>
            </div>
            <style type="text/css">
            	.font-awesome-list-template{
            		display: none !important;
            	}
            </style>
            <?php
        }        	 
    }

}
