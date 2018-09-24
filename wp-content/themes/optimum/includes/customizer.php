<?php
/**
 * optimum Theme Customizer
 *
 * @package optimum
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function optimum_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site background Color', 'optimum' );

	/*  Header Settings
	============================================================================================*/
	$wp_customize->add_section(
		'optimum_header_section',
			array(
			'title' => __( 'Header Settings', 'optimum' ),
			'description' => __('This section updates site logo', 'optimum'),
			'priority' => 1,
	));

	$wp_customize->add_setting( 'optimum_theme_options[om_phone_number]' , array(
    'default'     =>  __( '', 'optimum' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	) );
	$wp_customize->add_control( 'optimum_theme_options[om_phone_number]', array(
	    'label' =>  __( 'Phone Number', 'optimum' ),
			'section'	=> 'optimum_header_section',
			'type'	 => 'text',
			'description' => __( 'Provide the phone number.', 'optimum' ),
		) );

	$wp_customize->add_setting( 'optimum_theme_options[om_email_id]' , array(
    'default'     =>  __( '', 'optimum' ),
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'optimum_theme_options[om_email_id]', array(
	    'label' =>  __( 'Email ID', 'optimum' ),
			'section'	=> 'optimum_header_section',
			'type'	 => 'text',
			'description' => __( 'Provide the email address.', 'optimum' ),
		) );


	/*  Colors
	* All these below fields are using WP default colors sections
	============================================================================================*/
	$wp_customize->add_setting( 'optimum_theme_options[om_theme_color]', array(
		'default' => '#2ac465',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_theme_color]', array(
		'label' => __( 'Theme Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_theme_color]',
		'type'          => 'color',
	) ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_body_text_color]', array(
		'default' => '#333333',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_body_text_color]', array(
		'label' => __( 'Body Text Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_body_text_color]',
		'type'          => 'color',
	) ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_body_link_color]', array(
		'default' => '#292b2c',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_body_link_color]', array(
		'label' => __( 'Body Link Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_body_link_color]',
		'type'          => 'color',
	) ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_leftsidebar_bg_color]', array(
		'default' => '#1f1c1c',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_leftsidebar_bg_color]', array(
		'label' => __( 'Left Sidebar Background Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_leftsidebar_bg_color]',
		'type'          => 'color',
	) ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_leftsidebar_text_color]', array(
		'default' => '#FFFFFF',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_leftsidebar_text_color]', array(
		'label' => __( 'Left Sidebar Text Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_leftsidebar_text_color]',
		'type'          => 'color',
	) ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_footer_top_bg_color]', array(
		'default' => '#f6f6f6',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_footer_top_bg_color]', array(
		'label' => __( 'Footer Background Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_footer_top_bg_color]',
		'type'          => 'color',
	) ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_footer_top_text_color]', array(
		'default' => '#292b2c',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'optimum_theme_options[om_footer_top_text_color]', array(
		'label' => __( 'Footer Text Color', 'optimum' ),
		'section' => 'colors',
		'settings'      => 'optimum_theme_options[om_footer_top_text_color]',
		'type'          => 'color',
	) ) );


	/*  Social Media
	============================================================================================*/
	$wp_customize->add_section( 'optimum_social_section' , array(
		'title'      => __( 'Social Media', 'optimum' ),
	) );
	$wp_customize->add_setting( 'optimum_theme_options[om_facebook_url]', array(
        'default' => 'https://facebook.com',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_facebook_url]', array(
        'label' => __( 'Facebook Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

	$wp_customize->add_setting( 'optimum_theme_options[om_twitter_url]', array(
        'default' => 'http://twitter.com',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_twitter_url]', array(
        'label' => __( 'Twitter Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_linkedin_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_linkedin_url]', array(
        'label' => __( 'LinkedIn Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_google_plus_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'optimum_theme_options[om_google_plus_url]', array(
        'label' => __( 'Google Plus Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_instagram_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_instagram_url]', array(
        'label' => __( 'Instagram Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_youtube_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_youtube_url]', array(
        'label' => __( 'YouTube Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_skype_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_skype_url]', array(
        'label' => __( 'Skype Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_dribbble_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_dribbble_url]', array(
        'label' => __( 'Dribbble Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_digg_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_digg_url]', array(
        'label' => __( 'Digg Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_github_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_github_url]', array(
        'label' => __( 'Github Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_delicious_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_delicious_url]', array(
        'label' => __( 'Delicious Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_reddit_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_reddit_url]', array(
        'label' => __( 'Reddit Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_pinterest_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_pinterest_url]', array(
        'label' => __( 'Pinterest Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

		$wp_customize->add_setting( 'optimum_theme_options[om_rss_url]', array(
        'default' => '',
				'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'optimum_theme_options[om_rss_url]', array(
        'label' => __( 'RSS Url', 'optimum' ),
        'section' => 'optimum_social_section',
        'type' => 'url',
    ) );

	/*  Other Settings
	============================================================================================*/

	$wp_customize->add_section( 'optimum_other_settings' , array(
		'title'      => __( 'Other Settings', 'optimum' ),
	) );

	$wp_customize->add_setting( 'optimum_theme_options[om_enable_megafoter]' , array(
			'default'     => true,
			'transport'   => 'refresh',
			'sanitize_callback' => 'optimum_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'optimum_theme_options[om_enable_megafoter]', array(
		'label' => __( 'Do you want to enable the Mega Footer?', 'optimum' ),
		'section' => 'optimum_other_settings',
		'settings' => 'om_enable_megafoter',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'optimum_theme_options[om_enable_scroll_to_top]' , array(
			'default'     => true,
			'transport'   => 'refresh',
			'sanitize_callback' => 'optimum_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'optimum_theme_options[om_enable_scroll_to_top]', array(
		'label' => __( 'Do you want to enable scroll to top feature?', 'optimum' ),
		'section' => 'optimum_other_settings',
		'settings' => 'om_enable_scroll_to_top',
		'type' => 'checkbox',
	) );


	/*  Home Page Slider
	============================================================================================*/

	$wp_customize->add_section( 'optimum_home_page_slider' , array(
		'title'      => __( 'Home Page Slider', 'optimum' ),
		'priority'   => 12,
	) );

	$wp_customize->add_setting( 'optimum_theme_options[om_enable_home_page_slider]' , array(
			'default'     => true,
			'transport'   => 'refresh',
			'sanitize_callback' => 'optimum_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'optimum_theme_options[om_enable_home_page_slider]', array(
		'label' => __( 'Do you want to display slider on homepage ?', 'optimum' ),
		'section' => 'optimum_home_page_slider',
		'settings' => 'optimum_theme_options[om_enable_home_page_slider]',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'optimum_theme_options[om_enable_slider_overlay_bg]' , array(
			'default'     => true,
			'transport'   => 'refresh',
			'sanitize_callback' => 'optimum_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'optimum_theme_options[om_enable_slider_overlay_bg]', array(
		'label' => __( 'Do you want to enable slider overlay dotted bg ?', 'optimum' ),
		'section' => 'optimum_home_page_slider',
		'settings' => 'optimum_theme_options[om_enable_slider_overlay_bg]',
		'type' => 'checkbox',
	) );

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_image_1]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'optimum_sanitize_file',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
	$wp_customize,
	'optimum_theme_options[om_slider_image_1]', array(
			'label'    => __( 'Slider Image 1', 'optimum' ),
			'section' => 'optimum_home_page_slider',
			'settings' => 'optimum_theme_options[om_slider_image_1]',
			'description' => __( 'Upload image for first slider in sequence.', 'optimum' ),
	)));

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_description_1]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
      'optimum_theme_options[om_slider_description_1]',
      array(
          'label' => esc_html__( 'Slider description 1', 'optimum' ),
          'section' => 'optimum_home_page_slider',
          'type' => 'text'
      )
  );

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_image_2]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'optimum_sanitize_file',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
	$wp_customize,
	'optimum_theme_options[om_slider_image_2]', array(
			'label'    => __( 'Slider Image 2', 'optimum' ),
			'section' => 'optimum_home_page_slider',
			'settings' => 'optimum_theme_options[om_slider_image_2]',
			'description' => __( 'Upload image for second slider in sequence.', 'optimum' ),
	)));

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_description_2]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
      'optimum_theme_options[om_slider_description_2]',
      array(
          'label' => esc_html__( 'Slider description 2', 'optimum' ),
          'section' => 'optimum_home_page_slider',
          'type' => 'text'
      )
  );


	$wp_customize->add_setting( 'optimum_theme_options[om_slider_image_3]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'optimum_sanitize_file',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
	$wp_customize,
	'optimum_theme_options[om_slider_image_3]', array(
			'label'    => __( 'Slider Image 3', 'optimum' ),
			'section' => 'optimum_home_page_slider',
			'settings' => 'optimum_theme_options[om_slider_image_3]',
			'description' => __( 'Upload image for third slider in sequence.', 'optimum' ),
	)));

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_description_3]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
      'optimum_theme_options[om_slider_description_3]',
      array(
          'label' => esc_html__( 'Slider description 3', 'optimum' ),
          'section' => 'optimum_home_page_slider',
          'type' => 'text'
      )
  );

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_image_4]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'optimum_sanitize_file',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
	$wp_customize,
	'optimum_theme_options[om_slider_image_4]', array(
			'label'    => __( 'Slider Image 4', 'optimum' ),
			'section' => 'optimum_home_page_slider',
			'settings' => 'optimum_theme_options[om_slider_image_4]',
			'description' => __( 'Upload image for fourth slider in sequence.', 'optimum' ),
	)));

	$wp_customize->add_setting( 'optimum_theme_options[om_slider_description_4]', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
      'optimum_theme_options[om_slider_description_4]',
      array(
          'label' => esc_html__( 'Slider description 4', 'optimum' ),
          'section' => 'optimum_home_page_slider',
          'type' => 'text'
      )
  );

}

add_action( 'customize_register', 'optimum_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function optimum_customize_preview_js() {
	wp_enqueue_script( 'optimum_customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'optimum_customize_preview_js' );


/**
 * Sanitize file input
 */
function optimum_sanitize_file( $file, $setting ) {
		$mimes = array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif'          => 'image/gif',
				'png'          => 'image/png'
		);

		//check file type from file name
		$file_ext = wp_check_filetype( $file, $mimes );

		//if file has a valid mime type return it, otherwise return default
		return ( $file_ext['ext'] ? $file : $setting->default );
}


/**
 * Sanitize checkboxes
 */
 function optimum_sanitize_checkbox( $input ) {
     if ( $input == 1 ) {
         return 1;
     } else {
         return '';
     }
 }


 function optimum_get_darkness($hex) {
	  // strip off any leading #
	  $hex = str_replace('#', '', $hex);

	  $c_r = hexdec(substr($hex, 0, 2));
	  $c_g = hexdec(substr($hex, 2, 2));
	  $c_b = hexdec(substr($hex, 4, 2));
		$c_r = ($c_r - 12);
		$c_g = ($c_g - 12);
		$c_b = ($c_b - 12);

		return  $c_r .', '. $c_g .', '. $c_b ;
 }

/**
 * Convert hex to rgb
 *
 */
 function optimum_color_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
       $r = hexdec(substr($hex,0,1).substr($hex,0,1));
       $g = hexdec(substr($hex,1,1).substr($hex,1,1));
       $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
       $r = hexdec(substr($hex,0,2));
       $g = hexdec(substr($hex,2,2));
       $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    return implode(",", $rgb); // returns the rgb values separated by commas
 }

 /**
  * Generate custom style
  */
function optimum_custom_styles() {
	$om_body_text_color = esc_attr( optimum_get_options('om_body_text_color') );
	$om_body_link_color = esc_attr( optimum_get_options('om_body_link_color') );
	$om_footer_top_bg_color = esc_attr( optimum_get_options('om_footer_top_bg_color') );
	$om_footer_top_text_color = esc_attr( optimum_get_options('om_footer_top_text_color') );
	$om_leftsidebar_bg_color = esc_attr( optimum_get_options('om_leftsidebar_bg_color') );
	$om_leftsidebar_text_color = esc_attr( optimum_get_options('om_leftsidebar_text_color') );
	$om_theme_color = esc_attr( optimum_get_options('om_theme_color') );

	$custom_style = "";

	if ( $om_body_text_color != '' ) {
		$custom_style .= "
		body {
			color: {$om_body_text_color};
		}";
	}
	if ( $om_body_link_color != '' ) {
		$custom_style .= "
		body a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
			color: {$om_body_link_color};
		}";
	}

	if ( $om_leftsidebar_bg_color != '' ) {
		$om_leftsidebar_bg_color_rgb = optimum_color_hex2rgb($om_leftsidebar_bg_color);
		$custom_style .= "
		#left-sidebar,
		#left-sidebar nav.main-menu ul > li ul li a {
			background-color: {$om_leftsidebar_bg_color};
		}
		#left-sidebar nav.main-menu ul > li ul li {
			border-bottom: 1px solid {$om_leftsidebar_bg_color};
		}";
	}
	if ( $om_leftsidebar_text_color != '' ) {
		$om_leftsidebar_text_color_rgba = optimum_color_hex2rgb($om_leftsidebar_text_color);
		$custom_style .= "
		#left-sidebar,
		#left-sidebar.header-search-form,
		#left-sidebar a,
		#left-sidebar nav.main-menu ul > li ul li a {
			color: rgba({$om_leftsidebar_text_color_rgba}, 0.8);
		}";
	}

	if ( $om_theme_color != '' ) {
		$om_theme_color_rgb = optimum_color_hex2rgb($om_theme_color);
		$om_theme_color_dark =  optimum_get_darkness($om_theme_color);
		$custom_style .= "
		body .btn-primary, body input[type='submit'],
		.read-more, .read-more.outline:hover,
		.read-more.black:hover,
		.site-header #logo,
		nav.main-menu ul li ul li:hover > a,
		#home-slider .slide-content .btn,
		table thead,
		a#scroll-top {
			background-color: {$om_theme_color};
		}
		table thead th:last-child,
		table thead th {
			border-right: 1px solid rgba({$om_theme_color_dark}, 1);
		}
		table thead th:first-child {
			border-left: 1px solid rgba({$om_theme_color_dark}, 1);
		}
		::selection {
			background: {$om_theme_color};
		}
		::-moz-selection {
			background: {$om_theme_color};
		}
		.mean-container .mean-nav,
		.error-404,
		#home-slider .owl-theme .owl-dots .owl-dot span,
		.mean-container a.meanmenu-reveal,
		.mean-container .mean-bar .meanmenu-reveal,
		.mean-container .mean-nav ul li a {
			background: {$om_theme_color};
		}
		.pager li > a:hover, .pager li > a:focus,
		.comment a.btn {
	    background-color: {$om_theme_color};
	    border-color: {$om_theme_color};
		}

		body input[type='text']:focus,
		body input[type='email']:focus,
		body input[type='url']:focus,
		body input[type='tel']:focus,
		body input[type='number']:focus,
		body input[type='date']:focus,
		body input[type='range']:focus,
		body input[type='password']:focus,
		body input[type='text']:focus,
		body textarea:focus, body .form-control:focus, select:focus,
		.comment-form .alert-info {
			border-color: {$om_theme_color};
		}

		.comment a.btn:hover {
			background: rgba({$om_theme_color_dark}, 1);
			border-color: rgba({$om_theme_color_dark}, 1);
		}
		.read-more:hover, .read-more:focus, .read-more:active,
		body input[type='submit']:hover,
		#left-sidebar nav.main-menu ul > li ul li,
		.mean-container .mean-bar .mean-nav ul li a.mean-expand:hover,
		.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
			background-color: rgba({$om_theme_color_dark}, 1);
		}
		.mean-container .mean-nav ul li a:hover {
			background: rgba({$om_theme_color_dark}, 1);
		}
		.header-top {
			border-top: 4px solid {$om_theme_color};
		}

		blockquote,
		article.sticky,
		.comment-form .alert-info {
			background: rgba({$om_theme_color_rgb}, 0.20);
		}

		.read-more.outline,
		.gallery .gallery-item img,
		.wp-caption {
		    border-color:  {$om_theme_color};
		}
		.comment-form .alert-info,
		.read-more.outline,
		h1 a:hover, h2 a:hover, h3 a:hover,
		h4 a:hover, h5 a:hover, h6 a:hover,
		a:hover, a:focus,
		#colophon .widget_calendar table a:hover,
		#colophon a:hover,
		.header-top a:hover {
		    color: {$om_theme_color};
		}";
	}

	if ( $om_footer_top_bg_color != '' ) {
		$custom_style .= "
		#colophon {
			background-color: {$om_footer_top_bg_color};
		}";
	}
	if ( $om_footer_top_text_color != '' ) {
		$om_footer_top_text_color_rgb = optimum_color_hex2rgb($om_footer_top_text_color);
		$custom_style .= "
		#colophon,
		#colophon a {
			color: {$om_footer_top_text_color};
		}
		#colophon a:hover {
		    color: rgba({$om_footer_top_text_color_rgb}, 0.9);
		}";
	}


	if ( $custom_style != '' ) {
		wp_add_inline_style( 'optimum-style', $custom_style );
	}

}
add_action( 'wp_enqueue_scripts', 'optimum_custom_styles' );
