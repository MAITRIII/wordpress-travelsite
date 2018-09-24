<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package optimum
 */

get_header(); ?>

 <div class="row">
    <div class="col-sm-12 col-md-9">
	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
	<div class="content-padder">

	    <?php if ( have_posts() ) : ?>

		<header class="page-header">
        <?php
          the_archive_title( '<h1 class="page-title">', '</h1>' );
          the_archive_description( '<div class="taxonomy-description">', '</div>' );
        ?>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

		    <?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );
		    ?>

		<?php endwhile; ?>

		<?php optimum_content_nav( 'nav-below' ); ?>

	    <?php else : ?>

		<?php get_template_part( 'no-results', 'archive' ); ?>

	    <?php endif; ?>

	</div><!-- .content-padder -->

    </div>

    <div class="col-sm-12 col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
