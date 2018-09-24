<?php

/*
 * 
 * 
 * @package waffle
 * home.php for blog posts index
 * 
*/



get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

                <?php
                
                    
                    if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'waffle' ),
				'next_text'          => __( 'Next page', 'waffle' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'waffle' ) . ' </span>',
			) );
                        

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
                
                
		?>
                    

		</main><!-- .site-main -->
	</section><!-- .content-area -->
        
        
        
        
        </div><!-- .site-content -->
        
        
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				/**
				 * Fires before the Twenty Fifteen footer text for footer customization.
				 *
				 * @since Twenty Fifteen 1.0
				 */
				do_action( 'twentyfifteen_credits' );
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'waffle' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'waffle' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
        
       
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>

