<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Relic_Fashion_Store
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( relic_fashion_store_blog_item_class() ); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<div class="item">
			<?php do_action('relic_fashion_store_thumbnail'); ?>
			<div class="recent-blog-text">
				<?php if(get_theme_mod('relic_fashion_store_archive_page_category_metabox_enable',true) == true ): the_category(','); endif; ?>
				<?php if(get_theme_mod('relic_fashion_store_archive_page_author_metabox_enable',true) == true ): ?><span itemprop="author"><?php the_author(); ?></span><?php endif; ?>
				<?php the_title( '<h5 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
				<div class="blog-content" itemprop="text"><?php the_excerpt(); ?></div>
				<div class="blog_comment clearfix">
					<?php if(get_theme_mod('relic_fashion_store_archive_page_comments_metabox_enable',true) == true ): ?>
						<div class="blog_comment_number">
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><small><i class="fa fa-comment" aria-hidden="true"></i><?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'relic-fashion-store'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?></small></a>
						</div>
					<?php endif; ?>

					<?php if(get_theme_mod('relic_fashion_store_archive_page_social_share_enable',true) == true ): relic_fashion_store_social_share_section( $post->ID ); endif; ?>
				</div>
		</div>
	</div>
</div>
