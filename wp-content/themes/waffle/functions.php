<?php
/**
 *
 * @package waffle
 *
 */


function waffle_theme_enqueue_styles() {

	$parent_style = 'twentyfifteen-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'waffle-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style )
	);
}
add_action( 'wp_enqueue_scripts', 'waffle_theme_enqueue_styles' );


function waffle_theme_enqueue_scripts() {

	wp_dequeue_script('twentyfifteen-script'); // dequeue parent script
	wp_enqueue_script( 'waffle-script', get_stylesheet_directory_uri() . '/js/waffle_functions.js', array( 'jquery' ), '1.00', true );

}
add_action('wp_enqueue_scripts', 'waffle_theme_enqueue_scripts',100);

/*
 *
 *
 *  Widgets
 *
 *
 */


function waffle_remove_default_sidebars(){
	remove_action( 'widgets_init', 'twentyfifteen_widgets_init' );
}
add_action('after_setup_theme','waffle_remove_default_sidebars', 11 );

function waffle_child_widgets_init() {


	register_sidebar(
		array(
			'name' => __( 'Front Page Sidebar', 'waffle' ),
			'description'   => __( 'Add widgets here to appear in your front page.', 'waffle' ),
			'id' => 'front-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Inner Page Sidebar', 'waffle' ),
			'id'            => 'inner-sidebar',
			'description'   => __( 'Add widgets here to appear in your innner page.', 'waffle' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'waffle_child_widgets_init' );




/*
 *
 *
 *  Theme Customization API
 *
 *
 */

function waffle_child_customize_register($wp_customize) {


	/*       Side Background Color       */

	$wp_customize->add_setting(
		'waffle_side_bg_color',
		array(
			'default' => '#000000',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_setting(
		'waffle_side_bg_opacity',
		array(
			'default' => '0.5',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',

		)
	);

	$wp_customize->add_section(
		'waffle_side_bg_section',
		array(
			'title' => __('Waffle Sidebar Background Color', 'waffle'),
			'priority'   => 40
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'waffle_side_bg_color',
			array(
				'section' => 'waffle_side_bg_section',
				'settings' => 'waffle_side_bg_color',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'waffle_side_bg_opacity',
			array(
				'label'          => __( 'Opacity', 'waffle' ),
				'section'        => 'waffle_side_bg_section',
				'settings'       => 'waffle_side_bg_opacity',
				'type'           => 'select',
				'choices'        => array(
					'0.5'   => '50%',
					'0.6'   => '40%',
					'0.7'   => '30%',
					'0.8'   => '20%',
					'0.9'   => '10%',
					'1'   => '0%'
				)
			)
		)
	);


	/*       Sidebar text color       */

	 $wp_customize->add_setting(
		'waffle_side_text_color',
		array(
			'default' => '#ffffff',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_section(
		'waffle_side_text_section',
		array(
			'title' => __('Waffle Sidebar Text Color', 'waffle'),
			'priority'   => 50
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'waffle_side_text_color',
			array(
				'section' => 'waffle_side_text_section',
				'settings' => 'waffle_side_text_color',
			)
		)
	);


	/*       Logo Uploader       */

	$wp_customize->add_setting(
		'waffle_logo_setting',
		array(
			'default' => get_stylesheet_directory_uri() . '/img/logo.png',
			'transport' => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_section(
		'waffle_logo_section',
		array(
			'title' => __('Waffle Logo', 'waffle'),
			'priority'   => 10
		)
	);

	$wp_customize->add_control(
	   new WP_Customize_Image_Control(
		   $wp_customize,
		   'logo',
		   array(
			   'label'      => __( 'Select or Upload your logo', 'waffle' ),
			   'section'    => 'waffle_logo_section',
			   'settings'   => 'waffle_logo_setting'
		   )
	   )
   );


	$wp_customize->get_section( 'title_tagline' )->priority = 0;
	$wp_customize->get_section( 'header_image' )->priority = 70;
	$wp_customize->get_section( 'colors' )->priority = 80;

	$wp_customize->get_setting('background_image')->default = get_stylesheet_directory_uri() . '/img/waffle_bg.jpg';
	$wp_customize->get_setting('background_image')->transport = 'refresh';
}

add_action('customize_register', 'waffle_child_customize_register',30);



function waffle_output_customized_css()
{
	$sidebar_text_color = esc_attr(get_theme_mod('waffle_side_text_color', '#ffffff'));
	?>
		 <style type="text/css">

			.sidebar-inner .secondary .main-navigation ul{
					border-color: <?php echo $sidebar_text_color; ?>;
			}

			.main-navigation ul li a{
				color: <?php echo $sidebar_text_color; ?>;
			}

			 .widget ul.menu{
				 border-top:1px solid <?php echo $sidebar_text_color; ?>;
				 border-bottom:1px solid <?php echo $sidebar_text_color; ?>;
			 }

			 .menu-item-description{
				 color: <?php echo $sidebar_text_color; ?> !important;
			 }

			.widget .widgettitle{
				color:<?php echo $sidebar_text_color;?>;
				 padding-bottom:10px;
			 }

			 .widget .widget-title,
			 .widget-area .widget .textwidget > p > a{
				 border-bottom:1px solid <?php echo $sidebar_text_color;?>;
			 }

			 .site-branding .site-title>a,
			 .site-branding .site-description,
			 .widget-area .widget .widget-title,
			 .widget-area .widget .textwidget > p,
			 .widget-area .widget .textwidget > p > a,
			 .widget-area .widget ul li,
			 .widget-area .widget ul li a,
			 .widget-area .widget ul.menu li a{
				 color:<?php echo $sidebar_text_color; ?>;
			 }

			 .secondary-toggle,
			 .secondary-toggle:focus,
			 .secondary-toggle:hover{
				 border:1px solid <?php echo $sidebar_text_color;?>;
			 }

			 .secondary-toggle:before{
				 color:<?php echo $sidebar_text_color; ?>;
			 }

			 #social-navigation a:before{
				 color: <?php echo $sidebar_text_color.' !important'; ?>;
			 }


		 </style>
	<?php
}
add_action( 'wp_head', 'waffle_output_customized_css');

function waffle_get_sidebar_color(){

	$color = esc_attr(get_theme_mod('waffle_side_bg_color','#000000'));
	$opacity = esc_attr(get_theme_mod('waffle_side_bg_opacity','0.6'));


	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	if ( strlen( $color ) == 6 ) {
			list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
			list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
			return false;
	}

	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );

	return "$r,$g,$b,$opacity";
}

function waffle_get_bg_img(){
	$bg_uri = esc_attr(get_theme_mod('background_image'));
	if($bg_uri==''){
		return get_stylesheet_directory_uri() . '/img/waffle_bg.jpg';
	}else{
		return $bg_uri;
	}
}



/*
 *
 *
 *  custermize the length of excerpt
 *  @ switching the length of excerpt between archive.php and template-blog.php
 *  To chnage the length of excerpt between parent's archive.php and template-blog.php
 *  below code was added
 *
 *
 */

function waffle_new_excerpt_mblength($length) {
	if(is_archive()):
		return 40;
	elseif(is_page_template('template-blog.php')):
		return 100;
	else:
		return 80;
	endif;
}
add_filter('excerpt_mblength', 'waffle_new_excerpt_mblength');



/*
 *
 *
 *  Loading up language file of child theme
 *
 *
 */

function waffle_child_languages_setup() {

	load_child_theme_textdomain( 'waffle', get_stylesheet_directory() . '/languages');

	register_nav_menus( array(
	 'primary' => __( 'Primary Menu', 'waffle' ),
	) );

}
add_action( 'after_setup_theme', 'waffle_child_languages_setup');


/*
 *
 *
 *  Showing default home as part of derault menu as well as Sample page
 *
 *
 */


function waffle_show_default_menu($args){
	$args['show_home']=true;
	return $args;
}

add_filter('wp_page_menu_args','waffle_show_default_menu');




add_action('appearance_page_more', 'regist_more_css');
function regist_more_css() { ?>
<link rel='stylesheet' id='waffle_style-css' href='<?php echo get_stylesheet_directory_uri() .'/css/more.css' ?>' type='text/css' media='all' /><?php }

//More
function waffle_menu_more() {
	$siteurl = get_option( 'siteurl' );
?>
<div class="moreWrap">
	<h2>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/head_title.png" alt="Internet For Everyone Z.com by GMO" >
	</h2>

	<div class="more_navigation">
		<ul>
			<li><a href="#hosting">WordPress Hosting</a></li>
			<li><a href="#themes">Themes</a></li>
			<li><a href="#plugins">Plugins</a></li>
		</ul>
	</div>

	<a id="hosting" name="hosting"></a>
	<div class="more_contents">

		<h3>Z.com WordPress Hosting</h3>
		<div class="hosting">
			<a href="https://cloud.z.com/jp/en/wp/?utm_source=themes&utm_medium=aboutz&utm_campaign=themes_aboutz" target="_blank">
				<p class="title">Reason for smooth WordPress Experience</p>
				<p>
					You don’t have to care about Speeding up, security and updates, because “Z.com WordPress Hosting” is optimized for WordPress.<br>
					The structure designing for exclusive use of WordPress with high-speed SSD supports WordPress specific mechanism that depends on the database. You can enjoy seamless operation which cannot be provided with the regular HDD.<br>
					Z.com WordPress Hosting features safe and seamless WordPress site building experience to let you focus on site contents and updating.
				</p>
				<p class="btn">View More</p>
			</a>
		</div>

		<a id="themes" name="themes"></a>
		<h3>Z.com WordPress Themes</h3>
		<div class="block-themes">
			<ul class="list-themes">
				<li class="items list1">
					<div class="box-inner">
						<h4 class="titles">waffle</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_waffle.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://waffle.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="https://wordpress.org/themes/waffle" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							waffle is child theme of twenty fifteen base functionality is took over parent has and additional features are installed especially background color and text color on sidebar.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list2">
					<div class="box-inner">
						<h4 class="titles">Tidy</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_tidy.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://tidy.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="https://wordpress.org/themes/tidy" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Tidy - The multi-purpose WordPress theme with ultimate simplicity. The theme is fully customizable, responsive and flexible with full of revolutionary functions. Contents can turned on and off as desired, and a wide variety of layout options to help you build a satisfactory website.<br>
							The theme comes standard with the original slider, social media integration, Google advertisement & stats plugins along with the web font support with full color customization for enhanced flexibility.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list3">
					<div class="box-inner">
						<h4 class="titles">Madeini</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_madeini.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://madeini.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/madeini" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Madeini is an upgraded version of Twenty-Fourteen WordPress default theme with enhanced custom color and custom background image feature.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list4">
					<div class="box-inner">
						<h4 class="titles">Kimono</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_kimono.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://kimono.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/kimono" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Kimono is a simple, and user friendly WordPress theme. Beautiful design inspiration comes from Japanese traditional garment called Kimono.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list5">
					<div class="box-inner">
						<h4 class="titles">Kotenhanagara</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_kotenhanagara.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://kotenhanagara.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/kotenhanagara" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Kotenhanagara is a simple, easy-to-use, and highly customizable WordPress theme. Beautiful Japanese design inspiration comes from Urushi coating which is lacquerware decorated and varnished in the Japanese manner.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list6">
					<div class="box-inner">
						<h4 class="titles">de naani.</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_denaani.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://denaani.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="https://wordpress.org/themes/de-naani" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							'de naani' is an upgraded version of Twenty-Twelve default theme which is designed to work perfectly with 'GMO Show Time' slider plugin and 'GMO Font agent'web font plugin. This theme also allow you to insert logo, and change site title/tagline positions.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list7">
					<div class="box-inner">
						<h4 class="titles">Azabu Juban</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_azabujuban.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://azabujuban.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/azabu-juban" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Azabu-Juban is a simple, easy-to-use, and highly customizable WordPress theme. Beautiful Japanese design inspiration comes from Urushi coating which is lacquerware decorated and varnished in the Japanese manner.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
			</ul><!-- .list-themes -->
		</div><!-- .block-themes -->



		<a id="plugins" name="plugins"></a>
		<h3>Z.com WordPress Plugins</h3>

		<div class="plugins">

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_showtime.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-showtime/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Showtime</h4>
					<p>GMO Showtime slider plugin gives cool effects to the slider in a snap. The control screen is simple, for anyone to easily use. Express user's originality with fully customizable link and color as well as 16 slider effects in 6 different layouts.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_font_agent.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-font-agent/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Font Agent</h4>
					<p>GMO Font Agent plugin works with Google fonts, gives you a choice to use variety of stylish web fonts. The plugin is genericon and IcoMoon compatible, to enhance its usability. Icons can be inserted from the post editor.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_sahre_connection.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-share-connection/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Share Connection</h4>
					<p>GMO Share Connection plugin is designed for easy social sharing by letting user choose place/pages to use icons. 9 social network services are supported in this plugin including Facebook and Twitter.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_ads_master.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-ads-master/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Ads Master</h4>
					<p>GMO Ads Master is the ad banner plugin which enables you to place ad contents to the desired locations such as inside article, sidebar and footer. In addition to that, using this plugin let you setup Google Analytics tracking code and sitemap tool settings, and sitemap can be easily generated without playing with PHP files.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_go_to_top.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-go-to-top/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Go to Top</h4>
					<p>GMO Go to Top is a simple plugin adds a simple button which allows users to scroll all the way up to the top by 1-click. Button color, style, position can be modified or you can also upload your own button image.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_page_trasitions.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-page-transitions/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Page Transitions</h4>
					<p>GMO Page Transitions adds Page Transitions actions to your site. Click on the link, and page will slide over to left or right. This effect will not apply when "target=_brank" is used.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_tinymce_smiley.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-tinymce-smiley/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO TinyMCE Smiley</h4>
					<p>GMO TinyMCE Smiley is a plugin to let you instantly add smilies into your site from the toolbar..</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_google_map.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-google-map/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Google Map</h4>
					<p>With "GMO Google Map" plugin, you can use Google Maps on your website by simply embedding a shortcode in anywhere you desire. No special coding skill is required. Simply enter information (eg. address) to create a shortcode and paste it to complete.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_showtime.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-widget-custom/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Widget Custom</h4>
					<p>This is a useful widget customizer plugin which enables you to insert images, ad and recommendation banners.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_slider.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-slider/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Slider</h4>
					<p>GMO Slider plugin let you insert sliders in posts and pages. The control screen is simple, for anyone to easily use. GMO Slider supports images as well as text and video. </p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_social_connection.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-social-connection/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Social Connection</h4>
					<p>GMO Social Connection let you easily place SNS share buttons on the articles. It also allows you to choose button position from top or bottom. Supported SNS are Facebook, Twitter and Google+.</p>
				</div>
			</div>


		</div>

	</div>


	<div class="quality">
		<h3>Quality Service</h3>
		<p class="lead">“Brought to you by Japan's leading one-stop provider of Internet services”</p>
		<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/footer_logo_gmo.png" alt="GMO INTERNET GROUP" ></p>
		<p>Z.com WordPress Hosting is operated by GMO Internet group, the number one provider of domain registration, web hosting, security, ecommerce and payment processing solutions in Japan.Under the corporate slogan "Internet for Everyone", GMO Internet Group's trusted service brand represents industry expertise, a proven track record and quality service.</p>
		<p><a href="http://www.gmo.jp/en/" target="_blank">> Visit GMO Internet Group</a></p>
	</div>

</div>

<?php
}
function waffle_admin_menu() {
	add_theme_page( 'Z.com WordPress Hosting', 'More', 'read','more', 'waffle_menu_more' );
}

add_action( 'admin_menu', 'waffle_admin_menu' );

//Dashboard
function waffle_dashboard_widget_function() {
?>
<a href="https://cloud.z.com/jp/en/wp/?utm_source=themes&utm_medium=dashboard&utm_campaign=themes_dashboard" target="_blank"><img src="<?php echo get_stylesheet_directory_uri() .'/images/zcom_wordpress_hosting.gif' ?>" style="width:100%"></a>
<?php
}
function waffle_add_dashboard_widgets() {
wp_add_dashboard_widget('waffle_dashboard_widget', 'Z.com WordPress Hosting', 'waffle_dashboard_widget_function');
global $wp_meta_boxes;
$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
$example_widget_backup = array('waffle_dashboard_widget' => $normal_dashboard['waffle_dashboard_widget']);
unset($normal_dashboard['waffle_dashboard_widget']);
$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);
$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'waffle_add_dashboard_widgets' );
