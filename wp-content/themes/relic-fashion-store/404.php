<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Relic_Fashion_Store
 */

get_header(); 

relic_fashion_store_default_breadcrumb(); //breadcrumbs Section 
?>
<section class="container">
	<div class="error_page">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 error-page-title">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'relic-fashion-store' ); ?></h1>
				</header><!-- .page-header -->
			</div>
		</div>

		<div class="row error_page_main_block">

			<?php
                //Left Sidebar Call
                if ( relic_fashion_store_get_layout() == 'left-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
                    get_sidebar('left'); 
                endif;
            ?>

			<div class="<?php echo esc_attr( relic_fashion_store_page_column() ); ?>" >
				<div class="page-content">
					<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'relic-fashion-store' ); ?></p>
				</div><!-- .page-content -->
			</div><!-- #end column Section -->

			<?php
                //Sidebar Right 
                if ( relic_fashion_store_get_layout() == 'right-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
                    get_sidebar(); 
                endif;
            ?>

		</div><!-- .error-404 -->

	</div><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
