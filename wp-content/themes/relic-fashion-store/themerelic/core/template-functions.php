<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function relic_fashion_store_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	//Home page links
	elseif( 'posts' != get_option( 'show_on_front' ) && is_front_page()){
		$classes[] = 'page-template-v2';
	}

	//is home page
	if( 'posts' == get_option( 'show_on_front' ) ){
		$classes[] = 'header-menu-grid ';
	}
	

	return $classes;
}
add_filter( 'body_class', 'relic_fashion_store_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function relic_fashion_store_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'relic_fashion_store_pingback_header' );



/**
 * Thumbnail Image Settings
 */
function relic_fashion_store_post_thumbnail_image() {
	//Fallback Image
	$fallback_thumbnail_image = get_theme_mod( 'relic_fashion_store_archive_page_feedback_thumbnail',true );
	$fallback_image = get_template_directory_uri().'/assets/images/fallback/feedback-post-thumbnail.jpg';
	?>
	<?php if ( has_post_thumbnail() ) { ?> 
		<div class="" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">

			<?php  the_post_thumbnail( 'relic-fashion-store-blog', array( 'itemprop' => 'image' ) ); ?>

			<?php if( get_theme_mod('relic_fashion_store_archive_page_date_enable',true) == true ): ?><div class="date" itemprop="datePublished"><span><?php the_time('j'); ?></span><?php the_time('M Y') ?></div><?php endif; ?>
		</div>
	<?php	
	}elseif( $fallback_thumbnail_image == true ){ ?>
		<div  itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			<img itemprop="image" src="<?php echo esc_url( $fallback_image ); ?>" alt="<?php the_title_attribute(); ?>" >
			<?php if(get_theme_mod('relic_fashion_store_archive_page_date_enable',true) == true ): ?><div class="date" itemprop="datePublished"><span><?php the_time('j'); ?></span><?php the_time('M Y') ?></div><?php endif; ?>
		</div>
	<?php }

}
add_action( 'relic_fashion_store_thumbnail', 'relic_fashion_store_post_thumbnail_image' );
