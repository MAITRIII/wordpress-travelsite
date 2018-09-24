<?php
/**
 *
 * @package waffle
 * 
 */

?>

<div id="secondary" class="secondary" style="background:rgba(<?php echo waffle_get_sidebar_color();?>);"> 

                <?php //if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
					// Primary navigation menu.
					wp_nav_menu( array(
						'menu_class'     => 'nav-menu',
						'theme_location' => 'primary',
					) );
				?>
			</nav><!-- .main-navigation -->
		<?php //endif; ?>
    
                <?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' => 'social',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>
                        
		
			
            <div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'front-sidebar' ); ?>
			</div><!-- .widget-area -->
                        
		
                        
            <div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'inner-sidebar' ); ?>
			</div><!-- .widget-area -->
                        
               

	</div><!-- .secondary -->


