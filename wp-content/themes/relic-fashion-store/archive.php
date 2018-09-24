<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Relic_Fashion_Store
 */

get_header();
$relic_fashion_store_archive_page_sidebar = get_theme_mod( 'relic_fashion_store_archive_page_sidebar','right-sidebar' );

//Breadcrumbs Section
relic_fashion_store_default_breadcrumb(); //breadcrumbs Section 
?>
<section class="container">
	<div class="recent_blog">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php
					the_archive_title( '<h5 class="page-title" itemprop="headline" >', '</h5>' );
					the_archive_description( '<div class="archive-description" itemprop="description">', '</div>' );
				?>
			</div>
		</div>
		
		<div class="row recent_blog_post">
			<?php 
                //Left Sidebar Call
                if ( $relic_fashion_store_archive_page_sidebar == 'left-sidebar' OR $relic_fashion_store_archive_page_sidebar == 'both-sidebar') : 
                    get_sidebar('left'); 
                endif;
			?>
			<div class="<?php echo esc_attr( relic_fashion_store_page_column() ); ?>" >
				<div class="row">
					<?php
					if ( have_posts() ) : ?>
						<?php
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
						<div class="wraper-pagination">
							<?php the_posts_pagination( array(
									'mid_size' => 2,
									'prev_text' => __( '<', 'relic-fashion-store' ),
									'next_text' => __( '>', 'relic-fashion-store' ),
								) ); ?>
						</div>
					<?php
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</div>
			</div><!--Archive Bare Blog -->
			<?php
                //Sidebar Right 
                if ( $relic_fashion_store_archive_page_sidebar == 'right-sidebar' OR $relic_fashion_store_archive_page_sidebar == 'both-sidebar') : 
                    get_sidebar(); 
                endif;
            ?>
		</div>
	</div>
</section>
<?php
get_footer();