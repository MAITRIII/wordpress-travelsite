<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Relic_Fashion_Store
 */

get_header(); 

relic_fashion_store_default_breadcrumb(); //breadcrumbs Section 
?>
<section class="container">
	<div class="recent_blog">
			<div class="row recent_blog_post">
				<?php
					//Left Sidebar Call
					if ( relic_fashion_store_get_layout() == 'left-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
						get_sidebar('left'); 
					endif;
				?>

				<div class="<?php echo esc_attr( relic_fashion_store_page_column() ); ?>">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div><!-- #End row Column -->
				
				<?php
					//Sidebar Right 
					if ( relic_fashion_store_get_layout() == 'right-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
						get_sidebar(); 
					endif;
				?>
				
			</div><!-- #End row Section -->
		</div><!-- #End row Section -->

	</main><!-- #recent_blog -->
</section><!-- #section -->
<?php
get_footer();