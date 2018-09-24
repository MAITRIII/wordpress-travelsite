<?php
/**
 * @package optimum
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="row">
	   <div class="post-content-wrap col-sm-12 col-md-10">
  	    <header class="page-header">
      		<h1 class="page-title"><?php the_title(); ?></h1>
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
	    <div class="entry-content">
		<?php $format = get_post_format($post->ID); ?>
		<?php if (has_post_thumbnail($post->ID)): ?>
		    <?php
		    $image_id = get_post_thumbnail_id();
		    $full_image_url = wp_get_attachment_url($image_id);
		    ?>
		    <?php if ( '' != get_the_post_thumbnail() ): ?>
			<figure>
			    <a class="swipebox" href="<?php echo $full_image_url; ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('optimum-blog-page'); ?>
			    </a>
			</figure>
		    <?php endif; ?>
		<?php endif; ?>

		<?php the_content(); ?>
		<?php
		    wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'optimum' ),
			'after'  => '</div>',
		    ) );
		?>
	    </div><!-- .entry-content -->

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
		<?php endif; // End if 'post' == get_post_type() ?>
	    </footer><!-- .entry-meta -->
	</div><!--.post-content-wrap-->
    </div><!--.row-->
</article><!-- #post-## -->
