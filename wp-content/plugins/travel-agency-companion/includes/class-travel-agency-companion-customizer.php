<?php
/**
* Register all the sections for travel agency theme.
*
*
* @package    Travel_Agency_Companion
* @subpackage Travel_Agency_Companion/includes
* @author     raratheme <raratheme.com>
*/
add_action( 'customize_register',  'travel_agency_customize_register' );
/**
 * Home Page Settings
 *
 * @package Travel_Agency_Companion
 */
function travel_agency_customize_register( $wp_customize ) {
    
    /**
	 * The class responsible for creating control for plugin recommendation
	 */
	require_once TRAVEL_AGENCY_COMPANION_BASE_PATH . '/includes/class-travel-agency-companion-plugin-recommend.php';
        
	if( class_exists( 'WP_Customize_Control' ) ){

		class Travel_Agency_Customize_Editor_Control extends WP_Customize_Control {
			public $type = 'textarea';
		    /**
		    ** Render the content on the theme customizer page
		    */
		    public function render_content() { ?>
		        <label>
		          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		          <?php
		            $settings = array(
		              'media_buttons' => true,
		              'quicktags' => true
		              );
		            $this->filter_editor_setting_link();
		            wp_editor($this->value(), $this->id, $settings );
		          ?>
		        </label>
		    <?php
		        do_action('admin_footer');
		        do_action('admin_print_footer_scripts');
		    }
		    private function filter_editor_setting_link() {
		        add_filter( 'the_editor', function( $output ) { return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); } );
		    }
		}
	}

	if ( class_exists( 'WP_Customize_control' ) && !class_exists('Travel_Agency_Info_Text') ) {

		class Travel_Agency_Info_Text extends Wp_Customize_Control {
			
			public function render_content(){ ?>
	    	    <span class="customize-control-title">
	    			<?php echo esc_html( $this->label ); ?>
	    		</span>
	    
	    		<?php if( $this->description ){ ?>
	    			<span class="description customize-control-description">
	    			<?php echo wp_kses_post($this->description); ?>
	    			</span>
	    		<?php }
	        }
		}
	}
	
	/**
	 * The class responsible for defining control repeater
	 */
	require_once TRAVEL_AGENCY_COMPANION_BASE_PATH . '/includes/class-control-repeater.php';
	
	/**
	 * The class responsible for defining repeater settings
	 */
	require_once TRAVEL_AGENCY_COMPANION_BASE_PATH . '/includes/class-repeater-setting.php';
	
	$obj      = new Travel_Agency_Companion_Functions;
    $defaults = new Travel_Agency_Companion_Dummy_Array;
    
    /** About Us Section */
    $wp_customize->add_section( 'about_us_section', array(
        'title'    => __( 'About Us Section', 'travel-agency-companion' ),
        'priority' => 15,
        'panel'    => 'home_page_setting',
	) );
	
    /** Enable/Disable About Section */
    $wp_customize->add_setting(
        'ed_about_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_about_section',
		array(
			'section' => 'about_us_section',
			'label'	  => __( 'Enable About Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Section Title */
	$wp_customize->add_setting(
        'about_us_title',
        array(
            'default'           => __( 'Create Your Travel Booking Website with Travel Agency Theme', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_us_title',
        array(
            'label'   => __( 'Section Title', 'travel-agency-companion' ),
            'section' => 'about_us_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_us_title', array(
        'selector'        => '#about_section .row .text-holder h2',
        'render_callback' => 'travel_agency_companion_get_about_title',
    ) );
    
    /** Section Description */
    $wp_customize->add_setting(
        'about_us_desc',
        array(
            'default' => __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.
            
            Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.
            
            It is also translation ready. So you can translate your website in any language.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_us_desc',
        array(
            'label'   => __( 'Section Description', 'travel-agency-companion' ),
            'section' => 'about_us_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_us_desc', array(
        'selector'        => '#about_section .row .text-holder .content',
        'render_callback' => 'travel_agency_companion_get_about_content',
    ) );
    
    /** Read More Label */
   	$wp_customize->add_setting(
        'about_us_readmore',
        array(
            'default'           => __( 'View More', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_us_readmore',
        array(
            'label'   => __( 'Read More label', 'travel-agency-companion' ),
            'section' => 'about_us_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_us_readmore', array(
        'selector'        => '#about_section .row .text-holder .btn-more',
        'render_callback' => 'travel_agency_companion_get_about_label',
    ) );
    
    /** Read More Link */
    $wp_customize->add_setting(
        'about_us_readmore_link',
        array(
            'default'           => __( '#', 'travel-agency-companion' ),
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'about_us_readmore_link',
        array(
            'label'   => __( 'Read More link', 'travel-agency-companion' ),
            'section' => 'about_us_section',
            'type'    => 'text',
        )
    );
    
    /** Ad Image/Code */
	$wp_customize->add_setting( 'about_us_ad_content',
		array(
			'default'           => '<img src="' . esc_url( TRAVEL_AGENCY_COMPANION_URL.'includes/images/img1.jpg' ) . '"/>',
        )
    );

	$wp_customize->add_control(
		new Travel_Agency_Customize_Editor_Control(
			$wp_customize,
			'about_us_ad_content',
			array(
				'label'    => 'Ad Image/Code',
				'section'  => 'about_us_section',
				'settings' => 'about_us_ad_content'
			)
		)
	);
    
    /** Activities Section */
    $wp_customize->add_section( 'activities_section', array(
        'title'    => __( 'Adventure Section', 'travel-agency-companion' ),
        'priority' => 20,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Enable/Disable Activities Section */
    $wp_customize->add_setting(
        'ed_activities_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_activities_section',
		array(
			'section' => 'activities_section',
			'label'	  => __( 'Enable Adventure Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Section Title */
	$wp_customize->add_setting(
        'activities_title',
        array(
            'default'           => __( 'Adventure Activities', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'activities_title',
        array(
            'label'   => __( 'Section Title', 'travel-agency-companion' ),
            'section' => 'activities_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'activities_title', array(
        'selector'        => '.activities .section-header .section-title',
        'render_callback' => 'travel_agency_companion_get_activities_title',
    ) );
    
    /** Section Description */
    $wp_customize->add_setting(
        'activities_desc',
        array(
            'default' => __( 'This is the best place to tell your visitors what travel services your company provide. You can modify this section from Appearance > Customize > Home Page Settings > Adventure Section on your WordPress.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'activities_desc',
        array(
            'label'   => __( 'Section Description', 'travel-agency-companion' ),
            'section' => 'activities_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'activities_desc', array(
        'selector'        => '.activities .section-header .section-content',
        'render_callback' => 'travel_agency_companion_get_activities_content',
    ) );
    
    /** Background Image */
    $wp_customize->add_setting(
        'activities_bg_image',
        array(
            'default'           => TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img2.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'activities_bg_image',
           array(
               'label'   => __( 'Background Image', 'travel-agency-companion' ),
               'section' => 'activities_section'
           )
       )
    );

    /** Activities */
    $wp_customize->add_setting( 
        new Rara_Repeater_Setting( 
            $wp_customize, 
            'activities', 
            array(
                'default' => $defaults->default_activities(),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Control_Repeater(
			$wp_customize,
			'activities',
			array(
				'section'		=> 'activities_section',				
				'label'			=> __( 'Add Adventures', 'travel-agency-companion' ),
                'description'   => __( 'Add adventures from here', 'travel-agency-companion' ),
				'fields'     => array(
                    'name'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-companion' ),
                    ),
                    'desc'     => array(
                        'type'  => 'textarea',
                        'label' => __( 'Description', 'travel-agency-companion' ),
                    ),
                    'url'     => array(
                        'type'  => 'url',
                        'label' => __( 'Link', 'travel-agency-companion' ),
                    ),
                    'thumbnail'     => array(
                        'type'   => 'cropped_image',
                        'label'  => __( 'Thumbnail', 'travel-agency-companion' ),
                        'height' => 450,
                        'width'  => 360
                    ),
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'adventures', 'travel-agency-companion' ),
                    'field' => 'name'
                ),                          
			)
		)
	);

    /** Popular Section */
    $wp_customize->add_section( 'popular_section', array(
        'title'    => __( 'Best Sellers Packages', 'travel-agency-companion' ),
        'priority' => 25,
        'panel'    => 'home_page_setting',
    ) );
    
    /** Enable/Disable Popular Section */
    $wp_customize->add_setting(
        'ed_popular_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_popular_section',
		array(
			'section' => 'popular_section',
			'label'	  => __( 'Enable Best Sellers Packages Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Section Title */
	$wp_customize->add_setting(
        'popular_title',
        array(
            'default'           => __( 'Our Best Sellers Packages', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'popular_title',
        array(
            'label'   => __( 'Section Title', 'travel-agency-companion' ),
            'section' => 'popular_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'popular_title', array(
        'selector'        => '.popular-destination .section-header .section-title',
        'render_callback' => 'travel_agency_companion_get_popular_title',
    ) );
    
    /** Section Description */
    $wp_customize->add_setting(
        'popular_desc',
        array(
            'default' => __( 'This is the best place to show your most sold and popular travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Best Sellers Packages.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'popular_desc',
        array(
            'label'   => __( 'Section Description', 'travel-agency-companion' ),
            'section' => 'popular_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'popular_desc', array(
        'selector'        => '.popular-destination .section-header .section-content',
        'render_callback' => 'travel_agency_companion_get_popular_content',
    ) ); 
        
	if( $obj->travel_agency_is_wpte_activated() ){
        
        /** Popular Note */
    	$wp_customize->add_setting( 'popular_note',
            array(
                'default' => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control( new Travel_Agency_Info_Text( $wp_customize,
            'popular_note', 
                array(
                    'section'     => 'popular_section',
                    'description' => __( 'We recommend to choose all the options here for a flawless design.', 'travel-agency-companion' )
                )
            )
        );
        
        /** Enable/Disable Popular Section */
        $wp_customize->add_setting(
            'ed_popular_demo',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		'ed_popular_demo',
    		array(
    			'section'     => 'popular_section',
    			'label'	      => __( 'Enable Best Seller Demo Content', 'travel-agency-companion' ),
                'description' => __( 'If there are no Best Seller Category and Posts selected, demo content will be displayed. Uncheck to hide demo content of this section.', 'travel-agency-companion' ),
                'type'        => 'checkbox'
    		)		
    	);
        
        /** Popular Category */
        $wp_customize->add_setting(
            'popular_cat',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'popular_cat',
            array(
                'label'       => __( 'Choose Best Seller Category', 'travel-agency-companion' ),
                'description' => __( 'Go to Trips > Activities and add. Then you will be able to select a trip activities from the dropdown.', 'travel-agency-companion' ),
                'section'     => 'popular_section',
                'type'        => 'select',
                'choices'     => $obj->travel_agency_get_categories( true, 'activities', true )
            )
        );
        
        /** Popular Trip Note */
    	$wp_customize->add_setting( 'popular_tripnote',
            array(
                'default' => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control( new Travel_Agency_Info_Text( $wp_customize,
            'popular_tripnote', 
                array(
                    'section'     => 'popular_section',
                    'description' => __( 'Go to Trips > Add New trips. Then you will be able to select a trip from the dropdown below.', 'travel-agency-companion' ),
                )
            )
        );
        
        /** Popular Post One */
        $wp_customize->add_setting(
            'popular_post_one',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'popular_post_one',
            array(
                'label' => __( 'Best Seller One', 'travel-agency-companion' ),
                'section' => 'popular_section',
                'type' => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** Popular Post Two */
        $wp_customize->add_setting(
            'popular_post_two',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'popular_post_two',
            array(
                'label' => __( 'Best Seller Two', 'travel-agency-companion' ),
                'section' => 'popular_section',
                'type' => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** Popular Post Three */
        $wp_customize->add_setting(
            'popular_post_three',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'popular_post_three',
            array(
                'label' => __( 'Best Seller Three', 'travel-agency-companion' ),
                'section' => 'popular_section',
                'type' => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** Popular Post Four */
        $wp_customize->add_setting(
            'popular_post_four',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'popular_post_four',
            array(
                'label' => __( 'Best Seller Four', 'travel-agency-companion' ),
                'section' => 'popular_section',
                'type' => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** View All Label */
    	$wp_customize->add_setting(
            'popular_view_all_label',
            array(
                'default'           => __( 'View All Packages', 'travel-agency-companion' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'popular_view_all_label',
            array(
                'label'   => __( 'View All Label', 'travel-agency-companion' ),
                'section' => 'popular_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'popular_view_all_label', array(
            'selector'        => '.popular-destination .btn-holder .btn-more',
            'render_callback' => 'travel_agency_companion_get_popular_view_all',
        ) );
        
        /** View All URL */
    	$wp_customize->add_setting(
            'popular_view_all_url',
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        
        $wp_customize->add_control(
            'popular_view_all_url',
            array(
                'label'   => __( 'View All URL', 'travel-agency-companion' ),
                'section' => 'popular_section',
                'type'    => 'text',
            )
        );
    
    }else{                
        //if( class_exists( 'Travel_Agency_Companion_Plugin_Recommend_Control' ) ){
    		$wp_customize->add_setting(
    			'popular_note', array(
    				'sanitize_callback' => 'sanitize_text_field',
    			)
    		);
    
    		$wp_customize->add_control(
    			new Travel_Agency_Companion_Plugin_Recommend_Control(
    				$wp_customize, 'popular_note', array(
    					'label'       => __( 'Instructions', 'travel-agency-companion' ),
    					'section'     => 'popular_section',
    					'capability'  => 'install_plugins',
                        'plugin_slug' => 'wp-travel-engine',
                        'description' => __( 'Please install the recommended plugin "WP Travel Engine" for setting of this section.', 'travel-agency-companion' )
    				)
    			)
    		);
    	//}
    }
    
    /** Why Book with Us */
    $wp_customize->add_section( 'whyus_section', array(
        'title'    => __( 'Why Book with Us', 'travel-agency-companion' ),
        'priority' => 30,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Enable/Disable Why Us Section */
    $wp_customize->add_setting(
        'ed_why_us_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_why_us_section',
		array(
			'section' => 'whyus_section',
			'label'	  => __( 'Enable Why Us Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Title */
    $wp_customize->add_setting(
        'whyus_title',
        array(
            'default'           => __( 'Why Book with Us', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'whyus_title',
        array(
            'label'   => __( 'Title', 'travel-agency-companion' ),
            'section' => 'whyus_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'whyus_title', array(
        'selector'        => '#whyus_section .section-header .section-title',
        'render_callback' => 'travel_agency_companion_get_why_us_title',
    ) );
    
    /** Description */
    $wp_customize->add_setting(
        'whyus_desc',
        array(
            'default'           => __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'whyus_desc',
        array(
            'label'   => __( 'Description', 'travel-agency-companion' ),
            'section' => 'whyus_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'whyus_desc', array(
        'selector'        => '#whyus_section .section-header .section-content',
        'render_callback' => 'travel_agency_companion_get_why_us_content',
    ) );
    
    /** Background Image */
    $wp_customize->add_setting(
        'whyus_bg_image',
        array(
            'default'           => TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img13.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'whyus_bg_image',
           array(
               'label'   => __( 'Background Image', 'travel-agency-companion' ),
               'section' => 'whyus_section'
           )
       )
    );
    
    /** Why Us Repeater */
    $wp_customize->add_setting( 
        new Rara_Repeater_Setting( 
            $wp_customize, 
            'why_us', 
            array(
                'default' => $defaults->default_why_us(),                    
            ) 
        ) 
    );
    
    $wp_customize->add_control(
    	new Rara_Control_Repeater(
    		$wp_customize,
    		'why_us',
    		array(
    			'section' => 'whyus_section',				
    			'label'	  => __( 'Add Points', 'travel-agency-companion' ),
                'fields'  => array(
                    'whyus-icon' => array(
                        'type'  => 'font', 
                        'label' => __( 'Add Icon', 'travel-agency-companion' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-companion' ),
                    ),
                    'description'	=> array(
                        'type'  	=> 'textarea',
                        'label' 	=> __( 'Desciption', 'travel-agency-companion' ),
                    ),
                    'url'     => array(
                        'type'  => 'url',
                        'label' => __( 'Link', 'travel-agency-companion' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'points', 'travel-agency-companion' ),
                    'field' => 'title'
                ),                                            
    		)
    	)
    );
    
    /** Featured Section */
    $wp_customize->add_section( 'featured_section', array(
        'title'    => __( 'Featured Section', 'travel-agency-companion' ),
        'priority' => 35,
        'panel'    => 'home_page_setting',
    ) );
    
    /** Enable/Disable Feature Section */
    $wp_customize->add_setting(
        'ed_feature_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_feature_section',
		array(
			'section' => 'featured_section',
			'label'	  => __( 'Enable Feature Trip Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Section Title */
	$wp_customize->add_setting(
        'feature_title',
        array(
            'default'           => __( 'Featured Trip', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'feature_title',
        array(
            'label'   => __( 'Section Title', 'travel-agency-companion' ),
            'section' => 'featured_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'feature_title', array(
        'selector'        => '.featured-trip .section-header .section-title',
        'render_callback' => 'travel_agency_companion_get_featured_title',
    ) );
    
    /** Section Description */
    $wp_customize->add_setting(
        'feature_desc',
        array(
            'default' => __( 'This is the best place to show your other travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Featured Section.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'feature_desc',
        array(
            'label'   => __( 'Section Description', 'travel-agency-companion' ),
            'section' => 'featured_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'feature_desc', array(
        'selector'        => '.featured-trip .section-header .section-content',
        'render_callback' => 'travel_agency_companion_get_featured_content',
    ) ); 
        
    if( $obj->travel_agency_is_wpte_activated() ){
        
        /** Enable/Disable Popular Section */
        $wp_customize->add_setting(
            'ed_featured_demo',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		'ed_featured_demo',
    		array(
    			'section'     => 'featured_section',
    			'label'	      => __( 'Enable Featured Demo Content', 'travel-agency-companion' ),
                'description' => __( 'If there is no Featured Trip Category selected, demo content will be displayed. Uncheck to hide demo content of this section.', 'travel-agency-companion' ),
                'type'        => 'checkbox'
    		)		
    	);
        
        /** Trip Type */
        $wp_customize->add_setting(
            'trip_type',
            array(
                'default'           => 'select_cat',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'trip_type',
            array(
                'label'       => __( 'Choose Trips From', 'travel-agency-companion' ),
                'section'     => 'featured_section',
                'type'        => 'select',
                'choices'     => array(
                    'select_cat'   => __( 'Featured Trip Category', 'travel-agency-companion' ),  
                    'select_trips' => __( 'Select Trips', 'travel-agency-companion' ),  
                ),
            )
        );

        /** Featured Category */
        $wp_customize->add_setting(
            'featured_cat',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'featured_cat',
            array(
                'label'       => __( 'Choose Featured Trip Category', 'travel-agency-companion' ),
                'description' => __( 'Go to Trips > Activities and add. Then you will be able to select a trip activities from the dropdown.', 'travel-agency-companion' ),
                'section'     => 'featured_section',
                'type'        => 'select',
                'choices'     => $obj->travel_agency_get_categories( true, 'activities', true ),
                'active_callback' => 'travel_agency_companion_trip_ac',
            )
        );

               
        /** No. of Trips */
        $wp_customize->add_setting(
            'no_of_trips',
            array(
                'default'           => '6',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'no_of_trips',
            array(
                'label' => __( 'No. of Trips', 'travel-agency-companion' ),
                'section' => 'featured_section',
                'type' => 'select',
                'choices' => array(
                    '3' => __( '3', 'travel-agency-companion' ),
                    '6' => __( '6', 'travel-agency-companion' ),
                )
            )
        );

        $number_of_trips = get_theme_mod( 'no_of_trips', 6 );
        for( $i=1; $i<=$number_of_trips; $i++ ){
            /** Featured Category */
            $wp_customize->add_setting(
                'choose_trip_'. $i,
                array(
                    'default'           => '',
                    'sanitize_callback' => 'travel_agency_companion_sanitize_select',
                )
            );
            
            $wp_customize->add_control(
                'choose_trip_'. $i,
                array(
                    'label'       => sprintf( __( 'Latest Trip #%1$s', 'travel-agency-companion' ), $i ),
                    'section'     => 'featured_section',
                    'type'        => 'select',
                    'choices'     => $obj->travel_agency_get_posts( 'trip' ),
                    'active_callback' => 'travel_agency_companion_trip_ac',
                )
            );
        }
        
        /** Read More Label */
        $wp_customize->add_setting(
            'featured_readmore',
            array(
                'default'           => __( 'View Detail', 'travel-agency-companion' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'featured_readmore',
            array(
                'label'   => __( 'Read More label', 'travel-agency-companion' ),
                'section' => 'featured_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'featured_readmore', array(
            'selector'        => '.featured-trip .col .text-holder .btn-holder .btn-more',
            'render_callback' => 'travel_agency_companion_get_featured_label',
        ) );
        
        /** View All Label */
        $wp_customize->add_setting(
            'featured_view_all',
            array(
                'default'           => __( 'View All Trip', 'travel-agency-companion' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'featured_view_all',
            array(
                'label'   => __( 'View All label', 'travel-agency-companion' ),
                'section' => 'featured_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'featured_view_all', array(
            'selector'        => '.featured-trip .featured-btn-holder .featured-btn-more',
            'render_callback' => 'travel_agency_companion_get_featured_view_all_label',
        ) );

        /** View All Label */
        $wp_customize->add_setting(
            'featured_view_all_link',
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        
        $wp_customize->add_control(
            'featured_view_all_link',
            array(
                'label'   => __( 'View All Url', 'travel-agency-companion' ),
                'description'   => __( 'Please insert custom url link to show all trips.', 'travel-agency-companion' ),
                'section' => 'featured_section',
                'type'    => 'url',
                'active_callback' => 'travel_agency_companion_trip_ac',
            )
        );
        
    }else{
        if( class_exists( 'Travel_Agency_Companion_Plugin_Recommend_Control' ) ){
    		$wp_customize->add_setting(
    			'featured_note', array(
    				'sanitize_callback' => 'sanitize_text_field',
    			)
    		);
    
    		$wp_customize->add_control(
    			new Travel_Agency_Companion_Plugin_Recommend_Control(
    				$wp_customize, 'featured_note', array(
    					'label'       => __( 'Instructions', 'travel-agency-companion' ),
    					'section'     => 'featured_section',
    					'capability'  => 'install_plugins',
                        'plugin_slug' => 'wp-travel-engine',
                        'description' => __( 'Please install the recommended plugin "WP Travel Engine" for setting of this section.', 'travel-agency-companion' )
    				)
    			)
    		);
    	}
    }

    /** Stat Counter Background*/
    $wp_customize->add_section( 'stat_section', array(
        'title'    => __( 'Stats Counter Settings', 'travel-agency-companion' ),
        'priority' => 40,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Enable/Disable Stat Counter Section */
    $wp_customize->add_setting(
        'ed_stat_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_stat_section',
		array(
			'section' => 'stat_section',
			'label'	  => __( 'Enable Stat Counter Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Title */
    $wp_customize->add_setting(
        'stat_counter_title',
        array(
            'default'           => __( 'Stats Counter', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'stat_counter_title',
        array(
            'label'   => __( 'Title', 'travel-agency-companion' ),
            'section' => 'stat_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'stat_counter_title', array(
        'selector'        => '#stat_section .section-header .section-title',
        'render_callback' => 'travel_agency_companion_get_stat_title',
    ) );
    
    /** Description */
    $wp_customize->add_setting(
        'stat_counter_desc',
        array(
            'default'           => __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > Home Page Settings > Stats Counter Settings.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'stat_counter_desc',
        array(
            'label'   => __( 'Description', 'travel-agency-companion' ),
            'section' => 'stat_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'stat_counter_desc', array(
        'selector'        => '#stat_section .section-header .section-content',
        'render_callback' => 'travel_agency_companion_get_stat_content',
    ) );
    
    /** Background Image */
    $wp_customize->add_setting(
        'stat_bg_image',
        array(
            'default'           => TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img20.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'stat_bg_image',
           array(
               'label'   => __( 'Background Image', 'travel-agency-companion' ),
               'section' => 'stat_section'
           )
       )
    );
    
    /** Counters */
    $wp_customize->add_setting( 
        new Rara_Repeater_Setting( 
            $wp_customize, 
            'counter', 
            array(
                'default' => $defaults->default_stat_counter()                  
            ) 
        ) 
    );
    
    $wp_customize->add_control(
    	new Rara_Control_Repeater(
    		$wp_customize,
    		'counter',
    		array(
    			'section' => 'stat_section',				
    			'label'	  => __( 'Add Counter', 'travel-agency-companion' ),
                'fields'  => array(
                    'icon' => array(
                        'type'  => 'font', 
                        'label' => __( 'Add Icon', 'travel-agency-companion' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-companion' ),
                    ),
                    'number'   	=> array(
                        'type'  => 'text',
                        'label' => __( 'Number', 'travel-agency-companion' ),
                    ),
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'counter', 'travel-agency-companion' ),
                    'field' => 'title'
                ),                                             
    		)
    	)
    );    
    
    /** Deals Section */
    $wp_customize->add_section( 'deal_section', array(
        'title'    => __( 'Deals Section', 'travel-agency-companion' ),
        'priority' => 45,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Enable/Disable Feature Section */
    $wp_customize->add_setting(
        'ed_deal_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_deal_section',
		array(
			'section' => 'deal_section',
			'label'	  => __( 'Enable Deals & Discount Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Section Title */
	$wp_customize->add_setting(
        'deal_title',
        array(
            'default'           => __( 'Deals and Discounts', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'deal_title',
        array(
            'label'   => __( 'Section Title', 'travel-agency-companion' ),
            'section' => 'deal_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'deal_title', array(
        'selector'        => '.our-deals .section-header .section-title',
        'render_callback' => 'travel_agency_companion_get_deal_title',
    ) );
    
    /** Section Description */
    $wp_customize->add_setting(
        'deal_desc',
        array(
            'default' => __( 'how the special deals and discounts to your customers here. You can customize this section from Appearance > Customize > Home Page Settings > Deals Section.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'deal_desc',
        array(
            'label'   => __( 'Section Description', 'travel-agency-companion' ),
            'section' => 'deal_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'deal_desc', array(
        'selector'        => '.our-deals .section-header .section-content',
        'render_callback' => 'travel_agency_companion_get_deal_content',
    ) ); 
    
    if( $obj->travel_agency_is_wpte_activated() ){
        
        /** Enable/Disable Popular Section */
        $wp_customize->add_setting(
            'ed_deal_demo',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		'ed_deal_demo',
    		array(
    			'section'     => 'deal_section',
    			'label'	      => __( 'Enable Deal Demo Content', 'travel-agency-companion' ),
                'description' => __( 'If there are no Deal Post selected, demo content will be displayed. Uncheck to hide demo content of this section.', 'travel-agency-companion' ),
                'type'        => 'checkbox'
    		)		
    	);
        
        /** Deal Trip Note */
    	$wp_customize->add_setting( 'deal_tripnote',
            array(
                'default' => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control( new Travel_Agency_Info_Text( $wp_customize,
            'deal_tripnote', 
                array(
                    'section'     => 'deal_section',
                    'description' => __( 'Go to Trips > Add New trips. Then you will be able to select a trip from the dropdown below.', 'travel-agency-companion' ),
                )
            )
        );
        
        /** Deal Post One */
        $wp_customize->add_setting(
            'deal_post_one',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'deal_post_one',
            array(
                'label'   => __( 'Deal Post One', 'travel-agency-companion' ),
                'section' => 'deal_section',
                'type'    => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** Deal Post Two */
        $wp_customize->add_setting(
            'deal_post_two',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'deal_post_two',
            array(
                'label'   => __( 'Deal Post Two', 'travel-agency-companion' ),
                'section' => 'deal_section',
                'type'    => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** Deal Post Three */
        $wp_customize->add_setting(
            'deal_post_three',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_agency_companion_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'deal_post_three',
            array(
                'label'   => __( 'Deal Post Three', 'travel-agency-companion' ),
                'section' => 'deal_section',
                'type'    => 'select',
                'choices' => $obj->travel_agency_get_posts( 'trip' )
            )
        );
        
        /** Read More Label */
        $wp_customize->add_setting(
            'deal_readmore',
            array(
                'default'           => __( 'Book Now', 'travel-agency-companion' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'deal_readmore',
            array(
                'label'   => __( 'Read More label', 'travel-agency-companion' ),
                'section' => 'deal_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'deal_readmore', array(
            'selector'        => '.our-deals .grid .text-holder .btn-holder .btn-more',
            'render_callback' => 'travel_agency_companion_get_dealbtn_label',
        ) );
        
        /** View All Label */
    	$wp_customize->add_setting(
            'deal_view_all_label',
            array(
                'default'           => __( 'View All Deals', 'travel-agency-companion' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'deal_view_all_label',
            array(
                'label'   => __( 'View All Label', 'travel-agency-companion' ),
                'section' => 'deal_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'deal_view_all_label', array(
            'selector'        => '.our-deals .deal-btn-holder .deal-btn-more',
            'render_callback' => 'travel_agency_companion_get_deal_view_all_label',
        ) );
        
        /** View All URL */
    	$wp_customize->add_setting(
            'deal_view_all_url',
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        
        $wp_customize->add_control(
            'deal_view_all_url',
            array(
                'label'   => __( 'View All URL', 'travel-agency-companion' ),
                'section' => 'deal_section',
                'type'    => 'text',
            )
        );
    
    }else{
        if( class_exists( 'Travel_Agency_Companion_Plugin_Recommend_Control' ) ){
    		$wp_customize->add_setting(
    			'deal_note', array(
    				'sanitize_callback' => 'sanitize_text_field',
    			)
    		);
    
    		$wp_customize->add_control(
    			new Travel_Agency_Companion_Plugin_Recommend_Control(
    				$wp_customize, 'deal_note', array(
    					'label'       => __( 'Instructions', 'travel-agency-companion' ),
    					'section'     => 'deal_section',
    					'capability'  => 'install_plugins',
                        'plugin_slug' => 'wp-travel-engine',
                        'description' => __( 'Please install the recomended plugin "WP Travel Engine" for setting of this section.', 'travel-agency-companion' )
    				)
    			)
    		);
    	}
	}

	/** Call to Action **/
	$wp_customize->add_section( 'cta_section', array(
        'title'    => __( 'Call to Action Section', 'travel-agency-companion' ),
        'priority' => 50,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Enable/Disable Stat Counter Section */
    $wp_customize->add_setting(
        'ed_cta_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_companion_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		'ed_cta_section',
		array(
			'section' => 'cta_section',
			'label'	  => __( 'Enable Call To Action Section', 'travel-agency-companion' ),
            'type'    => 'checkbox'
		)		
	);
    
    /** Section Title */
	$wp_customize->add_setting(
        'cta_title',
        array(
            'default'           => __( 'Get Ready', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_title',
        array(
            'label'   => __( 'Call to Action Title', 'travel-agency-companion' ),
            'section' => 'cta_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cta_title', array(
        'selector'        => '.cta .text .title',
        'render_callback' => 'travel_agency_companion_get_cta_title',
    ) );
    
    /** Section Description */
	$wp_customize->add_setting(
        'cta_desc',
        array(
            'default'           => __( 'Keep a Call To Action button and promote your services. You can modify this section from Appearance > Customize > Home Page Settings > Call to Action Section.', 'travel-agency-companion' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'cta_desc',
        array(
            'label'   => __( 'Call to Action Description', 'travel-agency-companion' ),
            'section' => 'cta_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cta_desc', array(
        'selector'        => '.cta .text .content',
        'render_callback' => 'travel_agency_companion_get_cta_content',
    ) );

    /** Read More Label */
	$wp_customize->add_setting(
        'cta_readmore',
        array(
            'default'           => __( 'Browse Package', 'travel-agency-companion' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_readmore',
        array(
            'label'   => __( 'Read More label', 'travel-agency-companion' ),
            'section' => 'cta_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cta_readmore', array(
        'selector'        => '.cta .text .btn-more',
        'render_callback' => 'travel_agency_companion_get_ctabtn_label',
    ) );
    
    /** Read More Link */
    $wp_customize->add_setting(
        'cta_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cta_link',
        array(
            'label'   => __( 'Read More link', 'travel-agency-companion' ),
            'section' => 'cta_section',
            'type'    => 'text',
        )
    );

    /** CTA Background */
    $wp_customize->add_setting(
    'cta_bg_image',
        array(
            'default'           => TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img25.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
       	new WP_Customize_Image_Control(
           $wp_customize,
           'cta_bg_image',
           	array(
               'label'   => __( 'Background Image', 'travel-agency-companion' ),
               'section' => 'cta_section'
           	)
       	)
    );
}

/**
 * Sanitization Functions
*/
function travel_agency_companion_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function travel_agency_companion_sanitize_select( $input, $setting ){
    // Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function travel_agency_companion_trip_ac( $control ){
    
    $trip_type       = $control->manager->get_setting( 'trip_type' )->value();
    $control_id      = $control->id;

    if ( $control_id == 'featured_cat' && $trip_type == 'select_cat' ) return true;
    if ( $control_id == 'choose_trip_1' && $trip_type == 'select_trips' ) return true;
    if ( $control_id == 'choose_trip_2' && $trip_type == 'select_trips' ) return true;
    if ( $control_id == 'choose_trip_3' && $trip_type == 'select_trips' ) return true;
    if ( $control_id == 'choose_trip_4' && $trip_type == 'select_trips' ) return true;
    if ( $control_id == 'choose_trip_5' && $trip_type == 'select_trips' ) return true;
    if ( $control_id == 'choose_trip_6' && $trip_type == 'select_trips' ) return true;
    if ( $control_id == 'featured_view_all_link' && $trip_type == 'select_trips' ) return true;

    return false;
}