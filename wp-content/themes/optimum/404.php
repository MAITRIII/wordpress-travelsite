<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package optimum
 */

get_header(); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
	<section class="content-padder error-404 not-found jumbotron text-center">
	    <header class="page-header">
		<h1 class="title large-text">404</h1>
	    </header><!-- .page-header -->
	    <div class="page-content">
		<h2 class="page-title"><?php esc_html__( 'Oops! Something went wrong here.', 'optimum' ); ?></h2>
		<p><?php esc_html_e( 'Nothing could be found at this location.', 'optimum' ); ?></p>
		<p><?php esc_html_e('Try going back to the','optimum'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><strong><?php esc_html_e('Homepage','optimum'); ?></strong></a>  <?php esc_html_e('instead?','optimum'); ?> </p>
	    </div><!-- .page-content -->
	</section><!-- .content-padder -->
    </div>

</div>
<?php get_footer(); ?>
