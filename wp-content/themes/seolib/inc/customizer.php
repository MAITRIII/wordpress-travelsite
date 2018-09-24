<?php
/**
 * seolib Theme Customizer
 *
 * Please browse readme.txt for credits and forking information
 *
 * @package seolib
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seolib_customize_register( $wp_customize ) {

	//get the current color value for accent color
	$color_scheme = seolib_get_color_scheme();
	//get the default color for current color scheme
	$current_color_scheme = seolib_current_color_scheme_default_color();
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_section('header_image')->title = __( 'Front Page Header', 'seolib' );
	$wp_customize->get_section('colors')->title = __( 'Background Color', 'seolib' );



// Upsell section
	$wp_customize->add_section(
		'seolib_help_and_support_today',
		array(
			'title' => __('SEOlib Premium Version', 'seolib'),
			'priority' => 0,
			'description' => __(' ', 'seolib') . '<a href="https://outstandingthemes.com/themes/seolib/" target="_blank"><img src="' . get_template_directory_uri() . '/images/theme-image-1.png"></a>',
			)
		);  

	$wp_customize->add_setting('seolib_help_and_support_today_tabs_sec', array(
		'sanitize_callback' => 'unneeded',
		'type' => 'info_control',
		'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'help_and_support_today_tab', array(
		'section' => 'seolib_help_and_support_today',
		'settings' => 'seolib_help_and_support_today_tabs_sec',
		'type' => 'none',
		'priority' => 0
		) )
	);  


	//Header Background Color setting

	$wp_customize->add_setting( 'header_bg_color', array(
		'default'           => '#1b1b1b',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
		'label'       => __( 'Header Background Color', 'seolib' ),
		'description' => __( 'Applied to header background.', 'seolib' ),
		'section'     => 'header_image',
		'settings'    => 'header_bg_color',
		) ) );

	$wp_customize->add_setting( 'header_colors', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_colors', array(
		'label'       => __( 'Header Title Color', 'seolib' ),
		'description' => __( 'Choose a color for title.', 'seolib' ),
		'section'     => 'header_image',
		'priority'   => 2,
		'settings'    => 'header_colors',
		) ) );

	$wp_customize->add_section( 'site_identity' , array(
		'priority'   => 3,
		));

	$wp_customize->add_section( 'header_image' , array(
		'title'      => __('Front Page Header', 'seolib'),
		'priority'   => 4,
		));

	$wp_customize->add_setting( 'facebook_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'facebook_link', array(
		'label'    => __( "Facebook Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );
	$wp_customize->add_setting( 'twitter_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'twitter_link', array(
		'label'    => __( "Twitter Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );

	$wp_customize->add_setting( 'instagram_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'instagram_link', array(
		'label'    => __( "Instagram Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );
	$wp_customize->add_setting( 'youtube_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'youtube_link', array(
		'label'    => __( "Youtube Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );
	$wp_customize->add_setting( 'linkedin_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'linkedin_link', array(
		'label'    => __( "LinkedIn Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );
	$wp_customize->add_setting( 'twitch_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'twitch_link', array(
		'label'    => __( "Twitch Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );

	$wp_customize->add_setting( 'pinterest_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'pinterest_link', array(
		'label'    => __( "Pinterest Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );

	$wp_customize->add_setting( 'soundcloud_link', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'capability'        => 'edit_theme_options',
		) );

	$wp_customize->add_control( 'soundcloud_link', array(
		'label'    => __( "SoundCloud Link (URL)", 'seolib' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 2,
		) );

	$wp_customize->add_setting( 'social_media_link_color', array(
		'default'           => '#fab526',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_link_color', array(
		'label'       => __( 'Social Media Icons Color', 'seolib' ),
		'description' => __( 'Choose a color for the social media icons.', 'seolib' ),
		'section'     => 'header_image',
		'priority'   => 2,
		'settings'    => 'social_media_link_color',
		) ) );

	$wp_customize->add_setting( 'hide_header', array(
		'default' => 0,
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'hide_header', array(
		'label'    => __( 'Hide Header Text', 'seolib' ),
		'section'  => 'header_image',
		'priority' => 1,
		'settings' => 'hide_header',
		'type'     => 'checkbox',
		) );

// Footer Section
	$wp_customize->add_section(
		'footer_options',
		array(
			'title'     => __('Footer','seolib'),
			'priority'  => 99
			)
		);


	$wp_customize->add_setting( 'footer_colors', array(
		'default'           => '#212324',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_colors', array(
		'label'       => __( 'Footer Widget Background', 'seolib' ),
		'description' => __( 'Choose a background color for the footer widget section.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_colors',
		) ) );

	$wp_customize->add_setting( 'footer_widget_title_colors', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'display_header_text', array(
		'label'       => __( 'Hide Header Completely', 'seolib' ),
		'description' => __( 'Change Header Color.', 'seolib' ),
		'section' => 'header_customization',
		'settings'    => 'display_header_text',
		) ) );

	$wp_customize->add_setting( 'display_header_text', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_title_colors', array(
		'label'       => __( 'Footer Widget Headline Color', 'seolib' ),
		'description' => __( 'Choose a color for the footer widget headlines.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_widget_title_colors',
		) ) );


	$wp_customize->add_setting( 'footer_widget_text_colors', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_text_colors', array(
		'label'       => __( 'Footer Widget Text Color', 'seolib' ),
		'description' => __( 'Choose a color for the footer widget text.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_widget_text_colors',
		) ) );

	$wp_customize->add_setting( 'footer_widget_link_colors', array(
		'default'           => '#7f7f7f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_link_colors', array(
		'label'       => __( 'Footer Widget Link Color', 'seolib' ),
		'description' => __( 'Choose a color for the footer widget links.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_widget_link_colors',
		) ) );

	$wp_customize->add_setting( 'footer_copyright_background_color', array(
		'default'           => '#212324',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_setting( 'footer_copyright_text_color', array(
		'default'           => '#7f7f7f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_text_color', array(
		'label'       => __( 'Footer Copyright Text Color', 'seolib' ),
		'description' => __( 'Choose a color for the footer copyright section text.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_copyright_text_color',
		) ) );

	$wp_customize->add_setting( 'footer_copyright_border_color', array(
		'default'           => '#3f4042',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_border_color', array(
		'label'       => __( 'Footer Copyright Border Color', 'seolib' ),
		'description' => __( 'Choose a color for the border above the copyright section.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_copyright_border_color',
		) ) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copyright_background_color', array(
		'label'       => __( 'Footer Copyright Background Color', 'seolib' ),
		'description' => __( 'Choose a color for the footer copyright section background.', 'seolib' ),
		'section'     => 'footer_options',
		'settings'    => 'footer_copyright_background_color',
		) ) );

	$wp_customize->add_setting( 'footer_widget_text_color', array(
		'default'           => '#dedede',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
		'label'       => __( 'Header Color', 'seolib' ),
		'description' => __( 'Change Header Color.', 'seolib' ),
		'section' => 'header_colors',
		'settings'    => 'header_textcolor',
		) ) );

	$wp_customize->add_setting( 'header_textcolor', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );


// Blog Feed
	$wp_customize->add_section(
		'blog_feed',
		array(
			'title'     => __('Blog Feed','seolib'),
			'description' => __( 'Please go to a page where you can see all blog posts, to view the changes.', 'seolib' ),
			'priority'  => 5
			)
		);

	$wp_customize->add_setting( 'post_feed_post_background', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_background', array(
		'label'       => __( 'Posts Background Color', 'seolib' ),
		'description' => __( 'Choose a background color for the posts.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_background',
		) ) );

	$wp_customize->add_setting( 'post_feed_post_text', array(
		'default'           => '#949494',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_text', array(
		'label'       => __( 'Posts Text Color', 'seolib' ),
		'description' => __( 'Choose a text color for the posts.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_text',
		) ) );
	$wp_customize->add_setting( 'post_feed_post_headline', array(
		'default'           => '#4a4849',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_headline', array(
		'label'       => __( 'Posts Headline Color', 'seolib' ),
		'description' => __( 'Choose a headline color for the posts.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_headline',
		) ) );

	$wp_customize->add_setting( 'post_feed_post_date_withimage', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_date_withimage', array(
		'label'       => __( 'Posts Date Color (Featured Image)', 'seolib' ),
		'description' => __( 'Choose a date color for the posts with a featured image.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_date_withimage',
		) ) );
	$wp_customize->add_setting( 'post_feed_post_date_noimage', array(
		'default'           => '#afafaf',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_date_noimage', array(
		'label'       => __( 'Posts Date Color (No Featured Image)', 'seolib' ),
		'description' => __( 'Choose a date color for the posts without a featured image.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_date_noimage',
		) ) );

	$wp_customize->add_setting( 'post_feed_post_button_text', array(
		'default'           => '#fab526',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_button_text', array(
		'label'       => __( 'Next/Prev Page Buttons Text Color', 'seolib' ),
		'description' => __( 'Choose a text color for the next/previous page buttons.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_button_text',
		) ) );


	$wp_customize->add_setting( 'post_feed_post_button', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_feed_post_button', array(
		'label'       => __( 'Next/Prev Page Buttons Background Color', 'seolib' ),
		'description' => __( 'Choose a background color for the next/previous page buttons.', 'seolib' ),
		'section'     => 'blog_feed',
		'settings'    => 'post_feed_post_button',
		) ) );

// Post and page Section
	$wp_customize->add_section(
		'post_page_options',
		array(
			'title'     => __('Post & Page','seolib'),
			'description' => __( 'Please go to a blog post or a page to view the changes.', 'seolib' ),
			'priority'  => 6
			)
		);

	$wp_customize->add_setting( 'author_line_color', array(
		'default'           => '#8c8c8c',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'author_line_color', array(
		'label'       => __( 'Author Byline Color', 'seolib' ),
		'description' => __( 'Choose a color for the author byline in the top of posts and pages.', 'seolib' ),
		'section'     => 'post_page_options',
		'settings'    => 'author_line_color',
		) ) );

	$wp_customize->add_setting( 'headline_color', array(
		'default'           => '#2f2f2f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headline_color', array(
		'label'       => __( 'Post & Page Headline Color', 'seolib' ),
		'description' => __( 'Choose a color for the post & page headline.', 'seolib' ),
		'section'     => 'post_page_options',
		'settings'    => 'headline_color',
		) ) );
	$wp_customize->add_setting( 'post_content_color', array(
		'default'           => '#424242',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_content_color', array(
		'label'       => __( 'Post & Page Paragraph Color', 'seolib' ),
		'description' => __( 'Choose a color for the post & page paragraphs.', 'seolib' ),
		'section'     => 'post_page_options',
		'settings'    => 'post_content_color',
		) ) );

	$wp_customize->add_setting( 'post_link_color', array(
		'default'           => '#fab526',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_link_color', array(
		'label'       => __( 'Post & Page Link Color', 'seolib' ),
		'description' => __( 'Choose a color for the post & page text links.', 'seolib' ),
		'section'     => 'post_page_options',
		'settings'    => 'post_link_color',
		) ) );

	$wp_customize->add_setting( 'post_background_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_background_color', array(
		'label'       => __( 'Post & Page Background Color', 'seolib' ),
		'description' => __( 'Choose a color for the post & page background.', 'seolib' ),
		'section'     => 'post_page_options',
		'settings'    => 'post_background_color',
		) ) );


	//Navigation section end
	$wp_customize->add_section(
		'accent_color_option',
		array(
			'title'     => __('Theme Color','seolib'),
			'priority'  => 2
			)
		);

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'seolib_sanitize_color_scheme',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Predefined Colors', 'seolib' ),
		'section'  => 'accent_color_option',
		'type'     => 'select',
		'choices'  => seolib_get_color_scheme_choices(),
		'priority' => 3,
		) );

	// Add custom accent color.
	$wp_customize->add_setting( 'accent_color', array(
		'default'           => $current_color_scheme[0],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'       => __( 'Theme Color', 'seolib' ),
		'description' => __( 'Applied to highlight elements, buttons and much more.', 'seolib' ),
		'section'     => 'accent_color_option',
		'settings'    => 'accent_color',
		) ) );


}
add_action( 'customize_register', 'seolib_customize_register' );

/**
 * Register color schemes for seolib.
 *
 * @return array An associative array of color scheme options.
 */
function seolib_get_color_schemes() {
	return apply_filters( 'seolib_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'seolib' ),
			'colors' => array(
				'#fab526',			
				),
			),
		'pink'    => array(
			'label'  => __( 'Pink', 'seolib' ),
			'colors' => array(
				'#FF4081',				
				),
			),
		'orange'  => array(
			'label'  => __( 'Orange', 'seolib' ),
			'colors' => array(
				'#FF5722',
				),
			),
		'green'    => array(
			'label'  => __( 'Green', 'seolib' ),
			'colors' => array(
				'#8BC34A',
				),
			),
		'red'    => array(
			'label'  => __( 'Red', 'seolib' ),
			'colors' => array(
				'#FF5252',
				),
			),
		'yellow'    => array(
			'label'  => __( 'yellow', 'seolib' ),
			'colors' => array(
				'#FFC107',
				),
			),
		'blue'   => array(
			'label'  => __( 'Blue', 'seolib' ),
			'colors' => array(
				'#03A9F4',
				),
			),
		) );
}

if(!function_exists('seolib_current_color_scheme_default_color')):
/**
 * Get the default hex color value for current color scheme
 *
 *
 * @return array An associative array of current color scheme hex values.
 */
function seolib_current_color_scheme_default_color(){
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	
	$color_schemes       = seolib_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; //seolib_current_color_scheme_default_color

if ( ! function_exists( 'seolib_get_color_scheme' ) ) :
/**
 * Get the current seolib color scheme.
 *
 *
 * @return array An associative array of currently set color hex values.
 */
function seolib_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$accent_color = get_theme_mod('accent_color','#fab526');
	$color_schemes       = seolib_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		$color_schemes[ $color_scheme_option ]['colors'] = array($accent_color);
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // seolib_get_color_scheme

if ( ! function_exists( 'seolib_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for seolib.
 *
 *
 * @return array Array of color schemes.
 */
function seolib_get_color_scheme_choices() {
	$color_schemes                = seolib_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // seolib_get_color_scheme_choices

if ( ! function_exists( 'seolib_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function seolib_sanitize_color_scheme( $value ) {
	$color_schemes = seolib_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // seolib_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 *
 * @see wp_add_inline_style()
 */
function seolib_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	
	$color_scheme = seolib_get_color_scheme();

	$color = array(
		'accent_color'            => $color_scheme[0],
		);

	$color_scheme_css = seolib_get_color_scheme_css( $color);

	wp_add_inline_style( 'seolib-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'seolib_color_scheme_css' );

/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function seolib_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'accent_color'            => '',
		) );

	$css = <<<CSS
	/* Color Scheme */

	/* Accent Color */
	a,a:visited,a:active,a:hover,a:focus,#secondary .widget #recentcomments a, #secondary .widget .rsswidget {
		color: {$colors['accent_color']};
	}

	@media (min-width:767px) {
		.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {	    
			background-color: {$colors['accent_color']} !important;
			color:#fff !important;
		}
		.dropdown-menu .current-menu-item.current_page_item a, .dropdown-menu .current-menu-item.current_page_item a:hover, .dropdown-menu .current-menu-item.current_page_item a:active, .dropdown-menu .current-menu-item.current_page_item a:focus {
			background: {$colors['accent_color']} !important;
			color:#fff !important
		}
	}
	@media (max-width:767px) {
		.dropdown-menu .current-menu-item.current_page_item a, .dropdown-menu .current-menu-item.current_page_item a:hover, .dropdown-menu .current-menu-item.current_page_item a:active, .dropdown-menu .current-menu-item.current_page_item a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li.active > a {
			border-left: 3px solid {$colors['accent_color']};
		}
	}
	.btn, .btn-default:visited, .btn-default:active:hover, .btn-default.active:hover, .btn-default:active:focus, .btn-default.active:focus, .btn-default:active.focus, .btn-default.active.focus {
		background: {$colors['accent_color']};
	}
	.cat-links a, .tags-links a {
		color: {$colors['accent_color']};
	}
	.navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover, .navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
		color: #fff;
		background-color: {$colors['accent_color']};
	}
	h5.entry-date a:hover {
		color: {$colors['accent_color']};
	}
	#respond input#submit {
	background-color: {$colors['accent_color']};
	background: {$colors['accent_color']};
}
blockquote {
	border-left: 5px solid {$colors['accent_color']};
}
.entry-title a:hover,.entry-title a:focus{
	color: {$colors['accent_color']};
}
.entry-header .entry-meta::after{
	background: {$colors['accent_color']};
}
.readmore-btn, .readmore-btn:visited, .readmore-btn:active, .readmore-btn:hover, .readmore-btn:focus {
	background: {$colors['accent_color']};
}
.post-password-form input[type="submit"],.post-password-form input[type="submit"]:hover,.post-password-form input[type="submit"]:focus,.post-password-form input[type="submit"]:active,.search-submit,.search-submit:hover,.search-submit:focus,.search-submit:active {
	background-color: {$colors['accent_color']};
	background: {$colors['accent_color']};
	border-color: {$colors['accent_color']};
}
.fa {
	color: {$colors['accent_color']};
}
.btn-default{
	border-bottom: 1px solid {$colors['accent_color']};
}
.btn-default:hover, .btn-default:focus{
	border-bottom: 1px solid {$colors['accent_color']};
	background-color: {$colors['accent_color']};
}
.nav-previous:hover, .nav-next:hover{
	border: 1px solid {$colors['accent_color']};
	background-color: {$colors['accent_color']};
}
.next-post a:hover,.prev-post a:hover{
	color: {$colors['accent_color']};
}
.copy-right-section a {
    color: #a3a3a3;
}
.posts-navigation .next-post a:hover .fa, .posts-navigation .prev-post a:hover .fa{
	color: {$colors['accent_color']};
}
	#secondary .widget a:hover,	#secondary .widget a:focus{
color: {$colors['accent_color']};
}
	#secondary .widget_calendar tbody a {
background-color: {$colors['accent_color']};
color: #fff;
padding: 0.2em;
}
	#secondary .widget_calendar tbody a:hover{
background-color: {$colors['accent_color']};
color: #fff;
padding: 0.2em;
}	
CSS;

return $css;
}

if(! function_exists('seolib_colorstyles' ) ):
	function seolib_colorstyles(){

		?>

		<style type="text/css">

		.site-header .site-branding .header-logo span.site-title{ color: <?php echo esc_attr(get_theme_mod( 'header_colors')) ?>; }



		.header-social-media-link .fa{ color: <?php echo esc_attr(get_theme_mod( 'social_media_link_color')) ?>; }
		a.header-social-media-link{ border-color: <?php echo esc_attr(get_theme_mod( 'social_media_link_color')) ?>; }
		.site-header { padding-top: <?php echo esc_attr(get_theme_mod( 'header_top_padding')); ?>px; }
		.site-header { padding-bottom: <?php echo esc_attr(get_theme_mod( 'header_bottom_padding')); ?>px; }
		.site-header { background: <?php echo esc_attr(get_theme_mod( 'header_bg_color')); ?>; }
		.footer-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'footer_widget_title_colors')); ?>; }
		.site-footer { background: <?php echo esc_attr(get_theme_mod( 'footer_copyright_background_color')); ?>; }
		.footer-widget-wrapper { background: <?php echo esc_attr(get_theme_mod( 'footer_colors')); ?>; }
		.copy-right-section { color: <?php echo esc_attr(get_theme_mod( 'footer_copyright_text_color')); ?>; }
		#secondary h3.widget-title, #secondary h4.widget-title { color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline_colors')); ?>; }
		.secondary-inner { background: <?php echo esc_attr(get_theme_mod( 'sidebar_background_color')); ?>; }
		#secondary .widget a, #secondary .widget a:focus, #secondary .widget a:hover, #secondary .widget a:active, #secondary .widget #recentcomments a, #secondary .widget #recentcomments a:focus, #secondary .widget #recentcomments a:hover, #secondary .widget #recentcomments a:active, #secondary .widget .rsswidget, #secondary .widget .rsswidget:focus, #secondary .widget .rsswidget:hover, #secondary .widget .rsswidget:active { color: <?php echo esc_attr(get_theme_mod( 'sidebar_link_color')); ?>; }
		.navbar-default,.navbar-default li>.dropdown-menu, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dr { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
		.home .lh-nav-bg-transform li>.dropdown-menu:after { border-bottom-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
		.navbar-default .navbar-nav>li>a, .navbar-default li>.dropdown-menu>li>a, .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:active, .navbar-default .navbar-nav>li>a:visited, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
		.navbar-default .navbar-brand, .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?>; }
		h1.entry-title, .entry-header .entry-title a, .page .container article h2, .page .container article h3, .page .container article h4, .page .container article h5, .page .container article h6, .single article h1, .single article h2, .single article h3, .single article h4, .single article h5, .single article h6, .page .container article h1, .single article h1, .single h2.comments-title, .single .comment-respond h3#reply-title, .page h2.comments-title, .page .comment-respond h3#reply-title { color: <?php echo esc_attr(get_theme_mod( 'headline_color')); ?>; }
		.single .entry-content, .page .entry-content, .single .entry-summary, .page .entry-summary, .page .post-feed-wrapper p, .single .post-feed-wrapper p, .single .post-comments, .page .post-comments, .single .post-comments p, .page .post-comments p, .single .next-article a p, .single .prev-article a p, .page .next-article a p, .page .prev-article a p, .single thead, .page thead { color: <?php echo esc_attr(get_theme_mod( 'post_content_color')); ?>; }
		.page .container .entry-date, .single-post .container .entry-date, .single .comment-metadata time, .page .comment-metadata time { color: <?php echo esc_attr(get_theme_mod( 'author_line_color')); ?>; }
		.top-widgets { background: <?php echo esc_attr(get_theme_mod( 'top_widget_background_color')); ?>; }
		.top-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'top_widget_title_color')); ?>; }
		.top-widgets, .top-widgets p { color: <?php echo esc_attr(get_theme_mod( 'top_widget_text_color')); ?>; }
		.bottom-widgets { background: <?php echo esc_attr(get_theme_mod( 'bottom_widget_background_color')); ?>; }
		.bottom-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'bottom_widget_title_color')); ?>; }
		.frontpage-site-title, .frontpage-site-title:hover, .frontpage-site-title:active, .frontpage-site-title:focus { color: <?php echo esc_attr(get_theme_mod( 'header_image_text_color')) ?>; }
		.frontpage-site-description, .frontpage-site-description:focus, .frontpage-site-description:hover, .frontpage-site-description:active { color: <?php echo esc_attr(get_theme_mod( 'header_image_tagline_color')) ?>; }
		.bottom-widgets, .bottom-widgets p { color: <?php echo esc_attr(get_theme_mod( 'bottom_widget_text_color')); ?>; }
		.footer-widgets, .footer-widgets p { color: <?php echo esc_attr(get_theme_mod( 'footer_widget_text_color')); ?>; }
		.home .lh-nav-bg-transform .navbar-nav>li>a, .home .lh-nav-bg-transform .navbar-nav>li>a:hover, .home .lh-nav-bg-transform .navbar-nav>li>a:active, .home .lh-nav-bg-transform .navbar-nav>li>a:focus, .home .lh-nav-bg-transform .navbar-nav>li>a:visited { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_menu_color')); ?>; }
		.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_logo_color')); ?>; }
		body, #secondary h4.widget-title { background-color: <?php echo esc_attr(get_theme_mod( 'background_elements_color')); ?>; }
		.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus{color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
		#secondary, #secondary .widget, #secondary p{color: <?php echo esc_attr(get_theme_mod( 'sidebar_text_color')); ?>; }
		.footer-widgets, .footer-widgets p{color: <?php echo esc_attr(get_theme_mod( 'footer_widget_text_colors')); ?>; }
		.footer-widgets a, .footer-widgets li a{color: <?php echo esc_attr(get_theme_mod( 'footer_widget_link_colors')); ?>; }
		.copy-right-section{border-top: 1px solid <?php echo esc_attr(get_theme_mod( 'footer_copyright_border_color')); ?>; }
		.copy-right-section{border-top: 1px solid <?php echo esc_attr(get_theme_mod( 'footer_copyright_border_color')); ?>; }
		.single .entry-content a, .page .entry-content a, .single .post-comments a, .page .post-comments a, .single .next-article a, .single .prev-article a, .page .next-article a, .page .prev-article a {color: <?php echo esc_attr(get_theme_mod( 'post_link_color')); ?>; }
		.single .post-content, .page .post-content, .single .comments-area, .page .comments-area, .single .post-comments, .page .single-post-content, .single .post-comments .comments-area, .page .post-comments .comments-area, .single .next-article a, .single .prev-article a, .page .next-article a, .page .prev-article a, .page .post-comments {background: <?php echo esc_attr(get_theme_mod( 'post_background_color')); ?>; }
		.article-grid-container article{background: <?php echo esc_attr(get_theme_mod( 'post_feed_post_background')); ?>; }
		.article-grid-container .post-feed-wrapper p{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_text')); ?>; }
		.post-feed-wrapper .entry-header .entry-title a{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_headline')); ?>; }
		.article-grid-container h5.entry-date, .article-grid-container h5.entry-date a{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_date_noimage')); ?>; }
		.article-grid-container .post-thumbnail-wrap .entry-date{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_date_withimage')); ?>; }
		.blog .next-post a, .blog .prev-post a{background: <?php echo esc_attr(get_theme_mod( 'post_feed_post_button')); ?>; }
		.blog .next-post a, .blog .prev-post a, .blog .next-post a i.fa, .blog .prev-post a i.fa, .blog .posts-navigation .next-post a:hover .fa, .blog .posts-navigation .prev-post a:hover .fa{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_button_text')); ?>; }
		@media (max-width:767px){	
			.home .lh-nav-bg-transform { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?> !important; }
			.navbar-default .navbar-nav .open .dropdown-menu>li>a, .navbar-default .navbar-nav .open .dropdown-menu>li>a, .navbar-default .navbar-nav .open .dropdown-menu>li>a,.navbar-default .navbar-nav .open .dropdown-menu>li>a,:focus, .navbar-default .navbar-nav .open .dropdown-menu>li>a,:visited, .home .lh-nav-bg-transform .navbar-nav>li>a, .home .lh-nav-bg-transform .navbar-nav>li>a:hover, .home .lh-nav-bg-transform .navbar-nav>li>a:visited, .home .lh-nav-bg-transform .navbar-nav>li>a:focus, .home .lh-nav-bg-transform .navbar-nav>li>a:active, .navbar-default .navbar-nav .open .dropdown-menu>li>a:active, .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus, .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover, .navbar-default .navbar-nav .open .dropdown-menu>li>a:visited, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:active, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover {color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
			.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?>; }
			.navbar-default .navbar-toggle .icon-bar, .navbar-default .navbar-toggle:focus .icon-bar, .navbar-default .navbar-toggle:hover .icon-bar{ background-color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
			.navbar-default .navbar-nav .open .dropdown-menu > li > a {border-left-color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
		}
		<?php if ( get_theme_mod( 'hide_header' ) == '1' ) : ?>
		.site-header .site-branding .header-logo span.site-title {display:none;}
		<?php endif; ?>

		<?php if ( get_theme_mod( 'toggle_header_frontpage' ) == '1' ) : ?>
		.navbar-default .navbar-brand, .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?> !important; }
		.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_logo_color')); ?> !important; }
		.lh-nav-bg-transform li>.dropdown-menu:after { border-bottom-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }

		@media (max-width:767px){	
			.lh-nav-bg-transform { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?> !important; }
			.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?> !important; }

		}
		<?php endif; ?>

		</style>
		<?php }
		add_action( 'wp_head', 'seolib_colorstyles' );
		endif;



/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 */
function seolib_customize_control_js() {
	wp_enqueue_script( 'seolib-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'seolib-color-scheme-control', 'colorScheme', seolib_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'seolib_customize_control_js' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seolib_customize_preview_js() {
	wp_enqueue_script( 'seolib_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'seolib_customize_preview_js' );

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 */
function seolib_color_scheme_css_template() {
	$colors = array(
		'accent_color'            => '{{ data.accent_color }}',
		);
		?>
		<script type="text/html" id="tmpl-seolib-color-scheme">
		<?php echo seolib_get_color_scheme_css( $colors ); ?>
		</script>
		<?php
	}
	add_action( 'customize_controls_print_footer_scripts', 'seolib_color_scheme_css_template' );
