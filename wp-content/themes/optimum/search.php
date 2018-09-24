<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package optimum
 */
get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-8">	
	
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'optimum' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->

		<?php // start the loop. ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php optimum_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; // end of loop. ?>

    </div>
    
    <div class="col-sm-12 col-md-4">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>