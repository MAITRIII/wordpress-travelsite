<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="inner-page-content">
 *
 * @package optimum
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php do_action( 'before' ); ?>
  <div class="content-wrapper">
    <div class="inner-wrapper">

    	<div id="left-sidebar">
    	    <div class="sidebar-inner">
        		<header id="masthead" class="site-header" role="banner">
        		    <div id="logo">
            			<div class="site-header-inner">
            			    <div class="site-branding">
                				<?php optimum_the_custom_logo(); ?>
                        <?php if ( is_front_page() && is_home() ) : ?>
                          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                          <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif; ?>
                				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
            			    </div>
            			</div>
        		    </div><!--#logo-->

        		    <div class="sidebar-bottom-content">
              			<div class="header-search">
              			    <div class="header-search-form-wrap">
                          <?php get_search_form(); ?>
              		       </div>
              			</div>
              			<div class="site-navigation" role="navigation">
              			    <nav aria-label="<?php _e( 'Main Menu', 'optimum' ); ?>" class="main-menu">
                  				<?php
                  				wp_nav_menu(array(
                  				    'theme_location' => 'main-menu',
                  				    'container' => false,
                  				    'menu_class' => 'header-nav clearfix'
                  				));
                  				?>
              			    </nav>
              			    <div id="responsive-menu-container"></div>
              			</div><!-- .site-navigation -->

              			<div class="header-info">
              			    <div class="mail-info">
                  				<?php if(optimum_get_options( 'om_phone_number', '')): ?>
                  				    <span class="phone-info"><i class="fa fa-phone"></i> <a href="tel:<?php echo esc_attr(optimum_get_options( 'om_phone_number', '')); ?>"><?php echo esc_attr(optimum_get_options( 'om_phone_number', '')); ?></a></span>
                  				<?php endif; ?>
                  				<?php if(optimum_get_options( 'om_email_id', '')): ?>
                  				    <span class="email-info"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo esc_attr(optimum_get_options( 'om_email_id', '')); ?>" target="_blank"><?php echo esc_attr(optimum_get_options( 'om_email_id', '')); ?></a></span>
                  				<?php endif; ?>
              			    </div>

              			    <div class="header-social-icon-wrap">
                  				<ul class="social-icons">
                  				    <?php
                      					$socialmedia_navs= optimum_socialmedia_navs();
                      					foreach($socialmedia_navs as $socialmedia_url => $socialmedia_icon) {
                      					    if (optimum_get_options($socialmedia_url, '')) {
                  						          echo '<li class="social-icon"><a target="_blank" href="' . esc_url(optimum_get_options($socialmedia_url, '')) . '"><i class="'.$socialmedia_icon.'"></i></a></li>';
                      					    }
                      					}
                  				    ?>
                  				</ul>
              			    </div><!--.header-social-icon-wrap-->
              			</div><!--.header-info-->

        		    </div><!-- .sidebar-bottom-content -->
        		</header><!-- #masthead -->
    	    </div><!--.sidebar-inner-->
    	</div><!--#left-sidebar-->

     <div class="main-content" id="main-content" role="main">
       <div id="content" class="main-content-inner">
          <?php get_template_part( 'header', 'banner' );?>
  		    <div class="inner-page-content">
