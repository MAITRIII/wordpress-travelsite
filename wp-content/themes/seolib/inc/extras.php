<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package seolib
 *
 * Please browse readme.txt for credits and forking information
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function seolib_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  return $classes;
}
add_filter( 'body_class', 'seolib_body_classes' );

if ( ! function_exists( 'seolib_header_menu' ) ) :
    /**
     * Header menu (should you choose to use one)
     */
  function seolib_header_menu() {
      // display the WordPress Custom Menu if available
    wp_nav_menu(array(
      'theme_location'    => 'primary',
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
      'menu_class'        => 'nav navbar-nav',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker()
      ));
  } /* end header menu */
  endif;



/**
 * Adds the URL to the top level navigation menu item
 */
function  seolib_add_top_level_menu_url( $atts, $item, $args ){
  if ( isset($args->has_children) && $args->has_children  ) {
    $atts['href'] = ! empty( $item->url ) ? $item->url : '';
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'seolib_add_top_level_menu_url', 99, 3 );




function seolib_backendfunctions_styles( $hook ) {
  if ( 'appearance_page_seolib-infopage' !== $hook ) {
    return;
  }
  wp_enqueue_style( 'seolib-info-styles', get_template_directory_uri() . '/css/admin.css', false, '3.0' );
}
add_action( 'admin_enqueue_scripts', 'seolib_backendfunctions_styles' );




add_action( 'admin_menu', 'backendfunctions' );
function backendfunctions() {
  add_theme_page( __('SEOlib Info', 'seolib'), __('SEOlib Theme', 'seolib'), 'edit_theme_options', 'seolib-infopage.php', 'seolib_backendfunctions_text');
}

function seolib_backendfunctions_text(){ ?>
<div class="text-centering">
  <div class="backend-css customize-seolib">
    <h2><?php echo __( 'Welcome to SEOlib', 'seolib' ); ?></p></h2>
    <p><?php echo __( 'If you have questions or need help with anything <br>theme related please', 'seolib' ); ?> <a href="https://outstandingthemes.com/contact/" target="_blank"><?php echo __( 'contact us here', 'seolib' ); ?></a></p>
  </div>
</div>

<div class="text-centering">
  <div class="backend-css customize-seolib">
    <h2><?php echo __( 'Do you like SEOlib?', 'seolib' ); ?></p></h2>
    <p>
      <?php echo __( 'We work hard & do our best to give you an awesome theme.', 'seolib' ); ?><br>
      <?php echo __( 'If you like seolib then let the developer know, he gets so happy! ', 'seolib' ); ?>
    </p> 
    <a href="https://wordpress.org/support/theme/seolib/reviews/?filter=5" class="review-button" target="_blank">Rate SEOlib</a>
</div>
</div>
<h2 class="headline-second"><?php echo __( 'Quick Links', 'seolib' ); ?></h2>
<div class="text-centering">
 <div class="backend-css">
 <a class="wide-button-seolib" href="<?php echo admin_url('/customize.php'); ?>" target="_blank">Customize Theme Design</a><br>
  <a class="wide-button-seolib" href="#demoanchor">SEOlib F.A.Q</a><br>
  <a class="wide-button-seolib" href="https://outstandingthemes.com/themes/seolib/" target="_blank">Read About SEOlib Pro</a><br>
  <a class="wide-button-seolib" href="https://outstandingthemes.com/contact/" target="_blank">Contact Us</a>


</div>
</div>
<div class="text-centering"><br><br>
  <a href="https://outstandingthemes.com/themes/seolib/" target="_blank">
<?php echo '<a href="https://outstandingthemes.com/themes/seolib/" target="_blank"><img src="' . get_template_directory_uri() . '/images/theme-image-2.png"></a>'; ?>
  </a>
</div>

<h2 class="headline-second" id="demoanchor"><?php echo __( 'F.A.Q & Documentation', 'seolib' ); ?></h2>
<section class="ac-container">
  <div>
    <input id="ac-40" name="accordion-40" type="radio">
    <label for="ac-40"><?php echo __( 'Making your website like the demo', 'seolib' ); ?></label>
    <article class="ac-large">
     <p><em><?php echo __( 'How to set up your website like on our demo', 'seolib' ); ?></em></p>
    <ol>
      <li><p><?php echo __( 'Go to "Appearance" > "Customize" in the WordPress admin menu.', 'seolib' ); ?></p></li>
      <li><p><?php echo __( 'Under "Site identity" pick a title and a tagline & choose "Display site title and tagline"', 'seolib' ); ?></p></li>
      <li><p><?php echo __( 'Go to Front Page Header and fill out a title and a tagline text', 'seolib' ); ?></p></li>
      <li><p><?php echo __( 'Go to Global Theme Color and choose default or pick a new one', 'seolib' ); ?></p></li>
    </ol>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-41" name="accordion-41" type="radio">
    <label for="ac-41"> <?php echo __( 'How to set up plugins', 'seolib' ); ?></label>
    <article class="ac-large">
      <p>- <a href="http://www.wpbeginner.com/plugins/how-to-install-and-setup-wordpress-seo-plugin-by-yoast/"> <?php echo __( 'How to set up Yoast', 'seolib' ); ?></a></p>
      <p>- <a href="http://nerdynerdnerdz.com/4119/how-to-setup-autoptimize-plugin-in-wordpress/"> <?php echo __( 'How to set up Autoptimize', 'seolib' ); ?></a></p>
      <p>- <a href="http://www.wpbeginner.com/beginners-guide/how-to-install-and-setup-wp-super-cache-for-beginners/"> <?php echo __( 'How to set up WP Super Cache', 'seolib' ); ?></a></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-48" name="accordion-48" type="radio">
    <label for="ac-48"> <?php echo __( 'How to change footer copyright text', 'seolib' ); ?></label>
    <article class="ac-large">
      <p>- <?php echo __( 'Go to Appearance > Customize > Footer and fill in Footer Copyright Text', 'seolib' ); ?></a></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-1" name="accordion-1" type="radio">
     <label for="ac-1"><?php echo __( 'Adding a logo', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Site Identity > Select Logo', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-2" name="accordion-2" type="radio">
    <label for="ac-2"><?php echo __( 'Adding a title to the header image/color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Site Identity > Site Title', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-3" name="accordion-3" type="radio">
    <label for="ac-3"><?php echo __( 'Adding a tagline to the header image/color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Front Page Header', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-4" name="accordion-4" type="radio">
    <label for="ac-4"><?php echo __( 'Adding a Site Icon / Fav Icon', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Site Identity > Site Icon', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-5" name="accordion-5" type="radio">
     <label for="ac-5"><?php echo __( 'Changing header text color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Colors > Header Text Color', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-49" name="accordion-49" type="radio">
    <label for="ac-49"><?php echo __( 'Changing background color on footer widget area', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Footer', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-6" name="accordion-6" type="radio">
     <label for="ac-6"><?php echo __( 'Changing header background color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Colors > Header background Color', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-7" name="accordion-7" type="radio">
     <label for="ac-7"><?php echo __( 'Adding a header image', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Header Image > Upload or pick a suggested', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-8" name="accordion-8" type="radio">
     <label for="ac-8"><?php echo __( 'Changing background color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Colors > background color', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-10" name="accordion-10" type="radio">
     <label for="ac-10"><?php echo __( 'Changing Theme Color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Accent Color > Select a color', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-11" name="accordion-11" type="radio">
    <label for="ac-11"><?php echo __( 'Adding a widget', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Widgets ', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-13" name="accordion-13" type="radio">
     <label for="ac-13"><?php echo __( 'Using full width theme', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'While editing a page, under Page Attributes, choose Full Width Template ', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-14" name="accordion-14" type="radio">
     <label for="ac-14"><?php echo __( 'Changing Footer Widget Title Color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Footer', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-15" name="accordion-15" type="radio">
     <label for="ac-15"><?php echo __( 'Changing footer copyright section background color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Footer', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-16" name="accordion-16" type="radio">
     <label for="ac-16"><?php echo __( 'Changing footer copyright section text color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Footer', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-17" name="accordion-17" type="radio">
     <label for="ac-17"><?php echo __( 'Changing Sidebar background color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Sidebar', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-45" name="accordion-45" type="radio">
    <label for="ac-45"><?php echo __( 'Changing sidebar headline color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Sidebar', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-18" name="accordion-18" type="radio">
     <label for="ac-18"><?php echo __( 'Changing sidebar link color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Sidebar', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-19" name="accordion-19" type="radio">
     <label for="ac-19"><?php echo __( 'Changing sidebar link border color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Sidebar', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-20" name="accordion-20" type="radio">
    <label for="ac-20"><?php echo __( 'Changing navigation background color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Navigation', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-22" name="accordion-22" type="radio">
    <label for="ac-22"><?php echo __( 'Changing navigation link color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Navigation', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-23" name="accordion-23" type="radio">
     <label for="ac-23"><?php echo __( 'Changing navigation logo color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Navigation', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-24" name="accordion-24" type="radio">
    <label for="ac-24"><?php echo __( 'Changing post & page headline color ', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Post & Page', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-25" name="accordion-25" type="radio">
     <label for="ac-25"><?php echo __( 'Changing post & page content color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Post & Page', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-26" name="accordion-26" type="radio">
     <label for="ac-26"><?php echo __( 'Changing post author byline color', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Post & Page', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-27" name="accordion-27" type="radio">
    <label for="ac-27"><?php echo __( 'Adding top widgets', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Widgets', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-28" name="accordion-28" type="radio">
     <label for="ac-28"><?php echo __( 'Adding bottom widgets', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Widgets', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-29" name="accordion-29" type="radio">
   <label for="ac-29"><?php echo __( 'Adding Footer widgets', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Widgets', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-30" name="accordion-30" type="radio">
    <label for="ac-30"><?php echo __( 'Adding Sidebar widgets', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Widgets', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-31" name="accordion-31" type="radio">
   <label for="ac-31"><?php echo __( 'Changing design on top widgets', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > top widgets design', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-32" name="accordion-32" type="radio">
    <label for="ac-32"><?php echo __( 'Changing design on bottom widgets', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > bottom widgets design', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-33" name="accordion-33" type="radio">
     <label for="ac-33"><?php echo __( 'Adding custom CSS', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Additional CSS', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-50" name="accordion-50" type="radio">
     <label for="ac-50"><?php echo __( 'Adding custom header text', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Front page: Header', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<section class="ac-container">
  <div>
    <input id="ac-51" name="accordion-51" type="radio">
     <label for="ac-51"><?php echo __( 'Adding an author image on posts', 'seolib' ); ?></label>
    <article class="ac-large">
      <p><?php echo __( 'In the WordPress admin menu click Appearance > Customize > Post & Pages and paste in the link to your author image, 50x50 size is recommended.', 'seolib' ); ?></p>
    </article>
  </div>
</section>

<?php }
