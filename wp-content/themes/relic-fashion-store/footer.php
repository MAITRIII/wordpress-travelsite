<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Relic_Fashion_Store
 */
?>
	
	
		<!-- footer -->
		<footer class="footer_content" itemscope itemtype="http://schema.org/WPFooter">
			<?php if( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-5') ): ?>
				<div class="container footer-top">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="footer_copyright">
				<div class="container">
					<div class="row">
						<?php 
							relic_fashion_store_footer_copyright();
							relic_fashion_store_payment_method();
						?>
						
					</div>
				</div>
			</div>
		</footer>
	</div>
</div><!-- #content -->
<?php wp_footer(); ?>

</body>
</html>
