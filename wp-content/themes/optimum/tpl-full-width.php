<?php
/**
 * Template Name: Full Width Page
 *
 *
 * @package optimum
 */

get_header(); ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
        <?php endwhile; // end of the loop. ?>
    </div>
</div>
<?php get_footer(); ?>
