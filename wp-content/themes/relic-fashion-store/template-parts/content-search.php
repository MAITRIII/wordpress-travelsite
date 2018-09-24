<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Relic_Fashion_Store
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('col-lg-6 col-md-12'); ?>>
	<div class="item">
			<?php do_action('relic_fashion_store_thumbnail'); ?>
			<div class="recent-blog-text">
				<?php the_category(','); ?>
				<span itemprop="author"><?php the_author(); ?></span>
				<?php the_title( '<h5 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
				<div class="blog-content" itemprop="text"><?php the_excerpt(); ?></div>
				<div class="blog_comment clearfix">
					<div class="blog_comment_number">
						<a href="<?php echo esc_url( get_comments_link() ); ?>">
							<small>
								<i class="fa fa-comment" aria-hidden="true"></i>
								<?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'relic-fashion-store'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?>
							</small>
						</a>
					</div>
					<?php relic_fashion_store_social_share_section( $post->ID ); ?>
				</div>
		</div>
	</div>
</div>