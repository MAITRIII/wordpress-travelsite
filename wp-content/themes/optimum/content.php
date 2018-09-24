<?php
/**
 * @package optimum
 */
?>

<?php // Styling Tip!

// Want to wrap for example the post content in blog listings with a thin outline in Bootstrap style?
// Just add the class "panel" to the article tag here that starts below.
// Simply replace post_class() with post_class('panel') and check your site!
// Remember to do this for all content templates you want to have this,
// for example content-single.php for the post single view. ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">


	<div class="post-content-wrap col-sm-12 col-md-12">
	    <header class="page-header">
		<h2 class="page-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

    <div class="post-meta-info">
	    <?php if ( 'post' == get_post_type() ) : ?>
  	    <div class="entry-meta">
          <span class="entry-author">
            <i class="fa fa-user"></i>
            <span class="entry-author-link">
               <?php the_author_posts_link(); ?>
            </span>
          </span>

      		<time class="entry-time" itemprop="datePublished" datetime="<?php the_time(get_option('date_format')); ?>"><i class="fa fa-clock-o"></i> <?php the_date(get_option('date_format')); ?></time>
        		<span class="comments_count clearfix entry-comments-link"><i class="fa fa-commenting" aria-hidden="true"></i> <?php comments_popup_link('0', '1', '%'); ?></span>
  	    </div><!-- .entry-meta -->
  	    <?php endif; ?>
  	</div><!--.post-meta-info-->
	    </header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search and Archive Pages ?>
	    <div class="entry-summary">
    		<?php the_excerpt();  ?>
        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More &rarr;', 'optimum'); ?> <span class="screen-reader-text"><?php echo get_the_title(); ?></span></a>
	    </div><!-- .entry-summary -->

	<?php else : ?>

	    <div class="entry-content">
		<?php $format = get_post_format($post->ID); ?>
		<?php if (has_post_thumbnail($post->ID)): ?>
		    <?php
		    $image_id = get_post_thumbnail_id();
		    $full_image_url = wp_get_attachment_url($image_id);
		    ?>
		    <?php if ( '' != get_the_post_thumbnail() ): ?>
			<figure>
			    <a class="swipebox" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('optimum-blog-page'); ?>
			    </a>
			</figure>
		    <?php endif; ?>
		<?php endif; ?>

		<?php the_excerpt(); ?>

		<?php
		    wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'optimum' ),
			'after'  => '</div>',
		    ) );
		?>
		<a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More &rarr;', 'optimum'); ?> <span class="screen-reader-text"><?php echo get_the_title(); ?></span></a>

	    </div><!-- .entry-content -->
	<?php endif; ?>

	    <footer class="footer-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

		    <?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'optimum' ) );
		    ?>
		    <?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'optimum' ) );
		    ?>

		    <?php if ( ($categories_list && optimum_categorized_blog()) || ($tags_list) ): ?>
			<div class="cat-tag-meta-wrap">
			    <?php if ( $categories_list && optimum_categorized_blog() ) : ?>
				<span class="cats-meta"><?php printf( __( '<i class="fa fa-folder"></i> %1$s', 'optimum' ), $categories_list ); ?></span>
			    <?php endif; ?>
			    <?php if ( $tags_list ) : ?>
				<span class="tags-meta"><?php printf( __( '<i class="fa fa-tags"></i> %1$s', 'optimum' ), $tags_list ); ?></span>
			    <?php endif; ?>
			</div>
		    <?php endif; ?>
		<?php endif; ?>
	    </footer><!-- .entry-meta -->
	</div><!--.post-content-wrap-->

    </div><!--.row-->
</article><!-- #post-## -->
