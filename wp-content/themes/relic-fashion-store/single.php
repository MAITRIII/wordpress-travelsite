<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Relic_Fashion_Store
 */

get_header();

	//Breadcrumb 
	relic_fashion_store_default_breadcrumb(); //breadcrumbs Section 
	?>
	<div class="blog-detail blog_detail1">
		<?php
			while ( have_posts() ) : the_post();
				//single Page Content Section 
				get_template_part( 'template-parts/content', 'single' );
				wp_link_pages();
			endwhile; // End of the loop.
		?>
	</div>
<?php
get_footer();
