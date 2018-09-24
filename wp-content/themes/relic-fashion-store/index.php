<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Relic_Fashion_Store
 */

$relic_fashion_store_archive_page_sidebar = get_theme_mod( 'relic_fashion_store_archive_page_sidebar','right-sidebar' );
get_header(); 

//Breadcrumb 
relic_fashion_store_default_breadcrumb(); //breadcrumbs Section 

?>
<!-- related_blog -->
<section class="container">
	<div class="recent_blog">
		<div class="row recent_blog_post">
			<?php 
                //Left Sidebar Call
                if ( $relic_fashion_store_archive_page_sidebar == 'left-sidebar' OR $relic_fashion_store_archive_page_sidebar == 'both-sidebar') : 
                    get_sidebar('left'); 
                endif;
			?>
			
			<div class="<?php echo esc_attr( relic_fashion_store_page_column() ); ?>">
				<div class="row">
					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text" itemprop="headline"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						while ( have_posts() ) : the_post();
							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;
						?>
					<?php
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif; ?>
					
				</div>
				<div class="wraper-pagination">
					<?php the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => __( '<', 'relic-fashion-store' ),
							'next_text' => __( '>', 'relic-fashion-store' ),
						) ); ?>
				</div>
			</div>
			<?php
                //Sidebar Right 
                if ( $relic_fashion_store_archive_page_sidebar == 'right-sidebar' OR $relic_fashion_store_archive_page_sidebar == 'both-sidebar') : 
                    get_sidebar(); 
                endif;
            ?>
		</div>
</section>


<?php
get_footer();
