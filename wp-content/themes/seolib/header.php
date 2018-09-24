<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
* Please browse readme.txt for credits and forking information
 * @package seolib
 */

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="hfeed site">
    <header id="masthead">
      <nav class="navbar lh-nav-bg-transform navbar-default navbar-fixed-top navbar-left"> 
        <!-- Brand and toggle get grouped for better mobile display --> 
        <div class="container" id="navigation_menu">
          <div class="navbar-header"> 
            <?php if ( has_nav_menu( 'primary' ) ) { ?>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
              <span class="sr-only"><?php echo esc_html('Toggle Navigation', 'seolib') ?></span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
            </button> 
            <?php } ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="navbar-brand"><?php bloginfo('name'); ?></div>
            </a>
          </div> 
          <?php if ( has_nav_menu( 'primary' ) ) {
              seolib_header_menu(); // main navigation 
            }
            ?>

          </div><!--#container-->
        </nav>

        <?php if ( is_front_page() ) { ?>
        <div class="site-header">
          <div class="site-branding"> 
            <span class="home-link">
             <div class="header-logo">
               <?php 
               if (has_custom_logo()) { 
                the_custom_logo();
              } else {
                echo '<span class="site-title">'; bloginfo('name'); echo '</span>';
              } ?>
            </div>
            <!-- Social media links Start -->

            <!-- Facebook link -->
            <?php if (get_theme_mod('facebook_link') ) : ?>
            <a href="<?php echo esc_url(get_theme_mod('facebook_link')) ?>" target="_blank" class="header-social-media-link">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
          <?php endif; ?>
          <!-- Twitter link -->
          <?php if (get_theme_mod('twitter_link') ) : ?>
          <a href="<?php echo esc_url(get_theme_mod('twitter_link')) ?>" target="_blank" class="header-social-media-link">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
        <?php endif; ?>
        <!-- Instagram link -->
        <?php if (get_theme_mod('instagram_link') ) : ?>
        <a href="<?php echo esc_url(get_theme_mod('instagram_link')) ?>" target="_blank" class="header-social-media-link">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
      <!-- Youtube link -->
      <?php if (get_theme_mod('youtube_link') ) : ?>
      <a href="<?php echo esc_url(get_theme_mod('youtube_link')) ?>" target="_blank" class="header-social-media-link">
        <i class="fa fa-youtube" aria-hidden="true"></i>
      </a>
    <?php endif; ?>
    <!-- Linkedin link -->
    <?php if (get_theme_mod('linkedin_link') ) : ?>
    <a href="<?php echo esc_url(get_theme_mod('linkedin_link')) ?>" target="_blank" class="header-social-media-link">
     <i class="fa fa-linkedin" aria-hidden="true"></i>
   </a>
 <?php endif; ?>
 <!-- Twitch link -->
 <?php if (get_theme_mod('twitch_link') ) : ?>
 <a href="<?php echo esc_url(get_theme_mod('twitch_link')) ?>" target="_blank" class="header-social-media-link">
   <i class="fa fa-twitch" aria-hidden="true"></i>
 </a>
<?php endif; ?>
<!-- Pinterest link -->
<?php if (get_theme_mod('pinterest_link') ) : ?>
  <a href="<?php echo esc_url(get_theme_mod('pinterest_link')) ?>" target="_blank" class="header-social-media-link">
   <i class="fa fa-pinterest-p" aria-hidden="true"></i>
 </a>
<?php endif; ?>
<!-- Soundcloud link -->
<?php if (get_theme_mod('soundcloud_link') ) : ?>
  <a href="<?php echo esc_url(get_theme_mod('soundcloud_link')) ?>" target="_blank" class="header-social-media-link">
   <i class="fa fa-soundcloud" aria-hidden="true"></i>
 </a>
<?php endif; ?>
<!-- Social media links end -->

</span>

</div><!--.site-branding-->
</div><!--.site-header--> 
<?php } ?>

</header>    

<div id="content" class="site-content">