<?php
/**
 *
 * @package waffle
 * 
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background: url('<?php  echo waffle_get_bg_img();?>'); background-size: cover; background-attachment: fixed;">
    
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'waffle' ); ?></a>

            <div id="sidebar" class="sidebar">
                
                <div class="sidebar-inner" style="background:rgba(<?php echo waffle_get_sidebar_color();?>); overflow:hidden;">
                    
                    <header id="masthead" class="site-header" role="banner" style="background:rgba(<?php echo waffle_get_sidebar_color();?>);">
                    
                        <div class="site-branding">
                            
                            <?php 
                            if (esc_attr(get_theme_mod( 'waffle_logo_setting' ))) : ?>
                            <a href="<?php echo esc_url(home_url('/'));?>" rel="home">
                                <img src="<?php echo esc_attr(get_theme_mod( 'waffle_logo_setting')); ?>" alt="<?php _e( 'Logo', 'waffle' ); ?>">
                            </a>
                                
                            <?php elseif (is_front_page() && is_home()) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                            <?php
                            endif;

                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) :
                                ?>
                                <p class="site-description"><?php echo $description; ?></p>
                            <?php endif; ?>
                                
                            <button class="secondary-toggle"><?php _e('Menu and widgets', 'waffle'); ?></button>
                        </div><!-- .site-branding -->
                    </header><!-- .site-header -->

                    <?php get_sidebar(); ?>

                </div>
            </div><!-- .sidebar -->
            

	<div id="content" class="site-content">

