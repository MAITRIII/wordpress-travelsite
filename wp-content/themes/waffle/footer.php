<?php
/**
 *
 * @package waffle
 * 
 */
?>

	</div><!-- .site-content -->
        
        
        <?php if(!is_home()){ ?>
        
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				/**
				 * Fires before the Twenty Fifteen footer text for footer customization.
				 *
				 * @since Twenty Fifteen 1.0
				 */
				do_action( 'twentyfifteen_credits' );
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'waffle' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'waffle' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
        
        <?php } ?>
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
