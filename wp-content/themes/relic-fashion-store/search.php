<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Relic_Fashion_Store
 */

get_header(); 

//Breadcrumb 
relic_fashion_store_default_breadcrumb(); //breadcrumbs Section 
?>
<section class="container">
	<div class="recent_blog">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 search-page-title">
				<h1 class="page-title" itemprop="headline"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'relic-fashion-store' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</div>
		</div>
		<div class="row recent_blog_post">
			<?php
				//Left Sidebar Call
				if ( relic_fashion_store_get_layout() == 'left-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
					get_sidebar('left'); 
				endif;
			?>
			
			<div class="<?php echo esc_attr( relic_fashion_store_page_column() ); ?>">
				<div class="row">
					<?php
					if ( have_posts() ) : ?>
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
				</div>
			</div><!-- #column -->
			
			<?php
				//Sidebar Right 
				if ( relic_fashion_store_get_layout() == 'right-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
					get_sidebar(); 
				endif;
			?>

		</div><!-- #column -->
	</div><!-- #column -->	
</section><!-- #Section -->
<?php
get_footer();
